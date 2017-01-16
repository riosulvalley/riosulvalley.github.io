jQuery(document).ready(function($) {

	'use strict';

	// Mobile Menu
	$('#nav').slicknav({
		prependTo: 'body',
		label: '',
		allowParentLinks: 'true',
		closedSymbol: '<i class="fa fa-caret-down"></i>',
		openedSymbol: '<i class="fa fa-caret-up"></i>'
	});

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
