#!/bin/bash
# Basilico Theme-Aware Export Script
# This includes the critical pxl_theme_options that Basilico uses for headers

echo "=== Creating Basilico Theme-Aware Export ==="
echo "This export includes theme-specific settings required for headers to work"
echo ""

# Set variables
SOURCE_URL="http://buzznbloom.test"
TARGET_URL="https://buzznbloomstg.wpenginepowered.com"
OUTPUT_FILE="buzznbloom_basilico_complete_export.sql"

# Start the export
echo "Starting export with Basilico theme support..."

# Create the export with all necessary components
cat > $OUTPUT_FILE << 'EOF'
-- Basilico Theme-Aware Complete Export
-- =====================================
-- This export includes critical theme-specific settings

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET AUTOCOMMIT=0;
START TRANSACTION;

EOF

# Export the database
echo "Exporting database..."
mysqldump -h 127.0.0.1 -u root buzznbloom \
  --single-transaction \
  --no-create-db \
  --skip-add-drop-table \
  --skip-comments \
  --no-tablespaces | \
  sed "s/CREATE TABLE/CREATE TABLE IF NOT EXISTS/g" | \
  sed "s/$SOURCE_URL/$TARGET_URL/g" >> $OUTPUT_FILE

# Add critical theme options at the end
echo "" >> $OUTPUT_FILE
echo "-- CRITICAL: Ensure Basilico theme options are set correctly" >> $OUTPUT_FILE
echo "-- This is required for headers to display!" >> $OUTPUT_FILE
cat >> $OUTPUT_FILE << 'EOF'

-- Fix any header hiding settings
DELETE FROM wp_postmeta WHERE meta_key = 'header_layout' AND meta_value = '-1';
DELETE FROM wp_postmeta WHERE meta_key = 'disable_header' AND meta_value = '1';

-- Ensure theme is set correctly
UPDATE wp_options SET option_value = 'basilico' WHERE option_name = 'template';
UPDATE wp_options SET option_value = 'basilico-child' WHERE option_name = 'stylesheet';

-- Clear caches
DELETE FROM wp_options WHERE option_name LIKE '%_transient_%';
DELETE FROM wp_postmeta WHERE meta_key = '_elementor_css';

COMMIT;
SET FOREIGN_KEY_CHECKS=1;

-- POST IMPORT: Run this WP-CLI command via SSH:
-- wp eval "$options = get_option('pxl_theme_options'); $options['header_layout'] = '17'; update_option('pxl_theme_options', $options);"
EOF

echo ""
echo "Export completed: $OUTPUT_FILE"
echo ""
echo "IMPORTANT POST-IMPORT STEPS:"
echo "1. Import this file via phpMyAdmin"
echo "2. SSH to server: ssh buzznbloomstg@buzznbloomstg.ssh.wpengine.net"
echo "3. Run: cd sites/buzznbloomstg"
echo "4. Run: wp eval \"\\\$options = get_option('pxl_theme_options'); \\\$options['header_layout'] = '17'; update_option('pxl_theme_options', \\\$options);\""
echo "5. Run: wp cache flush"
echo "6. Clear WP Engine cache via admin"