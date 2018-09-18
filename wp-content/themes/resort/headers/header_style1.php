<?php global $resort_option; ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/assets/js/sticky-header.js"></script>

<div class="row header-abscon">	

	<?/*<div class="wel-band clearfix ">

		<div class="container">

			<div class="row">					

				<?php if( !empty( $resort_option['top_bar'] )): ?>

					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-left top-left" style="margin-top: 5px;">

						<ul>


							

							<li>

								<?php if($topbar_address = $resort_option['topbar_address'] ): ?>

									<div class="t-icon"><i class="fa fa-map-marker"></i></div>

									<div class="t-txt" style="color: #fff;">
									<?php $site_url = get_site_url(null, '/contact-us', 'https'); ?>
										<a  style="color: #fff;" href="<?php $site_url; ?>"><?php echo esc_html( $topbar_address ); ?></a>
									</div>

								<?php endif; ?>

							</li>

							

							<li>

								<?php if($topbar_email = $resort_option['topbar_email'] ): ?>

									<div class="t-icon"><i class="fa fa-envelope-o"></i></div>

									<div class="t-txt">

										<a style="color: #fff;" href="mailto:<?php echo esc_html( $topbar_email ); ?>"><?php echo esc_html( $topbar_email ); ?></a>


									</div>

								<?php endif; ?>

							</li>

						</ul>

					</div>  



					
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right top-right text-right" 
				style="
    			font-size: 20px;
   				 margin-top: 5px;
				">


							   <?php if($topbar_phone = $resort_option['topbar_phone'] ): ?>

							   										<div class="t-txt" 
							   										style="
   														 			float: right;
   														 			margin: -10px 0;
   														 			font-size: 30px;
   														 			
																	">

									<span style="font-size: 15px;">Звоните круглосуточно:</span>	<a  href="tel:<?php echo esc_html( $topbar_phone ); ?>"><?php echo esc_html( $topbar_phone ); ?></a>

									</div>

									<div class="t-icon" style="float: right; margin: 0 5px;">
									</div>



								<?php endif; ?>
	

					</div>	


										
				<?php endif; ?>

			</div>

		</div>

	</div>*/?>

						

	<div class=" main-menu-wrapper-two ">

		<div class="container ">     

			<div class="row">        

				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 anim-5 anim-5-all rtl-position">

					<div class="logo">

						<?php								

						if (isset($resort_option['site_logo']['url'] )):

							$logo = $resort_option['site_logo']['url']

						?>

						<a title="Гостиница Салют в Балаково" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img alt="Гостиница Салют в Балаково" src="<?php echo esc_url( $logo ); ?>"  alt="<?php bloginfo( 'name' ); ?>" /></a>

						

						<?php elseif($logo = get_template_directory_uri() .'/assets/images/tmp/logo_default.png' ) : 

						?>

							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>"  alt="<?php bloginfo( 'name' ); ?>" /></a>

						

						<?php else: ?>

							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>

					</div>
					<?php /*<div class="logo-text">
						<p>Офицальный сайт<br/> гостиницы в Балаково</p>
					</div> */?>


				</div>



				<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 pad-left-minus ">



					
					<div class="nav-header-right ">

						<!--ul>        
<?/*						
						<?php if(isset($resort_option['header_search']) && ($resort_option['header_search']==1)) { ?>
							<li>

								<button><i class="icon icon-Search"></i></button>

								<ul class="search-box">

									<li>

										<?php get_search_form(); ?>

									</li>

								</ul>

							</li>
						<?php } ?>
							<?php if(isset($resort_option['header_slide']) && ($resort_option['header_slide']==1)) { ?>
							<li class="give-top-pad">
							  	 <a role="button" data-toggle="collapse" href="#sidebarCollapse" aria-expanded="false" aria-controls="sidebarCollapse">
							   		<span class="phone-only"><?php echo esc_html__('Side Menu','resort'); ?></span>
							   		<i class="fa fa-bars"></i>
							   	</a>
							   </li>
							<?php } */?>
						</ul-->

				<!-- 		<?php if($topbar_phone = $resort_option['topbar_phone'] ): ?> -->

							   										<div class="t-txt" style="float: right;font-size: 22px;font-weight:bold;">

									<a  href="tel:<?php echo esc_html( $topbar_phone ); ?>"><span class="telephone"><?php echo esc_html( $topbar_phone ); ?></span>


									<span class="tel-text">круглосуточное заселение</span>	</a>

									

									</div>

								



							<!-- 	<?php endif; ?> -->


					</div>
					
										
					<div class="nav-holder pull-right text-right text-p">

						<div class="nav-footer">

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

<div id="header-wrapper2" 
<?php
if (is_admin())
  echo 'style="top:104px"';
?>>
<div class="container ">
		<nav id="site-navigation2" role="navigation">
			<?php wp_nav_menu('menu=pod-menu'); ?>	
		</nav>
		</div>
</div>