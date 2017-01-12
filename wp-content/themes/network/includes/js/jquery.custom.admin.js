/* ----------------------------------------------------------------

   Name: Mighty Post Meta Boxes Admin Toggle Scripts
   URI: http://meetmighty.com/
   Description: Toggle post meta boxes based on post format selected
   Version: 1.0
   Author: Mighty Themes
   Author URI: http://meetmighty.com
 
-----------------------------------------------------------------*/

jQuery(document).ready(function($) {

	// Define
	var audioBox      = $('#mighty-metabox-audio'),
    	audioChecked  = $('#post-format-audio'),
    	videoBox      = $('#mighty-metabox-video'),
    	videoChecked  = $('#post-format-video'),
    	linkBox       = $('#mighty-metabox-link'),
    	linkChecked   = $('#post-format-link'),
    	quoteBox      = $('#mighty-metabox-quote'),
    	quoteChecked  = $('#post-format-quote'),
    	group         = $('#post-formats-select input');

	// Hide
  HideThem(null);	

	group.change( function() {

    $that = $(this);
	    
    HideThem(null);

    if( $that.val() == 'link' ) {
			linkBox.css('display', 'block');
		} else if( $that.val() == 'quote' ) {
		    quoteBox.css('display', 'block');
		} else if( $that.val() == 'video' ) {
		    videoBox.css('display', 'block');
		} else if( $that.val() == 'audio' ) {
		    audioBox.css('display', 'block');
		}

	});

  if(linkChecked.is(':checked'))
      linkBox.css('display', 'block');

  if(quoteChecked.is(':checked'))
      quoteBox.css('display', 'block');

 	if(videoChecked.is(':checked'))
		videoBox.css('display', 'block');

	if(audioChecked.is(':checked'))
		audioBox.css('display', 'block');

  function HideThem() {
	linkBox.css('display', 'none');
	quoteBox.css('display', 'none');
	videoBox.css('display', 'none');
	audioBox.css('display', 'none');
  }

});
