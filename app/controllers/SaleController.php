<?php

require_once 'app/models/SaleModel.php';
require_once 'app/models/SellerModel.php'; 
require_once 'app/views/SaleView.php';

class SaleController {
    private $model;
    private $view;
    private $modelSeller;

    function __construct() {
        $this->model = new SaleModel();
        $this->view = new SaleView();
        $this->modelSeller = new SellerModel();
    }

    public function showSales($request) {
        $sales = $this->model->getAll();
        $this->view->showSales($sales, $request->user);
    }

    public function showSale($id) {
        $sale = $this->model->showSale($id);
        $this->view->showSale($sale);
    }

    // 🔹 Nuevo método para mostrar el formulario
    public function showAddSaleForm($request) {
        $sellers = $this->modelSeller->showAll();
        $this->view->showAddSaleForm($sellers);
    }

    public function addSale($request) {
        if (!isset($_POST['producto']) || empty($_POST['producto'])) {
            return $this->view->showError('Error: falta completar el producto');
        }
        if (!isset($_POST['precio']) || empty($_POST['precio'])) {
            return $this->view->showError('Error: falta completar el precio');
        }
        if (!isset($_POST['vendedor']) || empty($_POST['vendedor'])) {
            return $this->view->showError('Error: falta completar el vendedor');
        }
        if (!isset($_POST['fecha']) || empty($_POST['fecha'])) {
            return $this->view->showError('Error: falta completar la fecha');
        }

        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $vendedor = $_POST['vendedor'];
        $fecha = $_POST['fecha'];

        $id = $this->model->insert($producto, $precio, $vendedor, $fecha);

        if (!$id) {
            return $this->view->showError('Error al generar la venta');
        }

        // redirijo al home
        header('Location: ' . BASE_URL);
    }

    public function showSalesByID($sellerId) {
        $sales = $this->model->getSalesById($sellerId); // pido al modelo todas las ventas por id_vendedor
        $this->view->showSales($sales, $sellerId); // se reutiliza function showSales()
    }

    public function updateSale($id, $request){
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $fecha = $_POST['fecha'];        
        
        $this->model->updateSale($id, $producto, $precio, $fecha);
    
        $this->view->showMessageConfirm("Venta Editada");
        header('Location: ' . BASE_URL);

    }

    public function showFormUpdate($id, $request) {
        $sale = $this->model->showSale($id);
        $this->view->showEditSaleForm($sale);
    }
    

    public function deleteSale($id, $request){
        $this->model->deleteSale($id);

        header('Location: ' . BASE_URL);
    }

}
