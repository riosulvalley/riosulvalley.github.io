<?php

/* ----------------------------------------------------------------

   Name: Mighty Featured Video Widget
   URI: http://meetmighty.com/
   Description: Displays a video you would like to feature in the sidebar
   Version: 1.0
   Author: Mighty Themes
   Author URI: http://meetmighty.com
 
-----------------------------------------------------------------*/


add_action( 'widgets_init', 'mighty_video_widgets' );

function mighty_video_widgets() {
	register_widget( 'mighty_Video_Widget' );
}


/* ----------------------------------------------------------------
   WIDGET CLASS
-----------------------------------------------------------------*/

class mighty_video_widget extends WP_Widget {


/* ----------------------------------------------------------------
   WIDGET SETUP
-----------------------------------------------------------------*/

function mighty_Video_Widget() {

	/* Widget settings */
	$widget_ops = array(
		'classname' => 'mighty_video_widget',
		'description' => __( 'Display a featured YouTube or Vimeo video.', 'mighty' )
	);

    /* Widget controls */
	$control_ops = array(
		'width' => 300,
		'height' => 350,
		'id_base' => 'mighty_video_widget'
	);

    /* Build widget */
	$this->WP_Widget( 'mighty_video_widget', __( 'Mighty Featured Video', 'mighty' ), $widget_ops, $control_ops );
	
}


/* ----------------------------------------------------------------
   WIDGET OUTPUT
-----------------------------------------------------------------*/

function widget( $args, $instance ) {
	extract( $args );

	/* Our variables from the widget settings */
	$title = apply_filters( 'widget_title', $instance['title'] );
	$embed = $instance['embed'];
	$desc = $instance['desc'];

	/* Display widget */
	echo $before_widget;

	if ( $title ) { 
		echo $before_title . $title . $after_title;
	}

	echo '<div class="vid">';
    echo $embed;
	echo '</div>';
		
	if ( $desc != '' ) {
		echo '<p class="desc">' . $desc . '</p>';
    }
	
	echo $after_widget;
}


/* ----------------------------------------------------------------
   WIDGET UPDATE
-----------------------------------------------------------------*/

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	/* Strip tags to remove HTML (important for text inputs) */
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	/* Stripslashes for html inputs */
	$instance['desc'] = stripslashes( $new_instance['desc'] );
	$instance['embed'] = stripslashes( $new_instance['embed'] );

	return $instance;
}


/* ----------------------------------------------------------------
   WIDGET SETTINGS
-----------------------------------------------------------------*/

function form( $instance ) {

	/* Add default settings */
	$defaults = array(
		'title' => 'Featured Video',
		'embed' => stripslashes( '<iframe src="http://player.vimeo.com/video/80977329?color= e9242e" width="300" height="127" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'),
		'desc' => '850 Meter Animated Film',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); 
	
	/* Output the form */
	?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mighty' ) ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'embed' ); ?>"><?php _e( 'Embed Code:', 'mighty' ) ?></label>
		<textarea style="height: 220px;" class="widefat" id="<?php echo $this->get_field_id( 'embed' ); ?>" name="<?php echo $this->get_field_name( 'embed' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['embed'] ), ENT_QUOTES)); ?></textarea>
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Description:', 'mighty' ) ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['desc'] ), ENT_QUOTES)); ?>" />
	</p>
		
	<?php
	}
}
?>