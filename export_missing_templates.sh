#!/bin/bash

# Export ALL missing templates and their metadata

echo "🚀 Exporting missing templates for staging..."

DB_NAME="buzznbloom"
DB_USER="root"
DB_PASS=""
DB_HOST="127.0.0.1"

LOCAL_URL="http://buzznbloom.test"
STAGING_URL="https://buzznbloomstg.wpenginepowered.com"

EXPORT_FILE="missing_templates_fix.sql"

echo "📊 Step 1: Exporting all pxl-template posts..."

# Export all template posts
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --no-create-info \
  --extended-insert=FALSE \
  --where="post_type = 'pxl-template' AND post_status = 'publish'" \
  $DB_NAME wp_posts > $EXPORT_FILE

echo "📊 Step 2: Exporting template metadata..."

# Get all template post IDs
TEMPLATE_IDS=$(mysql -h $DB_HOST -u $DB_USER $DB_NAME -N -e "SELECT ID FROM wp_posts WHERE post_type = 'pxl-template' AND post_status = 'publish';" | tr '\n' ',' | sed 's/,$//')

if [ ! -z "$TEMPLATE_IDS" ]; then
  # Export postmeta for these templates
  mysqldump \
    --host=$DB_HOST \
    --user=$DB_USER \
    --password=$DB_PASS \
    --single-transaction \
    --no-create-info \
    --extended-insert=FALSE \
    --where="post_id IN ($TEMPLATE_IDS)" \
    $DB_NAME wp_postmeta >> $EXPORT_FILE
fi

echo "🔄 Step 3: Applying URL replacements..."

# Apply URL replacements
sed -i '' "s|$LOCAL_URL|$STAGING_URL|g" $EXPORT_FILE

echo "📊 Step 4: Adding template assignment settings..."

# Add the template assignments
cat >> $EXPORT_FILE << 'EOF'

-- Fix template assignments
INSERT INTO wp_options (option_name, option_value, autoload) 
SELECT 'pxltheme_options', option_value, autoload 
FROM wp_options 
WHERE option_name = 'pxltheme_options'
ON DUPLICATE KEY UPDATE option_value = VALUES(option_value);

-- Ensure header/footer assignments are correct
UPDATE wp_postmeta 
SET meta_value = '17' 
WHERE meta_key = 'header_layout' AND meta_value = '-1';

UPDATE wp_postmeta 
SET meta_value = '65' 
WHERE meta_key = 'footer_layout' AND meta_value = '-1';

EOF

FILE_SIZE=$(du -h $EXPORT_FILE | cut -f1)

echo ""
echo "✅ TEMPLATE EXPORT COMPLETE!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📁 Output file: $EXPORT_FILE"
echo "📏 File size: $FILE_SIZE"
echo ""
echo "📋 Import Instructions:"
echo "1. This file should be imported AFTER the main database"
echo "2. It contains all missing header/footer templates"
echo "3. Import via phpMyAdmin on WP Engine staging"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"