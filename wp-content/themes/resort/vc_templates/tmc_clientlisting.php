<?php
$atts = vc_map_get_attributes( 'tmc_clientlisting', $atts );
	extract( $atts );
$col_class = $thumbnail = '';
	if ( $column == 2 ) {
		$col_class = "grid-sm-6";
	} elseif ( $column == 3 ){
		$col_class = "grid-sm-6 grid-md-4";
	} elseif ( $column == 4 ) {
		$col_class = "grid-sm-6 grid-md-3";
	} else {
		$col_class = "grid-sm-6";
	}
	$count  = 0;
	$exclude_ids = null;
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
					'post_type' => 'clients',
					'post_status' => 'publish',
					'order'          => $order,			
					'posts_per_page' => $number
				);
    $post = new WP_Query( $args );
	$carousel_class = '';
	if ( $layout == 'carousel' ) {		
		$carousel_class = 'carousel-wrapper-'.uniqid();
			?>
			<script type="text/javascript">	
				jQuery(document).ready(function(){					
					"use strict";
					jQuery(".<?php echo esc_js( $carousel_class ); ?>").slick({
						rtl: <?php echo esc_js( $slick_rtl ); ?>,
						slidesToShow: <?php echo esc_js( $column ); ?>,
                        autoplay: <?php echo esc_js( $carousel_autoplay ); ?>,
                        autoplaySpeed: <?php echo esc_js( $carousel_autoplay_speed ); ?> ,
                        speed: <?php echo esc_js( $carousel_speed ); ?>,
						slidesToScroll: 1,
						draggable: false,
						prevArrow: "<span class=\'carousel-prev\'><i class=\'fa fa-angle-left\'></i></span>",
        				nextArrow: "<span class=\'carousel-next\'><i class=\'fa fa-angle-right\'></i></span>",
        				responsive: [{
						    breakpoint: 1024,
						    settings: {
						    slidesToShow: <?php echo esc_js( $column ); ?>
						    }
						},
						{
						    breakpoint: 801,
						    settings: {
						    slidesToShow: 3
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
			</script>
	<?php
	}
	if ( $post->have_posts() ) :
		?>
		<div class="grid-wrapper grid-<?php esc_attr($column);?>-columns grid-row "><div class= "our-team-page <?php echo esc_attr($carousel_class);?>">
<?php
		while ( $post->have_posts() ) : $post->the_post(); $count++;
		?>
			<div class="our-pro-slider">   
                <div class="pro-sliders">
                <div class="item item-client">
                    <div class="post-image our-t-client">
						<?php echo get_the_post_thumbnail( get_the_ID(), 'medium-thumb');?>
                    </div>
                </div>
            </div>     
            </div>
				<?php   
			if ( $layout == 'grid' ) {
				if ( $count % $column == 0 )
				?>
				<div class="clear"></div>
			<?php
			}
		endwhile;
?>
		   </div>  </div>
		   <?php 
		else:
		?>
			<div><?php esc_attr( 'Sorry, Client listing is not available under the selected page.', 'resort' );?></div>
			<?php
	endif;
	wp_reset_postdata();
	?>