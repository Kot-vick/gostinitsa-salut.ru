<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
wp_enqueue_style( 'resort-animate.min.css' );
?>
<div class="tmc_animation tmc_viewport" style="" data-animate="<?php echo esc_attr( $animation ); ?>" data-animation-delay="<?php echo esc_attr( $animation_delay ); ?>" data-animation-duration="<?php echo esc_attr( $animation_duration ); ?>" data-viewport_position="<?php echo esc_attr( $viewport_position ); ?>" >
	<?php echo do_shortcode($content); ?>
</div>