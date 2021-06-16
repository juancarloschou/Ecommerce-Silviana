=== PW WooCommerce Bulk Edit ===
Contributors: pimwick
Donate link: https://paypal.me/pimwick
Tags: woocommerce, products, utilities, tools, bulk, batch, mass, edit, bulk edit, multiple, sale price, sale, price, pimwick
Requires at least: 4.5
Tested up to: 4.9
Requires PHP: 5.6
Stable tag: 2.47
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

A powerful way to update your WooCommerce product catalog. Finally, no more tedious clicking through countless pages!

== Description ==

PW WooCommerce Bulk Edit is a powerful way to update your WooCommerce product catalog.

* **Live Preview** - See what you're about to change <strong>before</strong> you hit save. No more surprises!
* Inline editing in addition to bulk editing
* Safety net: you can undo changes before saving
* Edit <strong>Variations</strong> just as quickly as simple products
* Change prices by a specific amount or a percentage
* Search/replace text, append, prepend, or change capitalization
* Wildcard searches
* Keyboard navigation

> **The <a href="https://www.pimwick.com/pw-bulk-edit/">Pro version</a> includes even more great features:**
>
> * Edit so many more fields such as Categories, Sale Prices, Dates, and more! <a href="https://www.pimwick.com/pw-bulk-edit/">Click here to see the full list.</a>
> * Create new Variations
> * Modify selected Attributes
> * Bulk change the Sale Price based on Regular Price
> * Additional Filter options like "Is Empty" and "Is Not Empty"
> * Save and load filters
> * Use the power of Regular Expressions for searching and replacing text values
> * Support for other plugins like WooCommerce Brands and YITH Multi Vendor

**Your time is priceless**<br>
Finally, no more tedious clicking through countless pages! Make changes to your products at the same time.

**Product maintenance, evolved**<br>
Incredibly intuitive, make changes in batches or individually. Shortcut controls mimic working in a spreadsheet. Save your filters with the Pro version to make future updates a snap.

**Edit with confidence**<br>
Changes are visible and only saved when you are ready. Price drops are highlighted red for mistake-free editing.

**Relax!**<br>
You're in control of your WooCommerce product catalog with the power of PW WooCommerce Bulk Edit.

**This WooCommerce bulk editor lets you modify a variety of product fields including:**

* Product Name
* Product Description
* SKU
* Regular Price
* Tax Status
* Tax Class
* Manage Stock
* Stock Quantity
* Allow Backorders
* Stock Status
* Catalog Visibility
* Featured
* Status


== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/pw-bulk-edit` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Access the plugin using your WordPress menu under “Pimwick Plugins”

== Screenshots ==

1. Preview all changes before saving. Price drops highlight in red to give you confidence in your changes!
2. Inline editing, with keyboard navigation.
3. Complex filtering has been simplified to give you ultimate flexibility and control.
4. Powerful bulk editing for WooCommerce products.
5. Pro level features at a fraction of the price of the competition.
6. PW WooCommerce Bulk Edit is so easy to use!

== Changelog ==

= 2.47 =
* Updated plugin to be able to handle malformed prices when doing bulk operations.

= 2.46 =
* Variations titles now show the formatted name.

= 2.45 =
* Fixed possible issue sorting on variation attribute.

= 2.44 =
* Fixed issue where number fields may appear blank for editing instead of "n/a".

= 2.43 =
* Tweak to SQL query when saving products to prevent potential error on some systems.

= 2.42 =
* Tweaks to fix blank MySQL error.

= 2.41 =
* Moved the plugin init code out of the woocommerce_init hook and back into the constructor.

= 2.40 =
* Added .pot file for translation support.

= 2.39 =
* Added PW Bulk Edit menu under the WooCommerce Products menu to make it easier to find.

= 2.38 =
* Fixed issue where Stock Status column wouldn't appear unless you had Enable Stock Management enabled.

= 2.37 =
* Fixed sorting on the Featured column in WooCommerce 3.0 and later.

= 2.36 =
* Fixed issue setting Featured flag and Catalog Visibility in WooCommerce 3.0 and later.

= 2.35 =
* Fixed issue with the Featured flag. Fixed a possible exception when filtering results.

= 2.34 =
* Removed a warning about an undefined variable.

= 2.33 =
* Updated the admin menu icon style.

= 2.32 =
* Updated the admin menu icon.

= 2.31 =
* Display 0 in the results for prices that are not blank.

= 2.30 =
* Added a call to the update variation product hook while saving.

= 2.29 =
* Fixed small issue with single quotes not being encoded on the html editor.

= 2.28 =
* Fixed incompatibility with the WordPress automatic emoji converter.

= 2.27 =
* Fixed an issue with saving URLs in the Description and Short Description fields.

= 2.26 =
* Added the ability to edit the Menu Order field on products. Improved performance for large results sets.

= 2.25 =
* Removed the intro splash screen, it wasn't all that useful.

= 2.24 =
* Added help to the opening screen.

= 2.22 =
* Fixed issue with group filtering.

= 2.21 =
* Search and replace text now allows you to clear the entire string.

= 2.20 =
* Updated sync call to fix cache issue on some systems when changing prices.

= 2.19 =
* Support for PHP 5.2 and later.

= 2.18 =
* Support for PHP 5.2 and later.

= 2.17 =
* Improved database error reporting.

= 2.16 =
* Now both mysql and mysqli are supported.

= 2.15 =
* Now both mysql and mysqli are supported.

= 2.14 =
* Now both mysql and mysqli are supported.

= 2.13 =
* Revamped the error checking for product search queries.

= 2.12 =
* Removed the hook check for scripts.

= 2.11 =
* Verify the field keys before saving.

= 2.10 =
* Removed call to delete-cache after saving a product.

= 2.9 =
* Prevent currency thousands separators from being saved.

= 2.8 =
* Better support for international currencies.

= 2.7 =
* Fixed rounding issue on bulk percentage change for non-US currencies.

= 2.6 =
* Results now return much faster! Navigation improvements. Wrap cache delete inside try/catch.

= 2.5 =
* Results now return much faster! Plus, various small fixes.

= 2.4 =
* Adding missing files to SVN.

= 2.3 =
* Tweaks to the sticky header on the results table.

= 2.2 =
* Sticky header on the results table.

= 2.1 =
* Show/hide columns and save custom Views.

= 1.35 =
* Improved the user interface for selecting products. Hold the Shift key while clicking a checkbox to select a range of products.

= 1.34 =
* Fixed sorting of variations under the parent product. Allow changing Status for variations.

= 1.33 =
* Support for alternative decimal separators such as a comma. Fixed an issue sorting numeric fields.

= 1.32 =
* Made the add/remove filter UI more intuitive.

= 1.31 =
* Fixed issue with batch saving, improved error reporting.

= 1.30 =
* Update to improve compatibility with PHP 5.2

= 1.29 =
* Saving is now faster thanks to batching.

= 1.28 =
* Reduced server-side memory requirements.

= 1.27 =
* Added support for Multistore. Use configured currency rather than dollar. Various bug fixes.

= 1.26 =
* Report error detail if there is a problem while filtering.

= 1.25 =
* Report error detail if there is a problem while filtering.

= 1.24 =
* Added matched record count. Statuses pulled from system rather than hard-coded with default statuses.

= 1.23 =
* Changed how prices are saved internally.

= 1.22 =
* Added a status update to the save process.

= 1.21 =
* Fixed a potential error for larger queries.

= 1.20 =
* Fixed an issue that can be caused by filtering on multiple fields.

= 1.19 =
* Updated SQL statement to allow for larger result sets to be processed during filtering.

= 1.18 =
* Reduce extra calls to clearing transients.

= 1.17 =
* Increased timeout during save to prevent timeout errors when saving lots of products.

= 1.16 =
* Stock settings can be changed on variations now.

= 1.15 =
* Fixed a bug that could prevent Sale Price from being bulk changed.

= 1.14 =
* Added some hooks for other plugin authors to add functionality. Output SQL errors on filter to aid in troubleshooting.

= 1.11 =
* Added the ability to clear price fields.

= 1.9 =
* Allow whole number prices to be bulk updated to decimal values (for example, $4 can be changed to $4.50).

= 1.8 =
* Fixed an issue that prevented variations from updating due to caching.

= 1.7 =
* Stock fields no longer appear if you don't have the Manage Stock option enabled in WooCommerce.

= 1.6 =
* Added support for the WooCommerce Subscriptions plugin!
* Pro version includes support for the WooCommerce Brands plugin.
* Admin-level access is no longer required. Now works for any user with the Shop Manager role (or greater).
* Small bugfixes.

= 1.5 =
* Fixed an issue with Price not updating sometimes. Added social share buttons.

= 1.4 =
* Added Help Documentation.

= 1.3 =
* Small bugfixes.

= 1.2 =
* Fixed an issue that could cause the Currency or Text bulk edit dialog to be blank.

= 1.1 =
* Removed erroneous dollar sign on the bulk change number dialog.

= 1.0 =
* Initial version

== Upgrade Notice ==

= 2.47 =
* Updated plugin to be able to handle malformed prices when doing bulk operations.

= 2.46 =
* Variations titles now show the formatted name.

= 2.45 =
* Fixed possible issue sorting on variation attribute.

= 2.44 =
* Fixed issue where number fields may appear blank for editing instead of "n/a".

= 2.43 =
* Tweak to SQL query when saving products to prevent potential error on some systems.

= 2.42 =
* Tweaks to fix blank MySQL error.

= 2.41 =
* Moved the plugin init code out of the woocommerce_init hook and back into the constructor.

= 2.40 =
* Added .pot file for translation support.

= 2.39 =
* Added PW Bulk Edit menu under the WooCommerce Products menu to make it easier to find.

= 2.38 =
* Fixed issue where Stock Status column wouldn't appear unless you had Enable Stock Management enabled.

= 2.37 =
* Fixed sorting on the Featured column in WooCommerce 3.0 and later.

= 2.36 =
* Fixed issue setting Featured flag and Catalog Visibility in WooCommerce 3.0 and later.

= 2.35 =
* Fixed issue with the Featured flag. Fixed a possible exception when filtering results.

= 2.34 =
* Removed a warning about an undefined variable.

= 2.33 =
* Updated the admin menu icon style.

= 2.32 =
* Updated the admin menu icon.

= 2.31 =
* Display 0 in the results for prices that are not blank.

= 2.30 =
* Added a call to the update variation product hook while saving.

= 2.29 =
* Fixed small issue with single quotes not being encoded on the html editor.

= 2.28 =
* Fixed incompatibility with the WordPress automatic emoji converter.

= 2.27 =
* Fixed an issue with saving URLs in the Description and Short Description fields.

= 2.26 =
* Added the ability to edit the Menu Order field on products. Improved performance for large results sets.

= 2.25 =
* Removed the intro splash screen, it wasn't all that useful.

= 2.24 =
* Added help to the opening screen.

= 2.22 =
* Fixed issue with group filtering.

= 2.21 =
* Search and replace text now allows you to clear the entire string.

= 2.20 =
* Updated sync call to fix cache issue on some systems when changing prices.

= 2.19 =
* Support for PHP 5.2 and later.

= 2.18 =
* Support for PHP 5.2 and later.

= 2.17 =
* Improved database error reporting.

= 2.16 =
* Now both mysql and mysqli are supported.

= 2.15 =
* Now both mysql and mysqli are supported.

= 2.14 =
* Now both mysql and mysqli are supported.

= 2.13 =
* Revamped the error checking for product search queries.

= 2.12 =
* Removed the hook check for scripts.

= 2.11 =
* Verify the field keys before saving.

= 2.10 =
* Removed call to delete-cache after saving a product.

= 2.9 =
* Prevent currency thousands separators from being saved.

= 2.8 =
* Better support for international currencies.

= 2.7 =
* Fixed rounding issue on bulk percentage change for non-US currencies.

= 2.6 =
* Results now return much faster! Navigation improvements. Wrap cache delete inside try/catch.

= 2.5 =
* Results now return much faster! Plus, various small fixes.

= 2.4 =
* Adding missing files to SVN.

= 2.3 =
* Tweaks to the sticky header on the results table.

= 2.2 =
* Sticky header on the results table.

= 2.1 =
* Show/hide columns and save custom Views.

= 1.35 =
* Improved the user interface for selecting products. Hold the Shift key while clicking a checkbox to select a range of products.

= 1.34 =
* Fixed sorting of variations under the parent product. Allow changing Status for variations.

= 1.33 =
* Support for alternative decimal separators such as a comma. Fixed an issue sorting numeric fields.

= 1.32 =
* Made the add/remove filter UI more intuitive.

= 1.31 =
* Fixed issue with batch saving, improved error reporting.

= 1.30 =
* Update to improve compatibility with PHP 5.2

= 1.29 =
* Saving is now faster thanks to batching.

= 1.28 =
* Reduced server-side memory requirements.

= 1.27 =
* Added support for Multistore. Use configured currency rather than dollar. Various bug fixes.

= 1.26 =
* Report error detail if there is a problem while filtering.

= 1.25 =
* Report error detail if there is a problem while filtering.

= 1.24 =
* Added matched record count. Statuses pulled from system rather than hard-coded with default statuses.

= 1.23 =
* Changed how prices are saved internally.

= 1.22 =
* Added a status update to the save process.

= 1.21 =
* Fixed a potential error for larger queries.

= 1.20 =
* Fixed an issue that can be caused by filtering on multiple fields.

= 1.19 =
* Updated SQL statement to allow for larger result sets to be processed during filtering.

= 1.18 =
* Reduce extra calls to clearing transients.

= 1.17 =
* Increased timeout during save to prevent timeout errors when saving lots of products.

= 1.16 =
* Stock settings can be changed on variations now.

= 1.15 =
* Fixed a bug that could prevent Sale Price from being bulk changed.

= 1.14 =
* Added some hooks for other plugin authors to add functionality. Output SQL errors on filter to aid in troubleshooting.

= 1.11 =
* Added the ability to clear price fields.

= 1.9 =
* Allow whole number prices to be bulk updated to decimal values (for example, $4 can be changed to $4.50).

= 1.8 =
* Fixed an issue that prevented variations from updating due to caching.

= 1.7 =
* Stock fields no longer appear if you don't have the Manage Stock option enabled in WooCommerce.

= 1.6 =
* Added support for the WooCommerce Subscriptions plugin!
* Pro version includes support for the WooCommerce Brands plugin.
* Admin-level access is no longer required. Now works for any user with the Shop Manager role (or greater).
* Small bugfixes.

= 1.5 =
* Fixed an issue with Price not updating sometimes. Added social share buttons.

= 1.4 =
* Added Help Documentation.

= 1.3 =
* Small bugfixes.

= 1.2 =
* Fixed an issue that could cause the Currency or Text bulk edit dialog to be blank.

= 1.0 =
Initial version

== Frequently Asked Questions ==

**What is included with the Pro version?**

* The <a href="https://pimwick.com/pw-bulk-edit">Pro version</a> includes even more great features:
* Edit so many more fields such as Categories, Sale Prices, Dates, and more! <a href="https://pimwick.com/pw-bulk-edit">Click here to see the full list.</a>
* Create new Variations
* Modify selected Attributes
* Bulk change the Sale Price based on Regular Price
* Additional Filter options like "Is Empty" and "Is Not Empty"
* Save and load filters
* Support for other plugins like WooCommerce Brands
* <a href="https://pimwick.com/pw-bulk-edit"><strong>Learn more</strong></a>

**Where can I get the Pro version?**

* Buy the Pro Version here: <a href="https://pimwick.com/pw-bulk-edit">https://www.pimwick.com/pw-bulk-edit/</a>
