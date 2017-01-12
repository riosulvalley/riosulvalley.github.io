<?php

/* ----------------------------------------------------------------

   Name: Mighty Post Meta Boxes
   URI: http://meetmighty.com/
   Description: Display theme specific meta boxes for posts
   Version: 1.0
   Author: Mighty Themes
   Author URI: http://meetmighty.com
 
-----------------------------------------------------------------*/


add_filter( 'cmb_meta_boxes', 'mighty_metaboxes' );

function mighty_metaboxes( array $meta_boxes ) {

	$prefix = '_mighty_';


/* ----------------------------------------------------------------
   METABOX POST FORMAT: AUDIO
-----------------------------------------------------------------*/

	$meta_boxes['mighty_metabox_audio'] = array(
		'id'         => 'mighty-metabox-audio',
		'title'      => __( 'Audio Details', 'cmb' ),
		'pages'      => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => __( 'Audio File', 'cmb' ),
				'desc' => __( 'Enter URL to the MP3 audio file. &nbsp;(Example: http://domain.com/speech.mp3)', 'cmb' ),
				'id'   => $prefix . 'audio-file',
				'type' => 'text_url',
			),
		),
	);


/* ----------------------------------------------------------------
   METABOX POST FORMAT: LINKS
-----------------------------------------------------------------*/

	$meta_boxes['mighty_metabox_link'] = array(
		'id'         => 'mighty-metabox-link',
		'title'      => __( 'Link Details', 'cmb' ),
		'pages'      => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => __( 'Link Anchor Text', 'cmb' ),
				'desc' => __( 'The text string you would like linked to the URL below.', 'cmb' ),
				'id'   => $prefix . 'link-text',
				'type' => 'text_medium',
			),
			array(
				'name' => __( 'Link URL', 'cmb' ),
				'desc' => __( 'Enter the URL to the link. &nbsp;(Example: http://domain.com)', 'cmb' ),
				'id'   => $prefix . 'link-url',
				'type' => 'text_url',
			),
			array(
				'name'    => __( 'Link Target', 'cmb' ),
				'desc' => __( 'Open link in a new window', 'cmb' ),
				'id'   => $prefix . 'link-target',
				'type' => 'checkbox',
			),
		),
	);

/* ----------------------------------------------------------------
   METABOX POST FORMAT: QUOTES
-----------------------------------------------------------------*/

	$meta_boxes['mighty_metabox_quote'] = array(
		'id'         => 'mighty-metabox-quote',
		'title'      => __( 'Quote Details', 'cmb' ),
		'pages'      => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => __( 'Quote Text', 'cmb' ),
				'desc' => __( 'Add the text quote you would like displayed.', 'cmb' ),
				'id'   => $prefix . 'quote-text',
				'type' => 'textarea_small',
			),
			array(
				'name' => __( 'Quote Citation', 'cmb' ),
				'desc' => __( 'Add the citation of who said the quote.<br>(Example: Steve Jobs &#8212; Apple, Inc.)', 'cmb' ),
				'id'   => $prefix . 'quote-attr',
				'type' => 'text_medium',
			),
		),
	);


/* ----------------------------------------------------------------
   METABOX POST FORMAT: VIDEO
-----------------------------------------------------------------*/

	$meta_boxes['mighty_metabox_video'] = array(
		'id'         => 'mighty-metabox-video',
		'title'      => __( 'Video Details', 'cmb' ),
		'pages'      => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => __( 'Self Hosted Video URL', 'cmb' ),
				'desc' => __( 'Enter in the URL to the video MP4 or M4V file. (Example: http://domain.com/movie.mp4)', 'cmb' ),
				'id'   => $prefix . 'video-url',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Third Party Video', 'cmb' ),
				'desc' => __( 'Enter a YouTube, Vimeo, etc URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'cmb' ),
				'id'   => $prefix . 'video-embed',
				'type' => 'oembed',
			),
		),
	);


/* ----------------------------------------------------------------
   PORTFOLIO METABOX
-----------------------------------------------------------------*/

	$meta_boxes['mighty_metabox_portfolio'] = array(
		'id'         => 'mighty-metabox-portfolio',
		'title'      => __( 'Project Media', 'cmb' ),
		'pages'      => array( 'portfolio' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => __( 'Slideshow Gallery', 'cmb' ),
				'desc' => __( 'If you would like to display a slideshow image gallery, check this box.', 'cmb' ),
				'id'   => $prefix . 'slideshow-gallery',
				'type' => 'checkbox',
			),
			array(
				'name' => __( 'Self Hosted Video URL', 'cmb' ),
				'desc' => __( 'Enter in the URL to the video MP4 or M4V file. (Example: http://domain.com/movie.mp4)', 'cmb' ),
				'id'   => $prefix . 'video-url',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Third Party Video', 'cmb' ),
				'desc' => __( 'Enter a YouTube, Vimeo, etc URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'cmb' ),
				'id'   => $prefix . 'video-embed',
				'type' => 'oembed',
			),
			array(
				'name' => __( 'Audio File', 'cmb' ),
				'desc' => __( 'Enter URL to an MP3 audio file. &nbsp;(Example: http://domain.com/speech.mp3)', 'cmb' ),
				'id'   => $prefix . 'audio-file',
				'type' => 'text_url',
			),
		),
	);

	$meta_boxes['mighty_metabox_portfolio_details'] = array(
		'id'         => 'mighty-metabox-portfolio-details',
		'title'      => __( 'Project Details', 'cmb' ),
		'pages'      => array( 'portfolio' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(		
				'name' => __( 'Project Date', 'cmb' ),
				'desc' => __( 'Enter the date you produced this project.', 'cmb' ),
				'id'   => $prefix . 'project-date',
				'type' => 'text_date',
			),
			array(
				'name' => __( 'Client Name', 'cmb' ),
				'desc' => __( 'Enter the name of the Client you did this project for.', 'cmb' ),
				'id'   => $prefix . 'client-name',
				'type' => 'text_medium',
			),
			array(
				'name' => __( 'Client Name Link URL', 'cmb' ),
				'desc' => __( 'Optionally you may enter a URL to link to the clients site. &nbsp;(Example: http://domain.com)', 'cmb' ),
				'id'   => $prefix . 'client-url',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Special Skills', 'cmb' ),
				'desc' => __( 'You may optionally and special skills you would like to note.<br>(Example: Design, Coding, User Testing)', 'cmb' ),
				'id'   => $prefix . 'project-skills',
				'type' => 'text',
			),			
			array(
				'name' => __( 'Project Link Anchor Text', 'cmb' ),
				'desc' => __( 'The text string you would like linked to the URL below. &nbsp;(Example: View Project)', 'cmb' ),
				'id'   => $prefix . 'project-link-text',
				'type' => 'text_medium',
			),
			array(
				'name' => __( 'Project Link URL', 'cmb' ),
				'desc' => __( 'Enter a URL to link to the project elsewhere. &nbsp;(Example: http://domain.com)', 'cmb' ),
				'id'   => $prefix . 'project-url',
				'type' => 'text_url',
			),
		),
	);

	return $meta_boxes;
}


/* ----------------------------------------------------------------
   INITIALIZE
-----------------------------------------------------------------*/

add_action( 'init', 'init_mighty_meta_boxes', 9999 );

function init_mighty_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'init.php' );
	}
}
