(function($) {

	$(document).ready(function() {

		/*global Modernizr */
		
		//var clickHandler = Modernizr.touch ? 'touchstart' : 'click',
		var clickHandler = 'click',
			menuBtn = $(".menu-btn"),
			logo = $('.main a.logo'),
			mobileWidth = 767;

		menuBtn.on(clickHandler, function(e) {
			e.preventDefault();
			var element = $(this),
				menu = element.attr('data-href'),
				viewportWidth = $( window ).width();

			if (viewportWidth > mobileWidth) {
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
			if (viewportWidth < mobileWidth + 1) {
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

		equalHeightFeatures($, mobileWidth);

		accordion($, clickHandler);

		initOverlay($, clickHandler);

		$('a[href*="#"]:not([href="#"])').on(clickHandler, function(e) {
			var viewportWidth = $( window ).width(),
				scrollSpeed = 500,
				offset = 15;
			if (viewportWidth < mobileWidth + 1) {
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
			var sliders = $('.slides'),
				slideSpeed = 2000;
				showDots = false;
			if (sliders.length) {
				$.each(sliders, function( index, slider ) {
					var $slider = $(slider);
					slideSpeed = parseInt($slider.attr('data-speed')) * 1000;
					showDots = $slider.attr('data-dots') ? true : false;
					$slider.on('init', function(event, slick) {
						if (showDots) {
							var slides = slick.$slides,
								dots = slick.$dots.children('li');

							$.each(slides, function( index, slide ) {
								var slideColor = slide.getAttribute('data-color');
								if (slideColor) {
									$(dots[index]).find('button').css( 'background', slideColor );
								}
							});
						}
						//init
						/*
						setTimeout(function() {
							$('.loader').fadeOut('slow');
						}, 1000);
						*/
					});

					$slider.slick({
						slidesToShow: 1,
						autoplay: true,
						autoplaySpeed: slideSpeed,
						arrows: true,
						dots: showDots
					});

				});
			}
		
		})
		.resize(function() {
			equalHeightFeatures($);
		});

	function initOverlay($, clickHandler) {
		var productBtn = $('.product_btn'),
			overlays = $('.product-form, .product-overlay'),
			closeBtns = $('.product-form_close, .product-overlay'),
			form = $('.product-form'),
			formCloseBtn = $('.product-form_close'),
			fadeSpeed = 'fast';

		productBtn.on(clickHandler, function(e) {
			e.preventDefault();
			
			overlays.fadeIn(fadeSpeed, function() {
				$('body').addClass('show-overlay');
				formCloseBtn[0].focus();
				form.attr('aria-hidden', 'false');
				$('.main').attr('aria-hidden', 'true');
			});
		});

		closeBtns.on(clickHandler, function(e) {
			e.preventDefault();

			overlays.fadeOut(fadeSpeed, function() {
				$('body').removeClass('show-overlay');
				form.attr('aria-hidden', 'true');
				$('.main').attr('aria-hidden', 'false');
				$('body')[0].focus();
			});
			
		});

	}

	function equalHeightFeatures($, mobileWidth) {
		var viewportWidth = $( window ).width(),
			features = $(".features").find('.feature');
		if (viewportWidth > mobileWidth) {
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