<?php

require_once 'models/user.php';
require_once 'validation/validator.php';
require_once 'helpers/SanitizationHelper.php';

class RegistrationController
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
        require_once 'views/registration.php';
    }

    public function signUp()
    {
        $sanitizeData = $this->sanitizationHelper->sanitize($_POST);

        $username = $sanitizeData['username'];
        $dateOfBirth = $sanitizeData['dateOfBirth'];
        $password = $sanitizeData['password'];

        if (!Validator::validateRequired($username) || !Validator::validateRequired($dateOfBirth) || !Validator::validateRequired($password)) {
            header('Location:' . BASE_URL . 'registration?error=missing_fields');
            exit();
        }

        if (!Validator::validateDate($dateOfBirth)) {
            header('Location:' . BASE_URL . 'registration?error=invalid_date');
            exit();
        }

        if (!Validator::validatePasswordStrength($password)) {
            header('Location:' . BASE_URL . 'registration?error=weak_password');
            exit();
        }

        if (!Validator::validateUsernameUnique($username, $this->user)) {
            header('Location:' . BASE_URL . 'registration?error=username_taken');
            exit();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->user->add([
            "username" => $username,
            "dateOfBirth" => $dateOfBirth,
            "password" => $hashedPassword
        ]);
        
        $user = $this->user->getLastInsert();

        $_SESSION['user'] = $user;

        header('Location:' . BASE_URL);
        
        exit();
    }
}
