<?php
require get_template_directory() . '/inc/tgm/tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'tmc_require_plugins' );

function tmc_require_plugins() {
	$plugins_path = get_template_directory() . '/inc/tgm/plugins';
	$plugins      = array(
		array(
			'name'             => esc_html__('TMC Post Type','resort'),
			'slug'             => 'tmc-post-type',
			'source'           => 'http://demos.pixelatethemes.com/resortwp/theme-assets/tmc-post-type.zip',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),
		array(
			'name'         => esc_html__('WPBakery Visual Composer','resort'),
			'slug'         => 'vc-composer',
			'source'       => 'http://demos.pixelatethemes.com/allplugins/js_composer.zip',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
			'external_url' => esc_url('http://vc.wpbakery.com','resort'),
		),
		array(
			'name'         => esc_html__('Revolution Slider','resort'),
			'slug'         => 'revslider',
			'source'       => 'http://demos.pixelatethemes.com/allplugins/revslider.zip',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
			'external_url' => esc_url('http://www.themepunch.com/revolution/','resort'),
		),
		array(
			'name'     => esc_html__('Breadcrumb NavXT','resort'),
			'slug'     => 'breadcrumb-navxt',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),
	
		array(
			'name'     => esc_html__('Contact Form 7','resort'),
			'slug'     => 'contact-form-7',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),
		array(
			'name'     => esc_html__('MailChimp for WordPress Lite','resort'),
			'slug'     => 'mailchimp-for-wp',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),		

		array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'           => true,
			'force_activation'   => false,
            'force_deactivation' => false,
        ),
		
		array(
            'name'               => 'TMC Data options',
            'slug'               => 'tmc-data-options', 
            'source'             => 'http://demos.pixelatethemes.com/resortwp/theme-assets/tmc-data-options.zip',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
		array(
            'name'               => 'WP Hotel Booking',
            'slug'               => 'wp-hotel-booking', 
            'source'             => 'http://demos.pixelatethemes.com/resortwp/theme-assets/wp-hotel-booking.zip',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
		
	);

	tgmpa( $plugins, array( 'is_automatic' => true ) );
}