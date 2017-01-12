<?php

/* ----------------------------------------------------------------

   Name: Mighty Instagram Photos
   URI: http://meetmighty.com/
   Description: Display your most recent photos from Instagram
   Version: 1.0
   Author: Mighty Themes
   Author URI: http://meetmighty.com
 
-----------------------------------------------------------------*/


add_action( 'widgets_init', 'mighty_instagram_widgets' );

function mighty_instagram_widgets() {
	register_widget( 'mighty_Instagram_Widget' );
}


/* ----------------------------------------------------------------
   WIDGET CLASS
-----------------------------------------------------------------*/

class mighty_instagram_widget extends WP_Widget{


/* ----------------------------------------------------------------
   WIDGET SETUP
-----------------------------------------------------------------*/

function mighty_Instagram_Widget() {

	/* Widget settings */
	$widget_ops = array(
		'classname' => 'mighty_instagram_widget',
		'description' => __( 'Display your most recent photos from Instagram.', 'mighty' )
	);

	/* Widget controls */
	$control_ops = array(
		'width' => 200,
		'height' => 350,
		'id_base' => 'mighty_instagram'
	);

	/* Build widget */
	$this->WP_Widget( 'mighty_instagram', __( 'Mighty Instagram Photos', 'mighty' ), $widget_ops, $control_ops );

}


/* ----------------------------------------------------------------
   WIDGET OUTPUT
-----------------------------------------------------------------*/

function widget( $args, $instance ) {
	extract( $args, EXTR_SKIP );

	/* Widget variables */
	$title = apply_filters( 'widget_title', $instance['title'] );
	$username = $instance['username'];
	$limit = $instance['number'];
	$link = $instance['link'];

	/* Display widget */
	echo $before_widget;

	if ( $title ) echo $before_title . $title . $after_title;
		
	if ( $username != '' ) {
		$images_array = $this->scrape_instagram( $username, $limit );

		if ( is_wp_error( $images_array ) ) {
		   echo $images_array->get_error_message();
		} else {
			?>
			<ul class="clearfix">
			<?php
			foreach ( $images_array as $image ) {
				echo '<li><a target="_blank" href="' . $image['link'] . '"><img src="' . $image['thumbnail']['url'] . '" target="_blank" alt="' . $image['description'] . '" title="' . $image['description'] . '" /></a></li>';
			}
			?>
			</ul>
			<?php
		}
	}

	if ( $link != '' ) {
		?><div class="clearfix"></div><p><a href="http://instagram.com/<?php echo trim($username); ?>" target="_blank"><?php echo $link; ?></a></p><?php  
	}

	echo $after_widget;
}


/* ----------------------------------------------------------------
   WIDGET UPDATE
-----------------------------------------------------------------*/

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	/* Remove HTML */
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['username'] = trim(strip_tags($new_instance['username']));
	$instance['number'] = !absint($new_instance['number']) ? 9 : $new_instance['number'];
	$instance['link'] = strip_tags($new_instance['link']);

	return $instance;
}


/* ----------------------------------------------------------------
   WIDGET SETTINGS
-----------------------------------------------------------------*/

function form( $instance ) {

	/* Add default settings */
	$defaults = array(
		'title' => __( 'Instagram Shots', 'mighty' ),
		'username' => 'instagram',
		'link' => 'Follow Us',
		'number' => 6
	);

	$instance = wp_parse_args( (array) $instance, $defaults );

	/* Output the form */
	?>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e( 'Username:', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>">
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of shots to show:', 'mighty' ); ?></label>
		<input type="text" class="small-text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>">
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Follow Text e.g. Follow us on Dribbble', 'mighty') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
	</p>

<?php }


/* ----------------------------------------------------------------
   WIDGET HELPER
-----------------------------------------------------------------*/

function scrape_instagram( $username, $slice = 9 ) {

	if ( false === ( $instagram = get_transient( 'instagram-photos-' . sanitize_title_with_dashes( $username ) ) ) ) {
		
		$remote = wp_remote_get( 'http://instagram.com/' . trim( $username ) );

		if ( is_wp_error( $remote ) ) 
  			return new WP_Error( 'site_down', __('Unable to communicate with Instagram.', $this->wpiwdomain) );

			if ( 200 != wp_remote_retrieve_response_code( $remote ) ) 
				return new WP_Error( 'invalid_response', __('Instagram did not return a 200.', $this->wpiwdomain ) );

		$shards = explode( 'window._sharedData = ', $remote['body'] );
		$insta_json = explode( ';</script>', $shards[1] );
		$insta_array = json_decode( $insta_json[0], TRUE );

		if ( !$insta_array )
  			return new WP_Error( 'bad_json', __( 'Instagram has returned invalid data.', $this->wpiwdomain ) );

		$images = $insta_array['entry_data']['UserProfile'][0]['userMedia'];

		$instagram = array();
		foreach ( $images as $image ) {

			if ( $image['type'] == 'image' && $image['user']['username'] == $username ) {

				$instagram[] = array(
					'description' => $image['caption']['text'],
					'link' => $image['link'],
					'time' => $image['created_time'],
					'comments' => $image['comments']['count'],
					'likes' => $image['likes']['count'],
					'thumbnail' => $image['images']['thumbnail'],
					'large' => $image['images']['standard_resolution']
				);
			}
		}

		$instagram = base64_encode( serialize( $instagram ) );
		set_transient( 'instagram-photos-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
	}

	$instagram = unserialize( base64_decode( $instagram ) );

	return array_slice( $instagram, 0, $slice );
}

} ?>