// 顏色按鈕
const colorButtons = document.querySelectorAll('.btncol');
colorButtons.forEach(button => {
    button.addEventListener('click', function() {
        const selectedColor = this.getAttribute('data-color');
        CanvasApp.setColor(selectedColor);

        // 可選：視覺反饋 - 顯示選中的顏色
        colorButtons.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
    });
});

// 清除按鈕
const clearButton = document.getElementById('clear');
clearButton.addEventListener('click', function() {
    CanvasApp.clearCanvas();
});

// 筆刷粗細調整
const brushSizeSlider = document.getElementById('brushSize');
const sizeValueDisplay = document.getElementById('sizeValue');

brushSizeSlider.addEventListener('input', function() {
    const size = parseInt(this.value);
    CanvasApp.setBrushSize(size);
    sizeValueDisplay.textContent = size;
});

// 模式切換：畫筆 vs 填滿
const modeToggleButton = document.getElementById('modeToggle');
let currentMode = 'draw';

modeToggleButton.addEventListener('click', function() {
    if (currentMode === 'draw') {
        currentMode = 'fill';
        modeToggleButton.textContent = '模式：填滿';
    } else {
        currentMode = 'draw';
        modeToggleButton.textContent = '模式：畫筆';
    }

    CanvasApp.setMode(currentMode);
});

// 初始設置
window.addEventListener('load', function() {
    // 設置默認顏色
    CanvasApp.setColor('black');

    // 設置默認筆刷大小
    const initialSize = brushSizeSlider.value;
    CanvasApp.setBrushSize(parseInt(initialSize));
    sizeValueDisplay.textContent = initialSize;

    // 設置默認模式
    CanvasApp.setMode('draw');
});