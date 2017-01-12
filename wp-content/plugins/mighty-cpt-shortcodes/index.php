<?php

/* ----------------------------------------------------------------

	Plugin Name: Mighty - Post Type &amp; Shortcodes
	Plugin URI: http://meetmighty.com/support/
	Description: Extend theme functionality to include related custom post type (portfolio) and shortcodes.
	Version: 1.0
	Author: Mighty Themes
	Author URI: http://meetmighty.com
 
-----------------------------------------------------------------*/


if ( ! defined( 'ABSPATH' ) ) exit;


/* ----------------------------------------------------------------
   SHORTCODES (BUTTONS, TABS, ALERTS, TOGGLES, ETC)
-----------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ).'shortcodes.php' );


/* ----------------------------------------------------------------
   CUSTOM POST TYPE (PORTFOLIO
-----------------------------------------------------------------*/

require_once plugin_dir_path( __FILE__ ).'posttype-portfolio.php';