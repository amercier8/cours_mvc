<?php

require_once 'controller/frontend/frontend.php';
require_once 'controller/backend/backend.php';

class Router {

    public function __construct() {
        $this->ctrlFrontend = new ctrlFrontend();
        $this->ctrlBackend = new ctrlBackend();
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
                else if ($_GET['action'] == 'reportComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $this->ctrlFrontend->reportComment($_GET['id']);
                    }
                }

                elseif ($_GET['action'] == 'addPost') {
                    if (!empty($_POST['title']) && !empty($_POST['content']) && $_SESSION['loggedIn'] == true) {
                        $this->ctrlBackend->addPost($_POST['title'], $_POST['content']);
                    }
                    else {
                        throw new Exception('Il reste des éléments à renseigner');
                    }
                }

                else if($_GET['action'] == 'disconnect') {
                    $this->ctrlBackend->disconnect();
                }

                else if ($_GET['action'] == 'displayDashboard' && $_SESSION['loggedIn'] == true) {
                    $this->ctrlBackend->listPosts();
                }

                else if ($_GET['action'] == 'delete') {
                    if (isset($_GET['id']) && $_GET['id'] > 0 && $_SESSION['loggedIn'] == true) {
                        $this->ctrlBackend->deletePost($_GET['id']);
                    }
                    $this->ctrlBackend->listPosts();
                }

                elseif ($_GET['action'] == 'displayPost') {
                    if (isset($_GET['id']) && $_GET['id'] > 0 && $_SESSION['loggedIn'] == true) {
                        $this->ctrlBackend->displayPost($_GET['id']);
                    }
                }

                elseif ($_GET['action'] == 'modifyPost') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        //TODO : Je ne vérifie que si elles ne sont pas vides
                        if (!empty($_POST['title']) && !empty($_POST['content']) && $_SESSION['loggedIn'] == true) {
                            $this->ctrlBackend->modifyPost($_GET['id'], $_POST['title'], $_POST['content']);
                        }
                        else {
                            header('Location: index.php?action=displayPost&id=' .$_GET['id']);
                        }
                    }
                }

                elseif ($_GET['action'] == 'approveComment' && $_SESSION['loggedIn'] == true) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $this->ctrlBackend->removeReportComment($_GET['id']);
                        $this->ctrlBackend->approveComment($_GET['id']);
                    }
                }

                elseif ($_GET['action'] == 'disapproveComment' && $_SESSION['loggedIn'] == true) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $this->ctrlBackend->removeReportComment($_GET['id']);
                        $this->ctrlBackend->disapproveComment($_GET['id']);
                    }
                }
            }

            else if(isset($_GET['displayLogin'])) {
                    $this->ctrlBackend->displayLoginPage();
            }

            else if(isset($_GET['login'])) {
                $this->ctrlBackend->verifyPassword($_POST['psw']);
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