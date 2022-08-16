<?php 
require_once "controller/errores.php"; 

class App{
    function __construct()
    {
        error_log("APP::getRuta->no hay controlador especificado".$_GET["url"]);
        $url = isset($_GET["url"]) ? $_GET["url"]: null;
        $url = rtrim($url,"/");//borrar cualquier diagonal que se encuentre al final de la url
        $url = explode("/",$url);//dividir en elementos usando el separado /
        if(empty($url[0])){
            error_log("APP::construct->no hay controlador especificado");
            $archivoController = "controller/invitado.php";
            require_once $archivoController;
            $controller = new Invitado();
            /* $controller->loadModel("invitado"); */
            /* $controller = new Login();
            $controller->loadModel("login"); */
            $controller->render();
            return false;
        }
        $archivoController = "controller/".$url[0].".php";
        if(file_exists($archivoController)){
            require_once $archivoController;
            $controller = new $url[0];
            $controller->loadModel($url[0]);
            if(isset($url[1])){
                if(method_exists($controller,$url[1])){
                    if(isset($url[2])){
                        $nparam = count($url)-2;
                        //arreglo de parámetros
                        $params = [];
                        for($i = 0; $i < $nparam; $i++){
                            array_push($params,$url[$i+2]);
                        }
                        $controller->{$url[1]}($params);
                    }else{
                        //no tiene parámetros, el método se llama tal cual
                        $controller->{$url[1]}();
                    }
                }else{
                    //error, no existe el método
                    $controller = new Errores();
                    $controller->render();
                }
            }else{
                //no hay método a cargar
                $controller->render();
            }
        }else{
            //no existe el archivo, manda error
            $controller = new Errores();
            $controller->render();
        }
    }
}

?>