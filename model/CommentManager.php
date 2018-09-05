<?php

require_once("model/Manager.php");
require_once("model/entities/Comment.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        //OOP VERSION OF THE METHOD
        //$sql contains the sql request
        $sql = 'SELECT id, author, comment, report, status, post_id AS postId, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS commentDate FROM comments WHERE post_id = ? ORDER BY comment_date DESC';
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
        $sql = 'SELECT id, author, comment, report, status, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS commentDate FROM comments WHERE id = ? ORDER BY comment_date DESC';
        $results = $this->executeRequest($sql, array($commentId));
        if ($results->rowCount() == 1) {
            return new Comment($results->fetch());
        }
        else {
            throw new Exception ('Aucun commentaire ne correspond');
        }
    }

    public function reportComment($commentId) {
        //First Update the comment, to set its "report" property to true
        $commentContent = ['report' => true, 'id' => $commentId];
        $comment = new Comment($commentContent);
        $sql = 'UPDATE comments SET report=? WHERE id=?';
        $result = $this->executeRequest($sql, array($comment->getReport(), $comment->getId()));

        //Second, Select the Post on which the comment is linked to return it
        $sqlSelect = 'SELECT post_id FROM comments WHERE id = ?';
        $result = $this->executeRequest($sqlSelect, array($comment->getId()));
        $result = $result->fetch();
        return $result['post_id'];
    }

    //Retrieve all comments (To be used by the Dashboard view)
    public function getAllComments() {
        //Si Signalé et pas modéré, en 1er ; ensuite les non signalés en attente de modération ; ensuite le reste par date.
        //Attention : ne sert à rien car on n'affiche pas tous les commentaires d'un coup mais seulement ceux du post
        $sql = 'SELECT id, post_id AS postId, author, comment, status, report, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS commentDate FROM comments
        ORDER BY
            CASE
                WHEN report=1 AND status="pending" THEN report
            END DESC,
            CASE
                WHEN report!=1 AND status="pending" THEN status
            END DESC,
        comment_date DESC';
        $results = $this->executeRequest($sql);
        $comments = array();
        foreach ($results as $result) {
            $comment = new Comment($result);
            array_push($comments, $comment);
        }
        return $comments;
    }
    //By default, a newly created comment has its "status" property set to "pending". This is configured in the DB directly
    public function approveComment($commentId) {
        $commentContent = ['status' => 'approved', 'id' => $commentId];
        $comment = new Comment($commentContent);
        $sql = 'UPDATE comments SET status=? WHERE id=?';
        $this->executeRequest($sql, array($comment->getStatus(), $comment->getId()));

        //Second, Select the Post on which the comment is linked to return it
        $sqlSelect = 'SELECT post_id FROM comments WHERE id = ?';
        $result = $this->executeRequest($sqlSelect, array($comment->getId()));
        $result = $result->fetch();
        return $result['post_id'];
    }

    public function disapproveComment($commentId) {
        $commentContent = ['status' => 'disapproved', 'id' => $commentId];
        $comment = new Comment($commentContent);
        $sql = 'UPDATE comments SET status=? WHERE id=?';
        $this->executeRequest($sql, array($comment->getStatus(), $comment->getId()));
        
        //Second, Select the Post on which the comment is linked to return it
        $sqlSelect = 'SELECT post_id FROM comments WHERE id = ?';
        $result = $this->executeRequest($sqlSelect, array($comment->getId()));
        $result = $result->fetch();
        return $result['post_id'];
    }

    public function removeReportComment($commentId) {
        $commentContent = ['report' => 0, 'id' => $commentId];
        $comment = new Comment($commentContent);
        $sql = 'UPDATE comments SET report=? WHERE id=?';
        $this->executeRequest($sql, array($comment->getReport(), $comment->getId()));
    }

}