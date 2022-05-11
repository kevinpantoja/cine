<?php 

class Login extends SessionController{
    function __construct(){
        parent::__construct();
        error_log("Login::construct -> inicio de Login");
    }

    function render(){
        error_log("Login::render -> carga el inicio del login");
        $actual_link = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actual_link);
        $this->view->errorMessage = '';
        $this->view->render("login/index");
    }

    function authenticate(){
        $this->loadModel("login");
        if($this->existPOST(["username","password"])){
            $username = $this->getPOST("username");
            $password = $this->getPOST("password");

            if($username == "" || empty($username) || $password == "" || empty($password)){
                error_log('Login::authenticate() empty');
                $this->redirect("",["error"=> ErrorMessage::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
                return ;
            } 

            $resultados = $this->model->login($username,$password);

            if($resultados != NULL){
                $cuenta = $resultados[0];
                $user = $resultados[1];
                error_log('Login::authenticate() passed');  
                $this->initialize($cuenta,$user);
            }else{
                error_log('Login::authenticate() username and/or password wrong');
                $this->redirect("",["error"=> ErrorMessage::ERROR_LOGIN_AUTHENTICATE_DATA]);
            }
        }else{
            error_log('Login::authenticate() error with params');
            $this->redirect("",["error"=> ErrorMessage::ERROR_LOGIN_AUTHENTICATE]);
        }
    }



}

?>