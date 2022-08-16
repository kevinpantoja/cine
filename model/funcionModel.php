<?php 

class FuncionModel extends Model implements IModel{
    private $id;
    private $id_pelicula;
    private $fecha;
    private $minutos_inicio;
    private $minutos_final;
    private $formatos_sala;
    private $estado_pelicula;
    private $id_sala;

    public function __construct()
    {
        parent::__construct();
        $this->id = "";   
        $this->id_pelicula = "";
        $this->fecha = null;
        $this->minutos_inicio = 0;
        $this->minutos_final = 0;
        $this->formatos_sala = "";
        $this->estado_pelicula = "";
        $this->id_sala = "";
    }

    public function save(){
        try{
            $query = $this->prepare("INSERT INTO FUNCION(ID,ID_PELICULA,FECHA,MINUTOS_INICIO,MINUTOS_FINAL,FORMATOS_SALA,ESTADO_PELICULA,ID_SALA) 
            VALUES(:ID,:ID_PELICULA,:FECHA,:MINUTOS_INICIO,:MINUTOS_FINAL,:FORMATOS_SALA,:ESTADO_PELICULA,:ID_SALA)");
            $query->execute([
                "ID"=>$this->id,
                "ID_PELICULA"=>$this->id_pelicula,
                "FECHA"=>$this->fecha,
                "MINUTOS_INICIO"=>$this->minutos_inicio,
                "MINUTOS_FINAL"=>$this->minutos_final,
                "FORMATOS_SALA"=>$this->formatos_sala,
                "ESTADO_PELICULA"=>$this->estado_pelicula,
                "ID_SALA"=>$this->ID_SALa,
            ]);
            return true;
        }catch(PDOException $e){
            error_log("FUNCIONMODEL::save->PDOException ".$e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM FUNCION");
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new FuncionModel();
                $item->setId($row["id"]);
                $item->setId_pelicula($row["id_pelicula"]);
                $item->setFecha($row["fecha"]);
                $item->setMinutos_final($row["minutos_final"]);
                $item->setMinutos_inicio($row["minutos_inicio"]);
                $item->setFormatos_sala($row["formatos_sala"]);
                $item->setEstado_pelicula($row["estado_pelicula"]);
                $item->setId_sala($row["id_sala"]);
                array_push($items,$item);
            }
            return $items;
        }catch(PDOException $e){
            error_log("FUNCIONModel::getAll->PDOException ".$e);
            return null;
        }
    }

    public function getAllxFuncion($id){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM FUNCION WHERE id_pelicula = '$id'");
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new FuncionModel();
                $item->setId($row["id"]);
                $item->setId_pelicula($row["id_pelicula"]);
                $item->setFecha($row["fecha"]);
                $item->setMinutos_final($row["minutos_final"]);
                $item->setMinutos_inicio($row["minutos_inicio"]);
                $item->setFormatos_sala($row["formato_sala"]);
                $item->setEstado_pelicula($row["estado_pelicula"]);
                $item->setId_sala($row["id_sala"]);
                array_push($items,$item);
            }
            return $items;
        }catch(PDOException $e){
            error_log("FUNCIONModel::getAll->PDOException ".$e);
            return null;
        }
    }

    public function getAllxFuncionFecha($id){
        $items = [];
        try{
            $query = $this->query("SELECT fecha FROM funcion WHERE id_pelicula = '$id' GROUP BY fecha");
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                array_push($items,$row["fecha"]);
            }
            return $items;
        }catch(PDOException $e){
            error_log("FUNCIONModel::getAll->PDOException ".$e);
            return null;
        }
    }



    public function getAll_pelicula($id_pelicula){
        $items = [];
        try{
            $query = $this->prepare("SELECT * FROM FUNCION WHERE ID_PELICULA = :ID_PELICULA");
            $query->execute(["ID_PELICULA"=>$id_pelicula]);
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new FuncionModel();
                $item->setId($row["id"]);
                $item->setId_pelicula($row["id_pelicula"]);
                $item->setFecha($row["fecha"]);
                $item->setMinutos_final($row["minutos_final"]);
                $item->setMinutos_inicio($row["minutos_inicio"]);
                $item->setFormatos_sala($row["formatos_sala"]);
                $item->setEstado_pelicula($row["estado_pelicula"]);
                $item->setId_sala($row["id_sala"]);
                array_push($items,$item);
            }
            return $items;
        }catch(PDOException $e){
            error_log("FUNCIONModel::getAll_pelicula->PDOException ".$e);
            return null;
        }
    }

    public function getAll_sala($id_sala){
        $items = [];
        try{
            $query = $this->prepare("SELECT * FROM FUNCION WHERE ID_SALA = :ID_SALA");
            $query->execute(["ID_SALA"=>$id_sala]);
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new FuncionModel();
                $item->setId($row["id"]);
                $item->setId_pelicula($row["id_pelicula"]);
                $item->setFecha($row["fecha"]);
                $item->setMinutos_final($row["minutos_final"]);
                $item->setMinutos_inicio($row["minutos_inicio"]);
                $item->setFormatos_sala($row["formatos_sala"]);
                $item->setEstado_pelicula($row["estado_pelicula"]);
                $item->setId_sala($row["id_sala"]);
                array_push($items,$item);
            }
            return $items;
        }catch(PDOException $e){
            error_log("FUNCIONModel::getAll_sala->PDOException ".$e);
            return null;
        }
    }

    public function get($id){
        error_log("FUNCIONModel::get -> ".$id);
        try{
            $query = $this->prepare("SELECT * FROM FUNCION WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->setId($row["id"]);
            $this->setId_pelicula($row["id_pelicula"]);
            $this->setFecha($row["fecha"]);
            $this->setMinutos_final($row["minutos_final"]);
            $this->setMinutos_inicio($row["minutos_inicio"]);
            $this->setFormatos_sala($row["formatos_sala"]);
            $this->setEstado_pelicula($row["estado_pelicula"]);
            $this->setId_sala($row["id_sala"]);
            return $this;
        }catch(PDOException $e){
            error_log("FUNCIONMODEL::get->PDOException ".$e);    
        }
    }

    public function update(){
        error_log("FUNCIONModel::update  id->".$this->id);
        try{
            $query = $this->prepare("UPDATE FUNCION SET 
            ID_PELICULA = :ID_PELICULA, FECHA = :FECHA, MINUTOS_INICIO = :MINUTOS_INICIO, MINUTOS_FINAL = :MINUTOS_FINAL, FORMATOS_SALA = :FORMATOS_SALA, ESTADO_PELICULA = :ESTADO_PELICULA, ID_SALA = :ID_SALA WHERE ID = :ID");
            $query->execute([
                "ID"=>$this->id,
                "ID_PELICULA"=>$this->id_pelicula,
                "FECHA"=>$this->fecha,
                "MINUTOS_INICIO"=>$this->minutos_inicio,
                "MINUTOS_FINAL"=>$this->minutos_final,
                "FORMATOS_SALA"=>$this->formatos_sala,
                "ESTADO_PELICULA"=>$this->estado_pelicula,
                "ID_SALA"=>$this->ID_SALa,
            ]);
            return true;
        }catch(PDOException $e){
            error_log("FUNCIONMODEL::update->PDOException ".$e);
            return false;
        }
    }

    public function delete($id){
        try{
            $query = $this->prepare("DELETE FROM FUNCION WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            return true;
        }catch(PDOException $e){
            error_log("FUNCIONMODEL::delete->PDOException ".$e);
            return false;
        }
    }

    public function from($array){
        $this->id = $array["id"];
        $this->id_pelicula = $array["id_pelicula"];
        $this->fecha = $array["fecha"];
        $this->minutos_inicio = $array["minutos_inicio"];
        $this->minutos_final = $array["minutos_final"];
        $this->formatos_sala = $array["formatos_sala"];
        $this->estado_pelicula = $array["estado_pelicula"];
        $this->id_sala = $array["id_sala"];
    }

    public function setId($valor){$this->id = $valor;}
    public function setId_pelicula($valor){$this->id_pelicula = $valor;}
    public function setFecha($valor){$this->fecha = $valor;}
    public function setMinutos_inicio($valor){$this->minutos_inicio = $valor;}
    public function setMinutos_final($valor){$this->minutos_final = $valor;}
    public function setFormatos_sala($valor){$this->formatos_sala = $valor;}
    public function setEstado_pelicula($valor){$this->estado_pelicula = $valor;}
    public function setId_sala($valor){$this->id_sala = $valor;}

    public function getId(){return $this->id;}
    public function getId_pelicula(){return $this->id_pelicula;}
    public function getFecha(){return $this->fecha;}
    public function getMinutos_inicio(){return $this->minutos_inicio;}
    public function getMinutos_final(){return $this->minutos_final;}
    public function getFormatos_sala(){return $this->formatos_sala;}
    public function getEstado_pelicula(){return $this->estado_pelicula;}
    public function getId_sala(){return $this->id_sala;}
}


?>