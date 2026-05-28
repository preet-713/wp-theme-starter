# Custom Post Type (CPT) Registration — Complete Cheat Sheet
> Reference taken from `inc/post-types/features.php` and `inc/post-types/testimonials.php`

The function signature:

```php
register_post_type( string $post_type, array $args );
```

`$post_type` — the internal key, max 20 characters, lowercase, no spaces, no special chars except `_` and `-`. Never use `wp_` as a prefix (reserved by WordPress core).

---

## The `labels` Array

Labels control every piece of UI text WordPress displays for your CPT in the admin. Every value is translatable via `__()`.

```php
'labels' => array(

    // The plural name shown in the admin menu and list table heading.
    // Default: "Posts" / "Pages"
    'name'               => __( 'Features', 'juralaw' ),

    // The singular name used in buttons, page titles, and notifications.
    'singular_name'      => __( 'Feature', 'juralaw' ),

    // Text for the "Add New" link inside the CPT sub-menu.
    // Default: "Add New"
    'add_new'            => __( 'Add New', 'juralaw' ),

    // Title of the Add New screen, e.g. "Add New Feature".
    'add_new_item'       => __( 'Add New Feature', 'juralaw' ),

    // Title of the Edit screen, e.g. "Edit Feature".
    'edit_item'          => __( 'Edit Feature', 'juralaw' ),

    // Title of the New item screen in the editor.
    'new_item'           => __( 'New Feature', 'juralaw' ),

    // Text shown at top of the list table, and in the admin menu.
    'all_items'          => __( 'All Features', 'juralaw' ),

    // Title of the View item screen (front-end preview link).
    'view_item'          => __( 'View Feature', 'juralaw' ),

    // Label for the search box inside the list table.
    'search_items'       => __( 'Search Features', 'juralaw' ),

    // Text shown when no items are found in a search.
    'not_found'          => __( 'No Features Found', 'juralaw' ),

    // Text shown when no items are found in the Trash.
    'not_found_in_trash' => __( 'No Features Found in Trash', 'juralaw' ),

    // Prefix for the "Parent" label used on hierarchical CPTs (like Pages).
    // Only relevant when 'hierarchical' => true.
    'parent_item_colon'  => __( 'Parent Feature:', 'juralaw' ),

    // Aria label for the navigation menu item pointing to the CPT archive.
    'menu_name'          => __( 'Features', 'juralaw' ),

    // Text for the "Featured Image" meta box title.
    'featured_image'        => __( 'Feature Image', 'juralaw' ),

    // Text for the "Set featured image" link inside the meta box.
    'set_featured_image'    => __( 'Set Feature Image', 'juralaw' ),

    // Text for the "Remove featured image" link inside the meta box.
    'remove_featured_image' => __( 'Remove Feature Image', 'juralaw' ),

    // Text for the "Use as featured image" link in the media modal.
    'use_featured_image'    => __( 'Use as Feature Image', 'juralaw' ),

    // Screen reader text for the "Add New" button in the list table header.
    'insert_into_item'      => __( 'Insert into Feature', 'juralaw' ),

    // Screen reader text for the "Upload" button in the media modal.
    'uploaded_to_this_item' => __( 'Uploaded to this Feature', 'juralaw' ),

    // Screen reader text for the list table filter links.
    'filter_items_list'     => __( 'Filter Features List', 'juralaw' ),

    // Screen reader text for the list table pagination.
    'items_list_navigation' => __( 'Features List Navigation', 'juralaw' ),

    // Screen reader text for the list table itself.
    'items_list'            => __( 'Features List', 'juralaw' ),
),
```

**Rule of thumb:** Minimum required labels for a usable CPT are `name`, `singular_name`, `add_new_item`, `edit_item`, `all_items`, and `not_found`. The rest default to generic WordPress strings if omitted.

---

## Visibility & Access Arguments

### `public`
```php
'public' => true,
```
**Master switch.** Setting this to `true` is equivalent to setting all four of these to `true` at once:
- `publicly_queryable` — front-end URLs work (`?post_type=feature`)
- `show_ui` — admin list table and edit screen appear
- `show_in_nav_menus` — CPT archive appears in Appearance → Menus
- `show_in_admin_bar` — "New Feature" appears in the top admin toolbar

Set `false` only for internal/hidden CPTs (e.g. storing option sets, log entries) that should never be visited on the front-end or managed via the standard admin UI.

