<?php
require_once 'Model.php';
class SellerModel extends Model{
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

    public function update($id, $nombre, $telefono, $email) {
        $query = $this->db->prepare("UPDATE `vendedor` SET `nombre` = ?, `telefono` = ? , `email` = ? WHERE `vendedor`.`id` = ?");
        return $query->execute([$nombre, $telefono, $email, $id]);
    } 

    public function delete($id) {
        $query = $this->db->prepare("DELETE FROM vendedor WHERE `vendedor`.`id` = ?");
        $query->execute([$id]);
    }

    public function insert($nombre, $telefono, $email) {
        $query = $this->db->prepare("INSERT INTO `vendedor` (`id`, `nombre`, `telefono`, `email`) VALUES (NULL, ?, ?, ?)");
        $query->execute([$nombre, $telefono, $email]);
    }
}