<?php 

class SuccessMessage{
    //ERROR_CONTROLLER_METHOD_ACTION
    const PRUEBA = "ee3d5c6087021b9de828b90577764a92";
    const SUCCESS_SIGNUP_NEWUSER = "3zd47vfde3956549644cf26491234567";
    const SUCCESS_UPDATE_USER = "3zd47vfde3956549644cf26491234765";
    //nueva categoria existe

    private $successList = [];

    public function __construct()
    {
        $this->successList = [
            SuccessMessage::PRUEBA => "este es un mensaje de exito",
            SuccessMessage::SUCCESS_SIGNUP_NEWUSER => "Usuario crado con éxito",
            SuccessMessage::SUCCESS_UPDATE_USER => "Datos actualizados con éxito"
        ];
    }

    public function get($hash){
        return $this->successList[$hash];
    }

    public function existsKey($key){
        if(array_key_exists($key,$this->successList)){
            return true;
        }else{
            return false;
        }
    }
}




?>