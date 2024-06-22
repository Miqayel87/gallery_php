<?php

require_once 'models/user.php';
require_once 'helpers/SanitizationHelper.php';

class LoginController
{
    private $user;
    private $sanitizationHelper;

    public function __construct()
    {
        $this->user = new User;
        $this->sanitizationHelper = new SanitizationHelper;
    }

    public function index()
    {
        require_once 'views/login.php';
    }

    public function signIn()
    {
        $sanitizeData = $this->sanitizationHelper->sanitize($_POST);
        $username = $sanitizeData['username'];
        $password = $sanitizeData['password'];

        $user = $this->user->getUserByUsername($username);

        if (empty($user)) {
            return header('Location:' . BASE_URL . 'login?error=invalid_credentials');
        }

        $hashedPassword = $user['password'];
        
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user'] = $user;
            return header('Location:' . BASE_URL);
        } else {
            return header('Location:' . BASE_URL . 'login?error=invalid_credentials');
        }
    }

    public function logout()
    {
        $_SESSION['user'] = null;
        header('Location:' . BASE_URL . 'login');
    }
}
