#!/bin/bash
# Fix Basilico theme header settings

echo "=== Fixing Basilico Theme Header Settings ==="
echo ""

ssh buzznbloomstg@buzznbloomstg.ssh.wpengine.net << 'EOF'
cd sites/buzznbloomstg

echo "1. Check current theme options for header_layout:"
wp db query "SELECT option_value FROM wp_options WHERE option_name = 'pxl_theme_options'" --skip-column-names > /tmp/theme_options.txt
echo "Theme options size: $(wc -c < /tmp/theme_options.txt) bytes"

echo -e "\n2. Check what header_layout value should be (from theme_mods):"
wp option get theme_mods_basilico-child header_layout
wp option get theme_mods_basilico header_layout

echo -e "\n3. Update pxl_theme_options to set header_layout to 17:"
# This is tricky because it's serialized data. Let's try using WP-CLI
wp eval "
\$options = get_option('pxl_theme_options');
if(is_array(\$options)) {
    \$options['header_layout'] = '17';
    update_option('pxl_theme_options', \$options);
    echo 'Updated header_layout to 17';
} else {
    echo 'Could not parse theme options';
}
"

echo -e "\n4. Also check page-specific header disable option:"
wp db query "SELECT p.ID, p.post_title, pm.meta_value FROM wp_posts p JOIN wp_postmeta pm ON p.ID = pm.post_id WHERE pm.meta_key = 'disable_header' AND pm.meta_value = '1' LIMIT 10"

echo -e "\n5. Remove any page-specific header disabling:"
wp db query "DELETE FROM wp_postmeta WHERE meta_key = 'disable_header' AND meta_value = '1'"

echo -e "\n6. Clear all caches again:"
wp cache flush
wp elementor flush-css

echo -e "\n=== Basilico theme header settings updated! ==="
EOF