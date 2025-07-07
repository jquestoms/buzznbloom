-- FIX: Set Correct Theme (Basilico) on Staging
-- =============================================
-- The site uses basilico-child theme, not pxlz

-- 1. Remove incorrect theme settings
DELETE FROM wp_options WHERE option_name = 'theme_mods_pxlz';

-- 2. Set correct theme (basilico parent and basilico-child)
UPDATE wp_options SET option_value = 'basilico' WHERE option_name = 'template';
UPDATE wp_options SET option_value = 'basilico-child' WHERE option_name = 'stylesheet';
UPDATE wp_options SET option_value = 'Basilico Child' WHERE option_name = 'current_theme';

-- 3. Set theme mods for basilico-child (active theme)
INSERT INTO wp_options (option_name, option_value, autoload) 
VALUES ('theme_mods_basilico-child', 'a:5:{i:0;b:0;s:18:"custom_css_post_id";i:-1;s:11:"header_type";s:7:"default";s:14:"header_layout";s:2:"17";s:13:"header_sticky";s:1:"1";}', 'yes')
ON DUPLICATE KEY UPDATE option_value = 'a:5:{i:0;b:0;s:18:"custom_css_post_id";i:-1;s:11:"header_type";s:7:"default";s:14:"header_layout";s:2:"17";s:13:"header_sticky";s:1:"1";}';

-- 4. Also set theme mods for parent theme (basilico)
INSERT INTO wp_options (option_name, option_value, autoload) 
VALUES ('theme_mods_basilico', 'a:5:{i:0;b:0;s:18:"custom_css_post_id";i:-1;s:11:"header_type";s:7:"default";s:14:"header_layout";s:2:"17";s:13:"header_sticky";s:1:"1";}', 'yes')
ON DUPLICATE KEY UPDATE option_value = 'a:5:{i:0;b:0;s:18:"custom_css_post_id";i:-1;s:11:"header_type";s:7:"default";s:14:"header_layout";s:2:"17";s:13:"header_sticky";s:1:"1";}';

-- 5. Ensure menu locations are still set
UPDATE wp_options 
SET option_value = 'a:3:{s:7:"primary";i:48;s:14:"primary_mobile";i:50;s:6:"footer";i:51;}' 
WHERE option_name = 'nav_menu_locations';

-- 6. Clear all transients again
DELETE FROM wp_options WHERE option_name LIKE '%_transient_%';
DELETE FROM wp_options WHERE option_name LIKE '%_site_transient_%';

-- 7. Verify the changes
SELECT 'Theme Settings After Fix:' as Info;
SELECT option_name, option_value 
FROM wp_options 
WHERE option_name IN ('template', 'stylesheet', 'current_theme', 'theme_mods_basilico-child', 'theme_mods_basilico', 'nav_menu_locations');

SELECT 'DONE! Theme corrected to basilico-child. Clear WP Engine cache now!' as Result;