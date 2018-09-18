<?php
$resort_theme = wp_get_theme();
define( 'RESORT_THEME_VERSION', ( WP_DEBUG ) ? time() : $resort_theme->get( 'Version' ) );

if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

add_action( 'after_setup_theme', 'resort_theme_setup' );

if ( ! function_exists( 'resort_theme_setup' ) ) {

	function resort_theme_setup() {

		if ( ! get_post_meta( get_the_ID(), 'disable_tags', true ) ) {
		the_tags( '<div class="tags media-body">', ' ', '</div>' );
		}
		
		add_image_size( 'resort-image-1110x550-croped', 1110, 550, true );
		add_image_size( 'resort-image-350x250-croped', 350, 250, true );	
		add_image_size( 'resort-image-350x204-croped', 350, 204, true );
		add_image_size( 'resort-image-350x195-croped', 350, 195, true );		
		add_image_size( 'resort-image-255x182-croped', 255, 182, true );
		add_image_size( 'resort-image-50x50-croped', 50, 50, true );
		

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'resort' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );
		/*
		  * Enable support for custome header and background for the images.
		  */
		 add_theme_support( 'custom-header' );
		 add_theme_support( 'custom-background' ) ;
		 // This theme styles the visual editor to resemble the theme style.
		add_editor_style( 'assets/css/editor-style.css' );
 
		register_nav_menus(
			array(
				'resort-primary_menu'   => esc_html__( 'Primary', 'resort' ),
				'resort-footer' => esc_html__( 'Footer', 'resort' ),
			)
		);

	}
}
/**
 * The theme fully support WooCommerce, Awesome huh?.
 */
add_theme_support( 'woocommerce' );

