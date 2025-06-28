=== Migrate To Liquid Web & Nexcess ===
Contributors: blogvault, akshatc, liquidweb, nexcess
Tags: liquidweb, migration
Requires at least: 4.0
Tested up to: 6.8
Requires PHP: 5.6.0
Stable tag: 5.88
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Migrating your site(s) to the Liquid Web & Nexcess WordPress Hosting platform has never been so easy.

== Description ==

The Migrate to Liquid Web & Nexcess plugin makes it easy to migrate your site(s) to the [Nexcess Managed WordPress Hosting platform](https://www.liquidweb.com/products/managed-wordpress/). The plugin takes care of everything, from copying all the data to transforming config files and importing this to the Nexcess server. Start the migration, and the plugin will do all the heavy work!


== Installation ==

= There are two ways to install the plugin: =

1. Download the plugin through the ‘Plugins’ menu in your WordPress admin panel.
2. Upload the migrate-to-liquidweb folder to the /wp-content/plugins/ directory through sFTP.

After installing you need to activate the plugin.

== Frequently Asked Questions ==

= 1) How do I migrate a website? =

For detailed instructions on how to migrate your site over, please visit [How to Migrate your Site to Nexcess](https://www.nexcess.net/help/migrating-to-nexcess-with-managed-wordpress-and-managed-woocommerce-hosting/)

= 2) Why do you need my email? =

We require an email address to send you updates on the migration process, notify you of any errors that occur during the migration.

= 3) How long does it take to migrate a website? =

This can range anywhere from 30 minutes to several hours depending on the size of the website. On average, migrations to Liquid Web take about 1 hour.

= 4) Can I migrate a site from WordPress.com? =

Currently you can only migrate a self hosted WordPress installation, the plugin does not support migrating from WordPress.com.

= 5) What happens if I run into an error after the migration is complete? =

We are always wanting to assist and help out in any way that we can. If you encounter any type of issue please use the support section of our plugin.

= 6) Do I need to leave the window open while the migration is processing? =

No, that's the beauty of this plugin. It runs on a SAAS-based technology and a secure web address that runs everything in the background. Once you start the migration you can close the window at any time and come back to it later while it's still running, no need to wait for hours. You will also receive an email once the migration has completed.

= 7) Can this plugin be used to migrate to Liquid Web VPS plans? =

BlogVault is designed to be used to migrate to Managed WordPress and Managed WooCommerce plans on Nexcess and does not support WordPress sites running on VPS plans on Liquid Web.

== Changelog ==
= 5.88 =
* Tweak: Code Restructuring
* Tweak: Added support for PHP 8.4

= 5.56 =
* Better handling for Activate Redirect

= 5.25 =
* Bug fix get_admin_url

= 5.24 =
* SHA256 Support
* Stream Improvements

= 5.22 =
* Code Improvements
* Reduced Memory Footprint

= 5.16 =
* Bug Fixes

= 5.15 =
* Security Improvement: Upgraded Authentication

= 5.05 =
* Code Improvements for PHP 8.2 compatibility
* Site Health BugFix

= 4.97 =
* Code Improvements
* Sync Improvements
* Code Cleanup
* Bug Fixes

= 4.78 =
* Better handling for plugin, theme infos
* Sync Improvements

= 4.69 =
* Improved network call efficiency for site info callbacks.

= 4.68 =
* Removing use of constants for arrays for PHP 5.4 support.
* Post type fetch improvement.

= 4.65 =
* Robust handling of requests params.
* Callback wing versioning.

= 4.62 =
* MultiTable Sync in single callback functionality added.
* Improved host info
* Fixed services data fetch bug
* Fixed account listing bug in wp-admin

= 4.57 =
* Upgrading to New UI
* Added Support for Multi Table Callbacks

= 4.35 =
* Improved scanfiles and filelist api

= 4.31 =
* Updating Plugin Name

= 4.29 =
* Adding support for FTP for nexcess and imporved UI
* Fetching Mysql Version
* Robust data fetch APIs
* Core plugin changes
* Sanitizing incoming params

= 3.4 =
* Plugin branding fixes

= 3.2 =
* Updating account authentication struture

= 3.1 =
* Adding params validation
* Adding support for custom user tables

= 2.1 =
* Restructuring classes

= 1.88 =
* Callback improvements

= 1.86 =
* Updating tested upto 5.1

= 1.84 =
* Disable form on submit

= 1.82 =
* Updating tested upto 5.0

= 1.77 =
* Adding function_exists for getmyuid and get_current_user functions 

= 1.76 =
* Removing create_funtion for PHP 7.2 compatibility

= 1.72 =
* Adding Misc Callback

= 1.69 =
* Adding support for chunked base64 encoding

= 1.68 =
* Updating upload rows 

= 1.66 =
* Updating TOS and privacy policies

= 1.64 =
* Bug fixes for lp and fw

= 1.62 =
* SSL support in plugin for API calls
* Adding support for plugin branding

= 1.44 =
* Removed bv_manage_site
* Updated asym_key

= 1.41 =
* Better integrity checking
* Woo Commerce Dynamic sync support

= 1.40 =
* Manage sites straight from BlogVault dashboard

= 1.31 =
* Changing dynamic backups to be pull-based

= 1.30 =
* Using dbsig based authenticatation

= 1.22 =
* First release of Liquid Web Migration Plugin
