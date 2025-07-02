#!/bin/bash

# Create safer WordPress export that preserves WP Engine users
# This excludes user tables to prevent staging access issues

echo "🚀 Creating SAFE WordPress database export for staging..."

DB_NAME="buzznbloom"
DB_USER="root"
DB_PASS=""
DB_HOST="127.0.0.1"

LOCAL_URL="http://buzznbloom.test"
STAGING_URL="https://buzznbloomstg.wpenginepowered.com"

EXPORT_FILE="buzznbloom_safe_export.sql"

echo "📊 Step 1: Creating export WITHOUT user tables..."

# Export everything EXCEPT user-related tables
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
  --ignore-table=$DB_NAME.wp_users \
  --ignore-table=$DB_NAME.wp_usermeta \
  $DB_NAME > $EXPORT_FILE

if [ $? -ne 0 ]; then
    echo "❌ Error: Failed to create database export"
    exit 1
fi

echo "✅ Safe database export created: $EXPORT_FILE"

echo "🔄 Step 2: Applying URL replacements..."

# Apply URL replacements
sed -i '' "s|$LOCAL_URL|$STAGING_URL|g" $EXPORT_FILE
sed -i '' 's|buzznbloom\.test\\/|buzznbloomstg.wpenginepowered.com\\/|g' $EXPORT_FILE
sed -i '' 's|buzznbloom\.test\\\\|buzznbloomstg.wpenginepowered.com\\\\|g' $EXPORT_FILE
sed -i '' 's|buzznbloom\.test|buzznbloomstg.wpenginepowered.com|g' $EXPORT_FILE

echo "🧹 Step 3: Adding safe staging fixes..."

# Add staging fixes that DON'T affect users
cat >> $EXPORT_FILE << 'EOF'

-- SAFE Staging-specific fixes (preserves existing users)
-- Clear any remaining problematic cron jobs
DELETE FROM wp_options WHERE option_name = 'cron' AND option_value LIKE '%action_scheduler_run_queue%';

-- Ensure correct site URLs
UPDATE wp_options SET option_value = 'https://buzznbloomstg.wpenginepowered.com' WHERE option_name = 'home';
UPDATE wp_options SET option_value = 'https://buzznbloomstg.wpenginepowered.com' WHERE option_name = 'siteurl';

-- Clear any cached data that might contain old URLs
DELETE FROM wp_options WHERE option_name LIKE '%_transient_%';

-- Clear Action Scheduler entries to prevent cron errors
DELETE FROM wp_actionscheduler_actions WHERE hook = 'action_scheduler_run_queue';

-- Ensure basilico-child theme is active
UPDATE wp_options SET option_value = 'basilico' WHERE option_name = 'template';
UPDATE wp_options SET option_value = 'basilico-child' WHERE option_name = 'stylesheet';

-- Insert theme options if they don't exist
INSERT IGNORE INTO wp_options (option_name, option_value, autoload) VALUES ('template', 'basilico', 'yes');
INSERT IGNORE INTO wp_options (option_name, option_value, autoload) VALUES ('stylesheet', 'basilico-child', 'yes');

-- NOTE: This export intentionally preserves existing wp_users and wp_usermeta
-- to maintain WP Engine staging environment user configuration

COMMIT;
EOF

FILE_SIZE=$(du -h $EXPORT_FILE | cut -f1)

echo ""
echo "✅ SAFE EXPORT COMPLETE!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📁 Output file: $EXPORT_FILE"
echo "📏 File size: $FILE_SIZE"
echo "🔒 User tables: PRESERVED (won't overwrite staging users)"
echo "🎯 Ready for import to: buzznbloomstg.wpenginepowered.com"
echo ""
echo "✅ This export includes:"
echo "   ✅ All content, options, and theme data"
echo "   ✅ Proper URL replacements for staging"
echo "   ✅ PRESERVES existing staging users"
echo "   ✅ Won't cause 403/access issues"
echo "   ✅ Safe for WP Engine staging environment"
echo ""
echo "🚨 IMPORTANT: This will preserve existing staging users and permissions!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"