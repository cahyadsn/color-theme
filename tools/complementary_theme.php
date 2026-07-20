<?php

require_once __DIR__ . '/color_utils.php';

/**
 * Generates a complementary color theme from an input RGB color.
 * The theme includes 2 colors: base, complement (+180° hue).
 *
 * @param string|array $rgbInput RGB string in format "r,g,b" or array [r,g,b]
 * @return array Array of RGB strings in format "rgb(r,g,b)"
 */
function generateComplementaryTheme($rgbInput) {
    list($r, $g, $b) = parseRgbInput($rgbInput);

    // Convert to HSL
    list($h, $s, $l) = rgbToHsl($r, $g, $b);

    // Define hue variations (180° is 0.5)
    $variations = [
        'base'       => $h,
        'complement' => fmod($h + 0.5, 1),
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
$theme = generateComplementaryTheme($inputColor);
print_r($theme);

/*
Output example:
Array
(
    [base] => rgb(255,0,0)
    [complement] => rgb(0,255,255)
)
*/