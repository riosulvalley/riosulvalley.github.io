<?php

/* ----------------------------------------------------------------

   Name: Mighty Dribbble Shots
   URI: http://meetmighty.com/
   Description: Display your most recent shots from dribbble
   Version: 1.0
   Author: Mighty Themes
   Author URI: http://meetmighty.com
 
-----------------------------------------------------------------*/


add_action( 'widgets_init', 'mighty_dribbble_widgets' );

function mighty_dribbble_widgets() {
	register_widget( 'mighty_Dribbble_Widget' );
}


/* ----------------------------------------------------------------
   WIDGET CLASS
-----------------------------------------------------------------*/

class mighty_dribbble_widget extends WP_Widget{


/* ----------------------------------------------------------------
   WIDGET SETUP
-----------------------------------------------------------------*/

function mighty_Dribbble_Widget() {

	/* Widget settings */
	$widget_ops = array(
		'classname' => 'mighty_dribbble_widget',
		'description' => __( 'Display your latest dribbble shots.', 'mighty' )
	);

	/* Widget controls */
	$control_ops = array(
		'width' => 200,
		'height' => 350,
		'id_base' => 'mighty_dribbble_shots'
	);

	/* Build widget */
	$this->WP_Widget( 'mighty_dribbble_shots', __( 'Mighty Dribbble Shots', 'mighty' ), $widget_ops, $control_ops );

}


/* ----------------------------------------------------------------
   WIDGET OUTPUT
-----------------------------------------------------------------*/

function widget( $args, $instance ) {

	include_once( ABSPATH . WPINC . '/feed.php' );

	$player_name = $instance['dribbble_user'];
	$shots = $instance['dribbble_shots'];
	$rss = fetch_feed( "http://dribbble.com/players/$player_name/shots.rss" );

	add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$rss', 'return 1800;' ) );

	if ( !is_wp_error( $rss ) ){
		$items = $rss->get_items( 0, $rss->get_item_quantity( $shots ) );
	}

	extract( $args );


	/* Widget variables */
	$title = apply_filters( 'widget_title', $instance['title'] );
	$dribbble_user = $instance['dribbble_user'];
	$dribbble_shots = $instance['dribbble_shots'];
	$dribbble_text = $instance['dribbble_text'];
	

	/* Display widget */
	echo $before_widget;

	if ( $title ) echo $before_title . $title . $after_title;

	if ( isset( $items ) ) : ?>

		<ul>
			<?php foreach( $items as $item ) :
				$shot_title = $item->get_title();
				$shot_link = $item->get_permalink();
				$shot_description = $item->get_description();
				preg_match( "/src=\"(http.*(jpg|jpeg|gif|png))/", $shot_description, $shot_image_url );
				$shot_image = $shot_image_url[1];
			?>
			<li>
				<a href="<?php echo esc_url( $shot_link ); ?>" title="<?php echo $shot_title; ?>" target="_blank"><img src="<?php echo $shot_image; ?>" alt="<?php echo $shot_title; ?>"></a>
			</li>
			<?php endforeach; ?>
		</ul>

		<?php if ( $dribbble_text ) : ?>

			<p><a href="http://dribbble.com/<?php echo $dribbble_user; ?>" target="_blank"><?php echo $dribbble_text; ?></a></p>

		<?php endif; ?>

	<?php else : ?>

		<?php _e( 'Please check your dribbble username', 'mighty' ); ?>

	<?php endif;

	echo $after_widget;
}


/* ----------------------------------------------------------------
   WIDGET UPDATE
-----------------------------------------------------------------*/

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	/* Remove HTML */
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['dribbble_user'] = strip_tags( $new_instance['dribbble_user'] );
	$instance['dribbble_shots'] = strip_tags( $new_instance['dribbble_shots'] );
	$instance['dribbble_text'] = strip_tags( $new_instance['dribbble_text'] );	

	return $instance;
}


/* ----------------------------------------------------------------
   WIDGET SETTINGS
-----------------------------------------------------------------*/

function form( $instance ) {

	/* Add default settings */
	$defaults = array(
		'title' => __( 'Dribbble Shots', 'mighty' ),
		'dribbble_user' => 'dribbble',
		'dribbble_shots' => 1,
		'dribbble_text' => ''
	);

	$instance = wp_parse_args( (array) $instance, $defaults );

	/* Output the form */
	?>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('dribbble_user'); ?>"><?php _e( 'Username:', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('dribbble_user'); ?>" name="<?php echo $this->get_field_name('dribbble_user'); ?>" value="<?php echo $instance['dribbble_user']; ?>">
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('dribbble_shots'); ?>"><?php _e( 'Number of shots to show:', 'mighty' ); ?></label>
		<input type="text" class="small-text" id="<?php echo $this->get_field_id('dribbble_shots'); ?>" name="<?php echo $this->get_field_name('dribbble_shots'); ?>" value="<?php echo $instance['dribbble_shots']; ?>">
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'dribbble_text' ); ?>"><?php _e('Follow Text e.g. Follow us on Dribbble', 'mighty') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'dribbble_text' ); ?>" name="<?php echo $this->get_field_name( 'dribbble_text' ); ?>" value="<?php echo $instance['dribbble_text']; ?>" />
	</p>

	<?php
	}
}
?>