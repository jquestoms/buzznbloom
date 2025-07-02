#!/bin/bash

# Final comprehensive export of ALL customizations

echo "🚀 Creating FINAL customizations export..."

DB_NAME="buzznbloom"
DB_USER="root"
DB_PASS=""
DB_HOST="127.0.0.1"

LOCAL_URL="http://buzznbloom.test"
STAGING_URL="https://buzznbloomstg.wpenginepowered.com"

EXPORT_FILE="final_customizations.sql"

echo "📊 Exporting all customization data..."

# 1. Export ALL pxl-template posts (headers, footers, etc)
echo "-- PXL Templates" > $EXPORT_FILE
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --no-create-info \
  --replace \
  --where="post_type = 'pxl-template'" \
  $DB_NAME wp_posts >> $EXPORT_FILE

# 2. Export ALL postmeta for templates
echo -e "\n-- Template Metadata" >> $EXPORT_FILE
TEMPLATE_IDS=$(mysql -h $DB_HOST -u $DB_USER $DB_NAME -N -e "SELECT ID FROM wp_posts WHERE post_type = 'pxl-template';" | tr '\n' ',' | sed 's/,$//')
if [ ! -z "$TEMPLATE_IDS" ]; then
  mysqldump \
    --host=$DB_HOST \
    --user=$DB_USER \
    --password=$DB_PASS \
    --single-transaction \
    --no-create-info \
    --replace \
    --where="post_id IN ($TEMPLATE_IDS)" \
    $DB_NAME wp_postmeta >> $EXPORT_FILE
fi

# 3. Export ALL theme-related options
echo -e "\n-- Theme Options" >> $EXPORT_FILE
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --no-create-info \
  --replace \
  --where="option_name LIKE 'theme_mods_%' OR option_name LIKE 'pxltheme%' OR option_name LIKE '%basilico%' OR option_name LIKE '%elementor%' OR option_name LIKE '%hfe%'" \
  $DB_NAME wp_options >> $EXPORT_FILE

# 4. Apply URL replacements
echo "🔄 Applying URL replacements..."
sed -i '' "s|$LOCAL_URL|$STAGING_URL|g" $EXPORT_FILE

# 5. Add fixes
echo -e "\n-- Final Fixes" >> $EXPORT_FILE
cat >> $EXPORT_FILE << 'EOF'

-- Ensure templates are properly assigned
UPDATE wp_options 
SET option_value = REPLACE(option_value, 'http://buzznbloom.test', 'https://buzznbloomstg.wpenginepowered.com')
WHERE option_name LIKE 'pxltheme%' OR option_name LIKE 'theme_mods_%';

-- Clear any caches
DELETE FROM wp_options WHERE option_name LIKE '%_transient_%elementor%';
DELETE FROM wp_options WHERE option_name LIKE '%_transient_%pxl%';

COMMIT;
EOF

FILE_SIZE=$(du -h $EXPORT_FILE | cut -f1)

echo ""
echo "✅ FINAL EXPORT COMPLETE!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📁 Output file: $EXPORT_FILE"
echo "📏 File size: $FILE_SIZE"
echo ""
echo "🎯 This file contains:"
echo "   ✅ ALL header/footer templates"
echo "   ✅ ALL theme customizations"
echo "   ✅ ALL Elementor settings"
echo "   ✅ Proper URL replacements"
echo ""
echo "📋 Import this AFTER the main database!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"