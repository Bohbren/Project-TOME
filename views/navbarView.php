<nav class="navbar navbar-inverse" style="background-color:rgb(17, 17, 17);">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php?action=GET_HOME" style="color:white;">TOME</a>
            </div>
            <ul class="nav navbar-nav">
                <?php if(isset($_SESSION["sessionid"])) {
                    $user = UserEndpoint::getUserBySessionId($_SESSION["sessionid"]);?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" href="#" aria-expanded="false" aria-haspopup="true"><?php echo $user->getUsername(); ?></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?action=GET_PROFILE">Profile</a>
                            <a class="dropdown-item" href="index.php?action=GET_LOGOUT">Logout</a>
                        </div>
                    </li>
                <?php } ?>
                <li class="item"><a href="index.php?action=taskBoard">Task Board</a></li>
                        <li class="item"><a href="index.php?action=GET_LOGIN">Login</a></li>
                        <li class="item"><a href="index.php?action=GET_SIGNUP">Register</a></li>
                    </ul>
         
                </li>
          
            </ul>
        </div>
    </nav>
