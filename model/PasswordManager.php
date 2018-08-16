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
        return $hashedDbPassword;
        //$this->hashedDbPassword = new Password($result);
    }

    /*
    public function getHashedUserPassword($userPassword) {
        $this->hashedUserPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    }*/

    public function verifyPassword($userPassword) {
        $this->hashedDbPassword=getHashedDbPassword();
        $password = new Password($hashedDbPassword, $userPassword);
        if ((password_verify($password->getUserPassword(), $password->getHashedDbPassword))) {
            echo 'OK';
        }
        else {
            echo 'KO';
        }
    }
}