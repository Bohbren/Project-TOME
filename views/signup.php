<?php include 'header.php';?>

<div class="container">
    <?php if(isset($user)) {
        if($user->getErrorMessages() != null) {
            foreach($user->getErrorMessages() as $err) {
                echo '<p>' . $err . "</p>";
            }
        }
    } ?>
    <form method="post" action="?action=POST_SIGNUP">
        <table>
            <tr>
                <td>
                    <label for="txtUsername">Username:</label>
                </td>
                <td>
                    <input type="text" name="txtUsername" id="txtUsername"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="txtPassword">Password:</label>
                </td>
                <td>
                    <input type="password" name="txtPassword" id="txtPassword"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="txtFirstName">First Name:</label>
                </td>
                <td>
                    <input type="text" name="txtFirstName" id="txtFirstName"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="txtLastName">Last Name:</label>
                </td>
                <td>
                    <input type="text" name="txtLastName" id="txtLastName"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="txtEmailAddress">Email Address:</label>
                </td>
                <td>
                    <input type="email" name="txtEmailAddress" id="txtEmailAddress"/>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type="submit" value="Sign Up"/>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include 'footer.php'?>