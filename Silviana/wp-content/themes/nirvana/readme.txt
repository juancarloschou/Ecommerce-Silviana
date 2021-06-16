=============
Nirvana WordPress Theme
Copyright 2014-17 Cryout Creations

Author: Cryout Creations
Requires at least: 4.0
Tested up to: 4.8.0
Stable tag: 1.4.2.2
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Donate link: https://www.cryoutcreations.eu/donate/

Imagine a land of infinite beauty and overwhelming magnificence. Imagine seas of freedom and oceans of peace joining together with splashing waves of pure love.
Imagine high mountains of hope, hills of reason and deep valleys of knowledge � all covered with dense forests of complete calm. In this mystic land, under a spotless sky of clarity and a bright, cleansing sun you will find Nirvana. The search is finally over; you can now rest, relax and take a deep breath.

Nirvana will do the rest with a framework of over 200 settings in a user-friendly interface, a very effective responsive design, easy to use typography equipped with Google fonts, all post formats, 8 page templates (magazine and blog layouts included), 12 widget areas and a presentation page complete with an editable slider and columns.

Nirvana also gives you over 40 socials to choose from, is translation and multi-language ready and has full RTL support. All you have to do is imagine it and with Nirvana it will come true.

== License ==

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see http://www.gnu.org/copyleft/gpl.html


== Third Party Resources ==

Nirvana WordPress Theme bundles the following third-party resources:

Nivo Slider, Copyright 2010 Gilbert Pellegrom
Nivo Slider is licensed under the terms of the MIT license
Source: http://dev7studios.com/nivo-slider

FitVids, Copyright 2011 Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
FitVids is licensed under the terms of the WTFPLlicense
Source: http://fitvidsjs.com/

TGM Plugin Activation, Copyright Thomas Griffin
Licensed under the terms of the GNU GPL v2-or-later license
Source: http://tgmpluginactivation.com/

== Bundled Fonts ==

The extra fonts included with the theme are also under GPLv3 compatible licenses:

Source Sans Pro, Copyright 2010, 2012 Paul D. Hunt
Source Sans Pro is licensed under the SIL Open Font License, Version 1.1.
Source: https://www.google.com/fonts/specimen/Source+Sans+Pro

Ubuntu, Copyright 2010 Dalton Maag
Ubuntu is licensed under the SIL Open Font License, Version 1.0.
Source: http://www.google.com/fonts/specimen/Ubuntu

Open Sans, Copyright Steve Matteson
Open Sans is licensed under the Apache License v2.00
Source: https://www.google.com/fonts/specimen/Open+Sans

Droid Sans, Copyright Steve Matteson
Droid Sans is licensed under the Apache License v2.00
Source: https://www.google.com/fonts/specimen/Droid+Sans

Oswald, Copyright 2011-2012 Vernon Adams
Oswald is licensed under the SIL Open Font License, Version 1.1
Source: https://www.google.com/fonts/specimen/Oswald

Yanone Kaffeesatz, Copyright 2010, Jan Gerner
Yanone Kaffeesatz is licensed under the SIL Open Font License, Version 1.1
Source: https://www.google.com/fonts/specimen/Yanone+Kaffeesatz

Elusive-Icons Webfont, Copyright 2013, Aristeides Stathopoulos
Elusive-Icons Webfont is licensed under the SIL Open Font License, Version 1.1
Source: http://shoestrap.org/downloads/elusive-icons-webfont/

Font Awesome, Copyright Dave Gandy
Font Awesome is dual-licensed under the terms of the SIL Open Font License, Version 1.1, and the MIT license
Source: http://fortawesome.github.io/Font-Awesome/

"Tablet Ipad screen internet browser online" image, Copyright 2013 realworkhard
"Tablet Ipad screen internet browser online" is licensed under the terms of the Public Domain CC0 License
Source: http://pixabay.com/en/tablet-ipad-screen-internet-184888/

All other images bundled with the theme (used in the demo presentation page and admin section, as well as the social icons) are created by Cryout Creations and released with the theme under GPLv3 as well.


== Initial Translators ==

Chinese - jimbay
Croatian - Davor
Czech - Michal Jur�nek
Dutch - John Mulder
French - skiitrix
German - ralflexis
Hebrew - Udi Burg
Hungarian - Tam�s
Italian - Andrew
Japanese - Yuka Kachi
Polish - Marcin Szafran
Russian - Alexander
Spanish - Javier Iglesia
Swedish - Bandit
Turkish - Arvanitis


== Changelog ==

