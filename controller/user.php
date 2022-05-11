<?php 

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
        $this->view->render("user/index",[
            "user"=>$this->user,
            "actual"=>$session->getCurrentPage()
        ]);
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
        $this->redirect("user",[]); //TODO: 
    }
 
}



?>