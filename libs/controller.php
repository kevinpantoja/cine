<?php 

class Controller{
    function __construct()
    {
        $this->view = new View();
    }

    function loadModel($model){
        $url = "model/".$model."Model.php";

        if(file_exists($url)){
            require_once $url;

            $modelName = $model."Model";
            $this->model = new $modelName();
        }
    }

    function existPOST($params){
        //$params son todos los parámetros que quiero validar que existe en el POST
        foreach($params as $param){
            if(!isset($_POST[$param])){
                error_log("CONTROLLER::existsPOST => No existe el parámetro ".$param);
                return false;
            }
        }
        return true;
    }

    function getGET($name){
        return $_GET[$name];
    }

    function getPOST($name){
        return $_POST[$name];
    }


    function redirect($url,$mensajes = []){
        $data = [];
        $params = "";
        foreach($mensajes as $key => $mensaje){
            array_push($data,$key."=".$mensaje);
        }
        $params = join("&",$data);
        if($params != ""){
            $params = "?".$params;
        }
        error_log("Controller::redirect -> "."location: ".constant("URL").$url.$params);
        header("location: ".constant("URL").$url.$params);
    }
}

?>