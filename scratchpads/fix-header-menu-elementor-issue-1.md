# Fix Header Menu and Elementor Customizations - Issue #1

**GitHub Issue Link:** https://github.com/[repo]/issues/1

## Problem Summary
After migrating from local development to WP Engine staging, the header menu and Elementor customizations are not displaying correctly on the staging site. The local site (http://buzznbloom.test/) works correctly, but the staging site (https://buzznbloomstg.wpenginepowered.com/) is missing these elements.

## Root Cause Analysis
Based on the existing documentation found in the codebase:

1. **Custom Post Type Issue**: Headers and footers are stored as `pxl-template` custom post type, which may not have been fully migrated
2. **Header ID**: The correct header ID is 17 (Header Main) as documented in fix_header_and_slider.sql
3. **Elementor Cache**: Elementor cache may need to be cleared after migration
4. **Template Assignments**: Template assignments to pages may have been lost during migration

## Existing Resources Found
- `TROUBLESHOOTING_STAGING.md`: Documents the pxl-template issue and solutions
- `fix_header_and_slider.sql`: Contains SQL fixes for header assignment
- `missing_templates_fix.sql`: Contains actual pxl-template posts data
- `fix_header_export.sh`: Script specifically for exporting header/footer data
- `create_complete_safe_export.sh`: Master export script that should include all necessary data

## Solution Plan

### Phase 1: Analysis
1. Review the existing SQL fix files to understand what corrections have already been prepared
2. Identify which specific fixes need to be applied to staging

### Phase 2: Implementation
1. Create a comprehensive SQL fix that:
   - Ensures all pxl-template posts are present and published
   - Sets correct header assignments (ID 17 for Header Main)
   - Clears Elementor caches
   - Updates theme_mods_pxlz options
   - Ensures menu locations are properly set

### Phase 3: Testing
1. Test the fix locally first to ensure it works
2. Use Puppeteer MCP to verify:
   - Header menu is visible
   - Elementor customizations are displayed
   - No console errors
   - Take screenshots for documentation

### Phase 4: Deployment
1. Document the exact steps needed to apply the fix on staging
2. Create a PR with:
   - The SQL fix file
   - Updated documentation
   - Testing results

## Technical Details

### Key Database Tables Involved:
- `wp_posts`: Contains pxl-template posts
- `wp_postmeta`: Contains Elementor data and template assignments
- `wp_options`: Contains theme_mods and Elementor settings
- `wp_term_relationships`: Menu assignments

### Critical IDs:
- Header Main: ID 17
- Footer Main: ID 29
- Menu location: primary

## Success Criteria
1. Header menu displays correctly on staging site
2. All Elementor customizations are visible
3. No console errors related to missing templates
4. Site appearance matches local development environment

## Update: Issue Persists After Initial Fix
The user has applied the initial SQL fix and activated Elementor Pro license, but the issue persists. Need to investigate further and provide additional solutions.

### Additional Investigation Areas:
1. Check if templates are actually present in the database
2. Verify theme builder conditions are correctly set
3. Check for plugin conflicts or missing dependencies
4. Investigate if there are hardcoded template IDs that don't match
5. Check if there are additional cache layers on WP Engine

## Advanced Solutions Implemented
Created three additional resources to resolve persistent issues:

1. **advanced_header_diagnostics_fix.sql** - Comprehensive diagnostic queries and advanced fixes including:
   - Diagnostic checks to identify the current state
   - More aggressive cache clearing
   - Complete theme builder condition reset
   - Header visibility settings enforcement
   - Plugin activation verification

2. **MANUAL_HEADER_FIX_STEPS.md** - Step-by-step WordPress admin instructions for:
   - Verifying Elementor Pro license
   - Checking and fixing Theme Builder templates
   - Menu configuration verification
   - Plugin conflict testing
   - Last resort template recreation

3. **export_import_header_template.md** - Alternative solution for:
   - Exporting header template from local site
   - Importing to staging site
   - Direct database template migration
   - Manual recreation guidelines