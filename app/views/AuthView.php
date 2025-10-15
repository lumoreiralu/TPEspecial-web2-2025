<?php

class AuthView{
    public function showLogin(){
        require_once './templates/form-login.phtml';
    }
    public function showError($msje){
        echo $msje;
    }
}