<?php 

class CuentaModel extends Model{
    private $username;
    private $password;
    private $role;
    private $usuario;


    function __construct()
    {
        parent::__construct();
        $this->username = "";
        $this->password = "";
        $this->role = "";  
        $this->usuario = "";
    }

    private function getHashedPassword($password){
        return password_hash($password,PASSWORD_DEFAULT,["cost"=>10]);
    }

    function save(){
        try{
            $query = $this->prepare("INSERT INTO CUENTA (USERNAME,PASSWORD,ROL,USUARIO) VALUES ( :USERNAME, :PASSWORD, :ROL, :USUARIO)");
            $query->execute([
                "USERNAME"=>$this->username,
                "PASSWORD"=>$this->password,
                "ROL"=>$this->role,
                "USUARIO"=>$this->usuario
            ]);
            return true;
        }catch(PDOException $e){
            error_log("CUENTAMODEL::save->PDOException ".$e);
            return false;
        }
    }

    function get($username){
        error_log("cuentaModel::get -> ".$username);
        try{
            $query = $this->prepare("SELECT * FROM CUENTA WHERE USERNAME = :USERNAME");
            $query->execute(["USERNAME"=>$username]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->setUsername($row["username"]);
            $this->setPassword($row["password"]);
            $this->setRole($row["rol"]);
            $this->setUsuario($row["usuario"]);
            return $this;

        }catch(PDOException $e){
            error_log("CUENTAMODEL::get->PDOException ".$e);    
        }
    }

    function getUsernameByUsuario($usuario){
        try{
            $query = $this->prepare("SELECT username FROM CUENTA WHERE USUARIO = :USUARIO");
            $query->execute(["USUARIO"=>$usuario]);
            if($query->rowCount()>0){
                $row = $query->fetch(PDO::FETCH_ASSOC);
                error_log("CUENTAMODEL::getUsernameByUsuario->  username:".$row["username"]);
                return $row["username"];
            }else{
                error_log("CUENTAMODEL::getUsernameByUsuario-> return null");
                return null;
            }
        }catch(PDOException $e){
            error_log("CUENTAMODEL::getUsernameByUsuario->PDOException ".$e);
            return null;
        }
    }

    function getRolByUsername($username){
        try{
            $query = $this->prepare("SELECT rol FROM CUENTA WHERE USERNAME = :USERNAME");
            $row = $query->execute(["USERNAME"=>$username]);
            if($query->rowCount()>0){
                switch($row["rol"]){
                    case "1":
                        return "admin";
                        break;
                    case "2":
                        return "user";
                        break;
                    case "3":
                        return "employee";
                        break;
                }
            }else{
                return null;
            }
        }catch(PDOException $e){
            error_log("CUENTAMODEL::getRoleByUsername->PDOException ".$e);
            return null;
        }
    }

    function getRolByUsuario($usuario){
        try{
            $query = $this->prepare("SELECT rol FROM CUENTA WHERE USUARIO = :USUARIO");
            $row = $query->execute(["USUARIO"=>$usuario]);
            if($query->rowCount()>0){
                switch($row["rol"]){
                    case "1":
                        return "admin";
                        break;
                    case "2":
                        return "user";
                        break;
                    case "3":
                        return "employee";
                        break;
                }
            }else{
                return null;
            }
        }catch(PDOException $e){
            error_log("CUENTAMODEL::getRoleByUsuario->PDOException ".$e);
            return null;
        }
    }

    public function delete($id){
        try{
            $query = $this->prepare("DELETE FROM CUENTA WHERE USERNAME = :ID");
            $query->execute(["ID"=>$id]);
            return true;
        }catch(PDOException $e){
            error_log("CUENTAMODEL::delete->PDOException ".$e);
            return false;
        }
    }

    public function update(){
        error_log("CUENTAModel::update  username->".$this->username);
        try{
            $query = $this->prepare("UPDATE CUENTA SET PASSWORD = :PASSWORD, ROL = :ROL, USUARIO = :USUARIO WHERE USERNAME = :USERNAME");
            $query->execute([
                "USERNAME"=>$this->username,
                "PASSWORD"=>$this->password,
                "ROL"=>$this->role,
                "USUARIO"=>$this->usuario != ""?$this->usuario:null
            ]);
            return true;
        }catch(PDOException $e){
            error_log("CUENTAMODEL::update->PDOException ".$e);
            return false;
        }
    }

    public function from($array){
        $this->username = $array["username"];
        $this->password = $array["password"];
        $this->role = $array["rol"];
        $this->usuario = $array["usuario"];
    }

    public function exists($username){
        try{
            $query = $this->prepare("SELECT USERNAME FROM CUENTA WHERE USERNAME = :USERNAME");
            $query->execute(["USERNAME"=>$username]);
            if($query->rowCount()>0){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            error_log("CUENTAMODEL::exists->PDOException ".$e);
            return false;
        }
    }

    public function comparePassword($password,$username){
        try{
            $user = $this->get($username);
            return password_verify($password,$user->getPassword());
        }catch(PDOException $e){
            error_log("CUENTAMODEL::comparePassword->PDOException ".$e);
            return false;
        }
    }

    public function setUsername($valor){$this->username = $valor;}
    public function setPassword($password){
        $this->password = $this->getHashedPassword($password);
    }
    public function setRole($valor){$this->role = $valor;}
    public function setUsuario($valor){$this->usuario = $valor;}
    public function getUsername(){return $this->username;}
    public function getPassword(){return $this->password;}
    public function getRole(){return $this->role;}
    public function getUsuario(){return $this->usuario;}    
}

?>