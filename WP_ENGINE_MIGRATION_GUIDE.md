# WP Engine Database Migration Guide

## Files Created:
- `buzznbloom_local_export.sql` - Your original local database export
- `buzznbloom_staging_corrected.sql` - **READY FOR IMPORT** - Pre-corrected export with all URLs updated
- `search-replace.sql` - Enhanced SQL script for additional URL updates if needed

## Step-by-Step Migration Process:

### 1. Database Export & URL Correction (COMPLETED)
✅ Local database exported to `buzznbloom_local_export.sql`
✅ URLs corrected and saved to `buzznbloom_staging_corrected.sql`
✅ **All 28 local URLs have been replaced with staging URLs**

**What was corrected:**
- Changed `http://buzznbloom.test` to `https://buzznbloomstg.wpenginepowered.com`
- Fixed URLs in serialized data (WordPress options, Elementor settings, etc.)
- Updated escaped URLs in JSON/serialized content
- Ensured SSL (HTTPS) protocol for WP Engine environment

### 2. Import to WP Engine Staging

#### ⭐ **RECOMMENDED**: Use the Pre-Corrected File

#### Option A: Using WP Engine's phpMyAdmin (RECOMMENDED)
1. Log into your WP Engine User Portal
2. Go to your staging environment
3. Click on "phpMyAdmin" 
4. Select your database
5. Go to "Import" tab
6. Choose the `buzznbloom_staging_corrected.sql` file (**NOT** the original export)
7. Click "Go" to import

#### Option B: Using WP-CLI (if available)
```bash
# You'll need WP Engine's database credentials
mysql -h [WP_ENGINE_HOST] -u [WP_ENGINE_USER] -p [WP_ENGINE_DB] < buzznbloom_staging_corrected.sql
```

### 3. Post-Import Verification (URLs should already be correct)

Since you're using the pre-corrected file, URLs should already be updated. However, you can run these verification queries:

```sql
-- Verify site URLs are correct
SELECT option_name, option_value FROM wp_options WHERE option_name IN ('home', 'siteurl');

-- Should show: https://buzznbloomstg.wpenginepowered.com
```

#### If Additional URL Updates Are Needed:
Only run the `search-replace.sql` script if you find any remaining local URLs:

1. Go to phpMyAdmin in WP Engine
2. Select your database
3. Go to "SQL" tab
4. Copy and paste the contents of `search-replace.sql`
5. Execute the queries

### 4. Alternative: Use WP-CLI Search-Replace (Usually Not Needed)

Since URLs are pre-corrected, this is typically unnecessary. But if you have WP-CLI access on WP Engine and need additional replacements:
```bash
# Check for any remaining local URLs (should be none)
wp search-replace 'http://buzznbloom.test' 'https://buzznbloomstg.wpenginepowered.com' --dry-run
# Only run if dry-run shows replacements needed
wp search-replace 'http://buzznbloom.test' 'https://buzznbloomstg.wpenginepowered.com'
```

### 5. Update wp-config.php

Make sure your WP Engine staging environment's `wp-config.php` has the correct database credentials provided by WP Engine.

### 6. Test Your Site

After migration:
1. Visit your staging URL: https://buzznbloomstg.wpenginepowered.com
2. Test admin login
3. Check that all pages load correctly
4. Verify media files are accessible
5. Test any forms or functionality

## Important Notes:

- **Backup First**: Always backup your WP Engine staging database before importing
- **Pre-Corrected File**: Use `buzznbloom_staging_corrected.sql` for import - it already has all URL corrections
- **Serialized Data**: ✅ **HANDLED** - All serialized data has been corrected (Elementor, options, etc.)
- **File Uploads**: Media files need to be uploaded separately or synced to `/wp-content/uploads/`
- **SSL**: ✅ **HANDLED** - All URLs updated to HTTPS for WP Engine compatibility
- **URL Count**: 28 total URL references were corrected in the export file

## Troubleshooting:

If you encounter issues:
1. Check database connection settings
2. Verify URL replacements were successful
3. Clear any caching
4. Check error logs in WP Engine
5. Contact WP Engine support if needed

## Next Steps:

After successful migration:
1. Test all functionality
2. Update any remaining hardcoded URLs
3. Configure staging-specific settings
4. Set up any staging-specific plugins or configurations 