# Theme Starter — Quick Start Guide

A modern, minimal WordPress theme boilerplate with clean code, semantic HTML, and WordPress best practices.

---

## 📋 What's Inside

### Root Files
- **`style.css`** — Theme header (required by WordPress) + base styles
- **`functions.php`** — Theme initialization and module autoloader
- **`header.php`** — Opens `<html>`, loads CSS/JS, outputs site header
- **`footer.php`** — Outputs footer menus and closes `</html>`
- **`index.php`** — Fallback template (loads when no specific template matches)
- **`front-page.php`** — Homepage template
- **`home.php`** — Blog listing page
- **`archive.php`** — Category/tag/author archive pages
- **`single.php`** — Single blog post template
- **`page.php`** — Static page template
- **`404.php`** — 404 error page
- **`search.php`** — Search results page
- **`searchform.php`** — Search form component

### Folders

#### `/assets/css`
Stylesheets for the theme:
- **`style.css`** — Base styles, typography, WordPress standard classes
- **`media.css`** — Responsive design media queries
- **`editor.css`** — Gutenberg block editor styles

#### `/assets/js`
JavaScript files:
- **`setting.js`** — Main theme JS (menu toggle, Embla Carousel initialization)
- Add jQuery/external libraries here

#### `/assets/fonts`
Web fonts directory (woff2, etc.)

#### `/assets/images`
All images:
- **`icons/`** — SVG icons
- **`blocks-preview/`** — Block editor preview images

#### `/inc/setup`
Theme initialization files:
- **`assets.php`** — Enqueue CSS/JS files with wp_enqueue_style/script
- **`menus.php`** — Register navigation menu locations
- **`theme-support.php`** — Add WordPress theme support (post-thumbnails, etc.)

#### `/inc/helpers`
Utility functions (see [HELPERS.md](inc/helpers/HELPERS.md)):
- **`svg.php`** — SVG icon functions
- **`sanitize.php`** — Output sanitization (escape HTML/URLs)
- **`preview.php`** — Block editor preview helpers
- **`image.php`** — ACF image helpers
- **`HELPERS.md`** — Full documentation of all helpers

#### `/inc/blocks`
Gutenberg block management:
- **`category.php`** — Register custom block category
- **`register.php`** — Register all custom ACF blocks

#### `/blocks`
Custom Gutenberg block templates:
- **`hero-banner.php`** — Example block (copy this for new blocks)

#### `/post-types`
Custom post type definitions:
- **`example-cpt.php`** — Template for custom post types

#### `/template-parts`
Reusable template components:
- **`content.php`** — Default post content display
- **`blog/card.php`** — Blog post card (used in lists)
- **`blog/card-featured.php`** — Featured blog post card
- **`blog/pagination.php`** — Pagination navigation

#### `/templates`
Page templates (shown in WordPress > Page > Template):
- **`template-blank.php`** — Full-width blank page (for Gutenberg blocks)

---

## 🚀 Getting Started

### 1. Rename Your Theme

Replace `mytheme` with your actual theme slug throughout the entire theme:

```bash
# Using Find & Replace in your code editor:
Find:    mytheme
Replace: yourthemeslug
```

Update these files especially:
- `style.css` (Text Domain)
- `functions.php` (all constants and prefixes)
- All files in `/inc/` folders

### 2. Update `style.css` Header

Edit the theme information at the top of `style.css`:

```css
Theme Name: Your Theme Name
Theme URI: https://yourwebsite.com
Author: Your Name
Author URI: https://yourwebsite.com
Description: What your theme does
```

### 3. Create Menus

Register additional menus in `inc/setup/menus.php`:

```php
register_nav_menus(
    array(
        'main_menu'     => 'Main Menu',
        'footer_menu_1' => 'Footer Menu One',
        'footer_menu_2' => 'Footer Menu Two',
        'legal_pages'   => 'Legal Pages Nav',
        // Add more:
        'mobile_menu'   => 'Mobile Navigation',
    )
);
```

