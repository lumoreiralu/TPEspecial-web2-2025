<?php
require_once 'Model.php';
class UserModel extends Model{
    public function getUserByUsername($user){
        $query = $this->db->prepare('SELECT * FROM usuario WHERE user = ? ');
        $query->execute($user);

        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}