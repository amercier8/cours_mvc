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
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }
    
    //Get a specific comment to display
    public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ? ORDER BY comment_date DESC');
        $req->execute(array($commentId));
        
        $toto = $req->fetch();

        return $toto;
    }

    //modify a comment & return its post_id
    public function modifyComment($commentId, $commentAuthor, $commentContent)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET author=? ,comment=? WHERE id=?');
        $req->execute(array($commentAuthor, $commentContent, $commentId));


        $getCommentInfos = $db->prepare('SELECT post_id FROM comments WHERE id = ?');
        $getCommentInfos->execute(array($commentId));
        $tata = $getCommentInfos->fetch();

        return $tata;
    }
}