---

### `publicly_queryable`
```php
'publicly_queryable' => true,
```
Controls whether front-end URL queries work independently of `public`. Useful when you want a CPT that shows in admin (`show_ui => true`) but has no public-facing pages (`publicly_queryable => false`). Example: a CPT for storing data consumed by a REST API endpoint only.

---

### `show_ui`
```php
'show_ui' => true,
```
Whether WordPress generates a list table (`/wp-admin/edit.php?post_type=feature`) and an edit screen for this CPT. Set `false` to hide the CPT from the admin UI while keeping it functional programmatically.

---

### `show_in_menu`
```php
'show_in_menu' => true,   // show as a top-level admin menu item
'show_in_menu' => false,  // hide from all menus
'show_in_menu' => 'tools.php', // nest under an existing menu (e.g. Tools)
```
When `true`, a top-level menu item is added to the admin sidebar. Pass a string slug to nest the CPT under an existing menu page. Common parent slugs: `'tools.php'`, `'options-general.php'`, `'edit.php?post_type=page'`.

---

### `show_in_nav_menus`
```php
'show_in_nav_menus' => true,
```
Whether this CPT and its posts appear in Appearance → Menus. Defaults to the value of `public`. Set `false` for CPTs whose individual records should never be added to a navigation menu.

---

### `show_in_admin_bar`
```php
'show_in_admin_bar' => true,
```
Whether "New [Post Type]" appears in the "+ New" dropdown in the WordPress admin bar. Defaults to the value of `show_in_menu`.

---

### `show_in_rest`
```php
'show_in_rest' => true,
```
**Required for the Gutenberg block editor to work.** Enabling this:
1. Exposes the CPT via the REST API at `/wp-json/wp/v2/{rest_base}`.
2. Activates the block editor for the CPT's edit screen.

Set `false` if you want to use the Classic Editor for this CPT, or if the CPT should never be accessible via the REST API (e.g., private data stores). Always set `true` on modern themes.

---

### `rest_base`
```php
'rest_base' => 'features',
```
The URL slug used in the REST API endpoint. Defaults to the `$post_type` key. Override when the post type key is awkward (e.g. post type `jl_feat` → `rest_base => 'features'` → `/wp-json/wp/v2/features`).

---

### `rest_controller_class`
```php
'rest_controller_class' => 'WP_REST_Posts_Controller',
```
The PHP class that handles REST API requests for this CPT. Override with a custom class when you need to add custom REST endpoints, modify the response shape, or apply custom authentication rules to the CPT's REST endpoints.

---

## Archive & URL Arguments

### `has_archive`
```php
'has_archive' => true,        // archive URL is /{slug}/
'has_archive' => 'our-work',  // archive URL is /our-work/
```
Whether a paginated archive page exists for this CPT. When `true`, the archive URL is `/{rewrite_slug}/`. Pass a string to use a different URL for the archive than for single posts. Set `false` for CPTs that have no listing page (e.g. testimonials displayed only as a block on the homepage).

---

### `rewrite`
```php
'rewrite' => array(
    'slug'       => 'features',  // front-end URL: /features/{post-slug}/
    'with_front' => false,       // don't prepend the blog base (e.g. /blog/)
    'feeds'      => true,        // generate a feed URL for this CPT
    'pages'      => true,        // generate paginated archive URLs (/features/page/2/)
    'ep_mask'    => EP_PERMALINK,
),
```
Controls the permalink structure for single posts of this CPT.

| Key | Default | Effect |
|---|---|---|
| `slug` | post type key | The URL segment for single posts and the archive |
| `with_front` | `true` | Whether to prepend the permalink base set in Settings → Permalinks |
| `feeds` | `has_archive` value | Whether `/{slug}/feed/` works |
| `pages` | `true` | Whether `/{slug}/page/2/` works |

**Important:** After registering or changing the `rewrite` slug, go to Settings → Permalinks and click "Save Changes" (even without changing anything) to flush rewrite rules. Otherwise WordPress returns 404s.

---

### `query_var`
```php
'query_var' => true,          // use the post type key as query var (?feature=slug)
'query_var' => 'jl_feature',  // use a custom query var name
'query_var' => false,         // disable query var entirely
```
Controls whether the CPT can be queried via a URL query variable. Default is `true` (uses the post type key). Set `false` if you never query this CPT by URL — it avoids polluting the global query vars.