if ( ! function_exists( 'resort_register_default_sidebars' ) ) {
	function resort_register_default_sidebars() {
		
		//Right Sidebar
		register_sidebar( array(
			'id'            => 'resort-right-sidebar',
			'name'          => esc_html__( 'Right Sidebar', 'resort' ),
			'description'   => esc_html__( 'Add widgets here to appear in Right sidebar', 'resort' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h5 class="widget_title">',
			'after_title'   => '</h5>',
		) );
		
		//Left Sidebar
		register_sidebar( array(
			'id'            => 'resort-left-sidebar',
			'name'          => esc_html__( 'Left Sidebar', 'resort' ),
			'description'   => esc_html__( 'Add widgets here to appear in Left sidebar', 'resort' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h5 class="widget_title">',
			'after_title'   => '</h5>',
		) );
		
		//Single Room Sidebar
		register_sidebar(
			array(
				'id'            => 'resort-booking',
				'name'          => esc_html__( 'Single Room', 'resort' ),
				'description'   => esc_html__( 'Add widgets here to appear in Room sidebar', 'resort' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s booking_widgets">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h5 class="widget_title">',
				'after_title'   => '</h5>',
			)
		);
			
		//Register  Header side sidebar Widget
			register_sidebar(
				array(
					'id'            => 'header-side-sidebar-widget',
					'name'          => esc_html__( 'Header Side Sidebar Area', 'resort' ),
					'description'   => esc_html__( 'Add widgets here to appear in Header side sidebar', 'resort' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s header_widgets">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h5 class="widget_title">',
					'after_title'   => '</h5>',
				)
			);		
				
			
		//Register Mailchimp Widget
		register_sidebar(
			array(
				'id'            => 'mailchimp-widget',
				'name'          => esc_html__( 'Mailchimp Widget Area', 'resort' ),
				'description'   => esc_html__( 'Add widgets here to appear in Footer Top', 'resort' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s mailchimp-widget">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h5 class="widget_title">',
				'after_title'   => '</h5>',
			)
		);		
				
		// Register Footer Widget
		for ( $footer = 1; $footer < 5; $footer ++ ) {
			register_sidebar( array(
				'id'            => 'resort-footer-' . $footer,
				'name'          => esc_html__( 'Footer ', 'resort' ) . $footer,
				'description'   => esc_html__( 'Add widgets here to appear in Footer widgets area', 'resort' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h4 class="widget_title no_stripe">',
				'after_title'   => '</h4>',
			) );
		}
	}
}

add_action( 'widgets_init', 'resort_register_default_sidebars', 50 );

/**
 * Load custom theme widget.
 */
require get_template_directory() . '/inc/widgets/tmc_posts.php';

/**
 * Load custom theme widget.
 */
require get_template_directory() . '/inc/widgets/tmc_header.php';

/**
 * Load custom theme Get In Touch widget.
 */
require get_template_directory() . '/inc/widgets/tmc_get_in_touch.php';

//Default Home on breadcumb 
// add_filter('bcn_breadcrumb_title', function($title, $type, $id) {
//  if ($type[0] === 'home') {
//   $title = get_the_title(get_option('page_on_front'));
//  }
//  return $title;
// }, 42, 3);

add_action( 'wp_enqueue_scripts', 'resort_load_theme_scripts_and_styles' );

if( ! function_exists( 'resort_load_theme_scripts_and_styles' ) ){
	function resort_load_theme_scripts_and_styles() {

		if ( ! is_admin() ) {

			global $resort_option;
				$resort_option['demo'] = 'demo1';
			
			/* Register Styles */
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', null, RESORT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'resort-style', get_stylesheet_uri(), null, RESORT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'resort-layout', get_template_directory_uri() . '/assets/css/'. $resort_option['demo'] .'/main.css', null, RESORT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'strock-icon', get_template_directory_uri() . '/assets/css/'. $resort_option['demo'] .'/strock-icon.css', null, RESORT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'resort-responsive', get_template_directory_uri() . '/assets/css/'. $resort_option['demo'] .'/responsive.css', null, RESORT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', null, RESORT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css', null, RESORT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.css', null, RESORT_THEME_VERSION, 'all' );
			if(isset($resort_option['rtl_switch']) && $resort_option['rtl_switch']=='1'){
			wp_enqueue_style( 'style-main-rtl', get_template_directory_uri() . '/assets/css/'. $resort_option['demo'] .'/style-main-rtl.css', null, RESORT_THEME_VERSION, 'all' );
			}

			/* Register Scripts */
			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), RESORT_THEME_VERSION, true );
			wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), RESORT_THEME_VERSION, true );
			wp_enqueue_script( 'libs', get_template_directory_uri() . '/assets/js/libs.js', array( 'jquery' ), RESORT_THEME_VERSION, true );
			wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array( 'jquery' ), RESORT_THEME_VERSION, true );
			wp_enqueue_script( 'counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array( 'jquery' ), RESORT_THEME_VERSION, true );
			wp_enqueue_script( 'jquery.mixitup', get_template_directory_uri() . '/assets/js/jquery.mixitup.min.js', array( 'jquery' ), RESORT_THEME_VERSION, true );
			wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), RESORT_THEME_VERSION, true );
			wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), RESORT_THEME_VERSION, true );
			wp_enqueue_script( 'fancyboxs', get_template_directory_uri() . '/assets/js/jquery.fancybox.pack.js', array( 'jquery' ), RESORT_THEME_VERSION, true );
			
			
			/* Enqueue Scripts */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
						
		}

	}
}

