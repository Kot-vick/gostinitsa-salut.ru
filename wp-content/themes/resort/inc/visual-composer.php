<?php
if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
	vc_set_default_editor_post_types( array(
		'page','post','testimonials','gallery','sidebar'
	) );
}

add_action( 'vc_before_init', 'resort_vc_set_as_theme' );

if( ! function_exists( 'resort_vc_set_as_theme' ) ) {
	function resort_vc_set_as_theme() {
		vc_set_as_theme( true );
	}
}

if( ! function_exists( 'resort_animator_param' ) ){
	function resort_animator_param( $settings, $value ) {
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}
		$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$type       = isset( $settings['type'] ) ? $settings['type'] : '';
		$class      = isset( $settings['class'] ) ? $settings['class'] : '';
		$animations = json_decode( $wp_filesystem->get_contents( get_template_directory() . '/assets/js/animate-config.json' ), true );
		if ( $animations ) {
			$output = '<select name="' . esc_attr( $param_name ) . '" class="wpb_vc_param_value ' . esc_attr( $param_name . ' ' . $type . ' ' . $class ) . '">';
			foreach ( $animations as $key => $val ) {
				if ( is_array( $val ) ) {
					$labels = str_replace( '_', ' ', $key );
					$output .= '<optgroup label="' . ucwords( esc_attr( $labels ) ) . '">';
					foreach ( $val as $label => $style ) {
						$label = str_replace( '_', ' ', $label );
						if ( $label == $value ) {
							$output .= '<option selected value="' . esc_attr( $label ) . '">' . esc_html( $label ) . '</option>';
						} else {
							$output .= '<option value="' . esc_attr( $label ) . '">' . esc_html( $label ) . '</option>';
						}
					}
				} else {
					if ( $key == $value ) {
						$output .= "<option selected value=" . esc_attr( $key ) . ">" . esc_html( $key ) . "</option>";
					} else {
						$output .= "<option value=" . esc_attr( $key ) . ">" . esc_html( $key ) . "</option>";
					}
				}
			}

			$output .= '</select>';
		}

		return $output;
	}
}

add_filter( 'vc_google_fonts_get_fonts_filter', 'resort_vc_google_fonts', 10, 1 );

add_action( 'admin_init', 'resort_update_existing_shortcodes' );

if ( ! function_exists( 'resort_update_existing_shortcodes' ) ) {
	function resort_update_existing_shortcodes() {

		if ( function_exists( 'vc_add_params' ) ) {

			vc_add_params( 'vc_gallery', array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Gallery type', 'resort' ),
					'param_name' => 'type',
					'value'      => array(
						__( 'Image grid', 'resort' )     => 'image_grid',
						__( 'Slick slider', 'resort' )   => 'slick_slider',
						__( 'Slick slider 2', 'resort' ) => 'slick_slider_2'
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Thumbnail size', 'resort' ),
					'param_name' => 'thumbnail_size',
					'dependency' => array(
						'element' => 'type',
						'value'   => array( 'slick_slider_2' )
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'resort' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'resort' )
				)
			) );

			vc_add_params( 'vc_column_inner', array(
				array(
					'type'        => 'column_offset',
					'heading'     => esc_html__( 'Responsiveness', 'resort' ),
					'param_name'  => 'offset',
					'group'       => esc_html__( 'Width & Responsiveness', 'resort' ),
					'description' => esc_html__( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'resort' )
				)
			) );

			vc_add_params( 'vc_separator', array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Type', 'resort' ),
					'param_name' => 'type',
					'value'      => array(
						esc_html__( 'Type 1', 'resort' ) => 'type_1',
						esc_html__( 'Type 2', 'resort' ) => 'type_2'
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'resort' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'resort' )
				),
			) );

			vc_add_params( 'vc_video', array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Video Width', 'resort' ),
					'param_name' => 'size'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Preview Image', 'resort' ),
					'param_name' => 'image'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image Size', 'resort' ),
					'param_name'  => 'img_size',
					'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "projects_gallery" size.', 'resort' )
				),
			) );

			vc_add_params( 'vc_wp_pages', array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'resort' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'resort' )
				)
			) );

			vc_add_params( 'vc_custom_heading', array(
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'resort' ),
					'param_name' => 'icon',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Icon Size (px)', 'resort' ),
					'param_name' => 'icon_size',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Position', 'resort' ),
					'param_name' => 'icon_pos',
					'value'      => array(
						esc_html__( 'Left', 'resort' ) => '',
						esc_html__( 'Right', 'resort' ) => 'right',
						esc_html__( 'Top', 'resort' ) => 'top',
						esc_html__( 'Bottom', 'resort' ) => 'bottom'
					),
					'weight'     => 1
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Subtitle', 'resort' ),
					'param_name' => 'subtitle',
					'weight'     => 1
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Subtitle - Color', 'resort' ),
					'param_name' => 'subtitle_color',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Stripe - Position', 'resort' ),
					'param_name' => 'stripe_pos',
					'value'      => array(
						esc_html__( 'Bottom', 'resort' ) => 'bottom',
						esc_html__( 'Between Title and Subtitle', 'resort' ) => 'between',
						esc_html__( 'Hide', 'resort' ) => 'hide'
					),
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Font weight', 'resort' ),
					'param_name' => 'tmc_title_font_weight',
					'value'      => array(
						esc_html__( 'Select', 'resort' )    => '',
						esc_html__( 'Thin', 'resort' )      => 100,
						esc_html__( 'Light', 'resort' )     => 300,
						esc_html__( 'Regular', 'resort' )   => 400,
						esc_html__( 'Medium', 'resort' )    => 500,
						esc_html__( 'Semi-bold', 'resort' ) => 600,
						esc_html__( 'Bold', 'resort' )      => 700,
						esc_html__( 'Black', 'resort' )     => 900
					),
					'weight'     => 1
				)
			) );

			vc_add_params( 'vc_basic_grid', array(
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Gap', 'resort' ),
					'param_name'       => 'gap',
					'value'            => array(
						esc_html__( '0px', 'resort' )  => '0',
						esc_html__( '1px', 'resort' )  => '1',
						esc_html__( '2px', 'resort' )  => '2',
						esc_html__( '3px', 'resort' )  => '3',
						esc_html__( '4px', 'resort' )  => '4',
						esc_html__( '5px', 'resort' )  => '5',
						esc_html__( '10px', 'resort' ) => '10',
						esc_html__( '15px', 'resort' ) => '15',
						esc_html__( '20px', 'resort' ) => '20',
						esc_html__( '25px', 'resort' ) => '25',
						esc_html__( '30px', 'resort' ) => '30',
						esc_html__( '35px', 'resort' ) => '35',
						esc_html__( '40px', 'resort' ) => '40',
						esc_html__( '45px', 'resort' ) => '45',
						esc_html__( '50px', 'resort' ) => '50',
						esc_html__( '55px', 'resort' ) => '55',
						esc_html__( '60px', 'resort' ) => '60',
					),
					'std'              => '30',
					'description'      => esc_html__( 'Select gap between grid elements.', 'resort' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				)
			) );

			vc_add_params( 'vc_btn', array(
				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Color', 'resort' ),
					'param_name'         => 'color',
					'description'        => esc_html__( 'Select button color.', 'resort' ),
					'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
					'value'              => array(
						                        esc_html__( 'Theme Style 1', 'resort' )     => 'theme_style_1',
						                        esc_html__( 'Theme Style 2', 'resort' )     => 'theme_style_2',
						                        esc_html__( 'Theme Style 3', 'resort' )     => 'theme_style_3',
						                        esc_html__( 'Theme Style 4', 'resort' )     => 'theme_style_4',
						                        esc_html__( 'Classic Grey', 'resort' )      => 'default',
						                        esc_html__( 'Classic Blue', 'resort' )      => 'primary',
						                        esc_html__( 'Classic Turquoise', 'resort' ) => 'info',
						                        esc_html__( 'Classic Green', 'resort' )     => 'success',
						                        esc_html__( 'Classic Orange', 'resort' )    => 'warning',
						                        esc_html__( 'Classic Red', 'resort' )       => 'danger',
						                        esc_html__( 'Classic Black', 'resort' )     => 'inverse',
					                        ) + getVcShared( 'colors-dashed' ),
					'std'                => 'grey',
					'dependency'         => array(
						'element'            => 'style',
						'value_not_equal_to' => array( 'custom', 'outline-custom' ),
					),
				)
			) );

		}

	}
}

