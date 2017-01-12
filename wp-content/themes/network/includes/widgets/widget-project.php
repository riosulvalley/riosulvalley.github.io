<?php

/* ----------------------------------------------------------------

   Name: Mighty Featured Project Widget
   URI: http://meetmighty.com/
   Description: Displays a project you would like to feature in the sidebar
   Version: 1.0
   Author: Mighty Themes
   Author URI: http://meetmighty.com
 
-----------------------------------------------------------------*/


add_action( 'widgets_init', 'mighty_project_widgets' );

function mighty_project_widgets() {
	register_widget( 'Mighty_Project_Widget' );
}


/* ----------------------------------------------------------------
   WIDGET CLASS
-----------------------------------------------------------------*/

class mighty_project_widget extends WP_Widget {


/* ----------------------------------------------------------------
   WIDGET SETUP
-----------------------------------------------------------------*/

function Mighty_Project_Widget() {

	/* Widget settings */
	$widget_ops = array(
		'classname' => 'mighty_project_widget',
		'description' => __( 'Displays a portfolio project you would like to feature.', 'mighty' )
	);

    /* Widget controls */
	$control_ops = array(
		'width' => 300,
		'height' => 350,
		'id_base' => 'mighty_project_widget'
	);

    /* Build widget */
	$this->WP_Widget( 'mighty_project_widget', __( 'Mighty Featured Project', 'mighty' ), $widget_ops, $control_ops );

}


/* ----------------------------------------------------------------
   WIDGET OUTPUT
-----------------------------------------------------------------*/

function widget( $args, $instance ) {
	extract( $args );

	/* Widget variables */
	$title = apply_filters( 'widget_title', $instance['title'] );
	$project = apply_filters( 'widget_title', $instance['project'] );

	/* Display widget */
	echo $before_widget;

	if ( $title ) {
		echo $before_title . $title . $after_title;
	}

	/* Check, Query, and Loop */

	if ( post_type_exists( 'portfolio' ) ) {

		if ( $project ) {

			$loop = new WP_Query( array(
				'post_type' => 'portfolio',
				'posts_per_page' => 1,
				'p' => $project
			) );

		} else {

			$loop = new WP_Query( array(
				'post_type' => 'portfolio',
				'posts_per_page' => 1
			) );

		}

		while ( $loop->have_posts() ) : $loop->the_post(); ?>

		<!-- Article -->
		<article class="post last">

			<?php if ( has_post_thumbnail() ) : ?>

				<a href="<?php the_permalink(); ?>" title="<?php _e( 'View more of', 'mighty'); ?> - <?php the_title(); ?>" rel="bookmark">
					<?php the_post_thumbnail( 's' ); ?>
					<div class="overlay"></div>
					<span><?php the_title(); ?></span>
				</a>

			<?php endif; ?>

		</article>

		<?php endwhile;

	} else {
		echo __( 'Please install and activate the Mighty Shortcode / Custom Post Type plugin included in the theme download.', 'mighty' );
	}
	
	echo $after_widget;
}


/* ----------------------------------------------------------------
   WIDGET UPDATE
-----------------------------------------------------------------*/

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	/* Remove HTML */
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['project'] = strip_tags( $new_instance['project'] );

	return $instance;
}


/* ----------------------------------------------------------------
   WIDGET SETTINGS
-----------------------------------------------------------------*/

function form( $instance ) {

	/* Add default settings */
	$defaults = array(
		'title' => 'Featured Project',
		'project' => ''
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); 
	
	/* Output the form */
	?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mighty' ) ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'project' ); ?>"><?php _e( 'Project ID:', 'mighty' ) ?></label>
		<input type="text" size="3" id="<?php echo $this->get_field_id( 'project' ); ?>" name="<?php echo $this->get_field_name( 'project' ); ?>" value="<?php echo $instance['project']; ?>" />
		<br><small><?php _e( 'Leave empty to always show most recent, or assign an ID', 'mighty' ) ?></small>
	</p>
		
	<?php
	}
}
?>