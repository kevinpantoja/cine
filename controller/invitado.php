<?php 

require_once "model/peliculaModel.php";
require_once "model/customerModel.php";
class Invitado extends Controller{
/*     private $user;
    private $cuenta;
 */
    function __construct()
    {
        $session = new Session();
        if(isset($_SESSION["usuario"])){
            $sessionControler = new SessionController();
            $sessionControler->validateSession();
        }else{
            parent::__construct();
        }
    }

    function render(){
        $session = new Session();
        $peliculas = new PeliculaModel();
        $arreglo = [];
        if(isset($_SESSION["actual"])){
            $arreglo = [
                "actual"=>$session->getCurrentPage()
            ];    
        }else{
            $arreglo = [
                "actual"=>"principal"
            ];  
        }
        switch($arreglo["actual"]){
            case "peliculas": $arreglo["peliculas"] = $peliculas->getAll();
                break;
            case "principal": $arreglo["peliculas"] = $peliculas->getAllCartelera();
                break;
            case "proximamente": $arreglo["peliculas"] = $peliculas->getAllProximamente();
                break;
            case "pelicula_detalle": $arreglo["pelicula"] = $peliculas->get($session->getIdPelicula());
                break;
        } 
        $this->view->render("invitado/index",$arreglo);
    }

    function login(){
        $this->redirect("login",[]); //TODO: 
    }

    function barraRedirect($actual){
        $session = new Session();
        error_log("Invitado::barraRedirect -> direccion_destino: ".$actual[0]);
        $session->setCurrentPage($actual[0]);
        if(isset($actual[1])){
            $session->setIdPelicula($actual[1]);
        }
        $this->redirect("invitado",[]); //TODO: 
    }

 
}



?>