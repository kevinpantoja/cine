<?php 

class Session{
    private $sessionName = "usuario";
    private $currentPage = "actual";
    private $idPelicula = "id_pelciula";
    public $idFuncion = "id_funcion"; 
    public $boletos = "tickets";
    public $asientos = "asientos";

    public function __construct()
    {
        error_log("Session::construct");
        if(session_status() == PHP_SESSION_NONE){
            error_log("Session::construct ->session_start");
            session_start();
        }else{
            error_log("Session::construct ->session vigente");
        }
    }

    public function setAsientos($asientos){
        $_SESSION[$this->asientos] = $asientos;
    }
    public function setCurrentUser($user){
        $_SESSION[$this->sessionName] = $user;       
    }

    public function setIdPelicula($idPel){
        $_SESSION[$this->idPelicula] = $idPel;
    }

    public function setIdFuncion($idPel){
        $_SESSION[$this->idFuncion] = $idPel;
    }

    public function setCurrentPage($page){
        $_SESSION[$this->currentPage] = $page;
    }

    public function setTickets($tickes){
        $_SESSION[$this->boletos] = $tickes;
    }

    public function getCurrentPage(){
        return $_SESSION[$this->currentPage];
    }

    public function getCurrentUser(){
        return $_SESSION[$this->sessionName];
    }

    public function getTickets(){
        return $_SESSION[$this->boletos];
    }

    public function getIdPelicula(){
        return $_SESSION[$this->idPelicula];
    }

    public function getIdFuncion(){
        return $_SESSION[$this->idFuncion];
    }

    public function getAsientos(){
        return $_SESSION[$this->asientos];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }

    public function exists(){
        return isset($_SESSION[$this->sessionName]);
    }
}
?>