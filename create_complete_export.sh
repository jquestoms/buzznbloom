#!/bin/bash

# Complete WordPress Export Script for WP Engine Staging
# This script creates a complete database export with all theme data and customizations
# and properly replaces URLs for staging deployment

echo "🚀 Starting complete WordPress database export for staging..."

# Database configuration (adjust these values for your local setup)
DB_NAME="buzznbloom"
DB_USER="root"
DB_PASS=""
DB_HOST="127.0.0.1"

# URLs
LOCAL_URL="http://buzznbloom.test"
STAGING_URL="https://buzznbloomstg.wpenginepowered.com"

# Output files
EXPORT_FILE="buzznbloom_complete_raw.sql"
FINAL_FILE="buzznbloom_staging_complete.sql"

echo "📊 Step 1: Creating complete database export..."

# Create complete mysqldump with all data including theme options
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
  $DB_NAME > $EXPORT_FILE

if [ $? -ne 0 ]; then
    echo "❌ Error: Failed to create database export"
    exit 1
fi

echo "✅ Raw database export created: $EXPORT_FILE"

echo "🔄 Step 2: Applying URL replacements for staging environment..."

# Copy the raw export to working file
cp $EXPORT_FILE $FINAL_FILE

# Apply comprehensive URL replacements
echo "   - Replacing basic HTTP URLs..."
sed -i '' "s|$LOCAL_URL|$STAGING_URL|g" $FINAL_FILE

echo "   - Replacing serialized URLs with escaped slashes..."
sed -i '' 's|buzznbloom\.test\\/|buzznbloomstg.wpenginepowered.com\\/|g' $FINAL_FILE

echo "   - Replacing serialized URLs with double escaped slashes..."
sed -i '' 's|buzznbloom\.test\\\\|buzznbloomstg.wpenginepowered.com\\\\|g' $FINAL_FILE

echo "   - Replacing domain-only references..."
sed -i '' 's|buzznbloom\.test|buzznbloomstg.wpenginepowered.com|g' $FINAL_FILE

echo "   - Setting correct staging URLs in critical options..."
# Ensure the main site URL options are correct
sed -i '' "s|INSERT INTO \`wp_options\` VALUES (2,'siteurl','[^']*'|INSERT INTO \`wp_options\` VALUES (2,'siteurl','$STAGING_URL'|g" $FINAL_FILE
sed -i '' "s|INSERT INTO \`wp_options\` VALUES (3,'home','[^']*'|INSERT INTO \`wp_options\` VALUES (3,'home','$STAGING_URL'|g" $FINAL_FILE

echo "🧹 Step 3: Cleaning up problematic entries..."

# Remove problematic action scheduler entries that cause cron errors
echo "   - Removing problematic action scheduler cron entries..."
sed -i '' '/action_scheduler_run_queue/d' $FINAL_FILE

# Clean up any transients that might contain old URLs
echo "   - Cleaning transients..."
sed -i '' '/wp_options.*_transient_/d' $FINAL_FILE

echo "📋 Step 4: Adding staging-specific fixes..."

# Add SQL commands at the end to ensure proper configuration
cat >> $FINAL_FILE << 'EOF'

-- Staging-specific fixes and cleanup
-- Clear any remaining problematic cron jobs
DELETE FROM wp_options WHERE option_name = 'cron' AND option_value LIKE '%action_scheduler_run_queue%';

-- Ensure correct site URLs
UPDATE wp_options SET option_value = 'https://buzznbloomstg.wpenginepowered.com' WHERE option_name = 'home';
UPDATE wp_options SET option_value = 'https://buzznbloomstg.wpenginepowered.com' WHERE option_name = 'siteurl';

-- Clear any cached data that might contain old URLs
DELETE FROM wp_options WHERE option_name LIKE '%_transient_%';

-- Clear Action Scheduler entries to prevent cron errors
DELETE FROM wp_actionscheduler_actions WHERE hook = 'action_scheduler_run_queue';

-- Ensure basilico-child theme is active (if it exists in theme_mods)
UPDATE wp_options SET option_value = 'basilico' WHERE option_name = 'template';
UPDATE wp_options SET option_value = 'basilico-child' WHERE option_name = 'stylesheet';

-- Insert theme options if they don't exist
INSERT IGNORE INTO wp_options (option_name, option_value, autoload) VALUES ('template', 'basilico', 'yes');
INSERT IGNORE INTO wp_options (option_name, option_value, autoload) VALUES ('stylesheet', 'basilico-child', 'yes');

COMMIT;
EOF

echo "📊 Step 5: Generating import statistics..."

# Count URL replacements made
URL_COUNT=$(grep -c "buzznbloomstg.wpenginepowered.com" $FINAL_FILE)
FILE_SIZE=$(du -h $FINAL_FILE | cut -f1)

echo ""
echo "✅ EXPORT COMPLETE!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📁 Output file: $FINAL_FILE"
echo "📏 File size: $FILE_SIZE"
echo "🔗 URLs replaced: $URL_COUNT staging URLs found"
echo "🎯 Ready for import to: buzznbloomstg.wpenginepowered.com"
echo ""
echo "📋 Import Instructions:"
echo "1. Go to your WP Engine staging environment"
echo "2. Access phpMyAdmin"
echo "3. Select your database"
echo "4. Go to Import tab"
echo "5. Upload: $FINAL_FILE"
echo "6. Click 'Go' to import"
echo ""
echo "🔧 This export includes:"
echo "   ✅ Complete database with ALL tables"
echo "   ✅ All theme options and customizations"
echo "   ✅ Proper URL replacements for staging"
echo "   ✅ Cleaned action scheduler entries"
echo "   ✅ Theme activation fixes"
echo "   ✅ Staging-specific optimizations"
echo ""
echo "🚨 IMPORTANT: This will completely replace your staging database!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Cleanup temporary file
rm $EXPORT_FILE