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

    public function getSellerById($id) {
        $query  = $this->db->prepare('SELECT * FROM vendedor WHERE id_vendedor = ?');
        $query->execute([(int)$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function updateSeller($id, $nombre, $telefono, $email) {
        $query = $this->db->prepare("UPDATE `vendedor` SET `nombre` = ?, `telefono` = ? , `email` = ? WHERE `vendedor`.`id` = ?");
        return $query->execute([$nombre, $telefono, $email, $id]);
    } 

    public function deleteSeller($id) {
        $query = $this->db->prepare("DELETE FROM vendedor WHERE `vendedor`.`id` = ?");
        $query->execute([$id]);
    }
}