<?php resort_get_header(); ?>
	<section class="error-404">
		<div class="thm-container">
			<div class="text-center">
				<h1><?php echo esc_html__('404','resort'); ?></h1>
				<h2><?php echo esc_html__('Oops! That page cannot be found','resort'); ?></h2>
				<p><?php echo esc_html__('Sorry, but the page you are looking for does not existing','resort'); ?></p>
				<a href="<?php echo get_home_url() ?>" class="thm-button inverse"><?php echo esc_html__('go to home page','resort'); ?></a>
			</div>
		</div>
	</section>
<?php get_footer(); ?>