	</div>
	</div>	
	</div> <!--.content_wrapper-->
	<?php
		$logo_tmp = '';	
		global $resort_option;
			?>
	<?php 	
	dynamic_sidebar( 'mailchimp-widget' ); ?>
	<footer id="footer" class=" pad-sec footer">
	
	<?php if( isset($resort_option['footer_widget']) && ($resort_option['footer_widget']== '1') ): ?>
		<?php if( isset($resort_option['footer_sidebar_count'] )): ?>
			<div class="widgets_row">
				<div class="container">
					<div class="footer_widgets">
						<div class="row">
							<?php
							$footer_sidebar_count = intval( $resort_option['footer_sidebar_count'] );
							$col = 12 / $footer_sidebar_count;
							for ( $count = 1; $count <= $footer_sidebar_count; $count ++ ): ?>
								<div class="col-lg-<?php echo esc_attr( $col ); ?> col-md-<?php echo esc_attr( $col ); ?>  col-sm-6 col-xs-12 footer-<?php echo esc_attr($count); ?>">
									<?php if( $count == 1 ): ?>
										<?php /*if ($logo = $resort_option['footer_logo']['url'] ): ?>
											<div class="footer_logo">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>"  alt="<?php bloginfo( 'name' ); ?>" /></a>
											</div>
											<?php elseif( $footer_logo = get_theme_mod( 'footer_logo', get_template_directory_uri() . '/assets/images/tmp/footer/logo_'. $logo_tmp .'default_dark.png' ) ): ?>
											<div class="footer_logo">
												<a href="<?php echo esc_url( home_url( '/' ) ) ?>">
													<img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
												</a>
											</div>
										<?php endif; ?>
										
										<?php if( $footer_text = $resort_option['footer_text'] ): ?>
											<div class="footer_text">
												<p class="about-us-widget"><?php echo esc_html( $footer_text ); ?></p>
											</div>
										<?php endif; */?>	
										
										<?/*<a class= "about-us-widget_a" href= "<?php echo get_home_url().'/about-us/'; ?>"><?php echo esc_html__('Читать далее','resort'); ?> <i class="fa fa-angle-double-right"></i></a>*/?>
										

										
										
									<?php endif; ?>
									<?php dynamic_sidebar( 'resort-footer-' . $count ); ?>
								</div>
							<?php endfor; ?>
						</div>
					</div>	
															<?/*php if( isset($resort_option['footer_social_enable']) && ($resort_option['footer_social_enable']== '1') ): ?>
										<?php $socials = resort_get_socials( 'footer_socials' ); ?>	
											<?php if ( $socials): ?>
												<div class="socials" style="text-align: center;">
													<ul>
														<?php foreach( $socials as $key => $val ): ?>
															<li>
																<a href="<?php echo esc_url( $val ); ?>" target="_blank" class="social-<?php echo esc_attr( $key ); ?>">
																	<i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
																</a>
															</li>
														<?php endforeach; ?>
													</ul>
												</div>
											<?php endif; ?>
										<?php endif; */?>	
<div class="socials" style="text-align: center;">
													<ul>
																													<li>
																<a href="https://vk.com/gostinitsasalut" target="_blank" class="social-facebook">
																	<i class="fa fa-vk"></i>
																</a>
															</li>
															<li>
																<a href="https://www.instagram.com/gostinicasalut/" target="_blank" class="social-instagram">
																	<i class="fa fa-instagram"></i>
																</a>
															</li>
																													<li>
																<a href="" target="_blank" class="social-youtube">
																	<i class="fa fa-youtube"></i>
																</a>
															</li>
															
															<li>
																<a href="#" target="_blank" class="social-google">
																	<i class="fa fa-google"></i>
																</a>
															</li>
																											</ul>
												</div>										
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
		<?php if( isset($resort_option['copyright_switch']) && ($resort_option['copyright_switch']== '1') ): ?>
			<div class="container">
				<div class="footer-bottom">
					<div class="copyright_row">
						<div class="container">
							<div class="copyright">
								<?php if( !empty( $resort_option['footer_copyright'] ) ) { ?>
									<div class="copyright">
										<?php echo wp_kses_post( $resort_option['footer_copyright'] ); ?>
									<?/*<div class="pull-right">
										<?php echo wp_kses_post( $resort_option['copy_right'] ); ?>
									</div>*/?>
									</div>  
								<?php } else { ?>
										<p class="copycenter"><?php echo esc_html__('Copyright &copy; 2018 resort All rights reserved','resort'); ?></p>
								<?php } ?>			 
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>	
	</footer>
