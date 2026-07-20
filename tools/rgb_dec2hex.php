<?php
require_once __DIR__ . '/color_utils.php';

// Example usage:
try {
    $r = 255; // Red
    $g = 165; // Green
    $b = 0;   // Blue

    $hexColor = rgbToHex($r, $g, $b);
    echo "RGB($r, $g, $b) → HEX: $hexColor\n"; // Output: RGB(255, 165, 0) → HEX: #FFA500
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
}
?>
