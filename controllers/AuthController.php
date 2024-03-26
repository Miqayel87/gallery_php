<?php

require_once 'models/admin.php';

class AuthController
{
    public function __construct()
    {
        $this->admin = new Admin();
    }

    public function index()
    {
        require_once 'views/login.php';
    }

    public function login()
    {
        $user = $this->admin->login($_POST['username'], $_POST['password']);
        if ($user) {
            $_SESSION['user'] = $user;
            header('Location:' . BASE_URL . 'admin/index');
        } else {
            header('Location:' . BASE_URL . 'auth/index?error=invalid_credentials');
        }
    }

    public function logout()
    {
        $_SESSION['user'] = null;
        header('Location:' . BASE_URL . 'auth/index');
    }
}
