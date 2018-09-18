
<?php $atts = vc_map_get_attributes( 'tmc_room_grid', $atts );
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

	if ( $the_service->have_posts() ) :
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		
				$min = '';
				$prices = hb_room_get_selected_plan( get_the_ID() );
				$prices = isset( $prices->prices ) ? $prices->prices : array();
				 if ($prices){
					 $min = min( $prices );
				 }
				$content = wp_trim_words( get_the_content(), $num_words = 20, $more = null );
				if($count%2 != 0)		
				{
				$output .= '<div class="room-t-wrapper">
					<div class="col-lg-7 col-md-12 img-wrap">
					<div class="img-holder trans-no">'.get_the_post_thumbnail( get_the_ID(), 'medium-thumb',array('class' => 'alignnone trans-no size-full')).'</div>
					</div>
					<div class="col-lg-5 col-md-12 content negative-padding">
					<h2>'.get_the_title().'</h2>
					<p>'.$content.'</p>
					<div class="bottom-content">
					<div class="pull-left as-marginincrease-responsive">
					<p>'.hb_format_price($min).'<span class="span">Сутки</span></p>
					</div>
					<div class="pull-right as-marginincrease-responsive-2 "><a href="'.get_permalink().'">Просмотреть</a></div>
					</div>
					</div>
					</div>';
				  
				  } else {
					  
					  $output .= '<div class="room-t-wrapper room-l-wrapper">
						<div class="col-lg-5 col-md-12 content">
						<h2>'.get_the_title().'</h2>
						<p>'.$content.'</p>
						<div class="bottom-content">
						<div class="pull-left as-marginincrease-responsive">

						<p>'.hb_format_price($min).'<span class="span">Сутки</span></p>

						</div>
						<div class="pull-right as-marginincrease-responsive-2"><a href="'.get_permalink().'">Просмотреть</a></div>
						</div>
						</div>
						<div class="col-lg-7 col-md-12 img-wrap">
						<div class="img-holder">'.get_the_post_thumbnail( get_the_ID(), 'medium-thumb',array('class' => 'alignnone trans-no size-full')).'</div>
						</div>
						</div>';
				  }


		endwhile;
		else:
			$output .= __( 'Sorry, there is no child pages under your selected page.', 'resort' );
	endif;	
	wp_reset_postdata();
	echo $output; ?>