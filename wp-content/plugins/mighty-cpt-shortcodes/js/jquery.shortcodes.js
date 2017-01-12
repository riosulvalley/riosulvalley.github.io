jQuery(document).ready(function($) {

	// Tabs Shortcode
	$(".tabs").each(function(){
		var t = $(this);
		var h = t.children(".head");
		var b = t.children(".content");
		var contentTabs = b.children(".tab"); 
		
		contentTabs.eq(0).addClass("active");
		contentTabs.each(function(){
			h.append($("<div/>", { "class": "tab", "text": $(this).attr("title") }));
		});
		
		var titleTabs = h.children(".tab"); 
		
		titleTabs.eq(0).addClass("active");
		titleTabs.click(function(){
			$(this).addClass("active").siblings(".tab").removeClass("active");
			b.children(".tab").eq($(this).index()).addClass("active").siblings(".tab").removeClass("active");
		});
	});

	// Toggle Shortcode
	$(".toggle").each(function(){
		var t = $(this);
		var e = t.find(".expand"); 
		var c = t.find(".collapse");
		var b = t.find(".content");
		var isSliding = false;
		
		e.click(function(){
			if (!isSliding)
			{
				isSliding = true;
				e.hide();
				c.show();
				b.slideDown(300, function(){
					isSliding = false;
				});
			}
		});
		c.click(function(){
			if (!isSliding)
			{
				isSliding = true;
				c.hide();
				e.show();
				b.slideUp(300, function(){
					isSliding = false;
				});
			}
		});
	});

	// Alert Shortcode
	var page = $("#content");

	page.delegate(".alert .close", "click", function(e){
		e.preventDefault();
		$(this).parent().fadeOut();
	});

});