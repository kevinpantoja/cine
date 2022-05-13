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
            $datos = new CustomerModel();
            $user->setPassword($password);
            $user->setRole("2");
            $user->setUsuario($_POST["dni"]);

            if($user->exists($username)){
                $this->redirect("signup",["error"=> ErrorMessage::ERROR_SIGNUP_NEWUSER_EXISTS]);
            }else if(!$this->existPOST(["dni"])){
                $this->redirect("signup",["error"=> ErrorMessage::ERROR_SIGNUP_NEWUSER]);
            }else if($datos->exists($_POST["dni"])){
                $this->redirect("signup",["error"=> ErrorMessage::ERROR_SIGNUP_NEWUSER_EXISTS]);
            }
            else if($user->save()){
                $datos->from(array(
                    "id"=>$_POST["dni"],
                    "nombres"=>$_POST["name"],
                    "apellido_p"=>$_POST["apellido_p"],
                    "apellido_m"=>$_POST["apellido_m"],
                    "correo"=>$_POST["correo"],
                    "fecha_nacimiento"=>$_POST["fecha_nacimiento"]));
                if($datos->save()){
                    $this->redirect("",["success"=> SuccessMessage::SUCCESS_SIGNUP_NEWUSER]);
                }else{
                    $this->redirect("",["error"=> ErrorMessage::ERROR_LOGIN_AUTHENTICATE]);
                }
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