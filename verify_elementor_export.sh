#!/bin/bash

# Verify what Elementor data exists and what might be missing

echo "🔍 Analyzing Elementor and Theme Data..."

DB_NAME="buzznbloom"
DB_USER="root"
DB_PASS=""
DB_HOST="127.0.0.1"

echo ""
echo "📊 Elementor Custom Tables:"
mysql -h $DB_HOST -u $DB_USER -e "SHOW TABLES FROM $DB_NAME;" | grep -E "(elementor|pxl)" || echo "   No custom Elementor tables found"

echo ""
echo "📊 Elementor Post Meta Keys:"
mysql -h $DB_HOST -u $DB_USER -e "SELECT COUNT(*) as count, meta_key FROM $DB_NAME.wp_postmeta WHERE meta_key LIKE '%elementor%' GROUP BY meta_key ORDER BY count DESC;"

echo ""
echo "📊 Theme-specific Post Meta:"
mysql -h $DB_HOST -u $DB_USER -e "SELECT COUNT(*) as count, meta_key FROM $DB_NAME.wp_postmeta WHERE meta_key LIKE '%pxl%' OR meta_key LIKE '%basilico%' GROUP BY meta_key ORDER BY count DESC;"

echo ""
echo "📊 Header/Footer Assignments:"
mysql -h $DB_HOST -u $DB_USER -e "SELECT pm.post_id, pm.meta_key, pm.meta_value, p.post_title FROM $DB_NAME.wp_postmeta pm JOIN $DB_NAME.wp_posts p ON pm.post_id = p.ID WHERE pm.meta_key IN ('header_layout', 'footer_layout', 'custom_header', 'custom_footer');"

echo ""
echo "📊 Elementor Global Settings:"
mysql -h $DB_HOST -u $DB_USER -e "SELECT option_name, LENGTH(option_value) as size FROM $DB_NAME.wp_options WHERE option_name LIKE '%elementor%' AND option_name NOT LIKE '%transient%' ORDER BY size DESC LIMIT 20;"

echo ""
echo "📊 Theme Options:"
mysql -h $DB_HOST -u $DB_USER -e "SELECT option_name, LENGTH(option_value) as size FROM $DB_NAME.wp_options WHERE (option_name LIKE 'pxl_%' OR option_name LIKE 'theme_mods_%' OR option_name = 'basilico_options') ORDER BY size DESC;"

echo ""
echo "📊 Widget Data:"
mysql -h $DB_HOST -u $DB_USER -e "SELECT option_name FROM $DB_NAME.wp_options WHERE option_name LIKE 'widget_%';"

echo ""
echo "📊 Critical Missing Check - Elementor Conditions:"
mysql -h $DB_HOST -u $DB_USER -e "SELECT * FROM $DB_NAME.wp_options WHERE option_name = 'elementor_pro_theme_builder_conditions';"