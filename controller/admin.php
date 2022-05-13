<?php 

require_once "model/peliculaModel.php";
require_once "model/adminModel.php";
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
        $peliculas = new PeliculaModel();
        $arreglo = [
            "user"=>$this->user,
            "actual"=>$session->getCurrentPage()
        ];
        switch($session->getCurrentPage()){
            case "peliculas": $arreglo["peliculas"] = $peliculas->getAll();
                break;
        } 
        $this->view->render("admin/index",$arreglo);
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

    function newMovie(){
        error_log('admin::newMovie() empezando proceso');
        $this->loadModel("pelicula");
        if($this->existPOST(["nombre","id"])){
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            $duracion = $_POST["duracion"];
            $clasificacion = $_POST["clasificacion"];
            $foto = "";
            $descripcion = $_POST["descripcion"];
            $modo = $_POST["modo"];
            $link_trailer = $_POST["link_trailer"];
            $director = $_POST["director"];
            if(!$this->model->exists($id)){
                $this->model->from(array(
                    "id" => $id,
                    "nombre" => $nombre,
                    "duracion" => $duracion,
                    "clasificacion" => $clasificacion,
                    "foto" => $foto,
                    "descripcion" => $descripcion,
                    "modo" => $modo,
                    "link_trailer" => $link_trailer,
                    "director" => $director,
                ));
                $this->model->save();
                $this->updateMoviePhoto($id);
            }else{
                error_log('admin::newMovie() id ya registrado');
                $this->redirect("admin",["error"=> ErrorMessage::ERROR_MOVIE_EXISTS]);
            }
        }else{
            error_log('admin::newMovie() error with params');
            $this->redirect("admin",["error"=> ErrorMessage::ERROR_LOGIN_AUTHENTICATE]);
        }
    }

    function updateMoviePhoto($id_pelicula){
        if(!isset($_FILES["foto"])){
            error_log('admin::updateMoviePhoto() foto no encontrada');
            $this->redirect("admin",[]); //TODO: 
            return;
        }

        error_log('admin::updateMoviePhoto() foto encontrada');
        $photo = $_FILES["foto"];
        $targetDir = "public/img/photos/";
        $extension = explode(".",$photo["name"]);
        $filename = $extension[sizeof($extension) - 2];
        $ext = $extension[sizeof($extension) - 1];
        $hash = md5(Date("Ymdgi").$filename).".".$ext;
        $targetFile = $targetDir.$hash;
        $uploadOk = false;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        $check = getimagesize($photo["tmp_name"]);
        if($check !== false){
            $uploadOk = true;
        }else{
            $uploadOk = false;
        }

        if(!$uploadOk){
            $this->redirect("admin",[]); //TODO: 
            return;
        }else{
            if(move_uploaded_file($photo["tmp_name"],$targetFile)){
                $this->model->updatePhoto($hash,$id_pelicula);
                $this->redirect("admin",[]); //TODO: 
                return;
            }else{
                $this->redirect("admin",[]); //TODO: 
                return;
            }
        }
    }    

    function updateAdminData(){
        try{
            error_log("Admin::updateAdminData -> iniciando proceso de actualización");
            $adminModel = new AdminModel();
            $adminModel->from(array(
                "id"=>$_POST["dni"],
                "nombres"=>$_POST["name"],
                "apellido_p"=>$_POST["apellido_p"],
                "apellido_m"=>$_POST["apellido_m"],
                "correo"=>$_POST["correo"],
                "fecha_nacimiento"=>$_POST["fecha_nacimiento"],
                "direccion"=>$_POST["direccion"],
                "celular"=>$_POST["celular"]
            ));   
            $adminModel->update();
            $this->redirect("admin",["success"=> SuccessMessage::SUCCESS_UPDATE_USER]);         
        }catch(PDOException $e){
            error_log("Admin::updateAdminData -> error en procesamiento de datos ".$e->getMessage());
            $this->redirect("admin",["error"=> ErrorMessage::ERROR_LOGIN_AUTHENTICATE]);
        }
    }
 
}



?>