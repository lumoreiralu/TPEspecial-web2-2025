<?php
require_once 'app/models/SellerModel.php';
require_once 'app/views/SellerView.php';

class SellerController{
    private $model;
    private $view;

    function __construct(){
        $this->model = new SellerModel();
        $this->view = new SellerView();
    }

    function showSellers(){
        $sellers = $this->model->showAll();

        $this->view->showSellers($sellers);
    }

    function showSellerEditionMenu($sellerById) {
        $sellers = $this->model->showAll();
        $this->view->showEditMenu( $sellerById, $sellers);
    }

    function updateSeller($id) {
        
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];        
        
        $this->model->update($id, $nombre, $telefono, $email);
    
        header("Location: " . BASE_URL . "vendedores");
    }

    function deleteSeller($id){
        $this->model->delete($id);
        header("Location: " . BASE_URL . "vendedores");
    }    
}