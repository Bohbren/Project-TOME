<?php

require_once 'User.php';
require_once 'database.php';

class UserEndpoint {
    
    public static function login($username, $password) {
        $query = "SELECT `password` FROM userinfo WHERE `username` = :usn";
        $stmt = Database::getDB()->prepare($query);
        $stmt->bindValue(":usn", $username);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) > 0) {
            $user = $result[0];
            if($password == $user["password"]) {
                unset($_SESSION["sessionid"]);
                $_SESSION["sessionid"] = uniqid("", true);
                self::updateSessionId($username, $_SESSION["sessionid"]);
                $stmt->closeCursor();
                return true;
            }
        }
        $stmt->closeCursor();
        return false;
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
        $stmt->closeCursor();
    }
    
    public static function updateSessionId($username, $sessionid) {
        $db = Database::getDB();
        $query = "UPDATE userinfo SET sessionID = :session WHERE `username` = :user";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":session", $sessionid);
        $stmt->bindValue(":user", $username);
        $stmt->execute();
        $stmt->closeCursor();
    }
    
    public static function getUserBySessionId($sessionid) {
        $query = "SELECT * FROM userinfo WHERE `sessionID` = :sess";
        $db = Database::getDB();
        $stmt = $db->prepare($query);
        $stmt->bindValue(":sess", $sessionid);
        $stmt->execute();
        $results = $stmt->fetchAll();
        if(!empty($results)) {
            $u = $results[0];
            $user = new User($u["userID"], $u["username"], "", $sessionid, $u["firstName"], $u["lastName"], $u["emailAddress"]);
            return $user;
        }
        return null;
    }
    
    public static function getAllUsers() {
        $query = "SELECT * FROM userinfo";
        $db = Database::getDB();
        $stmt = $db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $users = array();
        foreach ($results as $u) {
            $user = new User($u["userID"], $u["username"], "", null, $u["firstName"], $u["lastName"], $u["emailAddress"]);
            array_push($users, $user);
        }
        return $users;
    }
    
}