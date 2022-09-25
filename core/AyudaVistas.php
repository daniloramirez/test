<?php
class AyudaVistas
{
    //Helpers para las vistas 
    public function url($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        $urlString="index.php?controller=".$controlador."&action=".$accion;
        return $urlString;
    }    
}
?>
