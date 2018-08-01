<?php

namespace OpenClassrooms\Blog\Model;

class Manager
{

    private $bdd;

    //TO BE REMOVED AT SOME POINT
    
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=tests;charset=utf8', 'root', 'root');
        return $db;
    }
    
    //

    protected function executeRequest($sql, $params = null) {
        if ($params == null) {
            $result = $this->getBdd()->query($sql);    // exécution directe
        }
        else {
            $result = $this->getBdd()->prepare($sql);  // requête préparée
            $result->execute($params);
        }
    return $result;
    }

    private function getBdd() {
        if ($this->bdd == null) {
        // Création de la connexion
            $this->bdd = new PDO('mysql:host=localhost;dbname=tests;charset=utf8',
            'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
    var_dump($this->bdd);
    return $this->bdd;
    }
}