<?php
$atts = vc_map_get_attributes( 'tmc_testimonialslisting_new', $atts );
	extract( $atts );

	$output = null;
	$output .= '
	<div class="child-page-wrapper '. esc_attr($el_class) .'">';
	$count  = 0;	
	$exclude_ids = null;
	$slick_rtl = 'false';
	if ( is_rtl() ){
		$slick_rtl = 'true';
	}
	$args = array(
					'post_type' => 'testimonials',
					'post_status' => 'publish',
					'order'          => $order
				);
    $the_service = new WP_Query( $args );
	if ( $the_service->have_posts() ) :
	$designataion = get_post_meta(get_the_ID(), '_tmc_testimonial_designation', true );
		$output .= '<div class="thm-container clearfix"><div class="row">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
				$output .= '<div class="col-lg-12 testimonial-col-p">
                <div class="media testimonial-p gap-pad">
                    <div class="media-left">
                        <a href="#">
							 '. get_the_post_thumbnail( get_the_ID(), array( 140, 153) ).'
                        </a>
                    </div>
                    <div class="media-body testimonial-p">
                        <p>'.get_the_content().'</p>
                        <a>-'.get_the_title().'<span>&nbsp;('.get_post_meta(get_the_ID(), '_tmc_testimonial_designation', true ).')</span></a>
									
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

	$output .= '
	</div>';
	echo $output;
	?>