<?php

require_once __DIR__ . '/color_utils.php';

/**
 * Generates a triadic color theme from an input RGB color.
 * The theme includes 3 colors: base, triad1 (+120° hue), triad2 (+240° hue).
 *
 * @param string|array $rgbInput RGB string in format "r,g,b" or array [r,g,b]
 * @return array Array of RGB strings in format "rgb(r,g,b)"
 */
function generateTriadicTheme($rgbInput) {
    list($r, $g, $b) = parseRgbInput($rgbInput);

    // Convert to HSL
    list($h, $s, $l) = rgbToHsl($r, $g, $b);

    // Define hue variations (120° is 1/3, 240° is 2/3)
    $variations = [
        'base'   => $h,
        'triad1' => fmod($h + 1/3, 1),
        'triad2' => fmod($h + 2/3, 1),
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
$theme = generateTriadicTheme($inputColor);
print_r($theme);

/*
Output example:
Array
(
    [base] => rgb(255,0,0)
    [triad1] => rgb(0,255,0)
    [triad2] => rgb(0,0,255)
)
*/
