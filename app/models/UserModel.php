<?php
require_once 'Model.php';
class UserModel extends Model{

    public function get($id) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE id_usuario = ?');
        $query->execute([$id]);
        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }

    public function getByUser($user) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE user = ?');
        $query->execute([$user]);
        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }
    
    public function getAll() {

        $query = $this->db->prepare('SELECT * FROM usuario');
        $query->execute();

        $users = $query->fetchAll(PDO::FETCH_OBJ);

        return $users;
    }

    function insert($user, $password) {
        $query = $this->db->prepare("INSERT INTO usuario(user, password) VALUES(?,?)");
        $query->execute([$user, $password]);


        return $this->db->lastInsertId();
    }

}