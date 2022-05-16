<?php 
    error_reporting(E_ALL); // error/Exception engine, always use E_ALL
    ini_set("ignore_repeated_errors",TRUE);//always use TRUE
    ini_set("display_errors",FALSE);//error/Exception display, use False only in production
    ini_set("log_errors",TRUE);//error/Exception file logging engine
    ini_set("error_log","./php-error.log");
    error_log("Inicio de aplicacion Web");

    require_once "libs/database.php";

    require_once "clases/errorMessage.php";
    require_once "clases/successMessage.php";

    require_once "libs/controller.php";
    require_once "libs/view.php";
    require_once "libs/model.php";
    require_once "libs/app.php";

    require_once "clases/sessionController.php";

    include_once "clases/barraElemento.php"; 
    include_once "clases/barraGrupo.php"; 

    require_once "config/config.php";

    $app = new App();

    Alex
?>
