<?php

require_once __DIR__ . '/color_utils.php';

/**
 * Generates an analogous color theme from an input RGB color.
 * The theme includes 5 colors: varying hue by -0.1, -0.05, 0, +0.05, +0.1 (wrapped around 0-1).
 *
 * @param string|array $rgbInput RGB string in format "r,g,b" or array [r,g,b]
 * @return array Array of RGB strings in format "rgb(r,g,b)"
 */
function generateAnalogousTheme($rgbInput) {
    list($r, $g, $b) = parseRgbInput($rgbInput);

    // Convert to HSL
    list($h, $s, $l) = rgbToHsl($r, $g, $b);

    // Define hue variations (in fractions of 360 degrees)
    $hueDelta = 0.05; // About 18 degrees per step
    $variations = [
        'analog1' => fmod($h - 2 * $hueDelta + 1, 1), // +1 to handle negative mod
        'analog2' => fmod($h - $hueDelta + 1, 1),
        'base'    => $h,
        'analog3' => fmod($h + $hueDelta, 1),
        'analog4' => fmod($h + 2 * $hueDelta, 1),
    ];

    $theme = [];
    foreach ($variations as $key => $newH) {
        list($nr, $ng, $nb) = hslToRgb($newH, $s, $l);
        $theme[$key] = "rgb($nr,$ng,$nb)";
    }

    return $theme;
}

// Example usage:
$inputColor = "255,0,0"; // Red
$theme = generateAnalogousTheme($inputColor);
print_r($theme);

/*
Output example:
Array
(
    [analog1] => rgb(255,0,128)
    [analog2] => rgb(255,0,64)
    [base] => rgb(255,0,0)
    [analog3] => rgb(255,64,0)
    [analog4] => rgb(255,128,0)
)
*/