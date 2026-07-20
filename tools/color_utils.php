<?php
/**
 * Universal CSS color theme system and styling utility library.
 */

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

    return [(int)round($r * 255), (int)round($g * 255), (int)round($b * 255)];
}

/**
 * Converts a HEX color string to an RGB array.
 *
 * @param string $hex HEX color string, e.g., "#FF0000" or "FF0000"
 * @return array|null [r, g, b] array, or null if invalid
 */
function parseHexColor($hex) {
    $hex = ltrim($hex, '#');
    if (strlen($hex) == 3) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    } elseif (strlen($hex) != 6 || !ctype_xdigit($hex)) {
        return null;
    }

    return [
        (int)hexdec(substr($hex, 0, 2)),
        (int)hexdec(substr($hex, 2, 2)),
        (int)hexdec(substr($hex, 4, 2))
    ];
}

/**
 * Convert RGB decimal values to HEX color format
 *
 * @param int $r Red value (0-255)
 * @param int $g Green value (0-255)
 * @param int $b Blue value (0-255)
 * @return string HEX color string (e.g., "#ff00aa")
 */
function rgbToHex($r, $g, $b) {
    foreach ([$r, $g, $b] as $value) {
        if (!is_int($value) || $value < 0 || $value > 255) {
            throw new InvalidArgumentException("RGB values must be integers between 0 and 255.");
        }
    }
    return sprintf("#%02X%02X%02X", $r, $g, $b);
}

/**
 * Calculates readable foreground color (either #000 or #fff) based on background luminance.
 *
 * @param int $n Threshold (normally 128 to 165)
 * @param int $r Red (0-255)
 * @param int $g Green (0-255)
 * @param int $b Blue (0-255)
 * @return string '#000' or '#fff'
 */
function foreColor($n, $r, $g, $b) {
    $fc = '#000';
    $fc = ((($r * 299 + $g * 587 + $b * 114) / 1000) < $n) ? '#fff' : $fc;
    return $fc;
}

/**
 * Helper to parse input color which can be string "r,g,b" or array [r,g,b].
 *
 * @param mixed $input
 * @return array [r,g,b]
 */
function parseRgbInput($input) {
    if (is_array($input)) {
        return array_map('intval', $input);
    }
    $parts = explode(',', $input);
    return [
        (int)trim($parts[0] ?? 0),
        (int)trim($parts[1] ?? 0),
        (int)trim($parts[2] ?? 0)
    ];
}
