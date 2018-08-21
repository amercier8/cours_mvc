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
        if($_SESSION['loggedIn'] === true) {
            var_dump($_SESSION['loggedIn']);
            require('view/backend/homepageView.php');
        }
        else {
            require('view/backend/loginView.php');
        }
    }

    public function verifyPassword($userPassword) {
        if($_SESSION['loggedIn'] === true) {
            var_dump($_SESSION['loggedIn']);
            require('view/backend/homepageView.php');
        }
        else {
            $passwordVerified = $this->passwordManager->verifyPassword($userPassword);
            if($_SESSION['loggedIn'] === true) {
                //$_SESSION['loggedIn'] = true;
                var_dump($_SESSION['loggedIn']);
                require('view/backend/homepageView.php');
            }
            else {
                //$_SESSION['loggedIn'] = false;
                var_dump($_SESSION['loggedIn']);
                throw new Exception('Impossible d\'accéder au BackOffice');
            }
        }
    }

    public function disconnect() {
        $_SESSION['loggedIn'] = false;
        //require('view/backend/loginView.php');
        require('view/backend/loginView.php');
    }

    //PUBLIC FUNCTION DISCONNECT???
}