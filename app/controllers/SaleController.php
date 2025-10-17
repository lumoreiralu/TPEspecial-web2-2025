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

    public function showAddSaleForm($request) {
        if (!isset($_SESSION['USER_ROLE']) || $_SESSION['USER_ROLE'] !== 'administrador') {
            return $this->view->showError('Acceso denegado. Solo los administradores pueden agregar ventas.');
        }
    
        $sellers = $this->modelSeller->showAll();
        $this->view->showAddSaleForm($sellers);
    }
    

    public function addSale($request) {
        if (!isset($_SESSION['USER_ROLE']) || $_SESSION['USER_ROLE'] !== 'administrador') {
            return $this->view->showError('Acceso denegado. Solo los administradores pueden agregar ventas.');
        }
    
        if (empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['vendedor']) || empty($_POST['fecha'])) {
            return $this->view->showError('Error: faltan datos obligatorios');
        }
    
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $vendedor = $_POST['vendedor'];
        $fecha = $_POST['fecha'];
    
        $id = $this->model->insert($producto, $precio, $vendedor, $fecha);
    
        if (!$id) {
            return $this->view->showError('Error al generar la venta');
        }
    
        header('Location: ' . BASE_URL); 
    }
    
    // esta funcion deberia ir ser de SellerController
    public function showSalesByID($sellerId, $request) {
        $sales = $this->model->getSalesById($sellerId); // pido al modelo todas las ventas por id_vendedor
        $seller = $this->model->getSeller($sellerId);
        $this->view->showSales($sales,$request->user, $seller); // se reutiliza function showSales()
    }

    public function showSaleDetail($id){
        $sale = $this->model->getSaleDetail($id);
        $this->view->showSaleDetail($sale);
    }

    public function updateSale($id, $request) {
        // Solo admin puede actualizar
        if (!$request->user || $request->user->rol !== 'administrador') {
            return $this->view->showError('Acceso denegado. Solo los administradores pueden editar ventas.');
        }
    
        if (empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['fecha'])) {
            return $this->view->showError('Faltan datos obligatorios para editar la venta.');
        }
    
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $fecha = $_POST['fecha'];
    
        $ok = $this->model->updateSale($id, $producto, $precio, $fecha);
    
        if (!$ok) {
            return $this->view->showError('Error al actualizar la venta.');
        }
    
        $this->view->showMessageConfirm('Venta editada correctamente.');
        header('Location: ' . BASE_URL);
    }
    

    public function showFormUpdate($id, $request) {
        // Solo admin puede acceder
        if (!$request->user || $request->user->rol !== 'administrador') {
            return $this->view->showError('Acceso denegado. Solo los administradores pueden editar ventas.');
        }
    
        $sale = $this->model->showSale($id);
    
        if (!$sale) {
            return $this->view->showError('Venta no encontrada.');
        }
    
        $this->view->showEditSaleForm($sale);
    }
    
    

    public function deleteSale($id, $request){
        $this->model->deleteSale($id);

        header('Location: ' . BASE_URL);
    }

}
