<?php
require_once 'app/models/SellerModel.php';
require_once 'app/views/SellerView.php';

class SellerControler{
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

    
}