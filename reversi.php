<?php
include 'tupla.php';
class Reversi {
     
    private $matriz;
    private $matrizAuxiliar;
    private $turno;
    private $libres = array();
    private $fichasTurno = array();
    private $fichasRival = array();
    private $posiblesMovimientos = array();
    
    public function __construct() {
         $matriz = array();
         $matrizAuxiliar = [ 
                             [ 120, -20, 20,  5,  5, 20, -20, 120 ],
                             [ -20, -40, -5, -5, -5, -5, -40, -20 ],
                             [  20,  -5, 15,  3,  3, 15,  -5,  20 ],
                             [   5,  -5,  3,  3,  3,  3,  -5,   5 ],
                             [  20,  -5, 15,  3,  3, 15,  -5,  20 ],
                             [   5,  -5,  3,  3,  3,  3,  -5,   5 ],
                             [ -20, -40, -5, -5, -5, -5, -40, -20 ],
                             [ 120, -20, 20,  5,  5, 20, -20, 120 ]
                            ];
    }
    public function setMatriz($matriz) {
         
         $count = 0;
         
          for ($i = 0; $i < 8; $i++) {
               for ($j = 0; $j < 8; $j++) {
                    $tupla = new tupla($matriz[$count],$i,$j,$this->matrizAuxiliar[$i][$j]);
                    $this->matriz[$i][$j] = $tupla;
                    if($tupla->getValor() == 2){
                      array_push($this->libres,$tupla);
                    }else if($tupla->getValor() == (int)$this->turno){
                      array_push($this->fichasTurno,$tupla);
                    }else{
                      array_push($this->fichasRival,$tupla);
                    }
                    $count++;
               }
          }
          
    }
    
    public function getMatriz(){
         
         return $this->matriz;
    }
    
    public function setTurno($turno){
        
        $this->turno = $turno;
        
    }
    
    public function getTurno(){
     
        return $this->turno;
        
    }
    
