# 📁 Theme Folder Structure

Complete breakdown of every folder and file.

---

## Root Level Files

### Core Theme Files (Required by WordPress)

```
style.css              WordPress reads this to detect the theme
                       MUST include: Theme Name, Author, License, etc.
                       ALSO contains: base styles, typography, reset

functions.php          Theme initialization & module loader
                       - Defines global constants (VERSION, THEME_URI, THEME_DIR)
                       - Auto-loads all helper functions and setup files
                       - Registers custom post types (optional)
```

### Template Files (Auto-selected by WordPress)

```
index.php              Fallback template (loads if no specific template found)
                       Used by: archives, 404, search, any unmatched URL

front-page.php         Homepage template
                       Loaded when: static page is set as homepage in Settings

home.php               Blog listing page
                       Loaded when: "Your latest posts" is set as homepage

single.php             Single blog post template
                       Loaded when: viewing a blog post

page.php               Static page template
                       Loaded when: viewing a static page (About, Contact, etc.)

archive.php            Archive page template
                       Loaded when: viewing category, tag, author, date archives

search.php             Search results template
                       Loaded when: user searches via search form

404.php                404 Not Found template
                       Loaded when: user visits a non-existent page

searchform.php         Search form component
                       Used by: get_search_form() function

header.php             Page header (opens HTML, loads CSS/JS)
                       Loaded by: get_header() in every template
                       Outputs: <html>, <head>, <body>, <header>

footer.php             Page footer (closes HTML)
                       Loaded by: get_footer() in every template
                       Outputs: <footer>, </body>, </html>
```

---

## `/inc/` — Helper Modules & Setup

Auto-loaded by `functions.php`. Each file handles a specific concern.

### `/inc/setup/` — Theme Initialization

```
assets.php             WHAT: Enqueue CSS & JavaScript files
                       WHERE: Called by WordPress 'wp_enqueue_scripts' hook
                       HOW TO USE: Add new wp_enqueue_style() and wp_enqueue_script() calls
                       EXAMPLE: wp_enqueue_style( 'my-style', THEME_URI . '/assets/css/custom.css' )

menus.php              WHAT: Register navigation menu locations
                       WHERE: Called by WordPress 'after_setup_theme' hook
                       HOW TO USE: Add menu locations to register_nav_menus() array
                       EXAMPLE: 'sidebar_menu' => 'Sidebar Navigation'
                       THEN USE: wp_nav_menu( array( 'theme_location' => 'sidebar_menu' ) )

theme-support.php      WHAT: Enable WordPress theme features
                       WHERE: Called by WordPress 'after_setup_theme' hook
                       FEATURES: post-thumbnails, custom-logo, title-tag, HTML5, etc.
                       HOW TO USE: Add add_theme_support() calls for new features
```

### `/inc/helpers/` — Utility Functions (See HELPERS.md for full docs)

```
svg.php                SVG icon helper functions
                       mytheme_svg_icon()     Output icon from sprite
                       mytheme_sprite_url()   Get sprite URL

sanitize.php           Output sanitization & escaping
                       mytheme_inline()       Echo HTML-safe short text
                       mytheme_rich()         Echo HTML-safe long-form content
                       mytheme_url()          Escape URLs
                       mytheme_slug()         Convert string to CSS-safe slug
                       mytheme_kses_inline()  Get allowed tags array (short text)
                       mytheme_kses_post()    Filter & escape long-form HTML

preview.php            Block editor preview helpers
                       mytheme_block_preview_placeholder() Show block preview in editor
                       mytheme_block_preview_image_url()   Get preview image URL
                       mytheme_block_is_empty()            Check if fields are empty

image.php              ACF image helpers
                       mytheme_acf_image()        Echo <img> from ACF image array
                       mytheme_acf_image_url()    Get image URL from ACF array

HELPERS.md             Complete documentation of all helper functions
                       Full signatures, parameters, examples, usage tips
```

