<?php
class Password {
    private $hashedDbPassword, $userPassword;

    public function hydrate (array $data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            //Boolean test on the $method parameter
            if (method_exists($this, $method)) {
                //$method being the name of the parameter to set
                $this->$method($value);
            }
        }
    }

    public function __construct(array $data) {
        $this->hydrate($data);
    }

    //SETTERS
    public function sethashedDbPassword($hashedDbPassword) {
            $this->hashedDbPassword = $hashedDbPassword;
    }

    public function setUserPassword($userPassword) {
        if (is_string($userPassword)) {
            $this->userPassword = $userPassword;
        }
    }

    //GETTERS
    public function getHashedDbPassword() {
        return $this->hashedDbPassword;
    }

    public function getUserPassword() {
        return $this->userPassword;
    }

}