<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");
require_once("model/entities/Post.php");

class PostManager extends Manager
{
    public function getPosts()
    {

        //TESTS
        //Connexion to the DB
        /*
        $db = $this->dbConnect();
        //$sql contains the SQL request
        $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5';
        //Usage of the execute request method, contained in the Manager
        $results = $this->executeRequest($sql);
        $posts = array();
        foreach($results as $result) {
            $post = new Post($result);
            array_push($posts, $post);
        }
        */
        //FIN DES TESTS
        
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');
        
        return $posts;
    }

    public function getPost($postId)
    {
        /*
        $db = $this->dbConnect();
        $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?';
        $results = $this->executeRequest($sql);
        $posts = array();
        foreach ($results as $result) {
            $post = new Post($result);
            array_push($posts, $post);
        }
        */
        
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        
        return $post;
    }
}