<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once './app/controllers/SaleController.php';
require_once './app/controllers/SellerController.php';
require_once './app/controllers/AuthController.php';
session_start();

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controller = new SaleController();
        $controller->showSales();
        break;
    case 'vendedores':
        if (!empty($params[1])) { // si me viene un ID de vendedor por GET
            $id = $params[1];
            $controller = new SaleController();
            $controller->showSalesByID($params[1]); // mando por param el ID de vendedor
            break;
        }
        $controller = new SellerController();
        $controller->showSellers();
        break;
    case 'venta': //por id
        $controller = new SaleController();
        if (isset($params[1])) {
            $id = $params[1];
            $controller->showSale($id);
        } else {
            $controller->showSales();
        }
        break;
    case 'addVenta':
        $controller = new SaleController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->addSale();
        } else {
            $controller->showAddSaleForm();
        }
        break;
        case 'editarVenta':
            $controller = new SaleController();
            if (!empty($params[1])) {
                $id = $params[1];
                $controller->showFormUpdate($id);
            } else {
                echo "ID no especificado"; //luego borrar
            }
            break;
    case 'updateSale':
        if(!empty($params[1])){
            $id = $params[1];
            $controller = new SaleController();
            $controller->updateSale($id);
        }
        break;
    case 'deleteSale':
        if(!empty($params[1])){
            $id = $params[1];
            $controller = new SaleController();
            $controller->deleteSale($id);
        }
        break;
    case 'nuevoVendedor':
        $controller = new SellerController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
            $controller->addSeller();
        else 
            $controller->showNewSellerForm();
        
        break;
    case 'editarVendedor':
        if (!empty($params[1])) {
            $controller = new SellerController();
            $sellerId = (int)$params[1]; // casteo el id del vendedor
            $controller->showSellerEditionMenu($sellerId); // le paso el id del vendedor a editar
        }
        break;
    case 'updateSeller':
        if (!empty($params[1])) {
            $controller = new SellerController();
            $sellerId = (int)$params[1]; // casteo el id del vendedor

            $controller->updateSeller($sellerId);
        }
        break;  
    case 'deleteSeller':
        if (!empty($params[1])){
            $id = (int)$params[1];
            $controller = new SellerController();
            $controller->deleteSeller($id);
        }
        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    default:
        echo 'Error!';
        break;
}