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
    }

    public function verifyPassword($userPassword) {

        $result = $this->getHashedDbPassword();
        $hashedDbPassword = $result->fetch();

        $passwordContent = ['userPassword' => $userPassword, 'hashedDbPassword' => $hashedDbPassword[0]];
        $password = new Password($passwordContent);
        if ((password_verify($password->getUserPassword(), $password->getHashedDbPassword()))) {
            echo 'OK';
            return true;
        }
        else {
            echo 'KO';
            return false;
        }
    }
}