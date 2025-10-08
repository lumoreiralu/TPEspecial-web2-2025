<?php
class SellerView{
    public function showSellers($sellers){
        $count = count($sellers);
        require_once './templates/sellers-list.php';
    }
}