<?php


// Chargement des classes
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';

///POO
class ctrlFrontend {

    private $comment, $post;

    public function __construct() {
        //$this->comment = new Comment();
        //$this->post = new Post();
    }

    public function listPosts() {
        //$postManager = new \OpenClassrooms\Blog\Model\PostManager();
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        require('view/frontend/listPostsView.php');
    }

    public function post() {
    //$postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $postManager = new PostManager();
    //$commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
    }

    public function addComment($postId, $author, $comment) {
    //$commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

    public function displayComment($commentId) {
    //$commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager = new CommentManager();

    $comment = $commentManager->getComment($commentId);
    // Trouble shooting missing
    //with this function, we redirect to commentView.php and transmit the commentId
    require('view/frontend/commentView.php');
}

    public function modifyComment($commentId, $commentAuthor, $commentContent) {
    //$commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager = new CommentManager();

    //Modify idBillet - Rcupérer la valeur du return via $idBillet
    $idBillet = $commentManager->modifyComment($commentId, $commentAuthor, $commentContent);

    header('Location: index.php?action=post&id=' .$idBillet);
}

}