<?php

/**
 * Converts RGB values to HSL.
 *
 * @param int $r Red value (0-255)
 * @param int $g Green value (0-255)
 * @param int $b Blue value (0-255)
 * @return array [hue, saturation, lightness] (0-1)
 */
function rgbToHsl($r, $g, $b) {
    $r /= 255;
    $g /= 255;
    $b /= 255;

    $max = max($r, $g, $b);
    $min = min($r, $g, $b);
    $delta = $max - $min;

    $l = ($max + $min) / 2;

    if ($delta == 0) {
        return [0, 0, $l];
    }

    $s = $delta / (1 - abs(2 * $l - 1));

    if ($max == $r) {
        $h = ($g - $b) / $delta + ($g < $b ? 6 : 0);
    } elseif ($max == $g) {
        $h = ($b - $r) / $delta + 2;
    } else {
        $h = ($r - $g) / $delta + 4;
    }

    $h /= 6;

    return [$h, $s, $l];
}

/**
 * Helper function for HSL to RGB conversion.
 */
function hueToRgb($p, $q, $t) {
    if ($t < 0) $t += 1;
    if ($t > 1) $t -= 1;
    if ($t < 1/6) return $p + ($q - $p) * 6 * $t;
    if ($t < 1/2) return $q;
    if ($t < 2/3) return $p + ($q - $p) * (2/3 - $t) * 6;
    return $p;
}

/**
 * Converts HSL values to RGB.
 *
 * @param float $h Hue (0-1)
 * @param float $s Saturation (0-1)
 * @param float $l Lightness (0-1)
 * @return array [red, green, blue] (0-255)
 */
function hslToRgb($h, $s, $l) {
    if ($s == 0) {
        $r = $g = $b = $l;
    } else {
        $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
        $p = 2 * $l - $q;

        $r = hueToRgb($p, $q, $h + 1/3);
        $g = hueToRgb($p, $q, $h);
        $b = hueToRgb($p, $q, $h - 1/3);
    }

    return [round($r * 255), round($g * 255), round($b * 255)];
}

/**
 * Generates a complementary color theme from an input RGB color.
 * The theme includes 2 colors: base, complement (+180° hue).
 *
 * @param string $rgbInput RGB string in format "r,g,b" (e.g., "255,0,0")
 * @return array Array of RGB strings in format "rgb(r,g,b)"
 */
function generateComplementaryTheme($rgbInput) {
    // Parse input
    list($r, $g, $b) = explode(',', $rgbInput);
    $r = (int)trim($r);
    $g = (int)trim($g);
    $b = (int)trim($b);

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