<?php
class MovieController extends ControladorBase
{     
    public function __construct()
    {
        parent::__construct();
    }
     
    public function admin()
    {         
        //Creamos el objeto Movie
        $model = new Movie();
        
        //Nos traemos todos los datos del modelo
        $model->findAll();

        //Se validan si existen valores del post
        if(isset($_POST["title"]) || isset($_POST["initDate"]) || isset($_POST["endDate"]) || isset($_POST["sort"]))
        {
            //Le damos valor a los atributos
            $model->setTitle($_POST["title"]);
            $model->setInitDate($_POST["initDate"]);
            $model->setEndDate($_POST["endDate"]);
            $model->setSort($_POST["sort"]);
            
            //Se valida el rango de fechas para realizar la busqueda 
            if($model->validate())
            {
                //Se realiza la busqueda con filtros
                $model->find();
            }
        }

        //Cargamos la vista movieList
        $this->view("admin", array(
            "model" => $model
        ));
    }

    public function update()
    {
        //Creamos el objeto Movie
        $model = new Movie();

        //Descargamos la información
        $data = $model->download();

        //Validamos que exista
        if($data)
        {
            $model->search = $data;
            $model->save();
                            
            //Se redirige hacia el admin
            $this->redirect("movie", "admin");
        }
    }
}
?>