<?php

class User {
    
    private $userID;
    private $username;
    private $password;
    private $sessionID;
    private $firstName;
    private $lastName;
    private $emailAddress;
    private $errorMessages;
    
    public function __construct($userID, $username, $password, $sessionID, $firstName, $lastName, $emailAddress) {
        $this->userID = $userID;
        $this->username = $username;
        $this->password = $password;
        $this->sessionID = $sessionID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->emailAddress = $emailAddress;
    }
    
    function getUserID() {
        return $this->userID;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getSessionID() {
        return $this->sessionID;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmailAddress() {
        return $this->emailAddress;
    }

    function getErrorMessages() {
        return $this->errorMessages;
    }

    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setSessionID($sessionID) {
        $this->sessionID = $sessionID;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setEmailAddress($emailAddress) {
        $this->emailAddress = $emailAddress;
    }

    function setErrorMessages($errorMessages) {
        $this->errorMessages = $errorMessages;
    }
    
}