---

## Content & Editor Arguments

### `supports`
```php
'supports' => array(
    'title',           // The post title field — almost always needed
    'editor',          // The block/classic content editor area
    'thumbnail',       // Featured image meta box
    'excerpt',         // Excerpt meta box (manual summary)
    'author',          // Author dropdown meta box
    'trackbacks',      // Send Trackbacks meta box
    'custom-fields',   // Custom Fields meta box (key-value pairs)
    'comments',        // Comments meta box and comment count column
    'revisions',       // Stores revision history (version control)
    'page-attributes', // Order (menu_order) and Parent dropdowns
    'post-formats',    // Post format meta box (video, audio, gallery…)
),
```
Each string in the array activates a specific meta box or feature on the edit screen.

| Value | What it adds | When to use |
|---|---|---|
| `title` | Title input field | Almost always |
| `editor` | Block/Classic content area | When the post has body content |
| `thumbnail` | Featured image | When posts have a representative image |
| `excerpt` | Manual summary field | Blog posts, press releases, SEO snippets |
| `author` | Author selector | Multi-author CPTs |
| `revisions` | Revision history | Content that changes over time |
| `page-attributes` | Order + parent fields | Hierarchical CPTs or manually sorted lists |
| `custom-fields` | Key-value meta box | Legacy; prefer ACF or `register_meta` |
| `comments` | Comment form + count | Community-driven CPTs |
| `post-formats` | Format selector | Blog or media-oriented CPTs |

Pass an empty array `array()` or `false` to disable all support (useful for CPTs used only as data stores where you manage fields entirely via ACF/meta boxes).

---

### `hierarchical`
```php
'hierarchical' => false, // flat, like Posts (default)
'hierarchical' => true,  // tree structure, like Pages (has Parent field)
```
When `true`, posts of this type can have parent/child relationships. Enables the Parent dropdown on the edit screen (requires `page-attributes` in `supports`), and adds a tree-view UI in the list table. Use for nested content structures like documentation sections or location hierarchies.

---

### `taxonomies`
```php
'taxonomies' => array( 'category', 'post_tag' ),
```
Attach existing taxonomies at registration time. You can alternatively call `register_taxonomy_for_object_type()` separately. Do **not** include custom taxonomies here that are registered with the CPT's slug in their own `register_taxonomy()` call — that can cause double-registration.

---

## Admin UI Arguments

