<?php

/* ----------------------------------------------------------------
   ENQUEUE DEPENDANT FILES
-----------------------------------------------------------------*/

if ( !function_exists( 'mighty_shortcodes_enqueue' ) ) {

	function mighty_shortcodes_enqueue() {

		if ( ! is_admin() ) {

			// Register
			wp_enqueue_script( 'mighty-shortcodes-js', plugin_dir_url( __FILE__ ) . 'js/jquery.shortcodes.js', 'jquery', '1.0', TRUE );

			// Enqueue
			wp_enqueue_script( 'mighty-shortcodes-js' );

			// Stylsheet
			wp_enqueue_style( 'mighty-shortcodes-css', plugin_dir_url( __FILE__ ) . 'css/shortcodes.css', FALSE, '1.0' );

		}

	}

}

add_action( 'init', 'mighty_shortcodes_enqueue' );


/* ----------------------------------------------------------------
   BUTTONS
-----------------------------------------------------------------*/

function shortcode_button($attr, $value) {
	$attr = shortcode_atts(array('color' => '', 'link' => '', 'target' => '_self'), $attr);
	return sprintf('<a href="%s" target="%s" class="btn %s">%s</a>', $attr["link"], $attr["target"], $attr["color"], $value);
}	

add_shortcode('button', 'shortcode_button');


/* ----------------------------------------------------------------
   ALERTS
-----------------------------------------------------------------*/

function shortcode_alert($attr, $value) {
	$attr = shortcode_atts(array('color' => ''), $attr);
	return sprintf('<div class="alert %s"><div class="content">%s</div><i class="close fa fa-times"></i></div>', $attr["color"], $value);
}

add_shortcode('alert', 'shortcode_alert');


/* ----------------------------------------------------------------
   TOGGLES
-----------------------------------------------------------------*/

function shortcode_toggle($attr, $value) {
	$attr = shortcode_atts(array('state' => 'expanded', 'title' => ''), $attr);
	return sprintf('<div class="toggle %s">
						<div class="head">
							<div class="title">%s</div>
							<i class="expand fa fa-plus"></i>
							<i class="collapse fa fa-minus"></i>
						</div>
						<div class="content">%s</div>
					</div>', $attr["state"], $attr["title"], do_shortcode($value));
}

add_shortcode('toggle', 'shortcode_toggle');


/* ----------------------------------------------------------------
   TABS
-----------------------------------------------------------------*/

function shortcode_tabs($attr, $value) {
	$attr = shortcode_atts(array('style' => 'filled'), $attr);
	return sprintf('	<div class="tabs %s">
							<div class="head clearfix"></div>
							<div class="content">%s</div>
						</div>', $attr["style"], do_shortcode($value));
}

add_shortcode('tabs', 'shortcode_tabs');


function shortcode_tab($attr, $value) {
	$attr = shortcode_atts(array( 'title' => 'Tab Title'), $attr);
	return sprintf('<div title="%s" class="tab">%s</div>', $attr["title"], do_shortcode($value));	
}

add_shortcode('tab', 'shortcode_tab');


/* ----------------------------------------------------------------
   COLUMNS
-----------------------------------------------------------------*/

function shortcode_columns($attr, $value) {
	$attr = shortcode_atts(array('count' => 'two'), $attr);
	return sprintf('<section class="columns columns-%s clearfix">%s</section>', $attr["count"], do_shortcode($value));
}

add_shortcode('columns', 'shortcode_columns');


function shortcode_column($attr, $value) {
	return sprintf('<section class="column">%s</section>', do_shortcode($value));
}

add_shortcode('column', 'shortcode_column');

