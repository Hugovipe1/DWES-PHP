<?php
    require("../vendor/autoload.php");
    use App\Model\Equipo;
    use App\Model\DBAbtractModel;
    
    
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/..");
    $dotenv->load();
    var_dump($_ENV);
?>