= 1.4.2.2 =
* improved editor styling (form elements and special tags)
* fixed columns from posts listed by IDs limited by WordPress' global post count limit 
* removed social scripts in the theme's admin page and replaced with simple social profile links

= 1.4.2.1 = 
* Fixed a typo that broke the theme's presentation page

= 1.4.2 =
* Fixed missing left and right padding on presentation page elements on Safari/Ipad
* Fixed 'continue reading button' on full posts using <!--more--> tag missing right arrow
* Renamed global $fonts and $socialNetworks variables to use 'nirvana_' prefix
* Made socials styling more specific to avoid overlapping with plugins
* Made 'sidebar empty' messages visible only to users with permissions to manage widgets
* Fixed TinyMCE editor error on WordPress 4.8
* Revamped TinyMCE editor styling to match the theme's appearance settings (this feature is enabled by default but can be disabled under Misc settings)
* Completely cleaned up extracted options variables usage inside functions 

= 1.4.1 =
* Fixed parse error in sanitize.php on PHP 5.3 and older
* Fixed attachment page malfunctioning since 1.4.0
* Fixed typo in settings page slider section
* Fixed above and below content widget areas not working since 1.4.0

= 1.4.0 =
* Added support for external sliders in the presentation page using shortcodes
* Added Github and TripAdvisor social icons
* Added styling to disable Chrome's built-in blue border on focused form elements
* Added autofocus to the menus search input on click
* Added explicit support for WooCommerce 3.0 new product gallery
* Renamed .mobile body class to .nimobile to avoid styling overlap with plugins
* Renamed all icon-* classes to crycon-* to avoid styling overlapping with plugins
* Fixed menu items displayed in wrong order on RTL
* Fixed using HTML excerpt option disabling continue reading button
* Fixed continue reading button missing on posts with manual excerpts on the Presentation Page
* Fixed checkbox options cannot be disabled when they default to enabled
* Improved formatting and cleaned up of the sanitization code
* Deprecated HTML excerpt option and disabled it on new theme installs
* Moved main presentation page code to function
* Removed the use of individual global options variables and adjusted all functions to use the global options array instead
* Cleaned up theme-loop.php; renamed several functions for consistency:
nirvana_excerpt_length_words()  -> nirvana_excerpt_trim_words()
nirvana_excerpt_length_chars()  -> nirvana_excerpt_trim_chars()
nirvana_custom_excerpt_more()   -> nirvana_excerpt_morelink()
nirvana_continue_reading_link() -> nirvana_excerpt_continuereading_link()
nirvana_auto_excerpt_more()     -> nirvana_excerpt_dots()
nirvana_trim_excerpt()          -> nirvana_excerpt_html()
nirvana_posted_on()             -> nirvana_meta_before()
nirvana_posted_after()          -> nirvana_meta_after()
nirvana_author_on()             -> nirvana_meta_author()

= 1.3.3 =
* Hid mobile menu placeholder when menu visibility disabled on Presentation Page
* Fixed comments line height.
* Fixed automatically generated menu dropdowns inaccessible on mobile devices with WordPress 4.7+
* Fixed social icons URL double sanitization (breaking special cases)
* Improved menu styling to fix double arrow and extra padding when menu-related plugins are used
* Added 'nirvana_pp_nosticky' filter for sticky posts inclusion in Presentation Page posts list

= 1.3.2 =
* Added filter for slider 'read more' button text
* Fixed font names with spaces on Safari limitation
* Added Fitvids on/off option for compatibility
* Fixed parse error in attachment.php
* Re-bundled it_IT, de_DE, ru_RU, tr_TR translations due to WordPress' 90% completeness requirement
* Renamed nirvana.po to nirvana.pot

= 1.3.1 =
* Fixed home page going full width (bug introduced in 1.3.0)
* Fixed extra top margin on pages (bug also introduced in 1.3.0)
* Added more specific declaration to comment reply buttons (for increased compatibility with bbPress)

= 1.3.0 =
* Escaped all theme options output
* Escaped all URLs in theme with esc_url()
* Escaped all get_bloginfo() instances
* Updated code to use the_title_attribute() inside HTML attributes
* Changed responsive breakpoint for the columns from 1280px to 1024px
* Merged frontpage CSS into the main CSS

= 1.2.9 =
* Improved comments display function to take languages with multiple plural forms into account
* Fixed search input aspect on Safari
* Updated translations

= 1.2.8 =
* Removed input[type="file"] styling
* Added implicit label and HTML5 'button' input to search in searchform.php (accessibility)
* Switched to using searchform.php in the footer menu search
* Added screen reader text for breadcrumbs home icon (accessibility)
* Fixed empty translation strings and updated translation files

