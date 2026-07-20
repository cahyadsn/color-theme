# Color Theme System Unit Tests

This directory contains unit tests for the color theme system styling framework. The tests are written in native PHP without external dependencies.

## Structure
* **[`color_utils_test.php`](file:///D:/laragon/repo/dev/color-theme/tests/color_utils_test.php)**: Verifies the logic in the color conversion library ([`tools/color_utils.php`](file:///D:/laragon/repo/dev/color-theme/tools/color_utils.php)).

## Tested Utilities
The test suite ensures the correctness of the following logic components:
1. **Hexadecimal Parsing (`parseHexColor`)**: Verifies that standard hex keys (like `#FF0000` or `FF0000`) and short syntax hex values (such as `#0F0`) are translated into RGB correctly, and rejects invalid structures.
2. **Hexadecimal Export (`rgbToHex`)**: Verifies decimal RGB components convert precisely to strings and triggers exceptions for out-of-bounds metrics.
3. **Color Space Transitions (`rgbToHsl` and `hslToRgb`)**: Ensures color conversion accuracy when moving colors between Red-Green-Blue (RGB) and Hue-Saturation-Lightness (HSL) representations.
4. **Foreground Luminance Detection (`foreColor`)**: Assures appropriate contrast foreground color calculations (either `#fff` or `#000`) against a specified threshold.
5. **Input Normalization (`parseRgbInput`)**: Tests that both array parameters and space-padded comma-separated strings are normalized cleanly into standard arrays.

## Running Tests
Run the test runner script using the command-line interface:
```bash
php tests/color_utils_test.php
```

## Adding New Tests
Simply append standard test cases using the `assertEquals($expected, $actual, $message)` assertion function:
```php
assertEquals($expected_value, functionUnderTest($args), "Describe what is being tested");
```
The test suite will automatically keep track of total assertions run and report failed counts with descriptive feedback.
