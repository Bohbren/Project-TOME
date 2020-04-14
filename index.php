<?php
//Controller for the application holding case statements that 
//navigate you to the different pages of the website

//Required Model files
require_once('models/controllerSecurity.php');
require_once("models/database.php");


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
}
?>