= 1.2.7 =
* Fixed RTL stylesheet missing in child themes
* Converted presentation page code to function blocks
* Updated TGM-PA
* Fixed columns caption on certain versions of Safari
* Cleaned up compatibility CSS for old browsers and '!important' usage

= 1.2.6 =
* Added support for presentation page columns without images (at least one of image, title or text needs to be set)
* Moved Magazine Layout option under Layout section for better consistency
* Changed 'More Posts' button label from theme text to configurable option in the settings page (and included in wpml-config.xml list of strings)
* Added ''nirvana_columnreadmore'' field to wpml-config.xml
* Updated theme URL for new site
* Updated theme news feed URL for new site structure
* Removed bundled es_ES, nl_NL, he_IL, ja, ro_RO, it_IT, de_DE, ru_RU, tr_TR translations in favor of WordPress Translate ones

= 1.2.5 =
* Added 'footer-widgets' theme tag
* Removed unused third parameter $post_image_id from nirvana_thumbnail_link()
* Removed hidden leftover meta separator
* Removed unused CSS related to fonts section
* Fixed magazine layout option overlapping presentation page posts per columns option
* Added site title value to as header logo alt/title attributes
* Improved meta bar styling conditionality
* Fixed topbar overlapped by admin bar when static; converted custom styling to rely on body classes; disabled fixed position on <600px (like the WP admin bar)
* Fixed top menu search box missing some styling since 1.2.4
* Removed box shadow on submit/reset inputs
* Improved forms padding and form elements font sizing

= 1.2.4 =
* Added author role meta to improve microformats
* Added time updated and published meta to improve microformats
* Added new WordPress.org theme tags (and removed deprecated ones)
* Improved breadcrumbs function, added post formats support
* Fixed #content dd/dt font size and line height
* Optimized CSS layout and fixed several typos
* Removed duplicate title attribute on featured images anchors
* Updated all instances of the search form (searchform.php, menu hooks) and replaced IDs with classes

= 1.2.3 =
* Added theme version to style and script enqueues to correct some caching issues
* Fixed menu center align issues with multi-line menus
* Changed social icon links to no longer be nofollow
* Clarified presentation page usage notice when static page is set
* Fixed WordPress 4.4.1 issue with plugin/theme notifications being moved in the Layout settings section
* Fixed missing sticky post styling on Blog page template
* Clarified customizer link info to indicate settings page is only available when theme is active
* Cleaned up !important usage in responsive styling (to ease customizations)
* Fixed header site title to not use H1 tag when homepage is static

= 1.2.2 =
* Fixed typos in TGM inclusion causing code collisions with other extensions also using TGM
* Fixed main menu centered option interfering with the mobile menu
* Added Swedish translation

= 1.2.1 =
* Fixed typo loading the wrong textdomain causing translations to stop working

= 1.2 =
* REMOVED THE THEME SETTINGS AND ADDED SUPPORT FOR THE SEPARATE THEME SETTINGS PLUGIN
* Integrated TGM to recommend the theme settings plugin
* Fixed settings page to handle changed H3 to H2 headings in Wordpress 4.4 RC1
* Changed presentation page to be disabled by default (in lack of theme options on fresh install without plugin)
* Restored missing above and below content widged areas from page templates
* Removed leftover footer menu margin
* Fixed main menu centered option messing sub-menu items alignment on IE
* Fixed main menu search box vertical alignment on centered menu
* Fixed presentation-page styling only applied when homepage is actually the presentation page (corrects boxed layout issues with static pages)
* Fixed some font families not selectable in theme settings
* Fixed sub-menu arrows on RTL
* Fixed character-count excerpts not working with multibyte (UTF-8) strings
* Rewrote readme file and merged changelog into readme

= 1.1.3 =
* Fixed centred multi-line menu change in 1.1.1 breaking submenu alignment
* Fixed slider title & text font size configurable options overlapped by default styling
* Fixed slider read more button locked to fixed size by styling; font size is now in sync with slider text size
* Added arrow indicators for sub-elements on submenu items
* Fixed magazine layout alignment on RTL
* Fixed sub-sub menu alignment for RTL
* Added Chinese translation
* Fixed category icon visible for pages in search results
* Corrected two untranslatable strings
* Fixed column image links (added in 1.1) not respecting "open in new window" option
* Fixed presentation page slider/column image alt attribute HTML handling
* Fixed font prototype function wrongfully localizing "general" font value
* Fixed an invalid translation string causing an erroneous text-domain in 1.1.2
* Added theme information and settings page link in the customizer

