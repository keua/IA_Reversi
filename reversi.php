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
    private $mejorMovimiento;
    
    public function __construct() {
         $this->matriz = array();
         $this->matrizAuxiliar = [ 
                             [ 120, -20, 20,  5,  5, 20, -20, 120 ],
                             [ -20, -40, -5, -5, -5, -5, -40, -20 ],
                             [  20,  -5, 15,  3,  3, 15,  -5,  20 ],
                             [   5,  -5,  3,  3,  3,  3,  -5,   5 ],
                             [  20,  -5, 15,  3,  3, 15,  -5,  20 ],
                             [   5,  -5,  3,  3,  3,  3,  -5,   5 ],
                             [ -20, -40, -5, -5, -5, -5, -40, -20 ],
                             [ 120, -20, 20,  5,  5, 20, -20, 120 ]
                            ];
      $this->mejorMovimiento = new tupla(0,0,0,0);
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
    public function getPosiblesMovimientos(){
      if( sizeof($this->libres) > 0 ){
        $this->posiblesMovimientos = array();

        for($i = 0; $i < sizeof($this->libres); $i++){
        
          //-fila "norte"
          
                  if(!in_array($this->libres[$i],$this->posiblesMovimientos)){
                    $primera = 0;
                    if($this->libres[$i]->getPosX() > 0){
                       for($k = $this->libres[$i]->getPosX() - 1; $k >= 0; $k--){
                          if($this->getValor($k,$this->libres[$i]->getPosY())->getValor() == 2 ){
                          break;
                          }elseif($primera == 0
                             && $this->getValor($k,$this->libres[$i]->getPosY())->getValor() == $this->turno){
                          break;
                          }elseif($this->fichasRival[0]->getValor() == $this->getValor($k,$this->libres[$i]->getPosY())->getValor()){
                          $primera++;
                          continue;
                          }else{
                          array_push($this->posiblesMovimientos,$this->libres[$i]);
                          break;
                          }
                        }
                      }
                   }
          
          //-columna "este"
          
            if($this->libres[$i]->getPosY() > 0){
                  if(!in_array($this->libres[$i],$this->posiblesMovimientos)){
                    $primera = 0;
                    for($k = $this->libres[$i]->getPosY() - 1; $k >= 0; $k--){
                      if($this->getValor($this->libres[$i]->getPosX(),$k)->getValor() == 2 ){
                        break;
                      }elseif($primera == 0
                           && $this->getValor($this->libres[$i]->getPosX(),$k)->getValor() == $this->turno){
                        break;
                      }elseif($this->fichasRival[0]->getValor() == $this->getValor($this->libres[$i]->getPosX(),$k)->getValor()){
                        $primera++;
                        continue;
                      }else{
                        array_push($this->posiblesMovimientos,$this->libres[$i]);
                        break;
                   }
                 }
              }
            }
          //+columna "oeste"

            if($this->libres[$i]->getPosY() < 7){
                  if(!in_array($this->libres[$i],$this->posiblesMovimientos)){
                    $primera = 0;
                    for($k = $this->libres[$i]->getPosY() + 1; $k <= 7; $k++){
                      if($this->getValor($this->libres[$i]->getPosX(),$k)->getValor() == 2 ){
                        break;
                      }elseif($primera == 0
                           && $this->getValor($this->libres[$i]->getPosX(),$k)->getValor() == $this->turno){
                        break;
                      }elseif($this->fichasRival[0]->getValor() == $this->getValor($this->libres[$i]->getPosX(),$k)->getValor()){
                        $primera++;
                        continue;
                      }else{
                        array_push($this->posiblesMovimientos,$this->libres[$i]);
                        break;
                  }
                }
              }
            }

          //+fila "sur"
          
            if($this->libres[$i]->getPosX() < 7){
                  if(!in_array($this->libres[$i],$this->posiblesMovimientos)){
                    $primera = 0;
                    for($k = $this->libres[$i]->getPosX() + 1; $k <= 7; $k++){
                      if($this->getValor($k,$this->libres[$i]->getPosy())->getValor() == 2 ){
                        break;
                      }elseif($primera == 0
                           && $this->getValor($k,$this->libres[$i]->getPosy())->getValor() == $this->turno){
                        break;
                      }elseif($this->fichasRival[0]->getValor() == $this->getValor($k,$this->libres[$i]->getPosy())->getValor()){
                        $primera++;
                        continue;
                      }else{
                        
                        array_push($this->posiblesMovimientos,$this->libres[$i]);
                        break;
                  }
                }
              }
            }

          //+fila -columna "sur-este"

            if($this->libres[$i]->getPosX() < 7
            && $this->libres[$i]->getPosY() > 0){
                  if(!in_array($this->libres[$i],$this->posiblesMovimientos)){
                    $primera = 0;
                    $bandera = 0;
                    for($k = $this->libres[$i]->getPosX() + 1; $k <= 7 && $bandera < 1; $k++){
                      for($l = $this->libres[$i]->getPosY() - 1; $l >= 0; $l--){
                        if($this->getValor($k,$l)->getValor() == 2 ){
                          $bandera++;
                          break;
                        }elseif($primera == 0
                             && $this->getValor($k,$l)->getValor() == $this->turno){
                          $bandera++;
                          break ;
                        }elseif($this->fichasRival[0]->getValor() == $this->getValor($k,$l)->getValor()){
                          $primera++;
                          if($k < 7)$k++;
                          continue ;
                        }else{
                          array_push($this->posiblesMovimientos,$this->libres[$i]);
                          $bandera++;
                          break;
                        }
                      }
                    }
                  }
                }

          //-fila +columna "nor-oeste"

            if($this->libres[$i]->getPosX() > 0
            && $this->libres[$i]->getPosY() < 7){
                  if(!in_array($this->libres[$i],$this->posiblesMovimientos)){
                    $primera = 0;
                    $bandera = 0;
                    for($k = $this->libres[$i]->getPosX() - 1; $k >= 0 && $bandera < 1; $k-- ){
                      for($l = $this->libres[$i]->getPosY() + 1; $l <= 7; $l++){
                        if($this->getValor($k,$l)->getValor() == 2 ){
                          $bandera++;
                          break;
                        }elseif($primera == 0
                             && $this->getValor($k,$l)->getValor() == $this->turno){
                          $bandera++;
                          break;
                        }elseif($this->fichasRival[0]->getValor() == $this->getValor($k,$l)->getValor()){
                          $primera++;
                          if($k > 0)$k--;
                          continue;
                        }else{
                          array_push($this->posiblesMovimientos,$this->libres[$i]);
                          $bandera++;
                          break;
                    }
                  }
                }
              }
            }

          //+fila +columna "sur-oeste"

            if($this->libres[$i]->getPosX() <  7
            && $this->libres[$i]->getPosY() >  0){
                    if(!in_array($this->libres[$i],$this->posiblesMovimientos)){
                      $primera = 0;
                      $bandera = 0;
                      for($k = $this->libres[$i]->getPosX() + 1; $k <= 7 && $bandera < 1; $k++ ){
                        for($l = $this->libres[$i]->getPosY() - 1; $l >= 0; $l--){
                          if($this->getValor($k,$l)->getValor() == 2 ){
                            $bandera++;
                            break;
                          }elseif($primera == 0
                               && $this->getValor($k,$l)->getValor() == $this->turno){
                            $bandera++;
                            break;
                          }elseif($this->fichasRival[0]->getValor() == $this->getValor($k,$l)->getValor()){
                            $primera++;
                            if($k < 7)$k++;
                            continue;
                          }else{
                            
                            array_push($this->posiblesMovimientos,$this->libres[$i]);
                            $bandera++;
                            break;
                    }
                  }
                }
              }
            }

          //-fila -columna "nor-este"

            if($this->libres[$i]->getPosX() >  0
            && $this->libres[$i]->getPosY() >  0){
                  if(!in_array($this->libres[$i],$this->posiblesMovimientos)){
                    $primera = 0;
                    $bandera = 0;
                      for($k = $this->libres[$i]->getPosX() - 1 ; $k >= 0 && $bandera < 1; $k-- ){
                        for($l = $this->libres[$i]->getPosY() - 1; $l >= 0; $l--){
                          if($this->getValor($k,$l)->getValor() == 2 ){
                            $bandera++;
                            break;
                          }elseif($primera == 0
                               && $this->getValor($k,$l)->getValor() == $this->turno){
                            $bandera++;
                            break;
                          }elseif($this->fichasRival[0]->getValor() == $this->getValor($k,$l)->getValor()){
                            $primera++;
                            if($k > 0)$k--;
                            continue;
                          }else{            
                            array_push($this->posiblesMovimientos,$this->libres[$i]);
                            $bandera++;
                            break;
                    }
                  }
                }
              }
            }
          }

        return $this->posiblesMovimientos;
      }
      return null;
    }
  public function getMejorMovimiento(){
    for($i = 0; $i < sizeof($this->posiblesMovimientos); $i++){
      for($j = 0;$j < sizeof($this->posiblesMovimientos) - $i; $j++){
        if($j+1 < sizeof($this->posiblesMovimientos) && $this->posiblesMovimientos[$j]->getPrioridad() < $this->posiblesMovimientos[$j+1]->getPrioridad()){
            $k = $this->posiblesMovimientos[$j + 1]; 
            $this->posiblesMovimientos[$j + 1] = $this->posiblesMovimientos[$j]; 
            $this->posiblesMovimientos[$j] = $k;
        }
      }
    }
    $this->mejorMovimiento = $this->posiblesMovimientos[0];
    return $this->mejorMovimiento;
  }
}

?>