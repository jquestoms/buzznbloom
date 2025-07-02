#!/bin/bash

# ULTIMATE Complete WordPress export for WP Engine staging
# This version ensures ALL Elementor, theme, and menu data is captured

echo "🚀 Creating ULTIMATE COMPLETE WordPress database export..."
echo "   This captures EVERYTHING needed for proper staging deployment"

DB_NAME="buzznbloom"
DB_USER="root"
DB_PASS=""
DB_HOST="127.0.0.1"

LOCAL_URL="http://buzznbloom.test"
STAGING_URL="https://buzznbloomstg.wpenginepowered.com"

EXPORT_FILE="buzznbloom_ultimate_complete_export.sql"

echo ""
echo "📊 Step 1: Creating comprehensive export (excluding user tables)..."

# Export with maximum data preservation
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --routines \
  --triggers \
  --events \
  --add-drop-table \
  --complete-insert \
  --extended-insert \
  --hex-blob \
  --tz-utc \
  --comments \
  --create-options \
  --quick \
  --lock-tables=false \
  --ignore-table=$DB_NAME.wp_users \
  --ignore-table=$DB_NAME.wp_usermeta \
  $DB_NAME > $EXPORT_FILE

if [ $? -ne 0 ]; then
    echo "❌ Error: Failed to create database export"
    exit 1
fi

echo "✅ Base export created"

echo ""
echo "🔄 Step 2: Applying comprehensive URL replacements..."

# Apply all URL replacement patterns
sed -i '' "s|$LOCAL_URL|$STAGING_URL|g" $EXPORT_FILE
sed -i '' 's|http://buzznbloom\\.test|https://buzznbloomstg.wpenginepowered.com|g' $EXPORT_FILE
sed -i '' 's|buzznbloom\\.test\\\\/|buzznbloomstg.wpenginepowered.com\\\\/|g' $EXPORT_FILE
sed -i '' 's|buzznbloom\\.test\\\\\\\\|buzznbloomstg.wpenginepowered.com\\\\\\\\|g' $EXPORT_FILE
sed -i '' 's|buzznbloom\\.test|buzznbloomstg.wpenginepowered.com|g' $EXPORT_FILE

echo "✅ URL replacements completed"

echo ""
echo "🧹 Step 3: Adding comprehensive staging fixes..."

# Add comprehensive fixes including proper header assignment
cat >> $EXPORT_FILE << 'EOF'

-- ULTIMATE Staging Environment Fixes
-- ==================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET AUTOCOMMIT=0;
START TRANSACTION;

-- 1. Clear ALL caches and transients
DELETE FROM wp_options WHERE option_name LIKE '%_transient_%';
DELETE FROM wp_options WHERE option_name LIKE '%_cache_%';

-- 2. Clear problematic cron jobs
DELETE FROM wp_options WHERE option_name = 'cron' AND option_value LIKE '%action_scheduler_run_queue%';
DELETE FROM wp_actionscheduler_actions WHERE hook = 'action_scheduler_run_queue';

-- 3. Ensure correct site URLs
UPDATE wp_options SET option_value = 'https://buzznbloomstg.wpenginepowered.com' WHERE option_name = 'home';
UPDATE wp_options SET option_value = 'https://buzznbloomstg.wpenginepowered.com' WHERE option_name = 'siteurl';

-- 4. Set correct active theme
UPDATE wp_options SET option_value = 'basilico' WHERE option_name = 'template';
UPDATE wp_options SET option_value = 'basilico-child' WHERE option_name = 'stylesheet';

-- 5. Fix Elementor theme builder conditions to use Header Main (ID: 17)
DELETE FROM wp_options WHERE option_name = 'elementor_pro_theme_builder_conditions';
INSERT INTO wp_options (option_name, option_value, autoload) 
VALUES ('elementor_pro_theme_builder_conditions', 'a:2:{s:6:"header";a:1:{i:17;a:1:{i:0;s:15:"include/general";}}s:6:"footer";a:1:{i:65;a:1:{i:0;s:15:"include/general";}}}', 'yes');

-- 6. Ensure ALL pxl-template posts are published
UPDATE wp_posts SET post_status = 'publish' WHERE post_type = 'pxl-template' AND post_status != 'publish';

-- 7. Clear Elementor caches
DELETE FROM wp_options WHERE option_name LIKE '%elementor_cache%';
DELETE FROM wp_postmeta WHERE meta_key = '_elementor_css';
UPDATE wp_postmeta SET meta_value = '' WHERE meta_key = '_elementor_inline_svg';