= 1.1.2 =
* Fixed search double slash causing issues on some servers
* Fixed PHP notice related to browseragent check
* Fixed PHP notice about old widget constructors being deprecated in WP 4.3
* Updated Hungarian translation

= 1.1.1 =
* Fixed ternary operator usage for PHP <5.3 (introduced in 1.1)
* Fixed centre main menu alignment functionality for multi-line menus
* Added Polish translation

= 1.1 =
* Preliminary WPML / Polylang support for custom theme options - presentation page content and socials (currently only tested on Polylang)
* Merged WooCommerce compatibility code and styling
* Fixed presentation page columns content layout on IE9
* Fixed typo in presentation page informative no posts test (linking to Tempera)
* Fixed header widget overlapping logo/title when no header image is used
* Fixed sup/sub styling resets
* Added slide title to alt attribute
* Added presentation page column title to image alt attribute
* Made presentation page column images clickable links
* Added Hebrew translation
* Fixed presentation page columns wrong float on RTL
* Improved colour control on presentation page columns (the hover colour is now configurable together with the slider caption background)
* Fixed leftover constant use in general theme setup
* Fixed a:active colour setup making some text vanish on click
* Fixed an undefined variable notice on the frontpage

= 1.0.6 =
* Added centred text option for the presentation page slider captions
* One itsy bitsy Google fonts fix (yet again)
* Moved JavaScript scripts from wp_head to wp_footer hook to remove blocking scripts
* Improved left/right padding handling on mobile devices when site set to boxed layout
* Improved headings font size option to apply to presentation page titles as well
* Fixed featured image as header image full width limitation
* Fixed (again) front columns layout when using custom widgets
* Improved presentation page columns responsiveness to exclude hover-capable devices
* Fixed presentation page columns padding on mobile devices
* Fixed slides count limitation when using custom posts by ID
* Fixed using cryout column widget outside the dedicated cryout columns area causing fatal error (introduced in 1.0.5) and made handler function pluggable via child themes
* Improved presentation columns to make them usable in all widget areas, not just the presentation page (with some responsiveness limitations)
* Fixed custom footer text not handling shortcodes
* Fixed category page with intro to follow category excerpt option, not homepage excerpt option
* Fixed input/textarea line-height reset causing visibility issues on Chrome and Internet Explorer
* Fixes RTL styling issue causing horizontal scrollbar
* Added Italian translation

= 1.0.5 =
* Fixed layout/image border option non-clickable on IE 11
* Fixed header container responsiveness
* Improved active links styling so it's easier replaceable via custom CSS
* Fixed wrong textdomain occurrence (thanks to Szemcse)
* Replaced the Presentation Page�s "Nothing Found" message when there are no published posts with an explanatory placeholder message
* Fixed disappearing/too small images inside tables issue on Chrome
* Removed baseline vertical alignment from styling reset to correct some weird alignment layouts
* Added Spanish translation
* Improved two somewhat untranslatable strings (that used esc_attr__() )
* Fixed an untranslatable string (thanks to seemannKP)

= 1.0.4 =
* Fixed settings page subsections not opening in some cases
* Updated Hungarian translation
* Added Japanese translation
* Added Turkish translation

= 1.0.3 =
* Added our social links to the settings page
* Added search bars to the remaining (main and footer) menus
* Fixed typos in the Google fonts cleanup function calls
* Fixed current open theme settings section not being saved any more after jQUery UI update in WP 4.1
* Removed extra padding after the presentation page slider
* Added text domain to style.css
* Added unminified version of Nivo Slider JS

= 1.0.2 =
* Fixed nirvana_content_nav() function missing its name
* Added RECOMMENDED add_theme_support( "title-tag" )
* Added some missing commas in styles.css (pointed out by Bill)

= 1.0.1 =
* Fixed skew missing on photo frame columns
* Fixed wrong order of tags on widget titles (pointed out by Michael)
* Replaced alt tag with title in thumbnail anchor function
* Fixed breadcrumbs having double anchor tag on the home icon
* Fixed HTML excerpts and added support for shortcodes (reported by Scott)
* Corrected first post image selector function to failsafe to standard image size when custom thumbnail is not available
* Fixed Google font names issue introduced in 0.9.9.9 (caused by extra output sanitization)
* Fixed max-width leftovers in editor-style.css (among other things making large images appear distorted in the editor)
* Added Hungarian translation
* Added Croatian translation
* Rearranged presentation page columns HTML to make it easier to be replaced via child themes
* Fixed ol double digits numbering not fitting into view
* Added standard HTML markup on presentation page static content
* Fixed 2 typos in settings page
* Revamped script/styles injection detection to protect the theme's settings page from getting broken by badly written plugins

