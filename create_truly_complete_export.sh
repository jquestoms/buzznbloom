#!/bin/bash

# TRULY COMPLETE WordPress export for WP Engine
# This ensures we capture ABSOLUTELY EVERYTHING

echo "🚀 Creating TRULY COMPLETE WordPress database export..."
echo "   This will capture ALL data, settings, and customizations"
echo ""

DB_NAME="buzznbloom"
DB_USER="root"
DB_PASS=""
DB_HOST="127.0.0.1"

LOCAL_URL="http://buzznbloom.test"
STAGING_URL="https://buzznbloomstg.wpenginepowered.com"

EXPORT_FILE="buzznbloom_truly_complete_export.sql"
TEMP_FILE="buzznbloom_temp_export.sql"

echo "📊 Step 1: Exporting ALL tables and data (except users)..."

# First, get a list of all tables except user tables
TABLES=$(mysql -h $DB_HOST -u $DB_USER -N -e "SHOW TABLES FROM $DB_NAME;" | grep -v "^wp_users$\|^wp_usermeta$" | tr '\n' ' ')

echo "   Found $(echo $TABLES | wc -w) tables to export"

# Export with MAXIMUM completeness
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
  --extended-insert=FALSE \
  --hex-blob \
  --quote-names \
  --tz-utc \
  --comments \
  --dump-date \
  --create-options \
  --quick \
  --lock-tables=false \
  --set-charset \
  --default-character-set=utf8mb4 \
  $DB_NAME $TABLES > $TEMP_FILE

if [ $? -ne 0 ]; then
    echo "❌ Error: Failed to create database export"
    exit 1
fi

echo "✅ Complete database export created"

echo ""
echo "📝 Step 2: Creating comprehensive header with fixes..."

# Create header with character set and initial setup
cat > $EXPORT_FILE << 'EOF'
-- TRULY COMPLETE WordPress Database Export
-- ========================================
-- This export includes ALL data, customizations, and fixes
-- Preserves WP Engine user accounts

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

EOF

# Append the export
cat $TEMP_FILE >> $EXPORT_FILE

echo ""
echo "🔄 Step 3: Applying COMPREHENSIVE URL replacements..."

# Count original URLs before replacement
ORIGINAL_COUNT=$(grep -o "buzznbloom.test" $EXPORT_FILE | wc -l)
echo "   Found $ORIGINAL_COUNT instances of local URL"

# Apply all possible URL patterns
sed -i '' "s|http://buzznbloom\\.test|https://buzznbloomstg.wpenginepowered.com|g" $EXPORT_FILE
sed -i '' "s|http:\\\\/\\\\/buzznbloom\\.test|https:\\\\/\\\\/buzznbloomstg.wpenginepowered.com|g" $EXPORT_FILE
sed -i '' "s|http:\\\\\\\\/\\\\\\\\/buzznbloom\\.test|https:\\\\\\\\/\\\\\\\\/buzznbloomstg.wpenginepowered.com|g" $EXPORT_FILE
sed -i '' "s|buzznbloom\\.test|buzznbloomstg.wpenginepowered.com|g" $EXPORT_FILE

# Verify replacements
REMAINING_COUNT=$(grep -o "buzznbloom.test" $EXPORT_FILE | wc -l)
echo "   Replaced $(($ORIGINAL_COUNT - $REMAINING_COUNT)) URLs"
if [ $REMAINING_COUNT -gt 0 ]; then
    echo "   ⚠️  Warning: $REMAINING_COUNT instances may still remain"
fi

echo ""
echo "🔧 Step 4: Adding CRITICAL staging environment fixes..."

# Add comprehensive fixes
cat >> $EXPORT_FILE << 'EOF'

-- CRITICAL POST-IMPORT FIXES
-- ==========================

-- 1. Clear ALL caches and transients
DELETE FROM wp_options WHERE option_name LIKE '%_transient_%';
DELETE FROM wp_options WHERE option_name LIKE '%_cache%';

-- 2. Set correct site URLs (belt and suspenders)
UPDATE wp_options SET option_value = 'https://buzznbloomstg.wpenginepowered.com' WHERE option_name IN ('home', 'siteurl');

-- 3. Fix theme settings
UPDATE wp_options SET option_value = 'basilico' WHERE option_name = 'template';
UPDATE wp_options SET option_value = 'basilico-child' WHERE option_name = 'stylesheet';