Then output in templates using:
```php
wp_nav_menu( array( 'theme_location' => 'mobile_menu' ) );
```

### 4. Enqueue Assets

Add CSS/JS files in `inc/setup/assets.php`:

```php
wp_enqueue_style(
    'my-style',
    THEME_URI . '/assets/css/my-style.css',
    array(),
    VERSION
);
```

### 5. Add Custom Blocks (ACF Required)

1. **Create block template** in `/blocks/my-block.php`
2. **Add ACF field group** in WordPress admin
3. **Register block** in `inc/blocks/register.php`:

```php
array(
    'name'        => 'my-block',
    'title'       => __( 'My Block', 'mytheme' ),
    'description' => __( 'Description', 'mytheme' ),
    'icon'        => 'star',
    'keywords'    => array( 'my', 'block' ),
),
```

See `blocks/hero-banner.php` for a complete example.

### 6. Create Custom Post Types

1. **Create file** `/post-types/my-post-type.php`
2. **Register in** `functions.php`:

```php
require_once THEME_DIR . '/post-types/my-post-type.php';
```

See `post-types/example-cpt.php` for a template.

---

## 📚 File Locations & Usage

### Template Selection (WordPress Hierarchy)

When a visitor goes to a URL, WordPress looks for templates in this order:

```
Single Post:
  single-{post-type}.php → single.php → index.php

Archive:
  archive-{post-type}.php → archive.php → index.php

Homepage (static page):
  front-page.php → home.php → index.php

Blog listing:
  home.php → index.php

Page:
  page-{slug}.php → page.php → index.php

Search:
  search.php → index.php

404:
  404.php → index.php
```

### Helper Functions

See **[`inc/helpers/HELPERS.md`](inc/helpers/HELPERS.md)** for detailed docs on:

#### Sanitization (Output Safety)
```php
mytheme_inline( $html )      // Echo short HTML (headings, labels)
mytheme_rich( $html )        // Echo long-form HTML (WYSIWYG)
mytheme_url( $url )          // Escape URL (tel:, mailto:, http, https)
mytheme_slug( $string )      // Convert to CSS-safe slug
```

#### SVG Icons
```php
mytheme_svg_icon( 'icon-id', 24, 24, 'class-name' )  // Echo SVG icon
mytheme_sprite_url()                                   // Get sprite URL
```

#### ACF Images
```php
mytheme_acf_image( $image, 'full', 'lazy', 'class' )  // Echo <img>
mytheme_acf_image_url( $image, 'full' )               // Get image URL
```

#### Block Helpers
```php
mytheme_block_preview_placeholder( $args )  // Show editor preview
mytheme_block_is_empty( $values )          // Check if fields are empty
```

---

## 🎨 Customizing Styles

### CSS Structure

**`style.css`** — Base styles
- HTML reset
- Typography (h1–h6, p, a, lists)
- WordPress standard classes

**`media.css`** — Responsive design
- Breakpoints: lg (1024px), md (768px), sm (640px)
- Heading size adjustments
- Mobile adjustments

**`editor.css`** — Editor styling
- Styles for `.editor-styles-wrapper` (Gutenberg editor)
- Ensures editor preview matches frontend

### Adding Custom Styles

Create new CSS files in `/assets/css/`:

```php
// In inc/setup/assets.php:
wp_enqueue_style(
    'my-styles',
    THEME_URI . '/assets/css/my-styles.css',
    array( 'main-style' ),  // Dependency (load after main-style)
    VERSION
);
```

### CSS Variables

Add reusable design tokens:

```css
:root {
    --primary-color: #0073aa;
    --font-stack: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

body {
    color: var(--primary-color);
    font-family: var(--font-stack);
}
```

---

## 🔧 Common Tasks

### Add a Search Form to Header
```php
// In header.php, inside <nav>:
<?php get_search_form(); ?>
```

