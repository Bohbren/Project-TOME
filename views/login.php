<?php include 'header.php'; ?>
<div class="container">
    <?php
        if(isset($errorMsg)) {
            echo '<p>' . $errorMsg . "</p>";
        }
    ?>
    <form method="post" action="?action=POST_LOGIN">
        <table>
            <tr>
                <td>
                    <label for="txtUsername">Username:</label>
                </td>
                <td>
                    <input type="text" id="txtUsername" name="txtUsername"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="txtPassword">Password:</label>
                </td>
                <td>
                    <input type="password" id="txtPassword" name="txtPassword"/>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type="submit" value="Login"/>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php include 'footer.php';?>