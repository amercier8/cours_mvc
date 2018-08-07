<?php

//Revoir le concept de namespace en profondeur
//namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");
require_once("model/entities/Comment.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        //OOP VERSION OF THE METHOD
        //Connexion to the DB
        $db = $this->dbConnect();
        //$sql contains the sql request
        $sql = 'SELECT id, author, comment, post_id AS postId, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS commentDate FROM comments WHERE post_id = ? ORDER BY comment_date DESC';
        //Usage of the execute request method, contained in the Manager
        $results = $this->executeRequest($sql, array($postId));
        //Creation of an empty array which is filled with the db data
        $comments = array();
        foreach ($results as $result) {
            $comment = new Comment($result);
            array_push($comments, $comment);
        }

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        //Creation of an array containing the method parameters
        $commentContent = ['postId' => $postId, 'author' => $author, 'comment' => $comment];
        //Creation of a new Comment object
        $comment = new Comment($commentContent);
        $sql = 'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())';
        //Adding the content of the object newly created to the DB
        $comment = $this->executeRequest($sql, array($comment->getPostId(), $comment->getAuthor(), $comment->getComment() ));
    }
    
    //Get a specific comment to display
    public function getComment($commentId)
    {

        //TESTS
        //TO BE REMOVED?
        $db = $this->dbConnect();
        $sql = 'SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ? ORDER BY comment_date DESC';
        $results = $this->executeRequest($sql, array($commentId));
        if ($results->rowCount() == 1) {
            return new Comment($results->fetch());
        }
        else {
            throw new Exception ('Aucun commentaire ne correspond');
        }

        return $comment;

    }

    //modify a comment & return its post_id
    public function modifyComment($commentId, $commentAuthor, $commentContent)
    {

        //TESTS
        //Update the comment itself
        $commentArray = ['id' => $commentId, 'author' => $commentAuthor, 'comment' => $commentContent];
        $comment = new Comment($commentArray);

        $db = $this->dbConnect();
        $sqlUpdate = 'UPDATE comments SET author=? ,comment=? WHERE id=?';
        $result = $this->executeRequest($sqlUpdate, array($comment->getAuthor(), $comment->getComment(), $comment->getId()));

        $sqlSelect = 'SELECT post_id FROM comments WHERE id = ?';
        $result = $this->executeRequest($sqlSelect, array($comment->getId()));

        return $result;

    }
}