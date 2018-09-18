<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till 
 *
 * @package tmchampion
 */
global $resort_option;

?>

<?php
	if(isset($resort_option['rtl_switch']) && $resort_option['rtl_switch']=='1'){					
	
		$rtl = 'rtl';	
		
		} else{
			$rtl = '';
		}			
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" dir="<?php echo esc_attr($rtl); ?>">
<head>
	<link href="<?php echo get_template_directory_uri() ?>/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="yandex-verification" content="2989ffe5d982b8da" />
	<link rel="profile" href="http://gmpg.org/xfn/11">	
	<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ): ?>
	<link rel="icon" type="image/png" href="<?php echo esc_url($resort_option['favicon_icon']['url']); ?>"/>
	<?php endif; ?>	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
<body <?php body_class(); ?>>

  <section class="side-menu" id="sidebarCollapse">
    	<button class="close-button" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-expanded="false" aria-controls="sidebarCollapse"><i class="fa fa-times"></i></button>
       <?php dynamic_sidebar( 'header-side-sidebar-widget' ); ?>

    </section><!-- /.side-menu -->

	<?php 
	if(isset($resort_option['layout_style']) && $resort_option['layout_style'] == '2') { 
			$class_name = 'boxed-container';
	} else { 
			$class_name = 'boxed-full';
	 } ?>
	
<div id="wrapper" class="<?php echo esc_attr($class_name); ?>">
	<div class="content_wrapper">
			<?php global $logo_tmp_src; ?>
			<?php  if(!empty($resort_option['header_style'])){	
					
						$headear = $resort_option['header_style'];			
				
					} else {				
						$headear ='tmc_header_1';
					}
			?>
			<header id="header">
				<?php 
				// passing header value in header_layout function &call
				 header_layout($headear);
				 ?>
			
				<!---Start code for header for mobile layout -->				
					<?php get_template_part( 'headers/mobile_header' ); ?>
				<!---End code for mobile layout -->			
			</header><!-- end header -->
			
		<!-- function for header styles  -->
			
			<!-- Start main -->
			<div id="main">		
				<?php 
				if(is_page('gallery-one')){
					echo do_shortcode('[rev_slider alias="svadba"]');
				}elseif ( ! is_front_page() && ! is_404() ) {
					page_title();
				}
				 ?>		
			 
				<div class="container main-container" <?php if(is_page('gallery-one')){ echo 'style="padding-top:20px !important"';}?>>
				