### `menu_icon`
```php
'menu_icon' => 'dashicons-star-filled', // Dashicons class
'menu_icon' => 'https://example.com/icon.png', // Custom image URL (20x20px)
'menu_icon' => 'data:image/svg+xml;base64,...', // Inline SVG as base64
```
The icon shown in the WordPress admin sidebar next to the CPT menu item. Use any [Dashicons](https://developer.wordpress.org/resource/dashicons/) slug. For pixel-perfect brand icons, pass a 20×20 PNG URL or a base64-encoded SVG.

---

### `menu_position`
```php
'menu_position' => 5,   // Below Posts
'menu_position' => 10,  // Below Media
'menu_position' => 20,  // Below Pages
'menu_position' => 25,  // Below Comments
'menu_position' => 60,  // Below first separator
'menu_position' => 65,  // Below Plugins
'menu_position' => 70,  // Below Users
'menu_position' => 75,  // Below Tools
'menu_position' => 80,  // Below Settings
'menu_position' => 100, // Below second separator
```
Controls where the CPT appears in the admin sidebar. Default is `null` (placed at the bottom after Comments). Use a value between existing items to slot the CPT in the desired position.

---

### `capability_type`
```php
'capability_type' => 'post',   // Uses built-in post capabilities (default)
'capability_type' => 'feature', // Generates a custom set of capabilities
'capability_type' => array( 'feature', 'features' ), // singular, plural
```
The base used to construct capability names. The default `'post'` means the CPT reuses the standard `edit_posts`, `delete_posts`, `publish_posts` capabilities — all users who can manage posts can manage this CPT. Pass a custom string to create a separate permission set (e.g. `edit_features`, `delete_features`) and assign them to specific roles. Always pair with `'map_meta_cap' => true` when using a custom capability type.

---

### `map_meta_cap`
```php
'map_meta_cap' => true,
```
When `true`, WordPress automatically maps meta capabilities (`edit_post`, `delete_post`, `read_post`) to the primitive capabilities defined by `capability_type`. Required when you use a custom `capability_type`. Without it, capability checks for individual posts (e.g. "can this user edit this specific feature?") will not work correctly.

---

### `capabilities`
```php
'capabilities' => array(
    'edit_post'          => 'edit_feature',
    'read_post'          => 'read_feature',
    'delete_post'        => 'delete_feature',
    'edit_posts'         => 'edit_features',
    'edit_others_posts'  => 'edit_others_features',
    'publish_posts'      => 'publish_features',
    'read_private_posts' => 'read_private_features',
),
```
Explicit override of individual capability names. Use when `capability_type` alone does not produce the exact capability names your role/permission system expects.

---

## Miscellaneous Arguments

### `description`
```php
'description' => 'Client testimonials displayed on the homepage and case study pages.',
```
A human-readable description of the CPT. Shown in the REST API schema and useful as in-code documentation. No functional impact on the admin UI.

---

### `exclude_from_search`
```php
'exclude_from_search' => false, // included in front-end search (default when public => true)
'exclude_from_search' => true,  // hidden from search results
```
Whether posts of this type appear in the front-end `?s=` search results. Useful for internal CPTs (e.g. a "Redirects" CPT) that are `public` but should never surface in site search.

---

### `can_export`
```php
'can_export' => true, // included in Tools → Export (default)
```
Whether this CPT's posts are included in the WordPress XML export. Set `false` for programmatically generated CPT records (log entries, API cache) that have no value in a data export.

---

### `delete_with_user`
```php
'delete_with_user' => false, // posts remain when the author is deleted (default)
'delete_with_user' => true,  // posts are deleted when the author account is deleted
```
Controls what happens to posts authored by a user when that user is deleted. Use `true` for personal CPTs (like a user's private notes) that have no meaning without their owner.

---

### `template`
```php
'template' => array(
    array( 'core/heading',    array( 'level' => 2, 'placeholder' => 'Testimonial Title' ) ),
    array( 'core/paragraph',  array( 'placeholder' => 'Write the testimonial here…' ) ),
    array( 'core/image',      array() ),
),
```
Pre-fills the block editor with a starter layout whenever a new post of this type is created. Each inner array is `[ block_name, block_attributes ]`. Useful for enforcing content structure (e.g. all testimonials must have a quote paragraph and an author image).

---

### `template_lock`
```php
'template_lock' => false,        // editors can add/move/delete blocks freely (default)
'template_lock' => 'all',        // blocks are locked — cannot be moved, added, or removed
'template_lock' => 'insert',     // existing blocks can be moved but none added or removed
'template_lock' => 'contentOnly',// layout locked; only text/image content inside blocks editable
```
Works in combination with `template`. Use `'all'` for tightly controlled layouts (press release format, legal disclaimer pages) where the structure must never change. Use `'insert'` to allow reordering but prevent adding unexpected blocks.

---

## Full Production Example

```php
register_post_type(
    'feature',
    array(
        'labels'             => array(
            'name'               => __( 'Features', 'juralaw' ),
            'singular_name'      => __( 'Feature', 'juralaw' ),
            'add_new'            => __( 'Add New', 'juralaw' ),
            'add_new_item'       => __( 'Add New Feature', 'juralaw' ),
            'edit_item'          => __( 'Edit Feature', 'juralaw' ),
            'new_item'           => __( 'New Feature', 'juralaw' ),
            'all_items'          => __( 'All Features', 'juralaw' ),
            'view_item'          => __( 'View Feature', 'juralaw' ),
            'search_items'       => __( 'Search Features', 'juralaw' ),
            'not_found'          => __( 'No Features Found', 'juralaw' ),
            'not_found_in_trash' => __( 'No Features Found in Trash', 'juralaw' ),
            'menu_name'          => __( 'Features', 'juralaw' ),
        ),

        // --- Visibility ---
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,       // Required for Gutenberg

        // --- Archive & URLs ---
        'has_archive'        => true,
        'rewrite'            => array(
            'slug'       => 'features',
            'with_front' => false,
        ),

        // --- Content ---
        'hierarchical'       => false,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),

        // --- Admin UI ---
        'menu_icon'          => 'dashicons-star-filled',
        'menu_position'      => 25,

        // --- Capabilities ---
        'capability_type'    => 'post',
        'map_meta_cap'       => true,

        // --- Misc ---
        'can_export'         => true,
        'delete_with_user'   => false,
    )
);
```

---

## `register_taxonomy()` — Complete Argument Reference

Used alongside CPTs to create custom category systems.

```php
register_taxonomy(
    'feature-category',      // Taxonomy key (max 32 chars)
    array( 'feature' ),      // CPT(s) this taxonomy is attached to
    array(

        // --- Labels (same pattern as CPT labels) ---
        'labels' => array(
            'name'              => __( 'Feature Categories', 'juralaw' ),
            'singular_name'     => __( 'Feature Category', 'juralaw' ),
            'add_new_item'      => __( 'Add New Feature Category', 'juralaw' ),
            'edit_item'         => __( 'Edit Feature Category', 'juralaw' ),
            'all_items'         => __( 'All Feature Categories', 'juralaw' ),
            'search_items'      => __( 'Search Feature Categories', 'juralaw' ),
            'not_found'         => __( 'No Feature Categories Found', 'juralaw' ),
            'parent_item'       => __( 'Parent Feature Category', 'juralaw' ),
            'parent_item_colon' => __( 'Parent Feature Category:', 'juralaw' ),
        ),

        // Like Pages (tree) or like Tags (flat)
        // true  → shows a parent dropdown and indented tree view (like Categories)
        // false → shows a tag-input box (like Tags)
        'hierarchical'      => true,

        // Makes taxonomy URLs public (/feature-category/slug/)
        'public'            => true,

        // Exposes taxonomy via REST API — required for Gutenberg sidebar
        'show_in_rest'      => true,

        // Adds a taxonomy column in the CPT list table
        'show_admin_column' => true,

        // Controls the URL slug for taxonomy archive pages
        'rewrite'           => array(
            'slug'         => 'feature-category',
            'with_front'   => false,
            'hierarchical' => false, // true = /parent/child/ URL nesting
        ),

        // Whether terms appear in the tag cloud widget
        'show_tagcloud'     => false,

        // Whether to show the taxonomy in the Quick Edit panel
        'show_in_quick_edit' => true,

        // Custom query var (defaults to taxonomy key)
        'query_var'         => true,

        // Sort terms in the order they were added to a post
        'sort'              => false,
    )
);
```

---

## Quick Reference — All Arguments at a Glance

| Argument | Type | Default | Purpose |
|---|---|---|---|
| `labels` | array | auto-generated | All admin UI text strings |
| `description` | string | `''` | Human-readable CPT description |
| `public` | bool | `false` | Master switch for all visibility |
| `publicly_queryable` | bool | `public` | Front-end URL queries |
| `show_ui` | bool | `public` | Admin list table + edit screen |
| `show_in_menu` | bool/string | `show_ui` | Admin sidebar menu |
| `show_in_nav_menus` | bool | `public` | Appearance → Menus |
| `show_in_admin_bar` | bool | `show_in_menu` | "+ New" admin toolbar item |
| `show_in_rest` | bool | `false` | REST API + Gutenberg editor |
| `rest_base` | string | post type key | REST API URL slug |
| `rest_controller_class` | string | `WP_REST_Posts_Controller` | REST handler class |
| `has_archive` | bool/string | `false` | Archive page URL |
| `rewrite` | array/bool | `true` | Permalink slug + options |
| `query_var` | bool/string | post type key | URL query variable |
| `hierarchical` | bool | `false` | Parent/child relationships |
| `supports` | array | `['title','editor']` | Edit screen features |
| `taxonomies` | array | `[]` | Attach existing taxonomies |
| `menu_icon` | string | `null` | Sidebar icon (dashicon/URL/SVG) |
| `menu_position` | int | `null` | Sidebar position |
| `capability_type` | string/array | `'post'` | Base for capability names |
| `map_meta_cap` | bool | `false` | Auto-map meta capabilities |
| `capabilities` | array | derived | Override individual capabilities |
| `exclude_from_search` | bool | `!public` | Hide from front-end search |
| `can_export` | bool | `true` | Include in XML export |
| `delete_with_user` | bool | `false` | Delete posts on user delete |
| `template` | array | `[]` | Starter block editor layout |
| `template_lock` | string/bool | `false` | Lock the starter template |
