<?php
require_once 'app/models/UserModel.php';
require_once 'app/views/UserView.php';
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


    public function login() {

        if (isset($_POST['user']) && isset($_POST['password'])) {
            $user = $_POST['user'];
            $password = $_POST['password'];
    

            $userFromDB = $this->model->getUserByUsername($user); 
    
            if ($userFromDB && password_verify($password, $userFromDB->password)) {

                $_SESSION['ID_VENDEDOR'] = $userFromDB->id_vendedor; // ID del vendedor/user
                $_SESSION['USUARIO_VENDEDOR'] = $userFromDB->usuario; // user del vendedor
                $_SESSION['ROL_VENDEDOR'] = $userFromDB->rol;  // Guardar el rol del vendedor/user (por ejemplo, 'admin' o 'vendedor')
                $_SESSION['LAST_ACTIVITY'] = time(); // Tiempo de la última actividad 


                header('Location: ' . BASE_URL);
                exit(); 
            } else {
                return $this->view->showLogin('Credenciales incorrectas');
            }
        } else {
            return $this->view->showLogin('Por favor, ingrese sus credenciales.');
        }
    }
}