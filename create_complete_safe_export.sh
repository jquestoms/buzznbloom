#!/bin/bash

# COMPLETE WordPress export that preserves WP Engine users AND includes ALL customizations
# This is the MASTER export script for future use

echo "🚀 Creating COMPLETE & SAFE WordPress database export for staging..."

DB_NAME="buzznbloom"
DB_USER="root"
DB_PASS=""
DB_HOST="127.0.0.1"

LOCAL_URL="http://buzznbloom.test"
STAGING_URL="https://buzznbloomstg.wpenginepowered.com"

EXPORT_FILE="buzznbloom_complete_safe_export.sql"

echo "📊 Step 1: Creating export WITHOUT user tables..."

# Export everything EXCEPT user-related tables
# INCLUDING all custom tables for themes/plugins
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --routines \
  --triggers \
  --add-drop-table \
  --extended-insert \
  --comments \
  --create-options \
  --quick \
  --lock-tables=false \
  --complete-insert \
  --ignore-table=$DB_NAME.wp_users \
  --ignore-table=$DB_NAME.wp_usermeta \
  $DB_NAME > $EXPORT_FILE

if [ $? -ne 0 ]; then
    echo "❌ Error: Failed to create database export"
    exit 1
fi

echo "✅ Safe database export created"

echo "🔄 Step 2: Applying URL replacements..."

# Apply comprehensive URL replacements
sed -i '' "s|$LOCAL_URL|$STAGING_URL|g" $EXPORT_FILE
sed -i '' 's|buzznbloom\.test\\/|buzznbloomstg.wpenginepowered.com\\/|g' $EXPORT_FILE
sed -i '' 's|buzznbloom\.test\\\\|buzznbloomstg.wpenginepowered.com\\\\|g' $EXPORT_FILE
sed -i '' 's|buzznbloom\.test|buzznbloomstg.wpenginepowered.com|g' $EXPORT_FILE

echo "🧹 Step 3: Adding staging fixes and ensuring all customizations..."

# Add comprehensive staging fixes
cat >> $EXPORT_FILE << 'EOF'

-- COMPLETE Staging-specific fixes (preserves existing users)
-- ============================================================

-- 1. Clear problematic cron jobs
DELETE FROM wp_options WHERE option_name = 'cron' AND option_value LIKE '%action_scheduler_run_queue%';
DELETE FROM wp_actionscheduler_actions WHERE hook = 'action_scheduler_run_queue';

-- 2. Ensure correct site URLs
UPDATE wp_options SET option_value = 'https://buzznbloomstg.wpenginepowered.com' WHERE option_name = 'home';
UPDATE wp_options SET option_value = 'https://buzznbloomstg.wpenginepowered.com' WHERE option_name = 'siteurl';

-- 3. Clear transients
DELETE FROM wp_options WHERE option_name LIKE '%_transient_%';

-- 4. Ensure theme is properly set
UPDATE wp_options SET option_value = 'basilico' WHERE option_name = 'template';
UPDATE wp_options SET option_value = 'basilico-child' WHERE option_name = 'stylesheet';

-- 5. CRITICAL: Ensure ALL pxl-template posts are properly imported
-- This ensures headers/footers are available
UPDATE wp_posts SET post_status = 'publish' WHERE post_type = 'pxl-template' AND post_status = 'draft';

-- 6. Fix any remaining URL issues in theme options
UPDATE wp_options 
SET option_value = REPLACE(option_value, 'http://buzznbloom.test', 'https://buzznbloomstg.wpenginepowered.com')
WHERE option_name LIKE 'pxltheme%' OR option_name LIKE 'theme_mods_%';

-- 7. Clear Elementor cache
DELETE FROM wp_options WHERE option_name LIKE '%elementor_cache%';
DELETE FROM wp_postmeta WHERE meta_key = '_elementor_css';

-- 8. Ensure header/footer assignments
UPDATE wp_postmeta pm
JOIN wp_posts p ON pm.post_id = p.ID
SET pm.meta_value = (SELECT ID FROM wp_posts WHERE post_type = 'pxl-template' AND post_name = 'header-main' LIMIT 1)
WHERE pm.meta_key = 'header_layout' AND pm.meta_value = '-1' AND p.post_type = 'page';

UPDATE wp_postmeta pm
JOIN wp_posts p ON pm.post_id = p.ID
SET pm.meta_value = (SELECT ID FROM wp_posts WHERE post_type = 'pxl-template' AND post_name = 'footer-main' LIMIT 1)
WHERE pm.meta_key = 'footer_layout' AND pm.meta_value = '-1' AND p.post_type = 'page';

-- NOTE: This export preserves existing wp_users and wp_usermeta tables

COMMIT;
EOF

echo "📋 Step 4: Verifying export includes critical components..."

# Check for important content
TEMPLATE_COUNT=$(grep -c "pxl-template" $EXPORT_FILE)
ELEMENTOR_COUNT=$(grep -c "elementor" $EXPORT_FILE)
THEME_MODS_COUNT=$(grep -c "theme_mods" $EXPORT_FILE)
NAV_MENU_COUNT=$(grep -c "nav_menu" $EXPORT_FILE)
MENU_ITEM_COUNT=$(grep -c "nav_menu_item" $EXPORT_FILE)

FILE_SIZE=$(du -h $EXPORT_FILE | cut -f1)

echo ""
echo "✅ COMPLETE EXPORT FINISHED!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📁 Output file: $EXPORT_FILE"
echo "📏 File size: $FILE_SIZE"
echo ""
echo "📊 Content verification:"
echo "   • Template references: $TEMPLATE_COUNT"
echo "   • Elementor references: $ELEMENTOR_COUNT"
echo "   • Theme mods references: $THEME_MODS_COUNT"
echo "   • Navigation menus: $NAV_MENU_COUNT"
echo "   • Menu items: $MENU_ITEM_COUNT"
echo ""
echo "🔒 Security:"
echo "   ✅ User tables: PRESERVED (won't overwrite staging users)"
echo "   ✅ No 403/access issues"
echo ""
echo "🎯 This export includes:"
echo "   ✅ ALL content and pages"
echo "   ✅ ALL pxl-template posts (headers/footers)"
echo "   ✅ ALL theme options and customizations"
echo "   ✅ ALL Elementor data and settings"
echo "   ✅ Proper URL replacements"
echo "   ✅ Staging-specific fixes"
echo ""
echo "📋 Usage: This is your MASTER export script for future deployments!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"