### `/inc/blocks/` — Block Registration

```
category.php           Register custom block category
                       Makes custom blocks appear under "MyTheme" category in editor

register.php           Register all custom ACF blocks
                       Each block must be listed here to appear in editor
                       USAGE: Add array to $blocks with name, title, description, icon
```

---

## `/blocks/` — Custom Gutenberg Blocks

Custom block templates (requires ACF Pro or Free).

```
hero-banner.php        Example block template
                       Shows: How to get ACF fields, check if empty, output HTML
                       COPY THIS: When creating new blocks
                       TO USE: Register in inc/blocks/register.php
```

### Block File Pattern

Every block file should:

1. Check if in editor preview mode (show placeholder)
2. Get ACF field values using get_field()
3. Check if all fields are empty (bail early if so)
4. Output the HTML with content

---

## `/post-types/` — Custom Post Types

Define custom content types beyond "Posts" and "Pages".

```
example-cpt.php        Template for creating custom post types
                       EXAMPLE: Create product, testimonial, case-study post types
                       TO USE: Copy this file, rename, customize, include in functions.php
```

---

## `/template-parts/` — Reusable Components

Small, reusable template pieces. Loaded via `get_template_part()`.

```
content.php            Default post content display
                       Used by: index.php and other fallback templates

/blog/
  card.php             Blog post card (for listing pages)
                       Used by: home.php, archive.php (in loops)
                       PATTERN: <li><article>...</article></li>

  card-featured.php    Featured blog post card (larger, for homepage)
                       Used by: home.php (for first post)
                       PATTERN: <article>...</article>

  pagination.php       Pagination navigation
                       Used by: home.php, archive.php (after post loop)
                       OUTPUTS: Previous/Next buttons and page numbers
```

### How to Use Template Parts

In any template:

```php
// Load template-parts/blog/card.php
get_template_part( 'template-parts/blog/card' );

// Load template-parts/blog/card-featured.php
get_template_part( 'template-parts/blog/card', 'featured' );
```

---

## `/templates/` — Custom Page Templates

Special page layouts shown in WordPress Admin > Page Edit > Template dropdown.

```
template-blank.php     Full-width blank page
                       Used for: Landing pages, custom Gutenberg layouts
                       PATTERN: No sidebars, full-width content
```

### Creating Custom Page Templates

1. Create file: `templates/template-my-layout.php`
2. Add header:
   ```php
   <?php
   /**
    * Template Name: My Layout
    * Template Post Type: page
    */
   ```
3. Appears in WordPress under "Page" > "Template" dropdown

---

## `/assets/` — Static Files

### `/assets/css/`

```
style.css              Main stylesheet
                       - HTML reset
                       - Typography (h1-h6, p, a, lists)
                       - WordPress standard classes
                       - Base layout

media.css              Responsive design
                       - Breakpoints: lg, md, sm
                       - Mobile typography adjustments
                       - Responsive utilities

editor.css             Block editor styles
                       - Scoped to .editor-styles-wrapper
                       - Preview styling for Gutenberg editor
                       - Ensures editor preview matches frontend
```

### `/assets/js/`

```
setting.js             Main theme JavaScript
                       - Mobile menu toggle
                       - Embla Carousel initialization
                       - Any custom JS code

(Add more JavaScript files here and enqueue in inc/setup/assets.php)
```

### `/assets/fonts/`

Store web fonts here (woff2 files for best support).

Enqueue in `inc/setup/assets.php`:

```php
wp_enqueue_style(
    'custom-fonts',
    THEME_URI . '/assets/fonts/fonts.css',
    array(),
    VERSION
);
```

### `/assets/images/`

```
/icons/                SVG icon files (if not using sprite sheet)

/blocks-preview/       Preview images for blocks
                       Files: {block-slug}.png (e.g., hero-banner.png)
                       Size: Recommended 600×400px
                       Used by: mytheme_block_preview_image_url()
                       Shows in block editor when block is not configured

(Add other images: logos, placeholders, etc.)
```

