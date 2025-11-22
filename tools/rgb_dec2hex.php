<?php
/**
 * Convert RGB decimal values to HEX color format
 *
 * @param int $r Red value (0-255)
 * @param int $g Green value (0-255)
 * @param int $b Blue value (0-255)
 * @return string HEX color string (e.g., "#ff00aa")
 */
function rgbToHex($r, $g, $b) {
    // Validate inputs
    foreach ([$r, $g, $b] as $value) {
        if (!is_int($value) || $value < 0 || $value > 255) {
            throw new InvalidArgumentException("RGB values must be integers between 0 and 255.");
        }
    }

    // Convert to HEX format
    return sprintf("#%02X%02X%02X", $r, $g, $b);
}

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
