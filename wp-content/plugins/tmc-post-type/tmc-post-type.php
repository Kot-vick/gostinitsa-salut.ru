<?php
/*
Plugin Name: TMC Post Type
Plugin URI:
Description: TMC Post Type
Author:
Author URI:
Text Domain: tmc_post_type
Version: 1.0
*/


function custom_post_type_init() {

  register_post_type(
    'sidebar', array(
      'labels' => array('name' => __( 'Sidebar' ), 'singular_name' => __( 'sidebar' ) ),
      'public' => true,
	  'menu_icon' => 'dashicons-schedule',
      'supports' => array( 'title', 'editor' ), 
	  'exclude_from_search' => true, 
	  'publicly_queryable' => false 
    )
  );

  register_post_type(
    'gallery', array(
      'labels' => array('name' => __( 'Gallery' ), 'singular_name' => __( 'gallery' ) ),
      'public' => true,
	  'menu_icon' => 'dashicons-portfolio',
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt')
    )
  );
   

   register_post_type(
    'testimonials', array(
      'labels' => array('name' => __( 'Testimonials' ), 'singular_name' => __( 'testimonials' ) ),
      'public' => true,
	  'menu_icon' => 'dashicons-testimonial',
      'has_archive' => true,
      'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt' ) ,
    )
  );
  

  
}
add_action( 'init', 'custom_post_type_init' );


function custom_post_type_tax_init() {
	
	register_taxonomy(
		'gallery-category',
		'gallery',
		array(
			'label' => __( 'Categories' ),
			'rewrite' => array( 'slug' => 'gallery' ),
			'hierarchical' => true,
		)
	);
}
add_action( 'init', 'custom_post_type_tax_init' );
?>