---

## Folder Tree

```
your-theme/
├── style.css                 Theme header + base styles
├── functions.php             Theme bootstrap & module loader
├── index.php                 Fallback template
├── front-page.php            Homepage
├── home.php                  Blog listing
├── single.php                Single post
├── page.php                  Single page
├── archive.php               Category/tag archives
├── search.php                Search results
├── 404.php                   404 error
├── searchform.php            Search form
├── header.php                Page header (open HTML)
├── footer.php                Page footer (close HTML)
├── README.md                 Full documentation
├── QUICKSTART.md             5-minute setup guide
├── STRUCTURE.md              This file
│
├── inc/
│   ├── setup/
│   │   ├── assets.php        Enqueue CSS/JS
│   │   ├── menus.php         Register menu locations
│   │   └── theme-support.php Enable theme features
│   ├── helpers/
│   │   ├── svg.php           SVG icon functions
│   │   ├── sanitize.php      Output escaping helpers
│   │   ├── preview.php       Block preview helpers
│   │   ├── image.php         ACF image helpers
│   │   └── HELPERS.md        Helper documentation
│   └── blocks/
│       ├── category.php      Block category
│       └── register.php      Register blocks
│
├── blocks/
│   └── hero-banner.php       Example block template
│
├── post-types/
│   └── example-cpt.php       Custom post type template
│
├── template-parts/
│   ├── content.php           Default content
│   └── blog/
│       ├── card.php          Blog post card
│       ├── card-featured.php Featured post card
│       └── pagination.php    Pagination nav
│
├── templates/
│   └── template-blank.php    Full-width page template
│
└── assets/
    ├── css/
    │   ├── style.css         Main styles
    │   ├── media.css         Responsive styles
    │   └── editor.css        Editor styles
    ├── js/
    │   └── setting.js        Main JavaScript
    ├── fonts/
    │   └── (woff2 files here)
    └── images/
        ├── icons/
        └── blocks-preview/
```

---

## 🔄 Data Flow

### When a user visits a page:

1. WordPress loads `functions.php` (initializes theme)
2. Selects appropriate template based on URL (single.php, page.php, etc.)
3. Template calls `get_header()` → loads `header.php`
4. `header.php` calls `wp_head()` hook → outputs CSS, meta tags, etc.
5. Template outputs main content using helper functions
6. Template calls `get_footer()` → loads `footer.php`
7. `footer.php` calls `wp_footer()` hook → outputs JS, analytics, etc.
8. HTML is sent to user's browser

### When editing a block in WordPress:

1. User clicks "Add Block"
2. WordPress shows blocks from `inc/blocks/register.php`
3. User selects a block
4. Template file (e.g., `blocks/hero-banner.php`) loads
5. If `is_preview`, shows placeholder image
6. User fills ACF fields
7. Block template renders with user's content

---

## 📖 Quick File Lookup

| I want to... | Go to... |
|---|---|
| Change logo | `header.php` |
| Add menu | `inc/setup/menus.php` then output in template |
| Enqueue CSS/JS | `inc/setup/assets.php` |
| Add theme feature | `inc/setup/theme-support.php` |
| Create custom block | Copy `blocks/hero-banner.php`, register in `inc/blocks/register.php` |
| Add custom post type | Create in `post-types/`, require in `functions.php` |
| Edit styles | `/assets/css/style.css` |
| Add JavaScript | `/assets/js/setting.js` or create new file |
| Output safe text | Use functions from `inc/helpers/sanitize.php` |
| Output icon | Use `mytheme_svg_icon()` from `inc/helpers/svg.php` |
| Output ACF image | Use `mytheme_acf_image()` from `inc/helpers/image.php` |

---

See [README.md](README.md) for usage examples and [HELPERS.md](inc/helpers/HELPERS.md) for function documentation.
