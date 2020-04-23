//Everything here is for testing purposes. There will need to be ways to call from db and also save task position to db. As well as ways to edit tasks
var popupBox = document.getElementById("myPopupBox");
var closeButton = document.getElementsByClassName("closeButton")[0];

$(document).ready(function () {
  createTaskBoard();

});
/*
  I'm trying to think about how I want these assigned to the different columns via the database. Right now I'm thinking of assigning a value of 1-3 to each task based on what column it is
  placed in. 1=Incomplete 2=In Progress 3=Complete. I'm hoping to use Ajax to not have to refresh the page constantly each time a task task is dropped into a column and it changes the 
  "columnNum" in the database.
*/

function createTaskBoard() {
  //generates the tasks on page load - this will call from a db in the future
  let index = 3;
  $('#slot3').append("<div class='task' style='background-color: white' value = " + index + " id=task1" +
    " draggable='true' ondragstart='dragtaskStart(event)'onClick='openChangeText(event)'><span><strong>As a user I want to make task tasks</strong></span>" +
    "<span style='float: right'>5 Hrs<br><span>Priority: 1</span><br><span style='bottom: 10px'>UNCLAIMED</span></span></div>");


  $('#slot3').append("<div class='task' style='background-color: yellow' value = " + index + " id=task2" +
    " draggable='true' ondragstart='dragtaskStart(event)'onClick='openChangeText(event)'><span><strong>As an admin I want to make projects</strong></span>" +
    "<span style='float: right'>16 Hrs<br><span>Priority: 2</span><br><span style='bottom: 10px'>UNCLAIMED</span></span></div>");


  $('#slot3').append("<div class='task' value = " + index + " id=task3" +
    " draggable='true' ondragstart='dragtaskStart(event)'onClick='openChangeText(event)'><span><strong>As a user I want to be able to edit task tasks</strong></span>" +
    "<span style='float: right'>8 Hrs<br><span>Priority: 3</span><br><span style='bottom: 10px'>UNCLAIMED</span></span></div>");

  $('#slot3').append("<div class='task' style='background-color: yellow' value = " + index + " id=task4" +
    " draggable='true' ondragstart='dragtaskStart(event)'onClick='openChangeText(event)'><span><strong>As a user I want to be able to edit task tasks</strong></span>" +
    "<span style='float: right'>8 Hrs<br><span>Priority: 3</span><br><span style='bottom: 10px'>UNCLAIMED</span></span></div>");

  $('#slot3').append("<div class='task' style='background-color: white' value = " + index + " id=task5" +
    " draggable='true' ondragstart='dragtaskStart(event)'onClick='openChangeText(event)'><span><strong>As a user I want to be able to edit task tasks</strong></span>" +
    "<span style='float: right'>8 Hrs<br><span>Priority: 3</span><br><span style='bottom: 10px'>UNCLAIMED</span></span></div>");

  $('#slot3').append("<div class='task' value = " + index + " id=task6" +
    " draggable='true' ondragstart='dragtaskStart(event)'onClick='openChangeText(event)'><span><strong>As a user I want to be able to edit task tasks</strong></span>" +
    "<span style='float: right'>8 Hrs<br><span>Priority: 3</span><br><span style='bottom: 10px'>UNCLAIMED</span></span></div>");

  $('#slot3').append("<div class='task' style='background-color: white' value = " + index + " id=task7" +
    " draggable='true' ondragstart='dragtaskStart(event)'onClick='openChangeText(event)'><span><strong>As a user I want to be able to edit task tasks</strong></span>" +
    "<span style='float: right'>8 Hrs<br><span>Priority: 3</span><br><span style='bottom: 10px'>UNCLAIMED</span></span></div>");

  document.getElementById("numIncomplete").innerHTML = "(" + index + ")";
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
    //Removes the current task and replaces it with the new one
    targetParentElement.removeChild(targetElement);
    targetParentElement.appendChild(sourcetaskSlot);
  } else {
    // Append to the list
    targetElement.appendChild(sourcetaskSlot);
  }
}

function openChangeText(ev) {
  popupBox.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
closeButton.onclick = function () {
  popupBox.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == popupBox) {
    popupBox.style.display = "none";
  }
}