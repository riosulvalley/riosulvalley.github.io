<?php

/* ----------------------------------------------------------------

   Name: Mighty Recent Tweets
   URI: http://meetmighty.com/
   Description: Display recent tweets from your Twitter feed
   Version: 1.0
   Author: Mighty Themes
   Author URI: http://meetmighty.com
 
-----------------------------------------------------------------*/


require_once( 'oauth/twitteroauth.php' );


/* ----------------------------------------------------------------
   WIDGET CLASS
-----------------------------------------------------------------*/

add_action( 'widgets_init', create_function( '', 'register_widget( "Mighty_Recent_Tweets" );' ) );

class Mighty_Recent_Tweets extends WP_Widget {

	private $mighty_twitter_oauth = array();


/* ----------------------------------------------------------------
   WIDGET SETUP
-----------------------------------------------------------------*/

	public function __construct() {
		parent::__construct(
			'mighty-twitter-widget',
			__('Mighty Recent Tweets', 'mighty'),
			array(
				'classname' => 'mighty_tweet_widget',
				'description' => __('A new widget that displays your latest tweets', 'mighty')
			)
		);
	}


/* ----------------------------------------------------------------
   WIDGET OUTPUT
-----------------------------------------------------------------*/

	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		echo $before_widget;

		$title = apply_filters('widget_title', $instance['title'] );
		if ( $title ) { echo $before_title . $title . $after_title; }

		$result = $this->getTweets($instance['username'], $instance['count']);

		echo '<ul>';

		if( $result && is_array($result) ) {
			foreach( $result as $tweet ) {
				$text = $this->linkify($tweet['text']);
				echo '<li>';
					echo $text;
					echo '<a class="twitter-time-stamp" href="http://twitter.com/' . $instance['username'] . '/status/' . $tweet['id'] . '">' . $tweet['timestamp'] . '</a>';
				echo '</li>';
			}
		} else {
			echo '<li>' . __('There was an error grabbing the Twitter feed', 'mighty') . '</li>';
		}

		echo '</ul>';

		if( !empty($instance['tweettext']) ) {
			echo '<a class="twitter-link" href="http://twitter.com/' . $instance['username'] . '">' . $instance['tweettext'] . '</a>';
		}

		echo $after_widget;
	}


/* ----------------------------------------------------------------
   UPDATE WIDGET
-----------------------------------------------------------------*/

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['tweettext'] = strip_tags( $new_instance['tweettext'] );

		return $instance;
	}


/* ----------------------------------------------------------------
   WIDGET SETTINGS
-----------------------------------------------------------------*/

	public function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance
		);

		// Default widget settings
		$defaults = array(
			'title' => 'Latest Tweets',
			'username' => 'meetmighty',
			'count' => '2',
			'tweettext' => 'Follow on Twitter',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$access_token = get_option('mtw_access_token');
		$access_token_secret = get_option('mtw_access_token_secret');
		$consumer_key = get_option('mtw_consumer_key');
		$consumer_key_secret = get_option('mtw_consumer_secret');

		if ( empty($access_token) || empty($access_token_secret) || empty($consumer_key) || empty($consumer_key_secret) ) {
			echo '<p><a href="options-general.php?page=mighty-twitter-widget-settings">Configure Twitter Widget</a></p>'; 
		} else {
		
			// Build the form
			?>

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mighty') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter Username e.g. meetmighty', 'mighty') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of tweets', 'mighty') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" />
				<small><?php _e('Feeds include replies and retweets', 'mighty'); ?></small>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'tweettext' ); ?>"><?php _e('Follow Text e.g. Follow me on Twitter', 'mighty') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tweettext' ); ?>" name="<?php echo $this->get_field_name( 'tweettext' ); ?>" value="<?php echo $instance['tweettext']; ?>" />
			</p>
			
			<p><em><?php _e('Tweets are cached for 5 minutes to improve performance', 'mighty'); ?></em></p>
		
		<?php

		} // end if

	} // end form


	// Returns tweets from a transient, or calls private oauth function, parses, and sets a transient if needed.
	public function getTweets( $username, $count ) {
		$config = array();
		$config['username'] = $username;
		$config['count'] = $count;
		$config['access_token'] = get_option( 'mtw_access_token' );
		$config['access_token_secret'] = get_option( 'mtw_access_token_secret' );
		$config['consumer_key'] = get_option( 'mtw_consumer_key' );
		$config['consumer_key_secret'] = get_option( 'mtw_consumer_secret' );

		$transname = 'mighty_tw_' . $username . '_' . $count;

		$result = get_transient( $transname );
		if ( !$result ) {
			$result = $this->oauthGetTweets( $config );

			if ( isset( $result['errors'] ) ){
				$result = NULL; 
			} else {
				$result = $this->parseTweets( $result );
				set_transient( $transname, $result, 300 );
			}
		} else {
			if ( is_string( $result ) )
				unserialize( $result );
		}

		return $result;
	}

	// Get tweets feed from Twitter API 1.1
	private function oauthGetTweets( $config ) {
		if( empty( $config['access_token'] ) ) 
			return array( 'error' => __('Not properly configured, check settings', 'mighty') );		
		if( empty( $config['access_token_secret'] ) ) 
			return array( 'error' => __('Not properly configured, check settings', 'mighty') );
		if( empty( $config['consumer_key'] ) ) 
			return array( 'error' => __('Not properly configured, check settings', 'mighty') );		
		if( empty( $config['consumer_key_secret'] ) ) 
			return array( 'error' => __('Not properly configured, check settings', 'mighty') );		

		$options = array(
			'trim_user' => true,
			'exclude_replies' => false,
			'include_rts' => true,
			'count' => $config['count'],
			'screen_name' => $config['username']
		);

		$connection = new TwitterOAuth( $config['consumer_key'], $config['consumer_key_secret'], $config['access_token'], $config['access_token_secret'] );
		$result = $connection->get( 'statuses/user_timeline', $options );

		return $result;
	}

	// Parse the tweets
	public function parseTweets( $results = array() ) {
		$tweets = array();
		foreach( $results as $result ) {
			$temp = explode( ' ', $result['created_at'] );
			$timestamp = $temp[2] . ' ' . $temp[1] . ' ' . $temp[5];

			$tweets[] = array(
				'timestamp' => $timestamp,
				'text' => filter_var( $result['text'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH ),
				'id' => $result['id_str']
			);
		}

		return $tweets;
	}

	// Changes text to links
	private function mighty_text_links( $matches ) {
		return '<a href="' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
	}

	// Changes username to links
	private function mighty_username_link( $matches ) {
		return '<a href="http://twitter.com/' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
	}

	// Make links
	public function linkify( $text ) {

		$string = preg_replace_callback(
			"/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/",
			array( &$this, 'mighty_text_links' ),
			$text
		);

		$string = preg_replace_callback(
			'/@([A-Za-z0-9_]{1,15})/', 
			array( &$this, 'mighty_username_link' ), 
			$string
		);

		return $string;
	}

} // Mighty_Recent_Tweets class

