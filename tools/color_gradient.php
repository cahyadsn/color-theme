<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CSS Gradient Generator</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: #f4f4f4;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
    }
    h1 {
        margin-top: 20px;
    }
    .controls {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .preview {
        width: 100%;
        max-width: 500px;
        height: 200px;
        border-radius: 8px;
        margin-top: 20px;
        border: 2px solid #ccc;
    }
    .code-box {
        margin-top: 15px;
        background: #222;
        color: #0f0;
        padding: 10px;
        border-radius: 5px;
        font-family: monospace;
        white-space: pre-wrap;
        word-break: break-all;
    }
    button {
        padding: 8px 12px;
        border: none;
        background: #007bff;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover {
        background: #0056b3;
    }
</style>
</head>
<body>

<h1>🎨 CSS Gradient Generator</h1>

<div class="controls">
    <label>First Color: <input type="color" id="color1" value="#ff7e5f"></label>
    <label>Second Color: <input type="color" id="color2" value="#feb47b"></label>
    <label>Gradient Type:
        <select id="type">
            <option value="linear">Linear</option>
            <option value="radial">Radial</option>
        </select>
    </label>
    <label>Direction (for linear):
        <select id="direction">
            <option value="to right">To Right</option>
            <option value="to left">To Left</option>
            <option value="to top">To Top</option>
            <option value="to bottom">To Bottom</option>
            <option value="45deg">45°</option>
            <option value="135deg">135°</option>
        </select>
    </label>
    <button id="copyBtn">Copy CSS</button>
</div>

<div class="preview" id="preview"></div>

<div class="code-box" id="cssCode"></div>

<script>
    const color1 = document.getElementById('color1');
    const color2 = document.getElementById('color2');
    const type = document.getElementById('type');
    const direction = document.getElementById('direction');
    const preview = document.getElementById('preview');
    const cssCode = document.getElementById('cssCode');
    const copyBtn = document.getElementById('copyBtn');

    function updateGradient() {
        let gradient;
        if (type.value === 'linear') {
            gradient = `linear-gradient(${direction.value}, ${color1.value}, ${color2.value})`;
        } else {
            gradient = `radial-gradient(circle, ${color1.value}, ${color2.value})`;
        }
        preview.style.background = gradient;
        cssCode.textContent = `background: ${gradient};`;
    }

    // Copy CSS to clipboard
    copyBtn.addEventListener('click', () => {
        navigator.clipboard.writeText(cssCode.textContent)
            .then(() => alert('CSS copied to clipboard!'))
            .catch(err => alert('Failed to copy CSS: ' + err));
    });

    // Event listeners
    [color1, color2, type, direction].forEach(el => el.addEventListener('input', updateGradient));

    // Initialize
    updateGradient();
</script>

</body>
</html>