// Google fonts
function resort_fonts_url() {
$fonts_url = '';

 /* Translators: If there are characters in your language that are not
* supported by Open Sans, translate this to 'off'. Do not translate
* into your own language.
*/
$open_sans = _x( 'on', 'Open Sans font: on or off', 'resort' );

 /* Translators: If there are characters in your language that are not
* supported by Raleway, translate this to 'off'. Do not translate
* into your own language.
*/
$raleway = _x( 'on', 'Raleway font: on or off', 'resort' );
   
/* Translators: If there are characters in your language that are not
* supported by Open Sans Condensed, translate this to 'off'. Do not translate
* into your own language.
*/
$open_sans_condensed = _x( 'on', 'Open Sans Condensed font: on or off', 'resort' );
 
 /* Translators: If there are characters in your language that are not
* supported by Playball, translate this to 'off'. Do not translate
* into your own language.
*/
$playball = _x( 'on', 'Playball&subset font: on or off', 'resort' ); 

 /* Translators: If there are characters in your language that are not
* supported by PT Serif, translate this to 'off'. Do not translate
* into your own language.
*/
$pt = _x( 'on', 'PT Serif font: on or off', 'resort' ); 
 
	if ( 'off' !== $raleway || 'off' !== $open_sans  ||  'off' !== $open_sans_condensed || 'off' !== $playball || 'off' !== $pt)
	{					
		$font_families = array();
			if ( 'off' !== $raleway )
			{
				$font_families[] = 'Raleway:400,100,200,300,500,600,800,700,900';
			}
			if ( 'off' !== $open_sans ) 
			{
				$font_families[] = 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic';
			}			
			if ( 'off' !== $open_sans_condensed ) 
			{
				$font_families[] = 'Open Sans Condensed:300,300italic,700';
			}
			
			if ( 'off' !== $playball ) 
			{
				$font_families[] = 'Playball';
			}
			
			if ( 'off' !== $pt ) 
			{
				$font_families[] = 'PT Serif:400italic,400';
			}
			
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' )
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	return esc_url_raw( $fonts_url );
}
function resort_scripts_styles() 
{
	wp_enqueue_style( 'fonts', resort_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'resort_scripts_styles' );

if( ! function_exists( 'resort_excerpt_more' ) ){
	function resort_excerpt_more( $more ) {
		return '';
	}
}

add_filter( 'excerpt_more', 'resort_excerpt_more' );


//Default Home on breadcumb 
// add_filter('bcn_breadcrumb_title', function($title, $type, $id) {
//  if ($type[0] === 'home') {
//   $title = get_the_title(get_option('page_on_front'));
//  }
//  return $title;
// }, 42, 3);


// function resort_custom_scripts_styles() 
// {	
// 	global $resort_option;
	
// 	 $custom_css = $resort_option['site_css'];
// 	$css = '';
	
// 	if ( $custom_css ) {
// 		$css .= preg_replace( '/\s+/', ' ', $custom_css );
// 	}
// 	wp_add_inline_style( 'resort-style', $css );
// }
// add_action( 'wp_enqueue_scripts', 'resort_custom_scripts_styles' );


if( ! function_exists( 'resort_body_class' ) ) {
	function resort_body_class( $classes ) {
	global $resort_option;
		$classes[] = tmc_get_header_style();
		

	if(isset($resort_option['layout_style']) && $resort_option['layout_style'] == '2') { 
			$classes[] = 'layout-boxed';
	}

	if(isset($resort_option['sticky_menu']) && $resort_option['sticky_menu'] == '1') { 
			$classes[] = 'sticky_menu';
		}
		return $classes;
	}
}

add_filter( 'body_class', 'resort_body_class' );
define( 'RESORT_INC_PATH', get_template_directory() . '/inc' );
require_once( RESORT_INC_PATH . '/tgm/tgm-plugin-registration.php' );
require_once( RESORT_INC_PATH . '/theme-essential.php' );
require_once( RESORT_INC_PATH . '/visual-composer.php' );

if ( !function_exists( 'resort_extended_import' ) ) {
 function resort_extended_import( $demo_active_import , $demo_directory_path ) {

  reset( $demo_active_import );
  $current_key = key( $demo_active_import );

  //Import Sliders
if ( class_exists( 'RevSlider' ) ) {
    $wbc_sliders_array = array(
        'demo1' => 'home1.zip', //Set slider zip name
		'demo2' => 'home2.zip', //Set slider zip name
		'demo4' => 'home4.zip', //Set slider zip name
    );

    if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
        $wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

        if( is_array( $wbc_slider_import ) ){
            foreach ($wbc_slider_import as $slider_zip) {
                if ( !empty($slider_zip) && file_exists( $demo_directory_path.$slider_zip ) ) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost( true, true, $demo_directory_path.$slider_zip );
                }
            }
        }else{
            if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
                $slider = new RevSlider();
                $slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
            }
        }
    }
}
  
  /************************************************************************
  * Setting Menus
  *************************************************************************/

  // If it's demo1 - demo5

  
  $wbc_menu_array = array( 'demo1','demo2','demo3','demo4','demo5');
			
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$top_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
		  
			if ( isset( $top_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'resort-primary_menu' => $top_menu->term_id					   
					)
				);
			}
		}
		

		
  /************************************************************************
  * Set HomePage
  *************************************************************************/

  // array of demos/homepages to check/select from
  $wbc_home_pages = array(
		'demo1' => 'Home',
		'demo2' => 'HomeV2',
		'demo3' => 'HomeV3',
		'demo4' => 'HomeV4',
		'demo5' => 'HomeV5'
  );

  if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
   $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
   if ( isset( $page->ID ) ) {
    update_option( 'page_on_front', $page->ID );
    update_option( 'show_on_front', 'page' );
   }
  }
  
 }
  add_action( 'wbc_importer_after_content_import', 'resort_extended_import', 10, 2 );
}