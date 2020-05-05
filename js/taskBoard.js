var editTaskBox = document.getElementById("editTaskBox");
var createTaskBox = document.getElementById("createTaskBox");
var closeButton = document.getElementsByClassName("closeButton")[0];
var tempCounter = 0;

var workitems = [];

$(document).ready(function () {
  createTaskBoard(function() {
      taskCount();
  });
});

//Checks the amount of tasks in each section
function taskCount() {
  var incompleteTasks = $("#slot3 .workitem-frame").length;
  var inProgressTasks = $("#slot2 .workitem-frame").length;
  var completeTasks = $("#slot1 .workitem-frame").length;

  document.getElementById("numIncomplete").innerHTML = "(" + incompleteTasks + ")";
  document.getElementById("numInProgress").innerHTML = "(" + inProgressTasks + ")";
  document.getElementById("numComplete").innerHTML = "(" + completeTasks + ")";
}

function createTaskBoard(callback) {
    
    $.ajax({
        url: "./index.php?action=GET_ALL_WORKITEMS",
        type: "GET",
        dataType: "json",
        success: function(data) {
            $.each(data, function(idx, item) {
                workitems.push(item);
                createWorkitem(item);
            });
            callback();
        }
    });
}

function createWorkitem(item) {
    var itemStatus = item.status;
    var priorityColor = "white";
    if(item.priority == 2) {
        priorityColor = "yellow";
    } else if(item.priority == 3) {
        priorityColor = "red";
    }
    var newItem = document.createElement("div");
    var newItemTitle = document.createElement("div");
    var newItemInfo = document.createElement("ul");
    newItem.id = "workitem-" + item.workItemID;
    $(newItemInfo).addClass("workitem-infoholder");
    var hoursLeft = document.createElement("li");
    var claimedBy = document.createElement("li");
    if(item.claimedByUser == "0") {
        claimedBy.innerHTML = "Not claimed";
    } else {
        claimedBy.innerHTML = "Claimed by: " + item.claimedByUser;
    }
    hoursLeft.innerHTML = item.hours + " hours left";
    $(hoursLeft).addClass("workitem-hoursleft");
    $(newItemInfo).append(hoursLeft);
    $(newItemInfo).append(claimedBy);
    $(newItemTitle).addClass("workitem-title");
    $(newItemTitle).html(item.itemName);
    $(newItem).append(newItemTitle);
    $(newItem).append(newItemInfo);
    $(newItem).addClass("workitem-frame");
    $(newItem).css("background-color", priorityColor);
    $(newItem).attr("draggable", true);
    $(newItem).on("dragstart", function(ev) {
        ev.originalEvent.dataTransfer.setData("text/plain", ev.target.id);
    });
    $(newItem).click(function(event) {
        openChangeTask(event);
    });
    $("#slot" + item.itemStatus).append(newItem);
}

function allowtaskDrop(ev) {
  ev.preventDefault(); // default is not to allow drop
}

//When you start dragging a task this function activates with the event of dragStart. It grabs the targets id of the task being dragged
function dragtaskStart(ev) {
  ev.dataTransfer.setData("text/plain", ev.target.id);
}

function droptask(ev) {
  ev.preventDefault(); // default is not to allow drop
  let taskId = ev.dataTransfer.getData("text/plain");
  let sourcetaskSlot = document.getElementById(taskId);


  // ev.target.id here is the id of target Object of the drop
  let targetElement = document.getElementById(ev.target.id)
  let targetParentElement = targetElement.parentElement;

  //Checks to see if there is an task in the slot. If there is, it will replace it with the new one.
  if (targetElement.className === sourcetaskSlot.className) {
    targetParentElement.appendChild(sourcetaskSlot);
  } else {
    // Append to the list
    targetElement.appendChild(sourcetaskSlot);
  }

  taskCount();
}

//Functions for opening the edit popup box for tasks
function openChangeTask(ev) {
    var itemID = ev.currentTarget.id.replace("workitem-", "");
    var workitemMatch = workitems[itemID - 1];
    $("#editTaskID").val(itemID);
    if(workitemMatch) {
        $("#editTaskName").val(workitemMatch.itemName);
        $("#editTaskDesc").val(workitemMatch.itemDescription);
        $("input[type=radio][name=editPriority]").val(workitemMatch.priority);
        $("#editEstimatedHours").val(workitemMatch.hours);
        $("#editUserClaims").val(workitemMatch.claimedByUser);
    }
  editTaskBox.style.display = "block";
}

// When the user clicks on the X in the upper right corner, close the edit box
closeButton.onclick = function () {
  editTaskBox.style.display = "none";
  createTaskBox.style.display = "none";
}

// When the user clicks anywhere outside of the edit box, close it
window.onclick = function (event) {
  if (event.target == this.editTaskBox) {
    editTaskBox.style.display = "none";
  }
  else if (event.target == this.createTaskBox) {
    createTaskBox.style.display = "none";
  }
}
//------------------------------------------------------------

function openCreateTask(ev) {
  createTaskBox.style.display = "block";
}

//Generates a new task card
document.getElementById("btnAddTask").addEventListener("click", function() {
  openCreateTask();
  taskCount();
});

//validation for creating a new task - clientside
function validTaskCreation(taskDescription, priority) {
  if(taskDescription === "" || taskDescription === null) {
    document.getElementById("descriptionError").style.display = "inline";
    return false;
  }
  else if(priority === null) {
    document.getElementById("priorityError").style.display = "inline";
    return false;
  }
  else {
    document.getElementById("descriptionError").style.display = "none";
    document.getElementById("priorityError").style.display = "none";
    return true;
  }

}

function clearTaskBoard() {
    workitems = [];
    $("#slot1").empty();
    $("#slot2").empty();
    $("#slot3").empty();
}

$(document).ready(function() {
    $("#btnCreateTask").click(function() {
        var taskName = $("#newTaskName").val();
        var estHours = $("#estimatedHours").val();
        var claimedUser = $("#userClaims").val();
        var priority = $("input[type=radio]:checked").val();
        var description = $("#taskDescription").val();
        $.ajax({
            url : "./index.php?action=SAVE_WORKITEM",
            type: "POST",
            data: {
                name: taskName,
                hours: estHours,
                claimedBy: claimedUser,
                priority: priority,
                description: description
            },
            success:function(data) {
                clearTaskBoard();
                $.each(data, function(idx, item) {
                    workitems.push(item);
                    createWorkitem(item);
                });
                createTaskBox.style.display = "block";
            }
        });
    });
    
    $("#btnEditTask").click(function() {
        var taskName = $("#editTaskName").val();
        var taskDesc = $("#editTaskDesc").val();
        var itemID = $("#editTaskID").val();
        var itemPriority = $("input[name=editPriority]:checked").val();
        var claimedBy = $("#editUserClaims").val();
        var estHours = $("#editEstimatedHours").val();
        $.ajax({
            url: "./index.php?action=SAVE_WORKITEM",
            type: "POST",
            dataType: "json",
            data: {
                name: taskName,
                hours: estHours,
                claimedBy: claimedBy,
                priority: itemPriority,
                description: taskDesc,
                id: itemID
            },
            success: function(data) {
                clearTaskBoard();
                $.each(data, function(idx, item) {
                    workitems.push(item);
                    createWorkitem(item);
                });
                $("#editTaskBox").hide();
            }
        });
    });
    
    $(".closeButton").click(function() {
    });
});

