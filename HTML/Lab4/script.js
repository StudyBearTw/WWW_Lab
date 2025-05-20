// A simple drawing program

function createCanvas() {
    var side = 100;
    var tbody = document.getElementById("tablebody");
  
    for (var i = 0; i < side; ++i) {
      var row = document.createElement("tr");
  
      for (var j = 0; j < side; ++j) {
        var cell = document.createElement("td");
        row.appendChild(cell);
      }
  
      tbody.appendChild(row);
    }
  
    // 註冊 mousemove 事件
    document
      .getElementById("canvas")
      .addEventListener("mousemove", processMouseMove, false);
  
    // 註冊拖曳事件
    enableDragAndDrop();
  
    // 新增清除畫布按鈕
    document.getElementById("clearCanvas").addEventListener("click", clearCanvas);
  }
  
  // 處理滑鼠移動
  function processMouseMove(e) {
    if (e.target.tagName.toLowerCase() == "td") {
      // Ctrl 鍵 + 滑鼠移動 → 變藍色
      if (e.ctrlKey) {
        e.target.setAttribute("class", "blue");
      }
      // Shift 鍵 + 滑鼠移動 → 變紅色
      if (e.shiftKey) {
        e.target.setAttribute("class", "red");
      }
    }
  }
  
  window.addEventListener("load", createCanvas, false);
  