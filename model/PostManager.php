<?php

require_once("model/Manager.php");
require_once("model/entities/Post.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date FROM posts ORDER BY id DESC';
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
        $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date FROM posts WHERE id = ?';
        $results = $this->executeRequest($sql, array($postId));
        if ($results->rowCount() == 1) {
            return new Post($results->fetch());  // Access to the first line of result
        }
        else {
            throw new Exception("Aucun Post ne correspond à cette recherche");
        }
    }

    public function deletePost($postId) {
        $sql = 'DELETE FROM posts WHERE id=?';
        $results = $this->executeRequest($sql, array($postId));
    }

    public function modifyPost($postId, $postTitle, $postContent) {
        $postArray = ['id' => $postId, 'title' => $postTitle, 'content' => $postContent];
        $post = new Post($postArray);

        $sql = 'UPDATE posts SET title=?, content=? WHERE id=?';
        $result = $this->executeRequest($sql, array($post->getTitle(), $post->getContent(), $post->getId()));
    }

    public function addPost($postTitle, $postContent) {
        $postArray = ['title' => $postTitle, 'content' => $postContent];
        $post = new Post($postArray);

        $sql = 'INSERT INTO posts(title, content) VALUES(?,?)';
        $this->executeRequest($sql, array($post->getTitle(), $post->getContent()));
    }
}