    public function getLibres() {
        return $this->libres;
    }
    public function getValor($posX,$posY){
      $tmpTupla = $this->matriz[$posX][$posY];  
      if($tmpTupla) return $tmpTupla; else return null;
    }
    public function getFichasTurno(){
      return $this->fichasTurno;   
    }
    public function getFichasRival(){
      return $this->fichasRival;
    }
    public function getPosiblesMovimientos()
    {
      $this->posiblesMovimientos = array();

      for($i = 0; $i < sizeof($this->libres); $i++){
        //-fila "norte"
        for($j = 1; $j < 7; $j++){
          if($this->libres[$i]->getPosX()-$j >= 0 && $this->libres[$i]->getPosX()-$j <= 7){
            $sigCasilla = $this->getValor($this->libres[$i]->getPosX() - $j ,$this->libres[$i]->getPosY());
            if($sigCasilla != null && $sigCasilla->getValor() == (int)$this->turno){
              if($this->getValor($this->libres[$i]->getPosX() - 1,$this->libres[$i]->getPosY())->getPosX() > 0 
              && $this->getValor($this->libres[$i]->getPosX() - 1,$this->libres[$i]->getPosY())->getPosX() <= 7
              && $this->getValor($this->libres[$i]->getPosX() - 1,$this->libres[$i]->getPosY())->getValor() < 2
              && $this->getValor($this->libres[$i]->getPosX() - 1,$this->libres[$i]->getPosY())->getValor() != $this->turno){
                array_push($this->posiblesMovimientos,$this->libres[$i]);
              }
            }
          }
        }
        //-columna "oeste"
       for($j = 1; $j < 7; $j++){
          if($this->libres[$i]->getPosY()-$j >= 0 && $this->libres[$i]->getPosY()-$j <= 7){
            $sigCasilla = $this->getValor($this->libres[$i]->getPosX() ,$this->libres[$i]->getPosY() - $j);
            if($sigCasilla != null && $sigCasilla->getValor() == (int)$this->turno){
              if($this->getValor($this->libres[$i]->getPosX(),$this->libres[$i]->getPosY() - 1)->getPosY() > 0 
              && $this->getValor($this->libres[$i]->getPosX(),$this->libres[$i]->getPosY() - 1)->getPosY() <= 7
              && $this->getValor($this->libres[$i]->getPosX(),$this->libres[$i]->getPosY() - 1)->getValor() < 2
              && $this->getValor($this->libres[$i]->getPosX(),$this->libres[$i]->getPosY() - 1)->getValor() != $this->turno){
                array_push($this->posiblesMovimientos,$this->libres[$i]);
              }
            }
          }
        }
        //+columna "este"
       for($j = 1; $j < 7; $j++){
          if($this->libres[$i]->getPosY()+$j >= 0 && $this->libres[$i]->getPosY()+$j <= 7){
            $sigCasilla = $this->getValor($this->libres[$i]->getPosX() ,$this->libres[$i]->getPosY() + $j);
            if($sigCasilla != null && $sigCasilla->getValor() == (int)$this->turno){
              if($this->getValor($this->libres[$i]->getPosX(),$this->libres[$i]->getPosY() + 1)->getPosY() > 0 
              && $this->getValor($this->libres[$i]->getPosX(),$this->libres[$i]->getPosY() + 1)->getPosY() <= 7
              && $this->getValor($this->libres[$i]->getPosX(),$this->libres[$i]->getPosY() + 1)->getValor() < 2
              && $this->getValor($this->libres[$i]->getPosX(),$this->libres[$i]->getPosY() + 1)->getValor() != $this->turno){
                array_push($this->posiblesMovimientos,$this->libres[$i]);
              }
            }
          }
        }
        //+fila "sur"
        for($j = 1; $j < 7; $j++){
          if($this->libres[$i]->getPosX()+$j >= 0 && $this->libres[$i]->getPosX()+$j <= 7){
            $sigCasilla = $this->getValor($this->libres[$i]->getPosX() + $j ,$this->libres[$i]->getPosY());
            if($sigCasilla != null && $sigCasilla->getValor() == (int)$this->turno){
              if($this->getValor($this->libres[$i]->getPosX() + 1,$this->libres[$i]->getPosY())->getPosX() > 0 
              && $this->getValor($this->libres[$i]->getPosX() + 1,$this->libres[$i]->getPosY())->getPosX() <= 7
              && $this->getValor($this->libres[$i]->getPosX() + 1,$this->libres[$i]->getPosY())->getValor() < 2
              && $this->getValor($this->libres[$i]->getPosX() + 1,$this->libres[$i]->getPosY())->getValor() != $this->turno){
                array_push($this->posiblesMovimientos,$this->libres[$i]);
              }
            }
          }
        }
        //+fila -columna "sur-este"
        for($j = 1; $j < 7; $j++){
          if(($this->libres[$i]->getPosX()+$j >= 0 && $this->libres[$i]->getPosX()+$j <= 7) 
          && ($this->libres[$i]->getPosY()-$j >= 0 && $this->libres[$i]->getPosY()-$j <= 7)){
            $sigCasilla = $this->getValor($this->libres[$i]->getPosX() + $j ,$this->libres[$i]->getPosY() - $j);
            if($sigCasilla != null && $sigCasilla->getValor() == (int)$this->turno){
              if($this->getValor($this->libres[$i]->getPosX() + 1,$this->libres[$i]->getPosY() - 1)->getPosX() > 0 
              && $this->getValor($this->libres[$i]->getPosX() + 1,$this->libres[$i]->getPosY() - 1)->getPosX() <= 7   
              && $this->getValor($this->libres[$i]->getPosX() + 1,$this->libres[$i]->getPosY() - 1)->getValor() < 2
              && $this->getValor($this->libres[$i]->getPosX() + 1,$this->libres[$i]->getPosY() - 1)->getValor() != $this->turno){
                array_push($this->posiblesMovimientos,$this->libres[$i]);
            }
          }
        }
      }
        //-fila +columna "nor-oeste"
        for($j = 1; $j < 7; $j++){
          if(($this->libres[$i]->getPosX()-$j >= 0 && $this->libres[$i]->getPosX()-$j <= 7) 
          && ($this->libres[$i]->getPosY()+$j >= 0 && $this->libres[$i]->getPosY()+$j <= 7)){
            $sigCasilla = $this->getValor($this->libres[$i]->getPosX() - $j ,$this->libres[$i]->getPosY() + $j);
            if($sigCasilla != null && $sigCasilla->getValor() == (int)$this->turno){
              if($this->getValor($this->libres[$i]->getPosX() - 1,$this->libres[$i]->getPosY() + 1)->getPosX() > 0 
              && $this->getValor($this->libres[$i]->getPosX() - 1,$this->libres[$i]->getPosY() + 1)->getPosX() <= 7   
              && $this->getValor($this->libres[$i]->getPosX() - 1,$this->libres[$i]->getPosY() + 1)->getValor() < 2
              && $this->getValor($this->libres[$i]->getPosX() - 1,$this->libres[$i]->getPosY() + 1)->getValor() != $this->turno){
                array_push($this->posiblesMovimientos,$this->libres[$i]);
              }
            }
          }
        }
        //+fila +columna "sur-oeste"
        for($j = 1; $j < 7; $j++){
          if(($this->libres[$i]->getPosX()+$j >= 0 && $this->libres[$i]->getPosX()+$j <= 7) 
          && ($this->libres[$i]->getPosY()+$j >= 0 && $this->libres[$i]->getPosY()+$j <= 7)){
            $sigCasilla = $this->getValor($this->libres[$i]->getPosX() + $j ,$this->libres[$i]->getPosY() + $j);
            if($this->getValor($this->libres[$i]->getPosX() + 1,$this->libres[$i]->getPosY() + 1)->getPosX() > 0 
            && $this->getValor($this->libres[$i]->getPosX() + 1,$this->libres[$i]->getPosY() + 1)->getPosX() <= 7   
            && $this->getValor($this->libres[$i]->getPosX() + 1,$this->libres[$i]->getPosY() + 1)->getValor() < 2
            && $this->getValor($this->libres[$i]->getPosX() + 1,$this->libres[$i]->getPosY() + 1)->getValor() != $this->turno){
                array_push($this->posiblesMovimientos,$this->libres[$i]);
              }
            }
          }
        }
        //-fila -columna "nor-este"
        for($j = 1; $j < 7; $j++){
          if(($this->libres[$i]->getPosX()-$j >= 0 && $this->libres[$i]->getPosX()-$j <= 7) 
          && ($this->libres[$i]->getPosY()-$j >= 0 && $this->libres[$i]->getPosY()-$j <= 7)){
            $sigCasilla = $this->getValor($this->libres[$i]->getPosX() - $j ,$this->libres[$i]->getPosY() - $j);
            if($sigCasilla != null && $sigCasilla->getValor() == (int)$this->turno){
              if($this->getValor($this->libres[$i]->getPosX() - 1,$this->libres[$i]->getPosY() - 1)->getPosX() > 0 
              && $this->getValor($this->libres[$i]->getPosX() - 1,$this->libres[$i]->getPosY() - 1)->getPosX() <= 7   
              && $this->getValor($this->libres[$i]->getPosX() - 1,$this->libres[$i]->getPosY() - 1)->getValor() < 2
              && $this->getValor($this->libres[$i]->getPosX() - 1,$this->libres[$i]->getPosY() - 1)->getValor() != $this->turno){
                array_push($this->posiblesMovimientos,$this->libres[$i]);
              }
            }
          }
        }
      }
      return $this->posiblesMovimientos;
    }
}

?>