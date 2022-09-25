<?php
class Movie extends EntidadBase
{
    //Atributos necesarios para el modelo
    public $title;
    public $initDate;
    public $endDate;
    public $sort;
    public $search;
    public $errors;
    
    //Se define el valor que tendra el archivo de datos
    public function __construct()
    {
        $table = "movie";
        parent::__construct($table);
    }

    public function setTitle($title)
    {
        $this->title = trim($title);
    }

    //Inicializamos los Setters
    public function setInitDate($initDate)
    {
        $this->initDate = trim($initDate);
    }

    public function setEndDate($endDate)
    {
        $this->endDate = trim($endDate);
    }

    public function setSort($sort)
    {
        $this->sort = trim($sort);
    }
    //Finalizamos los Setters

    //Nos traemos los errores
    public function getErrors()
    {
        return $this->errors;
    }

    //Descargamos la data del endpoint
    public function download()
    {
        return json_decode(file_get_contents($this->db()->endpoint))->Search;
    }

    //Validaciones por parte del servidor para el rango de fechas
    public function validate()
    {
        //Se inicializa con el valor true de retorno por defecto
        $return = true;

        if(!empty($this->initDate) && !empty($this->endDate))
        {
            //Expresión regular para validar campo Date
            $pattern = "/^[0-9]{4}+$/";

            //Se valida con la fecha inicial
            if(!preg_match($pattern, $this->initDate))
            {
                $this->errors .= 'Initial Date Invalid: Must contain only numbers and 4 digits, ';
            }

            //Se valida con la fecha final
            if(!preg_match($pattern, $this->endDate))
            {
                $this->errors .= 'Initial Date Invalid: Must contain only numbers and 4 digits, ';
            }

            //Se valida el rango de fechas
            if(empty($this->errors))
            {
                if($this->endDate < $this->initDate)
                {
                    $this->errors .= 'The date range is invalid, ';
                }
            }

            //Se valida si contiene algún error
            if(!empty($this->errors))
            {
                //Se retiran los espacios
                $this->errors = trim($this->errors);
                
                //Se retira la coma final y se reemplaza por un punto
                $this->errors = substr($this->errors, 0, -1);
                $this->errors .= ".";

                //Se cambia el valor de retorno.
                $return = false;
            }
        }

        return $return;
    }

    //Guarda los registros
    public function save()
    {
        $conexion = $this->db()->path.$this->table.$this->db()->driver;

        //Codificamos el array en JSON
        $json_string = json_encode($this->search);
        
        //Guardamos
        $save = file_put_contents($conexion, $json_string);
        
        return $save;
    }

    public function findAll()
    {
        //Traemos la ruta del archivo JSON plano
        $conexion = $this->db()->path.$this->table.$this->db()->driver;

        //Validamos si el archivo existe
        if(file_exists($conexion))
        {
            $data = file_get_contents($conexion);
            if($data)
            {
                $this->search = json_decode($data);
            }
        }
    }

    public function find()
    {
        //Traemos la ruta del archivo JSON plano
        $conexion = $this->db()->path.$this->table.$this->db()->driver;

        //Validamos si el archivo existe
        if(file_exists($conexion))
        {
            //Extraemos la información guardada
            $data = file_get_contents($conexion);
            
            //Valimos si se trae algún datos
            if($data)
            {
                //Se decodifican los datos para convertirlos en un array de objetos
                $data = json_decode($data);
                if(!empty($this->title))
                {
                    //Iniciamos variable auxiliar
                    $movies = array();

                    //Recorremos los datos para filtrar
                    for($i = 0; $i < count($data); $i++ )
                    {
                        //Array con numero de coincidencias
                        if(strpos(strtolower($data[$i]->Title), strtolower($this->title)) !== false)
                        {
                            $movies[] = $data[$i];
                        }
                    }
                    
                    //Igualamos valores para retornar
                    $data = $movies;
                    $this->search = $data;
                    
                }

                if(!empty($this->initDate) && !empty($this->endDate))
                {
                    //Iniciamos variable auxiliar
                    $movies = array();

                    //Recorremos los datos para filtrar
                    for($i = 0; $i < count($data); $i++ )
                    {
                        //Explotamos el dato para separar las fechas compuestas
                        $year = $data[$i]->Year;
                        $year = explode("-", $year);
                        $year = $year[0];

                        //Array con numero de coincidencias
                        if($year >= $this->initDate && $year <= $this->endDate)
                        {
                            $movies[] = $data[$i];
                        }
                    }

                    //Igualamos valores para retornar
                    $data = $movies;
                    $this->search = $data;
                }

                //Validamos si se pide ordenar por titulo                
                if($this->sort == "1")
                {
                    asort($data);
                    $this->search = $data;
                }

                //Validamos si se pide ordenar por año  
                if($this->sort == "2")
                {
                    $movies = array();
                    foreach ($data as $key => $row)
                    {
                        $movies[$key] = $row->Year;
                    }

                    array_multisort($movies, SORT_ASC, $data);
                    $this->search = $data;
                }
            }
        }

    }
    
}