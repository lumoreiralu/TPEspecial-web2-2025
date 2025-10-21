<?php
class SellerView
{
    public function showSellers($sellers, $user = null, $msg = null)
    {
        $count = count($sellers);
        require_once './templates/sellers-list.phtml';
    }

    // funcion para mostrar datos vendedor & imagen subida a la db
    public function showCard($seller, $user, $sales, $msg = null, $from = null)
    {
        if (!$from || $from <= 1)
            $page = "";
        else
            $page = "?page=" . $from;
        require_once './templates/sales-list.phtml';
    }

    public function showEditMenu($selectedId, $sellers, $user, $msg = null)
    {        
        $count = count($sellers);
        require_once './templates/sellers-edit-menu.phtml';
    }

    public function showFormAddSeller($error = null)
    {
        require_once './templates/form-addSeller.phtml';
    }

    public function showErrorMsg()
    {
        require_once './templates/error-msg.phtml';
    }

    public function showSuccessMsg($message, $action)
    {
        require_once './templates/alert-message.phtml';
    }
}