if ( function_exists( 'vc_map' ) ) {
	add_action( 'init', 'resort_vc_elements' );
}

if ( ! function_exists( 'resort_vc_elements' ) ) {
	function resort_vc_elements() {

		$project_categories_array = get_terms( 'project_category' );
		$project_categories       = array(
			esc_html__( 'All', 'resort' ) => 'all'
		);
		if ( $project_categories_array && ! is_wp_error( $project_categories_array ) ) {
			foreach ( $project_categories_array as $cat ) {
				$project_categories[ $cat->name ] = $cat->slug;
			}
		}

		vc_map( array(
			'name'     => esc_html__( 'Contacts', 'resort' ),
			'base'     => 'tmc_contacts_widget',
			'category' => esc_html__( 'TMC', 'resort' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'resort' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Style 1', 'resort' ) => 'style_1',
						esc_html__( 'Style 2', 'resort' ) => 'style_2',
						esc_html__( 'Style 3', 'resort' ) => 'style_3'
					),
				),
				array(
					'type'       => 'textfield',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'resort' ),
					'param_name' => 'title',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Address', 'resort' ),
					'param_name' => 'address',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_3'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Phone', 'resort' ),
					'param_name' => 'phone',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_2'))
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Phone', 'resort' ),
					'param_name' => 'phones',
					'dependency' => array('element' => 'style', 'value' => array('style_3'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Email', 'resort' ),
					'param_name' => 'email'
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Schedule', 'resort' ),
					'param_name' => 'schedule',
					'dependency' => array('element' => 'style', 'value' => array('style_3'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Facebook', 'resort' ),
					'param_name' => 'facebook',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Twitter', 'resort' ),
					'param_name' => 'twitter',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Linkedin', 'resort' ),
					'param_name' => 'linkedin',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Google+', 'resort' ),
					'param_name' => 'google_plus',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Skype', 'resort' ),
					'param_name' => 'skype',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'resort' ),
					'param_name'  => 'class',
					'value'       => '',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'resort' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'resort' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Info Box', 'resort' ),
			'base'     => 'tmc_info_box',
			'category' => esc_html__( 'TMC', 'resort' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'resort' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Image', 'resort' ),
					'param_name' => 'image',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_1', 'style_2', 'style_3', 'style_4' )
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Image Size', 'resort' ),
					'param_name' => 'vc_image_size',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_1', 'style_2', 'style_3', 'style_4' )
					),
					'description' => esc_html__( 'Example: Text - full, large, medium, Number - 340x200', 'resort' ),
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Align Center', 'resort' ),
					'param_name' => 'align_center',
					'value'      => array(
						esc_html__( 'Yes', 'resort' ) => 'yes'
					),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'resort' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Style 1', 'resort' ) => 'style_1',
						esc_html__( 'Style 2', 'resort' ) => 'style_2',
						esc_html__( 'Style 3', 'resort' ) => 'style_3',
						esc_html__( 'Style 4', 'resort' ) => 'style_4',
						esc_html__( 'Style 5', 'resort' ) => 'style_5',
						esc_html__( 'Style 6', 'resort' ) => 'style_6'
					),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Title Icon', 'resort' ),
					'param_name' => 'title_icon',
					'value'      => '',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_3', 'style_6' )
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Icon - Size', 'resort' ),
					'param_name' => 'title_icon_size',
					'description' => esc_html__( 'Enter icon size in "px"', 'resort'),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_6' )
					)
				),
				array(
					'type'       => 'textarea_html',
					'heading'    => esc_html__( 'Text', 'resort' ),
					'param_name' => 'content'
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'resort' ),
					'param_name' => 'link'
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Link Icon', 'resort' ),
					'param_name' => 'icon',
					'value'      => '',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_1', 'style_2', 'style_3', 'style_5', 'style_6' )
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'resort' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'resort' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Icon Box', 'resort' ),
			'base'     => 'tmc_icon_box',
			'category' => esc_html__( 'TMC', 'resort' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'resort' ),
					'param_name' => 'box_style',
					'value'      => array(
						esc_html__( 'Style 1', 'resort' ) => 'style_1',
						esc_html__( 'Style 2', 'resort' ) => 'style_2'
					)
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Alignment', 'resort' ),
					'param_name' => 'alignment',
					'value'      => array(
						esc_html__( 'Left', 'resort' )   => 'left',
						esc_html__( 'Right', 'resort' )  => 'right',
						esc_html__( 'Center', 'resort' ) => 'center'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_2')
				),
				array(
					'type'       => 'textarea',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'resort' ),
					'param_name' => 'title'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title - Font size', 'resort' ),
					'param_name'  => 'title_font_size',
					'description' => esc_html__( 'Enter font size in px', 'resort' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title - Line Height', 'resort' ),
					'param_name'  => 'title_line_height',
					'description' => esc_html__( 'Enter line-height in px', 'resort' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'resort' ),
					'param_name' => 'title_color',
					'value'      => array(
						esc_html__( 'Base', 'resort' ) => 'base',
						esc_html__( 'Secondary', 'resort' ) => 'secondary',
						esc_html__( 'Third', 'resort' ) => 'third',
						esc_html__( 'Custom', 'resort' ) => 'custom'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'resort' ),
					'param_name' => 'title_color_custom',
					'dependency' => array('element' => 'title_color', 'value' => 'custom')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'hide_title_line',
					'value'      => array(
						esc_html__( 'Hide Title Line', 'resort' ) => 'hide_title_line'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'enable_hexagon',
					'value'      => array(
						esc_html__( 'Enable Hexagon', 'resort' ) => 'enable'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'enable_hexagon_animation',
					'value'      => array(
						esc_html__( 'Enable Hexagon Hover Animation', 'resort' ) => 'enable'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'v_align_middle',
					'value'      => array(
						esc_html__( 'Enable Middle Align', 'resort' ) => 'enable'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'resort' ),
					'param_name' => 'icon',
					'value'      => ''
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Position', 'resort' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Icon Top', 'resort' )              => 'icon_top',
						esc_html__( 'Icon Top Transparent', 'resort' ) => 'icon_top_transparent',
						esc_html__( 'Icon Left', 'resort' )             => 'icon_left',
						esc_html__( 'Icon Left Transparent', 'resort' ) => 'icon_left_transparent'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Size', 'resort' ),
					'param_name'  => 'icon_size',
					'value'       => '65',
					'description' => esc_html__( 'Enter icon size in px', 'resort' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Color', 'resort' ),
					'param_name' => 'icon_color',
					'value'      => array(
						esc_html__( 'Base', 'resort' ) => 'base',
						esc_html__( 'Secondary', 'resort' ) => 'secondary',
						esc_html__( 'Third', 'resort' ) => 'third',
						esc_html__( 'Custom', 'resort' ) => 'custom'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon - Color Custom', 'resort' ),
					'param_name' => 'icon_color_custom',
					'dependency' => array('element' => 'icon_color', 'value' => 'custom')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Height', 'resort' ),
					'param_name'  => 'icon_height',
					'value'       => '65',
					'description' => esc_html__( 'Enter icon height in px', 'resort' ),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'icon_top', 'icon_top_transparent' )
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Width', 'resort' ),
					'param_name'  => 'icon_width',
					'value'       => '50',
					'description' => esc_html__( 'Enter icon width in px', 'resort' ),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'icon_left', 'icon_left_transparent' )
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Wrapper Width', 'resort' ),
					'param_name'  => 'icon_width_wr',
					'value'       => '',
					'description' => esc_html__( 'Enter icon wrapper width in px', 'resort' ),
					'dependency'  => array(
						'element' => 'box_style',
						'value'   => array( 'style_2' )
					)
				),
				array(
					'type'       => 'textarea_html',
					'heading'    => esc_html__( 'Text', 'resort' ),
					'param_name' => 'content',
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'resort' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'resort' )
				)
			)
		) );

		
		vc_map( array(
			'name'        => esc_html__( 'Spacing', 'resort' ),
			'base'        => 'tmc_spacing',
			'category' => esc_html__( 'TMC', 'resort' ),
			'params'      => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Large Screen', 'resort' ),
					'param_name' => 'lg_spacing'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Medium Screen', 'resort' ),
					'param_name' => 'md_spacing'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Small Screen', 'resort' ),
					'param_name' => 'sm_spacing'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra Small Screen', 'resort' ),
					'param_name' => 'xs_spacing'
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Contact', 'resort' ),
			'base'     => 'tmc_contact',
			'category' => esc_html__( 'TMC', 'resort' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Name', 'resort' ),
					'param_name' => 'name'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Image', 'resort' ),
					'param_name' => 'image'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image Size', 'resort' ),
					'param_name'  => 'image_size',
					'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "default" size.', 'resort' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Job', 'resort' ),
					'param_name' => 'job'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Email', 'resort' ),
					'param_name' => 'email'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Skype', 'resort' ),
					'param_name' => 'skype'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'resort' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'resort' )
				)
			)
		) );

		$tmc_sidebars_array = get_posts( array( 'post_type' => 'tmc_vc_sidebar', 'posts_per_page' => - 1 ) );
		$tmc_sidebars       = array( esc_html__( 'Select', 'resort' ) => 0 );
		if ( $tmc_sidebars_array && ! is_wp_error( $tmc_sidebars_array ) ) {
			foreach ( $tmc_sidebars_array as $val ) {
				$tmc_sidebars[ get_the_title( $val ) ] = $val->ID;
			}
		}

		vc_map( array(
			'name'     => esc_html__( 'TMC Sidebar', 'resort' ),
			'base'     => 'tmc_sidebar',
			'category' => esc_html__( 'TMC', 'resort' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Code', 'resort' ),
					'param_name' => 'sidebar',
					'value'      => $tmc_sidebars
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'resort' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'resort' )
				)
			)
		) );


		vc_map( array(
			'name'                    => esc_html__( 'Google Map', 'resort' ),
			'base'                    => 'tmc_gmap',
			'icon'                    => 'tmc_gmap',
			'as_parent'               => array( 'only' => 'tmc_gmap_address' ),
			'show_settings_on_create' => true,
			'js_view'                 => 'VcColumnView',
			'category'                => esc_html__( 'TMC', 'resort' ),
			'params'                  => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Map Height', 'resort' ),
					'param_name'  => 'map_height',
					'value'       => '733px',
					'description' => esc_html__( 'Enter map height in px', 'resort' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Map Zoom', 'resort' ),
					'param_name' => 'map_zoom',
					'value'      => 18
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Marker Image', 'resort' ),
					'param_name' => 'marker'
				),
				array(
					'type'       => 'checkbox',
					'param_name' => 'disable_mouse_whell',
					'value'      => array(
						esc_html__( 'Disable map zoom on mouse wheel scroll', 'resort' ) => 'disable'
					)
				),
				array(
					'type'       => 'textarea_raw_html',
					'heading'    => esc_html__( 'Style Code', 'resort' ),
					'param_name' => 'gmap_style',
					'group'      => esc_html__('Map Style', 'resort')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'resort' ),
					'param_name'  => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'resort' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'resort' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'resort' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Bottom Info', 'resort' ),
			'base'     => 'tmc_post_bottom',
			'category' => esc_html__( 'TMC Post Partials', 'resort' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'resort' ),
					'param_name' => 'css'
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Comments', 'resort' ),
			'base'     => 'tmc_post_comments',
			'category' => esc_html__( 'TMC Post Partials', 'resort' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'resort' ),
					'param_name' => 'css',
				)
			)
		) );
		
		vc_map( array(
			'name'     => esc_html__( 'Charts', 'resort' ),
			'base'     => 'tmc_charts',
			'icon'     => 'tmc_charts',
			'category' => esc_html__( 'TMC', 'resort' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Design', 'resort' ),
					'param_name' => 'design',
					'value'      => array(
						esc_html__( 'Line', 'resort' )   => 'line',
						esc_html__( 'Bar', 'resort' )    => 'bar',
						esc_html__( 'Circle', 'resort' ) => 'circle',
						esc_html__( 'Pie', 'resort' )    => 'pie',
					),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Show legend?', 'resort' ),
					'param_name'  => 'legend',
					'description' => esc_html__( 'If checked, chart will have legend.', 'resort' ),
					'value'       => array( esc_html__( 'Yes', 'resort' ) => 'yes' ),
					'std'         => 'yes',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Legend Position', 'resort' ),
					'param_name' => 'legend_position',
					'value'      => array(
						esc_html__( 'Bottom', 'resort' ) => 'bottom',
						esc_html__( 'Right', 'resort' )  => 'right',
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Width (px)', 'resort' ),
					'param_name' => 'width',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Height (px)', 'resort' ),
					'param_name' => 'height',
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'X-axis values', 'resort' ),
					'param_name' => 'x_values',
					'value'      => 'JAN; FEB; MAR; APR; MAY; JUN; JUL; AUG',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'line', 'bar' )
					),
				),
				array(
					'type'       => 'param_group',
					'heading'    => esc_html__( 'Values', 'resort' ),
					'param_name' => 'values',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'line', 'bar' )
					),
					'value'      => urlencode( json_encode( array(
						array(
							'title' => esc_html__( 'One', 'resort' ),
							'y_values' => '10; 15; 20; 25; 27; 25; 23; 25',
							'color' => '#fe6c61',
						),
						array(
							'title' => esc_html__( 'Two', 'resort' ),
							'y_values' => '25; 18; 16; 17; 20; 25; 30; 35',
							'color' => '#5472d2'
						)
					) ) ),
					'params'     => array(
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Title', 'resort' ),
							'param_name'  => 'title',
							'description' => esc_html__( 'Enter title for chart dataset.', 'resort' ),
							'admin_label' => true,
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Y-axis values', 'resort' ),
							'param_name' => 'y_values'
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__( 'Color', 'resort' ),
							'param_name' => 'color'
						)
					),
					'callbacks'  => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
				),
				array(
					'type'       => 'param_group',
					'heading'    => esc_html__( 'Values', 'resort' ),
					'param_name' => 'values_circle',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'circle', 'pie' )
					),
					'value'      => urlencode( json_encode( array(
						array(
							'title' => esc_html__( 'One', 'resort' ),
							'value' => '40',
							'color' => '#fe6c61',
						),
						array(
							'title' => esc_html__( 'Two', 'resort' ),
							'value' => '30',
							'color' => '#5472d2'
						),
						array(
							'title' => esc_html__( 'Three', 'resort' ),
							'value' => '40',
							'color' => '#8d6dc4'
						)
					) ) ),
					'params'     => array(
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Title', 'resort' ),
							'param_name'  => 'title',
							'description' => esc_html__( 'Enter title for chart dataset.', 'resort' ),
							'admin_label' => true,
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Value', 'resort' ),
							'param_name' => 'value'
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__( 'Color', 'resort' ),
							'param_name' => 'color'
						)
					),
					'callbacks'  => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'resort' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'resort' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'About Vacancy', 'resort' ),
			'base'     => 'tmc_about_vacancy',
			'category' => esc_html__( 'TMC Vacancy Partials', 'resort' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'resort' ),
					'param_name' => 'css',
				)
			)
		) );
	
	
	/*------------------------------------------------------*/
