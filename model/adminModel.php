<?php 

class AdminModel extends Model implements IModel{

    private $id;
    private $nombres;
    private $apellido_p;
    private $apellido_m;
    private $fecha_nacimineto;
    private $direccion;
    private $celular;
    private $correo;

    public function __construct()
    {
        parent::__construct();
        $this->id = "";   
        $this->nombres = "";   
        $this->apellido_m = "";   
        $this->apellido_p = "";   
        $this->fecha_nacimineto = "";   
        $this->direccion = "";   
        $this->celular = "";   
        $this->correo = "";   
    }

    public function save(){
        try{
            $query = $this->prepare("INSERT INTO ADMIN(ID,NOMBRES,APELLIDO_P,APELLIDO_M,FECHA_NACIMIENTO,DIRECCION,CELULAR,SALARIO) 
            VALUES(:ID,:NOMBRES,:AP_P,:AP_M,:NAC,:DIRECCION,:CELULAR,:CORREO)");
            $query->execute([
                "ID"=>$this->id,
                "NOMBRES"=>$this->nombres,
                "AP_P"=>$this->apellido_p,
                "AP_M"=>$this->apellido_m,
                "NAC"=>$this->fecha_nacimineto != ""?$this->fecha_nacimineto:null,
                "DIRECCION"=>$this->direccion,
                "CELULAR"=>$this->celular != ""?$this->celular:null,
                "CORREO"=>$this->correo
            ]);
            return true;
        }catch(PDOException $e){
            error_log("ADMINMODEL::save->PDOException ".$e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM ADMIN");
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new AdminModel();
                $item->setId($row["id"]);
                $item->setNombres($row["nombres"]);
                $item->setApellido_m($row["apellido_m"]);
                $item->setApellido_p($row["apellido_p"]);
                $item->setDireccion($row["direccion"]);
                $item->setCelular($row["celular"]);
                $item->setCorreo($row["correo"]);
                $item->setFechaNacimiento($row["fecha_nacimiento"]);
            }
        }catch(PDOException $e){
            error_log("AdminModel::getAll->PDOException ".$e);
            
        }
    }

    public function get($id){
        error_log("AdminModel::get -> ".$id);
        try{
            $query = $this->prepare("SELECT * FROM ADMIN WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->setId($row["id"]);
            $this->setDireccion($row["direccion"]);
            $this->setCelular($row["celular"]);
            $this->setCorreo($row["correo"]);
            $this->setFechaNacimiento($row["fecha_nacimiento"]);
            $this->setNombres($row["nombres"]);
            $this->setApellido_p($row["apellido_p"]);
            $this->setApellido_m($row["apellido_m"]);

            return $this;

        }catch(PDOException $e){
            error_log("AdminModel::get->PDOException ".$e);    
        }
    }

    public function delete($id){
        try{
            $query = $this->prepare("DELETE FROM ADMIN WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            return true;
        }catch(PDOException $e){
            error_log("AdminModel::delete->PDOException ".$e);
            return false;
        }
    }

    public function update(){
        error_log("AdminModel::update  id->".$this->id);
        try{
            $query = $this->prepare("UPDATE ADMIN SET NOMBRES = :NOMBRES, APELLIDO_P = :AP_P, APELLIDO_M = :AP_M, FECHA_NACIMIENTO = :NAC, DIRECCION = :DIRECCION,CELULAR = :CELULAR,CORREO = :CORREO WHERE ID = :ID");
            $query->execute([
                "ID"=>$this->id,
                "NOMBRES"=>$this->nombres,
                "AP_P"=>$this->apellido_p,
                "AP_M"=>$this->apellido_m,
                "NAC"=>$this->fecha_nacimineto != ""?$this->fecha_nacimineto:null,
                "DIRECCION"=>$this->direccion,
                "CELULAR"=>$this->celular != ""?$this->celular:null,
                "CORREO"=>$this->correo
            ]);
            return true;
        }catch(PDOException $e){
            error_log("AdminModel::update->PDOException ".$e);
            return false;
        }
    }

    public function from($array){
        $this->nombres = $array["nombres"];
        $this->apellido_m = $array["apellido_m"];
        $this->apellido_p = $array["apellido_p"];
        $this->fecha_nacimineto = $array["fecha_nacimiento"];
        $this->id = $array["id"];
        $this->direccion = $array["direccion"];
        $this->salario = $array["correo"];
        $this->celular = $array["celular"];
    }

    public function exists($id){
        try{
            $query = $this->prepare("SELECT ID FROM ADMIN WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            if($query->rowCount()>0){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            error_log("AdminModel::exists->PDOException ".$e);
            return false;
        }
    }

    /*setter and getter*/
    public function setNombres($valor){$this->nombres = $valor;}
    public function setApellido_m($valor){$this->apellido_m = $valor;}
    public function setApellido_p($valor){$this->apellido_p = $valor;}
    public function setFechaNacimiento($valor){$this->fecha_nacimineto = $valor;}
    public function setDireccion($valor){$this->direccion = $valor;}
    public function setCorreo($valor){$this->correo = $valor;}
    public function setCelular($valor){$this->celular = $valor;}
    public function setId($valor){$this->id = $valor;}


    public function getNombres(){return $this->nombres;}
    public function getApellido_p(){return $this->apellido_p;}
    public function getApellido_m(){return $this->apellido_m;}
    public function getDireccion(){return $this->direccion;}
    public function getCorreo(){return $this->correo;}
    public function getCelular(){return $this->celular;}
    public function getId(){return $this->id;}
    public function getFechaNacimiento(){return $this->fecha_nacimineto;}
}

?>