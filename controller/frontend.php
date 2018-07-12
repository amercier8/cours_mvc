<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

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
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $comment = $commentManager->getComment($commentId);
    // Trouble shooting missing
    //with this function, we redirect to commentView.php and transmit the commentId
    require('view/frontend/commentView.php');
}

function modifyComment($commentId, $commentAuthor, $commentContent)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    /*$comment = */$commentManager->modifyComment($commentId, $commentAuthor, $commentContent);

    header('Location: index.php');
}