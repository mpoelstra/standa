<?php
function my_scripts() {
	// CSS first
	if ( !is_admin() ) {
		wp_enqueue_style( 'style', get_stylesheet_directory_uri().'/style.css', null, '1.0', 'all' );
		wp_enqueue_style( 'slick', get_stylesheet_directory_uri().'/assets/slick/slick.css', null, '1.0', 'all' );
		wp_enqueue_style( 'magnificpopup', get_stylesheet_directory_uri().'/assets/magnificpopup/magnific-popup.css', null, '1.0', 'all' );
	}

	// JavaScript
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( !is_admin() ) {
		wp_enqueue_script( 'customplugins', get_template_directory_uri() . '/assets/js/plugins.min.js', array('jquery'), NULL, true );
		wp_enqueue_script( 'customscripts', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), NULL, true );
		//wp_enqueue_script( 'customscripts', get_template_directory_uri() . '/assets/js/source/main.js', array('jquery'), NULL, true );
	}
}
add_action('init', 'my_scripts');
?>