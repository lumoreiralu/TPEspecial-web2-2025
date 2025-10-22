<?php
class SaleView{
    public function showSales($sales, $user, $seller = null){
        $count = count($sales);
        require_once 'templates/layout/header.phtml';
        require_once './templates/sales-list.phtml';
    }

    public function showError($msje) {
        require_once 'templates/messageError.phtml';
    }
    
    public function showMessageConfirm($msje) {
        require_once 'templates/messageConfirm.phtml';
    }
    public function showSaleDetail($sale){
        require_once 'templates/sale-detail.phtml';
    }
    

    public function showAddSaleForm($sellers, $user) {
        require 'templates/form-addSale.phtml';
    }

    public function showEditSaleForm($venta){ 
        require_once 'templates/form-edit-sale.phtml';
    }
    
}