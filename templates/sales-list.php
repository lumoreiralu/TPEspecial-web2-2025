<?php 
require_once 'templates/layout/header.php';
    foreach($sales as $sale){
        echo'Nombre: '. $sale->producto . 
            "- Precio: " . $sale->precio . "<br>" ;
    }

require_once 'templates/layout/footer.php';