### Add Sidebar/Widget Area
```php
// In inc/setup/theme-support.php, add:
add_theme_support( 'widgets' );
register_sidebar( array(
    'name'          => 'Primary Sidebar',
    'id'            => 'primary-sidebar',
    'description'   => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
) );

// In template, display:
<?php
if ( is_active_sidebar( 'primary-sidebar' ) ) {
    dynamic_sidebar( 'primary-sidebar' );
}
?>
```

### Add Related Posts
```php
// In single.php, before get_footer():
<?php
$args = array(
    'posts_per_page' => 3,
    'post__not_in'   => array( get_the_ID() ),
);
$related = new WP_Query( $args );
if ( $related->have_posts() ) {
    echo '<h3>Related Posts</h3>';
    while ( $related->have_posts() ) {
        $related->the_post();
        get_template_part( 'template-parts/blog/card' );
    }
    wp_reset_postdata();
}
?>
```

### Add Comments
```php
// In single.php, in entry-content div:
<?php
if ( comments_open() || get_comments_number() ) {
    comments_template();
}
?>
```

---

## 📖 WordPress Functions Reference

### Content Output
```php
the_title()            // Echo post title
the_content()          // Echo post content
the_excerpt()          // Echo post excerpt
the_permalink()        // Echo post URL
the_post_thumbnail()   // Echo featured image
the_ID()               // Echo post ID
```

### Conditionals
```php
have_posts()           // Check if posts exist in loop
has_post_thumbnail()   // Check if featured image exists
is_single()            // Check if single post page
is_archive()           // Check if archive page
is_front_page()        // Check if homepage
```

### Menus
```php
wp_nav_menu()          // Output navigation menu
has_nav_menu()         // Check if menu has items assigned
register_nav_menus()   // Register menu location
```

### Escaping (Safety)
```php
esc_html()             // Escape for HTML context
esc_attr()             // Escape for HTML attributes
esc_url()              // Escape URL
wp_kses_post()         // Allow safe HTML in post content
```

---

## ✅ Checklist Before Launch

- [ ] Update theme name, author, URI in `style.css`
- [ ] Replace `mytheme` prefix with your theme slug everywhere
- [ ] Test all template pages (home, single post, archive, page, 404, search)
- [ ] Set menus in WordPress admin > Appearance > Menus
- [ ] Set homepage in WordPress admin > Settings > Reading
- [ ] Test responsive design on mobile
- [ ] Check that all CSS/JS files load (no 404 errors)
- [ ] Validate HTML output (https://validator.w3.org/)
- [ ] Test with multiple browsers

---

## 🆘 Troubleshooting

### "Function mytheme_* is undefined"
- Make sure the helper files are loaded in `functions.php`
- Check that the module path is correct in the `$mytheme_modules` array

### CSS/JS not loading
- Check `inc/setup/assets.php` — verify file paths are correct
- Use `THEME_URI` (for URLs) not `THEME_DIR` (for file paths)
- Make sure `VERSION` constant is defined in `functions.php`

### Block not showing in editor
- Verify ACF is installed and activated
- Check that block is registered in `inc/blocks/register.php`
- Confirm ACF field group is created and assigned to the block
- Check block template file exists at the correct path

### Menu not appearing
- Register menu in `inc/setup/menus.php`
- Assign menu in WordPress admin > Appearance > Menus
- Use correct `theme_location` in `wp_nav_menu()` call
- Check template uses `wp_nav_menu()` to output the menu

---

## 📚 More Resources

- [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- [WordPress Plugin & Theme Security](https://developer.wordpress.org/plugins/security/)
- [ACF Documentation](https://www.advancedcustomfields.com/resources/)
- [Helper Functions Docs](inc/helpers/HELPERS.md)

---

## 📝 License

This starter theme is free to use and modify. See LICENSE file for details.

---

**Happy coding!** 🎉

For detailed documentation on helper functions, see [`inc/helpers/HELPERS.md`](inc/helpers/HELPERS.md)
