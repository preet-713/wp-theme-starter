# 💬 Code Comments Guide

How to document code in this theme so other developers (and future-you) understand it.

---

## File Header Comments

Every PHP file should start with a doc block explaining its purpose:

```php
<?php
/**
 * File description - what this file does and why it exists.
 *
 * WHEN IT'S USED: What triggers this file to load?
 * WHAT IT DOES: Step-by-step of what happens
 * USAGE EXAMPLES: How developers use it
 *
 * @package MyTheme\Category
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;
```

### Template File Header

```php
<?php
/**
 * Template Name: Single Post Template
 *
 * LOADED BY: WordPress when viewing a single blog post
 * HIERARCHY: single-{post-type}.php → single.php → index.php
 *
 * WHAT IT DOES:
 * - Displays post title, featured image, and content
 * - Shows post metadata (date, author, etc.)
 * - Loads header and footer
 *
 * USAGE:
 * This is automatically selected by WordPress.
 * No explicit function call needed.
 *
 * TO CUSTOMIZE:
 * - Add post comments
 * - Add related posts section
 * - Change HTML structure
 * - Add custom CSS classes
 *
 * @package MyTheme
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;
```

---

## Function Comments

Document every function with its purpose, parameters, and return value:

```php
/**
 * Short description of what the function does.
 *
 * WHEN TO USE: What problem does it solve?
 * HOW TO USE: Usage example
 * RETURNS: What does it output or return?
 *
 * @param string $text     Description of parameter
 * @param int    $count    Description of parameter
 * @return string          What it returns
 *
 * @since 1.0.0
 */
function mytheme_my_function( $text, $count = 5 ) {
    // Function body
}
```

### Real Example

```php
/**
 * Output a sanitized heading with inline HTML allowed.
 *
 * USE FOR: Headings, titles, labels that might contain <strong>, <em>, etc.
 * DON'T USE FOR: Long-form content, WYSIWYG fields (use mytheme_rich instead)
 *
 * EXAMPLE:
 *   $heading = get_field( 'page_heading' );
 *   mytheme_inline( $heading ); // Outputs with safety
 *
 * @param string $html HTML string to sanitize and output
 * @return void Echoes directly to page
 *
 * @since 1.0.0
 */
function mytheme_inline( string $html ): void {
    echo wp_kses( $html, mytheme_kses_inline() );
}
```

---

## Action/Hook Comments

Document when hooks are called and what they do:

```php
/**
 * Hook: wp_enqueue_scripts
 * Fires when WordPress loads scripts on the frontend
 * Priority: 20 (runs after other scripts are enqueued)
 */
add_action(
    'wp_enqueue_scripts',
    static function (): void {
        // Enqueue all theme scripts and styles here
        wp_enqueue_style( 'main-style', ... );
    },
    20
);
```

---

## Section Comments

Break up long files into sections with clear headers:

```php
/* ==========================================================================
   CSS Custom Properties (Design Tokens)
   ========================================================================== */

:root {
    --primary-color: #0073aa;
}

/* ==========================================================================
   Typography
   ========================================================================== */

h1 {
    font-size: 2.5rem;
}
```

---

## Inline Comments

Use inline comments sparingly - only when the WHY is not obvious:

### ✅ Good — Explains WHY

```php
// Check if in editor preview mode to show placeholder instead of dynamic content
if ( isset( $block['data']['is_preview'] ) && $block['data']['is_preview'] ) {
    mytheme_block_preview_placeholder( ... );
    return;
}
```

### ❌ Bad — Just describes WHAT (code already says that)

```php
// Check if is preview
if ( isset( $block['data']['is_preview'] ) && $block['data']['is_preview'] ) {
    // Show placeholder
    mytheme_block_preview_placeholder( ... );
    // Return early
    return;
}
```

---

## Conditional Comments

When using complex logic, explain what conditions are being checked:

```php
/**
 * Only show featured post if:
 * 1. Posts exist
 * 2. We're on the blog homepage (not archive or single)
 * 3. Featured post has a featured image
 */
if ( have_posts() && is_home() && has_post_thumbnail() ) {
    // Show featured post
}
```

---

## Block Comments

Document block templates thoroughly since they're often customized:

```php
<?php
/**
 * Hero Banner Block Template
 *
 * USED IN: Gutenberg editor as "Hero Banner" block
 * ACF FIELDS:
 *   - heading       (Text)
 *   - subheading    (Textarea)
 *   - cta_button    (Link)
 *   - image         (Image - return format: Array)
 *
 * WORKFLOW:
 * 1. Check if in editor preview mode
 * 2. Get ACF field values
 * 3. Check if fields are empty (bail if so)
 * 4. Output HTML with field values
 *
 * TO CUSTOMIZE:
 * - Add more ACF fields (color, animation, etc.)
 * - Change HTML structure
 * - Add background overlay
 * - Add video background option
 */

defined( 'ABSPATH' ) || exit;

// Show placeholder in editor
if ( isset( $block['data']['is_preview'] ) && $block['data']['is_preview'] ) {
    mytheme_block_preview_placeholder( ... );
    return;
}

// Get all ACF fields
$heading    = get_field( 'heading' );
$subheading = get_field( 'subheading' );
$cta_btn    = get_field( 'cta_button' );
$image      = get_field( 'image' );

// Bail early if no fields filled
if ( mytheme_block_is_empty( array( $heading, $subheading, $cta_btn, $image ) ) ) {
    return;
}

// Output the block
?>
<section>...</section>
```

---

## Template Part Comments

Document what each template part is for:

```php
<?php
/**
 * Blog Card Template Part
 *
 * RENDERS: A single blog post card for listing pages
 * USED BY: home.php, archive.php (inside loops)
 * VARIABLES AVAILABLE: (all post data from have_posts/the_post)
 *
 * OUTPUTS: <li><article>...</article></li>
 * 
 * CUSTOMIZATION:
 * - Add post date: <?php the_date( 'F j, Y' ); ?>
 * - Add author: <?php the_author(); ?>
 * - Add categories: <?php the_category( ', ' ); ?>
 */

defined( 'ABSPATH' ) || exit;
?>
<li>
    <article>
        <!-- Content here -->
    </article>
</li>
```

---

## Setup File Comments

Explain what each setup file initializes:

```php
<?php
/**
 * Theme Support Setup
 *
 * WHAT IT DOES: Enables WordPress theme features
 * WHEN: After theme is set up (after_setup_theme hook)
 *
 * FEATURES ENABLED:
 * - post-thumbnails       Featured images
 * - custom-logo           Site logo in customizer
 * - title-tag             Let WordPress manage <title>
 * - html5                 Use HTML5 markup
 * - editor-styles         Style Gutenberg editor
 * - responsive-embeds     Make embeds responsive
 * - link-color            Allow users to change link color
 */

defined( 'ABSPATH' ) || exit;

add_action(
    'after_setup_theme',
    static function (): void {
        // Enable features here
    }
);
```

---

## What NOT to Comment

❌ **Don't comment obvious code:**

```php
// BAD - code is self-explanatory
$post_id = get_the_ID();                  // Get the post ID
$title = get_the_title();                 // Get the title
echo wp_kses_post( $content );            // Echo the content
```

❌ **Don't restate variable names:**

```php
// BAD - comment just repeats variable name
$featured_image = get_the_post_thumbnail(); // Get featured image
```

❌ **Don't reference specific users or tasks:**

```php
// BAD - rots as the codebase evolves
// John requested this on 2024-05-15
// Used by the "user registration" feature
// Handles case from issue #123
```

---

## What TO Comment

✅ **Do explain WHY (non-obvious reasons):**

```php
// GOOD - explains the reason
// Lazy load images below the fold for better Core Web Vitals
the_post_thumbnail( 'full', array( 'loading' => 'lazy' ) );
```

✅ **Do document complex logic:**

```php
// GOOD - explains the workflow
if ( have_posts() && is_home() && ! is_admin() ) {
    // Show featured post only on blog homepage, not admin
}
```

✅ **Do use comments for warnings:**

```php
// WARNING: Don't change this without updating the database query
// The 'post_status' must match the custom post type registration
```

---

## Comment Checklist

- [ ] Every file has a header docblock
- [ ] Every function has a docblock with @param and @return
- [ ] Complex logic is explained with inline comments
- [ ] WHY is documented, not WHAT
- [ ] No outdated comments (remove old to-do items)
- [ ] No commented-out code (delete or remove entirely)
- [ ] No references to specific people or dates

---

## Tools That Use Comments

### IDE Autocomplete

When you type a function name, IDEs show the docblock:

```
mytheme_inline( ✓
Description: Output a sanitized heading with inline HTML...
@param string $html
@return void
```

Good comments = better IDE support = faster coding.

### Documentation Generators

Tools like [phpDocumentor](https://www.phpdoc.org/) parse docblocks to generate HTML docs.

### Static Analyzers

Tools like [PHPStan](https://phpstan.org/) use docblocks to catch type errors:

```php
/**
 * @param string $text
 * @return int
 */
function get_word_count( string $text ): int {
    return str_word_count( $text );
}
```

---

## Summary

| Type | Rule |
|------|------|
| **File header** | Explain what the file does and when it's used |
| **Functions** | Document parameters, return value, usage |
| **Hooks** | Explain when the hook fires and why |
| **Complex logic** | Explain the WHY and the workflow |
| **Inline comments** | Only when the code's intent isn't obvious |
| **Don't comment** | Self-explanatory code, variable names, outdated notes |

---

Remember: **Good code is self-documenting. Great code includes comments explaining WHY.**
