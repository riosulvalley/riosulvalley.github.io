<?php

/* ----------------------------------------------------------------

   Name: Mighty Flickr Photos
   URI: http://meetmighty.com/
   Description: Display your most recent photos from Flickr
   Version: 1.0
   Author: Mighty Themes
   Author URI: http://meetmighty.com
 
-----------------------------------------------------------------*/


add_action( 'widgets_init', 'mighty_flickr_widgets' );

function mighty_flickr_widgets() {
	register_widget( 'mighty_Flickr_Widget' );
}


/* ----------------------------------------------------------------
   WIDGET CLASS
-----------------------------------------------------------------*/

class mighty_flickr_widget extends WP_Widget{


/* ----------------------------------------------------------------
   WIDGET SETUP
-----------------------------------------------------------------*/

function mighty_Flickr_Widget() {

	/* Widget settings */
	$widget_ops = array(
		'classname' => 'mighty_flickr_widget',
		'description' => __( 'Display your most recent photos from Flickr.', 'mighty' )
	);

	/* Widget controls */
	$control_ops = array(
		'width' => 200,
		'height' => 350,
		'id_base' => 'mighty_flickr'
	);

	/* Build widget */
	$this->WP_Widget( 'mighty_flickr', __( 'Mighty Flickr Photos', 'mighty' ), $widget_ops, $control_ops );

}


/* ----------------------------------------------------------------
   WIDGET OUTPUT
-----------------------------------------------------------------*/

function widget( $args, $instance ) {

	extract( $args );

	/* Widget variables */
	$title = apply_filters( 'widget_title', $instance['title'] );
	$flickr_id = $instance['flickr_id'];
	$flickr_count = $instance['flickr_count'];

	include_once( ABSPATH . WPINC . '/feed.php' );
	if( $flickr_count == '') $flickr_count = 6;

	$rss = fetch_feed('http://api.flickr.com/services/feeds/photos_public.gne?ids='.$flickr_id.'&lang=en-us&format=rss_200');
	add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$rss', 'return 1800;' ) );

	if ( !is_wp_error( $rss ) ){
		$items = $rss->get_items( 0, $rss->get_item_quantity( $flickr_count ) );
	}

	/* Display widget */
	echo $before_widget;

	if ( $title ) echo $before_title . $title . $after_title; ?>

	<ul class="flickr-photos">
	<?php foreach( $items as $item ) {
		$image_group = $item->get_item_tags( 'http://search.yahoo.com/mrss/', 'thumbnail' );
		$image_attrs = $image_group[0]['attribs'];
		foreach( $image_attrs as $image ) {
			$url = $image['url'];
			$width = $image['width'];
			$height = $image['height'];
			echo '<li><a target="_blank" href="' . $item->get_permalink() . '"><img src="'. $url .'" width="' . $width . '" height="' . $height . '" alt="'. $item->get_title() .'"></a></li>';
		}
	} ?>
	</ul>

	<?php echo $after_widget;
}


/* ----------------------------------------------------------------
   WIDGET UPDATE
-----------------------------------------------------------------*/

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	/* Remove HTML */
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
	$instance['flickr_count'] = strip_tags($new_instance['flickr_count']);

	return $instance;
}


/* ----------------------------------------------------------------
   WIDGET SETTINGS
-----------------------------------------------------------------*/

function form( $instance ) {

	/* Add default settings */
	$defaults = array(
		'title' => __( 'Flickr Photos', 'mighty' ),
		'flickr_id' => '29146556@N02',
		'flickr_count' => 6,
	);

	$instance = wp_parse_args( (array) $instance, $defaults );

	/* Output the form */
	?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>">
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>"><?php _e( 'Flickr ID:', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" value="<?php echo $instance['flickr_id']; ?>">
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'flickr_count' ); ?>"><?php _e( 'Number of shots to show:', 'mighty' ); ?></label>
		<input type="text" class="small-text" id="<?php echo $this->get_field_id( 'flickr_count' ); ?>" name="<?php echo $this->get_field_name( 'flickr_count' ); ?>" value="<?php echo $instance['flickr_count']; ?>">
	</p>

<?php }

} ?>