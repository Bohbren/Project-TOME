<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php?action=GET_HOME"">TOME</a>
            </div>
            <ul class="nav navbar-nav">
                <?php if(isset($_SESSION["sessionid"])) {
                    $user = UserEndpoint::getUserBySessionId($_SESSION["sessionid"]);?>
                    <li class="item">
                        <a class="navbar-brand" href="#"><?php echo $user->getUsername(); ?></a>
                    </li>
                <?php } ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Login/Register<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?action=GET_LOGIN">Login</a></li>
                        <li><a href="index.php?action=GET_SIGNUP">Register</a></li>
                    </ul>
                </li>
                <li><a href="index.php?action=taskBoard">Task Board</a></li>
                <li><a href="index.php?action=chat">Chat</a></li>
                <li><a href="index.php?action=calendar">Calendar</a></li>
            </ul>
        </div>
    </nav>
