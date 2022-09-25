<?php
class User extends EntidadBase
{
    //Atributos necesarios para el modelo
    public $username;
    public $phone;
    public $email;
    public $password;
    public $errors;
    
    //Se define el valor que tendra el archivo de datos
    public function __construct()
    {
        $table = "user";
        parent::__construct($table);
    }

    //Inicializamos los Setters
    public function setUsername($username)
    {
        $this->username = trim($username);
    }

    public function setPhone($phone)
    {
        $this->phone = trim($phone);
    }

    public function setEmail($email)
    {
        $this->email = trim($email);
    }

    public function setPassword($password)
    {
        $this->password = trim($password);
    }
    //Finalizamos los Setters

    //Nos traemos los errores
    public function getErrors()
    {
        return $this->errors;
    }

    //Nos traemos los registros de la tabla usuario
    public function find()
    {
        //Se inicializa con el valor false de retorno por defecto
        $return = false;

        //Validación de username
        if(empty($this->username))
        {
            $this->errors .= "Username Empty, ";
        }

        //Validación de pasword
        if(empty($this->password))
        {
            $this->errors .= "Password Empty, ";
        }

        if(!empty($this->username) && !empty($this->password))
        {
            //Traemos la ruta del archivo JSON plano
            $conexion = $this->db()->path.$this->table.$this->db()->driver;

            //Validamos si el archivo existe
            if(file_exists($conexion))
            {
                $data = file_get_contents($conexion);
                if($data)
                {
                    //Se decodifican los datos para convertirlos en un array de objetos
                    $data = json_decode($data);

                    if(is_array($data))
                    {
                        //Recorremos los registros para saber si el usuario y la contraseña ingresados se encuentran en la base de datos
                        foreach ($data as $key => $value) {
                            if($value->username == $this->username && $value->password == md5($this->password))
                            {
                                $return = true;
                                break;
                            }
                        }
                    }

                    if(!$return)
                    {
                        $this->errors .= 'Username and Password not found, ';
                    }
                }
            }else
            {
                $this->errors .= 'Username and Password not found, ';
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

        return $return;

    }

    //Validaciones por parte del servidor según reglas de negocio
    public function validate()
    {
        //Se inicializa con el valor true de retorno por defecto
        $return = true;

        //Validación de username
        if(empty($this->username))
        {
            $this->errors .= "Username Empty, ";
        }else
        {
            //Expresión regular para validar campo username
            $pattern = "/^[a-zA-Z]+$/";
            
            if(!preg_match($pattern, $this->username))
            {
                $this->errors .= 'Username Invalid: Cannot contain spaces or numbers, ';
            }

        }

        //Validación de phone
        if(empty($this->phone))
        {
            $this->errors .= "Phone Empty, ";

        }else
        {
            //Expresión regular para validar campo phone
            $pattern = "/^\+[0-9]{9}+$/";

            if(!preg_match($pattern, $this->phone))
            {
                $this->errors .= 'Phone Invalid: Must contain the sign "+" followed by 9 digits, ';
            }
        }

        //Validación de email
        if(empty($this->email))
        {
            $this->errors .= "Email Empty, ";

        }else
        {
            //Expresión regular para validar campo email
            $pattern = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
            
            if(!preg_match($pattern, $this->email))
            {
                $this->errors .= 'Email Invalid, ';
            }
        }

        //Validación de pasword
        if(empty($this->password))
        {
            $this->errors .= "Password Empty, ";

        }else
        {
            //Expresión regular para validar campo password
            $pattern = "/^(?=\w*[*\-\.])(?=\w*[A-Z])\S{6}$/";

            if(!preg_match($pattern, $this->password))
            {
                $this->errors .= 'Password Invalid: One letter must be uppercased and contain one of these special characters: "*", "-", ".", ';

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

        return $return;

    }

    //Guarda los registros
    public function save()
    {
        //Organizamos los atributos para guardar
        $model = array(
            'username' => $this->username,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => md5($this->password)
        );

        //Traemos la ruta del archivo JSON plano
        $conexion = $this->db()->path.$this->table.$this->db()->driver;

        //Validamos si el archivo existe
        if(file_exists($conexion))
        {
            //Listamos todos los registros
            $lista = file_get_contents($conexion);

            //Decodificamos los registros del archivo plano
            $data = json_decode($lista);
        }else
        {
            $data = array();
        }

        //Agregamos los nuevos registros a la cadena
        array_push($data, $model);

        //Codificamos el array en JSON
        $json_string = json_encode($data);
        
        //Guardamos
        $save = file_put_contents($conexion, $json_string);
        
        return $save;
    }
}
?>