= 1.0.0 =
* Added colour scheme support and 12 preset colour schemes
* Added new options for the slider: Title font size / Text font size (uppercase settings as well)
* Added new option � Slider Excerpt size
* Added new option � Posts per row for the presentation page posts
* Added new Option � Remove hover effect on columns
* Moved �Content Margins� setting field from Graphics Settings to Layout Settings
* Fixed Content Margins � Padding setting not working
* Fixed header widget responsiveness when no header image is used
* Fixed header wp_title() call (left the site title-less)
* Fixed hardcoded breadcrumbs background colour
* Fixed Presentation Page Titles colour option not working
* Fixed search icon in top bar so that it uses the same colour as the top bar menu
* Removed topbar shadow (a leftover from early development)
* Updated translation files

= 0.9.9.11 =
* Fixed Google fonts merging issue when subsets are used (introduced in 0.9.9.10)
* (Absolutely positively definitely) fixed Ajax "Load More" posts button (again� one more time)

= 0.9.9.10 =
* Fixed "array to string conversion" notices
* Fixed presentation page's 'More Posts' button affecting blog pages
* Made all CSS minify-able (should now support all caching plugins that perform resource minification)
* Fixed missing widget Google font support
* (Properly) optimized Google font calls

= 0.9.9.9 =
* Fixed slider �read more� button going full width on mobiles
* Fixed Ajax load more button breaking media gallery pagination functionality
* Fixed comment bubble appear to be link when in fact it isn�t
* Fixed a weird save issue affecting only some servers caused by an apostrophe in the sample in custom footer text
* Implemented escape output in custom_styles (per WordPress request)
* Fixed #forbottom override on presentation page (for boxed layout and responsiveness disabled)
* Made JS minify-able (should now support all caching plugins that perform resource minification)
* Slider excerpt is not limited to half the configurable post excerpt word count
* Corrected title tag code to adhere to latest WordPress rules

= 0.9.9 =
* Added customizer callback sanitization
* Edited theme settings news (now include only title and date)
* Updated PayPal donate button code
* Added header widget size option
* Corrected theme settings sanitization failsafe

= 0.9.8 =
* Fixed header responsiveness for the boxed layout
* Fixed Presentation Page incompatibility with some plugins
* Fixed settings page compatibility issues
* Fixed 'Load more' button on the Presentation Page
* Fixed show/hide setting for the search in topbar
* Added layout and columns text to the style.css description

= 0.9.7 =
* Fixed responsiveness disable setting not taking effect
* Added a new setting: 'Duality' that changes the site's format wide / boxed
* Fixed 'READ MORE' button disappearing in slider
* Fixed slider caption text inline background padding for FireFox
* Fixed top menu search icon position and size

= 0.9.6 =
* Fixed columns responsiveness on res <800px
* Added a wp.media check for the media uploader on the settings page
* Fixed post excerpt number of characters  not taking effect on the Presentation Page (the bug also added another Continue Reading button)
* Removed 'first click' alert on mobile
* Added category check for breadcrumbs categories
* Removed some leftover code from theme-meta.php

= 0.9.5.1 =
* Fixed styles enqueue order bug created in 0.9.5

= 0.9.5 =
* Removed conditional check for 'wp_enqueue_media'
* Removed all 'wp_register_style' and 'wp_register_script' functions.
* Enqueued all admin scripts and styles via 'admin_enqueue_scripts'
* Added a changelog.txt file

= 0.9.4 =
* Adjusted columns (photo frames, padding, margins)
* Fixed multi-line widget titles
* Removed leftover presentation page 'hide background' option
* Default option for columns is now frameless
* Fixed 'more posts' button border on IE
* Fixed sidebar 'dasboard' typo

= 0.9.3 =
* Edited 'readme.txt' for new and improved copyright declarations
* Removed Bebas Neue font (copyright incompatibility)
* Removed hardcoded Javascript found in frontpage.php - moved it to custom-styles.php
* Replaced 'dirname ( __FILE__ )' with 'get_template_directory()'

= 0.9.2 =
* Fixed header image responsiveness for full width / normal width
* Fixed header image responsiveness
* Removed leftovers from defaults.php
* Added Russian translation

= 0.9.1 =
* Fixed menu alignment
* Fixed header image not starting at top:0
* Fixed topbar height when set to 'fixed'
* Fixed topbar on mobile res below 480px
* Fixed front columns layout when using custom widgets
* Fixed Presentation Page columns on mobile using custom widgets (nth-child replaced with nth-of-type)

= 0.9 =
* Initial theme release
