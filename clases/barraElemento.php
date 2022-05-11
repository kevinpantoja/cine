<?php 
class BarraElemento{
    public $titulo;
    public $link;
    public function __construct($titulo,$link){
        $this->titulo = $titulo;
        $this->link = $link;
    }
}

?>