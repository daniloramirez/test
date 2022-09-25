<?php
    // Se realiza la configuración inicial a la conexión de la base de datos, 
    // en este caso es un archivo JSON plano 
    return array(
        "driver"    =>  ".json",
        "host"      =>  "localhost",
        "charset"   =>  "utf8",
        'path'      =>  "database/",
        'endpoint'      =>  "https://www.omdbapi.com/?s=avengers&apiKey=fc59da33"
    );
?>
