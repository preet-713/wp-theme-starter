# 📑 Theme Starter Documentation Index

Complete guide to all documentation files in this theme.

---

## 🚀 Start Here

### For Quick Setup (5 minutes)
→ **[QUICKSTART.md](QUICKSTART.md)**
- Copy theme folder
- Rename `mytheme` prefix
- Update theme header
- Activate in WordPress
- Create menus

### For Complete Guide (30 minutes)
→ **[README.md](README.md)**
- What's included
- Getting started (detailed)
- Customizing styles
- Common tasks
- Troubleshooting

---

## 📚 Documentation by Topic

### Understanding the Structure
→ **[STRUCTURE.md](STRUCTURE.md)**
- Folder layout explanation
- What each file does
- When it's used
- How to use it
- Visual folder tree

### Code Comments & Documentation
→ **[COMMENTS_GUIDE.md](COMMENTS_GUIDE.md)**
- How to comment code
- File headers
- Function documentation
- When to comment (and when not to)
- IDE tools that use comments

### Helper Functions Reference
→ **[inc/helpers/HELPERS.md](inc/helpers/HELPERS.md)**
- SVG icons: `mytheme_svg_icon()`
- Sanitization: `mytheme_inline()`, `mytheme_rich()`, `mytheme_url()`
- ACF images: `mytheme_acf_image()`
- Block helpers: `mytheme_block_preview_placeholder()`
- Full function signatures and examples

### Tips & Best Practices
→ **[TIPS.md](TIPS.md)**
- Code organization
- Performance optimization
- Security best practices
- Common mistakes
- Debugging tips
- WordPress function reference

---

## 🗂️ By File Type

