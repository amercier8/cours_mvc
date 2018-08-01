<?php
class Post {
    private $postId, $nickname, $password, $mail, $registration_date;

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
    public function setPostId($postId) {
        $this->postId = $postId;
    }

    public function setNickname($nicknme) {
        $this->nickname = $nickname;
    }
    public function setPassword($password) {
        $this->password = $password;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setRegistration_date($registration_date) {
        $this->registration_date = $registration_date;
    }

    //Getters
    public function getPostId() {
        return $this->postId;
    }

    public function getNickname() {
        return $this->nickname;
    }

    public function getpassword() {
        return $this->password;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getRegistration_date() {
        return $this->registration_date;
    }
}