<?php 

require_once "model/peliculaModel.php";
require_once "model/customerModel.php";
require_once "model/cuentaModel.php";
require_once "model/customerModel.php";
class User extends SessionController{
    private $user;
    private $cuenta;

    function __construct()
    {
        parent::__construct();
        $resultados = $this->getUserSessionData();
        $this->user = $resultados[1];
        $this->cuenta = $resultados[0];
        error_log("User::construct -> userName:" . $this->cuenta->getUsername());
    }

    function render(){
        $session = new Session();
        $peliculas = new PeliculaModel();
        $cuentas = new CuentaModel();
        $clientes = new CustomerModel();
        $arreglo = [
            "user"=>$this->user,
            "actual"=>$session->getCurrentPage()
        ];
        switch($session->getCurrentPage()){
            case "peliculas": $arreglo["peliculas"] = $peliculas->getAll();
                break;
            case "proximamente": $arreglo["peliculas"] = $peliculas->getAllProximamente();
                break;
            case "principal": $arreglo["peliculas"] = $peliculas->getAllCartelera();
                break;
            case "datos": 
                $cuenta_d = $cuentas->get($cuentas->getUsernameByUsuario($session->getCurrentUser()));
                $cliente_d = $clientes->get($session->getCurrentUser());
                $arreglo["datos"] = $cliente_d;
                $arreglo["datos_cuenta"] = $cuenta_d;
                break;
            case "pelicula_detalle": $arreglo["pelicula"] = $peliculas->get($session->getIdPelicula());
                break;
        } 
        $this->view->render("user/index",$arreglo);
    }

    function userCloseSession(){
        $session = new Session();
        $session->closeSession();
        $this->redirect("user",[]); //TODO: 
    }

    function barraRedirect($actual){
        $session = new Session();
        error_log("User::barraRedirect -> direccion_destino: ".$actual[0]);
        $session->setCurrentPage($actual[0]);
        if(isset($actual[1])){
            $session->setIdPelicula($actual[1]);
        }
        $this->redirect("user",[]); //TODO: 
    }

    function updateUserData(){
        try{
            error_log("User::updateUserData -> iniciando proceso de actualización");
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
    }
 
}



?>