<?php
class Conectar
{
    public $driver;
    public $host, $path, $charset, $endpoint;
   
    public function __construct() {
        $db_cfg = require_once 'config/database.php';
        $this->driver = $db_cfg["driver"];
        $this->host = $db_cfg["host"];
        $this->path = $db_cfg["path"];
        $this->charset = $db_cfg["charset"];
        $this->endpoint = $db_cfg["endpoint"];
    }
}
?>
