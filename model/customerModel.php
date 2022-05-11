<?php 

class CustomerModel extends Model implements IModel{

    private $id;
    private $nombres;
    private $apellido_p;
    private $apellido_m;
    private $fecha_nacimineto;
    private $correo;

    public function __construct()
    {
        parent::__construct();
        $this->id = "";   
        $this->nombres = "";   
        $this->apellido_m = "";   
        $this->apellido_p = "";   
        $this->fecha_nacimineto = "";   
        $this->correo = "";   
    }

    public function save(){
        try{
            $query = $this->prepare("INSERT INTO CLIENTE(ID,NOMBRES,APELLIDO_P,APELLIDO_M,FECHA_NACIMIENTO,CORREO) 
            VALUES(:ID,:NOMBRES,:AP_P,:AP_M,:NAC,:CORREO)");
            $query->execute([
                "ID"=>$this->id,
                "NOMBRES"=>$this->nombres,
                "AP_P"=>$this->apellido_p,
                "AP_M"=>$this->apellido_m,
                "NAC"=>$this->fecha_nacimineto != ""?$this->fecha_nacimineto:null,
                "CORREO"=>$this->correo!= ""?$this->correo:null,
            ]);
            return true;
        }catch(PDOException $e){
            error_log("CUSTOMERMODEL::save->PDOException ".$e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM CLIENTE");
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new CustomerModel();
                $item->setId($row["id"]);
                $item->setNombres($row["nombres"]);
                $item->setApellido_m($row["apellido_m"]);
                $item->setApellido_p($row["apellido_p"]);
                $item->setCorreo($row["correo"]);
                $item->setFechaNacimiento($row["fecha_nacimiento"]);
            }
        }catch(PDOException $e){
            error_log("CUSTOMERMODEL::getAll->PDOException ".$e);
            
        }
    }

    public function get($id){
        error_log("customerModel::get -> ".$id);
        try{
            $query = $this->prepare("SELECT * FROM CLIENTE WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->setId($row["id"]);
            $this->setCorreo($row["correo"]);
            $this->setFechaNacimiento($row["fecha_nacimiento"]);
            $this->setNombres($row["nombres"]);
            $this->setApellido_p($row["apellido_p"]);
            $this->setApellido_m($row["apellido_m"]);

            return $this;

        }catch(PDOException $e){
            error_log("CUSTOMERMODEL::get->PDOException ".$e);    
        }
    }

    public function delete($id){
        try{
            $query = $this->prepare("DELETE FROM CLIENTE WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            return true;
        }catch(PDOException $e){
            error_log("CUSTOMERMODEL::delete->PDOException ".$e);
            return false;
        }
    }

    public function update(){
        error_log("CUSTOMERModel::update  id->".$this->id);
        try{
            $query = $this->prepare("UPDATE CLIENTE SET NOMBRES = :NOMBRES, APELLIDO_P = :AP_P, APELLIDO_M = :AP_M, FECHA_NACIMIENTO = :NAC, CORREO = :CORREO WHERE ID = :ID");
            $query->execute([
                "ID"=>$this->id,
                "NOMBRES"=>$this->nombres,
                "AP_P"=>$this->apellido_p,
                "AP_M"=>$this->apellido_m,
                "NAC"=>$this->fecha_nacimineto != ""?$this->fecha_nacimineto:null,
                "CORREO"=>$this->correo!= ""?$this->correo:null,
            ]);
            return true;
        }catch(PDOException $e){
            error_log("CUSTOMERMODEL::update->PDOException ".$e);
            return false;
        }
    }

    public function from($array){
        $this->nombres = $array["nombres"];
        $this->apellido_m = $array["apellido_m"];
        $this->apellido_p = $array["apellido_p"];
        $this->fecha_nacimineto = $array["fecha_nacimiento"];
        $this->id = $array["id"];
        $this->correo = $array["correo"];
    }

    public function exists($id){
        try{
            $query = $this->prepare("SELECT ID FROM CLIENTE WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            if($query->rowCount()>0){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            error_log("CUSTOMERMODEL::exists->PDOException ".$e);
            return false;
        }
    }

    /*setter and getter*/
    public function setNombres($valor){$this->nombres = $valor;}
    public function setApellido_m($valor){$this->apellido_m = $valor;}
    public function setApellido_p($valor){$this->apellido_p = $valor;}
    public function setFechaNacimiento($valor){$this->fecha_nacimineto = $valor;}
    public function setCorreo($valor){$this->correo = $valor;}
    public function setId($valor){$this->id = $valor;}


    public function getNombres(){return $this->nombres;}
    public function getApellido_p(){return $this->apellido_p;}
    public function getApellido_m(){return $this->apellido_m;}
    public function getCorreo(){return $this->correo;}
    public function getId(){return $this->id;}
    public function getFechaNacimiento(){return $this->fecha_nacimineto;}
}

?>