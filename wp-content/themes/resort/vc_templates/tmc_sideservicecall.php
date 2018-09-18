<?php 
$atts = vc_map_get_attributes( 'tmc_sideservicecall', $atts );
	extract( $atts );	 
	$header_address = get_theme_mod( 'header_address', wp_kses( __( "<strong>1010 Avenue of the Moon</strong>\n<span>New York, NY 10018 US.</span>", 'resort' ), array( 'br' => array(), 'strong' => array(), 'span' => array() ) ) );
	$output = '<div class="row banner-row">
					<a href="'. get_the_permalink() .'">
						<div class="btop-box row">
							<h2 class="this-cursive">Shedule</h2>
							<h4 class="this-stitle">an appointment</h4>
							<h2 class="this-title">today!</h2>
						</div>
						<p>'.esc_attr($el_text).'</p>
						<h3 class="bphone">'.esc_attr($header_address).'</h3>
						<img src="'.get_template_directory_uri().'/assets/images/banner.png" alt="" class="bovelay-img">
					</a>
				</div>';
	echo $output;
	
?>