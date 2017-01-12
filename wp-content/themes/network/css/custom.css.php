<?php	

// Require WordPress To Load First
$current_url = dirname( __FILE__ );
$wp_content_pos = strpos( $current_url, 'wp-content' );
$wp_content = substr( $current_url, 0, $wp_content_pos );
require_once( $wp_content . 'wp-load.php' );

// Revert Back to Stylesheet
ob_start ( "ob_gzhandler" );
header( "Content-type: text/css; charset: UTF-8" );
	
?>

/*-----------------------------------------------------------------
 Output Custom CSS from Theme Options Panel
---------------------------------------------------------------- */

<?php echo of_get_option( 'custom-css' ); ?>