<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Draggable Tasks Test</title>
</head>

<body>
    <?php include('navbarView.php'); ?>
    <div class="boardInformation">
        <h2>Board Information: </h2>
        <!-- Call from databasse for each task under a project, add up all tasks hours in a loop, outputting it here -->
        <p>Calculated Hours: 55</p>
        <!-- Call from database looping to see how many users are assigned to this specific project -->
        <p>Users Working: 5</p>
        <!-- Algorithm assuming 8 hour work day, calculate how many hours there are with all tasks put together. Calculate days from that. Display date -->
        <p>Calculated Completion Date: April 7, 2020</p>
    </div>
    <div class="headerLayout">
        <div class="headerHolder">
            <div class="headers">
                <h1>Completed <span style="float: right">(0)</span></h1>
            </div>
        </div>
        <div class="headerHolder">
            <div class="headers">
                <h1>In Progress<span style="float: right">(0)</span></h1>
            </div>
        </div>
        <div class="headerHolder">
            <div class="headers">
                <h1><button id="btnAddTask" alt="Add another Task" style="float: left;">+</button>Incomplete<span
                        id="numIncomplete" style="float: right"></span></h1>
            </div>
        </div>
    </div>
    <div class="boardLayout">
        <div id="slot1" class="emptyBoards" ondrop="droptask(event)" ondragover="allowtaskDrop(event)">
        </div>
        <div id="slot2" class="emptyBoards" ondrop="droptask(event)" ondragover="allowtaskDrop(event)">

        </div>
        <div id="slot3" class="emptyBoards" ondrop="droptask(event)" ondragover="allowtaskDrop(event)">

        </div>
    </div>

    <!-- The Modal -->
    <div id="myPopupBox" class="popupBox">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="closeButton">&times;</span>
            <div class="insidePopupBox">
                <label>Task Name: </label><br>
                <input type="text"><br>
                <label>Task Description: </label><br>
                <textarea></textarea><br>
                <button>Save</button><br><br>

                <label>Claimed by: </label>
                <!-- Check if claimed in db, determined by a value of 0 or 1. -->
                <p>UNCLAIMED</p><br><br>
                <label>Claim this story?</label><br>
                <select id="userClaims">
                    <!-- Grab users from list of users in DB associated with this specific project number. Loop and display below -->
                    <?php
                        $users = UserEndpoint::getAllUsers();
                        foreach ($users as $user) {
                            echo '<option value="' . $user->getUserID() . '">' . $user->getFirstName() . " " . $user->getLastName() . "</option>";
                        }
                    ?>
                </select>
                <button>Claim</button><br>
            </div>
        </div>
    </div>
    <script src="js/taskBoard.js"></script>
</body>

</html>