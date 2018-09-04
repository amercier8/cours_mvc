<?php

require_once 'model/PasswordManager.php';
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';
require_once 'view/frontend/VueFrontend.php';

class ctrlBackend {

    private $passwordManager;
    private $postManager;

    public function __construct() {
        $this->passwordManager = new PasswordManager();
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }

    //WIP
    public function displayLoginPage() {
        //If Session OK, then directly rediredect to the Backend view
        if($_SESSION['loggedIn'] === true) {
            //var_dump($_SESSION['loggedIn']);
            header('Location: index.php?action=displayDashboard');
        }
        else {
            require('view/backend/loginView.php');
        }
    }

    public function verifyPassword($userPassword) {
        if($_SESSION['loggedIn'] === true) {
            //var_dump($_SESSION['loggedIn']);
            //A passer en header location via indexphp - rajouter une action = dashboard ; pour repasser par le routeur
            //require('view/backend/homepageView.php');
            header('Location: index.php?action=displayDashboard');
        }
        else {
            $passwordVerified = $this->passwordManager->verifyPassword($userPassword);
            if($_SESSION['loggedIn'] === true) {
                //var_dump($_SESSION['loggedIn']);
                header('Location: index.php?action=displayDashboard');
            }
            else {
                throw new Exception('Impossible d\'accéder au BackOffice');
            }
        }
    }

    public function disconnect() {
        $_SESSION['loggedIn'] = false;
        require('view/backend/loginView.php');
    }

    public function listPosts() {
        $posts = $this->postManager->getPosts();
        $comments = $this->commentManager->getAllComments();
        $commentSummary= array("postId"=>'',"numberOfReports"=>'');
        
        foreach ($comments as $comment):
            $postId = $comment->getPostId();
            //$report = $comment->getReport();
            //$numberOfReports = 0;

                
                    if ($comment->getReport() == true) {
                        if (!in_array($postId, $commentSummary)) {
                            $numberOfReports = $numberOfReports++;
                        //var_dump($numberOfReports);
                        
                            //$commentSummary[] = array('postId' => $postId);
                            $commentSummary['postId'.$postId] = $postId;
                        }
                    }
                
        endforeach;
        //$commentSummary2 = array_unique ($commentSummary);
        var_dump($commentSummary);
        //var_dump($commentSummary2);
        //var_dump($numberOfComments);
        require('view/backend/homepageView.php');
    }

    public function deletePost($postId) {
        $this->postManager->deletePost($postId);
    }

    public function displayPost($postId) {
        //TEST recup des coms signalés et en attente de com
        //$this->postManager->getReportedComments
        $post = $this->postManager->getPost($postId);
        //TEST
        $comments = $this->commentManager->getAllComments();
        require('view/backend/postView.php');
    }

    public function modifyPost($postId, $postTitle, $postContent) {
        $this->postManager->modifyPost($postId, $postTitle, $postContent);
        header('Location: index.php?action=displayDashboard');
    }

    public function addPost($postTitle, $postContent) {
        $affectedLines = $this->postManager->addPost($postTitle, $postContent);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le billet !');
        }
        else {
            header('Location: index.php?action=displayDashboard');
        }
    }

    public function approveComment($commentId) {
        $this->commentManager->approveComment($commentId);
        header('Location: index.php?action=displayDashboard');
    }

    public function disapproveComment($commentId) {
        $this->commentManager->disapproveComment($commentId);
        header('Location: index.php?action=displayDashboard');
    }

    //TO BE DONE
    /*
    public function countReportedComments($postId) {
        $reportedComments = $this->CommentManager->countReportedComments($postId);
        return $reportedComments;
        header('Location: index.php?action=displayDashboard');
    }
    */
}