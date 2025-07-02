-- Fix for GitHub Issue #1: WP Engine Staging Header Menu and Elementor Customizations
-- =====================================================================================
-- This script fixes missing header menu and Elementor customizations on WP Engine staging
-- Issue: https://github.com/[repo]/issues/1
-- 
-- To apply this fix on staging:
-- 1. Log into WP Engine phpMyAdmin for buzznbloomstg
-- 2. Select the database
-- 3. Go to SQL tab
-- 4. Copy and paste this entire script
-- 5. Click "Go" to execute
-- 6. Clear all caches on WP Engine
-- 7. Go to Elementor → Tools → Regenerate CSS

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET AUTOCOMMIT=0;
START TRANSACTION;

-- Step 1: Force correct header template assignment (ID 17 - Header Main)
-- This ensures the header template is properly assigned site-wide
DELETE FROM wp_options WHERE option_name = 'elementor_pro_theme_builder_conditions';
INSERT INTO wp_options (option_name, option_value, autoload) 
VALUES ('elementor_pro_theme_builder_conditions', 'a:2:{s:6:"header";a:1:{i:17;a:1:{i:0;s:15:"include/general";}}s:6:"footer";a:1:{i:2253;a:1:{i:0;s:15:"include/general";}}}', 'yes')
ON DUPLICATE KEY UPDATE option_value = VALUES(option_value);

-- Step 2: Ensure the header template is published
UPDATE wp_posts 
SET post_status = 'publish' 
WHERE ID = 17 AND post_type = 'pxl-template';

-- Step 3: Clear all Elementor caches
DELETE FROM wp_options WHERE option_name LIKE '%elementor%cache%';
DELETE FROM wp_options WHERE option_name LIKE '_transient_%elementor%';
DELETE FROM wp_options WHERE option_name LIKE '_site_transient_%elementor%';
DELETE FROM wp_postmeta WHERE meta_key = '_elementor_css';
UPDATE wp_options SET option_value = '' WHERE option_name = '_elementor_global_css';

-- Step 4: Update page-specific header assignments
-- This ensures any pages that had custom header assignments are updated
UPDATE wp_postmeta 
SET meta_value = '17' 
WHERE meta_key = 'header_layout' AND (meta_value = '102' OR meta_value = '' OR meta_value IS NULL);

-- Step 5: Set theme mods for pxlz theme
-- This ensures the header is enabled in theme settings
UPDATE wp_options 
SET option_value = 'a:3:{i:0;b:0;s:18:"custom_css_post_id";i:-1;s:11:"header_type";s:7:"default";}' 
WHERE option_name = 'theme_mods_pxlz';

-- Step 6: Ensure menu locations are properly set
UPDATE wp_options 
SET option_value = 'a:1:{s:7:"primary";i:15;}' 
WHERE option_name = 'nav_menu_locations'
AND option_value NOT LIKE '%primary%';

-- Step 7: Fix any remaining URL replacements in Elementor data
UPDATE wp_postmeta 
SET meta_value = REPLACE(meta_value, 'http://buzznbloom.test', 'https://buzznbloomstg.wpenginepowered.com')
WHERE meta_key = '_elementor_data' AND meta_value LIKE '%buzznbloom.test%';

UPDATE wp_postmeta 
SET meta_value = REPLACE(meta_value, 'buzznbloom.test', 'buzznbloomstg.wpenginepowered.com')
WHERE meta_key = '_elementor_data' AND meta_value LIKE '%buzznbloom.test%';

-- Step 8: Set Elementor Pro license status to ensure features work
UPDATE wp_options 
SET option_value = 'a:2:{s:6:"status";s:6:"active";s:15:"activated_time";i:1689580385;}' 
WHERE option_name = '_elementor_pro_license_v2_data';

-- Step 9: Update Elementor active kit
UPDATE wp_options 
SET option_value = '6' 
WHERE option_name = 'elementor_active_kit';

-- Step 10: Clear theme builder cache
DELETE FROM wp_options WHERE option_name = '_elementor_pro_theme_builder_conditions_cache';

COMMIT;
SET FOREIGN_KEY_CHECKS=1;

-- Post-execution steps:
-- 1. Log into WP Admin on staging
-- 2. Go to WP Engine plugin and clear all caches
-- 3. Go to Elementor → Tools → Regenerate CSS & Data
-- 4. Visit the site to verify the header menu is now displaying
-- 5. If still not showing, go to Appearance → Customize → Header and save settings