### Root Files
| File | Purpose | Read... |
|------|---------|---------|
| `style.css` | Theme header + base styles | [README.md](README.md#css-structure) |
| `functions.php` | Theme initialization | [README.md](README.md#1-rename-your-theme) |
| `header.php` | Open HTML, load CSS/JS | [STRUCTURE.md](STRUCTURE.md#root-level-files) |
| `footer.php` | Close HTML, output footer | [STRUCTURE.md](STRUCTURE.md#root-level-files) |

### Templates (Auto-selected by WordPress)
| File | Loaded When | Read... |
|------|-------------|---------|
| `index.php` | Fallback template | [STRUCTURE.md](STRUCTURE.md#template-files) |
| `front-page.php` | Static homepage | [README.md](README.md) |
| `home.php` | Blog listing | [README.md](README.md) |
| `single.php` | Single blog post | [STRUCTURE.md](STRUCTURE.md) |
| `page.php` | Static page | [STRUCTURE.md](STRUCTURE.md) |
| `archive.php` | Category/tag archives | [STRUCTURE.md](STRUCTURE.md) |
| `search.php` | Search results | [README.md](README.md#common-tasks) |
| `404.php` | 404 error page | [README.md](README.md) |

### Setup Files
| File | Purpose | Read... |
|------|---------|---------|
| `inc/setup/assets.php` | Enqueue CSS/JS | [STRUCTURE.md](STRUCTURE.md) |
| `inc/setup/menus.php` | Register navigation | [README.md](README.md#3-create-menus) |
| `inc/setup/theme-support.php` | Enable features | [STRUCTURE.md](STRUCTURE.md) |

### Helper Files
| File | Purpose | Read... |
|------|---------|---------|
| `inc/helpers/svg.php` | SVG icons | [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md) |
| `inc/helpers/sanitize.php` | Output safety | [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md) |
| `inc/helpers/preview.php` | Block previews | [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md) |
| `inc/helpers/image.php` | ACF images | [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md) |

---

## 💡 By Task

### I want to...

#### Change the logo
→ Edit `header.php`  
→ See [STRUCTURE.md](STRUCTURE.md#root-level-files)

#### Add a new menu
→ Edit `inc/setup/menus.php`  
→ Then output in template using `wp_nav_menu()`  
→ See [README.md](README.md#3-create-menus)

#### Add custom CSS
→ Create file in `/assets/css/`  
→ Enqueue in `inc/setup/assets.php`  
→ See [README.md](README.md#adding-custom-styles)

#### Add JavaScript
→ Create file in `/assets/js/`  
→ Enqueue in `inc/setup/assets.php`  
→ See [README.md](README.md#common-tasks)

#### Create a custom block
→ Copy `blocks/hero-banner.php`  
→ Register in `inc/blocks/register.php`  
→ Create ACF fields in WordPress admin  
→ See [README.md](README.md#5-add-custom-blocks-acf-required)

#### Add a custom post type
→ Create in `/post-types/`  
→ Require in `functions.php`  
→ See `post-types/example-cpt.php` for template

#### Create a custom page template
→ Create in `/templates/` with `Template Name:` header  
→ Appears in WordPress admin under Page > Template

#### Output a post title safely
→ Use `mytheme_inline( get_the_title() )`  
→ See [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md)

#### Output an image from ACF
→ Use `mytheme_acf_image( $image )`  
→ See [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md)

#### Output an icon
→ Use `mytheme_svg_icon( 'icon-name', 24, 24 )`  
→ Requires SVG sprite file  
→ See [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md)

#### Fix a security warning
→ Use helper functions: `mytheme_inline()`, `mytheme_rich()`, `mytheme_url()`  
→ See [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md)

#### Improve performance
→ See [TIPS.md](TIPS.md#performance-tips)

#### Debug a problem
→ See [TIPS.md](TIPS.md#debugging-tips)

---

## 📊 Documentation Map

```
START HERE
    ↓
QUICKSTART.md (5 min)
    ↓
README.md (30 min)
    ↓
Pick your path...
    
    → Building Blocks?
        blocks/hero-banner.php (example)
        inc/blocks/register.php
        
    → Styling?
        assets/css/style.css
        TIPS.md > Performance Tips
        
    → Custom Functions?
        COMMENTS_GUIDE.md
        inc/helpers/HELPERS.md
        
    → Understanding Structure?
        STRUCTURE.md
        
    → Best Practices?
        TIPS.md
```

---

## 📖 Reading by Experience Level

### Beginners
1. [QUICKSTART.md](QUICKSTART.md) — Get theme running
2. [README.md](README.md) — Understand how to customize
3. [STRUCTURE.md](STRUCTURE.md) — Learn folder organization
4. [TIPS.md](TIPS.md) — Common mistakes to avoid

### Intermediate
1. [README.md](README.md) — Complete reference
2. [STRUCTURE.md](STRUCTURE.md) — File organization
3. [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md) — Function reference
4. [COMMENTS_GUIDE.md](COMMENTS_GUIDE.md) — Code documentation

### Advanced
1. [STRUCTURE.md](STRUCTURE.md) — Deep dive into organization
2. [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md) — Detailed function docs
3. [TIPS.md](TIPS.md) — Performance & security
4. [COMMENTS_GUIDE.md](COMMENTS_GUIDE.md) — Code standards

---

## 🔍 Quick Lookup Table

| Need | Location | Time |
|------|----------|------|
| Setup theme | [QUICKSTART.md](QUICKSTART.md) | 5 min |
| Understand all files | [STRUCTURE.md](STRUCTURE.md) | 15 min |
| How to use helpers | [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md) | 20 min |
| Best practices | [TIPS.md](TIPS.md) | 20 min |
| How to comment | [COMMENTS_GUIDE.md](COMMENTS_GUIDE.md) | 10 min |
| Full reference | [README.md](README.md) | 30 min |

---

## ✅ Document Checklist

- ✅ **QUICKSTART.md** — 5-minute setup guide
- ✅ **README.md** — Complete documentation with examples
- ✅ **STRUCTURE.md** — Folder layout and file purposes
- ✅ **COMMENTS_GUIDE.md** — How to document code
- ✅ **TIPS.md** — Best practices and common mistakes
- ✅ **inc/helpers/HELPERS.md** — All helper functions
- ✅ **INDEX.md** — This file (navigation)

---

## 🎯 Most Important Files

### For Users
1. [README.md](README.md)
2. [QUICKSTART.md](QUICKSTART.md)
3. [STRUCTURE.md](STRUCTURE.md)

### For Developers
1. [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md)
2. [TIPS.md](TIPS.md)
3. [COMMENTS_GUIDE.md](COMMENTS_GUIDE.md)

### For Designers
1. [README.md](README.md#-customizing-styles)
2. [assets/css/style.css](assets/css/style.css)
3. [TIPS.md](TIPS.md#performance-tips)

---

## 🆘 Stuck? Start Here

| Problem | Solution |
|---------|----------|
| Don't know where to start | [QUICKSTART.md](QUICKSTART.md) |
| Can't find a file | [STRUCTURE.md](STRUCTURE.md) |
| Function doesn't exist | [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md) |
| Unsure how to extend | [README.md](README.md#-common-tasks) |
| Code is breaking | [TIPS.md](TIPS.md#common-mistakes-to-avoid) |
| Theme is slow | [TIPS.md](TIPS.md#performance-tips) |
| Security warnings | [TIPS.md](TIPS.md#security-best-practices) |

---

## 📝 Quick Notes

- **Find & Replace** `mytheme` with your theme slug in all files
- **ACF Required** for custom blocks (Advanced Custom Fields)
- **PHP 8.0+** minimum version required
- **WordPress 6.0+** recommended
- All functions prefixed with `mytheme_` to avoid conflicts
- All output is escaped for security by default

---

## 🔗 External Resources

- [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/)
- [ACF Documentation](https://www.advancedcustomfields.com/resources/)
- [PHP Documentation](https://www.php.net/manual/en/)

---

**Happy coding!** 🎉

Start with [QUICKSTART.md](QUICKSTART.md) or jump to any section above.
