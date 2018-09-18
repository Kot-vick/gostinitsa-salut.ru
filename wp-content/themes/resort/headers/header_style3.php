<?php global $resort_option;?>

<div class="row header-abscont">	

	<div class="top-bar-header-three">

		<div class="container">

			<div class="row">					

				<?php if( !empty( $resort_option['top_bar'] )): ?>

					<div class=" pull-left top-left left-infos contact-infos">

						<ul class="list-inline">

							<li>

							   <?php if($topbar_phone = $resort_option['topbar_phone'] ): ?>

									 <a href="#"><i class="fa fa-phone"></i><?php echo esc_html( $topbar_phone ); ?></a>

								<?php endif; ?>

							</li>	

							

							<li>

								<?php if($topbar_address = $resort_option['topbar_address'] ): ?>

											<a href="#"><i class="fa fa-map-marker"></i><?php echo esc_html( $topbar_address ); ?></a>		

								<?php endif; ?>

							</li>

							

							<li>

								<?php if($topbar_email = $resort_option['topbar_email'] ): ?>

										<a href="#"><i class="fa fa-envelope-o"></i><?php echo esc_html( $topbar_email ); ?></a>

								<?php endif; ?>

							</li>

						</ul>

					</div>  

					<div class=" pull-right right-infos link-list">

						<ul class="list-inline">

							<li><a href="#"><?php echo esc_html__('Login','resort'); ?></a></li>

							<li><a href="#"><?php echo esc_html__('Registration','resort'); ?></a></li>

					</div>
					
				<?php endif; ?>

			</div>

		</div>

	</div>

					

	<div class=" main-menu-wrapper-two stricky no-boder top_nav no-background">

		<div class="container ">     

			<div class="row">        

				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 anim-5 anim-5-all">

					<div class="logo">

						<?php								

						if (isset($resort_option['transparent_logo']['url'] )):

							$logo = $resort_option['transparent_logo']['url'];

						?>

						<a class="sticky_logo_trans" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>

						<?php								

						if (isset($resort_option['site_logo']['url'] ))
						{

							$logo_sticky = $resort_option['site_logo']['url'];
						}
						?>

						<a  class="sticky_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo_sticky ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
						
						

						<?php elseif($logo = get_template_directory_uri() .'/assets/images/tmp/logo_default.png' ) : 

						?>

							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>"  alt="<?php bloginfo( 'name' ); ?>" /></a>

						

						<?php else: ?>

							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>

					</div>

				</div>

				<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 pad-left-minus ">

					
					<div class="nav-header-right ">

						<ul>                   
						<?php if(isset($resort_option['header_search']) && ($resort_option['header_search']==1)) { ?>
							<li class="awsm-fd-class">

								<button class="bg-transparent"><i class="icon icon-Search"></i></button>

								<ul class="search-box">

									<li>

										<?php get_search_form(); ?>

									</li>
								</ul>
								
							</li>
						<?php } ?>
							<?php if(isset($resort_option['header_slide']) && ($resort_option['header_slide']==1)) { ?>
								<li class="give-top-pad awsm-c">
							  	 <a role="button" data-toggle="collapse" href="#sidebarCollapse" aria-expanded="false" aria-controls="sidebarCollapse">
							   		<span class="phone-only"><?php echo esc_html__('Side Menu','resort'); ?></span>
							   		<i class="fa fa-bars"></i>
							   	</a>
							   </li>

							<?php } ?>

							</li>

						</ul>

					</div>
					

					<div class="nav-holder pull-right text-right text-p">

						<div class="nav-footer nav-nw-color">

							<div class="nav my-style">

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

			</div>

		</div>

	</div>

</div>