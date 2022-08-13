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
/*         $resultados = $this->getUserSessionData();
        $this->user = $resultados[1];
        $this->cuenta = $resultados[0]; */
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
            case "proximamente": $arreglo["peliculas"] = $peliculas->getAllProximamente();
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
        $this->redirect("invitado",[]); //TODO: 
    }

    /* function updateUserData(){
        try{
            error_log("Invi::updateUserData -> iniciando proceso de actualización");
            $clienteModel = new CustomerModel();
            $clienteModel->from(array(
                "id"=>$_POST["dni"],
                "nombres"=>$_POST["name"],
                "apellido_p"=>$_POST["apellido_p"],
                "apellido_m"=>$_POST["apellido_m"],
                "correo"=>$_POST["correo"],
                "fecha_nacimiento"=>$_POST["fecha_nacimiento"]
            ));   
            $clienteModel->update();
            $this->redirect("user",["success"=> SuccessMessage::SUCCESS_UPDATE_USER]);         
        }catch(PDOException $e){
            error_log("User::updateUserData -> error en procesamiento de datos ".$e->getMessage());
            $this->redirect("user",["error"=> ErrorMessage::ERROR_LOGIN_AUTHENTICATE]);
        }
    } */
 
}



?>