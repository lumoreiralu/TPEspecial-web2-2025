<?php

class SellerModel{

    private $db;

    function __construct(){

        $this->db = new PDO('mysql:host=localhost;dbname=db_tiendaComputacion;charset=utf8', 'root', '');
   
    }

    public function showAll(){
        $query = $this->db->prepare('SELECT * FROM vendedor');
        $query->execute();

        $sellers = $query->fetchAll(PDO::FETCH_OBJ);

        return $sellers;
    }
}