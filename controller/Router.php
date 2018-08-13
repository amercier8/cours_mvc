<?php

require_once 'controller/frontend/frontend.php';
require_once 'view/frontend/VueFrontend';
//require_once 'view/frontend/commentView.php';
//require_once 'view/frontend/listPostsView.php';
//require_once 'view/frontend/postView.php';

class Router {

    public function __construct() {
        $this->ctrlFrontend = new ctrlFrontend();
    }

    public function routRequest() {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'listPosts') {
                    $this->ctrlFrontend->listPosts();
                }
                elseif ($_GET['action'] == 'post') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $this->ctrlFrontend->post();
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }
                elseif ($_GET['action'] == 'addComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                            $this->ctrlFrontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
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
                        $this->ctrlFrontend->displayComment($_GET['id']);
                    }
                }
                elseif ($_GET['action'] == 'modifyComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        //TODO : Je ne vérifie que si elles ne sont pas vides
                        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                            $this->ctrlFrontend->modifyComment($_GET['id'], $_POST['author'], $_POST['comment']);
                        }
                        else {
                            header('Location: index.php?action=displayComment&id=' .$_GET['id']);
                        }
                    }
                }
            }  
            else {
                $this->ctrlFrontend->listPosts();
            }
        }
        catch(Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}


?>