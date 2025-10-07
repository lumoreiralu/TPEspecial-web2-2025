<?php

class SellerModel{

    private $db;

    function __construct(){

        $this->db = new PDO('mysql:host=localhost;dbname=db_tiendaComputacion;charset=utf8', 'root', '');
   
    }
}