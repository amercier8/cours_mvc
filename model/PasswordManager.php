<?php

require_once("model/Manager.php");

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
        //$hashedDbPassword is an array, we use the first and only result, which explains the $hashedDbPassword[0]
        if ((password_verify($userPassword,$hashedDbPassword[0]))) {
            $_SESSION['loggedIn'] = true;
        }
        else {
            $_SESSION['loggedIn'] = false;
        }
    }
}