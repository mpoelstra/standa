(function($) {

	$(document).ready(function() {

		/*global Modernizr */
		var clickHandler = Modernizr.touch ? 'touchstart' : 'click',
			menuBtn = $(".menu-btn");

		menuBtn.on(clickHandler, function(e) {
			e.preventDefault();
			var element = $(this),
				menu = element.attr('data-href');
			
			$(menu).slideToggle();
			element.toggleClass('open');
			//do your stuff here
		});

		equalHeightFeatures($);

		accordion($, clickHandler);

		$('a[href*="#"]:not([href="#"])').on(clickHandler, function(e) {
			e.preventDefault();
			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					$('html, body').animate({ // was html, body
						//html needed for firefox
						//body needed for chrome
						scrollTop: target.offset().top
					}, 500)
					.promise().then(function() {
						// Called when the animation in total is complete
						if (!target.hasClass('selected')) {
							setTimeout(function() {
								openPage(target);
							}, 500);
						}
					});
					return false;
				}
			}
		});
    });

    $(window).load(function() {
		var slides = $('.slides'),
			slideSpeed = 2000;
		if (slides.length) {
			slideSpeed = parseInt(slides.attr('data-speed')) * 1000;
			slides.on('init', function(event, slick){
				//init
				/*
				setTimeout(function() {
					$('.loader').fadeOut('slow');
				}, 1000);
				*/
			});

			slides.slick({
				slidesToShow: 1,
				autoplay: false,
  				autoplaySpeed: slideSpeed,
				arrows: true,
				dots: true
			});

		}
		
	});

	function equalHeightFeatures($) {
		var features = $(".features").find('.feature'),
			maxHeight = 0;

		features.each(function( index ) {
			var height = $(this).height();
			if (height > maxHeight) {
				maxHeight = height;
			}
		});

		features.height(maxHeight);
	}

	function accordion($, clickHandler) {
		var pages = $(".pages").find('.pages_item');

		pages.each(function( index ) {
			var pageTitle = $(this).find('.page_title');
			pageTitle.on(clickHandler, function(e){
				e.preventDefault();
				var element = $(this);
				openPage(element);
			});
		});

	}

	function openPage(element) {
		element.toggleClass('selected');
		element.next('div').slideToggle( "slow", function() {
			//anim complete
		});
	}

})(jQuery);