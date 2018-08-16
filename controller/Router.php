<?php

require_once 'controller/frontend/frontend.php';
require_once 'controller/backend/backend.php';
require_once 'view/frontend/VueFrontend.php';
//require_once 'view/frontend/commentView.php';
//require_once 'view/frontend/listPostsView.php';
//require_once 'view/frontend/postView.php';

class Router {

    public function __construct() {
        $this->ctrlFrontend = new ctrlFrontend();
        //$this->ctrlBackend = new ctrlBackend();
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
                else if ($_GET['action'] == 'reportComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $this->ctrlFrontend->reportComment($_GET['id']);
                    }
                }
            }
            //TEST
            else if(isset($_GET['login'])) {
                var_dump($_GET['login']);
                $passTest = "koka";
                echo('Pass de base = '.$passTest. '<br />');
                $pass_hache = password_hash($passTest, PASSWORD_DEFAULT);
                echo $pass_hache. '<br />';

                $passConf = "koko";
                echo('Pass de conf = '.$passConf. '<br />');
                $pass_hache_confirmation = password_hash($passConf, PASSWORD_DEFAULT);
                echo $pass_hache_confirmation. '<br />';

                if (password_verify($passTest, $pass_hache_confirmation)) {
                    echo 'mdp OK';
                }
                else {
                    echo 'mdp KO';
                }

                $this->backend->loginBackOffice();
            }
            //TEST END
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