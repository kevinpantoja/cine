<?php 

include_once "model/cuentaModel.php";
include_once "model/adminModel.php";
include_once "model/employeeModel.php";
include_once "model/customerModel.php";

class LoginModel extends Model{

    function __construct()
    {
        parent::__construct();
    }

    function login($username,$password){
        try{
            $query = $this->prepare("SELECT * FROM CUENTA WHERE USERNAME = :USERNAME");
            $query->execute(["USERNAME"=>$username]);

            if($query->rowCount() == 1){
                $item = $query->fetch(PDO::FETCH_ASSOC);


                $cuenta = new CuentaModel();
                $cuenta->from($item);

                if(password_verify($password,$cuenta->getPassword())){
                    error_log("LoginModel::login -> success con rol:".$cuenta->getRole()."  usuario->".$cuenta->getUsuario());
                    $user = "";
                    switch($cuenta->getRole()){
                        case "1":
                            $user = new AdminModel();
                            $user->get($cuenta->getUsuario());
                            break;
                        case "2":
                            $user = new CustomerModel();
                            $user->get($cuenta->getUsuario());
                            break;
                        case "3":
                            $user = new EmployeeModel();
                            $user->get($cuenta->getUsuario());
                            break;
                    }
                    error_log("LoginModel::login -> user:".$user->getId());
                    return array($cuenta,$user);
                }else{
                    error_log("LoginModel::login -> PASSWORD NO ES IGUAL");
                    return NULL;
                }
            }

        }catch(PDOException $e){
            error_log("LoginModel::login->exception ".$e);
            return NULL;
        }
    }
}

?>