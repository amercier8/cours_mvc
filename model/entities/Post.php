<?php
class Post {
    private $id, $title, $content, $creation_date;

    //Hydrate
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

    //Constructor
    public function __construct(array $data) {
        $this->hydrate($data);
    }

    //Setters
    //Data controls missing, TO DO
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setCreation_date($creation_date) {
        $this->creation_date = $creation_date;
    }


    //Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCreation_date() {
        return $this->creation_date;
    }
}