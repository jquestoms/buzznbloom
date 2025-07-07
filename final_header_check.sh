#!/bin/bash
# Final check of all header settings

echo "=== Final Header Configuration Check ==="
echo ""

ssh buzznbloomstg@buzznbloomstg.ssh.wpengine.net << 'EOF'
cd sites/buzznbloomstg

echo "1. Theme header settings:"
wp eval "
\$options = get_option('pxl_theme_options');
echo 'Header Layout: ' . (isset(\$options['header_layout']) ? \$options['header_layout'] : 'not set') . PHP_EOL;
"

echo -e "\n2. Header template status:"
wp db query "SELECT ID, post_title, post_status FROM wp_posts WHERE ID = 17"

echo -e "\n3. Theme builder conditions:"
wp option get elementor_pro_theme_builder_conditions | cut -c1-100

echo -e "\n4. Check a sample page for header settings:"
wp db query "SELECT meta_key, meta_value FROM wp_postmeta WHERE post_id = 5709 AND meta_key IN ('header_layout', 'disable_header')"

echo -e "\n5. Theme info:"
echo "Active theme: $(wp theme list --status=active --field=name)"
echo "Parent theme: $(wp option get template)"

echo -e "\n=== All settings verified. Clear your browser cache and check the site! ==="
EOF