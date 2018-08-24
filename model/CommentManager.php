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
        //$sql contains the sql request
        $sql = 'SELECT id, author, comment, report, post_id AS postId, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS commentDate FROM comments WHERE post_id = ? ORDER BY comment_date DESC';
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
        $sql = 'SELECT id, author, comment, report, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS commentDate FROM comments WHERE id = ? ORDER BY comment_date DESC';
        $results = $this->executeRequest($sql, array($commentId));
        if ($results->rowCount() == 1) {
            return new Comment($results->fetch());
        }
        else {
            throw new Exception ('Aucun commentaire ne correspond');
        }
    }

    //modify a comment & return its post_id
    public function modifyComment($commentId, $commentAuthor, $commentContent)
    {

        //TESTS
        //Update the comment itself
        //Sets the report to false, as the content of the comment has been modified and needs to be reviewed again
        $commentArray = ['id' => $commentId, 'author' => $commentAuthor, 'comment' => $commentContent, 'report' => false];
        $comment = new Comment($commentArray);

        $sqlUpdate = 'UPDATE comments SET author=?, comment=?, report=? WHERE id=?';
        $result = $this->executeRequest($sqlUpdate, array($comment->getAuthor(), $comment->getComment(), $comment->getReport(), $comment->getId()));

        $sqlSelect = 'SELECT post_id FROM comments WHERE id = ?';
        $result = $this->executeRequest($sqlSelect, array($comment->getId()));
        $result = $result->fetch();

        return $result['post_id'];
    }

    //report a comment
    public function reportComment($commentId) {
        $commentContent = ['report' => true, 'id' => $commentId];
        $comment = new Comment($commentContent);
        $sql = 'UPDATE comments SET report=? WHERE id=?';
        $result = $this->executeRequest($sql, array($comment->getReport(), $comment->getId()));

        $sqlSelect = 'SELECT post_id FROM comments WHERE id = ?';
        $result = $this->executeRequest($sqlSelect, array($comment->getId()));
        $result = $result->fetch();
        return $result['post_id'];
    }

    //Retrieve all comments (To be used by the Dashboard view)
    //Really usefull??
    public function getAllComments() {
        $sql = 'SELECT id, post_id AS postId, author, comment, report, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS commentDate FROM comments ORDER BY comment_date DESC LIMIT 0, 5';
        $results = $this->executeRequest($sql);
        $comments = array();
        foreach ($results as $result) {
            $comment = new Comment($result);
            array_push($comments, $comment);
        }
        return $comments;
    }    
}