<nav class="navbar navbar-inverse" style="background-color:rgb(17, 17, 17);">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php?action=GET_HOME" style="color:white;">TOME</a>
            </div>
            <ul class="nav navbar-nav">
                <?php if(isset($_SESSION["sessionid"])) {
                    $user = UserEndpoint::getUserBySessionId($_SESSION["sessionid"]);?>
                    <li class="item">
                        <a class="navbar-brand" href="#"><?php echo $user->getUsername(); ?></a>
                    </li>
                <?php } ?>
                <li><a href="index.php?action=chat" style="color:white;">Chat</a></li>
                <li><a href="index.php?action=calendar" style="color:white;">Calendar</a></li>
                <li><a href="index.php?action=taskBoard" style="color:white;">Task Board</a></li>
                <li><a href="index.php?action=chat" style="color:white;">Chat</a></li>
                        <li><a href="index.php?action=GET_LOGIN">Login</a></li>
                        <li><a href="index.php?action=GET_SIGNUP">Register</a></li>
                    </ul>
         
                </li>
          
            </ul>
        </div>
    </nav>
