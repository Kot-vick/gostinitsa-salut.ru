<?php
$atts = vc_map_get_attributes( 'tmc_testimonialsnew', $atts );
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
					'post_type' => 'Testimonials',
					'post_status' => 'publish',
					'order'          => $order,
					
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
						prevArrow: false,
        				nextArrow: false,
        				responsive: [{
						    breakpoint: 1024,
						    settings: {
						    slidesToShow: '. esc_js($column).'
						    }
						},
						{
						    breakpoint: 769,
						    settings: {
						    slidesToShow: 1
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
	$designataion = get_post_meta(get_the_ID(), '_tmc_testimonial_designation', true );
		$output .= '
		<div class="grid-wrapper grid-'.esc_js($column).'-columns grid-row '. esc_js($carousel_class).'">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
			$output .= ' <div class="our-pro-slider">               
                <div class="pro-sliders">
                <div class="item">
				  <div class="test-cont"><p>'.get_the_content().'</p></div>             
					 <div class="test-bot">
					 <div class="tst-img new-sty">'.get_the_post_thumbnail( get_the_ID(), 'medium-thumb').'</div>
					 <div class="client_name">
						 <h5>'.get_the_title().' - <span></span></h5> ';
												$rating = get_post_meta(get_the_ID(),'_tmc_testimonial_rating', true );
							$output .='<ul>';
							switch($rating){
							case '':
                               $output .='<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li><br/><img src="https://gostinitsa-salut.ru/wp-content/uploads/logo.jpg" alt="Отзывы оставлены с сайта Booking.com">';
								break;
								case 'star1':
                               $output .='<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li><br/><img src="https://gostinitsa-salut.ru/wp-content/uploads/logo.jpg" alt="Отзывы оставлены с сайта Booking.com">';
								break;
								case 'star2':
                                $output .='<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li><br/><img src="https://gostinitsa-salut.ru/wp-content/uploads/logo.jpg" alt="Отзывы оставлены с сайта Booking.com">';
								break;
								case 'star3':
                                $output .='<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li><br/><img src="https://gostinitsa-salut.ru/wp-content/uploads/logo.jpg" alt="Отзывы оставлены с сайта Booking.com">';
								break;
								case 'star4':
                                $output .='<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li><br/><img src="https://gostinitsa-salut.ru/wp-content/uploads/logo.jpg" alt="Отзывы оставлены с сайта Booking.com">';
								break;
								case 'star5':
                                $output .='<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li><br/><img src="https://gostinitsa-salut.ru/wp-content/uploads/logo.jpg" alt="Отзывы оставлены с сайта Booking.com">';
								break;                               
							}
                            $output .='</ul>
					 </div>
					 </div>
				  </div></div>
				  </div>
				  ';
			if ( $layout == 'grid' ) {
				if ( $count % $column == 0 ) $output .= '
				<div class="clear"></div>';
			}
		endwhile;
		$output .= '
		</div>';
		else:
			$output .= __( 'Sorry, there is no child pages under your selected page.', 'resort' );
	endif;
	
	wp_reset_postdata();
		
	$output .= '
	</div>';

	echo $output;
	?>