<?php

//namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");
require_once("model/entities/Post.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5';
        $results = $this->executeRequest($sql);
        $posts = array();
        foreach ($results as $result) {
            $post = new Post($result);
            array_push($posts, $post);
        }
        return $posts;
    }

    public function getPost($postId)
    {
        $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date FROM posts WHERE id = ?';
        $results = $this->executeRequest($sql, array($postId));
        if ($results->rowCount() == 1) {
            return new Post($results->fetch());  // Accès à la première ligne de résultat
        }
        else {
            throw new Exception("Aucun Post ne correspond à cette recherche");
        }

        return $post;
    }

    public function deletePost($postId) {
        $sql = 'DELETE FROM posts WHERE id=?';
        $results = $this->executeRequest($sql, array($postId));
    }

    public function modifyPost($postId, $postTitle, $postContent) {
        $postArray = ['id' => $postId, 'title' => $postTitle, 'content' => $postContent];
        $post = new Post($postArray);
        //var_dump($post);

        $sql = 'UPDATE posts SET title=?, content=? WHERE id=?';
        $result = $this->executeRequest($sql, array($post->getTitle(), $post->getContent(), $post->getId()));

    }
}