<?php
class SaleView{
    public function showSales($sales){
        $count = count($sales);
        require_once './templates/sales-list.php';
    }

    public function showSale($sale){
        require_once './templates/sale-detail.php';
    }
}