(function($) {

	$(document).ready(function() {

		/*global Modernizr */
		
		//var clickHandler = Modernizr.touch ? 'touchstart' : 'click',
		var clickHandler = 'click',
			menuBtn = $(".menu-btn"),
			logo = $('.main a.logo');

		menuBtn.on(clickHandler, function(e) {
			e.preventDefault();
			var element = $(this),
				menu = element.attr('data-href'),
				viewportWidth = $( window ).width();

			console.log(viewportWidth);
			if (viewportWidth > 767) {
				$(menu).slideToggle();
			} else {
				$(menu).toggleClass('menu--open');
				$('body').toggleClass('no-scroll');
			}
			element.toggleClass('open');
			//do your stuff here
		});

		logo.on(clickHandler, function(e) {

			var viewportWidth = $( window ).width();
			if (viewportWidth < 768) {
				e.preventDefault();
				
				$('#menu').removeClass('menu--open');
				menuBtn.removeClass('open');

				$('html, body').animate({ // was html, body
					//html needed for firefox
					//body needed for chrome
					scrollTop: 0
				}, 500);
			}
		});

		equalHeightFeatures($);

		accordion($, clickHandler);

		$('a[href*="#"]:not([href="#"])').on(clickHandler, function(e) {
			var viewportWidth = $( window ).width(),
				scrollSpeed = 500,
				offset = 15;
			if (viewportWidth < 768) {
				scrollSpeed = 1000;
				offset = 65 + 15; //fixed header height + extra white space
				$('#menu').removeClass('menu--open');
				menuBtn.removeClass('open');
				$('body').removeClass('no-scroll');
			}

			e.preventDefault();
			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					$('html, body').animate({ // was html, body
						//html needed for firefox
						//body needed for chrome
						scrollTop: target.offset().top - offset
					}, scrollSpeed)
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

    $(window)
		.load(function() {
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
					autoplay: true,
					autoplaySpeed: slideSpeed,
					arrows: true,
					dots: true
				});

			}
		
		})
		.resize(function() {
			equalHeightFeatures($);
		});

	function equalHeightFeatures($) {
		var viewportWidth = $( window ).width(),
			features = $(".features").find('.feature');
		console.log(viewportWidth);
		if (viewportWidth > 767) {
			var maxHeight = 0;

			features.each(function( index ) {
				var height = $(this).height();
				if (height > maxHeight) {
					maxHeight = height;
				}
			});

			features.height(maxHeight);
		} else {
			features.height('auto');
		}
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