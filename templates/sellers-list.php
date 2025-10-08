<?php 
require_once 'templates/layout/header.php';
    foreach($sellers as $seller){
        echo'Nombre: '. $seller->nombre . 
            "- Telefono: " . $seller->telefono . "<br>" ;
    }

require_once 'templates/layout/footer.php';