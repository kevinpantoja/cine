<?php 


require_once "clases/session.php";
include_once "model/cuentaModel.php";
include_once "model/adminModel.php";
include_once "model/employeeModel.php";
include_once "model/customerModel.php";

class SessionController extends Controller{

    private $userSession;
    private $username;
    private $userid;

    private $session;
    private $sites;

    private $user;
    private $cuenta;

    function __construct()
    {
        error_log("ControllerSession::construct");
        parent::__construct();
        $this->init();
    }

    public function init(){
        error_log("ControllerSession::init");
        $this->session = new Session();
        error_log("ControllerSession::init session creada");
        $json = $this->getJSONFileConfig();

        $this->sites = $json["sites"];
        $this->defaultSites = $json["default-sites"];

        $this->validateSession();
    }

    private function getJSONFileConfig(){
        $string = file_get_contents("config/access.json");
        $json = json_decode($string,true);
        return $json;
    }

    public function validateSession(){
        error_log("SESSIONCONTROLLER::validateSession");
        if($this->existsSession()){
            //sí existe la sesion
            $respuestas = $this->getUserSessionData();
            $role = $respuestas[0]->getRole();
            //si la página a entrar es pública
            switch($role){
                case "1": $role = "admin";
                    break;
                case "2": $role = "user";
                    break;
                case "3": $role = "employee";
                    break;
                default: $role = "invitado";
                    break;
            }
            if($this->getCurrentPage() == NULL){
                $this->redirectDefaultSiteByRole($role);
                return ;
            }
            if($this->isPublic()){
                error_log("SESSIONCONTROLLER::validateSession -> sesión pública");
                $this->redirectDefaultSiteByRole($role);
            }else{
                if($this->isAuthorized($role)){
                    error_log("SESSIONCONTROLLER::validateSession -> sesión privada autorizada");
                    //lo dejo pasar
                }else{
                    error_log("SESSIONCONTROLLER::validateSession -> sesión privada sin autorización");
                    $this->redirectDefaultSiteByRole($role);
                }
            }
        }else{
            //no existe la sesion
            error_log("SESSIONCONTROLLER::validateSession -> sin sesión");
            if($this->isPublic()){
                //lo deja entrar
                error_log("SESSIONCONTROLLER::validateSession -> sin sesión pública");
            }else{
                error_log("SESSIONCONTROLLER::validateSession -> sin sesión no pública");
                header("location: ".constant("URL")."");
            }
        }
    }

    function existsSession(){
        if(!$this->session->exists()) return false; 
        if($this->session->getCurrentUser() == NULL) return false;

        error_log("SessionController::existsSession -> currentUser:".$this->session->getCurrentUser());
        $userid = $this->session->getCurrentUser();

        if($userid){
            $this->userid = $userid;
            return true;
        } 
        return false;
    }

    function getUserSessionData(){
        $id = $this->userid;
        error_log("SESSIONCONTROLLER::getUserSessionData -> id:  ".$id);
        $this->cuenta = new CuentaModel();
        $this->cuenta->get($this->cuenta->getUsernameByUsuario($id));
        switch($this->cuenta->getRole()){
            case "1":
                $this->user = new AdminModel();
                $this->user->get($this->cuenta->getUsuario());
                break;
            case "2":
                $this->user = new CustomerModel();
                $this->user->get($this->cuenta->getUsuario());
                break;
            case "3":
                $this->user = new EmployeeModel();
                $this->user->get($this->cuenta->getUsuario());
                break;
        }
        error_log("SESSIONCONTROLLER::getUserSessionData -> username: ".$this->cuenta->getUsername());
        return array($this->cuenta,$this->user);
    }

    private function isPublic(){
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/","",$currentURL);

        for($i = 0; $i < sizeof($this->sites); $i++){
            if($currentURL == $this->sites[$i]["site"] && $this->sites[$i]["access"] == "public"){
                error_log("SessionController::isPublic -> true:".$this->sites[$i]["site"]);
                return true;
            }
        }
        error_log("SessionController::isPublic -> false:".$currentURL);
        return false;
    }

    function getCurrentPage(){
        error_log("SessionController::getCurrentPage request_url->".$_SERVER["REQUEST_URI"]);
        $actualLink = trim("$_SERVER[REQUEST_URI]");
        $url = explode("/",$actualLink);
        error_log("SESSIONCONTROLLER::getCurrentPage  actualLink ".$actualLink."-> url = ".$url[3]);
        return $url[3];
    }

    private function redirectDefaultSiteByRole($role){
        $url = "";
        for($i = 0; $i < sizeof($this->sites); $i++){
            if($this->sites[$i]["role"] == $role){
                $url = constant("URL").$this->sites[$i]["site"];
                break;
            }
        }
        header("location: ".$url);
    }

    private function isAuthorized($role){
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/","",$currentURL);

        for($i = 0; $i < sizeof($this->sites); $i++){
            if($currentURL == $this->sites[$i]["site"] && $this->sites[$i]["role"] == $role){
                return true;
            }
        }
        return false;
    }

    function initialize($cuenta,$user){
        error_log("sessionController::initialize(): user_id: ".$user->getId());
        $this->session->setCurrentUser($user->getId());
        $this->session->getCurrentPage("");
        error_log("sessionController::initialize(): session('user'): " . $this->session->getCurrentUser());
        $this->authorizeAccess($cuenta->getRole());

    }

    private function authorizeAccess($role){
        error_log("sessionController::authorizeAccess(): role: $role");
        switch($role){
            case "1":
                $this->redirect($this->defaultSites["admin"]);
            break;
            case "2":
                $this->redirect($this->defaultSites["user"]);
            break;
            case "3":
                $this->redirect($this->defaultSites["deployee"]);
            break;
            default;
        }
    }

    function logout(){
        $this->session->closeSession();
    }

}


?>