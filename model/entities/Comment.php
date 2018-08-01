<?php
class Comment {
    private $postId;
    private $id, $author, $comment, $commentDate;

    //Function hydrate to add
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

    //constructor to add
    public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }

    //Setters
    //
    //Manque les contrôles sur les données
    //
    public function setId($id) {
        $this->id = $id;
    }

    public function setPostId($postId) {
        $this->postId = $postId;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }

    public function setCommentDate($commentDate) {
        $this->commentDate = $commentDate;
    }


    //Getters
    public function getPostId() {
        return $this->postId;
    }

    public function getId() {
        return $this->id;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getCommentDate() {
        return $this->commentDate;
    }


}