<nav class="navbar navbar-inverse" style="border-radius: 0px!important; background-color:rgb(17, 17, 17);">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <a class="navbar-brand" href="index.php?action=GET_HOME" style="color:white;">TOME</a>
            <?php
            if(isset($_SESSION["sessionid"])) {
                ?>
            <li><a href="index.php?action=GET_HOME" class="menuButtons">HOME</a></li>
            <li><a href="index.php?action=taskBoard">Task Board</a></li>
            <?php
            if(isset($_SESSION["user"])) {
                ?>
            <li><a href="index.php?action=chat">Chat</a></li>
            <?php }
            ?>
            </li>
            <?php } else { ?>
            <li><a href="index.php?action=GET_HOME" class="menuButtons">HOME</a></li>
            <?php }
            ?>
        </ul>
        
        
        <ul class="nav navbar-nav navbar-right">
             <?php
            if(isset($_SESSION["sessionid"])) {
                ?>
            <?php
            $user = UserEndpoint::getUserBySessionId($_SESSION["sessionid"]);
            //If the player is logged in it will display their name to go to their profile, if not logged in it
            //displays an option to register or login.
            if ($_SESSION["sessionid"] === "" || $user->getUsername() === NULL) {
                ?>
            <li><a href="index.php?action=GET_SIGNUP" class="menuButtons">Register</a></li>
            <li><a href="index.php?action=GET_LOGIN" class="menuButtons">Login</a></li>
            <?php } else { 
                $user = UserEndpoint::getUserBySessionId($_SESSION["sessionid"]);?>
            <li><a
                    href="index.php?action=GET_PROFILE"><?php echo controllerSecurity::xecho(strtoupper($user->getUsername())); ?></a>
            </li>
            <li><a href="index.php?action=GET_LOGOUT" class="menuButtons">Logout</a></li>
            <?php }
                ?>
            <?php } else { ?>
           <li><a href="index.php?action=GET_SIGNUP" class="menuButtons">Register</a></li>
            <li><a href="index.php?action=GET_LOGIN" class="menuButtons">Login</a></li>
             <?php }
            ?>
        </ul>
    </div>
</nav>