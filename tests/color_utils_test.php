<?php
/**
 * Native PHP Unit Tests for color_utils.php
 */

require_once __DIR__ . '/../tools/color_utils.php';

$testsRun = 0;
$testsFailed = 0;

function assertEquals($expected, $actual, $message = '') {
    global $testsRun, $testsFailed;
    $testsRun++;
    if ($expected !== $actual) {
        $testsFailed++;
        echo "❌ Fail: $message\n";
        echo "   Expected: " . print_r($expected, true) . "\n";
        echo "   Actual:   " . print_r($actual, true) . "\n\n";
    } else {
        echo "✅ Pass: $message\n";
    }
}

// Test parseHexColor
echo "--- Testing parseHexColor ---\n";
assertEquals([255, 0, 0], parseHexColor('#FF0000'), "Full hex with hash");
assertEquals([255, 0, 0], parseHexColor('FF0000'), "Full hex without hash");
assertEquals([0, 255, 0], parseHexColor('#0F0'), "Short hex with hash");
assertEquals(null, parseHexColor('#GG0000'), "Invalid characters");
assertEquals(null, parseHexColor('12345'), "Invalid length");

// Test rgbToHex
echo "\n--- Testing rgbToHex ---\n";
assertEquals('#FF0000', rgbToHex(255, 0, 0), "Convert red to hex");
assertEquals('#00FF00', rgbToHex(0, 255, 0), "Convert green to hex");
try {
    rgbToHex(256, 0, 0);
    assertEquals(true, false, "Exception expected for out of bounds RGB");
} catch (InvalidArgumentException $e) {
    assertEquals(true, true, "Caught exception for value 256");
}

// Test rgbToHsl and hslToRgb
echo "\n--- Testing HSL conversions ---\n";
list($h, $s, $l) = rgbToHsl(255, 0, 0);
assertEquals([0.0, 1.0, 0.5], [round($h, 2), round($s, 2), round($l, 2)], "RGB to HSL (Red)");

$rgb = hslToRgb(0.0, 1.0, 0.5);
assertEquals([255, 0, 0], $rgb, "HSL to RGB (Red)");

// Test foreColor
echo "\n--- Testing foreColor ---\n";
assertEquals('#fff', foreColor(165, 0, 0, 0), "Black background gets white foreground");
assertEquals('#000', foreColor(165, 255, 255, 255), "White background gets black foreground");

// Test parseRgbInput
echo "\n--- Testing parseRgbInput ---\n";
assertEquals([255, 0, 0], parseRgbInput('255,0,0'), "String input parsing");
assertEquals([128, 64, 32], parseRgbInput(' 128 , 64 , 32 '), "String input parsing with spaces");
assertEquals([10, 20, 30], parseRgbInput([10, 20, 30]), "Array input parsing");

// Summary
echo "\n===============================\n";
echo "Tests run: $testsRun\n";
echo "Tests failed: $testsFailed\n";
if ($testsFailed > 0) {
    echo "❌ Some tests failed.\n";
    exit(1);
} else {
    echo "🎉 All tests passed successfully!\n";
    exit(0);
}
