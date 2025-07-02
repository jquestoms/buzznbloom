# Manual Header Fix Steps for WP Engine Staging

If the SQL fixes haven't resolved the header issue, follow these manual steps in the WordPress admin.

## Prerequisites
- Access to WordPress admin at https://buzznbloomstg.wpenginepowered.com/wp-admin/
- Elementor Pro must be activated with a valid license
- Administrator level access

## Step 1: Verify Elementor Pro License
1. Go to **Elementor → License**
2. Ensure license shows as "Active"
3. If not active, enter your license key and activate

## Step 2: Check Theme Builder Templates
1. Navigate to **Templates → Theme Builder**
2. Look for "Header Main" in the list
3. Check its status:
   - Should show "Publish" (not "Draft")
   - Should have conditions set (usually shows "Entire Site")
4. If missing or draft:
   - Click "Add New" → Select "Header" → Name it "Header Main"
   - Design a basic header or import from library
   - Set conditions to "Entire Site"
   - Publish

## Step 3: Verify Display Conditions
1. In Theme Builder, hover over "Header Main"
2. Click on "Conditions" or the display conditions text
3. Ensure it's set to:
   - Include: Entire Site
   - No exclusions (unless specifically needed)
4. Save if you make changes

## Step 4: Check Individual Page Settings
1. Edit the home page
2. In Elementor, click the gear icon (Page Settings)
3. Under "Page Layout":
   - Ensure "Header" is not set to "Hide"
   - Check that "Page Template" is set to "Elementor Full Width" or "Elementor Canvas"
4. Update the page

## Step 5: Menu Configuration
1. Go to **Appearance → Menus**
2. Verify a menu exists and has items
3. Under "Menu Settings" → "Display location":
   - Check "Primary Menu" or "Main Menu"
4. Save Menu

## Step 6: Theme Customizer Check
1. Go to **Appearance → Customize**
2. Navigate to Header settings (location varies by theme)
3. Ensure:
   - Header is enabled
   - Header layout is set correctly
   - No "Hide Header" options are checked
4. Publish changes (even if you didn't make any)

## Step 7: Elementor Global Settings
1. Go to **Elementor → Settings**
2. Under "General" tab:
   - Post Types: Ensure "Pages" and "Posts" are checked
3. Under "Advanced" tab:
   - CSS Print Method: Set to "Internal Embedding"
4. Save Changes

## Step 8: Clear All Caches
1. **WP Engine Cache**:
   - Go to WP Engine plugin in admin
   - Click "Clear All Caches"
   
2. **Elementor Cache**:
   - Go to **Elementor → Tools**
   - Click "Regenerate CSS & Data"
   - Click "Sync Library"
   
3. **Browser Cache**:
   - Hard refresh: Ctrl+Shift+R (Windows) or Cmd+Shift+R (Mac)

## Step 9: Plugin Conflict Test
If header still doesn't appear:
1. Go to **Plugins**
2. Deactivate all plugins EXCEPT:
   - Elementor
   - Elementor Pro
   - WP Engine System
3. Check if header appears
4. If it does, reactivate plugins one by one to find the conflict

## Step 10: Theme Fallback Test
1. Go to **Appearance → Themes**
2. Temporarily activate Twenty Twenty-Four
3. Check if menus appear
4. Switch back to pxlz theme
5. This often forces WordPress to refresh theme settings

## Step 11: Direct Template Edit
1. Go to **Templates → Saved Templates**
2. Find "Header Main" (ID should be 17)
3. Click "Edit with Elementor"
4. Make a small change (like adding a space)
5. Update the template
6. This forces Elementor to regenerate the template

## Step 12: Database Verification
If you have phpMyAdmin access:
1. Check `wp_posts` table:
   ```sql
   SELECT * FROM wp_posts WHERE ID = 17;
   ```
   - Verify post_status = 'publish'
   - Verify post_type = 'pxl-template'

2. Check theme builder conditions:
   ```sql
   SELECT * FROM wp_options WHERE option_name = 'elementor_pro_theme_builder_conditions';
   ```

## Step 13: Last Resort - Recreate Header
1. In Theme Builder, create a new header template
2. Name it something different (e.g., "Header Staging")
3. Design the header with menu widget
4. Set conditions to "Entire Site"
5. Delete or deactivate the old header template

## Common Issues and Solutions

### Issue: "Nothing Found" message
- Templates might be in trash - check Trash in Templates
- Database prefix might be different - verify wp_ prefix

### Issue: Header appears in Elementor editor but not frontend
- Cache issue - clear all caches multiple times
- Theme conflict - check theme's header.php file

### Issue: Menu items missing but header structure appears
- Check Appearance → Menus
- Verify menu is assigned to correct location
- Check if menu items are published pages

## Verification Checklist
After each major step, check:
- [ ] Visit homepage - is header visible?
- [ ] Check other pages - is header consistent?
- [ ] Open browser console - any JavaScript errors?
- [ ] View page source - is header HTML present?

## Contact Support
If none of these steps work:
1. Document which steps you've tried
2. Take screenshots of:
   - Theme Builder page
   - Current site header area
   - Any error messages
3. Contact WP Engine support with this information