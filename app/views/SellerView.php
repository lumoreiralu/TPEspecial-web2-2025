<?php
class SellerView
{
    // tabla de vendedores -> vendedores/
    public function showSellers($sellers, $user = null, $paginacion, $msg = null)
    {
        $vendedoresPagina = $paginacion['vendedoresPagina'];
        $paginaActual = $paginacion['paginaActual'];
        $totalPaginas = $paginacion['totalPaginas'];
        $pagina = $paginacion['pagina'];
        $inicio = $paginacion['inicio'];
        $from = $paginacion['from'];

        require_once './templates/sellers-list.phtml';
    }

    // perfil del vendedor -> vendedor/:id
    public function showCard($seller, $user, $sales, $paginacion, $msg = null, $from = null)
    {
        $vendedoresPagina = $paginacion['vendedoresPagina'];
        $paginaActual = $paginacion['paginaActual'];
        $totalPaginas = $paginacion['totalPaginas'];
        $pagina = $paginacion['pagina'];
        $inicio = $paginacion['inicio'];
        $from = $paginacion['from'];
        if (!$from || $from <= 1)
            $page = "";
        else
            $page = "?page=" . $from;

        require_once './templates/sales-list.phtml';
    }

    // modo editar vendedor tabla de vendedores -> vendedores/editar/1
    public function showEditMenu($selectedId, $sellers, $user, $paginacion, $msg = null)
    
    {
        $vendedoresPagina = $paginacion['vendedoresPagina'];
        $paginaActual = $paginacion['paginaActual'];
        $totalPaginas = $paginacion['totalPaginas'];
        $pagina = $paginacion['pagina'];
        $inicio = $paginacion['inicio'];
        $from = $paginacion['from'];
        if (!$from || $from <= 1)
            $page = "";
        else
            $page = "?page=" . $from;
        require_once './templates/sellers-edit-menu.phtml';
    }

    // formulario registrar vendedor -> vendedor/nuevo
    public function showFormAddSeller($msg = null, $user)
    {
        require_once './templates/form-addSeller.phtml';
    }

    // pantalla de error -> url invalida
    public function showErrorMsg()
    {
        require_once './templates/error-msg.phtml';
    }

    // pantalla de error -> no responde la db
    public function showExceptionError($e)
    {
        require_once './templates/alert-exception.phtml';
    }
}