add_action( 'widgets_init', create_function( '', 'register_widget( "Mighty_Recent_Tweets" );' ) );


/* ----------------------------------------------------------------
   WP PAGE SETTINGS
-----------------------------------------------------------------*/

function Mighty_Recent_Tweets_settings() {
	add_options_page(
		'Twitter Settings',
		'Twitter Settings',
		'manage_options',
		'mighty-twitter-widget-settings',
		'Mighty_Recent_Tweets_render_admin_page'
	);
}

add_action( 'admin_menu', 'Mighty_Recent_Tweets_settings' );


/* ----------------------------------------------------------------
   TWITTER SETTINGS
-----------------------------------------------------------------*/

function mighty_tw_settings() {
	$mtw = array();
	$mtw[] = array( 'label' => 'Twitter Application Consumer Key', 'name' => 'mtw_consumer_key' );
	$mtw[] = array( 'label' => 'Twitter Application Consumer Secret', 'name' => 'mtw_consumer_secret' );
	$mtw[] = array( 'label' => 'Account Access Token', 'name' => 'mtw_access_token' );
	$mtw[] = array( 'label' => 'Account Access Token Secret', 'name' => 'mtw_access_token_secret' );
	return $mtw;
}

function mighty_tw_register_settings() {
	$settings = mighty_tw_settings();
	foreach( $settings as $setting ) {
		register_setting( 'mighty_tw_settings', $setting['name'] );
	}
}

add_action( 'admin_init', 'mighty_tw_register_settings' );


/* ----------------------------------------------------------------
   RENDER TWITTER SETTINGS ADMIN PAGE
-----------------------------------------------------------------*/

function Mighty_Recent_Tweets_render_admin_page() {

	if( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Insufficient permissions' );
	}

	$settings = mighty_tw_settings(); ?>

	<div class="wrap">
	 	<?php screen_icon(); ?>
		<h2>Twitter Widget Settings</h2>
		<form method="post" action="options.php">
			<p><strong>Twitter requires that you register an application in order to utilize their API. Directions to get the Consumer Key, Consumer Secret, Access Token, and Access Token Secret.</strong></p>
			<ol>
				<li><a href="https://dev.twitter.com/apps/new" target="_blank">Create a new Twitter application.</a></li>
				<li>Fill in all fields on the create application page.</li>
				<li>Agree to rules, fill out captcha, and submit your application.</li>
				<li>Copy the Consumer Key, Consumer Secret, Access Token, and Access Token Secret into the fields below.</li>
				<li>Click the Save Changes button at the bottom of this page.</li>
			</ol>
			<?php settings_fields('mighty_tw_settings'); ?>
			<table>
				<?php foreach( $settings as $setting ) : ?>
					<tr>
						<td><?php echo $setting['label']; ?></td>
						<td><input type="text" style="width: 300px;" name="<?php echo $setting['name']; ?>" value="<?php echo get_option( $setting['name'] ); ?>" /></td>
					</tr>
				<?php endforeach; ?>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>

<?php	};
