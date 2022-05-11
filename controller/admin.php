<?php 

class Admin extends SessionController{
    private $user;
    private $cuenta;

    function __construct()
    {
        parent::__construct();
        $resultados = $this->getUserSessionData();
        $this->user = $resultados[1];
        $this->cuenta = $resultados[0];
        error_log("Admin::construct -> AdminName:" . $this->cuenta->getUsername());
    }

    function render(){
        $session = new Session();
        $this->view->render("admin/index",[
            "user"=>$this->user,
            "actual"=>$session->getCurrentPage()
        ]);
    }

    function AdminCloseSession(){
        $session = new Session();
        $session->closeSession();
        $this->redirect("admin",[]); //TODO: 
    }

    function barraRedirect($actual){
        $session = new Session();
        error_log("Admin::barraRedirect -> direccion_destino: ".$actual[0]);
        $session->setCurrentPage($actual[0]);
        $this->redirect("admin",[]); //TODO: 
    }
 
}



?>