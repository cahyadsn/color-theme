<?php

require_once __DIR__ . '/color_utils.php';

/**
 * Converts a HEX color string to RGB decimal values.
 *
 * @param string $hex HEX color string, e.g., "#FF0000" or "FF0000"
 * @return string RGB string in format "rgb(r,g,b)" or error message
 */
function hexToRgb($hex) {
    $rgb = parseHexColor($hex);
    if ($rgb === null) {
        return "Invalid HEX color";
    }
    return "rgb(" . implode(',', $rgb) . ")";
}

// Example usage:
$hexColor = "#FF0000"; // Red
$rgb = hexToRgb($hexColor);
echo $rgb; // Output: rgb(255,0,0)

// Short hex example:
$shortHex = "#F00";
$rgbShort = hexToRgb($shortHex);
echo $rgbShort; // Output: rgb(255,0,0)