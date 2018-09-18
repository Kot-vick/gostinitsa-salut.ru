<?php 
$atts = vc_map_get_attributes( 'tmc_ourlatestproject', $atts );
	extract( $atts );
	$output = null;	
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
	$output = '';
	$count  = 0;
	
	$args = array(
					'post_type' => 'projects',
					'post_status' => 'publish',
					'order'          => $order,
					'posts_per_page' => $number
				);
    $the_service = new WP_Query( $args );
	
	if ( $the_service->have_posts() ) :
		$output .= '
		<div class="grid-wrapper grid-'.esc_attr($column).'-columns grid-row '. esc_attr($carousel_class) .' row">';
     
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;				 				 
				$output .= '<div class="col-sm-4 lp-gallery-item gallery-item">
				<div class="row this-inner">
					'.get_the_post_thumbnail( get_the_ID(), 'medium-thumb').'
					<div class="this-infos">
						<div class="infos-inner">
							<h4 class="this-title">'.get_the_title().'</h4>
							<a href="'. get_the_permalink() .'" class="this-link btn btn-primary">View project</a>
						</div>
					</div>
				</div>
			</div>';		
		endwhile;

		$output .= '</div>';
		else:
			$output .= __( 'Sorry, there is no child pages under your selected page.', 'resort' );
	endif;
	
	wp_reset_postdata();
	echo $output;	
?>