// A simple drawing program with drag and drop functionality.
function createCanvas() {
  var side = 100;
  var tbody = document.getElementById("tablebody");

  for (var i = 0; i < side; ++i) {
    var row = document.createElement("tr");
    for (var j = 0; j < side; ++j) {
      var cell = document.createElement("td");
      cell.draggable = true; // Enable dragging
      cell.addEventListener("dragstart", handleDragStart);
      cell.addEventListener("dragover", handleDragOver);
      cell.addEventListener("drop", handleDrop);
      row.appendChild(cell);
    }
    tbody.appendChild(row);
  }

  document.getElementById("canvas").addEventListener("mousemove", processMouseMove, false);
}

let draggedCell = null;

function handleDragStart(e) {
  draggedCell = e.target;
}

function handleDragOver(e) {
  e.preventDefault(); // Allow drop
}

function handleDrop(e) {
  e.preventDefault();
  if (draggedCell && draggedCell !== e.target) {
    let tempColor = draggedCell.style.backgroundColor;
    draggedCell.style.backgroundColor = e.target.style.backgroundColor;
    e.target.style.backgroundColor = tempColor;
  }
}

function processMouseMove(e) {
  if (e.target.tagName.toLowerCase() == "td") {
    if (e.altKey) {
      e.target.style.backgroundColor = "white";
    } else if (e.ctrlKey) {
      e.target.style.backgroundColor = "blue";
    } else if (e.shiftKey) {
      e.target.style.backgroundColor = "red";
    }
  }
}

function clearCanvas() {
  var cells = document.querySelectorAll("#canvas td");
  cells.forEach(cell => cell.style.backgroundColor = "white");
}

window.addEventListener("load", createCanvas, false);
