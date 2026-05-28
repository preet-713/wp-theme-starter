# 💡 Tips & Best Practices

Helpful tips for working with this theme.

---

## Code Organization

### Keep functions organized by purpose

```php
// ✅ GOOD - Grouped by responsibility
inc/helpers/        // Utility functions
inc/setup/          // Theme initialization
inc/blocks/         // Block registration
post-types/         // Custom content types
blocks/             // Block templates
template-parts/     // Reusable components
```

### One file = One responsibility

```
Good:  inc/helpers/svg.php (only SVG functions)
Bad:   inc/helpers/utilities.php (SVG, images, sanitization mixed)
```

---

## Performance Tips

### 1. Lazy Load Images

Always lazy load images except above-the-fold ones:

```php
// Above the fold - eager load
the_post_thumbnail( 'full', array( 'loading' => 'eager' ) );

// Below the fold - lazy load
the_post_thumbnail( 'full', array( 'loading' => 'lazy' ) );
```

### 2. Defer Non-Critical JavaScript

In `inc/setup/assets.php`:

```php
wp_enqueue_script(
    'my-script',
    THEME_URI . '/assets/js/my-script.js',
    array(),
    VERSION,
    array(
        'in_footer' => true,
        'strategy'  => 'defer',  // Load after page renders
    )
);
```

### 3. Minimize CSS Enqueues

Combine related styles instead of many files:

```php
// ✅ GOOD
wp_enqueue_style( 'main-styles', ... );  // Contains all theme styles

// ❌ BAD
wp_enqueue_style( 'header-styles', ... );
wp_enqueue_style( 'footer-styles', ... );
wp_enqueue_style( 'blog-styles', ... );
```

### 4. Cache ACF Field Calls

If using the same field multiple times:

```php
// ✅ GOOD - store in variable
$image = get_field( 'hero_image' );
$image_url = mytheme_acf_image_url( $image );
$image_alt = $image['alt'];

// ❌ BAD - multiple get_field calls
$url = mytheme_acf_image_url( get_field( 'hero_image' ) );
$alt = get_field( 'hero_image' )['alt'];
```

---

## Security Best Practices

### Always Escape Output

```php
// ✅ GOOD - escaped
echo esc_html( get_the_title() );
echo esc_attr( $custom_class );
echo esc_url( $link_url );

// ❌ BAD - not escaped
echo get_the_title();
echo $custom_class;
echo $link_url;
```

### Use Helper Functions for Safety

```php
// ✅ GOOD - uses built-in sanitization
mytheme_inline( get_field( 'heading' ) );
mytheme_rich( get_field( 'content' ) );
mytheme_url( get_field( 'link' ) );

// ❌ BAD - no sanitization
echo get_field( 'heading' );
echo get_field( 'content' );
echo get_field( 'link' );
```

### Sanitize User Input

```php
// ✅ GOOD - sanitize form input
$email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
$name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';

// ❌ BAD - no sanitization
$email = $_POST['email'];
$name = $_POST['name'];
```

### Verify Nonces for Form Submissions

```php
// ✅ GOOD - verify nonce
if ( isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'my_action' ) ) {
    // Process form
}

// ❌ BAD - no nonce check
if ( isset( $_POST['submit'] ) ) {
    // Process form
}
```

---

## Naming Conventions

### File Names

```
kebab-case (lowercase with hyphens):
  hero-banner.php      ✅
  HeroBanner.php       ❌
  hero_banner.php      ❌ (underscore for vars, not files)
```

### Function Names

```
snake_case with theme prefix:
  mytheme_get_hero_content()     ✅
  mytheme_getHeroContent()       ❌
  get_hero_content()             ❌ (no prefix = conflicts)
```

### CSS Classes

```
kebab-case and semantic:
  .entry-header                  ✅
  .entry_header                  ❌
  .eh                            ❌ (not semantic)
  .red-text                      ❌ (describes appearance, not content)
```

### PHP Variables

```
camelCase for most, snake_case for WordPress compatibility:
  $heroImage             ✅
  $hero_image            ✅ (WordPress convention)
  $HERO_IMAGE            ❌ (CONSTANTS only)
  $heroimage             ❌ (hard to read)
```

---

## Debugging Tips

### Check if a Function Exists

```php
if ( function_exists( 'mytheme_inline' ) ) {
    mytheme_inline( $text );
} else {
    echo esc_html( $text );
}
```

### Debug ACF Field Values

```php
// Check what data is available
$image = get_field( 'hero_image' );
echo '<pre>';
var_dump( $image );
echo '</pre>';
```

### Check WordPress Constants

```php
// Verify paths are correct
echo THEME_DIR;   // Should be: /var/www/html/wp-content/themes/your-theme
echo THEME_URI;   // Should be: http://yoursite.com/wp-content/themes/your-theme
```

### Enable Debug Mode

In `wp-config.php`:

```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

// Then check: /wp-content/debug.log
```

---

## Common Mistakes to Avoid

### ❌ Mistake 1: Hardcoding URLs

```php
// BAD - breaks if site URL changes
echo '<img src="http://mysite.com/wp-content/themes/my-theme/logo.png">';

// GOOD - uses constants
echo '<img src="' . esc_url( THEME_URI . '/assets/images/logo.png' ) . '">';
```

