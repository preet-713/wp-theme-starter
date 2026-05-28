# Helper Functions Reference

All helpers live in `inc/helpers/` and are loaded automatically via `functions.php`.  
Every function is prefixed `mytheme_` — replace that prefix with your theme slug when starting a new project.

---

## Table of Contents

- [svg.php — SVG Icons](#svgphp--svg-icons)
- [sanitize.php — Output Sanitization](#sanitizephp--output-sanitization)
- [preview.php — Block Editor Previews](#previewphp--block-editor-previews)
- [image.php — ACF Image Rendering](#imagephp--acf-image-rendering)
- [Quick-reference cheat sheet](#quick-reference-cheat-sheet)

---

## `svg.php` — SVG Icons

Uses an SVG sprite sheet located at `assets/images/svgsprit.svg`.  
Each icon in the sprite must have a unique `id` attribute — that id is what you pass as `$icon`.

---

### `mytheme_sprite_url()`

```php
mytheme_sprite_url(): string
```

Returns the absolute URL to the SVG sprite file.  
Rarely called directly — used internally by `mytheme_svg_icon()`.

**Returns:** `string` — Full URL, e.g. `https://example.com/wp-content/themes/mytheme/assets/images/svgsprit.svg`

**Example**
```php
$sprite = mytheme_sprite_url();
// https://example.com/.../svgsprit.svg
```

---

### `mytheme_svg_icon()`

```php
mytheme_svg_icon( string $icon, int $width = 24, int $height = 24, string $class = 'icon' ): void
```

Echoes an inline `<svg>` that references an icon from the sprite via `<use>`.  
Does nothing if `$icon` is empty.

| Parameter | Type     | Default  | Description                                         |
|-----------|----------|----------|-----------------------------------------------------|
| `$icon`   | `string` | —        | The sprite `id` of the icon (e.g. `chevron-right-icon`) |
| `$width`  | `int`    | `24`     | Rendered width in pixels                            |
| `$height` | `int`    | `24`     | Rendered height in pixels                           |
| `$class`  | `string` | `'icon'` | CSS class(es) applied to the `<svg>` element        |

**Returns:** `void` — outputs HTML directly.

**Examples**
```php
// Default 24×24 icon
mytheme_svg_icon( 'chevron-right-icon' );

// Custom size
mytheme_svg_icon( 'chevron-left-icon', 12, 12 );

// Custom size + extra class
mytheme_svg_icon( 'hamburger-icon', 24, 18, 'icon open-icon' );
```

**Output**
```html
<svg class="icon open-icon" width="24" height="18">
    <use xlink:href="https://…/svgsprit.svg#hamburger-icon"></use>
</svg>
```

> **Adding new icons:** Drop the SVG symbol into `svgsprit.svg` with a unique `id`, then call `mytheme_svg_icon( 'your-id' )`.

---

## `sanitize.php` — Output Sanitization

Thin wrappers around WordPress's `wp_kses` / `esc_url` functions.  
Use these instead of raw `echo` to keep templates clean and consistent.

**Rule of thumb:**

| Content type                        | Use              |
|-------------------------------------|------------------|
| Heading, label, button text (HTML)  | `mytheme_inline()` |
| WYSIWYG / long-form content         | `mytheme_rich()`   |
| Any URL                             | `mytheme_url()`    |
| CSS class / slug / modifier         | `mytheme_slug()`   |

---

### `mytheme_kses_inline()`

```php
mytheme_kses_inline(): array
```

Returns the allowed-tag array for short rich-text fields.  
Permitted tags: `<a>`, `<br>`, `<em>`, `<i>`, `<strong>`, `<b>`, `<span>`, `<sup>`, `<sub>`.

**Returns:** `array` — tag allowlist compatible with `wp_kses()`.

Mainly used internally by `mytheme_inline()`. Call it directly only if you need to pass the allowlist somewhere else.

```php
$allowed = mytheme_kses_inline();
$clean   = wp_kses( $raw_html, $allowed );
```

---

### `mytheme_kses_post()`

```php
mytheme_kses_post( string $html, bool $allow_iframe = false ): string
```

Filters HTML using WordPress's full post-level allowlist (`wp_kses_allowed_html( 'post' )`), with an optional extension to permit safe `<iframe>` attributes.

| Parameter        | Type     | Default | Description                                         |
|------------------|----------|---------|-----------------------------------------------------|
| `$html`          | `string` | —       | Raw HTML to sanitize                                |
| `$allow_iframe`  | `bool`   | `false` | Pass `true` to allow `<iframe>` (e.g. YouTube embeds) |

**Returns:** `string` — sanitized HTML.

```php
// Standard rich-text
$clean = mytheme_kses_post( get_field( 'body_content' ) );

// With iframe (e.g. embedded video)
$clean = mytheme_kses_post( get_field( 'embed_code' ), true );
```

---

### `mytheme_inline()`

```php
mytheme_inline( string $html ): void
```

**Echo** wrapper for `mytheme_kses_inline()`.  
Use for headings, titles, labels, and button text that may contain basic HTML like `<strong>` or `<a>`.

| Parameter | Type     | Description          |
|-----------|----------|----------------------|
| `$html`   | `string` | Raw HTML to sanitize and echo |

**Returns:** `void`

```php
$heading = get_field( 'heading' ); // e.g. "Reduce <strong>Risk</strong>"
mytheme_inline( $heading );
// outputs: Reduce <strong>Risk</strong>
```

> Do **not** use `mytheme_inline()` for long-form content — it strips block-level tags like `<p>` and `<ul>`. Use `mytheme_rich()` instead.

---

### `mytheme_rich()`

```php
mytheme_rich( string $html, bool $allow_iframe = false ): void
```

**Echo** wrapper for `mytheme_kses_post()`.  
Use for WYSIWYG fields and any long-form content blocks.

| Parameter       | Type     | Default | Description                          |
|-----------------|----------|---------|--------------------------------------|
| `$html`         | `string` | —       | Raw HTML                             |
| `$allow_iframe` | `bool`   | `false` | Pass `true` to allow iframe embeds   |

**Returns:** `void`

```php
$body = get_field( 'body_content' );
mytheme_rich( $body );

// With iframe (e.g. embedded map or video)
mytheme_rich( get_field( 'embed_code' ), true );
```

---

### `mytheme_url()`

```php
mytheme_url( ?string $url ): string
```

Escapes a URL and whitelists the schemes `http`, `https`, `mailto`, `tel`, and `sms`.  
Returns an empty string if `$url` is null or empty (safe to echo directly).

| Parameter | Type          | Description      |
|-----------|---------------|------------------|
| `$url`    | `string\|null` | Raw URL to escape |

**Returns:** `string` — escaped URL, or `''`.

```php
$link = get_field( 'cta_button' ); // ACF link array
echo mytheme_url( $link['url'] );

// Also safe for tel: and mailto: links
echo mytheme_url( 'tel:+13125551234' );
echo mytheme_url( 'mailto:info@example.com' );
```

> Unlike bare `esc_url()`, this will not strip `tel:` or `mailto:` schemes.

---

### `mytheme_slug()`

```php
mytheme_slug( string $value ): string
```

Converts any string into a safe CSS class / HTML ID / slug.  
Runs `sanitize_title()` then `sanitize_html_class()`.

| Parameter | Type     | Description      |
|-----------|----------|------------------|
| `$value`  | `string` | Raw string value |

**Returns:** `string` — lowercased, hyphenated, safe slug.

```php
$modifier = mytheme_slug( get_field( 'colour_variant' ) );
// "Blue Theme" → "blue-theme"

echo '<section class="block block--' . mytheme_slug( $variant ) . '">';
```

---

## `preview.php` — Block Editor Previews

These helpers power the block editor preview mode (`'mode' => 'preview'` in `acf_register_block_type`).  
When a block is viewed in the editor sidebar, WordPress passes `is_preview: true` — these functions handle that state.

**Standard pattern at the top of every block file:**
```php
if ( isset( $block['data']['is_preview'] ) && $block['data']['is_preview'] ) {
    mytheme_block_preview_placeholder( array(
        'slug'  => 'your-block-slug',
        'title' => __( 'Your Block Title', 'mytheme' ),
    ) );
    return;
}
```

---

### `mytheme_block_preview_placeholder()`

```php
mytheme_block_preview_placeholder( array $args = array() ): void
```

Renders the editor-mode preview for a block.  
**Priority:** if a preview image exists in `assets/images/blocks-preview/`, it is shown as a full-width `<img>`. Otherwise a grey fallback `<div>` is rendered with the block title, message, and optional field list.

| Key in `$args` | Type     | Default                              | Description                                         |
|----------------|----------|--------------------------------------|-----------------------------------------------------|
| `slug`         | `string` | `''`                                 | Block slug — used to find the preview image file    |
| `title`        | `string` | `'Block'`                            | Display name shown in the fallback placeholder      |
| `message`      | `string` | `'Configure this block…'`            | Helper text shown in the fallback placeholder       |
| `fields`       | `array`  | `[]`                                 | List of expected ACF field names for the hint list  |

**Returns:** `void`

```php
mytheme_block_preview_placeholder( array(
    'slug'    => 'hero-banner',
    'title'   => __( 'Hero Banner', 'mytheme' ),
    'message' => __( 'Set a heading, sub-heading, CTA, and image.', 'mytheme' ),
    'fields'  => array( 'heading', 'subheading', 'cta_button', 'image' ),
) );
```

> **Adding a preview image:** Save a `hero-banner.png` (or `.jpg`, `.webp`, `.svg`) to `assets/images/blocks-preview/`. The function finds it automatically by matching the slug.

---

### `mytheme_block_preview_image_url()`

```php
mytheme_block_preview_image_url( string $slug ): string
```

Looks for a preview image for `$slug` in `assets/images/blocks-preview/`, checking extensions `png → jpg → webp → svg` in that order.

| Parameter | Type     | Description            |
|-----------|----------|------------------------|
| `$slug`   | `string` | Block slug (e.g. `hero-banner`) |

**Returns:** `string` — full URL to the image, or `''` if none found.

Used internally by `mytheme_block_preview_placeholder()`. Call directly only if you need just the URL.

```php
$url = mytheme_block_preview_image_url( 'hero-banner' );
if ( $url ) {
    echo '<img src="' . esc_url( $url ) . '" alt="Hero Banner preview">';
}
```

---

### `mytheme_block_is_empty()`

```php
mytheme_block_is_empty( array $values ): bool
```

Returns `true` only when **every** value in `$values` is falsy (empty string, `null`, `false`, `0`, `[]`).  
Use this as a guard at the top of block templates to bail out silently when no ACF fields have been filled.

| Parameter  | Type    | Description                          |
|------------|---------|--------------------------------------|
| `$values`  | `array` | Array of ACF field values to inspect |

**Returns:** `bool` — `true` if all values are empty, `false` if at least one has content.

```php
$heading = get_field( 'heading' );
$image   = get_field( 'image' );
$cta     = get_field( 'cta_button' );

if ( mytheme_block_is_empty( array( $heading, $image, $cta ) ) ) {
    return; // nothing to render
}
```

---

## `image.php` — ACF Image Rendering

Helpers for rendering images stored as ACF image arrays (ACF returns an array with `url`, `alt`, `width`, `height`, `sizes`, etc. when the field's return format is set to **Array**).

---

### `mytheme_acf_image()`

```php
mytheme_acf_image(
    array|false $image,
    string      $size    = 'full',
    string      $loading = 'lazy',
    string      $class   = ''
): void
```

Echoes a complete, escaped `<img>` tag from an ACF image array.  
Silently returns if `$image` is empty or not an array.  
Automatically includes `width` and `height` attributes when available (helps CLS scores).

| Parameter  | Type            | Default    | Description                                                      |
|------------|-----------------|------------|------------------------------------------------------------------|
| `$image`   | `array\|false`   | —          | ACF image array (field return format must be **Array**)          |
| `$size`    | `string`        | `'full'`   | WordPress image size key (`'thumbnail'`, `'medium'`, `'large'`, `'full'`, or a custom registered size) |
| `$loading` | `string`        | `'lazy'`   | `'lazy'` for below-fold images, `'eager'` for LCP/hero images    |
| `$class`   | `string`        | `''`       | CSS class(es) to add to the `<img>` tag                          |

**Returns:** `void`

```php
$image = get_field( 'hero_image' );

// Default — lazy, full size
mytheme_acf_image( $image );

// Hero / above-fold — eager load, with a CSS class
mytheme_acf_image( $image, 'full', 'eager', 'hero-img' );

// Medium size, lazy
mytheme_acf_image( $image, 'medium' );
```

> **Set ACF return format to Array.** In the ACF field group settings, set the image field's *Return Format* to **Array** — otherwise this helper receives a URL string and will silently return nothing.

---

### `mytheme_acf_image_url()`

```php
mytheme_acf_image_url( array|false $image, string $size = 'full' ): string
```

Returns only the escaped URL string from an ACF image array.  
Use when you need the URL in a CSS `background-image`, an `href`, or a data attribute rather than a full `<img>` tag.

| Parameter | Type           | Default  | Description                                    |
|-----------|----------------|----------|------------------------------------------------|
| `$image`  | `array\|false`  | —        | ACF image array                                |
| `$size`   | `string`       | `'full'` | WordPress image size key                       |

**Returns:** `string` — escaped URL, or `''` if image is invalid.

```php
$image = get_field( 'background_image' );
$url   = mytheme_acf_image_url( $image, 'large' );

if ( $url ) {
    echo '<div class="bg-section" style="background-image: url(' . $url . ');">';
}
```

---

## Quick-Reference Cheat Sheet

| Function | File | Use for |
|---|---|---|
| `mytheme_svg_icon( $id, $w, $h, $class )` | svg.php | Render a sprite icon |
| `mytheme_sprite_url()` | svg.php | Get sprite sheet URL |
| `mytheme_inline( $html )` | sanitize.php | Echo heading / label / button HTML |
| `mytheme_rich( $html, $iframe? )` | sanitize.php | Echo WYSIWYG / long-form HTML |
| `mytheme_url( $url )` | sanitize.php | Escape & return a URL string |
| `mytheme_slug( $value )` | sanitize.php | Turn any string into a CSS-safe slug |
| `mytheme_kses_inline()` | sanitize.php | Get inline allowlist array |
| `mytheme_kses_post( $html, $iframe? )` | sanitize.php | Filter & return rich HTML |
| `mytheme_block_preview_placeholder( $args )` | preview.php | Render block editor preview |
| `mytheme_block_preview_image_url( $slug )` | preview.php | Get URL of preview image |
| `mytheme_block_is_empty( $values )` | preview.php | Guard: bail if all fields empty |
| `mytheme_acf_image( $img, $size, $loading, $class )` | image.php | Echo full `<img>` from ACF array |
| `mytheme_acf_image_url( $img, $size )` | image.php | Get URL string from ACF array |

---

> **Renaming prefix:** When you start a new theme, run a find-and-replace of `mytheme_` → `yourtheme_` across all files in `inc/helpers/` and update `functions.php` accordingly.
