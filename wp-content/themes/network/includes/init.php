<?php

/* ----------------------------------------------------------------
   SET PATH
-----------------------------------------------------------------*/

$path = get_template_directory() . '/includes/';


/* ----------------------------------------------------------------
   WIDGET SETUP
-----------------------------------------------------------------*/

require_once( $path . 'widgets/widget-tweets.php' );
require_once( $path . 'widgets/widget-video.php' );
require_once( $path . 'widgets/widget-project.php' );
require_once( $path . 'widgets/widget-dribbble.php' );
require_once( $path . 'widgets/widget-instagram.php' );
require_once( $path . 'widgets/widget-flickr.php' );
require_once( $path . 'widgets/widget-social.php' );

?>