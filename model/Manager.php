<?php

class Manager
{

    private $bdd;
    
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
        return $db;
    }

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
        //Connexion creation
            $this->bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8',
            'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
    return $this->bdd;
    }
}