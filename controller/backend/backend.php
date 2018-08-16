<?php

require_once 'model/PasswordManager.php';

class ctrlBackend {

    private $passwordManager;

    public function __construct() {
        $this->passwordManager = new PasswordManager();
    }

    //WIP
    public function displayLoginPage() {
        require('view/backend/loginView.php');
    }

    public function verifyPassword($userPassword) {
        $passwordVerified = $this->passwordManager->verifyPassword($userPassword);
        var_dump($passwordVerified);
        return $passwordVerified;
    }
}