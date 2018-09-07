<?php


// Chargement des classes
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';
require_once 'view/frontend/VueFrontend.php';

///POO
class ctrlFrontend {

    private $commentManager, $postManager;

    public function __construct() {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }

    public function listPosts() {
        $posts = $this->postManager->getPosts();
        require('view/frontend/listPostsView.php');
    }

    public function post() {
        $post = $this->postManager->getPost($_GET['id']);
        $comments = $this->commentManager->getComments($_GET['id']);

        require('view/frontend/postView.php');
    }

    public function addComment($postId, $author, $comment) {
        $affectedLines = $this->commentManager->postComment($postId, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }

    public function displayComment($commentId) {
        $comment = $this->commentManager->getComment($commentId);
        //with this function, we redirect to commentView.php and transmit the commentId
        require('view/frontend/commentView.php');
    }

    public function reportComment($comment) {
        $postId = $this->commentManager->reportComment($comment);
        
        header('Location: index.php?action=post&id=' .$postId);
    }
}