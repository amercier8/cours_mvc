<?php


// Chargement des classes
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';
/*
///POO
class Frontend {

    //En l'état, ne sert à rien : il n'y a aucun setter créé à utiliser
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

    private function listPosts() {
        //$postManager = new \OpenClassrooms\Blog\Model\PostManager();
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        require('view/frontend/listPostsView.php');
    }

    private function post() {
    //$postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $postManager = new PostManager();
    //$commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
    }

    private function addComment($postId, $author, $comment) {
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

    private function displayComment($commentId) {
    //$commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager = new CommentManager();

    $comment = $commentManager->getComment($commentId);
    // Trouble shooting missing
    //with this function, we redirect to commentView.php and transmit the commentId
    require('view/frontend/commentView.php');
}

    private function modifyComment($commentId, $commentAuthor, $commentContent) {
    //$commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager = new CommentManager();

    //Modify idBillet - Rcupérer la valeur du return via $idBillet
    $idBillet = $commentManager->modifyComment($commentId, $commentAuthor, $commentContent);

    header('Location: index.php?action=post&id=' .$idBillet);
}

}

    //OOP
    */

function listPosts()
{
    //$postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $postManager = new PostManager();

    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    //$postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $postManager = new PostManager();
    //$commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
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

function displayComment($commentId)
{
    //$commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager = new CommentManager();

    $comment = $commentManager->getComment($commentId);
    // Trouble shooting missing
    //with this function, we redirect to commentView.php and transmit the commentId
    require('view/frontend/commentView.php');
}

function modifyComment($commentId, $commentAuthor, $commentContent)
{
    //$commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager = new CommentManager();

    //Modify idBillet - Rcupérer la valeur du return via $idBillet
    $idBillet = $commentManager->modifyComment($commentId, $commentAuthor, $commentContent);

    header('Location: index.php?action=post&id=' .$idBillet);
}
