# WP Engine Staging SSH Access

## SSH Connection Command
```bash
ssh buzznbloomstg@buzznbloomstg.ssh.wpengine.net
```

## Usage Notes
- This provides SSH access to the WP Engine staging environment
- Can be used for WP-CLI commands and direct server access
- Useful for running database queries via WP-CLI

## Example WP-CLI Commands via SSH
```bash
# Check theme
wp option get template
wp option get stylesheet

# Check header template
wp db query "SELECT ID, post_title, post_status FROM wp_posts WHERE ID = 17"

# Clear caches
wp cache flush
wp elementor flush-css

# Check menu locations
wp option get nav_menu_locations
```

## Database Access via SSH
```bash
# Run SQL queries directly
wp db query "SELECT * FROM wp_options WHERE option_name = 'theme_mods_basilico-child'"

# Export database
wp db export staging-backup.sql

# Import SQL file
wp db query < fix_file.sql
```

## File Access
- WordPress root: `/home/wpe-user/sites/buzznbloomstg`
- Themes: `/home/wpe-user/sites/buzznbloomstg/wp-content/themes/`
- Uploads: `/home/wpe-user/sites/buzznbloomstg/wp-content/uploads/`

Last updated: 2025-01-02