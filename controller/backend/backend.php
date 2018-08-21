<?php

require_once 'model/PasswordManager.php';

class ctrlBackend {

    private $passwordManager;

    public function __construct() {
        $this->passwordManager = new PasswordManager();
    }

    //WIP
    public function displayLoginPage() {
        //If Session OK, then directly rediredect to the Backend view
        require('view/backend/loginView.php');
    }

    public function verifyPassword($userPassword) {
        $passwordVerified = $this->passwordManager->verifyPassword($userPassword);
        if($_SESSION['loggedIn'] === true) {
            //$_SESSION['loggedIn'] = true;
            require('view/backend/homepageView.php');
        }
        else {
            //$_SESSION['loggedIn'] = false;
            throw new Exception('Impossible d\'accéder au BackOffice');
        }
    
    //PUBLIC FUNCTION DISCONNECT???

    }
}