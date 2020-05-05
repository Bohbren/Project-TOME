<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Task Board</title>
</head>

<body>
<?php 

$usercount = count(UserEndpoint::getAllUsers());

include('navbarView.php'); ?>
    <div class="boardInformation">
        <h2>Board Information: </h2>
        <!-- Call from databasse for each task under a project, add up all tasks hours in a loop, outputting it here -->
        <p>Calculated Hours: 55

        </p>
        <!-- Call from database looping to see how many users are assigned to this specific project -->
        <p>Users Working: <?php echo $usercount; ?></p>
        <!-- Algorithm assuming 8 hour work day, calculate how many hours there are with all tasks put together. Calculate days from that. Display date -->
        <p>Calculated Completion Date: April 7, 2020</p>        

    </div>
    <div class="headerLayout">
        <div class="headerHolder">
            <div class="headers">
                <h1>Complete<span id="numComplete" style="float: right"></span></h1>
            </div>
        </div>
        <div class="headerHolder">
            <div class="headers">
                <h1>In Progress<span id="numInProgress" style="float: right"></span></h1>
            </div>
        </div>
        <div class="headerHolder">
            <div class="headers">
                <h1><button id="btnAddTask" alt="Add another Task" style="float: left;"
                        onClick="openCreateTask(event)">+</button>Incomplete<span id="numIncomplete"
                        style="float: right"></span></h1>
            </div>
        </div>
    </div>
    <div class="boardLayout">
        <div id="slot1" class="emptyBoards" ondrop="droptask(event)" ondragover="allowtaskDrop(event)"></div>
        <div id="slot2" class="emptyBoards" ondrop="droptask(event)" ondragover="allowtaskDrop(event)"></div>
        <div id="slot3" class="emptyBoards" ondrop="droptask(event)" ondragover="allowtaskDrop(event)"></div>
    </div>

    <!-- The popup box that allows you to edit tasks -->
    <div id="editTaskBox" class="editTaskBox">
        <!-- task content -->
        <div class="editTaskBox-content"> <span class="closeButton">&times;</span>
            <div class="insideEditTaskBox">
                <h2>EDIT TASK</h2>
                <div class="taskRow">
                    <div class="taskColumn">
                        <label>Task Description: <span style="color:red;">You must enter a description</span></label><br>
                        <textarea></textarea><br>
                        <label>Priority</label><br>
                        <input type="radio" id="1" name="priority" value="1">
                        <label for="1">1 - Critical</label><br>
                        <input type="radio" id="2" name="priority" value="2">
                        <label for="2">2 - High</label><br>
                        <input type="radio" id="3" name="priority" value="3">
                        <label for="3">3 - Common</label><br>
                    </div>
                    <div class="taskColumn">
                        <label>Claim this task?</label><br>
                        <select id="editUserClaims">
                    <!-- Grab users from list of users in DB associated with this specific project number. Loop and display below -->
                    <?php
                        $users = UserEndpoint::getAllUsers();
                        foreach ($users as $user) {
                            echo '<option value="' . $user->getUserID() . '">' . $user->getFirstName() . " " . $user->getLastName() . "</option>";
                        }
                    ?>
                </select>
                    </div>
                </div>
                <div style="text-align: center;"> <button id="btnEditTask">Save Task</button></div>
            </div>
        </div>
    </div>
    </div>

    <!-- The popup box that allows you to create tasks -->
    <div id="createTaskBox" class="editTaskBox">
        <!-- task content -->
        <div class="editTaskBox-content"> <span class="closeButton">&times;</span>

        <div class="insideEditTaskBox">
                <h2>CREATE NEW TASK</h2>
                <div class="taskRow">
                    <div class="taskColumn">
                    <label>Task Description <span id="descriptionError" style="color:red; display: none;">You must enter a description</span></label><br>
                        <textarea id="taskDescription"></textarea><br>
                        <label>Priority <span id="priorityError" style="color:red; display: none;">You must select a priority</span></label><br>
                        <input type="radio" id="1" name="priority" value="1" checked>
                        <label for="1">1 - Critical</label><br>
                        <input type="radio" id="2" name="priority" value="2">
                        <label for="2">2 - High</label><br>
                        <input type="radio" id="3" name="priority" value="3">
                        <label for="3">3 - Common</label><br>
                    </div>
                    <div class="taskColumn">
                        <label>Claim this task?</label><br>
                        <select id="userClaims">
                    <!-- Grab users from list of users in DB associated with this specific project number. Loop and display below -->
                    <?php
                        $users = UserEndpoint::getAllUsers();
                        foreach ($users as $user) {
                            echo '<option value="' . $user->getFirstName() . " " . $user->getLastName() . '">' . $user->getFirstName() . " " . $user->getLastName() . "</option>";
                        }
                    ?>
                </select><br><br>
                <label>Estimated Hours</label><br>
                <select id="estimatedHours">
                <option value="?">?</option>
                <?php 
                    for($i = 1; $i < 100; $i++) {?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>    
                <?php } ?>
                </select>
                    </div>
                </div>
                <div style="text-align: center;"> <button id="btnCreateTask">Create Task</button></div>
            </div>
        </div>
    </div>
    <script src="js/taskBoard.js"></script>
</body>

</html>