#!/bin/bash
# Check how Basilico theme handles headers

echo "=== Checking Basilico Header System ==="
echo ""

ssh buzznbloomstg@buzznbloomstg.ssh.wpengine.net << 'EOF'
cd sites/buzznbloomstg

echo "1. Check the theme's header class:"
echo "=== Key parts of class-header.php ==="
grep -A 10 -B 2 "function getHeader\|elementor\|pxl-template" wp-content/themes/basilico/inc/classes/class-header.php | head -50

echo -e "\n2. Check theme options for header settings:"
wp db query "SELECT option_name, LENGTH(option_value) as size FROM wp_options WHERE option_name LIKE '%basilico%' OR option_name LIKE '%pxl%theme%'"

echo -e "\n3. Check if theme uses Redux or similar framework:"
wp db query "SELECT option_name FROM wp_options WHERE option_name LIKE '%redux%' OR option_name LIKE '%theme_options%' LIMIT 10"

echo -e "\n4. Look for header template functions:"
grep -r "pxl_template\|pxl-template" wp-content/themes/basilico/inc/ | grep -i header | head -10

echo -e "\n5. Check theme's template loader:"
find wp-content/themes/basilico -name "*.php" -exec grep -l "post_type.*pxl-template" {} \; | head -5

EOF