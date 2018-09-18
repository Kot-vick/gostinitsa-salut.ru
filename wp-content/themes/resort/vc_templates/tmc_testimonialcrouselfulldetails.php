<?php 
$atts = vc_map_get_attributes( 'tmc_testimonialcrouselfulldetails', $atts );
	extract( $atts );
	$output = null;
	$output .= '
	<div class="child-page-wrapper '. esc_attr($el_class) .'">';
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
					'post_type' => 'testimonials',
					'post_status' => 'publish',
					'order'          => $order
				);
    $the_service = new WP_Query( $args );

	
			$output .= '<script type="text/javascript">
			var jQuery = jQuery.noConflict();
    jQuery(document).on("ready", function() {
      jQuery(".regular").slick({
        dots: false,
        infinite: true,
		draggable: true,
        slidesToScroll: 1,
		autoplay: '. esc_js($carousel_autoplay).' ,
		autoplaySpeed: '. esc_js($carousel_autoplay_speed) .' ,
		speed: '. esc_js($carousel_speed) .' ,
		prevArrow: false,
		nextArrow: false
      });
     
    });
	
</script>';
	
	if ( $the_service->have_posts() ) :
		$designataion = get_post_meta(get_the_ID(), '_tmc_testimonial_designation', true );
		$output .= '
		<div class="testimonial-sec"> <div class="testimonial-slider regular slider">';
     
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;

				$output .= '<div class="item">
				  <div class="test-cont"><p>'.get_the_content().'</p></div>             
					 <div class="test-bot">
					 <div class="tst-img">'.get_the_post_thumbnail( get_the_ID(), 'medium-thumb').'</div>
					 <div class="client_name">
						 <h5>'.get_the_title().' </h5>';
						
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
				  </div>';
		endwhile;
		$output .= '
		</div></div></div>';
		else:
			$output .= __( 'Sorry, there is no child pages under your selected page.', 'resort' );
	endif;	
	wp_reset_postdata();
	echo $output;
	?>