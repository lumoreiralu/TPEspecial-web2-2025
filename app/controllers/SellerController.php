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
        $sellers = $this->sellerModel->getSellers();
        if (isset($_SESSION['flash'])) {
            $msg = $_SESSION['flash'];
            unset($_SESSION['flash']);
            $this->sellerView->showSellers($sellers, $request->user, $msg);
            return;
        }
        $this->sellerView->showSellers($sellers, $request->user);
    }

    function showNewSellerForm()
    {
        $this->sellerView->showFormAddSeller();
    }

    function showSellerEditMenu($request, $sellerId)
    {
        $sellers = $this->sellerModel->getSellers();
        if (isset($_SESSION['flash'])) {
            $msg = $_SESSION['flash'];
            unset($_SESSION['flash']);
            $this->sellerView->showEditMenu($sellerId, $sellers, $request->user, $msg);
            return;
        }
        if ($request->user):
            $this->sellerView->showEditMenu($sellerId, $sellers, $request->user);
        else:
            $this->sellerView->showErrorMsg();
        endif;
    }

    public function showSellerCard($sellerId, $request)
    {
        $seller = $this->sellerModel->getSellerById($sellerId);
        $msg = null;
        if (isset($_SESSION['flash'])):
            $msg = $_SESSION['flash'];
            unset($_SESSION['flash']);
        endif;
        // verifico que exista el vendedor
        if ($seller) {
            $sales = $this->saleModel->getSalesById($sellerId);
            if (isset($_GET['from'])):
                $fromPage = $_GET['from'];
                $this->sellerView->showCard($seller, $request->user, $sales, $msg, $fromPage);
            else:
                $this->sellerView->showCard($seller, $request->user, $sales, $msg);
            endif;
        } else {
            $this->sellerView->showErrorMsg();
        }
    }
    function update($id)
    {
        if (empty($_POST) && empty($_FILES)) {
            $_SESSION['flash'] = ["danger", "bi bi-x-circle-fill me-2", "Error procesar", "El archivo no es compatible"];
            header("Location: " . BASE_URL . "vendedor/" . $id);
            die();
        }
        // Valido que ningún campo esté vacío
        if (!empty($_POST['nombre']) && !empty($_POST['telefono']) && !empty($_POST['email'])) {
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
        } else {
            $_SESSION['flash'] = ["warning", "bi bi-exclamation-triangle-fill me-2", "No se pudo completar", "Faltan completar datos obligatorios"];
            header("Location: " . BASE_URL . "vendedores/editar/$id");
            return;
        }

        // Valido el formato del email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash'] = ["warning", "bi bi-exclamation-triangle-fill me-2", "No se pudo completar", "Formato de email inválido"];
            header("Location: " . BASE_URL . "vendedores/editar/$id");
            return;
        }
        $srcImage = null;
        // Verifico si mando una imagen
        if ($_FILES['imagen']['tmp_name'] && $_FILES['imagen']['error'] === UPLOAD_ERR_OK){
            // si la mandó, la valido
            $mime = mime_content_type($_FILES['imagen']['tmp_name']);
            $maxSize = 4 * 1024 * 1024; // maximo = 4 MB            
            // si es valida la subo al servidor
            if (in_array($mime, ['image/jpeg', 'image/png']) && $_FILES['imagen']['size'] <= $maxSize)
                $srcImage = $this->uploadImg($_FILES['imagen']);
            else {
                $_SESSION['flash'] = ["warning", "bi bi-exclamation-triangle-fill me-2", "No se pudo completar", "Solo se permiten imágenes .jpeg, .jpeg o .png y que pesen menos de 4 megabytes"];
                header("Location: " . BASE_URL . "vendedor/" . $id);
                return;
            }
            $this->sellerModel->update($id, $nombre, $telefono, $email, $srcImage);
            header("Location: " . BASE_URL . "vendedor/" . $id);
            return;

        }
        else
            $result = $this->sellerModel->update($id, $nombre, $telefono, $email);
        if ($result)
            $_SESSION['flash'] = ["success", "bi bi-check-circle-fill me-2", "Operación completada", "Los datos del vendedor se actualizaron correctamente"];
        header("Location: " . BASE_URL . "vendedores");
    }

    function delete($id)
    {
        $success = $this->sellerModel->delete($id);
        if ($success):

            header("Location: " . BASE_URL . "vendedores");
            $_SESSION['flash'] = ["success", "bi bi-patch-check-fill me-2", "Operación completada", "El vendedor se ha eliminado correctamente"];

        else:
            header("Location: " . BASE_URL . "vendedores");
            $_SESSION['flash'] = ["danger", "bi bi-x-octagon-fill me-2", "Oops! Algo falló", "El vendedor no se pudo eliminar"];
        endif;
    }
    public function uploadImg($img)
    {
        $target = "img/" . uniqid() . "." . strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
        move_uploaded_file($img['tmp_name'], $target);
        return $target;
    }

    function insert()
    {
        if (!empty($_POST['nombre']) && !empty($_POST['telefono']) && !empty($_POST['email'])):
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
        else:
            $error = "Faltan datos obligatorios";
            $this->sellerView->showFormAddSeller($error);
            return;
        endif;

        // Valido el formato de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
            $error = "Ingrese un email válido";
            $this->sellerView->showFormAddSeller($error);
            return;
        endif;

        $imgToUpload = null;

        if (!empty($_FILES['imagen']['tmp_name']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK):
            $mime = mime_content_type($_FILES['imagen']['tmp_name']);
            $maxSize = 4000 * 1024 * 1024; // maximo = 4 MB

            if (in_array($mime, ['image/jpeg', 'image/png']) && $_FILES['imagen']['size'] <= $maxSize)
                $imgToUpload = $this->uploadImg($_FILES['imagen']);
            else {
                $error = "La imagen es demasiado grande";
                $this->sellerView->showFormAddSeller($error);
                return;
            }
        endif;

        $success = $this->sellerModel->insert($nombre, $telefono, $email, $imgToUpload);
        if ($success)
            $_SESSION['flash'] = ["success", "bi bi-patch-check-fill me-2", "Operación completada", "El vendedor ha sido registrado completadamente"];

        header("Location: " . BASE_URL . "vendedores");
    }

    function showError()
    {
        $this->sellerView->showErrorMsg();
    }
}