<?php
class UserController extends ControladorBase
{     
    public function __construct()
    {
        parent::__construct();
    }
     
    public function login()
    {         
        //Creamos el objeto usuario
        $model = new User();

        //Se validan si existen valores del post
        if(isset($_POST["username"]) || isset($_POST["password"]))
        {
            $model->setUsername($_POST["username"]);
            $model->setPassword($_POST["password"]);

            //Validaciones del modelo por parte del servidor
            if($model->find())
            {
                //Se redirige hacia el Movie/admin
                $this->redirect("movie", "admin");
            }

        }
        
        //Cargamos la vista login
        $this->view("login", array(
            "model" => $model
        ));
    }

    public function create()
    {
        //Creamos el objeto usuario
        $model = new User();

        //Se validan si existen valores del post
        if(isset($_POST["username"]) || isset($_POST["phone"]) || isset($_POST["email"]) || isset($_POST["password"]))
        {     
            //Le damos valor a los atributos
            $model->setUsername($_POST["username"]);
            $model->setPhone($_POST["phone"]);
            $model->setEmail($_POST["email"]);
            $model->setPassword($_POST["password"]);

            //Validaciones del modelo por parte del servidor
            if($model->validate())
            {
                //Se guarda el registro
                $model->save();
                //Se redirige hacia el login
                $this->redirect("user", "login");
            }
        }

        //Cargamos la vista registro
        $this->view("registro", array(
            "model" => $model
        ));
    }
}
?>