<?php
session_start();
require_once __DIR__ . '/color_utils.php';

/**
 * Converts a HEX color string to RGB decimal values as a comma-separated string.
 *
 * @param string $hex HEX color string
 * @return string RGB string "r,g,b" or error message
 */
function hexToRgb($hex) {
    $rgb = parseHexColor($hex);
    if ($rgb === null) {
        return "Invalid HEX color";
    }
    return implode(',', $rgb);
}

/**
 * Generates a monochrome color theme from an input RGB color.
 * The theme includes 5 shades: darkest, dark, base, light, lightest.
 *
 * @param string|array $rgbInput RGB string in format "r,g,b" or array [r,g,b]
 * @return array Theme color mapping
 */
function generateMonochromeTheme($rgbInput) {
    list($r, $g, $b) = parseRgbInput($rgbInput);

    // Convert to HSL
    list($h, $s, $l) = rgbToHsl($r, $g, $b);

    // Define lightness variations relative to base (clamped 0-1)
    $variations = [
        'd5'    => max(0, $l - ($l/5)*2.5),
        'd4'    => max(0, $l - ($l/5)*2),
        'd3'    => max(0, $l - ($l/5)*1.5),
        'd2'    => max(0, $l - ($l/5)*1),
        'd1'    => max(0, $l - ($l/5)*0.5),
        'base'  => $l,
        'l1'    => min(1, $l + ((1.0-$l)/5)*1),
        'l2'    => min(1, $l + ((1.0-$l)/5)*2),
        'l3'    => min(1, $l + ((1.0-$l)/5)*3),
        'l4'    => min(1, $l + ((1.0-$l)/5)*4),
        'l5'    => min(1, $l + ((1.0-$l)/5)*4.7)
    ];

    $theme = [];
    foreach ($variations as $key => $newL) {
        list($nr, $ng, $nb) = hslToRgb($h, $s, $newL);
        $theme[$key] = array("rgb($nr,$ng,$nb)", rgbToHex((int)$nr,(int)$ng,(int)$nb), foreColor(165,(int)$nr,(int)$ng,(int)$nb));
    }
    return $theme;
}

$my_color=['f0f8ff','faebd7','00ffff','7fffd4','f0ffff','f5f5dc','ffe4c4','000000','ffebcd','0000ff','8a2be2','a52a2a','deb887','5f9ea0','7fff00','d2691e','ff7f50','6495ed','fff8dc','dc143c','00ffff','00008b','008b8b','b8860b','a9a9a9','a9a9a9','006400','bdb76b','8b008b','556b2f','ff8c00','9932cc','8b0000','e9967a','8fbc8f','483d8b','2f4f4f','2f4f4f','00ced1','9400d3','ff1493','00bfff','696969','696969','1e90ff','b22222','fffaf0','228b22','ff00ff','dcdcdc','f8f8ff','ffd700','daa520','808080','808080','008000','adff2f','f0fff0','ff69b4','cd5c5c','4b0082','fffff0','f0e68c','e6e6fa','fff0f5','7cfc00','fffacd','add8e6','f08080','e0ffff','fafad2','d3d3d3','d3d3d3','90ee90','ffb6c1','ffa07a','20b2aa','87cefa','778899','778899','b0c4de','ffffe0','00ff00','32cd32','faf0e6','ff00ff','800000','66cdaa','0000cd','ba55d3','9370db','3cb371','7b68ee','00fa9a','48d1cc','c71585','191970','f5fffa','ffe4e1','ffe4b5','ffdead','000080','fdf5e6','808000','6b8e23','ffa500','ff4500','da70d6','eee8aa','98fb98','afeeee','db7093','ffefd5','ffdab9','cd853f','ffc0cb','dda0dd','b0e0e6','800080','663399','ff0000','bc8f8f','4169e1','8b4513','fa8072','f4a460','2e8b57','fff5ee','a0522d','c0c0c0','87ceeb','6a5acd','708090','708090','fffafa','00ff7f','4682b4','d2b48c','008080','d8bfd8','ff6347','40e0d0','ee82ee','f5deb3','ffffff','f5f5f5','ffff00','9acd32'];
$x_color=(int)date('dHis')%148;
// Example usage:
$hex=isset($_GET['c'])?$_GET['c']:(isset($_SESSION['c'])?$_SESSION['c']:'#'.$my_color[$x_color]);
//$_SESSION['c']=$hex;
$inputColor = hexToRgb($hex); // Red
$theme = generateMonochromeTheme($inputColor);
//echo "<pre>";print_r($theme);
foreach($theme as $k=>$v){
  echo "<div style='width:80%;height:40px;margin:5px;padding:2px;background-color:{$v[1]};color:{$v[2]}'>{$v[1]}</div>";
}

echo "<pre>
.w3-theme-l5 {color:{$theme['l5'][2]} !important; background-color:{$theme['l5'][1]} !important}
.w3-theme-l4 {color:{$theme['l4'][2]} !important; background-color:{$theme['l4'][1]} !important}
.w3-theme-l3 {color:{$theme['l3'][2]} !important; background-color:{$theme['l3'][1]} !important}
.w3-theme-l2 {color:{$theme['l2'][2]} !important; background-color:{$theme['l2'][1]} !important}
.w3-theme-l1 {color:{$theme['l1'][2]} !important; background-color:{$theme['l1'][1]} !important}
.w3-theme-d1 {color:{$theme['d1'][2]} !important; background-color:{$theme['d1'][1]} !important}
.w3-theme-d2 {color:{$theme['d2'][2]} !important; background-color:{$theme['d2'][1]} !important}
.w3-theme-d3 {color:{$theme['d3'][2]} !important; background-color:{$theme['d3'][1]} !important}
.w3-theme-d4 {color:{$theme['d4'][2]} !important; background-color:{$theme['d4'][1]} !important}
.w3-theme-d5 {color:{$theme['d5'][2]} !important; background-color:{$theme['d5'][1]} !important}
.w3-theme-light {color:{$theme['l5'][2]} !important; background-color:{$theme['l5'][1]} !important}
.w3-theme-dark {color:{$theme['d5'][2]} !important; background-color:{$theme['d5'][1]} !important}
.w3-theme-action {color:{$theme['d5'][2]} !important; background-color:{$theme['d5'][1]} !important}
.w3-theme {color:{$theme['base'][2]} !important; background-color:{$theme['base'][1]} !important}
.w3-text-theme {color:{$theme['base'][1]} !important}
.w3-border-theme {border-color:{$theme['base'][1]} !important}
.w3-hover-theme:hover {color:{$theme['base'][2]} !important; background-color:{$theme['base'][1]} !important}
.w3-hover-text-theme:hover {color:{$theme['base'][1]} !important}
.w3-hover-border-theme:hover {border-color:{$theme['base'][1]} !important}
</pre>";

