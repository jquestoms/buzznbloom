# WP Engine Staging Setup Instructions

## 🚀 Complete Setup Guide for buzznbloomstg.wpenginepowered.com

### SSH Access
```bash
ssh buzznbloomstg@buzznbloomstg.ssh.wpengine.net
```
- Provides command line access to staging server
- Can run WP-CLI commands for database queries and maintenance
- See STAGING_SSH_ACCESS.md for detailed usage examples

### Step 1: Get WP Engine Database Credentials

1. **Log into WP Engine User Portal**
2. **Go to your staging environment**
3. **Click "Database" tab**
4. **Note these credentials:**
   - Database Name: `_____________`
   - Username: `_____________`
   - Password: `_____________`
   - Host: `_____________`

### Step 2: Create wp-config.php for Staging

1. **Open the file:** `wp-config-staging-template.php`
2. **Replace the placeholder values:**
   ```php
   define( 'DB_NAME', 'YOUR_ACTUAL_DATABASE_NAME' );
   define( 'DB_USER', 'YOUR_ACTUAL_USERNAME' );
   define( 'DB_PASSWORD', 'YOUR_ACTUAL_PASSWORD' );
   define( 'DB_HOST', 'YOUR_ACTUAL_HOST' );
   ```
3. **Save the file as:** `wp-config.php`

### Step 3: Upload wp-config.php to Staging

**Option A: Using WP Engine File Manager**
1. Go to WP Engine User Portal → Your Site → **File Manager**
2. Navigate to the root directory (same level as wp-admin, wp-content)
3. Upload your `wp-config.php` file
4. Ensure permissions are set to 644

**Option B: Using SFTP/SSH**
1. Connect to your WP Engine staging environment via SFTP
2. Upload `wp-config.php` to the root directory
3. Set file permissions to 644

### Step 4: Import Database (Already Done ✅)

✅ **Completed:** `buzznbloom_staging_complete.sql` has been imported
- Contains all theme options and customizations
- URLs properly replaced for staging environment
- Action Scheduler issues cleaned up

### Step 5: Verify Setup

1. **Visit your staging site:** https://buzznbloomstg.wpenginepowered.com
2. **Expected results:**
   - ✅ Site loads without "database connection" error
   - ✅ Basilico theme is active
   - ✅ All your local customizations are visible
   - ✅ Admin login works

### Step 6: Test Everything

**Frontend Testing:**
- [ ] Homepage loads correctly
- [ ] All pages display your custom styling
- [ ] Images and media work
- [ ] Navigation menus work
- [ ] Contact forms function

**Admin Testing:**
- [ ] WordPress admin login works
- [ ] Theme customizations are preserved
- [ ] Plugins are active and functional
- [ ] No error messages in admin

## 🔧 Troubleshooting

### If you still get "Error establishing a database connection":

1. **Double-check database credentials** in wp-config.php
2. **Verify the file was uploaded** to the correct location
3. **Check file permissions** (should be 644)
4. **Contact WP Engine support** if credentials don't work

### If the site loads but looks different:

1. **Clear all caches** in WP Engine User Portal
2. **Check if themes were deployed** via git (should be ✅ done)
3. **Verify database import** completed successfully

### If admin access doesn't work:

1. **Use the same login credentials** as your local site
2. **Reset password** if needed via database
3. **Check user permissions** in wp_users table

## 🎯 Expected Final Result

Your staging site should look **identical** to your local site:
- Same theme and styling
- Same content and pages  
- Same functionality
- All customizations preserved

## 📞 Support

If you encounter issues:
1. **WP Engine Support:** For database/hosting issues
2. **Check error logs** in WP Engine User Portal → Logs
3. **Verify all steps** were completed correctly

---

**🔒 Security Note:** Never commit wp-config.php to git! It's already in .gitignore ✅