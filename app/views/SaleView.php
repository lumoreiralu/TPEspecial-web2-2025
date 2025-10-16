<?php
class SaleView{
    public function showSales($sales, $user){
        $count = count($sales);
        require_once 'templates/layout/header.php';
        require_once './templates/sales-list.phtml';
    }

    public function showSale($sale){
        require_once './templates/sale-detail.php';
    }

    public function showError($msje) {
        echo '
        <div class="container mt-4">
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Error:</strong> ' . htmlspecialchars($msje) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>';
    }
    
    public function showMessageConfirm($msje) {
        echo '
        <div class="container mt-4">
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>Éxito:</strong> ' . htmlspecialchars($msje) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>';
    }
    

    public function showAddSaleForm($sellers) {
        require 'templates/form-addSale.phtml';
    }

    public function showEditSaleForm($venta){ 
        require_once 'templates/form-edit-sale.phtml';
    }
    
}