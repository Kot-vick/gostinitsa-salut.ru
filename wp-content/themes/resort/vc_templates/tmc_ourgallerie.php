<?php $atts = vc_map_get_attributes( 'tmc_ourgallerie', $atts );
	extract( $atts );
	$output = null;
	$output .= '
	<div class="child-page-wrapper '. esc_attr($el_class) .'">';
	
	
	
	if ( $readmore_text == '' )
	{
		$readmore_text = __('Read More', 'resort');
	}

	$col_class = $thumbnail = '';
	if ( $column == 2 ) {
		$col_class = "grid-sm-6";
	} elseif ( $column == 3 ){
		$col_class = "grid-sm-6 grid-md-4";
	} elseif ( $column == 4 ) {
		$col_class = "grid-sm-6 grid-md-3";
	} else {
		$col_class = "grid-sm-6 grid-md-4";
	}
	$count  = 0;

	$slick_rtl = 'false';
	if ( is_rtl() ){
		$slick_rtl = 'true';
	}

    if ( $carousel_autoplay == 'yes' ) {
        $carousel_autoplay = 'true';
    } else {
        $carousel_autoplay = 'false';
    }

    if ( $carousel_autoplay_speed == '' ) {
        $carousel_autoplay_speed = '3000';
    }

    if ( $carousel_speed == '' ) {
        $carousel_speed = '300';
    }

	$args = array(
					'post_type' => 'gallery',
					'post_status' => 'publish',
					'order'          => $order,
					'orderby'        => $orderby,
					'posts_per_page' => $number
				);
    $the_service = new WP_Query( $args );

	$carousel_class = '';
	if ( $layout == 'carousel' ) {
		$carousel_class = 'carousel-wrapper-'.uniqid();
			$output .= '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					"use strict";
					jQuery(".'. esc_js($carousel_class) .'").slick({
						rtl: '. esc_js($slick_rtl) .',
						slidesToShow: '. esc_js($column) .',
                        autoplay: '. esc_js($carousel_autoplay) .' ,
                        autoplaySpeed: '. esc_js($carousel_autoplay_speed) .' ,
                        speed: '. esc_js($carousel_speed) .' ,
						slidesToScroll: 1,
						draggable: false,
						prevArrow: "<span class=\'carousel-prev\'><i class=\'fa fa-angle-left\'></i></span>",
        				nextArrow: "<span class=\'carousel-next\'><i class=\'fa fa-angle-right\'></i></span>",
        				responsive: [{
						    breakpoint: 1024,
						    settings: {
						    slidesToShow: '. esc_js($column) .'
						    }
						},
						{
						    breakpoint: 981,
						    settings: {
						    slidesToShow: 2
						    }
						},
						{
						    breakpoint: 600,
						    settings: {
						    slidesToShow: 2
						    }
						},
						{
						    breakpoint: 480,
						    settings: {
						    slidesToShow: 1
						    }
						}]
					});
				});
			</script>';
	}
	if ( $the_service->have_posts() ) :
		$output .= '
		     <div class="fullwidth-silder">
        
        <div class="fullwidth-slider">
		<div class="grid-wrapper our-gallery grid-'.esc_attr($column).'-columns grid-row '. esc_attr($carousel_class) .'  '. esc_attr($el_class) .'">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
			$output .= ' 
			
							<div class="item">
				'.get_the_post_thumbnail( get_the_ID(), 'medium-thumb').'
				<div class="this-overlay">
					<div class="this-texts">
						<a href="'.types_render_field( "url_guest", array( ) ).'" class="fancybox" rel="our-gallery"><i class="icon icon-Search"></i></a>
						<h4 class="this-title">'. get_the_title() .'</h4>
					</div>
				</div>
			</div>';
			
			if ( $layout == 'grid' ) {
				if ( $count % $column == 0 ) $output .= '
				<div class="clear"></div>';
			}
		endwhile;
		$output .= '
		</div>
		</div>
		</div>';
		else:
			$output .= __( 'Sorry, there is no child pages under your selected page.', 'resort' );
	endif;
	
	wp_reset_postdata();
	
	
	
		$output .= '
	</div>';

	echo $output;
	?>
	
