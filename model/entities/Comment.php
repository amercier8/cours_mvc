<?php
class Comment {
    private $postId;
    private $id, $author, $comment, $commentDate;

    private $status;
    //I set a default value of false to $report. It will only be changed if a user concretely reports the comment
    private $report;

    //Function hydrate to add
    public function hydrate (array $data) {
        foreach ($data as $key => $value) {
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
    public function __construct(array $data) {
        $this->hydrate($data);
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

    public function setStatus($status) {
        $statuses = array("pending", "disapproved", "approved");
        if (in_array($status, $statuses)) {
            $this->status = $status;
        }
    }

    public function setReport($report) {
        //if (is_bool) doesn't seem to work...
            $this->report = $report;
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

    public function getStatus() {
        return $this->status;
    }

    public function getReport() {
        return $this->report;
    }
}