</div>


<?php 
	$bttField = '';
		if(isset($resort_option['top_back_button_one']))
	{
		$bttField =  $resort_option['top_back_button_one'];
	}
?>
<?php 
	if( $bttField == 4){ ?>
		
	<?php } else if($bttField == 3){ ?>

			<div id="btt" class="mobileBtt"><i class="fa fa-angle-double-up"></i></div>
		
	<?php } else if($bttField == 2){ ?>

			<div id="btt" class="desktopBtt"><i class="fa fa-angle-double-up"></i></div>
				
	<?php } else { ?> 

			<div id="btt"><i class="fa fa-angle-double-up"></i></div>
	
<?php } ?>


<?php wp_footer(); ?>
<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter44498482 = new Ya.Metrika({ id:44498482, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <!-- /Yandex.Metrika counter -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-98414955-1', 'auto');
  ga('send', 'pageview');

</script>


<!-- Модальное окно №1 -->
   <a href="#x" class="overlay" id="win1"></a>
   <div class="popup">    
  <h2>Август</h2>        
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Пн</th>
        <th>Вт</th>
        <th>Ср</th>
		<th>Чт</th>
        <th>Пт</th>
        <th>Сб</th>
        <th>Вс</th>
      </tr>
    </thead>
    <tbody>
    <tr>
		<td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>1</td>
      </tr>
      <tr>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
		<td>6</td>
        <td>7</td>
        <td>8</td>
<!--  style="background-color: red; color: #fff" -->
      </tr>
	  <tr>
	    <td>9</td>
        <td>10</td>
        <td>11</td>
        <td>12</td>
        <td>13</td>
        <td>14</td>
        <td>15</td>

      </tr>
	  <tr>
        <td>16</td>
        <td>17</td>
        <td>18</td>
        <td>19</td>
        <td>20</td>
        <td>21</td>
        <td>22</td>
      </tr>
        <tr>
        <td>23</td>
        <td>24</td>
        <td>25</td>
        <td>26</td>
        <td>27</td>
        <td>28</td>
        <td>29</td>
      </tr>
        <tr>
        <td>30</td>
        <td>31</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table> 
<ul class="sale">  
	<li> - Постоянные гости. Скидки по предъявлению дисконтных карт -5%, 7%,
10%; </li>
	<li>- Раннее бронирование (за 30дней) - 10%;</li>
	<li>- Семейная. Семьям с детьми доп.место бесплатно (полулюкс в любой день);</li>
	<li>- Массовое заселение. Индивидуальная скидка;</li>
	<li>- Весь месяц июль скидка для молодоженов на все номера - 20%;</li>
	<li>- Скидка выходного дня - 10%;</li>
<!-- 	<li style="color:#fff; background: rgba(239, 23, 23, 0.78);">- Скидка дня  / На категории люкс, люкс-элит, апартаменты -20%</li> -->
	<!-- <li style="color:#fff; background-color: red">- Скидка дня. На категории люкс, люкс-элит, апартаменты -30%;</li> -->
	<li><strong>Скидка не суммируется с другими акциями и
спецпредложениями.</strong></li>
</ul>
  <a class="close"title="Закрыть" href="#close"></a>
    </div>


</body>
</html>