/* Client Listing
/*------------------------------------------------------*/

/* Code for Client Listing.. */

vc_map( array(
	"name"                      => __("Client Listing", "resort"),
	"base"                      => 'tmc_clientlisting',
	"category"                  => __('TMC Client Listing', 'resort'),
	"description"               => __('Display project listing', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order', 'resort' ),
			'param_name'  => 'order',
			'description' => __( 'Ascending or descending order', 'resort' ),
			'default'	  => 'DESC',
			'value'       => array(
				__("DESC", "resort") => "DESC",
				__("ASC", "resort") => "ASC"
			)
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Number of posts","resort"),
			"param_name"	=> "number",
			"value"			=> "9",
			"description" 	=> "How many post to show?",
		),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Display Mode', 'resort' ),
				'param_name'  => 'layout',
				'description' => __( 'The layout your page children being display', 'resort' ),
				'value'       => array(
					__("Grid", "resort")     => "grid",
					__("Carousel", "resort") => "carousel"
				)
			),
		array(
			"type"        => "checkbox",
			"heading"     => __("Carousel Autoplay","resort"),
			"value"       => array( __("Yes.","resort") => "yes" ),
			"param_name"  => "carousel_autoplay",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),
		
		array(
			"type"			 => "textfield",
			"class"			 => "",
			"heading"		 => __("Carousel Autoplay Speed","resort"),
			"param_name"	 => "carousel_autoplay_speed",
			"value"			 => "3000",
			'description'    => __( 'Carousel Autoplay Speed in millisecond', 'resort' ),
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
			
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Carousel Speed","resort"),
			"param_name"	=> "carousel_speed",
			'description'    => __( 'Carousel Speed in millisecond', 'resort' ),
			"value"			=> "300",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Column', 'resort' ),
			'param_name'  => 'column',
			'description' => __( 'How many column will be display on a row?', 'resort' ),
			'default'	  => '3',
			'value'       => array(
				__("2 Columns", "resort") => "2",
				__("3 Columns", "resort") => "3",
				__("4 Columns", "resort") => "4",
				__("5 Columns", "resort") => "5",
				__("6 Columns", "resort") => "6"
			)
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );

/*------------------------------------------------------*/
/* Our Counter
/*------------------------------------------------------*/

vc_map( array(
		"name"                      => __("Our Counter", "resort"),
		"base"                      => 'tmc_counter',
		"category"                  => __('TMC Elements', 'resort'),
		"description"               => __('Our Counter', 'resort'),
		"save_always" 				=> true,
		'params'      => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Widget Title', 'resort' ),
				'param_name' => 'widget_title',
				'value'       => '',
				'description' => __('What text use as widget title. Leave blank if no title is needed.', 'resort')
			),
			
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Counter Value1', 'resort' ),
				'param_name' 		=> 'counter_value1',
				'value'				=> '1000'
			),
			array(
				'type' => 'textfield',
				'holder' => 'p',
				'heading' => __( 'Right Text1', 'resort' ),
				'param_name' => 'right_text1',
				'value'       => '',
				'description' => __('What text use as widget title. Leave blank if no title is needed.', 'resort')
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Counter Value2', 'resort' ),
				'param_name' 		=> 'counter_value2',
				'value'				=> '1000'
			),
			array(
				'type' => 'textfield',
				'holder' => 'p',
				'heading' => __( 'Right Text2', 'resort' ),
				'param_name' => 'right_text2',
				'value'       => '',
				'description' => __('What text use as widget title. Leave blank if no title is needed.', 'resort')
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Counter Value3', 'resort' ),
				'param_name' 		=> 'counter_value3',
				'value'				=> '1000'
			),
			array(
				'type' => 'textfield',
				'holder' => 'p',
				'heading' => __( 'Right Text3', 'resort' ),
				'param_name' => 'right_text3',
				'value'       => '',
				'description' => __('What text use as widget title. Leave blank if no title is needed.', 'resort')
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Counter Value4', 'resort' ),
				'param_name' 		=> 'counter_value4',
				'value'				=> '1000'
			),
			array(
				'type' => 'textfield',
				'holder' => 'p',
				'heading' => __( 'Right Text4', 'resort' ),
				'param_name' => 'right_text4',
				'value'       => '',
				'description' => __('What text use as widget title. Leave blank if no title is needed.', 'resort')
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Duration', 'resort' ),
				'param_name' 		=> 'duration',
				'value'				=> '2.5'
			),
	
			array(
				'type' 				=> 'iconpicker',
				'heading' 			=> __( 'Icon', 'resort' ),
				'param_name' 		=> 'icon',
				'value'				=> ''
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Icon Size', 'resort' ),
				'param_name' 		=> 'icon_size',
				'value'				=> '65',
				'description'       => __( 'Enter icon size in px', 'resort' )
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Icon Height', 'resort' ),
				'param_name' 		=> 'icon_height',
				'value'				=> '90',
				'description'       => __( 'Enter icon height in px', 'resort' )
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Text alignment', 'resort' ),
				'param_name' 		=> 'icon_text_alignment',
				'value' => array(
					'Center' => 'center',
					'Left' => 'left',
					'Right' => 'right',
				),
				'description'       => __( 'Text alignment in block', 'resort' )
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Text color', 'resort' ),
				'param_name' 		=> 'icon_text_color',
				'description'       => __( 'Text color(white - default)', 'resort' )
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Counter text color', 'resort' ),
				'param_name' 		=> 'counter_text_color',
				'description'       => __( 'Counter Text color(yellow - default)', 'resort' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'resort' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'resort' )
			),
			array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
		)
	) );

	
