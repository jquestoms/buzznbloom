# WP Engine Deployment Guide

## 🚀 Complete Deployment Process

### Prerequisites
- Local development environment (Herd/MAMP/etc)
- Git repository connected to WP Engine
- WP Engine staging environment

### Step 1: Export Database (USE THIS SCRIPT!)

**ALWAYS use the master export script for complete exports:**

```bash
./create_complete_safe_export.sh
```

This script:
- ✅ Exports ALL content including pxl-template posts (headers/footers)
- ✅ Preserves WP Engine user accounts (no 403 errors)
- ✅ Includes ALL theme customizations
- ✅ Automatically replaces URLs for staging
- ✅ Fixes common migration issues

### Step 2: Push Code via Git

```bash
# Check status
git status

# Add all changes
git add .

# Commit
git commit -m "Your commit message"

# Push to WP Engine
git push origin main
```

**Important Git Notes:**
- ✅ Plugins ARE tracked in git (including premium plugins)
- ❌ Uploads are NOT tracked (transfer separately)
- ❌ wp-config.php is NOT tracked (already in .gitignore)

### Step 3: Import Database

1. Go to WP Engine User Portal
2. Navigate to phpMyAdmin
3. Select your database
4. Click "Import" tab
5. Upload `buzznbloom_complete_safe_export.sql`
6. Click "Go"

### Step 4: Upload Media Files

**Via WP Engine File Manager:**
1. Go to File Manager in WP Engine portal
2. Navigate to wp-content/
3. Upload your uploads folder

**Via SFTP (faster for large uploads):**
```bash
# Use your WP Engine SFTP credentials
sftp username@buzznbloomstg.wpenginepowered.com
cd wp-content/
put -r uploads/
```

### Step 5: Clear Caches

In WP Engine Portal:
1. Click "Clear All Caches"
2. Wait 30 seconds
3. Visit your staging site

## 🔧 Troubleshooting

### Missing Header/Footer Customizations?

The theme uses `pxl-template` custom post type for headers/footers. If missing:

1. Check if templates exist:
```sql
SELECT * FROM wp_posts WHERE post_type = 'pxl-template';
```

2. Run the complete export script (it includes all templates)

### Database Connection Error?

- Verify wp-config.php has correct WP Engine credentials
- Check that you didn't overwrite wp_users table

### 403 Forbidden Error?

- The safe export script preserves WP Engine users
- Never include wp_users or wp_usermeta in exports

## 📝 Script Locations

- **Master Export:** `create_complete_safe_export.sh` (USE THIS!)
- **Old Scripts (deprecated):**
  - `create_safe_export.sh` - Missing templates
  - `create_complete_export.sh` - Includes user tables (causes 403)

## 🎯 Key Points to Remember

1. **ALWAYS use `create_complete_safe_export.sh`** for exports
2. **Themes and plugins** go through Git
3. **Uploads** go through FTP/File Manager
4. **wp-config.php** stays environment-specific
5. **Clear caches** after deployment

## 📋 Pre-Deployment Checklist

- [ ] Run complete safe export script
- [ ] Commit all code changes to git
- [ ] Verify .gitignore excludes wp-config.php
- [ ] Have WP Engine credentials ready
- [ ] Backup staging before import (optional)

## 🚨 Critical Files

These custom post types MUST be included in exports:
- `pxl-template` - Headers, footers, and other templates
- `elementor_library` - Elementor templates
- Theme options in `wp_options` table

---

Last updated: 2024-03-28
Script version: 1.0