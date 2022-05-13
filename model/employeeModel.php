<?php 

class EmployeeModel extends Model implements IModel{

    private $id;
    private $nombres;
    private $apellido_p;
    private $apellido_m;
    private $fecha_nacimineto;
    private $direccion;
    private $celular;
    private $salario;

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
        $this->salario = 0.0;   
    }

    public function save(){
        try{
            $query = $this->prepare("INSERT INTO VENDEDOR(ID,NOMBRES,APELLIDO_P,APELLIDO_M,FECHA_NACIMIENTO,DIRECCION,CELULAR,SALARIO) 
            VALUES(:ID,:NOMBRES,:AP_P,:AP_M,:NAC,:DIRECCION,:CELULAR,:SALARIO)");
            $query->execute([
                "ID"=>$this->id,
                "NOMBRES"=>$this->nombres,
                "AP_P"=>$this->apellido_p,
                "AP_M"=>$this->apellido_m,
                "NAC"=>$this->fecha_nacimineto != ""?$this->fecha_nacimineto:null,
                "DIRECCION"=>$this->direccion,
                "CELULAR"=>$this->celular != ""?$this->celular:null,
                "SALARIO"=>$this->salario
            ]);
            return true;
        }catch(PDOException $e){
            error_log("EMPLOYEEMODEL::save->PDOException ".$e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM VENDEDOR");
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new EmployeeModel();
                $item->setId($row["id"]);
                $item->setNombres($row["nombres"]);
                $item->setApellido_m($row["apellido_m"]);
                $item->setApellido_p($row["apellido_p"]);
                $item->setDireccion($row["direccion"]);
                $item->setCelular($row["celular"]);
                $item->setSalario($row["salario"]);
                $item->setFechaNacimiento($row["fecha_nacimiento"]);
                array_push($items,$item);
            }
            return $items;
        }catch(PDOException $e){
            error_log("AdminModel::getAll->PDOException ".$e);
            return null;
        }
    }

    public function get($id){
        error_log("employeeModel::get -> ".$id);
        try{
            $query = $this->prepare("SELECT * FROM VENDEDOR WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->setId($row["id"]);
            $this->setDireccion($row["direccion"]);
            $this->setCelular($row["celular"]);
            $this->setSalario($row["salario"]);
            $this->setFechaNacimiento($row["fecha_nacimiento"]);
            $this->setNombres($row["nombres"]);
            $this->setApellido_p($row["apellido_p"]);
            $this->setApellido_m($row["apellido_m"]);

            return $this;

        }catch(PDOException $e){
            error_log("EMPLOYEEMODEL::get->PDOException ".$e);    
        }
    }

    public function delete($id){
        try{
            $query = $this->prepare("DELETE FROM VENDEDOR WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            return true;
        }catch(PDOException $e){
            error_log("EMPLOYEEMODEL::delete->PDOException ".$e);
            return false;
        }
    }

    public function update(){
        error_log("EMPLOYEEModel::update  id->".$this->id);
        try{
            $query = $this->prepare("UPDATE VENDEDOR SET NOMBRES = :NOMBRES, APELLIDO_P = :AP_P, APELLIDO_M = :AP_M, FECHA_NACIMIENTO = :NAC, DIRECCION = :DIRECCION,CELULAR = :CELULAR,SALARIO = :SALARIO WHERE ID = :ID");
            $query->execute([
                "ID"=>$this->id,
                "NOMBRES"=>$this->nombres,
                "AP_P"=>$this->apellido_p,
                "AP_M"=>$this->apellido_m,
                "NAC"=>$this->fecha_nacimineto != ""?$this->fecha_nacimineto:null,
                "DIRECCION"=>$this->direccion,
                "CELULAR"=>$this->celular != ""?$this->celular:null,
                "SALARIO"=>$this->salario
            ]);
            return true;
        }catch(PDOException $e){
            error_log("EMPLOYEEMODEL::update->PDOException ".$e);
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
        $this->salario = $array["salario"];
        $this->celular = $array["celular"];
    }

    public function exists($id){
        try{
            $query = $this->prepare("SELECT ID FROM VENDEDOR WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            if($query->rowCount()>0){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            error_log("EMPLOYEEMODEL::exists->PDOException ".$e);
            return false;
        }
    }

    /*setter and getter*/
    public function setNombres($valor){$this->nombres = $valor;}
    public function setApellido_m($valor){$this->apellido_m = $valor;}
    public function setApellido_p($valor){$this->apellido_p = $valor;}
    public function setFechaNacimiento($valor){$this->fecha_nacimineto = $valor;}
    public function setDireccion($valor){$this->direccion = $valor;}
    public function setSalario($valor){$this->salario = $valor;}
    public function setCelular($valor){$this->celular = $valor;}
    public function setId($valor){$this->id = $valor;}


    public function getNombres(){return $this->nombres;}
    public function getApellido_p(){return $this->apellido_p;}
    public function getApellido_m(){return $this->apellido_m;}
    public function getDireccion(){return $this->direccion;}
    public function getSalario(){return $this->salario;}
    public function getCelular(){return $this->celular;}
    public function getId(){return $this->id;}
    public function getFechaNacimiento(){return $this->fecha_nacimineto;}
}

?>