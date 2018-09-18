

<?php $atts = vc_map_get_attributes( 'tmc_room_list', $atts );
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
	
	

	$args = array(
					'post_type' => 'hb_room',
					'post_status' => 'publish',
				);
    $the_service = new WP_Query( $args );

	
	
	$output .= '<div class="row nasir-room-grid">
								<div class="container">
									<div class="row">';
	
	
	if ( $the_service->have_posts() ) :
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		$price_old = types_render_field( "price-room", array( ) );
		$price_room = types_render_field( "new-price", array( ) );
				$min = '';
				$prices = hb_room_get_selected_plan( get_the_ID() );
				$prices = isset( $prices->prices ) ? $prices->prices : array();
				 if ($prices){
					 $min = min( $prices );
				 }
				$content = wp_trim_words( get_the_content(), $num_words = 15, $more = null );

				$output .= '<div class="col-sm-4 nroom-grid">
								<a href="'.get_permalink().'" class="room-img">'.get_the_post_thumbnail( get_the_ID(), 'medium-thumb').'</a>
								<div class="row this-conts">
									<div class="media">
										<div class="media-body this-title">'.get_the_title().'</div>
										<div class="media-right">
											'.$price_old.' <i class="fa fa-rub" aria-hidden="true"></i> <small>'. esc_html__('Сутки','resort').'</small>
											
										</div>
									</div>
									<p>'.$content.'</p>
									<a href="'.get_permalink().'" class="read-more">'. esc_html__('Просмотреть','resort').'<i class="fa fa-arrow-right"></i></a>
								</div>
							</div>';

		endwhile;
		
		
		$output .= '</div>
						</div>
							</div>';
		else:
			$output .= __( 'Sorry, there is no child pages under your selected page.', 'resort' );
	endif;	
	wp_reset_postdata();
	echo $output; ?>