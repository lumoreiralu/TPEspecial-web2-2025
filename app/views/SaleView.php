<?php
class SaleView{
    public function showSales($sales){
        $count = count($sales);
        require_once './templates/sales-list.phtml';
    }

    public function showSale($sale){
        require_once './templates/sale-detail.php';
    }

    public function showError($msje){
        echo $msje;
    }

    public function showAddSaleForm($sellers) {
        require 'templates/form-addSale.phtml';
    }
    
}