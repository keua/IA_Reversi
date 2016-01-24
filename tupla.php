<?php
class tupla {
  
   private $valor;
   private $posX;
   private $poxY;
   private $prioridad;
    
    public function __construct($valor,$posX,$posY,$prioridad) {
      
      $this->valor = $valor;
      $this->posX = $posX;
      $this->posY = $posY;
      $this->prioridad = $prioridad;
    }
    public function setValor($valor){
      $this->valor = $valor;
    }
    public function getValor(){
      return $this->valor;
    }
    public function setPosX($posX){
      $this->posX = $posX;
    }
    public function getPosX(){
      return $this->posX;
    }
    public function setPosY($posY){
      $this->posY = $posY;
    }
    public function getposY(){
      return $this->posY;
    }
    public function setPrioridad($prioridad){
      $this->prioridad = $prioridad;
    }
    public function getPrioridad(){
      return $this->prioridad;
    }
}
?>