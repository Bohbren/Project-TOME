var editTaskBox = document.getElementById("editTaskBox");
var createTaskBox = document.getElementById("createTaskBox");
var closeButton = document.getElementsByClassName("closeButton")[0];
var tempCounter = 0;
$(document).ready(function () {
  createTaskBoard();
  taskCount();
});
/*
  I'm trying to think about how I want these assigned to the different columns via the database. Right now I'm thinking of assigning a value of 1-3 to each task based on what column it is
  placed in. 1=Incomplete 2=In Progress 3=Complete. I'm hoping to use Ajax to not have to refresh the page constantly each time a task task is dropped into a column and it changes the 
  "columnNum" in the database.
*/

//Checks the amount of tasks in each section
function taskCount() {
  var incompleteTasks = $("#slot3 .task").length;
  var inProgressTasks = $("#slot2 .task").length;
  var completeTasks = $("#slot1 .task").length;

  document.getElementById("numIncomplete").innerHTML = "(" + incompleteTasks + ")";
  document.getElementById("numInProgress").innerHTML = "(" + inProgressTasks + ")";
  document.getElementById("numComplete").innerHTML = "(" + completeTasks + ")";
}

function createTaskBoard() {
  //generates the tasks on page load - this will call from a db in the future
  let index = 3;
  $('#slot3').append("<div class='task' style='background-color: white' value = " + index + " id=task1" +
    " draggable='true' ondragstart='dragtaskStart(event)'onClick='openChangeTask(event)'><span><strong>I am a Common Priority task</strong></span>" +
    "<span style='position: absolute; right: 0; bottom: 0; padding-right: 5px;'><em><span>8 Hrs<span style='padding-left:20px;'>Priority: 1</span> <span style='padding-left:20px;'>UNCLAIMED</span></span></em></span></div>");

  $('#slot3').append("<div class='task' style='background-color: yellow' value = " + index + " id=task2" +
    " draggable='true' ondragstart='dragtaskStart(event)'onClick='openChangeTask(event)'><span><strong>I am a High Priority task</strong></span>" +
    "<span style='position: absolute; right: 0; bottom: 0; padding-right: 5px;'><em><span>8 Hrs<span style='padding-left:20px;'>Priority: 2</span> <span style='padding-left:20px;'>UNCLAIMED</span></span></em></span></div>");

  $('#slot3').append("<div class='task' value = " + index + " id=task3" +
    " draggable='true' ondragstart='dragtaskStart(event)'onClick='openChangeTask(event)'><span><strong>I am a Critical Priority task</strong></span>" +
    "<span style='position: absolute; right: 0; bottom: 0; padding-right: 5px;'><em><span>8 Hrs<span style='padding-left:20px;'>Priority: 3</span> <span style='padding-left:20px;'>UNCLAIMED</span></span></em></span></div>");
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

document.getElementById("btnCreateTask").addEventListener("click", function() {
  console.log("Create task button clicked");

  var taskDescription = $("#taskDescription").val();
  var priority = document.querySelector('input[name="priority"]:checked'); 
  var userClaimed = $("#userClaims :selected").text();
  var color = null;
  var estimatedHours = $("#estimatedHours").val();

  console.log("Task Description: " + taskDescription);
  console.log("Priority: " + priority);
  console.log("User Claimed: " + userClaimed);
  console.log("Estimated Hours: " + estimatedHours);

  //Check to see what priority is selected
  switch (priority.value) {
    case "1":
      color = "rgb(250, 48, 75)";
      break;
    case "2":
      color = "yellow";
    break;
    case "3":
      color = "white";
    break;
    default:
      color = "white";
      break;
  }
  if(validTaskCreation(taskDescription, priority)) {
    console.log("the user: " + userClaimed);
    $('#slot3').append("<div style='background-color:" + color + ";' class='task' value = " + tempCounter + " id="+ tempCounter++ + 
    " draggable='true' ondragstart='dragtaskStart(event)'onClick='openChangeTask(event)'><span><strong>" + taskDescription + "</strong></span>" +
    "<span style='position: absolute; right: 0; bottom: 0; padding-right: 5px;'><em><span>" + estimatedHours + " Hrs<span style='padding-left:20px;'>Priority: " + priority.value + "</span>" +
    "<span style='padding-left:20px;'>" + userClaimed + "</span></span></em></span></div>");

    createTaskBox.style.display = "none";
    taskCount();
  }
  else {
    createTaskBox.style.display = "block";
    taskCount();
  }
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

