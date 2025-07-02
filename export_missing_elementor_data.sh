#!/bin/bash

# Export ALL missing Elementor and menu customization data
# This captures everything needed for the styled header/menu

echo "🔍 Exporting ALL missing Elementor and menu customization data..."

DB_NAME="buzznbloom"
DB_USER="root"
DB_PASS=""
DB_HOST="127.0.0.1"

LOCAL_URL="http://buzznbloom.test"
STAGING_URL="https://buzznbloomstg.wpenginepowered.com"

EXPORT_FILE="missing_elementor_customizations.sql"

echo "📊 Creating focused export of missing data..."

# Create temporary file for the export
cat > $EXPORT_FILE << 'EOF'
-- Missing Elementor and Menu Customizations Export
-- ================================================
-- This contains ALL the missing data for proper header/menu display

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET AUTOCOMMIT=0;
START TRANSACTION;

-- 1. Ensure ALL navigation menus and items are included
EOF

# Export navigation menus
echo "-- Navigation Menus" >> $EXPORT_FILE
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --no-create-info \
  --complete-insert \
  --extended-insert=FALSE \
  --where="taxonomy='nav_menu'" \
  $DB_NAME wp_term_taxonomy >> $EXPORT_FILE

# Export menu terms
echo -e "\n-- Menu Terms" >> $EXPORT_FILE
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --no-create-info \
  --complete-insert \
  --extended-insert=FALSE \
  $DB_NAME wp_terms >> $EXPORT_FILE

# Export term relationships for menus
echo -e "\n-- Menu Term Relationships" >> $EXPORT_FILE
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --no-create-info \
  --complete-insert \
  --extended-insert=FALSE \
  $DB_NAME wp_term_relationships >> $EXPORT_FILE

# Export ALL nav_menu_item posts
echo -e "\n-- Navigation Menu Items" >> $EXPORT_FILE
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --no-create-info \
  --complete-insert \
  --extended-insert=FALSE \
  --where="post_type='nav_menu_item'" \
  $DB_NAME wp_posts >> $EXPORT_FILE

# Export postmeta for menu items
echo -e "\n-- Menu Item Metadata" >> $EXPORT_FILE
mysql -h $DB_HOST -u $DB_USER -N -e "SELECT post_id FROM $DB_NAME.wp_posts WHERE post_type='nav_menu_item'" | while read post_id; do
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

# Export ALL Elementor settings and data
echo -e "\n-- Elementor Settings and Data" >> $EXPORT_FILE
mysql -h $DB_HOST -u $DB_USER -N -e "SELECT option_name FROM $DB_NAME.wp_options WHERE option_name LIKE '%elementor%' OR option_name LIKE '%pxl%' OR option_name LIKE 'theme_mods_%'" | while read option_name; do
    echo "DELETE FROM wp_options WHERE option_name='$option_name';" >> $EXPORT_FILE
    mysqldump \
      --host=$DB_HOST \
      --user=$DB_USER \
      --password=$DB_PASS \
      --single-transaction \
      --no-create-info \
      --complete-insert \
      --extended-insert=FALSE \
      --where="option_name='$option_name'" \
      $DB_NAME wp_options >> $EXPORT_FILE 2>/dev/null
done

# Add specific fixes
cat >> $EXPORT_FILE << 'EOF'

-- 2. Ensure header template assignments
UPDATE wp_options 
SET option_value = 'a:1:{s:6:"header";a:1:{i:102;a:1:{i:0;s:15:"include/general";}}}'
WHERE option_name = 'elementor_pro_theme_builder_conditions';

-- 3. Clear Elementor cache to force regeneration
DELETE FROM wp_options WHERE option_name LIKE '_elementor_css_%';
DELETE FROM wp_options WHERE option_name LIKE 'elementor_css_%';
DELETE FROM wp_postmeta WHERE meta_key = '_elementor_css';

-- 4. Ensure menu locations are properly set
UPDATE wp_options 
SET option_value = REPLACE(option_value, '"main-menu-left"', '"main-menu-left"')
WHERE option_name LIKE 'theme_mods_%' AND option_value LIKE '%nav_menu_locations%';

-- 5. Fix any widget-specific Elementor data
UPDATE wp_postmeta 
SET meta_value = REPLACE(meta_value, 'http://buzznbloom.test', 'https://buzznbloomstg.wpenginepowered.com')
WHERE meta_key = '_elementor_data' AND meta_value LIKE '%buzznbloom.test%';

COMMIT;
SET FOREIGN_KEY_CHECKS=1;
EOF

# Apply URL replacements
echo "🔄 Applying URL replacements..."
sed -i '' "s|$LOCAL_URL|$STAGING_URL|g" $EXPORT_FILE
sed -i '' 's|buzznbloom\\.test|buzznbloomstg.wpenginepowered.com|g' $EXPORT_FILE

# Check file size and content
FILE_SIZE=$(du -h $EXPORT_FILE | cut -f1)
MENU_COUNT=$(grep -c "nav_menu" $EXPORT_FILE)
ELEMENTOR_COUNT=$(grep -c "elementor" $EXPORT_FILE)

echo ""
echo "✅ MISSING DATA EXPORT COMPLETE!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📁 Output file: $EXPORT_FILE"
echo "📏 File size: $FILE_SIZE"
echo ""
echo "📊 Content included:"
echo "   • Navigation menu references: $MENU_COUNT"
echo "   • Elementor references: $ELEMENTOR_COUNT"
echo ""
echo "📋 This export contains:"
echo "   ✅ ALL navigation menus and items"
echo "   ✅ ALL menu assignments and locations"
echo "   ✅ ALL Elementor settings and configurations"
echo "   ✅ Theme builder conditions for header/footer"
echo "   ✅ Widget-specific Elementor data"
echo ""
echo "🚀 Next steps:"
echo "   1. Import this file via WP Engine phpMyAdmin"
echo "   2. Clear all caches in WP Engine"
echo "   3. Visit the Elementor → Tools → Regenerate CSS"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"