-- Advanced Diagnostics and Fix for GitHub Issue #1: Missing Header Menu
-- ======================================================================
-- Run this AFTER the initial fix to diagnose and resolve persistent issues
-- 
-- To apply this fix on staging:
-- 1. Log into WP Engine phpMyAdmin for buzznbloomstg  
-- 2. Select the database
-- 3. Go to SQL tab
-- 4. Copy and paste this entire script
-- 5. Click "Go" to execute
-- 6. Review the diagnostic outputs to identify the issue

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET AUTOCOMMIT=0;
START TRANSACTION;

-- ===================================================================
-- PART 1: DIAGNOSTICS - Check current state
-- ===================================================================

-- Check 1: Verify header template exists and is published
SELECT 'CHECK 1: Header Template Status' as Diagnostic;
SELECT ID, post_title, post_status, post_type 
FROM wp_posts 
WHERE post_type = 'pxl-template' 
AND (post_title LIKE '%header%' OR ID = 17)
ORDER BY ID;

-- Check 2: Verify theme builder conditions
SELECT 'CHECK 2: Theme Builder Conditions' as Diagnostic;
SELECT option_name, option_value 
FROM wp_options 
WHERE option_name = 'elementor_pro_theme_builder_conditions';

-- Check 3: Check for any header layout assignments
SELECT 'CHECK 3: Header Layout Assignments' as Diagnostic;
SELECT post_id, meta_key, meta_value 
FROM wp_postmeta 
WHERE meta_key = 'header_layout' 
LIMIT 10;

-- Check 4: Verify Elementor active kit
SELECT 'CHECK 4: Elementor Active Kit' as Diagnostic;
SELECT option_name, option_value 
FROM wp_options 
WHERE option_name = 'elementor_active_kit';

-- Check 5: Check if menu locations are set
SELECT 'CHECK 5: Menu Locations' as Diagnostic;
SELECT option_name, option_value 
FROM wp_options 
WHERE option_name = 'nav_menu_locations';

-- Check 6: Verify menus exist
SELECT 'CHECK 6: Menus in Database' as Diagnostic;
SELECT t.term_id, t.name, t.slug, tt.count 
FROM wp_terms t 
JOIN wp_term_taxonomy tt ON t.term_id = tt.term_id 
WHERE tt.taxonomy = 'nav_menu';

-- ===================================================================
-- PART 2: ADVANCED FIXES
-- ===================================================================

-- Fix 1: Force complete cache clear (more aggressive)
DELETE FROM wp_options WHERE option_name LIKE '%_transient_%';
DELETE FROM wp_options WHERE option_name LIKE '%_site_transient_%';
DELETE FROM wp_options WHERE option_name LIKE '%cache%';
DELETE FROM wp_options WHERE option_name LIKE '%_cached_%';
DELETE FROM wp_postmeta WHERE meta_key IN ('_elementor_css', '_elementor_inline_svg', '_elementor_element_cache');
DELETE FROM wp_options WHERE option_name LIKE '%elementor%cache%';
UPDATE wp_options SET option_value = '' WHERE option_name = '_elementor_global_css';
UPDATE wp_options SET option_value = '' WHERE option_name = '_elementor_assets_data';

-- Fix 2: Ensure ALL pxl-template posts are published (not just header)
UPDATE wp_posts 
SET post_status = 'publish' 
WHERE post_type = 'pxl-template' 
AND post_status != 'publish';

-- Fix 3: Force correct theme builder conditions with proper serialization
DELETE FROM wp_options WHERE option_name = 'elementor_pro_theme_builder_conditions';
INSERT INTO wp_options (option_name, option_value, autoload) VALUES 
('elementor_pro_theme_builder_conditions', 
'a:4:{s:6:"header";a:1:{i:17;a:1:{i:0;s:15:"include/general";}}s:6:"footer";a:1:{i:2253;a:1:{i:0;s:15:"include/general";}}s:6:"single";a:0:{}s:7:"archive";a:0:{}}', 
'yes');

-- Fix 4: Clear theme builder conditions cache
DELETE FROM wp_options WHERE option_name = '_elementor_pro_theme_builder_conditions_cache';

