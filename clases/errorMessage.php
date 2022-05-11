<?php 

class ErrorMessage{
    //ERROR_CONTROLLER_METHOD_ACTION
    const ERROR_ADMIN_NEWCATEGORY_EXISTS = "37d4736de391e549a43cf26494fb23db";
    const ERROR_SIGNUP_NEWUSER = "3zd47vfde3956549644cf26494fb23db";
    const ERROR_SIGNUP_NEWUSER_EMPTY = "1234567de3956549644cf26494fbMB5S";
    const ERROR_SIGNUP_NEWUSER_EXISTS = "V8bn567de3913rT9644cf26494fbMB5S";
    const ERROR_LOGIN_AUTHENTICATE_EMPTY = "V8bn567dm2Vt3rTAB4T2f26494fbMB5S";
    const ERROR_LOGIN_AUTHENTICATE_DATA = "V8bn567dm2Vt3rTAB4T2f26494fb4321";
    const ERROR_LOGIN_AUTHENTICATE = "1234567dm2Vt3rTAB4T2f26494fb4321";
    //nueva categoria existe

    private $errorList = [];

    public function __construct()
    {
        $this->errorList = [
            ErrorMessage::ERROR_ADMIN_NEWCATEGORY_EXISTS => "nueva categoria existe",
            ErrorMessage::ERROR_SIGNUP_NEWUSER => "Hubo un error al procesar los datos",
            ErrorMessage::ERROR_SIGNUP_NEWUSER_EMPTY => "Alguno de los campos está vacio",
            ErrorMessage::ERROR_SIGNUP_NEWUSER_EXISTS => "El usuario ya existe",
            ErrorMessage::ERROR_LOGIN_AUTHENTICATE_EMPTY => "Alguno de los campos está vacio",
            ErrorMessage::ERROR_LOGIN_AUTHENTICATE_DATA => "Contraseña o cuenta incorrecta",
            ErrorMessage::ERROR_LOGIN_AUTHENTICATE => "Error en el procesamiento de datos",
        ];
    }

    public function get($hash){
        return $this->errorList[$hash];
    }

    public function existsKey($key){
        if(array_key_exists($key,$this->errorList)){
            return true;
        }else{
            return false;
        }
    }
}

?>