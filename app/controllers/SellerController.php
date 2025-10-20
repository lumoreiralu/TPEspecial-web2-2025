<?php
require_once 'app/models/SellerModel.php';
require_once 'app/views/SellerView.php';

class SellerController
{
    private $sellerModel, $saleModel;
    private $saleView, $sellerView;

    function __construct()
    {
        $this->sellerModel = new SellerModel();
        $this->saleModel = new SaleModel();
        $this->sellerView = new SellerView();
        $this->saleView = new SaleView();
    }

    function showSellers($request)
    {
        $sellers = $this->sellerModel->showAll();

        $this->sellerView->showSellers($sellers, $request->user);
    }

    function showSellerEditView($request, $sellerId)
    {
        if ($request->user):
            $sellers = $this->sellerModel->showAll();
            $this->sellerView->showEditMenu($sellerId, $sellers, $request->user);
        else:
            $this->sellerView->showErrorMsg();
        endif;
    }

    function redirect($request){
        echo 'hola';
        var_dump($_POST);
        header("Location: " . BASE_URL . "vendedores/editar");
    }

    // esta funcion deberia ir ser de SellerController
    public function showSellerProfile($sellerId, $request) {
        if ($sellerId){
        $sales = $this->saleModel->getSalesById($sellerId); // pido al modelo todas las ventas por id_vendedor
        $seller = $this->saleModel->getSeller($sellerId);
        $this->saleView->showSales($sales,$request->user, $seller); // se reutiliza function showSales()
        }
        else {
            $this->sellerView->showErrorMsg();
        }
    }

    public function errorMsg(){
            $this->sellerView->showErrorMsg();
        
    }

    function updateSeller($id)
    {
        if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
            header("Location: " . BASE_URL . "vendedor/" . $id);
            return $this->sellerModel->updateImg($id, $_FILES['imagen']);
        }
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $this->sellerModel->update($id, $nombre, $telefono, $email);
        header("Location: " . BASE_URL . "vendedores");
    }

    function deleteSeller($id)
    {
        $this->sellerModel->delete($id);
        header("Location: " . BASE_URL . "vendedores");
    }

    function showNewSellerForm()
    {
        $this->sellerView->showFormAddSeller();
    }

    function addSeller()
    {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
            $this->sellerModel->insert($nombre, $telefono, $email, $_FILES['imagen']);
        else
            $this->sellerModel->insert($nombre, $telefono, $email);

        header("Location: " . BASE_URL . "vendedores");



    }



}