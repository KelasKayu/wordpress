=== Advanced Ads ===
Contributors: webzunft
Donate link:https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5RRRCEBGN3UT2
Tags: ads, ad, adsense, display, banner, advertisements, adverts, advert, monetization
Requires at least: WP 4.2, PHP 5.3
Tested up to: 4.3.1
Stable tag: 1.6.12
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Manage and optimize your ads in WordPress as easy as creating posts. Including support for AdSense, ad injection, ad planning and ad rotation.

== Description ==

Advanced Ads is a simple ad manager made by a publisher for publishers. Based on my experience delivering millions of ads per month I built this plugin as a powerful, but light weight solution to not only manage and serve ads in WordPress, but to test and optimize them as well.

[Full Feature List](https://wpadvancedads.com/features/).

= create and manage ads =

* create ads as easy as creating posts
* group ads to create ad rotations
* create drafts or ads only visible to logged in users
* set a date for when to publish the ad
* make internal notes about each ad

= ad types =

choose between different ad types that enable you to:

* insert code for ad and affiliate networks (e.g., Chitika, Amazon)
* dedicated support for Google AdSense
* display images and image banners
* use shortcodes (to also deliver ads from other ad plugins)
* create content rich ad with the tinymc editor
* flash files including a fallback – included in [Pro](https://wpadvancedads.com/add-ons/advanced-ads-pro/)

= display ads =

* auto inject ads (see _ad injection_ below)
* display ad in template files (with functions)
* display ad in post content (with shortcodes)
* widget to display ads in widget areas (sidebars)
* display grouped ads based on customizable ad weight
* use placements in your theme to change ads and groups in template files without coding
* disable all ads on individual single pages
* set start time and expiry date for ads
* display multiple ads from an ad group (ad blocks)
* define the order of ads from an ad group and allow default ads

= display conditions =

deliver ads based on conditions like

* individual posts, pages and other post type
* post type
* posts by category, tags, taxonomies
* archive pages by category, tags, taxonomies
* special page types like 404, attachment and front page
* hide ads on secondary queries (e.g. posts in sidebars)

global conditions

* disable all ads in the frontend (e.g. when your ad network breaks down)
* disable all ads on 404 pages (e.g. AdSense doesn’t allow that)
* disable all ads on non-singular pages with a single click
* disable all ads in secondary queries
* hide ads from bots and web crawlers

= visitor conditions =

display ads by conditions based on the visitor

* display or hide ads for mobile visitors
* display or hide ads for logged in visitors
* hide all ads from logged in users based on their role
* advanced visitor conditions: previous visited url (referrer), user capability, browser language, browser and device, url parameters included in [Pro](https://wpadvancedads.com/add-ons/advanced-ads-pro/)
* display ads by exact browser width with the [Responsive add-on](https://wpadvancedads.com/add-ons/responsive-ads/)

= ad injection | placements =

Placements to inject ads in pre-defined positions in your theme and content:

* ads after any given paragraph or headline in the post content
* ads at the top of the post content
* ads at the bottom of the post content
* ads before closing `</head>` tag
* ads into page footer
* many more with [add-ons](https://wpadvancedads.com/add-ons/)

= ad networks =

Advanced Ads is compatible with all ad networks and banners from affiliate programs like Google AdSense, Chitika, Clickbank, Amazon, etc.
You can also use it to add additional ad network tags into header or footer of your site without additional coding)

= Google AdSense =

* switch sizes of an ad
* switch between normal and responsive ads
* automatic limit 3 AdSense ads according to AdSense terms of service (can be disabled)
* insert Page-Level ads code globally
* assistant for exact sizes of responsive ads with the [Responsive add-on](https://wpadvancedads.com/add-ons/responsive-ads/)

= ad blocker =

* basic features to prevent ad blocks from being removed by AdBlock and co

= based on WordPress standards =

* integrated into WordPress using standards like custom post types, taxonomies and hooks
* easily customizable by any WordPress plugin developer

Learn more on the [plugin homepage](https://wpadvancedads.com).

Localizations: English, German, Dutch, Italian, Portuguese

> <strong>Add-Ons</strong>
>
> * [Advanced Ads Pro](https://wpadvancedads.com/add-ons/advanced-ads-pro/) – powerful tools for ad optimizations: cache-busting, more placements, etc.
> * [Tracking](https://wpadvancedads.com/add-ons/tracking/) – ad tracking and statistics
> * [Responsive Ads ](https://wpadvancedads.com/add-ons/responsive-ads/) – create mobile ads or ads for specific browser sizes
> * [Sticky Ads](https://wpadvancedads.com/sticky-ads/demo/) – increase click rates with fixed, sticky, and anchor ads
> * [PopUp and Layer Ads](https://wpadvancedads.com/add-ons/popup-and-layer-ads/) – display ads and other content in layers and popups
> * [Slider](https://wpadvancedads.com/add-ons/slider/) – create a simple slider from your ads

== Installation ==

How to install the plugin and get it working?

= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'advanced ads'
3. Click 'Install Now'
4. Activate Advanced Ads on the Plugin dashboard

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `advanced-ads.zip` from your computer
4. Click 'Install Now'
5. Activate Advanced Ads in the Plugin dashboard

= Using FTP =

1. Download `advanced-ads.zip`
2. Extract the `advanced-ads` directory to your computer
3. Upload the `advanced-ads` directory to the `/wp-content/plugins/` directory
4. Activate Advanced Ads in the Plugin dashboard

== Displaying Ads ==

You can use functions and shortcodes to display ads and ad groups.

The integers in this example are the IDs of the elements.

Use these shortcode to insert an ad or ad group into your post/page.

`[the_ad id="24"]`
`[the_ad_group id="5"]`

Use these functions to insert an ad or ad group into your template file.

`<?php the_ad(24); ?>`
`<?php the_ad_group(5); ?>`

In addition to directly displaying ads and groups you can define ad placements and assign either an ad or group to them.

`[the_ad_placement id="header-left"]`
`<?php the_ad_placement('header-left'); ?>`

== Frequently Asked Questions ==

= Is there a revenue share? =

There is no revenue share. Advanced Ads doesn’t alter your ad codes in a way that you earn less than you would directly including the ad code in your template.

== Screenshots ==

1. Create an ad almost like you would create an article or page.
2. Align the ad and set a margin to other elements
3. Choose from various conditions where and where not to display your ad.
4. Placements that let you inject ads anywhere into your site without coding (6 in Advanced Ads + 9 through add-ons)

== Changelog ==

= 1.6.12 =

* added filters to ad list
* display expired date in ad list
* display ad dates in ads list on group page
* hide unrelated columns in ad list
* fix saving adsense ad unit as non-superadmin
* error message for possible jQueryUI library conflicts
* fix widget_title override

= 1.6.11.1 =

* hotfix for widgets

= 1.6.11 =

* added icon to rich media editor to quickly add shortcodes
* added widget placement type
* added new column for ad planning
* TinyMCE is now working when ad type is switched to content ad
* enable license key deactivation
* hide unnecessary fields for image ads in media gallery
* loading jQuery ui styles only on Advanced Ads dashboard pages now
* fixed AdSense ad not retrieving values due to slashes
* fixed issue with licenses being activated twice

= 1.6.10.2 =

* warn on support page if ads are (partially) disabled
* inform users of Pro that AdSense limit does not work with cache-busting
* added hooks to extend content injection
* group slug hidden, because it currently serves no purpose
* fixed possible issues with content injection priority being lower than wpautop

= 1.6.10.1 =

* hotfix for empty id field

= 1.6.10 =

* added image ad type
* added option to set id and class attributes
* added check for conflicting plugins
* allow a higher number of visible ads in a group if more are existing

= 1.6.9.4 =

* last settings tab is now opened again after being saved
* exchanged text domain constants with string to match wp.org translate criteria

= 1.6.9.3 =

* order placement list by slug (which normally equals name)
* updated Autoptimize message. If you use the Autoptimize plugin then check out the Autoptimize-Support in [Advanced Ads Pro](https://wpadvancedads.com/add-ons/advanced-ads-pro/)
* unquote json request
* added missing advertisement image for AdBlock check
* added `advanced-ads-can-inject-into-content-` hook to check if individual placements can be injected into the content

= 1.6.9.2 =

* small adjustment to make cache-busting from [Advanced Ads Pro](https://wpadvancedads.com/add-ons/advanced-ads-pro/) compatible with [Sticky Ads](https://wpadvancedads.com/add-ons/sticky-ads/)

= 1.6.9.1 =

* fixed AdBlocker check on Support page
* display Advanced Ads notices on Support page

= 1.6.9 =

*features*

* add AdSense Page-Level ads code globally
* added hours and minutes to expiry date
* allow to set content priority to negative value
* added checks for main issues to the Support page
* added check for AdBlocker to all Advanced Ads pages in the dashboard

*fixes and maintenance*

* don’t display error message if not on archive page
* fixed issue with placement tooltips not showing up
* optimized content injection code
* added collapsed field for advanced placement options
* fix "support email sent" message showing all the time
* allow JSON encoded arguments for ajax callback
* make conditions case insensitive and binary safe
* renamed some classes belonging to AdSense module
* updated composer
* display warning on AdSense settings page if publisher ID is missing
* optimized support form layout
* added can-display check + filter for placements

= 1.6.8.3 =

* Hoe vet is dat!? – added Dutch translation
* fix selecting placement type in IE 11
* fix errors with content injection when mbstring extension is missing on the server

= 1.6.8.2 =

* added introduction page with first steps
* optimized error handling in placement form
* added option to remove the public id from widgets completely
* rewritten dismiss buttons of notices based on new WP standard

= 1.6.8.1 =

* added menu page to get support from within your dashboard
* stricter control of ad group archives not being public
* fix: content-injection requires more than one item per level for p-tags only
* updated German translation

= 1.6.8 =

* added option to change the prefix of ids and classes in the frontend to prevent widgets from being ad-blocked
* minor optimization to autocomplete feature of post display condition
* minor changes to align with changes in WordPress 4.3
* content-injection now detects wrappers around content up to the third level

= 1.6.7.1 =

* hotfix to prevent error message on empty content injection placements

= 1.6.7 =

*features*

* allow to inject ads into content starting from bottom
* prevent ad injection into lower-level paragraphs (e.g. into tables or containers)
* hide ad widget when the content is empty
* show post type or date when searching an individual post display condition

*fixes and maintenance*

* fix placement types images not showing up completely
* warn if any used placement type is missing
* added `advads-ad-allow-php` class to php-setting of plain text
* added `advanced-ads-activate-advanced-js` filter to allow add-ons to attach advanced js file without bothering the user
* updated German translation

= 1.6.6.1 =

* removed link to no-longer-existing manual page
* the option to close internal notices now also hides update messages
* fixed broken html on placement page

= 1.6.6 =

*features*

* added images to placement form ui
* allow to select item when creating a new placement
* always display placement form if no placement exists
* display shortcode and function for default placement type
* display notice if license keys are invalid, expired, or expire soon
* display error when AdSense Publisher ID is missing
* log error message in case regular expression is used wrong in visitor conditions

*fixes and under-the-hood*

* extended advanced js by move and fix_element function
* minified advanced js file
* added `advanced-ads-sanitize-settings` filter to sanitize plugin options
* added `advanced-ads-can-inject-into-content` filter
* added `advanced-ads-dashboard-screens` filter
* removed wrong output on Responsive settings
* store jquery ui css locally
* fixed saving empty placement options
* fixed free add-on notice showing up twice
* fixed error message in ads list when AdSense ad is empty
* fixed saving quick edit on ad list returning wrong columns

= 1.6.5 =

* removed "use strict" from js
* hide error message caused by third party code that uses post_updated_messages filter wrong
* hide licenses tab on non-main-blogs on multisites
* made plugin name untranslatable

= 1.6.4.1 =

* fixed free-add-on notice not closing forever

= 1.6.4 =

COOL: newsletter subscribers now receive 2 free add-ons

* changed newsletter subscription text
* display description of visitor conditions, if selected
* minor fix to display conditions ui
* updated German translation

= 1.6.3 =

* added visitor condition to check for logged in visitors
* fixed display conditions buttons
* updated German translation

= 1.6.2.1 =

* added missing files to repository

= 1.6.2 =

* display dashboard widget only to authors and higher roles
* include admin javascript file only on pages which need it
* no need to save AdSense publisher ID separately anymore
* added warning if AdSense publisher ID has wrong format
* list more than 10 ads from a group on the group overview page
* active settings and conditions are now blue
* clear object cache when saving an ad (thanks to pete-sch)

= 1.6.1 =

* fix secondary query condition (this was revered in 1.6)
* fix wrong constant displaying errors on add-on license page
* display license expire date for add-ons
* prevent accidental removal of license keys

= 1.6 =

THIS IS A MAJOR UPDATE, PLEASE HELP ME WITH YOUR BUG REPORTS

[Update post](https://wpadvancedads.com/advanced-ads-1-6)

Changes you can test:

* fixed ordered ad groups displaying ads with 0 ad weight
* fixed order of ad groups to deliver ad with highest weight first
* added option to allow ad injections on archive pages and outside the loop
* minor layout fix for update button after selecting rich content ad type
* fixed timestamp issues using GMT only now (might shift old ad expiry timestamps by timezone offset)
* load adsense script with every ad request

Changes under the hood:

* allow to cache groups when persistend object cache is available
* pass placement options to underlying ad/ group
* allow to exchange loaded ad ids for ajax callback
* fix override option for ad select
* wp query is now prepared as ad argument on selection
* moved query based display conditions to own module
* fixed ajax request parser
* actually serve placement on injection (and allow to use placement arguments)
* `advanced-ads-ajax-ad-select-init` action when ad is going to be selected by ajax call
* provide action when plugin was loaded

[Changelog Archive](http://wpadvancedads.com/codex/changelog-archive/)

== Upgrade Notice ==
