<?php
class SellerView
{
    public function showSellers($sellers, $user)
    {
        $count = count($sellers);
        require_once './templates/sellers-list.phtml';
    }

    public function showEditMenu($sellerToEdit, $sellers, $user)
    {
        $count = count($sellers);
        require_once './templates/sellers-edit-menu.phtml';
    }

    public function showFormAddSeller()
    {
        require_once './templates/form-addSeller.phtml';
    }

    public function showErrorMsg(){
        require_once './templates/error-msg.phtml';        
    }

    // funcion para mostrar datos vendedor & imagen subida a la db

}