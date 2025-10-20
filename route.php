<?php
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

try {
    switch ($params[0]) {

        case 'home':
            $controller = new SaleController();
            $controller->showSales($request);
            break;

        /* -- ITEMS -> VENTA -- */
        case "detalleVenta": //muestra la venta para todos
            $controller = new SaleController();
            if (!empty($params[1])) {
                $id = $params[1];
                $controller->showSaleDetail($id);
            } else
                echo '404 not found';
            break;

        case 'venta': //usa seguridad para mostrar la venta con sus botones ocultos
            $controller = new SaleController();
            if (isset($params[1])) {
                $request = (new GuardMiddleware())->run($request);
                $id = $params[1];
                $controller->showSale($id);
            } else {
                $controller->showSales($request);
            }
            break;

        case 'addSale':
            $request = (new GuardMiddleware())->run($request);
            $controller = new SaleController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->addSale($request);
            } else {
                $controller->showAddSaleForm($request);
            }
            break;

        case 'editarVenta': //muestra el formulario 
            $request = (new GuardMiddleware())->run($request);
            $controller = new SaleController();
            if (!empty($params[1])) {
                $id = $params[1];
                $controller->showFormUpdate($id, $request);
            } else {
                $view = new SaleView();
                $view->showError("Debes indicar qué venta deseas editar.");
            }
            break;

        case 'updateSale': //toma el valor del formulario y se los da al modelo para actualizar en la db
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


        /* -- CATEGORIA -> VENDEDOR -- */
        case 'vendedores':
            $controller = new SellerController();
            if (empty($params[1])) {
                $controller->showSellers($request);

            }
            // vendedores/editar
            elseif (!empty($params[1]) && !empty($params[2])) {
                // esta validacion deberia hacerla el controller
                if ($params[1] != 'editar') {
                    $controller->error();
                    break;
                }
                // vendedores/editar/actualizar-datos
                if (!empty($params[3]) && $params[3] == "actualizar-datos") {
                    $request = (new GuardMiddleware())->run($request);
                    $sellerId = (int) $params[2];
                    $controller->update($sellerId, $request);
                    break;
                }
                // vendedores/editar/:id
                $id = (int) $params[2];
                $controller->showSellerEditMenu($request, $id);
                break;

            } else
                $controller->error();
            break;

        case 'vendedor':
            $controller = new SellerController();
            if (!empty($params[1]) && empty($params[2])) {
                $id = (int) $params[1];
                $controller->showSellerCard($id, $request);
            } else
                $controller->error();
            break;

        case 'nuevo-vendedor':
            $request = (new GuardMiddleware())->run($request);
            $controller = new SellerController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
                $controller->insert();
            else
                $controller->showNewSellerForm();
            break;

        case 'eliminar':
            $request = (new GuardMiddleware())->run($request);
            if (!empty($params[1]) && $params[1] == "vendedor") {
                $id = (int) $params[2];
                $controller = new SellerController();
                $controller->delete($id);
            }
            break;

        /* -- LOGIN/LOGOUT -- */
        case 'showLogin':
            $controller = new AuthController();
            $controller->showLogin();
            break;

        case 'login':
            $controller = new AuthController();
            $controller->login();
            break;

        case 'logout':
            $request = (new GuardMiddleware())->run($request);
            $controller = new AuthController();
            $controller->logout($request);
            break;

        default:
            $controller = new SellerView();
            $controller->showErrorMsg();
            break;
    }
} catch (Exception $e) {
    require_once './templates/error-conexion.phtml';
    die();
}