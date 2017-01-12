
jQuery(document).ready(function($) {

	"use strict";

	// Gallery Post Format Slider
	$(window).load(function() {
		$('#content .flexslider').flexslider({
			slideshow: false,
			controlNav: false,
			animation: "slide",
			animationSpeed: 250,
			smoothHeight: true,
			prevText: '<i class="fa fa-chevron-left"></i>',
			nextText: '<i class="fa fa-chevron-right"></i>'
		});
	});


	// Homepage Slider
	$(window).load(function() {
		$('body.home .flexslider').flexslider({
			slideshow: false,
			controlNav: false,
			animation: "slide",
			easing: "swing",
			animationSpeed: 750,
			smoothHeight: false,
			animationLoop: false,
			prevText: '<i class="fa fa-chevron-left"></i>',
			nextText: '<i class="fa fa-chevron-right"></i>'
		});
	});


	// Mobile Menu
	$('#nav').slicknav({
		prependTo: 'body',
		label: '',
		allowParentLinks: 'true',
		closedSymbol: '<i class="fa fa-caret-down"></i>',
		openedSymbol: '<i class="fa fa-caret-up"></i>'
	});


	// Make Videos Responsive
	$('.entry-image').fitVids();
	$('.poster').fitVids();


	// Portfolio Filter Sorting
	$('.portfolio-container').isotope({
		resizable: true,
		layoutMode: 'cellsByRow'
	});

	$('.portfolio-filter a').click(function(e) {
		if( $('body').hasClass('tax-portfolio-type') ) {
			return;
		}
		// do the filter
		var selector = $(this).attr('data-filter');
		$('.portfolio-container').isotope({ filter: selector });

		// update filter class
		$('.portfolio-filter a').removeClass('active');
		$(this).addClass('active');

		// prevent default click
		e.preventDefault();
		return false;
	});

});
