<?php 
require_once './app/controllers/SellerControler.php';
require_once './app/controllers/SaleController.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home';
if(!empty($_GET['action'])){
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch($params[0]){
    case 'home':
        $controller = new SaleController();
        $controller->showSales();
        break;
    default:
        echo 'Error!';
        break;
}