/*------------------------------------------------------*/
/* Latest NEWS
/*------------------------------------------------------*/
vc_map( array(
	"name"                      => __("Latest News", "resort"),
	"base"                      => 'tmc_latest_news',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Recent Blog Posts', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(
		array(
			'type'        => 'textarea',
			'holder'      => 'h2',
			'heading'     => __( 'Widget Title', 'resort' ),
			'param_name'  => 'widget_title',
			'value'       => '',
			'description' => __('What text use as widget title. Leave blank if no title is needed.', 'resort')
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Number of posts to show","resort"),
			"param_name"	=> "number",
			"value"			=> "3",
			"description" 	=> "How many post to show?",
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Display Mode', 'resort' ),
			'param_name'  => 'layout',
			'description' => __( 'The layout your page children being display', 'resort' ),
			'value'       => array(
				__("Grid", "resort")     => "grid",
				__("Carousel", "resort") => "carousel"
			)
		),

		array(
			"type"        => "checkbox",
			"heading"     => __("Carousel Autoplay","resort"),
			"value"       => array( __("Yes.","resort") => "yes" ),
			"param_name"  => "carousel_autoplay",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			"type"			 => "textfield",
			"class"			 => "",
			"heading"		 => __("Carousel Autoplay Speed","resort"),
			"param_name"	 => "carousel_autoplay_speed",
			"value"			 => "3000",
			'description'    => __( 'Carousel Autoplay Speed in millisecond', 'resort' ),
			"dependency"     => Array('element' => "layout", 'value' => array('carousel'))
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Carousel Speed","resort"),
			"param_name"	=> "carousel_speed",
			'description'    => __( 'Carousel Speed in millisecond', 'resort' ),
			"value"			=> "300",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Column', 'resort' ),
			'param_name'  => 'column',
			'description' => __( 'How many column will be display on a row?', 'resort' ),
			'default'	  => '3',
			'value'       => array(
				__("2 Columns", "resort") => "2",
				__("3 Columns", "resort") => "3",
				__("4 Columns", "resort") => "4",
				__("5 Columns", "resort") => "5"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Read More text","resort"),
			"param_name"	=> "readmore_text",
			"value"			=> "Read More",
			"description" 	=> "Custom your read more text, e.g. Read More, View Profile ...",
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );
/*------------------------------------------------------*/
/* RECENT NEWS
/*------------------------------------------------------*/
vc_map( array(
	"name"                      => __("Recent News", "resort"),
	"base"                      => 'tmc_recent_news',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Recent Blog Posts', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(
		array(
			'type'        => 'textarea',
			'holder'      => 'h2',
			'heading'     => __( 'Widget Title', 'resort' ),
			'param_name'  => 'widget_title',
			'value'       => '',
			'description' => __('What text use as widget title. Leave blank if no title is needed.', 'resort')
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Number of posts to show","resort"),
			"param_name"	=> "number",
			"value"			=> "3",
			"description" 	=> "How many post to show?",
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Display Mode', 'resort' ),
			'param_name'  => 'layout',
			'description' => __( 'The layout your page children being display', 'resort' ),
			'value'       => array(
				__("Grid", "resort")     => "grid",
				__("Carousel", "resort") => "carousel"
			)
		),

		array(
			"type"        => "checkbox",
			"heading"     => __("Carousel Autoplay","resort"),
			"value"       => array( __("Yes.","resort") => "yes" ),
			"param_name"  => "carousel_autoplay",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			"type"			 => "textfield",
			"class"			 => "",
			"heading"		 => __("Carousel Autoplay Speed","resort"),
			"param_name"	 => "carousel_autoplay_speed",
			"value"			 => "3000",
			'description'    => __( 'Carousel Autoplay Speed in millisecond', 'resort' ),
			"dependency"     => Array('element' => "layout", 'value' => array('carousel'))
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Carousel Speed","resort"),
			"param_name"	=> "carousel_speed",
			'description'    => __( 'Carousel Speed in millisecond', 'resort' ),
			"value"			=> "300",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Column', 'resort' ),
			'param_name'  => 'column',
			'description' => __( 'How many column will be display on a row?', 'resort' ),
			'default'	  => '3',
			'value'       => array(
				__("2 Columns", "resort") => "2",
				__("3 Columns", "resort") => "3",
				__("4 Columns", "resort") => "4",
				__("5 Columns", "resort") => "5"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Read More text","resort"),
			"param_name"	=> "readmore_text",
			"value"			=> "Read More",
			"description" 	=> "Custom your read more text, e.g. Read More, View Profile ...",
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );	

/*------------------------------------------------------*/
/* Testimonial full details Carousel
/*------------------------------------------------------*/

vc_map( array(
	"name"                      => __("TMC Testimonials Full Details", "resort"),
	"base"                      => 'tmc_testimonialcrouselfulldetails',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display project listing', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order', 'resort' ),
			'param_name'  => 'order',
			'description' => __( 'Ascending or descending order', 'resort' ),
			'default'	  => 'DESC',
			'value'       => array(
				__("DESC", "resort") => "DESC",
				__("ASC", "resort") => "ASC"
			)
			),array(
		   "type"   => "textfield",
		   "class"   => "",
		   "heading"  => __("Number of posts","resort"),
		   "param_name" => "number",
		   "value"   => "9",
		   "description"  => "How many post to show?",
		  ), array(
			   'type'        => 'dropdown',
			   'heading'     => __( 'Display Mode', 'resort' ),
			   'param_name'  => 'layout',
			   'description' => __( 'The layout your page children being display', 'resort' ),
			   'value'       => array(
				__("Grid", "resort")     => "grid",
				__("Carousel", "resort") => "carousel"
			   )
			  ),array(
		   'type'        => 'dropdown',
		   'heading'     => __( 'Column', 'resort' ),
		   'param_name'  => 'column',
		   'description' => __( 'How many column will be display on a row?', 'resort' ),
		   'default'   => '3',
		   'value'       => array(
			__("2 Columns", "resort") => "2",
			__("3 Columns", "resort") => "3",
			__("4 Columns", "resort") => "4",
			__("5 Columns", "resort") => "5"
		   )
		  ),

		array(
			"type"        => "checkbox",
			"heading"     => __("Carousel Autoplay","resort"),
			"value"       => array( __("Yes.","resort") => "yes" ),
			"param_name"  => "carousel_autoplay"
		),

		array(
			"type"			 => "textfield",
			"class"			 => "",
			"heading"		 => __("Carousel Autoplay Speed","resort"),
			"param_name"	 => "carousel_autoplay_speed",
			"value"			 => "3000",
			'description'    => __( 'Carousel Autoplay Speed in millisecond', 'resort' )
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Carousel Speed","resort"),
			"param_name"	=> "carousel_speed",
			'description'    => __( 'Carousel Speed in millisecond', 'resort' ),
			"value"			=> "300"
		),

		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );



/* Code for Products Listing.. */

vc_map( array(
	"name"                      => __("Project Listing", "resort"),
	"base"                      => 'tmc_projectslisting',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display project listing', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(
		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order', 'resort' ),
			'param_name'  => 'order',
			'description' => __( 'Ascending or descending order', 'resort' ),
			'default'	  => 'DESC',
			'value'       => array(
				__("DESC", "resort") => "DESC",
				__("ASC", "resort") => "ASC"
			)
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Orderby', 'resort' ),
			'param_name'  => 'orderby',
			'description' => __( 'Sort retrieved posts/pages by parameter', 'resort' ),
			'default'	  => 'none',
			'value'       => array(
				__("None", "resort")       => "none",
				__("ID", "resort")         => "ID",
				__("Title", "resort")      => "title",
				__("Name", "resort")       => "name",
				__("Random", "resort")     => "rand",
				__("Date", "resort")       => "date",
				__("Page Order", "resort") => "menu_order"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Number of posts","resort"),
			"param_name"	=> "number",
			"value"			=> "9",
			"description" 	=> "How many post to show?",
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Display Mode', 'resort' ),
			'param_name'  => 'layout',
			'description' => __( 'The layout your page children being display', 'resort' ),
			'value'       => array(
				__("Grid", "resort")     => "grid",
				__("Carousel", "resort") => "carousel"
			)
		),

		array(
			"type"        => "checkbox",
			"heading"     => __("Carousel Autoplay","resort"),
			"value"       => array( __("Yes.","resort") => "yes" ),
			"param_name"  => "carousel_autoplay",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			"type"			 => "textfield",
			"class"			 => "",
			"heading"		 => __("Carousel Autoplay Speed","resort"),
			"param_name"	 => "carousel_autoplay_speed",
			"value"			 => "3000",
			'description'    => __( 'Carousel Autoplay Speed in millisecond', 'resort' ),
			"dependency"     => Array('element' => "layout", 'value' => array('carousel'))
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Carousel Speed","resort"),
			"param_name"	=> "carousel_speed",
			'description'    => __( 'Carousel Speed in millisecond', 'resort' ),
			"value"			=> "300",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Column', 'resort' ),
			'param_name'  => 'column',
			'description' => __( 'How many column will be display on a row?', 'resort' ),
			'default'	  => '3',
			'value'       => array(
				__("2 Columns", "resort") => "2",
				__("3 Columns", "resort") => "3",
				__("4 Columns", "resort") => "4",
				__("5 Columns", "resort") => "5"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Read More text","resort"),
			"param_name"	=> "readmore_text",
			"value"			=> "Read More",
			"description" 	=> "Custom your read more text, e.g. Read More, View Profile ...",
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );
/* Code for Our Latest Projects.. */

vc_map( array(
	"name"                      => __("Our Latest Projects", "resort"),
	"base"                      => 'tmc_ourlatestproject',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display latest project', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(
		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order', 'resort' ),
			'param_name'  => 'order',
			'description' => __( 'Ascending or descending order', 'resort' ),
			'default'	  => 'DESC',
			'value'       => array(
				__("DESC", "resort") => "DESC",
				__("ASC", "resort") => "ASC"
			)
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Orderby', 'resort' ),
			'param_name'  => 'orderby',
			'description' => __( 'Sort retrieved posts/pages by parameter', 'resort' ),
			'default'	  => 'none',
			'value'       => array(
				__("None", "resort")       => "none",
				__("ID", "resort")         => "ID",
				__("Title", "resort")      => "title",
				__("Name", "resort")       => "name",
				__("Random", "resort")     => "rand",
				__("Date", "resort")       => "date",
				__("Page Order", "resort") => "menu_order"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Number of posts","resort"),
			"param_name"	=> "number",
			"value"			=> "9",
			"description" 	=> "How many post to show?",
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Carousel Speed","resort"),
			"param_name"	=> "carousel_speed",
			'description'    => __( 'Carousel Speed in millisecond', 'resort' ),
			"value"			=> "300",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Column', 'resort' ),
			'param_name'  => 'column',
			'description' => __( 'How many column will be display on a row?', 'resort' ),
			'default'	  => '3',
			'value'       => array(
				__("2 Columns", "resort") => "2",
				__("3 Columns", "resort") => "3",
				__("4 Columns", "resort") => "4",
				__("5 Columns", "resort") => "5"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Read More text","resort"),
			"param_name"	=> "readmore_text",
			"value"			=> "Read More",
			"description" 	=> "Custom your read more text, e.g. Read More, View Profile ...",
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );


/*------------------------------------------------------*/
/* CUSTOM HEADING
/*------------------------------------------------------*/
vc_map( array(
	"name"                      => __("Custom Heading", "resort"),
	"base"                      => 'tmc_custom_heading',
	"icon"                      => "",
	"show_settings_on_create"   => true,
	"category"                  => __('TMC Elements', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(
		array(
			'type'        => 'textarea',
			'holder'      => 'h2',
			'heading'     => __( 'Heading', 'resort' ),
			'param_name'  => 'heading',
			'admin_label' => true,
			'value'       => '',
			'description' => __('Custom heading, allow simple HTML code.', 'resort')
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => __("Heading Color","resort"),
			"param_name" => "heading_color",
			"value"      => ""
		),
		array(
			"type"        => "checkbox",
			"class"       => "",
			"heading"     => __("Display a colored line below heading?","resort"),
			"value"       => array( __("Yes.","resort") => "yes" ),
			"param_name"  => "colored_line",
			"description" => ""
		),

		array(
			'type'               => 'dropdown',
			'heading'            => __( 'Custom Line Color', 'resort' ),
			'param_name'         => 'line_color',
			'description'        => __( 'Heading custom line color.', 'resort' ),
			'value'              => array(
				__("Primary Color", "resort")   => "primary",
				__("Secondary Color", "resort") => "secondary",
				__("Custom Color", "resort") => "custom",
			)
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => __("Custom Line Color","resort"),
			"param_name" => "line_custom_color",
			"value"      => "",
			"dependency" => Array('element' => "line_color", 'value' => array('custom'))
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Heading Position', 'resort' ),
			'param_name'  => 'position',
			'value'       => array(
				__("Left", "resort")   => "left",
				__("Center", "resort") => "center",
				__("Right", "resort")  => "right"
			)
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Heading Size', 'resort' ),
			'param_name'  => 'size',
			'value'       => array(
				__("Large", "resort")   => "large",
				__("Medium", "resort") => "medium",
				__("Small", "resort")  => "small"
			)
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Custom Margin Top","resort"),
			"param_name"	=> "margin_top",
			"value"			=> "",
			"description" 	=> "Don't include \"px\" in your string. e.g \"50\"",
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Custom Margin Bottom","resort"),
			"param_name"	=> "margin_bottom",
			"value"			=> "",
			"description" 	=> "Don't include \"px\" in your string. e.g \"50\"",
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );


/*------------------------------------------------------*/
/* Side-service-call
/*------------------------------------------------------*/

/* Code for Side-service-call.. */

vc_map( array(
	"name"                      => __("Side Service", "resort"),
	"base"                      => 'tmc_sideservicecall',
	"category"                  => __('TMC Side Service', 'resort'),
	"description"               => __('Display Side Service', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order', 'resort' ),
			'param_name'  => 'order',
			'description' => __( 'Ascending or descending order', 'resort' ),
			'default'	  => 'DESC',
			'value'       => array(
				__("DESC", "resort") => "DESC",
				__("ASC", "resort") => "ASC"
			)
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Text', 'resort' ),
			'param_name'  => 'el_text',
			'default'     =>esc_html__('Nemo enim ips am voluptatem quia voluptas sit.', 'resort'),
			'description' => __( 'Enter Text Here', 'resort' )
			
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );


/* Code for Our Gallerie*/

vc_map( array(
	"name"                      => __("Our Gallerie", "resort"),
	"base"                      => 'tmc_ourgallerie',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display our Gallerie', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(
		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order', 'resort' ),
			'param_name'  => 'order',
			'description' => __( 'Ascending or descending order', 'resort' ),
			'default'	  => 'DESC',
			'value'       => array(
				__("DESC", "resort") => "DESC",
				__("ASC", "resort") => "ASC"
			)
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Orderby', 'resort' ),
			'param_name'  => 'orderby',
			'description' => __( 'Sort retrieved posts/pages by parameter', 'resort' ),
			'default'	  => 'none',
			'value'       => array(
				__("None", "resort")       => "none",
				__("ID", "resort")         => "ID",
				__("Title", "resort")      => "title",
				__("Name", "resort")       => "name",
				__("Random", "resort")     => "rand",
				__("Date", "resort")       => "date",
				__("Page Order", "resort") => "menu_order"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Number of posts","resort"),
			"param_name"	=> "number",
			"value"			=> "9",
			"description" 	=> "How many post to show?",
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Display Mode', 'resort' ),
			'param_name'  => 'layout',
			'description' => __( 'The layout your page children being display', 'resort' ),
			'value'       => array(
				__("Grid", "resort")     => "grid",
				__("Carousel", "resort") => "carousel"
			)
		),

		array(
			"type"        => "checkbox",
			"heading"     => __("Carousel Autoplay","resort"),
			"value"       => array( __("Yes.","resort") => "yes" ),
			"param_name"  => "carousel_autoplay",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			"type"			 => "textfield",
			"class"			 => "",
			"heading"		 => __("Carousel Autoplay Speed","resort"),
			"param_name"	 => "carousel_autoplay_speed",
			"value"			 => "3000",
			'description'    => __( 'Carousel Autoplay Speed in millisecond', 'resort' ),
			"dependency"     => Array('element' => "layout", 'value' => array('carousel'))
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Carousel Speed","resort"),
			"param_name"	=> "carousel_speed",
			'description'    => __( 'Carousel Speed in millisecond', 'resort' ),
			"value"			=> "300",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Column', 'resort' ),
			'param_name'  => 'column',
			'description' => __( 'How many column will be display on a row?', 'resort' ),
			'default'	  => '3',
			'value'       => array(
				__("2 Columns", "resort") => "2",
				__("3 Columns", "resort") => "3",
				__("4 Columns", "resort") => "4",
				__("5 Columns", "resort") => "5"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Read More text","resort"),
			"param_name"	=> "readmore_text",
			"value"			=> "Read More",
			"description" 	=> "Custom your read more text, e.g. Read More, View Profile ...",
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );

/* Code for TMC Testimonials.. */

vc_map( array(
	"name"                      => __("TMC Testimonials Full Details", "resort"),
	"base"                      => 'tmc_testimonialcrouselfulldetails',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display project listing', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order', 'resort' ),
			'param_name'  => 'order',
			'description' => __( 'Ascending or descending order', 'resort' ),
			'default'	  => 'DESC',
			'value'       => array(
				__("DESC", "resort") => "DESC",
				__("ASC", "resort") => "ASC"
			)
		),

		array(
			"type"        => "checkbox",
			"heading"     => __("Carousel Autoplay","resort"),
			"value"       => array( __("Yes.","resort") => "yes" ),
			"param_name"  => "carousel_autoplay"
		),

		array(
			"type"			 => "textfield",
			"class"			 => "",
			"heading"		 => __("Carousel Autoplay Speed","resort"),
			"param_name"	 => "carousel_autoplay_speed",
			"value"			 => "3000",
			'description'    => __( 'Carousel Autoplay Speed in millisecond', 'resort' )
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Carousel Speed","resort"),
			"param_name"	=> "carousel_speed",
			'description'    => __( 'Carousel Speed in millisecond', 'resort' ),
			"value"			=> "300"
		),

		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );


/* Code for Our New testimonial*/

vc_map( array(
	"name"                      => __("Testimonials New ", "resort"),
	"base"                      => 'tmc_testimonialsnew',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display our Testimonials ', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(
		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order', 'resort' ),
			'param_name'  => 'order',
			'description' => __( 'Ascending or descending order', 'resort' ),
			'default'	  => 'DESC',
			'value'       => array(
				__("DESC", "resort") => "DESC",
				__("ASC", "resort") => "ASC"
			)
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Orderby', 'resort' ),
			'param_name'  => 'orderby',
			'description' => __( 'Sort retrieved posts/pages by parameter', 'resort' ),
			'default'	  => 'none',
			'value'       => array(
				__("None", "resort")       => "none",
				__("ID", "resort")         => "ID",
				__("Title", "resort")      => "title",
				__("Name", "resort")       => "name",
				__("Random", "resort")     => "rand",
				__("Date", "resort")       => "date",
				__("Page Order", "resort") => "menu_order"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Number of posts","resort"),
			"param_name"	=> "number",
			"value"			=> "9",
			"description" 	=> "How many post to show?",
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Display Mode', 'resort' ),
			'param_name'  => 'layout',
			'description' => __( 'The layout your page children being display', 'resort' ),
			'value'       => array(
				__("Grid", "resort")     => "grid",
				__("Carousel", "resort") => "carousel"
			)
		),

		array(
			"type"        => "checkbox",
			"heading"     => __("Carousel Autoplay","resort"),
			"value"       => array( __("Yes.","resort") => "yes" ),
			"param_name"  => "carousel_autoplay",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			"type"			 => "textfield",
			"class"			 => "",
			"heading"		 => __("Carousel Autoplay Speed","resort"),
			"param_name"	 => "carousel_autoplay_speed",
			"value"			 => "3000",
			'description'    => __( 'Carousel Autoplay Speed in millisecond', 'resort' ),
			"dependency"     => Array('element' => "layout", 'value' => array('carousel'))
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Carousel Speed","resort"),
			"param_name"	=> "carousel_speed",
			'description'    => __( 'Carousel Speed in millisecond', 'resort' ),
			"value"			=> "300",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Column', 'resort' ),
			'param_name'  => 'column',
			'description' => __( 'How many column will be display on a row?', 'resort' ),
			'default'	  => '3',
			'value'       => array(
				__("2 Columns", "resort") => "2",
				__("3 Columns", "resort") => "3",
				__("4 Columns", "resort") => "4",
				__("5 Columns", "resort") => "5"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Read More text","resort"),
			"param_name"	=> "readmore_text",
			"value"			=> "Read More",
			"description" 	=> "Custom your read more text, e.g. Read More, View Profile ...",
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );
/* Code for Our galery -mix -it-up*/

vc_map( array(
	"name"                      => __("Gallery One", "resort"),
	"base"                      => 'tmc_gallery_one',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display our Gallerie', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(
		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order', 'resort' ),
			'param_name'  => 'order',
			'description' => __( 'Ascending or descending order', 'resort' ),
			'default'	  => 'DESC',
			'value'       => array(
				__("DESC", "resort") => "DESC",
				__("ASC", "resort") => "ASC"
			)
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Orderby', 'resort' ),
			'param_name'  => 'orderby',
			'description' => __( 'Sort retrieved posts/pages by parameter', 'resort' ),
			'default'	  => 'none',
			'value'       => array(
				__("None", "resort")       => "none",
				__("ID", "resort")         => "ID",
				__("Title", "resort")      => "title",
				__("Name", "resort")       => "name",
				__("Random", "resort")     => "rand",
				__("Date", "resort")       => "date",
				__("Page Order", "resort") => "menu_order"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Number of posts","resort"),
			"param_name"	=> "number",
			"value"			=> "9",
			"description" 	=> "How many post to show?",
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Display Mode', 'resort' ),
			'param_name'  => 'layout',
			'description' => __( 'The layout your page children being display', 'resort' ),
			'value'       => array(
				__("Grid", "resort")     => "grid",
				__("filter", "resort") => "filter"
			)
		),

		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Column', 'resort' ),
			'param_name'  => 'column',
			'description' => __( 'How many column will be display on a row?', 'resort' ),
			'default'	  => '3',
			'value'       => array(
				__("2 Columns", "resort") => "2",
				__("3 Columns", "resort") => "3",
				__("4 Columns", "resort") => "4",
				__("5 Columns", "resort") => "5"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Read More text","resort"),
			"param_name"	=> "readmore_text",
			"value"			=> "Read More",
			"description" 	=> "Custom your read more text, e.g. Read More, View Profile ...",
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );

/* Code for Our News post*/

vc_map( array(
	"name"                      => __("News Posts", "resort"),
	"base"                      => 'tmc_newspost',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display our Gallerie', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(
		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order', 'resort' ),
			'param_name'  => 'order',
			'description' => __( 'Ascending or descending order', 'resort' ),
			'default'	  => 'DESC',
			'value'       => array(
				__("DESC", "resort") => "DESC",
				__("ASC", "resort") => "ASC"
			)
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Orderby', 'resort' ),
			'param_name'  => 'orderby',
			'description' => __( 'Sort retrieved posts/pages by parameter', 'resort' ),
			'default'	  => 'none',
			'value'       => array(
				__("None", "resort")       => "none",
				__("ID", "resort")         => "ID",
				__("Title", "resort")      => "title",
				__("Name", "resort")       => "name",
				__("Random", "resort")     => "rand",
				__("Date", "resort")       => "date",
				__("Page Order", "resort") => "menu_order"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Number of posts","resort"),
			"param_name"	=> "number",
			"value"			=> "9",
			"description" 	=> "How many post to show?",
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Display Mode', 'resort' ),
			'param_name'  => 'layout',
			'description' => __( 'The layout your page children being display', 'resort' ),
			'value'       => array(
				__("Grid", "resort")     => "grid",
				__("Carousel", "resort") => "carousel"
			)
		),

		array(
			"type"        => "checkbox",
			"heading"     => __("Carousel Autoplay","resort"),
			"value"       => array( __("Yes.","resort") => "yes" ),
			"param_name"  => "carousel_autoplay",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			"type"			 => "textfield",
			"class"			 => "",
			"heading"		 => __("Carousel Autoplay Speed","resort"),
			"param_name"	 => "carousel_autoplay_speed",
			"value"			 => "3000",
			'description'    => __( 'Carousel Autoplay Speed in millisecond', 'resort' ),
			"dependency"     => Array('element' => "layout", 'value' => array('carousel'))
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Carousel Speed","resort"),
			"param_name"	=> "carousel_speed",
			'description'    => __( 'Carousel Speed in millisecond', 'resort' ),
			"value"			=> "300",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Column', 'resort' ),
			'param_name'  => 'column',
			'description' => __( 'How many column will be display on a row?', 'resort' ),
			'default'	  => '3',
			'value'       => array(
				__("2 Columns", "resort") => "2",
				__("3 Columns", "resort") => "3",
				__("4 Columns", "resort") => "4",
				__("5 Columns", "resort") => "5"
			)
		),

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Read More text","resort"),
			"param_name"	=> "readmore_text",
			"value"			=> "Read More",
			"description" 	=> "Custom your read more text, e.g. Read More, View Profile ...",
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );
/*------------------------------------------------------*/
/* Testimonials Listing New
/*------------------------------------------------------*/

vc_map( array(
	"name"                      => __("Testimonials Listing New", "resort"),
	"base"                      => 'tmc_testimonialslisting_new',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display project listing', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order', 'resort' ),
			'param_name'  => 'order',
			'description' => __( 'Ascending or descending order', 'resort' ),
			'default'	  => 'DESC',
			'value'       => array(
				__("DESC", "resort") => "DESC",
				__("ASC", "resort") => "ASC"
			)
		),

		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );

/*------------------------------------------------------*/
/* TMC Search Availability
/*------------------------------------------------------*/

vc_map( array(
	"name"                      => __("TMC Search Availability", "resort"),
	"base"                      => 'tmc_seach_availability',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display Search Availability', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(		
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );
vc_map( array(
	"name"                      => __("TMC Search Availability2", "resort"),
	"base"                      => 'tmc_seach_availability2',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display Search Availability For Home5', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(		
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );


/*------------------------------------------------------*/
/* TMC Room grid
/*------------------------------------------------------*/

vc_map( array(
	"name"                      => __("TMC Room Grid", "resort"),
	"base"                      => 'tmc_room_grid',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display TMC Room Grid', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(		
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );


/*------------------------------------------------------*/
/* TMC Room List
/*------------------------------------------------------*/

vc_map( array(
	"name"                      => __("TMC Room List", "resort"),
	"base"                      => 'tmc_room_list',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display TMC Room List', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(		
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );


/*------------------------------------------------------*/
/* TMC Rooms
/*------------------------------------------------------*/

vc_map( array(
	"name"                      => __("TMC Rooms", "resort"),
	"base"                      => 'tmc_rooms',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display TMC Rooms', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Number of posts","resort"),
			"param_name"	=> "number",
			"value"			=> "9",
			"description" 	=> "How many post to show?",
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Display Mode', 'resort' ),
			'param_name'  => 'layout',
			'description' => __( 'The layout your page children being display', 'resort' ),
			'value'       => array(
				__("Grid", "resort")     => "grid",
				__("Carousel", "resort") => "carousel"
			)
		),

		array(
			"type"        => "checkbox",
			"heading"     => __("Carousel Autoplay","resort"),
			"value"       => array( __("Yes.","resort") => "yes" ),
			"param_name"  => "carousel_autoplay",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			"type"			 => "textfield",
			"class"			 => "",
			"heading"		 => __("Carousel Autoplay Speed","resort"),
			"param_name"	 => "carousel_autoplay_speed",
			"value"			 => "3000",
			'description'    => __( 'Carousel Autoplay Speed in millisecond', 'resort' ),
			"dependency"     => Array('element' => "layout", 'value' => array('carousel'))
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Carousel Speed","resort"),
			"param_name"	=> "carousel_speed",
			'description'    => __( 'Carousel Speed in millisecond', 'resort' ),
			"value"			=> "300",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Column', 'resort' ),
			'param_name'  => 'column',
			'description' => __( 'How many column will be display on a row?', 'resort' ),
			'default'	  => '3',
			'value'       => array(
				__("2 Columns", "resort") => "2",
				__("3 Columns", "resort") => "3",
				__("4 Columns", "resort") => "4"
			)
		),

	
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );

/*------------------------------------------------------*/
/* TMC Rooms 2
/*------------------------------------------------------*/

vc_map( array(
	"name"                      => __("TMC Rooms2", "resort"),
	"base"                      => 'tmc_rooms2',
	"category"                  => __('TMC Elements', 'resort'),
	"description"               => __('Display TMC Rooms', 'resort'),
	"save_always" 				=> true,
	"params"                    => array(

		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Number of posts","resort"),
			"param_name"	=> "number",
			"value"			=> "9",
			"description" 	=> "How many post to show?",
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Display Mode', 'resort' ),
			'param_name'  => 'layout',
			'description' => __( 'The layout your page children being display', 'resort' ),
			'value'       => array(
				__("Grid", "resort")     => "grid",
				__("Carousel", "resort") => "carousel"
			)
		),

		array(
			"type"        => "checkbox",
			"heading"     => __("Carousel Autoplay","resort"),
			"value"       => array( __("Yes.","resort") => "yes" ),
			"param_name"  => "carousel_autoplay",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			"type"			 => "textfield",
			"class"			 => "",
			"heading"		 => __("Carousel Autoplay Speed","resort"),
			"param_name"	 => "carousel_autoplay_speed",
			"value"			 => "3000",
			'description'    => __( 'Carousel Autoplay Speed in millisecond', 'resort' ),
			"dependency"     => Array('element' => "layout", 'value' => array('carousel'))
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Carousel Speed","resort"),
			"param_name"	=> "carousel_speed",
			'description'    => __( 'Carousel Speed in millisecond', 'resort' ),
			"value"			=> "300",
			"dependency" => Array('element' => "layout", 'value' => array('carousel'))
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Column', 'resort' ),
			'param_name'  => 'column',
			'description' => __( 'How many column will be display on a row?', 'resort' ),
			'default'	  => '3',
			'value'       => array(
				__("2 Columns", "resort") => "2",
				__("3 Columns", "resort") => "3",
				__("4 Columns", "resort") => "4"
			)
		),

	
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'resort' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'resort' )
		)
	),
) );
}	
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {


	class WPBakeryShortCode_TMC_Animation_Block extends WPBakeryShortCodesContainer {
	}

	class WPBakeryShortCode_TMC_Gmap extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

	class WPBakeryShortCode_TMC_Contacts_Widget extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Info_Box extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Icon_Box extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Posts extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Contact extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Sidebar extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Gmap_Address extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Post_Bottom extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Post_About_Author extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Post_Comments extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Charts extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Spacing extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Clientlisting extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Counter extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Recent_news extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Testimonialcrouselfulldetails extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Projectslisting extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Custom_heading extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Ourlatestproject extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Sideservicecall extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Ourgallerie extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Testimonialsnew extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Gallery_one extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Newspost extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Testimonialslisting_new extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Seach_Availability extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Seach_Availability2 extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Rooms extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Rooms2 extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Room_Grid extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_TMC_Room_List extends WPBakeryShortCode {
	}
}
