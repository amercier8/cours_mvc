<?php

require_once("model/Manager.php");
require_once("model/entities/Password.php");

class PasswordManager extends Manager
{
    private $hashedDbPassword, $hashedUserPassword;

    public function getHashedDbPassword()
    {
        $sql='SELECT content FROM password';
        $hashedDbPassword = $this->executeRequest($sql);

        return $hashedDbPassword->fetch();
    }

    public function verifyPassword($userPassword) {

        $hashedDbPassword = $this->getHashedDbPassword();

        /*
        $passwordContent = ['userPassword' => $userPassword, 'hashedDbPassword' => $hashedDbPassword[0]];
        $password = new Password($passwordContent);
        if ((password_verify($password->getUserPassword(), $password->getHashedDbPassword()))) {
            $_SESSION['loggedIn'] = true;
        }
        else {
            $_SESSION['loggedIn'] = false;
        }
        */

        if ((password_verify($userPassword,$hashedDbPassword[0]))) {
            $_SESSION['loggedIn'] = true;
        }
        else {
            $_SESSION['loggedIn'] = false;
        }
    }
}