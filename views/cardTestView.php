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
    <div class="boardLayout">
        <div id="slot1" class="emptyBoards" ondrop="dropCard(event)" ondragover="allowCardDrop(event)"><div class="headers"><h1>Completed</h1></div></div>   
        <div id="slot2" class="emptyBoards" ondrop="dropCard(event)" ondragover="allowCardDrop(event)"><div class="headers"><h1>In Progress</h1></div></div>   
        <div id="slot3" class="emptyBoards" ondrop="dropCard(event)" ondragover="allowCardDrop(event)"><div class="headers"><h1>Incomplete</h1></div></div>   
     </div>
    <script src="js/main.js"></script>
</body>
</html>