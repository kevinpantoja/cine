<?php 

class PeliculaModel extends Model implements IModel{
    private $id;
    private $nombre;
    private $duracion;
    private $clasificacion;
    private $foto;
    private $descripcion;
    private $modo;
    private $link_trailer;
    private $director;

    public function save(){
        try{
            $query = $this->prepare("INSERT INTO pelicula(id, nombre, duracion, foto, descripcion, clasificacion, modo, link_trailer, director) VALUES (:id,:nombre,:duracion,:foto,:descripcion,:clasificacion,:modo,:link_trailer,:director)");
            $query->execute([
                "id"=>$this->id,
                "nombre"=>$this->nombre,
                "duracion"=>$this->duracion,
                "clasificacion"=>$this->clasificacion,
                "foto"=>$this->foto,
                "descripcion"=>$this->descripcion,
                "modo"=>$this->modo,
                "link_trailer"=>$this->link_trailer,
                "director"=>$this->director
            ]);
            return true;
        }catch(PDOException $e){
            error_log("PeliculaMODEL::save->PDOException ".$e);
            return false;
        }
    }

    function updatePhoto($foto, $id){
        try{
            $query = $this->db->connect()->prepare('UPDATE PELICULA SET foto = :val WHERE id = :id');
            $query->execute(['val' => $foto, 'id' => $id]);

            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        
        }catch(PDOException $e){
            return NULL;
        }
    }

    public function exists($id){
        try{
            $query = $this->prepare("SELECT ID FROM PELICULA WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            if($query->rowCount()>0){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            error_log("PeliculaModel::exists->PDOException ".$e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM PELICULA");
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new PeliculaModel();
                $item->setId($row["id"]);
                $item->setNombre($row["nombre"]);
                $item->setDuracion(intval($row["duracion"]));
                $item->setClasificacion($row["clasificacion"]);
                $item->setFoto($row["foto"]);
                $item->setDescripcion($row["descripcion"]);
                $item->setModo($row["modo"]);
                $item->setLink_trailer($row["link_trailer"]);
                $item->setDirector($row["director"]);
                array_push($items,$item);
            }
            return $items;
        }catch(PDOException $e){
            error_log("AdminModel::getAll->PDOException ".$e);
            return null;
        }
    }

    public function getAllProximamente(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM PELICULA WHERE modo = 'proximamente'");
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new PeliculaModel();
                $item->setId($row["id"]);
                $item->setNombre($row["nombre"]);
                $item->setDuracion(intval($row["duracion"]));
                $item->setClasificacion($row["clasificacion"]);
                $item->setFoto($row["foto"]);
                $item->setDescripcion($row["descripcion"]);
                $item->setModo($row["modo"]);
                $item->setLink_trailer($row["link_trailer"]);
                $item->setDirector($row["director"]);
                array_push($items,$item);
            }
            return $items;
        }catch(PDOException $e){
            error_log("AdminModel::getAll->PDOException ".$e);
            return null;
        }
    }



    public function get($id){
        error_log("PELICULAModel::get -> ".$id);
        try{
            $query = $this->prepare("SELECT * FROM PELICULA WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->setId($row["id"]);
            $this->setNombre($row["nombre"]);
            $this->setDuracion(intval($row["duracion"]));
            $this->setClasificacion($row["clasificacion"]);
            $this->setFoto($row["foto"]);
            $this->setDescripcion($row["descripcion"]);
            $this->setModo($row["celular"]);
            $this->setLink_trailer($row["link_trailer"]);
            $this->setDirector($row["director"]);
            return $this;
        }catch(PDOException $e){
            error_log("PELICULAModel::get->PDOException ".$e);    
        }
    }

    public function delete($id){

    }

    public function update(){

    }

    public function from($array){
        $this->id = $array["id"];
        $this->nombre = $array["nombre"];
        $this->duracion = $array["duracion"];
        $this->clasificacion = $array["clasificacion"];
        $this->foto = $array["foto"];
        $this->descripcion = $array["descripcion"];
        $this->modo = $array["modo"];
        $this->link_trailer = $array["link_trailer"];
        $this->director = $array["director"];
    }



    public function setId($valor){$this->id = $valor;}
    public function setNombre($valor){$this->nombre = $valor;}
    public function setDuracion($valor){$this->duracion = $valor;}
    public function setClasificacion($valor){$this->clasificacion = $valor;}
    public function setFoto($valor){$this->foto = $valor;}
    public function setDescripcion($valor){$this->descripcion = $valor;}
    public function setModo($valor){$this->modo = $valor;}
    public function setLink_trailer($valor){$this->link_trailer = $valor;}
    public function setDirector($valor){$this->director = $valor;}

    public function getId(){return $this->id;}
    public function getNombre(){return $this->nombre;}
    public function getDuracion(){return $this->duracion;}
    public function getClasificacion(){return $this->clasificacion;}
    public function getFoto(){return $this->foto;}
    public function getDescripcion(){return $this->descripcion;}
    public function getModo(){return $this->modo;}
    public function getLink_trailer(){return $this->link_trailer;}
    public function getDirector(){return $this->director;}    

}


?>