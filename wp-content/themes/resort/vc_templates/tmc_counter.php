<?php
	$atts = vc_map_get_attributes( 'tmc_counter', $atts );
	extract( $atts );
	$output = null;
	$output .= '<div class="container">
	<div class="child-page-wrapper '. esc_attr($el_class) .'">';
	
	$output .= '<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="single-count-box">
					<span class="decor-line"></span>
					<div class="box">
						<div class="number-box">
							<span class="counter">'. $counter_value1 .'</span>
						</div>
						<div class="text-box">
							<p>'. $right_text1 .'</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="single-count-box">
					<span class="decor-line"></span>
					<div class="box">
						<div class="number-box">
							<span class="counter">'. $counter_value2 .'</span>
						</div>
						<div class="text-box">
							<p>'. $right_text2 .'</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="single-count-box">
					<span class="decor-line"></span>
					<div class="box">
						<div class="number-box">
							<span class="counter">'. $counter_value3 .'</span>
						</div>
						<div class="text-box">
							<p>'. $right_text3 .'</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="single-count-box">
					<span class="decor-line"></span>
					<div class="box">
						<div class="number-box">
							<span class="counter">'. $counter_value4 .'</span>
						</div>
						<div class="text-box">
							<p>'. $right_text4 .'</p>
						</div>
					</div>
				</div>
			</div>';
$output .= '
			<script type="text/javascript">
			jQuery( document ).ready(function() {
			jQuery(".counter") .counterUp({
            delay: 10,
            time: 3000,
			})});
			</script>';	
		

	wp_reset_postdata();
	
	
	$output .= '</div>
	</div>';

	echo $output;
	?>