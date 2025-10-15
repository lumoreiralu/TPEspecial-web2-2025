<?php
class SellerView
{
    public function showSellers($sellers, $user)
    {
        $count = count($sellers);
        require_once './templates/sellers-list.php';
    }

    public function showEditMenu($sellerToEdit, $sellers)
    {
        $count = count($sellers);
        require_once './templates/sellers-edit-menu.php';
    }

    public function showFormAddSeller()
    {
        require_once './templates/form-addSeller.phtml';
    }

}