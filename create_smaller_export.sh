#!/bin/bash

# Create smaller, more reliable export for WP Engine import
# This breaks the export into manageable chunks

echo "🚀 Creating smaller, more reliable export for staging..."

DB_NAME="buzznbloom"
DB_USER="root"
DB_PASS=""
DB_HOST="127.0.0.1"

LOCAL_URL="http://buzznbloom.test"
STAGING_URL="https://buzznbloomstg.wpenginepowered.com"

echo "📊 Step 1: Creating structure-only export..."
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --no-data \
  --single-transaction \
  --routines \
  --triggers \
  $DB_NAME > buzznbloom_structure.sql

echo "📊 Step 2: Creating critical data export (options, posts, users)..."
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --no-create-info \
  --single-transaction \
  --where="1 limit 1000" \
  $DB_NAME wp_options wp_posts wp_postmeta wp_users wp_usermeta > buzznbloom_critical_data.sql

echo "🔄 Step 3: Applying URL replacements..."
sed -i '' "s|$LOCAL_URL|$STAGING_URL|g" buzznbloom_critical_data.sql
sed -i '' 's|buzznbloom\.test\\/|buzznbloomstg.wpenginepowered.com\\/|g' buzznbloom_critical_data.sql
sed -i '' 's|buzznbloom\.test\\\\|buzznbloomstg.wpenginepowered.com\\\\|g' buzznbloom_critical_data.sql
sed -i '' 's|buzznbloom\.test|buzznbloomstg.wpenginepowered.com|g' buzznbloom_critical_data.sql

echo "🧹 Step 4: Adding cleanup and fixes..."
cat >> buzznbloom_critical_data.sql << 'EOF'

-- Staging fixes
UPDATE wp_options SET option_value = 'https://buzznbloomstg.wpenginepowered.com' WHERE option_name = 'home';
UPDATE wp_options SET option_value = 'https://buzznbloomstg.wpenginepowered.com' WHERE option_name = 'siteurl';
UPDATE wp_options SET option_value = 'basilico' WHERE option_name = 'template';
UPDATE wp_options SET option_value = 'basilico-child' WHERE option_name = 'stylesheet';
DELETE FROM wp_options WHERE option_name LIKE '%_transient_%';
DELETE FROM wp_options WHERE option_name = 'cron' AND option_value LIKE '%action_scheduler_run_queue%';
EOF

echo ""
echo "✅ SMALLER EXPORT COMPLETE!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📁 Files created:"
echo "   1. buzznbloom_structure.sql (database structure)"
echo "   2. buzznbloom_critical_data.sql (essential data with theme settings)"
echo ""
echo "📋 Import these files IN ORDER:"
echo "   1. First: buzznbloom_structure.sql"
echo "   2. Then: buzznbloom_critical_data.sql"
echo ""
echo "💡 These smaller files are less likely to timeout during import"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"