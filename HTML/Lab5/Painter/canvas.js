const canvas = document.getElementById("mycanvas");
const context = canvas.getContext("2d");
const show_mouse = document.getElementById("show_mouse");

let mouse_down = false;
let color = "black";
let mode = "draw";

// 初始筆刷粗細
context.lineWidth = 5;

canvas.onmousedown = function (event) {
    const x = event.offsetX;
    const y = event.offsetY;

    if (mode === "fill") {
        context.fillStyle = color;
        context.fillRect(0, 0, canvas.width, canvas.height);
    } else {
        context.beginPath();
        context.moveTo(x, y);
        mouse_down = true;
        show_mouse.textContent = `開始於：${x}, ${y}`;
    }
};

canvas.onmousemove = function (event) {
    if (mouse_down && mode === "draw") {
        const x = event.offsetX;
        const y = event.offsetY;
        context.lineTo(x, y);
        context.strokeStyle = color;
        context.stroke();
        show_mouse.textContent = `目前座標：${x}, ${y}`;
    }
};

canvas.onmouseup = function () {
    mouse_down = false;
    show_mouse.textContent = "滑鼠放開";
};

// 提供外部操作
window.CanvasApp = {
    setColor: (c) => { color = c; },
    setMode: (m) => { mode = m; },
    clearCanvas: () => context.clearRect(0, 0, canvas.width, canvas.height),
    setBrushSize: (size) => { context.lineWidth = size; }
};