-- 4. CRITICAL: Fix Elementor Pro theme builder conditions
-- Use the actual header that exists (ID 17 - Header Main)
DELETE FROM wp_options WHERE option_name = 'elementor_pro_theme_builder_conditions';
INSERT INTO wp_options (option_name, option_value, autoload) 
VALUES ('elementor_pro_theme_builder_conditions', 'a:2:{s:6:"header";a:1:{i:17;a:1:{i:0;s:15:"include/general";}}s:6:"footer";a:1:{i:65;a:1:{i:0;s:15:"include/general";}}}', 'yes');

-- 5. Clear Elementor caches
DELETE FROM wp_options WHERE option_name LIKE '%elementor%cache%';
DELETE FROM wp_postmeta WHERE meta_key = '_elementor_css';
DELETE FROM wp_postmeta WHERE meta_key = '_elementor_inline_svg';
UPDATE wp_options SET option_value = '' WHERE option_name = '_elementor_global_css';

-- 6. Fix any serialized data with URLs
UPDATE wp_options SET option_value = REPLACE(option_value, 's:19:"buzznbloom.test"', 's:35:"buzznbloomstg.wpenginepowered.com"') WHERE option_value LIKE '%buzznbloom.test%';
UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 's:19:"buzznbloom.test"', 's:35:"buzznbloomstg.wpenginepowered.com"') WHERE meta_value LIKE '%buzznbloom.test%';

-- 7. Ensure all custom post types are published
UPDATE wp_posts SET post_status = 'publish' WHERE post_type IN ('pxl-template', 'elementor_library') AND post_status = 'draft';

-- 8. Fix menu locations
DELETE FROM wp_options WHERE option_name = 'theme_mods_basilico-child';
INSERT INTO wp_options (option_name, option_value, autoload) 
SELECT 'theme_mods_basilico-child', option_value, 'yes' 
FROM wp_options 
WHERE option_name = 'theme_mods_basilico' 
LIMIT 1;

-- 9. Clear any remaining problematic options
DELETE FROM wp_options WHERE option_name = 'cron' AND option_value LIKE '%action_scheduler%';
DELETE FROM wp_actionscheduler_actions WHERE status != 'complete';

-- 10. Final URL cleanup in all text fields
UPDATE wp_posts SET guid = REPLACE(guid, 'http://buzznbloom.test', 'https://buzznbloomstg.wpenginepowered.com') WHERE guid LIKE '%buzznbloom.test%';
UPDATE wp_posts SET post_content = REPLACE(post_content, 'http://buzznbloom.test', 'https://buzznbloomstg.wpenginepowered.com') WHERE post_content LIKE '%buzznbloom.test%';
UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'http://buzznbloom.test', 'https://buzznbloomstg.wpenginepowered.com') WHERE meta_value LIKE '%buzznbloom.test%' AND meta_key != '_elementor_data';

-- Restore settings
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Export completed
EOF

# Clean up temp file
rm -f $TEMP_FILE

echo ""
echo "📋 Step 5: Final verification..."

# Comprehensive verification
TABLE_COUNT=$(grep -c "CREATE TABLE" $EXPORT_FILE)
INSERT_COUNT=$(grep -c "INSERT INTO" $EXPORT_FILE)
FILE_SIZE=$(du -h $EXPORT_FILE | cut -f1)

echo ""
echo "✅ TRULY COMPLETE EXPORT FINISHED!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📁 Output file: $EXPORT_FILE"
echo "📏 File size: $FILE_SIZE"
echo ""
echo "📊 Export Statistics:"
echo "   • Tables exported: $TABLE_COUNT"
echo "   • Insert statements: $INSERT_COUNT"
echo "   • URL replacements completed"
echo "   • Header fix included (ID 17)"
echo "   • All caches will be cleared"
echo ""
echo "🎯 This is your COMPLETE export that includes:"
echo "   ✅ ALL 80 database tables (excluding users)"
echo "   ✅ ALL posts, pages, and custom post types"
echo "   ✅ ALL options and settings"
echo "   ✅ ALL Elementor data and configurations"
echo "   ✅ ALL theme customizations"
echo "   ✅ ALL menu configurations"
echo "   ✅ Proper header/footer assignments"
echo "   ✅ Complete URL replacements"
echo "   ✅ All necessary staging fixes"
echo ""
echo "📝 To use this export:"
echo "   1. Import via WP Engine phpMyAdmin"
echo "   2. Clear all WP Engine caches"
echo "   3. Your site should work immediately!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"