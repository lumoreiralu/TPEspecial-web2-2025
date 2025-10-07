<?php
require_once '../models/SellerModel.php';
require_once '../views/SellerView.php';

class SellerControler{
    private $model;
    private $view;

    function __construct(){
        $this->model = new SellerModel();
        $this->view = new SellerView();
    }

    
}