<?php

require_once 'User.php';
require_once 'database.php';

class UserEndpoint {
    
    public static function login($username, $password) {
        $query = "SELECT * FROM userinfo WHERE `username` = @username AND `password` = @password";
        $stmt = Database::getDB()->prepare($query);
        $stmt->bindValue("@username", $username);
        $stmt->bindValue("@password", $password);
        $stmt->execute();
        //TODO: check if we get results back, if so update the session id for the user we get back
    }
    
    public static function createUser($user) {
        $query = "INSERT INTO userinfo(`username`, `password`, sessionID, firstName, lastName, emailAddress) VALUES (:username, :password, :sessionid, :firstname, :lastname, :email)";
        $stmt = Database::getDB()->prepare($query);
        $stmt->bindValue(":username", $user->getUsername());
        $stmt->bindValue(":password", $user->getPassword());
        $stmt->bindValue(":sessionid", $user->getSessionID());
        $stmt->bindValue(":firstname", $user->getFirstName());
        $stmt->bindValue(":lastname", $user->getLastName());
        $stmt->bindValue(":email", $user->getEmailAddress());
        $stmt->execute();
    }
    
}