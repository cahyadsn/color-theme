<?php

require_once __DIR__ . '/color_utils.php';

/**
 * Generates a monochrome color theme from an input RGB color.
 * The theme includes 5 shades: darkest, dark, base, light, lightest.
 *
 * @param string|array $rgbInput RGB string in format "r,g,b" or array [r,g,b]
 * @return array Array of RGB strings in format "rgb(r,g,b)"
 */
function generateMonochromeTheme($rgbInput) {
    list($r, $g, $b) = parseRgbInput($rgbInput);

    // Convert to HSL
    list($h, $s, $l) = rgbToHsl($r, $g, $b);

    // Define lightness variations relative to base (clamped 0-1)
    $variations = [
        'darkest' => max(0, $l - 0.3),
        'dark'    => max(0, $l - 0.15),
        'base'    => $l,
        'light'   => min(1, $l + 0.15),
        'lightest'=> min(1, $l + 0.3),
    ];

    $theme = [];
    foreach ($variations as $key => $newL) {
        list($nr, $ng, $nb) = hslToRgb($h, $s, $newL);
        $theme[$key] = "rgb($nr,$ng,$nb)";
    }

    return $theme;
}

// Example usage:
$inputColor = "255,0,0"; // Red
$theme = generateMonochromeTheme($inputColor);
print_r($theme);

/*
Output example:
Array
(
    [darkest] => rgb(77,0,0)
    [dark] => rgb(140,0,0)
    [base] => rgb(255,0,0)
    [light] => rgb(255,89,89)
    [lightest] => rgb(255,153,153)
)
*/