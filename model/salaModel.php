<?php 

class SalaModel extends Model implements IModel{
    private $id;
    private $capacidad;
    private $num_filas;
    private $num_columnas;

    public function __construct()
    {
        parent::__construct();
        $this->id = "";   
        $this->capacidad = 0;
        $this->num_filas = 0;
        $this->num_columnas = 0;
    }

    public function save(){
        try{
            $query = $this->prepare("INSERT INTO SALA(ID,CAPACIDAD,NUM_FILAS,NUM_COLUMNAS) 
            VALUES(:ID,:CAPACIDAD,:NUM_FILAS,:NUM_COLUMNAS)");
            $query->execute([
                "ID"=>$this->id,
                "CAPACIDAD"=>$this->capacidad,
                "NUM_FILAS"=>$this->num_filas,
                "NUM_COLUMNAS"=>$this->num_columnas,
            ]);
            return true;
        }catch(PDOException $e){
            error_log("SALAMODEL::save->PDOException ".$e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM SALA");
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new SalaModel();
                $item->setId($row["id"]);
                $item->setCapacidad($row["capacidad"]);
                $item->setNum_filas($row["num_filas"]);
                $item->setNum_columnas($row["num_columnas"]);
                array_push($items,$item);
            }
            return $items;
        }catch(PDOException $e){
            error_log("SALAModel::getAll->PDOException ".$e);
            return null;
        }
    }

    public function get($id){
        error_log("SALAModel::get -> ".$id);
        try{
            $query = $this->prepare("SELECT * FROM SALA WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->setId($row["id"]);
            $this->setCapacidad($row["capacidad"]);
            $this->setNum_filas($row["num_filas"]);
            $this->setNum_columnas($row["num_columnas"]);
            return $this;

        }catch(PDOException $e){
            error_log("SALAMODEL::get->PDOException ".$e);    
        }
    }

    public function delete($id){
        try{
            $query = $this->prepare("DELETE FROM SALA WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            return true;
        }catch(PDOException $e){
            error_log("SALAMODEL::delete->PDOException ".$e);
            return false;
        }
    }

    public function update(){
        error_log("SALAModel::update  id->".$this->id);
        try{
            $query = $this->prepare("UPDATE SALA SET CAPACIDAD = :CAPACIDAD, NUM_FILAS = :NUM_FILAS, NUM_COLUMNAS = :NUM_COLUMNAS WHERE ID = :ID");
            $query->execute([
                "ID"=>$this->id,
                "CAPACIDAD"=>$this->capacidad,
                "NUM_FILAS"=>$this->num_filas,
                "NUM_COLUMNAS"=>$this->num_columnas,
            ]);
            return true;
        }catch(PDOException $e){
            error_log("SALAMODEL::update->PDOException ".$e);
            return false;
        }
    }

    public function from($array){
        $this->id = $array["id"];
        $this->capacidad = $array["capacidad"];
        $this->num_columnas = $array["num_columnas"];
        $this->num_filas = $array["num_filas"];
    }

    public function setId($valor){$this->id = $valor;}
    public function setCapacidad($valor){$this->capacidad = $valor;}
    public function setNum_filas($valor){$this->num_filas = $valor;}
    public function setNum_columnas($valor){$this->num_columnas = $valor;}

    public function getId(){return $this->id;}
    public function getCapacidad(){return $this->capacidad;}
    public function getNum_filas(){return $this->num_filas;}
    public function getNum_columnas(){return $this->num_columnas;}

}





?>