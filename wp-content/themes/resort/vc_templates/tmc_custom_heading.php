<?php
$atts = vc_map_get_attributes( 'tmc_custom_heading', $atts );	extract( $atts );
	$heading_style_color = '';
	if ( $heading_color ) {
		$heading_style_color ='style="color:'. esc_attr($heading_color) .';"';
	}
	$extract_class = '';
	if ( $el_class ) $extract_class = $el_class;
	$position_class = '';
	if ( $position == 'right' ) $position_class = ' text-right';
	if ( $position == 'center' ) $position_class = ' text-center';
	$heading_size = '';
	if ( $size     == 'medium' ) $heading_size = ' heading-medium';
	if ( $size == 'small' ) $heading_size = ' heading-small';
	// Custom Style
	$custom_styles = array();
		if ( $margin_top ) {
			$custom_styles[] = 'margin-top: ' . intval($margin_top) . 'px;';
		}
		if ( $margin_bottom ) {
			$custom_styles[] = 'margin-bottom: ' . intval($margin_bottom) . 'px;';
		}
	$custom_styles = implode('', $custom_styles);
	if ( $custom_styles ) {
		$custom_styles = wp_kses( $custom_styles, array() );
		$custom_styles = ' style="' . esc_attr($custom_styles) . '"';
	}
	$line_class = '';
	$line_color_custom = '';
	if ( $line_color == 'primary' ) {
		$line_class = 'primary';
	}
	if ( $line_color == 'secondary' ) {
		$line_class = 'secondary';
	}
	if ( $line_color == 'custom' ) {
		$line_class = '';
	}
	if ( $line_custom_color && $line_color == 'custom' )
		$line_color_custom = 'style="background-color:'.esc_attr($line_custom_color).'"';
?>
	<div class="custom-heading wpb_content_element <?php echo esc_attr($extract_class) . esc_attr($heading_size) . esc_attr($position_class) . esc_attr($custom_styles);?>" >
<?php if ( $heading ) ?>
		<h2 class="heading-title" <?php echo esc_attr($heading_style_color); ?> > <?php echo wp_kses_post($heading); ?> </h2>
	</div>
