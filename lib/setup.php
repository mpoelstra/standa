<?php
/**
 * Setup the constants used in the functions in this file 
 */
$get_theme_name = explode('/themes/', get_template_directory());
if( ! defined('TEMPLATE_NAME') ) { define('TEMPLATE_NAME', 'standa'); }
if( ! defined('TXTDOMAIN') )     { define('TXTDOMAIN', 'standa'); }
if( ! defined('THEME_OPTIONS') ) { define('THEME_OPTIONS', 'theme_options'); }
if( ! defined('RELATIVE_PLUGIN_PATH') ) { define('RELATIVE_PLUGIN_PATH',  str_replace(home_url() . '/', '', plugins_url())); }
if( ! defined('RELATIVE_CONTENT_PATH') ) { define('RELATIVE_CONTENT_PATH', str_replace(home_url() . '/', '', content_url())); }
if( ! defined('THEME_NAME') ) { define('THEME_NAME', next($get_theme_name)); }
if( ! defined('THEME_PATH') ) { define('THEME_PATH', RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME); }

/**
 * Setup the theme. Gets called by after_setup_theme WP hook 
 *  
 *  - add a text domain for translations
 *  - add menus for navigation
 *  - add a theme options page
 *
 * @access public
 * @return void
 */


if( ! function_exists('standa_setup') ) {
  function standa_setup()
  {
    // setup the textdomain for translations
    load_theme_textdomain( TXTDOMAIN, TEMPLATEPATH . '/languages' );
    
    // add support for featured images and set some size options
    add_theme_support( 'post-thumbnails' );
    add_post_type_support( 'page', 'excerpt' );
    
    add_image_size( 'background', 1000, 400, true ); //(cropped)
	
    // add menus to the header and footer of the theme 
    register_nav_menus( array(
      'header-menu'                     => __('Main menu', TXTDOMAIN),
      'footer-menu'                     => __('Footer menu', TXTDOMAIN)
    ));   
    
    // register sidebars   
    standa_register_sidebars();
	
	//custom post types/taxonomies/filters
    
	//add_action('init', 'standa_create_post_type' );
  //add_action('init', 'standa_create_taxonomies', 0 );
  //add_filter("manage_edit-media_columns", "my_media_columns");
  //add_filter("manage_edit-event_columns", "my_event_columns");
  //add_action('manage_posts_custom_column', 'my_custom_columns');
  //add_action('restrict_manage_posts', 'my_restrict_manage_posts' );

	   
    //remove default widgets
	add_action('widgets_init','remove_some_wp_widgets', 1);
	
	//add_action('wp_enqueue_scripts', 'standa_enqueue_scripts');
		
	remove_action('wp_head', 'wp_generator'); 
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'rsd_link'); 
	
	//remove next/prev links, can cause problems in firefox
	remove_action('wp_head', 'start_post_rel_link', 10, 0 );
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	
    add_filter('show_admin_bar', '__return_false'); 
	add_filter('the_generator','hide_wp_vers');
	add_filter('excerpt_length', 'my_excerpt_length');
    add_filter('the_excerpt', 'excerpt_datebefore');
	add_filter( 'wp_title', 'standa_filter_wp_title', 10, 2 );

  $role_object = get_role( 'editor' );
  $role_object->add_cap( 'edit_theme_options' );
 }
  
  add_action( 'after_setup_theme', 'standa_setup' );   
} else {
  wp_die('Could not setup theme. Name collision found with standa_setup'); 
}

// Custom WordPress Login Logo
function login_css() {
	wp_enqueue_style( 'login_css', get_template_directory_uri() . '/css/login.css' );
}
//add_action('login_head', 'login_css');

//Add sidebars to the theme to which widgets can be added. 
if( ! function_exists('standa_register_sidebars') ) {
  function standa_register_sidebars() 
  {
       
    register_sidebar( array(
      'name'          => 'Pagina rechterkant',
      'description'   => __('Voeg hier de widgets toe die verschijnen op een pagina aan de rechterkant', TXTDOMAIN),
      'before_widget' => '<div class="box %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '',
      'after_title'   => ''
    ));



  }
}

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

add_filter( 'gform_confirmation_anchor_1', '__return_false' );

//Custom excerpt length
function my_excerpt_length($length) {
  if(is_category() || is_tax()) {
    return 50;
  } else {
    //archive and other taxonomies
    return 10;
  }
}
?>