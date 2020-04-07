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
    <title>Draggable Notecards Test</title>
</head>

<body>
    <?php include('navbarView.php'); ?>
    <div class="boardInformation">
    <h2>Board Information: </h2>
    <p>Calculated Hours: 55</p>
    <p>Users Working: 5</p>
    <p>Calculated Completion Date: April 7, 2020</p>
    </div>
    <div class="boardLayout">
        <div id="slot1" class="emptyBoards" ondrop="dropCard(event)" ondragover="allowCardDrop(event)">
            <div class="headers">
                <h1>Completed <span style="float: right">(15)</span></h1>
            </div>
        </div>
        <div id="slot2" class="emptyBoards" ondrop="dropCard(event)" ondragover="allowCardDrop(event)">
            <div class="headers">
                <h1>In Progress<span style="float: right">(15)</span></h1>
            </div>
        </div>
        <div id="slot3" class="emptyBoards" ondrop="dropCard(event)" ondragover="allowCardDrop(event)">
            <div class="headers">
                <h1>Incomplete<span style="float: right">(15)</span></h1>
            </div>
        </div>
    </div>
    <!-- Trigger/Open The Modal -->

    <!-- The Modal -->
    <div id="myPopupBox" class="popupBox">
        <!-- Modal content -->
        <div class="modal-content">
        <span class="closeButton">&times;</span>
            <div class="insidePopupBox">
                <label>Card Name: </label><br>
                <input type="text"><br>
                <label>Card Description: </label><br>
                <textarea></textarea><br>
            <button>Save</button><br><br>

            <label>Claimed by: </label>
            <p>UNCLAIMED</p><br><br>
            <label>Claim this story?</label><br>
            <select id="userClaims">
                <option value="">Brendan</option>
                <option value="">Luther</option>
                <option value="">Dan</option>
                <option value="">Bryan</option>
                <option value="">These values will be dynamically generated and pulled from DB</option>
            </select>
            <button>Claim</button><br>
            </div>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>

</html>