
<?php $atts = vc_map_get_attributes( 'tmc_rooms2', $atts );
	extract( $atts );
	$output = null;
	$output .= '';
$output = '';
$output .= '
	<div class="child-page-wrapper '. esc_attr($el_class) .'">';
	$count  = 0;
	$slick_rtl = 'false';
	if ( is_rtl() ){
		$slick_rtl = 'true';
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
					'post_type' => 'hb_room',
					'post_status' => 'publish',
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
						draggable: true,
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
		<div class="grid-wrapper room-slider grid-'.esc_attr($column).'-columns grid-row '. esc_attr($carousel_class) .'">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		
				$min = '';
				$prices = hb_room_get_selected_plan( get_the_ID() );
				$prices = isset( $prices->prices ) ? $prices->prices : array();
				 if ($prices){
					 $min = min( $prices );
				 }
		
				$output .= '<div class="item '.$col_class.'">            
					 <div class="room-suite">
						 <div class="item">
						  <a href="'.get_permalink().'">
						 <div class="ro-img">'.get_the_post_thumbnail( get_the_ID(), 'medium-thumb').'</div>
						 <div class="ro-txt">
							 <div class="left-h pull-left"><p>'.get_the_title().'</p></div>
							 <div class="right-p pull-right"><p>'.hb_format_price($min).'<span>Сутки</span></p></div>
							 </div>
							 </a>
						 </div>						 
						</div>
				  </div>';

		endwhile;
		$output .= '
		</div></div>';
		else:
			$output .= __( 'Sorry, there is no child pages under your selected page.', 'resort' );
	endif;	
	wp_reset_postdata();
	echo $output; ?>