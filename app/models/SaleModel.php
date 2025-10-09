<?php

class SaleModel{
    private $db;

    function __construct(){

        $this->db = new PDO('mysql:host=localhost;dbname=db_tiendaComputacion;charset=utf8', 'root', '');
   
    }

    public function getAll(){
        $query = $this->db->prepare('SELECT * FROM venta');
        $query->execute();

        $sales = $query->fetchAll(PDO::FETCH_OBJ);

        return $sales;
    }

    public function showSale($id){
        $query = $this->db->prepare('SELECT * FROM venta WHERE = ?');
        $query->execute([$id]);

        $sale = $query->fetch(PDO::FETCH_OBJ);

        return $sale;
    }

    public function insert($producto, $precio, $vendedor, $fecha){
        $query = $this->db->prepare('INSERT INTO venta(producto, precio, id_vendedor, fecha) VALUES (?,?,?,?)');
        $query->execute([$producto, $precio, $vendedor, $fecha]);

        return $this->db->lastInsertId();
    }
}