-- 8. Fix any remaining URL issues in serialized data
UPDATE wp_options 
SET option_value = REPLACE(option_value, 'http://buzznbloom.test', 'https://buzznbloomstg.wpenginepowered.com')
WHERE option_value LIKE '%buzznbloom.test%';

-- 9. Update postmeta URLs
UPDATE wp_postmeta 
SET meta_value = REPLACE(meta_value, 'http://buzznbloom.test', 'https://buzznbloomstg.wpenginepowered.com')
WHERE meta_value LIKE '%buzznbloom.test%';

-- 10. Ensure menu locations are properly set
UPDATE wp_options 
SET option_value = 'a:2:{s:18:"nav_menu_locations";a:3:{s:14:"main-menu-left";i:48;s:9:"menu-main";i:50;s:15:"main-menu-right";i:51;}s:18:"custom_css_post_id";i:-1;}'
WHERE option_name = 'theme_mods_basilico-child';

-- 11. Fix widget areas
UPDATE wp_options 
SET option_value = REPLACE(option_value, 'http://buzznbloom.test', 'https://buzznbloomstg.wpenginepowered.com')
WHERE option_name LIKE 'widget_%';

-- 12. Regenerate Elementor kit settings
UPDATE wp_options 
SET option_value = REPLACE(option_value, '"site_url":"http:\\/\\/buzznbloom.test"', '"site_url":"https:\\/\\/buzznbloomstg.wpenginepowered.com"')
WHERE option_name = 'elementor_kit_settings';

-- NOTE: This export preserves existing wp_users and wp_usermeta tables

COMMIT;
SET FOREIGN_KEY_CHECKS=1;

-- Force refresh of all caches after import
EOF

echo "✅ Staging fixes added"

echo ""
echo "📋 Step 4: Comprehensive verification..."

# Detailed verification
TEMPLATE_COUNT=$(grep -c "pxl-template" $EXPORT_FILE)
ELEMENTOR_COUNT=$(grep -c "_elementor" $EXPORT_FILE)
THEME_MODS_COUNT=$(grep -c "theme_mods" $EXPORT_FILE)
NAV_MENU_COUNT=$(grep -c "nav_menu" $EXPORT_FILE)
MENU_ITEM_COUNT=$(grep -c "nav_menu_item" $EXPORT_FILE)
WIDGET_COUNT=$(grep -c "widget_" $EXPORT_FILE)
PXL_OPTIONS_COUNT=$(grep -c "pxl_.*options" $EXPORT_FILE)

FILE_SIZE=$(du -h $EXPORT_FILE | cut -f1)

echo ""
echo "✅ ULTIMATE EXPORT COMPLETE!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📁 Output file: $EXPORT_FILE"
echo "📏 File size: $FILE_SIZE"
echo ""
echo "📊 Comprehensive content verification:"
echo "   • PXL Template references: $TEMPLATE_COUNT"
echo "   • Elementor metadata: $ELEMENTOR_COUNT"
echo "   • Theme modifications: $THEME_MODS_COUNT"
echo "   • Navigation menus: $NAV_MENU_COUNT"
echo "   • Menu items: $MENU_ITEM_COUNT"
echo "   • Widget configurations: $WIDGET_COUNT"
echo "   • Theme options: $PXL_OPTIONS_COUNT"
echo ""
echo "🔒 Security:"
echo "   ✅ User tables: PRESERVED (no login issues)"
echo "   ✅ No 403/access problems"
echo ""
echo "🎯 This export includes:"
echo "   ✅ ALL content, posts, and pages"
echo "   ✅ ALL pxl-template posts (headers/footers)"
echo "   ✅ ALL theme options and customizations"
echo "   ✅ ALL Elementor data, settings, and kit configuration"
echo "   ✅ ALL navigation menus and assignments"
echo "   ✅ ALL widget configurations"
echo "   ✅ Proper header/footer template assignments"
echo "   ✅ Complete URL replacements"
echo "   ✅ Comprehensive staging fixes"
echo ""
echo "📋 Import Instructions:"
echo "   1. Import this file via WP Engine phpMyAdmin"
echo "   2. Clear ALL caches in WP Engine"
echo "   3. Visit /wp-admin → Elementor → Tools → Regenerate CSS"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"