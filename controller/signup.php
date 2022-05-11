<?php 

require_once "model/cuentaModel.php";

class Signup extends SessionController{
    public function __construct()
    {
        parent::__construct();
    }

    function render(){
        $this->view->render("login/signup",[]);
    }

    function newUser(){
        if($this->existPOST(["username","password"])){
            $username = $this->getPOST("username");
            $password = $this->getPOST("password");

            if($username == "" || empty($username) || $password == "" || empty($password)){
                $this->redirect("signup",["error"=> ErrorMessage::ERROR_SIGNUP_NEWUSER_EMPTY]);
                return false;
            }
            $user = new CuentaModel();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setRole("2");

            if($user->exists($username)){
                $this->redirect("signup",["error"=> ErrorMessage::ERROR_SIGNUP_NEWUSER_EXISTS]);
            }else if($user->save()){
                $this->redirect("",["success"=> SuccessMessage::SUCCESS_SIGNUP_NEWUSER]);
            }else{
                $this->redirect("signup",["error"=> ErrorMessage::ERROR_SIGNUP_NEWUSER]);
            }
        }else{
            error_log("no exite el post de username o password");
            $this->redirect("signup",["error"=> ErrorMessage::ERROR_SIGNUP_NEWUSER]);
        }
    }
}
?>