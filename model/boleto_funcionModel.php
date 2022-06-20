<?php 

class Boleto_funcionModel extends Model{
    private $id;
    private $id_cliente;
    private $fila;
    private $columna;
    private $id_funcion;
    private $precio;
    private $fecha_compra;

    public function __construct()
    {
        parent::__construct();
        $this->id = "";   
        $this->id_cliente = "";   
        $this->fila = 0;   
        $this->columna = 0;   
        $this->id_funcion = "";   
        $this->precio = 0;   
        $this->fecha_compra = null;   
    }

    public function save(){
        try{
            $query = $this->prepare("INSERT INTO BOLETO_FUNCION(ID,ID_CLIENTE,FILA,COLUMNA,ID_FUNCION,PRECIO,FECHA_COMPRA) 
            VALUES(:ID,:ID_CLIENTE,:FILA,:COLUMNA,:ID_FUNCION,:PRECIO,:FECHA_COMPRA)");
            $query->execute([
                "ID"=>$this->id,
                "ID_CLIENTE"=>$this->id_cliente,
                "FILA"=>$this->fila,
                "COLUMNA"=>$this->columna,
                "ID_FUNCION"=>$this->id_funcion,
                "PRECIO"=>$this->precio,
                "FECHA_COMPRA"=>$this->fecha_compra
            ]);
            return true;
        }catch(PDOException $e){
            error_log("BOLETO_FUNCIONMODEL::save->PDOException ".$e);
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query("SELECT * FROM BOLETO_FUNCION");
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new Boleto_funcionModel();
                $item->setId($row["id"]);
                $item->setid_cliente($row["id_cliente"]);
                $item->setfila($row["fila"]);
                $item->setcolumna($row["columna"]);
                $item->setid_funcion($row["id_funcion"]);
                $item->setprecio($row["precio"]);
                $item->setfecha_compra($row["fecha_compra"]);
            }
            return $items;
        }catch(PDOException $e){
            error_log("BOLETO_FUNCIONModel::getAll->PDOException ".$e);
            return null;
        }
    }

    public function getAll_cliente($id_cliente){
        $items = [];
        try{
            $query = $this->prepare("SELECT * FROM BOLETO_FUNCION WHERE ID_CLIENTE = :ID_CLIENTE");
            $query->execute(["ID_CLIENTE"=>$id_cliente]);
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new Boleto_funcionModel();
                $item->setId($row["id"]);
                $item->setid_cliente($row["id_cliente"]);
                $item->setfila($row["fila"]);
                $item->setcolumna($row["columna"]);
                $item->setid_funcion($row["id_funcion"]);
                $item->setprecio($row["precio"]);
                $item->setfecha_compra($row["fecha_compra"]);
            }
            return $items;
        }catch(PDOException $e){
            error_log("BOLETO_FUNCIONModel::getAll_cliente->PDOException ".$e);
            return null;
        }
    }

    public function getAll_cliente_funcion($id_cliente,$id_funcion){
        $items = [];
        try{
            $query = $this->prepare("SELECT * FROM BOLETO_FUNCION WHERE ID_CLIENTE = :ID_CLIENTE AND ID_FUNCION = :ID_FUNCION");
            $query->execute([
                "ID_CLIENTE"=>$id_cliente,
                "ID_FUNCION"=>$id_funcion
            ]);
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new Boleto_funcionModel();
                $item->setId($row["id"]);
                $item->setid_cliente($row["id_cliente"]);
                $item->setfila($row["fila"]);
                $item->setcolumna($row["columna"]);
                $item->setid_funcion($row["id_funcion"]);
                $item->setprecio($row["precio"]);
                $item->setfecha_compra($row["fecha_compra"]);
            }
            return $items;
        }catch(PDOException $e){
            error_log("BOLETO_FUNCIONModel::getAll_cliente_funcion->PDOException ".$e);
            return null;
        }
    }

    public function get($id){
        error_log("BOLETO_FUNCIONModel::get -> ".$id);
        try{
            $query = $this->prepare("SELECT * FROM BOLETO_FUNCION WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->setId($row["id"]);
            $this->setId_cliente($row["id_cliente"]);
            $this->setFila($row["fila"]);
            $this->setColumna($row["columna"]);
            $this->setId_funcion($row["id_funcion"]);
            $this->setPrecio($row["precio"]);
            $this->setFecha_compra($row["fecha_compra"]);
            return $this;
        }catch(PDOException $e){
            error_log("BOLETO_FUNCIONMODEL::get->PDOException ".$e);    
        }
    }

    public function delete($id){
        try{
            $query = $this->prepare("DELETE FROM BOLETO_FUNCION WHERE ID = :ID");
            $query->execute(["ID"=>$id]);
            return true;
        }catch(PDOException $e){
            error_log("BOLETO_FUNCIONMODEL::delete->PDOException ".$e);
            return false;
        }
    }

    public function from($array){
        $this->id = $array["id"];
        $this->id_cliente = $array["id_cliente"];
        $this->id_funcion = $array["id_funcion"];
        $this->fila = $array["fila"];
        $this->columna = $array["columna"];
        $this->fecha_compra = $array["fecha_compra"];
        $this->precio = $array["precio"];
    }


    public function getId(){return $this->id;}
    public function getId_cliente(){return $this->id_cliente;}
    public function getId_funcion(){return $this->id_funcion;}
    public function getFila(){return $this->fila;}
    public function getColumna(){return $this->columna;}
    public function getPrecio(){return $this->precio;}
    public function getFecha_compra(){return $this->fecha_compra;}

    public function setId($valor){$this->id = $valor;}
    public function setId_cliente($valor){$this->id_cliente = $valor;}
    public function setId_funcion($valor){$this->id_funcion = $valor;}
    public function setFila($valor){$this->fila = $valor;}
    public function setColumna($valor){$this->columna = $valor;}
    public function setPrecio($valor){$this->precio = $valor;}
    public function setFecha_compra($valor){$this->fecha_compra = $valor;}    
}

?>