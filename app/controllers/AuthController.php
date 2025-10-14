<?php
require_once 'app/models/AuthModel.php';
require_once 'app/views/AuthView.php';
class AuthController{
    private $model;
    private $view;

    public function __construct(){
        $this->model = new UserModel();
        $this->view = new UserView();
    }

    public function showLogin(){
        return $this->view->showLogin();
    }

    public function login(){
        if((!isset($_POST['user']))||(empty($_POS['user']))){
            return $this->view->showError('Falta completar el nombre de usuario');
        }
        if(!isset($_POST['password'])||(empty($_POST['password']))){
            return $this->view->showError('Falta completar la contraseña');
        }
        $user = $_POST['user'];
        $password = $_POST['password'];

        $usserFromDB = $this->model->getUser($user);

    }
}