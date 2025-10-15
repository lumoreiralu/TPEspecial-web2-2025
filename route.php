<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once './app/controllers/SaleController.php';
require_once './app/controllers/SellerController.php';
require_once './app/controllers/AuthController.php';
require_once './app/middlewares/GuardMiddleware.php';
require_once './app/middlewares/SessionMiddleware.php';
session_start();

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

// --- Aplico el middleware de sesión ---
$request = new StdClass();
$request = (new SessionMiddleware())->run($request);

switch ($params[0]) {

    case 'home':
        $controller = new SaleController();
        $controller->showSales();
        break;

    case 'vendedores':
        $controller = new SellerController();
        $controller->showSellers();
        break;

    case 'vendedor':
        $controller = new SaleController();
        if (!empty($params[1])) {
            $id = (int) $params[1];
            $controller->showSalesById($id);
        } else
            echo '404 not found';
        break;

    case 'venta': 
        $controller = new SaleController();
        if (isset($params[1])) {
            $id = $params[1];
            $controller->showSale($id);
        } else {
            $controller->showSales();
        }
        break;

    case 'addVenta':
        $request = (new GuardMiddleware())->run($request);
        $controller = new SaleController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->addSale($request);
        } else {
            $controller->showAddSaleForm($request);
        }
        break;
    case 'editarVenta':
        $request = (new GuardMiddleware())->run($request);
        $controller = new SaleController();
        
        if (!empty($params[1])) {
            $id = $params[1];
            $controller->showFormUpdate($id, $request);
        } else {
            echo "ID no especificado";
        }
        break;
    case 'updateSale':
        $request = (new GuardMiddleware())->run($request);
        $controller = new SaleController();
        
        if (!empty($params[1])) {
            $id = $params[1];
            $controller->updateSale($id, $request);
        }
        break;
    case 'deleteSale':
        $request = (new GuardMiddleware())->run($request);
        $controller = new SaleController();
        if (!empty($params[1])) {
            $id = $params[1];
            $controller->deleteSale($id, $request);
        }
        break;

    case 'nuevoVendedor':
        $request = (new GuardMiddleware())->run($request);
        $controller = new SellerController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->addSeller($request);
        } else {
            $controller->showNewSellerForm($request);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
            $controller->addSeller();
        else
            $controller->showNewSellerForm();

        break;

    case 'editarVendedor':
        $request = (new GuardMiddleware())->run($request);
        if (!empty($params[1])) {
            $controller = new SellerController();
            $sellerId = (int) $params[1];
            $controller->showSellerEditionMenu($sellerId, $request);
        }
        break;

    case 'updateSeller':
        if (!empty($params[1])) {
            $controller = new SellerController();
            $sellerId = (int) $params[1];
            $controller->updateSeller($sellerId, $request);
        }
        break;

    case 'deleteSeller':
        if (!empty($params[1])) {
            $id = (int) $params[1];
            $controller = new SellerController();
            $controller->deleteSeller($id, $request);
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