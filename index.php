<?php
//Controller for the application holding case statements that 
//navigate you to the different pages of the website

//Required Model files
require_once('models/controllerSecurity.php');
require_once("models/database.php");
require_once('models/User.php');
require_once('models/UserEndpoint.php');
require_once 'validation/validation.php';


//Sets the cookie for the session
$lifetime = 60 * 60 * 24 * 14; //Two weeks
session_set_cookie_params($lifetime);
session_start();

//Session variables that contain information for current use
if (empty($_SESSION['user'])) {
    $_SESSION['user'] = "";
}

//Defines the action statement used for the switch statement - and then takes you to 
//the desired page
$action = filter_input(INPUT_POST, "action");

//Checks if the action variable is null - if it is, go back to home page view
if ($action == NULL) {
    $action = filter_input(INPUT_GET, "action");
    if ($action == NULL) {
        $action = "GET_HOME";
    }
}

//Switch statement containing actions that take you to different views of the site.
switch ($action) {
    case 'GET_HOME':
        $datab = Database::getDB();
        include("views/homeView.php");
        die();
        break;
    case 'cardTest':
        include("views/cardTestView.php");
        die();
        break;
    case 'GET_LOGIN':
        include("views/login.php");
        die();
        break;
    case 'POST_LOGIN':
        //TODO: add login validation here, if success return to homepage. nav should update automatically
        break;
    case 'GET_SIGNUP':
        include("views/signup.php");
        die();
        break;
    case 'POST_SIGNUP':
        //TODO: add validation here, if success give the user a session id and return them to homepage
        $username = filter_input(INPUT_POST, "txtUsername");
        $password = filter_input(INPUT_POST, "txtPassword");
        $firstName = filter_input(INPUT_POST, "txtFirstName");
        $lastName = filter_input(INPUT_POST, "txtLastName");
        $emailAddress = filter_input(INPUT_POST, "txtEmailAddress");
        $errorMessages = array();
        $sessionid = session_id();
        $user = new User(null, $username, $password, $sessionid, $firstName, $lastName, $emailAddress);
        if(!validation::textboxNotEmpty($username)) {
            array_push($errorMessages, "Username cannot be empty");
        }
        if(!validation::isValidPassword($password)) {
            array_push($errorMessages, "Password was not valid. Must be at least 8 characters.");
        }
        if(!validation::textboxNotEmpty($firstName)) {
            array_push($errorMessages, "First name is required");
        }
        if(!validation::textboxNotEmpty($lastName)) {
            array_push($errorMessages, "Last name is required");
        }
        if(!validation::isValidEmail($emailAddress)) {
            array_push($errorMessages, "Email address not valid");
        }
        //if we have errors don't create the user
        if(count($errorMessages) > 0) {
            $user->setErrorMessages($errorMessages);
            include("views/signup.php");
        } else {           
            UserEndpoint::createUser($user);
            $_SESSION["sessionid"] = $sessionid;
            include("views/homeView.php");
        }
        die();
        break;
     case 'chat':
        include("views/chat.php");
        die();
        break;
}
?>