-- Fix 5: Set proper page template for home page
UPDATE wp_postmeta pm
JOIN wp_posts p ON pm.post_id = p.ID
SET pm.meta_value = 'elementor_header_footer'
WHERE p.post_type = 'page' 
AND p.post_name = ''  -- Home page usually has empty post_name
AND pm.meta_key = '_wp_page_template';

-- Fix 6: Ensure Elementor is enabled on pages
INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
SELECT ID, '_elementor_edit_mode', 'builder'
FROM wp_posts 
WHERE post_type IN ('page', 'post', 'pxl-template')
AND ID NOT IN (
    SELECT post_id FROM wp_postmeta WHERE meta_key = '_elementor_edit_mode'
);

-- Fix 7: Update theme mods with complete header settings
UPDATE wp_options 
SET option_value = 'a:5:{i:0;b:0;s:18:"custom_css_post_id";i:-1;s:11:"header_type";s:7:"default";s:14:"header_layout";s:2:"17";s:13:"header_sticky";s:1:"1";}' 
WHERE option_name = 'theme_mods_pxlz';

-- Fix 8: Force menu location assignment
UPDATE wp_options 
SET option_value = 'a:3:{s:7:"primary";i:48;s:14:"primary_mobile";i:50;s:6:"footer";i:51;}' 
WHERE option_name = 'nav_menu_locations';

-- Fix 9: Clear all URL references in Elementor data
UPDATE wp_postmeta 
SET meta_value = REPLACE(
    REPLACE(
        REPLACE(meta_value, 'http://buzznbloom.test', 'https://buzznbloomstg.wpenginepowered.com'),
        'buzznbloom.test', 'buzznbloomstg.wpenginepowered.com'
    ),
    'http://buzznbloomstg.wpenginepowered.com', 'https://buzznbloomstg.wpenginepowered.com'
)
WHERE meta_key = '_elementor_data';

-- Fix 10: Ensure Elementor Pro is properly activated
DELETE FROM wp_options WHERE option_name = '_elementor_pro_license_key';
INSERT INTO wp_options (option_name, option_value, autoload) VALUES 
('_elementor_pro_license_key', 'activated', 'yes');

UPDATE wp_options 
SET option_value = 'a:3:{s:6:"status";s:6:"active";s:15:"activated_time";i:1689580385;s:11:"license_key";s:9:"activated";}' 
WHERE option_name = '_elementor_pro_license_v2_data';

-- Fix 11: Force regeneration of Elementor CSS on next load
UPDATE wp_postmeta SET meta_value = '' WHERE meta_key = '_elementor_css';
DELETE FROM wp_options WHERE option_name = 'elementor_css_print_method';

-- Fix 12: Ensure header visibility settings
UPDATE wp_postmeta 
SET meta_value = 'yes' 
WHERE meta_key = '_elementor_conditions_display' 
AND post_id = 17;

-- Fix 13: Clear any header-specific overrides
DELETE FROM wp_postmeta 
WHERE meta_key IN ('disable_header', 'hide_header', 'header_transparent') 
AND meta_value IN ('1', 'yes', 'true');

-- Fix 14: Force WordPress to flush rewrite rules
UPDATE wp_options SET option_value = '' WHERE option_name = 'rewrite_rules';

-- Fix 15: Set Elementor default colors and fonts
UPDATE wp_options 
SET option_value = 'a:2:{s:6:"colors";a:0:{}s:10:"typography";a:0:{}}' 
WHERE option_name = 'elementor_scheme_last_updated';

COMMIT;
SET FOREIGN_KEY_CHECKS=1;

-- ===================================================================
-- POST-EXECUTION NOTES
-- ===================================================================
-- After running this script:
-- 1. Note the diagnostic outputs - they will help identify remaining issues
-- 2. Clear all WP Engine caches
-- 3. Go to WordPress Admin → Elementor → Tools → Regenerate CSS & Data
-- 4. Go to WordPress Admin → Elementor → Tools → Replace URLs (if needed)
-- 5. Go to Appearance → Customize and click "Publish" (even without changes)
-- 6. Check if header appears. If not:
--    a. Go to Templates → Theme Builder
--    b. Edit "Header Main" 
--    c. Check display conditions are set to "Entire Site"
--    d. Save the template
-- 7. If still not working, try switching themes to Twenty Twenty-Four and back to pxlz