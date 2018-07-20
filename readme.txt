=== Die Eule Vernetzt ===
Contributors: maxmelzer
Tags: church, rss, news
Requires at least: 4.9
Tested up to: 4.9.7
Stable tag: 1.0.0
Requires PHP: 5.6
Text Domain: eule-network
Domain Path: /languages
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Display current Posts from eulemagazin.de as a widget or shortcode on your WordPress page.

== Description ==

This plugin uses the official eulemagazin.de RSS-Feed to fetch the two most recent posts of the german online magazine "Die Eule" and display them on your Worpress-Page.

You can use this plugin if your page is part of the network "Die Eule #vernetzt".

You can include the posts on your page

- via *widget*,
- via the *shortcode* `[eule]`
- or directly in a template file via `<?php echo do_shortcode('[eule]'); ?>`.

This plugin uses the [SimplePie parser](http://simplepie.org) to parse the "Die Eule" RSS feed.

== Installation ==

This section explains the plugin installation

1. Put the plugin files into the directory `/wp-content/plugins/eule-network` in your Wordpress installation, or install the plugin via the WordPress plugin directory.
2. Activate the plugin in the 'plugins' section in the WordPress dashboard.
3. There is no third step.

== Changelog ==

= 1.0.0 =
* Initial release.
