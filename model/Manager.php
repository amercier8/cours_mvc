<?php

class Manager
{
    protected function executeRequest($sql, $params = null) {
        if ($params == null) {
            $result = $this->getBdd()->query($sql);    // Direct execution
        }
        else {
            $result = $this->getBdd()->prepare($sql);  //Prepared request
            $result->execute($params);
        }
    return $result;
    }

    
    private function getBdd() {
        if ($this->bdd == null) {

            $host_name = 'localhost';
            $database = 'blog';
            $user_name = 'root';
            $password = 'root';

            $this->bdd = new PDO("mysql:host=$host_name;dbname=$database;charset=utf8",
            $user_name, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
    return $this->bdd;
    }
}