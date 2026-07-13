<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RGB Color Slider</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    h1 {
        margin-bottom: 20px;
    }

    .slider-container {
        width: 300px;
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="range"] {
        width: 100%;
        -webkit-appearance: none;
        height: 8px;
        border-radius: 5px;
        background: #ddd;
        outline: none;
    }

    /* Custom slider thumb */
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #333;
        cursor: pointer;
    }

    #colorPreview {
        width: 200px;
        height: 200px;
        border-radius: 10px;
        border: 2px solid #ccc;
        margin-top: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    #rgbValue {
        margin-top: 10px;
        font-weight: bold;
    }
</style>
</head>
<body>
<h1>RGB Color Slider</h1>
<div class="slider-container">
    <label for="red">Red: <span id="redVal">0</span></label>
    <input type="range" id="red" min="0" max="255" value="0">
</div>
<div class="slider-container">
    <label for="green">Green: <span id="greenVal">0</span></label>
    <input type="range" id="green" min="0" max="255" value="0">
</div>
<div class="slider-container">
    <label for="blue">Blue: <span id="blueVal">0</span></label>
    <input type="range" id="blue" min="0" max="255" value="0">
</div>
<div id="colorPreview"></div>
<div id="rgbValue">rgb(0, 0, 0)</div>
<script>
    // Get elements
    const redSlider = document.getElementById('red');
    const greenSlider = document.getElementById('green');
    const blueSlider = document.getElementById('blue');
    const redVal = document.getElementById('redVal');
    const greenVal = document.getElementById('greenVal');
    const blueVal = document.getElementById('blueVal');
    const colorPreview = document.getElementById('colorPreview');
    const rgbValue = document.getElementById('rgbValue');
    // Function to update color
    function updateColor() {
        const r = parseInt(redSlider.value);
        const g = parseInt(greenSlider.value);
        const b = parseInt(blueSlider.value);
        // Update text values
        redVal.textContent = r;
        greenVal.textContent = g;
        blueVal.textContent = b;
        // Create RGB string
        const rgb = `rgb(${r}, ${g}, ${b})`;
        // Apply to preview box
        colorPreview.style.backgroundColor = rgb;
        // Show RGB value
        rgbValue.textContent = rgb;
    }
    // Event listeners
    redSlider.addEventListener('input', updateColor);
    greenSlider.addEventListener('input', updateColor);
    blueSlider.addEventListener('input', updateColor);
    // Initialize
    updateColor();
</script>
</body>
</html>