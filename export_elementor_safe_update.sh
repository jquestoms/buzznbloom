#!/bin/bash

# Export Elementor and menu data with UPDATE/INSERT handling
# This version handles existing records gracefully

echo "🔍 Creating SAFE Elementor and menu update export..."

DB_NAME="buzznbloom"
DB_USER="root"
DB_PASS=""
DB_HOST="127.0.0.1"

LOCAL_URL="http://buzznbloom.test"
STAGING_URL="https://buzznbloomstg.wpenginepowered.com"

EXPORT_FILE="elementor_safe_update.sql"

echo "📊 Creating safe update export..."

# Create the export with proper handling
cat > $EXPORT_FILE << 'EOF'
-- Safe Elementor and Menu Update Export
-- =====================================
-- This handles existing records gracefully

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET AUTOCOMMIT=0;
START TRANSACTION;

-- 1. Update navigation menu items (don't insert duplicates)
EOF

# Export nav menu items with REPLACE INTO to handle duplicates
echo "-- Navigation Menu Items (using REPLACE to handle duplicates)" >> $EXPORT_FILE
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --no-create-info \
  --complete-insert \
  --extended-insert=FALSE \
  --replace \
  --where="post_type='nav_menu_item'" \
  $DB_NAME wp_posts >> $EXPORT_FILE

# Export postmeta for menu items with DELETE/INSERT pattern
echo -e "\n-- Menu Item Metadata (delete existing and re-insert)" >> $EXPORT_FILE
echo "DELETE FROM wp_postmeta WHERE post_id IN (SELECT ID FROM wp_posts WHERE post_type='nav_menu_item');" >> $EXPORT_FILE
mysql -h $DB_HOST -u $DB_USER -N -e "SELECT ID FROM $DB_NAME.wp_posts WHERE post_type='nav_menu_item'" | while read post_id; do
    mysqldump \
      --host=$DB_HOST \
      --user=$DB_USER \
      --password=$DB_PASS \
      --single-transaction \
      --no-create-info \
      --complete-insert \
      --extended-insert=FALSE \
      --where="post_id=$post_id" \
      $DB_NAME wp_postmeta >> $EXPORT_FILE 2>/dev/null
done

# Handle theme options with DELETE/INSERT
echo -e "\n-- Theme and Elementor Options (delete and re-insert)" >> $EXPORT_FILE
mysql -h $DB_HOST -u $DB_USER -N -e "SELECT option_name FROM $DB_NAME.wp_options WHERE option_name LIKE '%elementor%' OR option_name LIKE '%pxl%' OR option_name LIKE 'theme_mods_%' OR option_name LIKE '%nav_menu_locations%'" | while read option_name; do
    echo "DELETE FROM wp_options WHERE option_name='$option_name';" >> $EXPORT_FILE
done

# Now insert the options
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --no-create-info \
  --complete-insert \
  --extended-insert=FALSE \
  --where="option_name LIKE '%elementor%' OR option_name LIKE '%pxl%' OR option_name LIKE 'theme_mods_%' OR option_name LIKE '%nav_menu_locations%'" \
  $DB_NAME wp_options >> $EXPORT_FILE

# Export Elementor data from postmeta
echo -e "\n-- Elementor Post Data" >> $EXPORT_FILE
echo "DELETE FROM wp_postmeta WHERE meta_key IN ('_elementor_data', '_elementor_edit_mode', '_elementor_template_type');" >> $EXPORT_FILE
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --no-create-info \
  --complete-insert \
  --extended-insert=FALSE \
  --where="meta_key IN ('_elementor_data', '_elementor_edit_mode', '_elementor_template_type')" \
  $DB_NAME wp_postmeta >> $EXPORT_FILE

# Add specific fixes
cat >> $EXPORT_FILE << 'EOF'

-- 2. Ensure header template is active
DELETE FROM wp_options WHERE option_name = 'elementor_pro_theme_builder_conditions';
INSERT INTO wp_options (option_name, option_value, autoload) 
VALUES ('elementor_pro_theme_builder_conditions', 'a:1:{s:6:"header";a:1:{i:17;a:1:{i:0;s:15:"include/general";}}}', 'yes');

-- 3. Clear all Elementor caches
DELETE FROM wp_options WHERE option_name LIKE '_elementor_%_cache%';
DELETE FROM wp_options WHERE option_name LIKE 'elementor_%_cache%';
DELETE FROM wp_postmeta WHERE meta_key = '_elementor_css';

-- 4. Set active theme mods
UPDATE wp_options 
SET option_value = REPLACE(option_value, 'http://buzznbloom.test', 'https://buzznbloomstg.wpenginepowered.com')
WHERE option_name LIKE 'theme_mods_%';

-- 5. Ensure menu locations are set
UPDATE wp_options 
SET option_value = 'a:3:{s:14:"main-menu-left";i:48;s:9:"menu-main";i:50;s:15:"main-menu-right";i:51;}'
WHERE option_name = 'nav_menu_locations' OR (option_name LIKE 'theme_mods_%' AND option_value LIKE '%nav_menu_locations%');

COMMIT;
SET FOREIGN_KEY_CHECKS=1;
EOF

# Apply URL replacements
echo "🔄 Applying URL replacements..."
sed -i '' "s|$LOCAL_URL|$STAGING_URL|g" $EXPORT_FILE
sed -i '' 's|buzznbloom\\.test|buzznbloomstg.wpenginepowered.com|g' $EXPORT_FILE

FILE_SIZE=$(du -h $EXPORT_FILE | cut -f1)

echo ""
echo "✅ SAFE UPDATE EXPORT COMPLETE!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📁 Output file: $EXPORT_FILE"
echo "📏 File size: $FILE_SIZE"
echo ""
echo "🎯 This export:"
echo "   ✅ Handles duplicate entries gracefully"
echo "   ✅ Uses DELETE/INSERT pattern for clean updates"
echo "   ✅ Preserves existing data structure"
echo "   ✅ Updates only Elementor and menu data"
echo ""
echo "📋 Import this file to fix your header/menu styling!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"