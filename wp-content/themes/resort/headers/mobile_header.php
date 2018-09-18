<?php 
global $tmc_option;
global $resort_option; 
?>	
	<div class="wel-band clearfix no-original-display">
		<div class="container">
			<div class="row">					
				<?php if( !empty( $resort_option['top_bar'] )): ?>
					<div class="col-lg-8 col-md-9 col-sm-12 col-xs-12 pull-left top-left">
						<ul>
							<li>
							   <?php if($topbar_phone = $resort_option['topbar_phone'] ): ?>
									<div class="t-icon"><i class="fa fa-phone"></i></div>
									<div class="t-txt">
										
									<a style="color: #a4b6d1;"  href="tel:<?php echo esc_html( $topbar_phone ); ?>"><?php echo esc_html( $topbar_phone ); ?></a>
									</div>
								<?php endif; ?>
							</li>	
							
							<li>
								<?php if($topbar_address = $resort_option['topbar_address'] ): ?>
									<div class="t-icon"><i class="fa fa-map-marker"></i></div>
									<div class="t-txt">
										<?php echo esc_html( $topbar_address ); ?>
									</div>
								<?php endif; ?>
							</li>
							
							<li>
								<?php if($topbar_email = $resort_option['topbar_email'] ): ?>
									<div class="t-icon"><i class="fa fa-envelope-o"></i></div>
									<div class="t-txt">
										<?php echo esc_html( $topbar_email ); ?>
									</div>
								<?php endif; ?>
							</li>
						</ul>
					</div>  
				<?php endif; ?>
				
<!-- 				<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 pull-right top-right text-right">
					<a href="#"><?php echo esc_html__('Login','resort'); ?></a>
					<a href="#"><?php echo esc_html__('Registration','resort'); ?></a>
				</div>	 -->			
			</div>
		</div>
	</div>
						
	<div class="mobile_header top_nav">
		<div class="container">
			<div class="logo_wrapper clearfix">
				<div class="logo" id="tel-logo">
					<?php								
						if (isset($resort_option['site_logo']['url'] )):
						$logo = $resort_option['site_logo']['url']
					?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					
					<?php elseif($logo = get_template_directory_uri() .'/assets/images/tmp/logo_default.png' ) : 
					?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					
					<?php else: ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					<?php endif; ?>



				</div>
					<div class="mob-tel-header" id="mob-header">
					<a href="tel:<?php echo esc_html( $topbar_phone ); ?>" class="mob-tel"> <i class="fa fa-phone" style="  
					color: #000; font-size: 28px;" aria-hidden="true"></i></a>
						</div>
					<div id="menu_toggle">
						<button></button>
					</div>
			</div>
				<div class="header_info">
					<div class="top_nav_mobile">
								<?php wp_nav_menu( array(

									'menu_id' => 'Primary',

									'menu' => 'Primary',

									'theme_location' => 'resort-primary_menu',

									'container'      => false,

									'depth'          => 3,

									'menu_class'     => 'main_menu_nav'

								)

								); ?>
				
					</div>
				</div>
		</div>
	</div>