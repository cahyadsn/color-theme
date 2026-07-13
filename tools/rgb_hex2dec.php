<?php

/**
 * Converts a HEX color string to RGB decimal values.
 *
 * @param string $hex HEX color string, e.g., "#FF0000" or "FF0000"
 * @return string RGB string in format "rgb(r,g,b)" or error message
 */
function hexToRgb($hex) {
    // Remove '#' if present
    $hex = ltrim($hex, '#');

    // Validate hex length (3 or 6 characters)
    if (strlen($hex) == 3) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    } elseif (strlen($hex) != 6) {
        return "Invalid HEX color";
    }

    // Validate hex characters
    if (!ctype_xdigit($hex)) {
        return "Invalid HEX color";
    }

    // Extract RGB components
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    return "rgb($r,$g,$b)";
}

// Example usage:
$hexColor = "#FF0000"; // Red
$rgb = hexToRgb($hexColor);
echo $rgb; // Output: rgb(255,0,0)

// Short hex example:
$shortHex = "#F00";
$rgbShort = hexToRgb($shortHex);
echo $rgbShort; // Output: rgb(255,0,0)