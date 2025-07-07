#!/bin/bash
# Check if theme actually supports Elementor header location

echo "=== Checking Theme Header Support ==="
echo ""

ssh buzznbloomstg@buzznbloomstg.ssh.wpengine.net << 'EOF'
cd sites/buzznbloomstg

echo "1. Check theme's header.php for Elementor support:"
echo "=== Checking basilico/header.php ==="
if [ -f "wp-content/themes/basilico/header.php" ]; then
    grep -n "elementor_theme_do_location\|elementor_location\|elementor.*header" wp-content/themes/basilico/header.php || echo "No Elementor header hooks found in parent theme"
fi

echo -e "\n=== Checking basilico-child/header.php ==="
if [ -f "wp-content/themes/basilico-child/header.php" ]; then
    grep -n "elementor_theme_do_location\|elementor_location\|elementor.*header" wp-content/themes/basilico-child/header.php || echo "No child theme header.php"
else
    echo "Child theme uses parent header.php"
fi

echo -e "\n2. Check if theme declares Elementor support:"
grep -r "add_theme_support.*elementor\|elementor-pro" wp-content/themes/basilico*/functions.php 2>/dev/null || echo "No explicit Elementor support found"

echo -e "\n3. Check theme's actual header.php content:"
echo "=== First 50 lines of basilico/header.php ==="
head -50 wp-content/themes/basilico/header.php 2>/dev/null || echo "Cannot read header.php"

echo -e "\n4. Check if there's a different header template mechanism:"
find wp-content/themes/basilico* -name "*header*.php" -type f | head -10

echo -e "\n5. Check Elementor Pro plugin status:"
wp plugin get elementor-pro --field=status

EOF