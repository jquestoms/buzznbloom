# WP Engine Staging Troubleshooting Guide

## ⚠️ CRITICAL: Basilico Theme Header Issue (SOLVED!)
**The Basilico theme uses a custom header system that bypasses Elementor's standard theme builder!**

### Quick Fix for Missing Headers:
```bash
# SSH to staging
ssh buzznbloomstg@buzznbloomstg.ssh.wpengine.net
cd sites/buzznbloomstg

# Run this CRITICAL command:
wp eval "\$options = get_option('pxl_theme_options'); \$options['header_layout'] = '17'; update_option('pxl_theme_options', \$options);"
wp cache flush
```

**Why this happens**: Basilico theme ignores Elementor theme builder conditions and uses `pxl_theme_options['header_layout']` instead. See SOLUTION_HEADER_ISSUE_1.md for full details.

## 🚨 CRITICAL: Use the Correct Export Script!

**ALWAYS USE:** `./create_complete_safe_export.sh`
- ✅ Includes ALL pxl-template posts (headers/footers)
- ✅ Preserves WP Engine user accounts
- ✅ Includes all theme customizations
- ✅ Handles URL replacements automatically

**DO NOT USE:** Old scripts that miss critical data

## ✅ Pre-Import Status Check

**If you used the complete safe export:**
- All local URLs have been pre-corrected
- Serialized data has been handled
- SSL (HTTPS) URLs are already set
- Headers/footers/templates are included
- User tables are preserved

## Issue: "Nothing Found" After Database Import

### Common Causes and Solutions:

#### 1. **URL Configuration Issues**
This should be rare if using the pre-corrected file, but check anyway.

**Verify URLs are correct:**
```sql
-- Check current site URL settings (should show staging URLs)
SELECT option_name, option_value FROM wp_options WHERE option_name IN ('home', 'siteurl');

-- Expected result: https://buzznbloomstg.wpenginepowered.com

-- If they still show local URLs, update them:
UPDATE wp_options SET option_value = 'https://buzznbloomstg.wpenginepowered.com' WHERE option_name = 'home';
UPDATE wp_options SET option_value = 'https://buzznbloomstg.wpenginepowered.com' WHERE option_name = 'siteurl';
```

**Check for any remaining local URLs:**
```sql
-- Search for any remaining local URLs in options
SELECT option_name, option_value FROM wp_options WHERE option_value LIKE '%buzznbloom.test%';

-- Search for local URLs in post content
SELECT ID, post_title FROM wp_posts WHERE post_content LIKE '%buzznbloom.test%';
```

#### 2. **Database Connection Issues**
Verify your wp-config.php has correct WP Engine database credentials.

**Check in WP Engine:**
- Go to User Portal → Your Site → Database
- Note the database name, username, password, and host
- Verify these match your wp-config.php

#### 3. **File Permissions**
WP Engine may have different file permissions.

**Check:**
- Ensure wp-config.php is readable
- Check that wp-content directory has proper permissions
- Verify .htaccess file exists and is readable

#### 4. **Missing .htaccess File**
WordPress needs .htaccess for URL rewriting.

**Create .htaccess if missing:**
```apache
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
# END WordPress
```

#### 5. **Database Table Prefix Issues**
Ensure the table prefix matches between your export and import.

**Check:**
```sql
-- Verify table prefix
SHOW TABLES LIKE 'wp_%';
```

#### 6. **WP Engine Specific Issues**

**Check WP Engine Logs:**
- Go to User Portal → Your Site → Logs
- Check for PHP errors or database connection issues

**Clear WP Engine Caches:**
- Go to User Portal → Your Site → Caches
- Clear all caches

#### 7. **Alternative Database Import Method**

If phpMyAdmin import failed, try:
1. **Split the SQL file** into smaller chunks (the corrected file is ready for splitting)
2. **Use WP Engine's backup/restore** feature
3. **Import via WP-CLI** if available:
   ```bash
   mysql -h [WP_ENGINE_HOST] -u [WP_ENGINE_USER] -p [WP_ENGINE_DB] < buzznbloom_staging_corrected.sql
   ```

#### 8. **File Import Issues**
The corrected SQL file is quite large due to Elementor and media content.

**If import times out:**
- Try importing in smaller chunks
- Increase PHP timeout limits (contact WP Engine support)
- Use command line import instead of web interface

### Step-by-Step Debugging:

1. **Check Site URL:**
   - Visit: https://buzznbloomstg.wpenginepowered.com
   - Check for redirects or errors
   - Should show your homepage if URLs are correct

2. **Verify Database Import Success:**
   - Go to phpMyAdmin
   - Verify tables exist and have data
   - Check wp_options table for correct URLs:
     ```sql
     SELECT option_name, option_value FROM wp_options WHERE option_name IN ('home', 'siteurl');
     ```
   - Should show: `https://buzznbloomstg.wpenginepowered.com`

3. **Check Error Logs:**
   - WP Engine User Portal → Your Site → Logs
   - Look for PHP errors or database connection errors
   - Check for 404 or redirect errors

4. **Test Database Connection:**
   - Create a simple test file to verify database connectivity
   - Or check wp-config.php database credentials

5. **Verify Media Files:**
   - Check if `/wp-content/uploads/` directory exists
   - Verify image URLs are accessible
   - Upload media files separately if needed

### Quick Fix Commands (if you have WP-CLI access):

```bash
# Check WordPress status
wp core is-installed

# Check current site URL (should already be correct)
wp option get home
wp option get siteurl
# Expected: https://buzznbloomstg.wpenginepowered.com

# Only run these if URLs are incorrect:
# Update site URLs
wp option update home 'https://buzznbloomstg.wpenginepowered.com'
wp option update siteurl 'https://buzznbloomstg.wpenginepowered.com'

# Search and replace (should find few/no matches if pre-corrected file was used)
wp search-replace 'http://buzznbloom.test' 'https://buzznbloomstg.wpenginepowered.com' --dry-run
wp search-replace 'http://buzznbloom.test' 'https://buzznbloomstg.wpenginepowered.com'

# Flush rewrite rules
wp rewrite flush

# Clear all caches
wp cache flush
```

### Additional Debugging for Pre-Corrected Import:

Since you used the pre-corrected file, also check:

```bash
# Verify no local URLs remain
wp search-replace 'buzznbloom.test' 'buzznbloomstg.wpenginepowered.com' --dry-run

# Check for any Elementor-specific issues
wp option get elementor_settings

# Regenerate Elementor CSS (if using Elementor)
wp elementor flush_css --network
```

### Contact WP Engine Support:
If issues persist, contact WP Engine support with:
- Your site name: buzznbloomstg.wpenginepowered.com
- Specific error messages
- Steps you've already tried
- Mention you used a pre-corrected SQL export with URL replacements
- Size of import file and any timeout issues encountered

## Issue: Missing Header/Footer Customizations

### Cause:
The theme uses `pxl-template` custom post type for headers and footers. These might be missing if:
- Wrong export script was used
- Templates weren't published
- Template assignments were lost

### Solution:
1. **Use the complete export script** that includes all templates
2. **Check if templates exist:**
   ```sql
   SELECT ID, post_title, post_status FROM wp_posts WHERE post_type = 'pxl-template';
   ```
3. **Import the supplemental file if needed:**
   - `final_customizations.sql` contains all missing templates

### Success Indicators:
✅ Site loads at https://buzznbloomstg.wpenginepowered.com
✅ Admin login works
✅ Custom header/footer appear correctly
✅ All images and media display correctly  
✅ Elementor pages render properly
✅ No broken links or 404 errors
✅ SSL certificate shows as secure 