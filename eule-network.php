<?php
/*
Plugin Name:  Die Eule Netzwerk-Plugin
Plugin URI:   https://eulemagazin.de/
Description:  Zeige die neuesten Artikel von eulemagazin.de auf deiner Seite an.
Version:      1.0.1
Author:       Max Melzer
Author URI:   http://moehrenzahn.de/en/about
License:      GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  eule-network
Domain Path:  /languages
*/
if (!defined('ABSPATH')) {
    die('Invalid access');
};

require_once('vendor/autoload.php');
require_once('src/Autoloader.php');
spl_autoload_register('EuleNetwork\Autoloader::load');

new \EuleNetwork\Plugin();
