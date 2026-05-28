# ⚡ Quick Start — 5 Minutes

Get your theme up and running in minutes.

---

## Step 1: Copy the Theme (30 seconds)

```bash
cp -r theme-starter your-theme-name
cd your-theme-name
```

---

## Step 2: Rename the Prefix (2 minutes)

Open your code editor and use **Find & Replace**:

**Find:** `mytheme`  
**Replace:** `yourthemeslug`

Search in these files **at minimum**:
- `style.css`
- `functions.php`
- All files in `/inc/`
- All files in `/blocks/`

---

## Step 3: Update Theme Header (1 minute)

Edit `style.css` at the top:

```css
Theme Name: My Amazing Theme
Theme URI: https://example.com/
Author: Your Name
Author URI: https://example.com
Description: A custom WordPress theme
```

---

## Step 4: Upload & Activate (1 minute)

1. Upload folder to `/wp-content/themes/`
2. Go to WordPress Admin > Appearance > Themes
3. Find your theme and click **Activate**

---

## Step 5: Create Menus (30 seconds)

1. Go to WordPress Admin > Appearance > Menus
2. Create a menu called "Main Menu"
3. Add some pages to it
4. Under "Menu Settings", check **Main Menu** and save
5. Repeat for **Footer Menu One**, **Footer Menu Two**, and **Legal Pages Nav**

---

## ✅ Done!

Your theme is now live. Start customizing:

- **Edit styles** → `/assets/css/style.css`
- **Add functions** → `/functions.php` or create file in `/inc/`
- **Create blocks** → Copy `/blocks/hero-banner.php` as template
- **Add pages** → Create `.php` files in root (e.g., `page-about.php`)

---

## 📚 Next Steps

- Read [README.md](README.md) for detailed documentation
- Check [inc/helpers/HELPERS.md](inc/helpers/HELPERS.md) for utility functions
- See [File Structure](STRUCTURE.md) for folder organization
- Edit styles in `/assets/css/`
- Add custom JavaScript in `/assets/js/`

---

## 🔗 Common Links

| What | Where |
|------|-------|
| Add theme support | `inc/setup/theme-support.php` |
| Enqueue CSS/JS | `inc/setup/assets.php` |
| Register menus | `inc/setup/menus.php` |
| Output escaping helpers | `inc/helpers/sanitize.php` |
| SVG icon function | `inc/helpers/svg.php` |
| Helper functions docs | `inc/helpers/HELPERS.md` |

---

**Questions?** See [README.md](README.md) or [STRUCTURE.md](STRUCTURE.md)
