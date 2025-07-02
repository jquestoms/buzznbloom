#!/bin/bash

# Fix header/footer export - captures all Elementor customizations

echo "🔍 Checking for missing header/footer data..."

DB_NAME="buzznbloom"
DB_USER="root"
DB_PASS=""
DB_HOST="127.0.0.1"

EXPORT_FILE="header_footer_fix.sql"

echo "📊 Exporting header/footer related data..."

# Export specific tables that might contain header data
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --no-create-info \
  --extended-insert=FALSE \
  --where="meta_key LIKE '%header%' OR meta_key LIKE '%footer%' OR meta_key LIKE '%hfe%' OR meta_key LIKE '%elementor%template%'" \
  $DB_NAME wp_postmeta > $EXPORT_FILE

# Also export any Elementor library posts
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --no-create-info \
  --extended-insert=FALSE \
  --where="post_type = 'elementor_library' OR post_type = 'elementor-hf'" \
  $DB_NAME wp_posts >> $EXPORT_FILE

# Export all theme mods and Elementor settings
mysqldump \
  --host=$DB_HOST \
  --user=$DB_USER \
  --password=$DB_PASS \
  --single-transaction \
  --no-create-info \
  --extended-insert=FALSE \
  --where="option_name LIKE 'theme_mods_%' OR option_name LIKE '%elementor%' OR option_name LIKE '%hfe%' OR option_name LIKE '%header%footer%'" \
  $DB_NAME wp_options >> $EXPORT_FILE

echo "✅ Header/footer data exported to: $EXPORT_FILE"
echo ""
echo "📋 Next steps:"
echo "1. Review the exported data"
echo "2. Import this file AFTER the main database import"
echo "3. This will add any missing header/footer customizations"