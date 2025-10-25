<?php
class SaleView{
    public function showSales($sales, $user, $seller = null){
        $count = count($sales);
        require_once 'templates/layout/header.phtml';
        require_once './templates/sale-templates/sales-list.phtml';
    }

    public function showError($msje) {
        require_once 'templates/sale-templates/messageError.phtml';
    }
    
    public function showMessageConfirm($msje) {
        require_once 'templates/sale-templates/messageConfirm.phtml';
    }
    public function showSaleDetail($sale){
        require_once 'templates/sale-templates/sale-detail.phtml';
    }
    

    public function showAddSaleForm($sellers, $user) {
        require 'templates/sale-templates/form-addSale.phtml';
    }

    public function showEditSaleForm($venta){ 
        require_once 'templates/sale-templates/form-edit-sale.phtml';
    }
    
}