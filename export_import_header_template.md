# Alternative Solution: Export/Import Header Template

If the SQL fixes don't work, you can manually export the header template from your local site and import it to staging.

## Export from Local Site (http://buzznbloom.test/)

1. **Access Local WordPress Admin**
   - Go to http://buzznbloom.test/wp-admin/
   - Login with your credentials

2. **Export Header Template**
   - Navigate to **Templates → Saved Templates**
   - Find "Header Main" (ID 17)
   - Hover over it and click "Export"
   - Save the .json file to your computer (e.g., `header-main-template.json`)

3. **Export Complete Theme Builder Setup** (Alternative)
   - Go to **Elementor → Tools**
   - Click on "Export Templates"
   - Select "Theme Builder"
   - This exports ALL your templates including headers/footers

## Import to Staging Site (https://buzznbloomstg.wpenginepowered.com/)

1. **Access Staging WordPress Admin**
   - Go to https://buzznbloomstg.wpenginepowered.com/wp-admin/
   - Login with your credentials

2. **Import Header Template**
   - Navigate to **Templates → Saved Templates**
   - Click "Import Templates" button
   - Choose the .json file you exported
   - Click "Import Now"

3. **Assign Template Conditions**
   - After import, go to **Templates → Theme Builder**
   - Find the imported header template
   - Click on "Conditions" or "Display Conditions"
   - Set to "Entire Site"
   - Save changes

4. **Clear Caches**
   - WP Engine cache
   - Elementor cache (Tools → Regenerate CSS)
   - Browser cache

## Direct Database Template Export (Advanced)

If the above doesn't work, you can export the template directly from the database:

### On Local Site:
```sql
-- Export the header template post
SELECT * FROM wp_posts WHERE ID = 17 AND post_type = 'pxl-template';

-- Export the template's postmeta
SELECT * FROM wp_postmeta WHERE post_id = 17;

-- Export Elementor data
SELECT * FROM wp_postmeta WHERE post_id = 17 AND meta_key = '_elementor_data';
```

### On Staging Site:
1. Delete existing header template if corrupted:
   ```sql
   DELETE FROM wp_posts WHERE ID = 17 AND post_type = 'pxl-template';
   DELETE FROM wp_postmeta WHERE post_id = 17;
   ```

2. Insert the exported data from local site
3. Update URLs in the Elementor data:
   ```sql
   UPDATE wp_postmeta 
   SET meta_value = REPLACE(meta_value, 'buzznbloom.test', 'buzznbloomstg.wpenginepowered.com')
   WHERE post_id = 17 AND meta_key = '_elementor_data';
   ```

## Verify Menu Widget Settings

The header template likely contains an Elementor Nav Menu widget. After import:

1. Edit the header template with Elementor
2. Click on the Navigation Menu widget
3. In the widget settings:
   - Ensure a menu is selected
   - Check responsive settings
   - Verify styling matches your needs
4. Update the template

## Additional Import Options

### Using Elementor's Template Library:
1. On local site, save header as "Template" (not just export)
2. It will be saved to your Elementor account
3. On staging, access it from Elementor Library
4. Insert and customize as needed

### Manual Recreation:
If import fails, document the header structure:
1. Screenshot the local header
2. Note all widgets used
3. Document settings for each widget
4. Manually recreate on staging

This ensures you have the exact same header configuration.