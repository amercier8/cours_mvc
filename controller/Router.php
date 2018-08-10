<?php

require_once 'controler/frontend.php';
require_once '/view/frontend/commentView.php';
require_once '/view/frontend/listPostsView.php';
require_once '/view/frontend/postView.php';

class Router {
    public function hydrate (array $donnees) {
        foreach ($donnees as $key => $value) {
            // get the "setter" name corresponding to the attribute
            $method = 'set'.ucfirst($key);
            //Boolean test on the $method parameter
            if (method_exists($this, $method)) {
                //$method being the name of the parameter to set
                $this->$method($value);
            }
        }
    }

    public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }

    public function routRequest() {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'listPosts') {
                    listPosts();
                }
                elseif ($_GET['action'] == 'post') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        post();
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }
                elseif ($_GET['action'] == 'addComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                            addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                        }
                        else {
                            throw new Exception('Tous les champs ne sont pas remplis !');
                        }
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }
                elseif ($_GET['action'] == 'displayComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        displayComment($_GET['id']);
                    }
                }
                elseif ($_GET['action'] == 'modifyComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        //TODO : Je ne vérifie que si elles ne sont pas vides
                        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                            modifyComment($_GET['id'], $_POST['author'], $_POST['comment']);
                        }
                        else {
                            header('Location: index.php?action=displayComment&id=' .$_GET['id']);
                        }
                    }
                }
            }  
            else {
                listPosts();
            }
        }
        catch(Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}


?>