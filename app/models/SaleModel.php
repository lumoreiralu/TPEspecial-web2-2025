<?php
require_once 'Model.php';
class SaleModel extends Model{ 
    public function getAll(){
        $query = $this->db->prepare('SELECT * FROM venta');
        $query->execute();

        $sales = $query->fetchAll(PDO::FETCH_OBJ);

        return $sales;
    }

    public function getSeller($sellerId){
        $query = $this->db->prepare('SELECT * FROM vendedor WHERE id = ?');
        $query->execute([(int)$sellerId]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    // devuelve array de ventas por vendedor
    public function getSalesById($sellerId){
        $query = $this->db->prepare('SELECT * FROM `venta` WHERE `id_vendedor` = ? ORDER BY `id_venta` ASC');
        $query->execute([(int)$sellerId]);

        $sales = $query->fetchAll(PDO::FETCH_OBJ);

        return $sales;
    }

    public function showSale($id){
        $query = $this->db->prepare('SELECT * FROM venta WHERE `id_venta` = ?'); 
        $query->execute([$id]);

        $sale = $query->fetch(PDO::FETCH_OBJ);

        return $sale;
    }

    // Trae el detalle de UNA venta
    public function getSaleDetail($id) {
        $query = $this->db->prepare("
            SELECT v.*, ven.nombre AS vendedor
            FROM venta v
            JOIN vendedor ven ON v.id_vendedor = ven.id_vendedor
            WHERE v.id_venta = ?
        ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function insert($producto, $precio, $vendedor, $fecha){
        $query = $this->db->prepare('INSERT INTO venta(producto, precio, id_vendedor, fecha) VALUES (?,?,?,?)');
        $query->execute([$producto, $precio, $vendedor, $fecha]);

        return $this->db->lastInsertId();
    }

    public function updateSale($id, $producto, $precio, $fecha) {
        $query = $this->db->prepare('UPDATE venta SET producto = ?, precio = ?, fecha = ? WHERE id_venta = ?');
        return $query->execute([$producto, $precio, $fecha, $id]);
    }
    

    public function deleteSale($id){
        $query = $this->db->prepare('DELETE FROM `venta` WHERE `id_venta` = ?');
        $query->execute([$id]);
    }

}