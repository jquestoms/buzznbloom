# Fix for Header Menu and Elementor Customizations on WP Engine Staging

## Issue Description
GitHub Issue #1: After migrating from local development to WP Engine staging, the header menu and Elementor customizations are not displaying correctly.

- **Local Site (Working):** http://buzznbloom.test/
- **Staging Site (Issue):** https://buzznbloomstg.wpenginepowered.com/

## Root Cause
The issue occurs because:
1. Header templates (stored as `pxl-template` custom post type) are not properly assigned
2. Elementor theme builder conditions are missing or incorrect
3. Cache needs to be cleared after migration
4. URL replacements may not have been fully completed in serialized data

## Solution Files
- `fix_staging_header_menu_issue1.sql` - Comprehensive SQL fix for staging

## How to Apply the Fix

### Method 1: Via phpMyAdmin (Recommended)
1. Log into WP Engine User Portal
2. Navigate to buzznbloomstg environment
3. Click on phpMyAdmin
4. Select the database
5. Click on SQL tab
6. Copy the entire contents of `fix_staging_header_menu_issue1.sql`
7. Paste into the SQL query box
8. Click "Go" to execute

### Method 2: Via WP CLI (if available)
```bash
wp db import fix_staging_header_menu_issue1.sql
```

## Post-Fix Steps (REQUIRED)
1. Clear WP Engine caches:
   - Log into WP Admin
   - Go to WP Engine plugin
   - Click "Clear All Caches"

2. Regenerate Elementor CSS:
   - Go to Elementor → Tools
   - Click "Regenerate CSS & Data"

3. Clear browser cache and hard refresh

## What This Fix Does
1. **Forces Header Assignment**: Sets Header Main (ID 17) as the site-wide header
2. **Ensures Template is Published**: Makes sure the header template has 'publish' status
3. **Clears All Caches**: Removes Elementor and transient caches
4. **Updates Page Headers**: Fixes any page-specific header assignments
5. **Sets Theme Mods**: Ensures theme recognizes the header
6. **Fixes Menu Locations**: Ensures primary menu location is set
7. **URL Replacements**: Completes any remaining URL replacements
8. **Activates Elementor Pro**: Ensures Pro features are active
9. **Sets Active Kit**: Ensures Elementor kit is properly configured

## Verification Steps
1. Visit https://buzznbloomstg.wpenginepowered.com/
2. Verify header menu is visible
3. Check that Elementor customizations appear
4. Test menu navigation
5. Check browser console for any errors

## Troubleshooting
If the header still doesn't appear after applying the fix:

1. **Manual Header Assignment**:
   - Go to Templates → Theme Builder
   - Edit Header Main
   - Click on conditions
   - Set to "Entire Site"
   - Save

2. **Check Template Status**:
   - Go to Templates → Saved Templates
   - Ensure Header Main is "Published" not "Draft"

3. **Menu Assignment**:
   - Go to Appearance → Menus
   - Ensure a menu is assigned to "Primary" location

4. **Plugin Conflicts**:
   - Temporarily deactivate all plugins except Elementor and Elementor Pro
   - If header appears, reactivate plugins one by one to find conflict

## Prevention for Future Migrations
Use the `create_complete_safe_export.sh` script which includes all necessary data:
- All pxl-template posts
- Proper URL replacements
- Theme modifications
- Elementor settings

## Related Documentation
- `TROUBLESHOOTING_STAGING.md` - General staging troubleshooting
- `WP_ENGINE_MIGRATION_GUIDE.md` - Complete migration guide
- `fix_header_and_slider.sql` - Original header fix (partial)