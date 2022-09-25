<?php
class EntidadBase
{
    public $table;
    private $conectar;
 
    public function __construct($table) {
        $this->table = (string) $table;
         
        require_once 'Conectar.php';
        $this->conectar = new Conectar();
    }
     
    public function db(){
        return $this->conectar;
    }
    
}
?>
