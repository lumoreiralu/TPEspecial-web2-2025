<?php

require_once 'app/models/SaleModel.php';
require_once 'app/views/SaleView.php';

class SaleController{
    private $model;
    private $view;

    function __construct(){
        $this->model = new SaleModel();
        $this->view = new SaleView();
    }

    public function showSales(){
        $sales = $this->model->getAll();

        $this->view->showSales($sales);
    }


}