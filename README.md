# COLOR-THEME

Universal CSS color theme system and styling framework.

[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/cahyadsn/color-theme.svg)](https://github.com/cahyadsn/color-theme/issues)
[![GitHub forks](https://img.shields.io/github/forks/cahyadsn/color-theme.svg)](https://github.com/cahyadsn/color-theme/network)
[![GitHub stars](https://img.shields.io/github/stars/cahyadsn/color-theme.svg)](https://github.com/cahyadsn/color-theme/stargazers)
[![Donate](https://img.shields.io/badge/$-support-ff69b4.svg?style=flat)](https://paypal.me/cahyadwiana)

---

## Table of Contents
- [About](#about)
- [Directory Structure](#directory-structure)
- [Available Themes](#available-themes)
- [Tools and Utilities](#tools-and-utilities)
- [How to Use](#how-to-use)
- [Roadmap / TODO](#roadmap--todo)
- [Changelog](#changelog)
- [Donations](#donations)

---

## About

**COLOR-THEME** is a versatile and lightweight CSS color theme library designed to provide ready-made styles and layouts. It includes utility tools and a dynamic color generator app that allows developers to create custom private themes easily.

---

## Directory Structure

* **[`apps/`](file:///D:/laragon/repo/dev/color-theme/apps)**: Contains web-based demonstration and theme-building applications.
  * **[`color_generator.html`](file:///D:/laragon/repo/dev/color-theme/apps/color_generator.html)**: Interactive web app to visually create, preview, and generate theme CSS.
  * **[`color-theme.css`](file:///D:/laragon/repo/dev/color-theme/apps/color-theme.css)**: The base stylesheet.
  * **[`color-theme.js`](file:///D:/laragon/repo/dev/color-theme/apps/color-theme.js)**: Color utility functions.
* **[`color-theme/`](file:///D:/laragon/repo/dev/color-theme/color-theme)**: Production-ready CSS stylesheets for pre-defined themes.
* **[`fonts/`](file:///D:/laragon/repo/dev/color-theme/fonts)**: Icon assets (FontAwesome) utilized by the application framework.
* **[`tools/`](file:///D:/laragon/repo/dev/color-theme/tools)**: PHP scripts to calculate color spaces, conversions, and theme generation.

---

## Available Themes

The repository includes pre-built themes under the **[`color-theme/`](file:///D:/laragon/repo/dev/color-theme/color-theme)** folder:
* `black-theme.css`
* `blue-theme.css`
* `brown-theme.css`
* `cyan-theme.css`
* `green-theme.css`
* `grey-theme.css`
* `indigo-theme.css`
* `orange-theme.css`
* `red-theme.css`
* `yellow-theme.css`

---

## Tools and Utilities

The **[`tools/`](file:///D:/laragon/repo/dev/color-theme/tools)** folder contains PHP utility scripts for color theory operations:
* **`theme.php`**: Generates a standard theme CSS configuration.
* **`color_gradient.php`**: Computes color gradients and transitions.
* **`rgb_dec2hex.php` / `rgb_hex2dec.php`**: Conversions between decimal and hexadecimal formats.
* **Theme Generators**:
  * `analogue_theme.php`
  * `complementary_theme.php`
  * `monochrome_theme.php`
  * `triadic_theme.php`

---

## How to Use

### Using Pre-built Themes
To use one of the pre-built themes, include the theme stylesheet in the `<head>` of your HTML document:

```html
<link rel="stylesheet" href="color-theme/blue-theme.css">
```

### Generating Custom Themes
1. Open **[`apps/color_generator.html`](file:///D:/laragon/repo/dev/color-theme/apps/color_generator.html)** in any browser.
2. Select or input a color hex code.
3. Preview the generated theme live and export the resulting CSS code.

---

## Roadmap / TODO

- [ ] Add more color options and presets for themes.
- [ ] Implement dark mode variations for each theme.

---

## Changelog

* **2025-04-03**
  * Added color theme support for striped tables.
  * Added color theme support for radio buttons, inputs, and option elements.

---

## Donations

If you find this project useful, you can support its development through the following donation channels:

* **Direct Bank Transfer (Indonesia)**:
  * **Bank BCA Digital (Blu)**: `(501) 000 576 776 186`
  * **Bank Sinarmas**: `(153) 005 462 4719`
  * **Bank Syariah Indonesia (BSI)**: `821-342-5550`
* **PayPal**: [https://paypal.me/cahyadwiana](https://paypal.me/cahyadwiana)
