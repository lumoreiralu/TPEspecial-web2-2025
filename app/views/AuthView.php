<?php

class AuthView{
    public function showLogin(){
        require_once './templates/form-login.phtml';
    }
    public function showError($msje) {
        require_once 'templates/layout/header.phtml';
        echo '
        <div class="container mt-4">
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Error:</strong> ' . htmlspecialchars($msje) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>';
        require_once 'templates/layout/footer.phtml';
    }
}