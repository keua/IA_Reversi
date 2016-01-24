<?php
/*
    cadena de entrada
    22222222 22222222 22222222 22210222 22201222 22222222 22222222 22222222
    22222222 22222222 22222222 22211122 22201222 22222222 22222222 22222222
*/
include 'reversi.php';

$movimiento = new reversi();


if (isset($_GET['estado']) && isset($_GET['turno'])) {
    
    $movimiento->setMatriz($_GET['estado']);
    $movimiento->setTurno($_GET['turno']);
    
    $matriz = $movimiento->getMatriz();

    echo("Turno de: \n".$movimiento->getTurno()."<br>");
    echo("[ ");
    for ($i = 0; $i < 8; $i++) {
        
         for ($j = 0; $j < 8; $j++) {
           
              if($j>0 || $i>0) echo("&nbsp&nbsp");
              $tempTupla = $matriz[$i][$j]; 
              echo("(".$tempTupla->getValor().",".$tempTupla->getPosX().",".$tempTupla->getPosY().")");
              if($j < 7) echo(",");          
         }
         
         if($i < 7) echo("<br>");
    }
    echo(" ]<br> Casillas Libres");
    for($i = 0;  $i < sizeof($movimiento->getLibres()); $i++){
      if($i%7 == 0) echo("<br>");
      print("(".$movimiento->getLibres()[$i]->getPosX().",".$movimiento->getLibres()[$i]->getPosY().")");
    }   
    echo("<br> posision fichas turno");
     for($i = 0;  $i < sizeof($movimiento->getFichasTurno()); $i++){
       if($i%7 == 0) echo("<br>");
      print("(".$movimiento->getFichasTurno()[$i]->getPosX().",".$movimiento->getFichasTurno()[$i]->getPosY().")");
    }
    echo("<br> posision fichas rival");
     for($i = 0;  $i < sizeof($movimiento->getFichasRival()); $i++){
       if($i%7 == 0) echo("<br>");
      print("(".$movimiento->getFichasRival()[$i]->getPosX().",".$movimiento->getFichasRival()[$i]->getPosY().")");
    }
    echo("<br> Posibles Movimientos");
     for($i = 0;  $i < sizeof($movimiento->getPosiblesMovimientos()); $i++){
       if($i%7 == 0) echo("<br>");
      print("(".$movimiento->getPosiblesMovimientos()[$i]->getPosX().",".$movimiento->getPosiblesMovimientos()[$i]->getPosY().")");
    }
 
}
else {
    echo("No hay ningun estado");
}

?>