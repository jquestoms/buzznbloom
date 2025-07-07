# Solution: Header Not Displaying on WP Engine Staging

## Problem Summary
Header menu and Elementor customizations were missing on staging site after migration from local development.

## Root Causes (Multiple Issues)
1. **Wrong theme name**: Database had `pxlz` but actual theme is `basilico-child`
2. **Hidden headers**: All pages had `header_layout = -1` in postmeta (which means hide header)
3. **Theme-specific header system**: Basilico theme doesn't use standard Elementor Theme Builder hooks
4. **Missing theme settings**: `theme_mods_basilico-child` and `nav_menu_locations` were empty

## THE CRITICAL FIX
**Basilico theme uses its own header system**, not Elementor's standard theme builder:

```php
// In basilico/header.php
basilico()->header->getHeader();

// In class-header.php
$header_layout = (int)basilico()->get_opt('header_layout');
```

The theme reads header settings from `pxl_theme_options`, NOT from Elementor's theme builder conditions!

## Exact Fix Sequence

### 1. Fixed Theme Name
```sql
UPDATE wp_options SET option_value = 'basilico' WHERE option_name = 'template';
UPDATE wp_options SET option_value = 'basilico-child' WHERE option_name = 'stylesheet';
```

### 2. Set Theme Mods and Menu Locations
```sql
INSERT INTO wp_options (option_name, option_value, autoload) 
VALUES ('theme_mods_basilico-child', 'a:5:{i:0;b:0;s:18:"custom_css_post_id";i:-1;s:11:"header_type";s:7:"default";s:14:"header_layout";s:2:"17";s:13:"header_sticky";s:1:"1";}', 'yes');

INSERT INTO wp_options (option_name, option_value, autoload) 
VALUES ('nav_menu_locations', 'a:3:{s:7:"primary";i:48;s:14:"primary_mobile";i:50;s:6:"footer";i:51;}', 'yes');
```

### 3. Removed Header Hiding Settings
```sql
DELETE FROM wp_postmeta WHERE meta_key = 'header_layout' AND meta_value = '-1';
```

### 4. THE KEY FIX: Updated Basilico Theme Options
```bash
wp eval "
\$options = get_option('pxl_theme_options');
\$options['header_layout'] = '17';
update_option('pxl_theme_options', \$options);
"
```

This last step was CRITICAL - it tells Basilico theme to use header template ID 17.

## Why Standard Elementor Fixes Don't Work

Typical Elementor header fixes involve:
- Setting `elementor_pro_theme_builder_conditions`
- Ensuring template is published
- Clearing Elementor cache

These DO NOT WORK with Basilico because:
1. Theme has custom `getHeader()` function that ignores Elementor conditions
2. Theme reads from `pxl_theme_options['header_layout']` instead
3. Theme uses `pxl-template` custom post type (not standard `elementor_library`)

## Complete Fix Script
Save this as `fix_basilico_header_complete.sql`:

```sql
-- Fix Basilico Header on Staging
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET AUTOCOMMIT=0;
START TRANSACTION;

-- 1. Set correct theme
UPDATE wp_options SET option_value = 'basilico' WHERE option_name = 'template';
UPDATE wp_options SET option_value = 'basilico-child' WHERE option_name = 'stylesheet';

-- 2. Remove header hiding
DELETE FROM wp_postmeta WHERE meta_key = 'header_layout' AND meta_value = '-1';
DELETE FROM wp_postmeta WHERE meta_key = 'disable_header' AND meta_value = '1';

-- 3. Set theme mods
DELETE FROM wp_options WHERE option_name IN ('theme_mods_basilico-child', 'theme_mods_basilico');
INSERT INTO wp_options (option_name, option_value, autoload) VALUES 
('theme_mods_basilico-child', 'a:5:{i:0;b:0;s:18:"custom_css_post_id";i:-1;s:11:"header_type";s:7:"default";s:14:"header_layout";s:2:"17";s:13:"header_sticky";s:1:"1";}', 'yes'),
('theme_mods_basilico', 'a:5:{i:0;b:0;s:18:"custom_css_post_id";i:-1;s:11:"header_type";s:7:"default";s:14:"header_layout";s:2:"17";s:13:"header_sticky";s:1:"1";}', 'yes');

-- 4. Set menu locations
DELETE FROM wp_options WHERE option_name = 'nav_menu_locations';
INSERT INTO wp_options (option_name, option_value, autoload) VALUES 
('nav_menu_locations', 'a:3:{s:7:"primary";i:48;s:14:"primary_mobile";i:50;s:6:"footer";i:51;}', 'yes');

-- 5. Clear caches
DELETE FROM wp_options WHERE option_name LIKE '%_transient_%';
DELETE FROM wp_postmeta WHERE meta_key = '_elementor_css';

COMMIT;
SET FOREIGN_KEY_CHECKS=1;
```

Then run via SSH:
```bash
ssh buzznbloomstg@buzznbloomstg.ssh.wpengine.net
cd sites/buzznbloomstg
wp eval "\$options = get_option('pxl_theme_options'); \$options['header_layout'] = '17'; update_option('pxl_theme_options', \$options);"
wp cache flush
```

## Lessons Learned
1. **Always check if theme uses custom header system** - not all themes use Elementor's standard hooks
2. **Look for theme-specific options** like `pxl_theme_options` 
3. **Page-level overrides** (`header_layout = -1`) can hide headers even if everything else is correct
4. **Theme name mismatches** can cause subtle issues
5. **SSH access with WP-CLI** is invaluable for fixing serialized options

## Prevention
When migrating Basilico sites:
1. Export `pxl_theme_options` from source
2. Check for page-level header overrides
3. Ensure theme names match exactly
4. Use the complete export script that includes theme options