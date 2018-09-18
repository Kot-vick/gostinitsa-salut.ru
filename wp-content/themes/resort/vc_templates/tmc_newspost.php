<?php
$atts = vc_map_get_attributes( 'tmc_newspost', $atts );
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
					'post_type' => 'post',
					'post_status' => 'publish',
					'order'          => $order,
					'orderby'        => $orderby,
					'posts_per_page' => $number
				);
    $the_service = new WP_Query( $args );

	$carousel_class = '';
	if ( $layout == 'carousel' ) {
		$carousel_class = 'carousel-wrapper-'.uniqid();
			$output .= '';
	}
	if ( $the_service->have_posts() ) :
		$output .= '<div class="container1 clearfix">
		<div class="grid-wrapper grid-'.esc_attr($column).'-columns grid-row">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
			$output .= ' 
						<div class="col-md-4 col-sm-4 col-xs-12 resp-sp-width-980">
						<div class="news-evn-img"><a href="'. get_the_permalink() .'">'.get_the_post_thumbnail( get_the_ID(), 'medium-thumb').'</a>
						<div class="event-date"><h3>'.get_the_date('d').' <small>'.get_the_date('M').'</small></h3></div>
						</div>
						<div class="news-evn-cont">
						<div class="news-meta">
						<a href="#">  By: ' .get_the_author().'</a> <a href="'. get_the_permalink() .'"> Comments: 6</a>
					</div>
						<a href="'. get_the_permalink() .'"><h3>'.get_the_title().'</h3></a>

						<div>'.get_the_content().'</div>
						
					
						</div>
						</div> ';


			if ( $layout == 'grid' ) {
				if ( $count % $column == 0 ) $output .= '
				<div class="clear"></div>';
			}
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