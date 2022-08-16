<?php 

class GolosinaModel extends Model{
    private $id;
    private $nombre;
    private $descripcion;
    private $precios;
    private $rutaImagen;

    public function save(){
        try{
            if(sizeof($this->precios) == 0){
                $query = $this->prepare("INSERT INTO confiteria(id, nombre, descripcion) VALUES (:id,:nombre,:descripcion)");
                $query->execute([
                    "id"=>$this->id,
                    "nombre"=>$this->nombre,
                    "descripcion"=>$this->descripcion
                ]);
                $query = $this->prepare("INSERT INTO tipoconfiteria(idTipoConfiteria, tamano, precio) VALUES (:id,:tamano,:precio)");
                $query->execute([
                    "id"=>$this->id,
                    "tamano"=>NULL,
                    "precio"=>$this->precios["unico"]
                ]);
                return true;    
            }else{

            }
        }catch(PDOException $e){
            error_log("confiteriaMODEL::save->PDOException ".$e);
            return false;
        }
    }

    function updatePhoto($foto, $id){
        try{
            $query = $this->db->connect()->prepare('UPDATE confiteria SET rutaImagen = :val WHERE id = :id');
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
            $query = $this->prepare("SELECT ID FROM confiteria WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            if($query->rowCount()>0){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            error_log("confiteriaModel::exists->PDOException ".$e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM confiteria");
            $items = [];
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new GolosinaModel();
                $item->setId($row["id"]);
                $item->setNombre($row["nombre"]);
                $item->setDescripcion($row["descripcion"]);
                $item->setRutaImagen($row["rutaImagen"]);
                $items[$row["id"]]=$item;
            }
            $query = $this->query("SELECT * FROM tipoconfiteria");
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                if($row["tamano"] == null){
                    $items[$row["idTipoConfiteria"]]->setPrecio("unico",$row["precio"]);
                }else{
                    $items[$row["idTipoConfiteria"]]->setPrecio($row["tamano"],$row["precio"]);
                }
            }
            return $items;
        }catch(PDOException $e){
            error_log("confiteriaModel::getAll->PDOException ".$e);
            return null;
        }
    }


    public function get($id){
        error_log("confiteriaModel::get -> ".$id);
        try{
            $query = $this->prepare("SELECT * FROM confiteria WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->setId($row["id"]);
            $this->setNombre($row["nombre"]);
            $this->setDescripcion($row["descripcion"]);
            $this->setRutaImagen($row["rutaImagen"]);
            $query = $this->prepare("SELECT * FROM tipoconfiteria WHERE idTipoConfiteria = :ID");
            $query->execute(["ID"=>$id]);
            while($row1 = $query->fetch(PDO::FETCH_ASSOC)){
                if($row1["tamano"] == null){
                    $this->setPrecio("unico",$row1["precio"]);
                }else{
                    $this->setPrecio($row1["tamano"],$row1["precio"]);
                }
            }
            return $this;
        }catch(PDOException $e){
            error_log("confiteriaModel::get->PDOException ".$e);    
        }
    }

    public function delete($id){

    }

    public function update(){

    }

    public function from($array){
        $this->id = $array["id"];
        $this->nombre = $array["nombre"];
        $this->descripcion = $array["descripcion"];
        $this->rutaImagen = $array["rutaImagen"];
        $this->precios = $array["precios"];
    }



    public function setId($valor){$this->id = $valor;}
    public function setNombre($valor){$this->nombre = $valor;}
    public function setDescripcion($valor){$this->descripcion = $valor;}
    public function setPrecio($tipo,$precio){$this->precios[$tipo]=$precio;}
    public function setRutaImagen($valor){$this->rutaImagen = $valor;}

    public function getId(){return $this->id;}
    public function getNombre(){return $this->nombre;}
    public function getDescripcion(){return $this->descripcion;}
    public function getPrecios(){return $this->precios;}
    public function getRutaImagen(){return $this->rutaImagen;}

}


?>