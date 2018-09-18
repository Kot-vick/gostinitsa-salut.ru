<?php

/* ------------------------------------------------------------------------ */
/* Redux Configuration
/* ------------------------------------------------------------------------ */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "resort_option";
	global $logo_tmp_src;
    $theme = wp_get_theme(); // For use with some settings. Not necessary.

   $args = array(
        'opt_name'          => 'tmc_options',       // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
        'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
        'menu_type'         => 'submenu',               //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'    => false,                   // Show the sections below the admin menu item or not
        'menu_title'        => __('Theme Options', 'resort'),
        'page_title'        => __('Theme Options', 'resort'),
        'save_defaults'     => true,
        'async_typography'  => true,                    // Use a asynchronous font on the front end or font string
        'admin_bar'         => false,                    // Show the panel pages on the admin bar
        'global_variable'   => 'resort_option',        // Set a different name for your global variable other than the opt_name
        'dev_mode'          => false,                    // Show the time the page took to load, etc
        'customizer'        => false,                    // Enable basic customizer support
        'page_slug'         => 'resort_options',
        'system_info'       => false,
        'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    );

	 
	
    Redux::setArgs( $opt_name, $args, $logo_tmp_src  );

    /* Set Extensions /-------------------------------------------------- */
    Redux::setExtensions( $opt_name, dirname( __FILE__ ) . '/extensions/' );

    /* General /--------------------------------------------------------- */
    Redux::setSection( $opt_name, array(
        'title'     => __('General', 'resort'),
		'desc'   => '',
        'icon'      => 'el-icon-home',
		'class'     => 'main_background',
		'submenu' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

			array(
                'id'       => 'switch_comments',
                'type'     => 'switch', 
                'title'    => __('Global Page Comments', 'minti-framework'),
                'subtitle' => __('You can globally disable the Page Comments.', 'minti-framework'),
                'default'  => false,
            ),
			array(
				'id'       => 'rtl_switch',
				'type'     => 'switch',
				'title'    => esc_html__('Enable RTL.', 'resort'),
				'subtitle' => __('Enable / Disable RTL', 'resort'),
				'default'  => false,
				),
			array(
				'id'       => 'seprater_five',
				'url'      => false,
				'type'     => '',
				'class'    => 'background_color',
				'title'    => esc_html__('Favicon', 'resort'),
				
			),
			array(
					'id'       =>'favicon_icon',
					'url'      => false,
					'type'     => 'media',
					'title'    => esc_html__('Favicon Upload (16x16)', 'resort'),
					'subtitle' => __('Upload your favicon ( 16x16px )', 'resort'),
					'default'  => '',
			),
		
 
        ),
    ) );

	
	/* Layout  */
	
		Redux::setSection( $opt_name, array(
			'title'     => esc_html__('Layout', 'resort'),
			'desc'   => '',
			'class'     => 'main_background',
			'icon'   => 'el el-th',
			'submenu' => true,
			'fields'    => array(
	
			array(
				'id'       => 'top_back_button_one',
				'type'     => 'select',
				'title'    => __('Back to Top Button', 'resort'),
				'subtitle' => esc_html__('Enable / Disable Back to Top Button.', 'resort'),
				'options'  => array(
					'1' => 'Enable on All Devices',
					'2' => 'Enable on Desktop Only',
					'3' => 'Enable on Mobile Only',
					'4' => 'Disable'
				),
				'default'  => '1',
			),
			
			array(
				'id'       => 'layout_style',
				'type'     => 'select',
				'title'    => __('Layout Style', 'resort'),
				'subtitle' => esc_html__('Choose your Layout Style.', 'resort'),
				'options'  => array(
					'1' => 'Fullwidth',
					'2' => 'Boxed Layout',
				),
				'default'  => '1',
			), 
			
			array(
				'id'       => 'boxed_bg',
				'type'     => 'background',
				'compiler' => true,
				'output'   => array('.layout-boxed'),
				'title'    => esc_html__('Body Background for boxed layout', 'resort'),
				'default'  => array(
					'max-width' => '1200px',
					'margin' => '0 auto'					
				)
			),
						
		)
	) );
		
	/* Top Bar /--------------------------------------------------------- */
	
	Redux::setSection( $opt_name, array(
        'title'     => esc_html__('Top Bar', 'resort'),
		'desc'   => '',
		'class'     => 'main_background',
        'icon'   => 'el el-align-center',
		'submenu' => true,
        'fields'    => array(
	
	
		array(
				'id'       => 'top_bar',
				'type'     => 'switch',
				'title'    => esc_html__('Enable Top Bar', 'resort'),
				'default'  => true,
			  ),
		
		array(
				'id'       => 'topbar_phone',
				'type'     => 'text',
				'title'    => esc_html__('Top Bar Phone Number', 'resort'),
				'default'  => esc_html__( "(+44) 555 890767", 'resort' ),
			  ),
	
		array(
				'id'       => 'topbar_address',
				'type'     => 'text',
				'title'    => esc_html__('Top Bar Address', 'resort'),
				'default'  => esc_html__( "56, BUILDING- AVENUE-96, NEW YORK", 'resort' ),
			  ),

			array(
				'id'       => 'topbar_email',
				'type'     => 'text',
				'title'    => esc_html__('Top Bar Email', 'resort'),
				'default'  => esc_html__( "info@resorthotel.com", 'resort' ),
			  ), 
	 ),
    ) );
	
		
	/* Header /--------------------------------------------------------- */
	 
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__('Header', 'resort'),
		'background-color' => '#ef9a9a',
		'desc'   => '',
		'class'     => 'main_background',
        'icon'   => 'el el-credit-card',
		'submenu' => true,
        'fields'    => array(
		
		array(
			'id'       => 'header_style',
			'title'   => esc_html__( 'Header Style', 'finance' ),
			'type'    => 'button_set',
			'default' => 'tmc_header_4',
			'options' => array(
				'tmc_header_1' => esc_html__( 'Style 1', 'resort' ),
				'tmc_header_2' => esc_html__( 'Style 2', 'resort' ),
				'tmc_header_3' => esc_html__( 'Style 3', 'resort' ),

			)
		),
		
		array(
                'id'       => 'header_style',
                'type'     => 'image_select',
                'title'    => __('Header Layout', 'resort'), 
                'subtitle' => __('Select the header Layout', 'resort'),
                'description' => __('Only Header 2 & 3 can be transparent. Keep that in mind when choosing your Page specific Headers.', 'resort'),
                'options'  => array(
                    'tmc_header_1'      => array(
                        'alt'   => 'Header 1', 
                        'img'   => get_template_directory_uri() .'/assets/images/headers/header_1.png'
                    ),
					
                    'tmc_header_2'      => array(
                        'alt'   => 'Header 2', 
                        'img'   => get_template_directory_uri() .'/assets/images/headers/header_2.png'
                    ),
                    'tmc_header_3'      => array(
                        'alt'   => 'Header 3', 
                        'img'   => get_template_directory_uri() .'/assets/images/headers/header_3.png'
                    ),
                ),
                'default' => 'tmc_header_1'
            ),
		
		array(
			'id'       => 'header_background',
			'title'   => esc_html__( 'inner Header Image', 'resort' ),
			'type'    => 'media',
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/tmp/inner-header.jpg' ),
			'subtitle' => esc_html__('Upload your Inner Header Image.', 'resort'),
		),
						
        array(
			'id'       => 'sticky_menu',
			'type'     => 'switch',
			'title'    => esc_html__('Enable fixed header on scroll.', 'resort'),
			'default'  => true,
			 ),
			 
		array(
				'id'       => 'header_search',
				'type'     => 'switch',
				'title'    => esc_html__('Enable/Disable Header Search.', 'resort'),
				'default'  => true,
			  ), 

	    array(
			'id'       => 'header_slide',
			'type'     => 'switch',
			'title'    => esc_html__('Enable/Disable Header Slide Sidebar.', 'resort'),
			'default'  => false,
			 ),
		

		array(
					'id'       =>'site_logo',
					'url'      => false,
					'type'     => 'media',
					'title'    => esc_html__('Site Logo', 'resort'),
					'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_default.png' ),
					'subtitle' => esc_html__('Upload your logo here.', 'resort'),
				),
			
		array(
			'id'       =>'footer_logo',
			'url'      => false,
			'type'     => 'media',
			'title'    => esc_html__('Site Footer Logo', 'resort'),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'default_dark.png' ),
			'subtitle' => esc_html__('Upload your footer logo here.', 'resort'),
		),
			
			
		array(
			'id'       =>'transparent_logo',
			'url'      => false,
			'type'     => 'media',
			'title'    => esc_html__('Transparent Logo', 'resort'),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/tmp/'.$logo_tmp_src.'logo.png' ),
			'subtitle' => esc_html__('Upload your logo here.', 'resort'),				
			),	

		array(
				'id'       => 'header_height',
				'type'    =>  'dimensions',
				'units'    => array('em','px','%'),
				'output'         => array('.main-menu-wrapper-two'),
				'title'   => esc_html__( 'Header Height', 'resort' ),
				'subtitle' => esc_html__('Enter Header Height.', 'resort'),
				'default'  => array(
				'Width'   => '', 
				'Height'  => '',
				'units'   => 'px'
				)
			),
		array(
				'id'       => 'logo_margin',
				'type'           => 'spacing',
				'output'         => array('.logo'),
				'mode'           => 'margin',
				'units'          => array('em','px','%'),
				'units_extended' => 'false',
				'title'   => esc_html__( 'Logo Margin', 'resort' ),
				'subtitle' => esc_html__('Enter your top margin value for the logo.', 'resort'),
				'default'        => array(
				
					'margin-top'     => '23px',
					'margin-right'   => '0px',
					'margin-bottom'  => '23px',
					'margin-left'    => '0px',
					'units'          => 'px',

				)
			),
			
        ),
    ) );
	
	
	/* Menu Styling /--------------------------------------------------------- */
    Redux::setSection( $opt_name, array(
        'title'     => __('Menu', 'resort'),
		'desc'   	=> '',
        'icon'      => 'el el-th-list',
		'class'     => 'main_background',
		'submenu'   => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(
		

			array(
				'id' => 'menu_padding_first_level',
				'title' => 'Menu Padding - First Level',
				'type' => 'spacing',
				'mode' => 'padding',
				'units' => array('px','%','em'),
				'output' => array('.nav-footer li a'),
				'default' => array(
					'padding-top' => '', 
					'padding-right' => '', 
					'padding-bottom' => '', 
					'padding-left' => ''
				),
			),
			array(
				'id' => 'menu_margin_first_level',
				'title' => 'Menu Margin - First Level',
				'output' => array('.nav-footer li a'),
				'type' => 'spacing',
				'mode' => 'margin',
				'units' => array('px', '%', 'em'),
			),
			array(
				'id'          => 'menu_fontsize_first_level',
				'type'        => 'typography', 
				'title'       => __('Menu- First Level', 'resort'),
				'google'      => true, 
				'font-backup' => true,
				'output'      => array('.nav-footer li a'),
				'units'       =>array('px','%','em'),
				'default'     => array(
					'color'       => '', 
					'font-style'  => '', 
					'font-family' => '', 
					'google'      => true,
					'font-size'   => '', 
					'line-height' => ''
				),
			),
			array(
				'id' => 'menu_bg',
				'type' => 'color_rgba',
				'title' => esc_html__('Menu Background Color', 'resort'),
				'default' => array(
					'color'     => '',
					'alpha'     => 1
				),
				'output' => array( 'background' => '.main-menu-wrapper-two'),
			),
		   array(
				'id' => 'menu_color_first_level_hover',
				'type' => 'color',
				'title' => esc_html__('Menu Hover color  - First level', 'resort'),
				'output' => array('.nav-footer li:hover a,.nav-footer li:focus a'),
				'default' => ''
			),
		    array(
				'id' => 'menu_active_color_first_level',
				'type' => 'color',
				'title' => esc_html__('Menu Active Color - First level', 'resort'),
				'output' => array('.nav-footer li.current-menu-item a'),
				'default' => ''
			),
			array(
				'id'       => 'seprater',
				'url'      => false,
				'type'     => '',
				'class'    => 'background_color',
				'title'    => esc_html__('Sub Menu', 'resort'),    
			),
			array(
				'id' => 'sub_menu_bg',
				'type' => 'color_rgba',
				'title' => esc_html__('Sub Menu Background Color', 'resort'),
				'default' => array(
					'color'     => '',
					'alpha'     => 1
				),
				'output' => array( 'background' => '.nav-holder .nav-footer li ul.sub-menu li'),
				
			), 
			 array(
				'id' => 'sub_menu_bg_hover',
				'type' => 'color_rgba',
				'title' => esc_html__('Sub Menu Background Color On Hover', 'resort'),
				'default' => array(
					'color'     => '',
					'alpha'     => 1
				),
				'output' => array( 'background' => '.my-style li ul.sub-menu li a:hover'),
			),
			array(
				'id'          => 'menu_fontsize_sub_level',
				'type'        => 'typography', 
				'title'       => __('Menu- Sub Level', 'resort'),
				'google'      => true, 
				'font-backup' => true,
				'output'      => array('.my-style li ul.sub-menu li a'),
				'units'       =>array('px','%','em'),
				'default'     => array(
					'color'       => '', 
					'font-style'  => '', 
					'font-family' => '', 
					'google'      => true,
					'font-size'   => '', 
					'line-height' => ''
				),
			),
			array(
				'id' => 'menu_color_sub_hover',
				'type' => 'color',
				'title' => esc_html__('Menu Color Hover - Sub level', 'resort'),
				'output' => array('.my-style li ul.sub-menu li a:hover'),
				'default' => ''
			),
			array(
				'id' => 'sub_active_color_level',
				'type' => 'color',
				'title' => esc_html__('Menu Active Color - Sub level', 'resort'),
				'output' => array('.my-style li ul.sub-menu li.current-menu-item a'),
				'default' => ''
			),
			array(
				'id'       => 'seprater_sticky',
				'url'      => false,
				'type'     => '',
				'class'    => 'background_color',
				'title'    => esc_html__('Sticky Menu', 'resort'),    
			   ),
			array(
				'id' => 'sticky_menu_bg',
				'type' => 'color_rgba',
				'title' => esc_html__('Sticky Menu Background Color', 'resort'),
				'output' => array( 'background' => '#header .top_nav.affix'),
				'default' => array(
					'color'     => '',
					'alpha'     => 1
				),
			),
			array(
				'id'          => 'sticky_menu_color_first_level',
				'type'        => 'typography', 
				'title'       => __('Sticky Menu - first level', 'resort'),
				'google'      => true, 
				'font-backup' => true,
				'output'      => array('#header .top_nav.affix .nav-footer li a'),
				'units'       =>array('px','%','em'),
				'default'     => array(
					'color'       => '', 
					'font-style'  => '', 
					'font-family' => '', 
					'google'      => true,
					'font-size'   => '', 
					'line-height' => ''
				),
			),
			array(
				'id' => 'sticky_menu_color_first_level_hover',
				'type' => 'color',
				'title' => esc_html__('Sticky Menu color hover - first level', 'resort'),
				'output' => '#header .top_nav.affix .nav-footer li a:hover',
				'default' => ''
			),			
        ),
    ) );

	/* Titlebar  */
	
		Redux::setSection( $opt_name, array(
			'title'     => esc_html__('Titlebar', 'resort'),
			'desc'   => '',
			'class'     => 'main_background',
			'icon'   => 'el el-text-width',
			'submenu' => true,
			'fields'    => array(

			array(
				'id'       => 'tilebar_layout',
				'type'     => 'select',
				'title'    => __('Default Titlebar Layout', 'resort'), 
				'subtitle' => __('Define the titlebar for your page.', 'resort'),
				'options'  => array(
					'1' => 'Header + Title',
					'2' => 'Header + Image + Title',
					'3' => 'Header Only',
				),
				'default'  => '2',
			),
			array(
				'id'       => 'breadcrumb_switch',
				'type'     => 'switch',
				'title'    => esc_html__('Breadcrumbs', 'resort'),
				'subtitle' => esc_html__('Enable / Disable Breadcrumbs', 'resort'),
				'default'  => true,
				),
			array(
				'id'       => 'seprater_eight',
				'url'      => false,
				'type'     => '',
				'class'    => 'background_color',
				'title'    => esc_html__('Titlebar Text', 'resort'),
				
			),
			 array(
				'id'       => 'blog_title',
				'title'   => esc_html__( 'Blog Title', 'resort' ),
				'subtitle' => esc_html__('Title for the blog page.', 'resort'),
				'type'    => 'text',
				'default' => esc_html__( "News", 'resort' )
			),

			
			array(
				'id'       => 'title_background',
				'type'    => 'background',				
				'title'   => esc_html__( 'Title Background Color', 'resort' ),
				'subtitle' => esc_html__('Default: #717e95', 'resort'),
				'output'  => array('section.row.page-cover.final-inner-header'),
				'default'  => array(
					'background-color' => '#717e95',
				)
			),
			array(
				'id'          => 'typography_title',
				'type'        => 'typography', 
				'title'       => __('Title Text', 'resort'),
				'google'      => true, 
				'font-backup' => false,
				'output'      => array('.final-inner-header .this-title'),
				'units'       =>'px',
				'default'     => array(
					'color'       => '#ffffff', 
					'google'      => true
				)
			),
			array(
				'id'             =>'breadcrumb_text',
				'type'           => 'typography',
				'title'          => esc_html__('Breadcrumb Text', 'resort'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>true,
				'subsets'        =>true,
				'font-size'      =>true,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>false,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('.breadcrumb-row .breadcrumb li span, .breadcrumb-row .breadcrumb li'),
				'units'          =>'px',
				'default'        => array(
					'color'       =>"",
					'font-family' =>''
				)
			),
			array(
				'id'       => 'breadcrumb_hover',
				'type'    => 'link_color',
				'output'  => array('.breadcrumb-row .breadcrumb li span , .breadcrumb-row .breadcrumb li'),
				'title'   => esc_html__( 'Breadcrumb Hover Color', 'resort' ),
				'default'        => array(
					'regular'  => '',
					'hover'    => '',
					'active'   => '', 
					'visited'  => ''
				)
			),
			array(
				'id'       => 'breadcrumb_margin_top',
				'type'           => 'spacing',
				'output'         => array('.final-breadcrumb'),
				'mode'           => 'margin',
				'units'          => array('em','px','%'),
				'units_extended' => 'false',
				'title'   => esc_html__( 'Breadcrumb Margin', 'resort' ),
				'subtitle' => esc_html__('Default: 0px', 'resort'),
				'default'        => array(
				
					'margin-top'     => '0px',
					'margin-right'   => '0px',
					'margin-bottom'  => '0px',
					'margin-left'    => '0px',
					'units'          => 'px',

				)
			)
			
		)
	) );
	
		
	 /* Typography  /--------------------------------------------------------- */
	
	Redux::setSection( $opt_name, array(
        'title'     => __('Typography', 'resort'),
		'header'     => '',
		'desc'       => '',
		'icon_class' => 'el-icon-large',
		'icon'       => 'el-icon-font',
		'submenu'    => true,
        'fields'    => array(
		 array(
				'id'             =>'typography_body',
				'type'           => 'typography',
				'title'          => esc_html__('Body', 'resort'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'font-weight'    =>false,
				'all_styles'     =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>true,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>false,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('body'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for your main body text.', 'resort'),
				'default'        => array(
					'font-family'=> 'Arial, Helvetica, sans-serif',
					'font-weight'=> '100%', 
					'height'=>'100%',
					'overflow-x'=> 'hidden',
					'letter-spacing'=> '0.2px'								
				)
			),
			 array(
				'id'             =>'typography_p',
				'type'           => 'typography',
				'title'          => esc_html__('Paragraph', 'resort'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'font-weight'    =>false,
				'all_styles'     =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>true,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>false,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('p'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for your Paragraph text.', 'resort'),
				'default'        => array(
					'font-family'=> 'Arial, Helvetica, sans-serif',
					'font-weight'=> '100%', 
					'height'=>'auto',
					'overflow-x'=> 'hidden',
					'letter-spacing'=> '0.2px'								
				)
			),
			array(
				'id'             =>'typography_h1',
				'type'           => 'typography',
				'title'          => esc_html__('Heading H1', 'resort'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>false,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>true,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('h1, .h1'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for heading h1', 'resort'),
				'default'        => array(
					'color'       =>"#242424",
					'font-family' =>'Arial, Helvetica, sans-serif',
				)
			),
			array(
				'id'             =>'typography_h2',
				'type'           => 'typography',
				'title'          => esc_html__('Heading H2', 'resort'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>false,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>true,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('h2, .h2'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for heading h2', 'resort'),
				'default'        => array(
					'color'       =>"#242424",
					'font-family' =>'Arial, Helvetica, sans-serif',
				)
			),
			array(
				'id'             =>'typography_h3',
				'type'           => 'typography',
				'title'          => esc_html__('Heading H3', 'resort'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>false,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>true,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('h3, .h3'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for heading h3 ...', 'resort'),
				'default'        => array(
					'color'       =>"#242424",
					'font-family' =>'Arial, Helvetica, sans-serif',
				)
			),
			array(
				'id'             =>'typography_h4',
				'type'           => 'typography',
				'title'          => esc_html__('Heading H4', 'resort'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>false,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>true,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('h4, .h4'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for heading h4 ...', 'resort'),
				'default'        => array(
					'color'       =>"#242424",
					'font-family' =>'Arial, Helvetica, sans-serif',
				)
			),
			array(
				'id'             =>'typography_h5',
				'type'           => 'typography',
				'title'          => esc_html__('Heading H5', 'resort'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>false,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>true,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('h5, .h5'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for heading h5', 'resort'),
				'default'        => array(
					'color'       =>"#242424",
					'font-family' =>'Arial, Helvetica, sans-serif',
				)
			),
			array(
				'id'             =>'typography_h6',
				'type'           => 'typography',
				'title'          => esc_html__('Heading H6', 'resort'),
				'compiler'       =>true,
				'google'         =>true,
				'font-backup'    =>false,
				'all_styles'     =>true,
				'font-weight'    =>true,
				'font-style'     =>false,
				'subsets'        =>true,
				'font-size'      =>false,
				'line-height'    =>false,
				'word-spacing'   =>false,
				'letter-spacing' =>true,
				'color'          =>true,
				'preview'        =>true,
				'output'         => array('h6, .h6'),
				'units'          =>'px',
				'subtitle'       => esc_html__('Select custom font for heading h6', 'resort'),
				'default'        => array(
					'color'       =>"#242424",
					'font-family' =>'Arial, Helvetica, sans-serif',
				)
			),
		),
		
    ) );
	
	  /* Social Media /--------------------------------------------------------- */
    Redux::setSection( $opt_name, array(
		'title'  => esc_html__( 'Social Media', 'resort' ),
		'desc'   => 'Enter social url here and then active them in footer or header options. Please add full URLs include http://',
		'icon'   => 'el-icon-address-book',
		'submenu' => true,
        'fields'    => array(

            array(
					'id'       => 'footer_social',
					'type'     => 'switch',
					'title'    => esc_html__('Enable footer connect social icon', 'resort'),
					'default'  => false,
				),
				array(
					'id'       => 'twitter-social',
					'type'     => 'checkbox',
					'title'    => esc_html__('Enable Twitter?', 'resort'),
					'default'  => false,
					
				),
				array(
					'id'       =>'twitter-value',
					'type'     => 'text',
					'title'    => esc_html__('Twitter', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Twitter URL.', 'resort'),
					'required' => array('twitter-social','=',true,),
					           
				),
				
				array(
					'id'       => 'facebook-social',
					'type'     => 'checkbox',
					'title'    => esc_html__('Enable Facebook?', 'resort'),
					'default'  => false,
					
				),
				array(
					'id'       =>'facebook-value',
					'type'     => 'text',
					'title'    => esc_html__('Facebook', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Facebook URL.', 'resort'),
					'required' => array('facebook-social','=',true,),
					           
				),

				array(
					'id'       => 'linkedin-social',
					'type'     => 'checkbox',
					'title'    => esc_html__('Enable Linkedin?', 'resort'),
					'default'  => false,
					
				),
				array(
					'id'       =>'linkedin-value',
					'type'     => 'text',
					'title'    => esc_html__('Linkedin', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Linkedin URL.', 'resort'),
					'required' => array('linkedin-social','=',true,),
					           
				),
	
				array(
					'id'       => 'pinterest-social',
					'type'     => 'checkbox',
					'title'    => esc_html__('Enable Pinterest?', 'resort'),
					'default'  => false,
					
				),
				array(
					'id'       =>'pinterest-value',
					'type'     => 'text',
					'title'    => esc_html__('Pinterest', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Pinterest URL.', 'resort'),
					'required' => array('pinterest-social','=',true,),
					           
				),
	
				array(
					'id'       => 'google-social',
					'type'     => 'checkbox',
					'title'    => esc_html__('Enable Google?', 'resort'),
					'default'  => false,
					
				),
				array(
					'id'       =>'google-value',
					'type'     => 'text',
					'title'    => esc_html__('Google', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Google URL.', 'resort'),
					'required' => array('google-social','=',true,),
					           
				),
				
				array(
					'id'       => 'instagram-social',
					'type'     => 'checkbox',
					'title'    => esc_html__('Enable Instagram?', 'resort'),
					'default'  => false,
					
				),
				array(
					'id'       =>'instagram-value',
					'type'     => 'text',
					'title'    => esc_html__('Instagram', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Instagram URL.', 'resort'),
					'required' => array('instagram-social','=',true,),
					           
				),				
				array(
					'id'       => 'yelp-social',
					'type'     => 'checkbox',
					'title'    => esc_html__('Enable Yelp?', 'resort'),
					'default'  => false,
					
				),
				array(
					'id'       =>'yelp-value',
					'type'     => 'text',
					'title'    => esc_html__('Yelp', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Yelp URL.', 'resort'),
					'required' => array('yelp-social','=',true,),
					           
				),
				
				array(
					'id'       => 'foursquare-social',
					'type'     => 'checkbox',
					'title'    => esc_html__('Enable Foursquare?', 'resort'),
					'default'  => false,
					
				),
				array(
					'id'       =>'foursquare-value',
					'type'     => 'text',
					'title'    => esc_html__('Foursquare', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Foursquare URL.', 'resort'),
					'required' => array('foursquare-social','=',true,),
					           
				),
				array(
					'id'       => 'flickr-social',
					'type'     => 'checkbox',
					'title'    => esc_html__('Enable Flickr?', 'resort'),
					'default'  => false,
					
				),
				array(
					'id'       =>'flickr-value',
					'type'     => 'text',
					'title'    => esc_html__('Flickr', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Flickr URL.', 'resort'),
					'required' => array('flickr-social','=',true,),
					           
				),
				array(
					'id'       => 'youtube-social',
					'type'     => 'checkbox',
					'title'    => esc_html__('Enable Youtube?', 'resort'),
					'default'  => false,
					
				),
				array(
					'id'       =>'youtube-value',
					'type'     => 'text',
					'title'    => esc_html__('Youtube', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Youtube URL.', 'resort'),
					'required' => array('youtube-social','=',true,),
					           
				),
				
				array(
					'id'       => 'email-social',
					'type'     => 'checkbox',
					'title'    => esc_html__('Enable Email?', 'resort'),
					'default'  => false,
					
				),
				array(
					'id'       =>'email-value',
					'type'     => 'text',
					'title'    => esc_html__('Email', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Email URL.', 'resort'),
					'required' => array('email-social','=',true,),
					           
				),
			
				array(
					'id'       => 'rss-social',
					'type'     => 'checkbox',
					'title'    => esc_html__('Enable Rss?', 'resort'),
					'default'  => false,
					
				),
				array(
					'id'       =>'rss-value',
					'type'     => 'text',
					'title'    => esc_html__('Rss', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter your Rss URL.', 'resort'),
					'required' => array('rss-social','=',true,),
					           
				),			
        ),
    ) );
	
	
	/* Blog Pages Layout /--------------------------------------------------------- */
	
		Redux::setSection( $opt_name, array(
			'title'     => esc_html__('Blog', 'resort'),
			'desc'   => '',
			'class'     => 'main_background',
			'icon'   => 'el el-globe',
			'submenu' => true,
			'fields'    => array(
        
     		array(
				'id'       => 'blog_metadata',
				'type'     => 'switch',
				'title'    => esc_html__('Metadata on Blog Posts', 'resort'),
				'subtitle'       => esc_html__('Enable / Disable Metadata on Blog Posts.', 'resort'),
				'default'  => true,
			),
			array(
				'id'       => 'blog_multi_checkbox',
				'type'     => 'checkbox',
				'title'    => __('Metadata Options', 'resort'), 
				'subtitle' => __('Check the Metadata you want to show on Blog Posts.', 'resort'),
				'options'  => array(
					'1' => 'Date',
					'2' => 'Author',
					'3' => 'Comments',
					'4' => 'Tags(Only on Blog Post Details.)'
				),
				'default' => array(
					'1' => '1', 
					'2' => '1', 
					'3' => '1',
					'4' => '1'
				)
			),
			array(
				'id'       => 'blog_sidebar_type',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Sidebar Type', 'resort' ),
				'options' => array(
					'wp' => esc_html__( 'Wordpress Sidebars', 'resort' ),
					'vc' => esc_html__( 'VC Sidebars', 'resort' )
				),
				'default' => 'wp'
			),
			
			array(
				'id'       => 'blog_wp_sidebar',
				'type'      => 'select',
				'data' => 'sidebars',
				'title'     => esc_html__( 'Wordpress Sidebar', 'resort' ),
				'default'   => 'resort-right-sidebar'
			),
			 array(
			'id'       => 'blog_vc_sidebar',
			'type'     => 'select',
			'multi'    => false,
			'data'     => 'posts',
			'args'     => array( 'post_type' =>  array( 'sidebar', 'nyheter_forbundet', 'stup' ), 'numberposts' => -1 ),
			'title'    => esc_html__( 'VC Sidebar', 'resort' ),
			'required' => array('blog_sidebar_type','=','vc', ),
			),
			array(
				'id'       => 'blog_sidebar_position',
				'type'    => 'image_select',
				'title'   => esc_html__( 'Blog Layout', 'resort' ),
				'subtitle' => __('Select the Sidebar Position for Blog Pages.', 'resort'),
				'options' => array(
					'left'  => array(
									'alt'   => '1', 
									'img'   => get_template_directory_uri() .'/assets/images/blogLayout/layout-1.jpg'
								),
					'right' => array(
									'alt'   => '2', 
									'img'   => get_template_directory_uri() .'/assets/images/blogLayout/layout-2.jpg'
								)
				),
				'default' => 'right'
			),
			array(
				'id'       => 'blog_pagination',
				'type'     => 'switch',
				'title'    => esc_html__('Previous / Next Pagination', 'resort'),
				'subtitle'       => esc_html__('Enable / Disable pagination for Blog Pages.', 'resort'),
				'default'  => true,
			),
			array(
				'id'       => 'seprater_blog_one',
				'url'      => false,
				'type'     => '',
				'class'    => 'background_color',
				'title'    => esc_html__('Blog Post Detail Page', 'resort'),
				
			),
			array(
				'id'       => 'detail_sidebar_position',
				'type'    => 'image_select',
				'title'   => esc_html__( 'Blog Detail Layout', 'resort' ),
				'subtitle' => __('Select the Sidebar Position for Blog Detail Pages.', 'resort'),
				'options' => array(
					'left'  => array(
									'alt'   => '1', 
									'img'   => get_template_directory_uri() .'/assets/images/blogLayout/layout-1.jpg'
								),
					'right' => array(
									'alt'   => '2', 
									'img'   => get_template_directory_uri() .'/assets/images/blogLayout/layout-2.jpg'
								)
				),
				'default' => 'right'
			),
			array(
				'id'       => 'blogdetail_metadata',
				'type'     => 'switch',
				'title'    => esc_html__('Metadata on Blog Detail Posts', 'resort'),
				'subtitle'       => esc_html__('Enable / Disable Metadata on Blog Detail Pages.', 'resort'),
				'default'  => true,
			),
			array(
				'id'       => 'blogdetail_multi_checkbox',
				'type'     => 'checkbox',
				'title'    => __('Metadata Options Of Blog Detail Page', 'resort'), 
				'subtitle' => __('Check the Metadata you want to show on Blog Detail Pages.', 'resort'),
				'options'  => array(
					'date' => 'Date',
					'author' => 'Author',
					'comment' => 'Comments',
					'tag' => 'Tags(Only on Blog Post Details.)'
				),
				'default' => array(
						'date'    => '1', 
						'author'  => '1', 
						'comment' => '1',
						'tag'     => '1'
					)
			),

		)
	) );
			
		 /* Footer /--------------------------------------------------------- */		 
		 Redux::setSection( $opt_name, array(
        'title'     => __('Footer', 'resort'),
		'header'     => '',
		'desc'       => '',
		'icon'       => 'el-icon-photo',
		'class'     => 'main_background',
		'submenu'    => true,
        'fields'    =>  array(

				array(
				'id'       => 'footer_widget',
				'type'     => 'switch',
				'title'    => esc_html__('Footer Widget Area', 'resort'),
				'subtitle' => __('Enable / Disable Widgetzed Footer Area', 'resort'),
				'default'  => true,
			    ),
				
				array(
					'id'       => 'footer_sidebar_count',
					'type'     => 'image_select',
					'title'    => __('Footer Widget Columns', 'resort'), 
					'subtitle' => __('Select Footer Columns', 'resort'),
					'description' => __('', 'resort'),
					'options'  => array(
						'1'      => array(
							'alt'   => '1', 
							'img'   => get_template_directory_uri() .'/assets/images/footers/col-1.jpg'
						),
						
						'2'      => array(
							'alt'   => '2', 
							'img'   => get_template_directory_uri() .'/assets/images/footers/col-2.jpg'
						),
						'3'      => array(
							'alt'   => '3', 
							'img'   => get_template_directory_uri() .'/assets/images/footers/col-3.jpg'
						),
						'4'      => array(
							'alt'   => '4', 
							'img'   => get_template_directory_uri() .'/assets/images/footers/col-4.jpg'
						)
					),
					'default' => '4'
				),
				
				array(
				'id'       => 'seprater_four',
				'url'      => false,
				'type'     => '',
				'class'    => 'background_color',
				'title'    => esc_html__('Footer Information Fields', 'resort'),
				
				),
	
				array(
						'id'       => 'footer_text',
						'title'   => esc_html__( 'Footer Text', 'resort' ),
						'type'    => 'text',
						'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscn gelit, sed do eiusmod tempor incididunt ut labore et dolore magna ali qua.', 'resort' )
				),
					
				array(
				'id'       => 'footer_social_enable',
				'type'     => 'switch',
				'title'    => esc_html__('Enable Footer connect social icon', 'resort'),
				'default'  => true,
				),
				array(
				'id'       => 'seprater_three',
				'url'      => false,
				'type'     => '',
				'class'    => 'background_color',
				'title'    => esc_html__('Copyright', 'resort'),
				
				),
					
				array(
				'id'       => 'copyright_switch',
				'type'     => 'switch',
				'title'    => esc_html__('Copyright Area', 'resort'),
				'subtitle' => __('Enable / Disable Copyright Area', 'resort'),
				'default'  => true,
			    ),
				
				array(
				'id'       => 'footer_copyright',
				'type'     => 'textarea',
				'title'    => esc_html__('Copyright Text', 'resort'),
				'subtitle' => __('Enter your Copyright Text (HTML allowed).', 'resort'),
				'default'  => esc_html__( 'Copyright © 2012-2017 resort All rights reserved. Created by: DesignArc', 'resort')
			    ),
				
				array(
					'id'       => 'copy_right',
					'type'      => 'textarea',
					'title'     => esc_html__( 'Copyright Right Content', 'resort' ),
					'default'   => esc_html__('Developed by: <a href="https://themeforest.net/user/themechampion"> ThemeChampion</a>', 'resort')
				),							
		)
) );


/* Custom CSS /--------------------------------------------------------- */
     Redux::setSection( $opt_name, array(
		'icon'       => 'el-icon-css',
		'icon_class' => 'el-icon-large',
		'class'     => 'main_background',
		'title'      => esc_html__('Custom CSS', 'plumbing'),
		'submenu'    => true,
        'fields'    => array(
				array(
						'id'       => 'site_css',
						'type'     => 'ace_editor',
						'title'    => esc_html__( 'CSS Code', 'plumbing' ),
						'subtitle' => esc_html__( 'Paste your custom CSS code here.', 'plumbing' ),
						'mode'     => 'css',
						'theme'    => 'monokai',
						'desc'     => 'Possible modes can be found at <a href="'. esc_url( 'http://ace.c9.io' ) .'" target="_blank">'. esc_attr( 'http://ace.c9.io' ) .'</a>.',
						'default'  => ""
					),
				
				),
		) ); 

/* Auto Update] /--------------------------------------------------------- */
    Redux::setSection( $opt_name, array(
		'icon'       => 'el-icon-random',
		'icon_class' => 'el-icon-large',
		'title'      => esc_html__('One Click Update', 'resort'),
		'desc'    => esc_html__( 'Let us notify you when new versions of this theme are live on ThemeForest! Update with just one button click and forget about manual updates!<br> If you have any troubles while using auto update ( It is likely to be a permissions issue ) then you may want to manually update the theme as normal.', 'resort' ),
		'submenu'    => true,
        'fields'    => array(

			array(
					'id'       =>'tf_username',
					'type'     => 'text',
					'title'    => esc_html__('ThemeForest Username', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter here your ThemeForest (or Envato) username account (i.e. resort).', 'resort'),
				),
				array(
					'id'       =>'tf_api',
					'type'     => 'text',
					'title'    => esc_html__('ThemeForest Secret API Key', 'resort'),
					'subtitle' => '',
					'desc'     => esc_html__('Enter here the secret api key you have created on ThemeForest. You can create a new one in the Settings > API Keys section of your profile.', 'resort'),
				),
				array(
					'id'    => 'info_warning',
					'type'  => 'info',
					'title' => esc_html__('One Click Update Note: ', 'resort'),
					'style' => 'warning',
					'desc'  => esc_html__('If the one click update does not works for you ( ( It is likely to be a permissions issue ) ) then please do manual update or use <a target="_blank" href="https://github.com/envato/wp-envato-market">WP Envato Market</a>. Thanks!', 'resort')
				),
        ),
    ) );
   
/* ------------------------------------------------------------------------ */
/* Custom function for resorttheme's own CSS
/* ------------------------------------------------------------------------ */

function overridePanelCSS() {   
    wp_enqueue_style('redux-custom-css');
}
add_action( 'redux/page/resort_option/enqueue', 'overridePanelCSS' );

function tmc_option_styles() {
    $plugin_url =  plugins_url('', __FILE__);
    wp_enqueue_style( 'admin-styles', $plugin_url . '/style.css', null, null, 'all' );
}

add_action( 'admin_enqueue_scripts', 'tmc_option_styles' );

