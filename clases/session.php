<?php 

class Session{
    private $sessionName = "usuario";
    private $currentPage = "actual";
    private $idPelicula = "id_pelciula";

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

    public function setCurrentUser($user){
        $_SESSION[$this->sessionName] = $user;       
    }

    public function setIdPelicula($idPel){
        $_SESSION[$this->idPelicula] = $idPel;
    }

    public function setCurrentPage($page){
        $_SESSION[$this->currentPage] = $page;
    }

    public function getCurrentPage(){
        return $_SESSION[$this->currentPage];
    }

    public function getCurrentUser(){
        return $_SESSION[$this->sessionName];
    }

    public function getIdPelicula(){
        return $_SESSION[$this->idPelicula];
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