### ❌ Mistake 2: Using Global Variables Directly

```php
// BAD - unreliable, might not exist
$post = $GLOBALS['post'];

// GOOD - use WordPress functions
$post = get_post();
```

### ❌ Mistake 3: Not Checking if Post Has Data

```php
// BAD - will error if post has no thumbnail
the_post_thumbnail();

// GOOD - check first
if ( has_post_thumbnail() ) {
    the_post_thumbnail();
}
```

### ❌ Mistake 4: Echo Instead of Return

```php
// BAD - ties output to logic
function my_function() {
    $text = 'Hello';
    echo $text;  // Can't reuse this
}

// GOOD - return value for flexibility
function my_function() {
    return 'Hello';
}
$text = my_function();
echo esc_html( $text );
```

### ❌ Mistake 5: Using Outdated WordPress Functions

```php
// BAD - deprecated
the_widget();

// GOOD - use current functions
if ( is_active_sidebar( 'sidebar-id' ) ) {
    dynamic_sidebar( 'sidebar-id' );
}
```

---

## Working with ACF

### Always Set Return Format to Array

For images, always use "Array" return format in ACF field settings:

```php
// When return format is Array:
$image = get_field( 'hero_image' );
$url = $image['url'];
$alt = $image['alt'];

// ✅ Use helper function:
mytheme_acf_image( $image );
```

### Handle Repeating Fields Properly

```php
$items = get_field( 'features' );
if ( $items ) {
    foreach ( $items as $item ) {
        echo esc_html( $item['title'] );
    }
}
```

### Check for Empty Groups

```php
$group = get_field( 'hero_section' );
if ( $group ) {
    echo esc_html( $group['heading'] );
    echo esc_html( $group['subheading'] );
}
```

---

## Block Development Tips

### Always Check Preview Mode

At the top of every block template:

```php
if ( isset( $block['data']['is_preview'] ) && $block['data']['is_preview'] ) {
    mytheme_block_preview_placeholder( array(
        'slug'  => 'my-block',
        'title' => __( 'My Block', 'mytheme' ),
    ) );
    return;
}
```

### Provide Block Preview Images

Add a preview image in `/assets/images/blocks-preview/`:

```
/assets/images/blocks-preview/hero-banner.png  (600×400px recommended)
```

It will automatically show in the editor instead of the placeholder.

### Test Block with Empty Fields

Make sure the block doesn't error when fields are empty:

```php
if ( mytheme_block_is_empty( array( $field1, $field2, $field3 ) ) ) {
    return;  // Don't render anything
}
```

---

## WordPress Template Hierarchy

Understand which template loads for each URL:

```
Home Page (static):   front-page.php → home.php → index.php
Blog List:            home.php → index.php
Single Post:          single-post.php → single.php → index.php
Single Page:          page-{slug}.php → page.php → index.php
Archive:              archive-{type}.php → archive.php → index.php
Category:             category-{slug}.php → category.php → archive.php → index.php
Search:               search.php → index.php
404:                  404.php → index.php
```

Create specific templates for more control. WordPress automatically selects them.

---

## Useful WordPress Functions

### Conditional Tags

```php
if ( is_home() ) { }              // Blog listing page
if ( is_single() ) { }            // Single post/CPT
if ( is_archive() ) { }           // Any archive
if ( is_page() ) { }              // Static page
if ( is_front_page() ) { }        // Homepage
if ( is_search() ) { }            // Search results
if ( is_404() ) { }               // 404 page
if ( is_singular() ) { }          // Single post OR page
if ( is_admin() ) { }             // WordPress admin
```

### Post Data Functions

```php
get_the_ID()                      // Get current post ID
get_the_title()                   // Get post title
get_the_excerpt()                 // Get post excerpt
get_the_content()                 // Get full post content (use the_content() to echo)
get_the_post_thumbnail()          // Get featured image HTML
get_permalink()                   // Get post URL
get_the_date()                    // Get post publish date
get_the_author()                  // Get author name
```

### Navigation Functions

```php
wp_nav_menu()                     // Output navigation menu
has_nav_menu()                    // Check if menu exists
wp_get_nav_menu_items()           // Get menu items as array
```

### Query Functions

```php
new WP_Query( $args )             // Query posts
get_posts( $args )                // Simpler query
wp_reset_postdata()               // Reset after custom query
```

---

## Performance Checklist

- [ ] Images are lazy-loaded (except above-fold)
- [ ] Non-critical JS has `'strategy' => 'defer'`
- [ ] CSS is minified in production
- [ ] Database queries are cached when possible
- [ ] Only necessary JS/CSS files are enqueued
- [ ] No plugins are unnecessary
- [ ] Images are optimized (WebP, small file size)

---

## Code Review Checklist

Before committing code:

- [ ] All output is escaped (esc_html, esc_attr, esc_url, etc.)
- [ ] All ACF fields are checked for existence
- [ ] Template hierarchy is correct for the template
- [ ] Functions are properly documented
- [ ] No hardcoded URLs (use THEME_URI/THEME_DIR)
- [ ] Proper use of WordPress functions
- [ ] No debugging code left (var_dump, console.log, etc.)
- [ ] Code follows naming conventions

---

See [README.md](README.md) for more documentation.
