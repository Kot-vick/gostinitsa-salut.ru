<?php
/**
 * The Template for displaying all single products
 *
 * Override this template by copying it to yourtheme/tp-hotel-booking/single-room.php
 *
 * @author        ThimPress
 * @package       wp-hotel-booking/templates
 * @version       1.6
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header(); ?>

<?php
/**
 * hotel_booking_before_main_content hook
 */
do_action( 'hotel_booking_before_main_content' );
?>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 my-float-condition single-room-wrapper">
	<?php while ( have_posts() ) : the_post(); ?>

		<div class="room-dec-wrapper">
			<?php hb_get_template_part( 'content', 'single-room' ); ?>
		</div>

	<?php endwhile; // end of the loop. ?>
</div>
<?php
/**
 * hotel_booking_after_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'hotel_booking_after_main_content' );
?>

<?php
/**
 * hotel_booking_sidebar hook
 *
 * @hooked hotel_booking_sidebar - 10
 */
 do_action( 'hotel_booking_sidebar' );
 
 //dynamic_sidebar('resort-booking');
?>
<div class="col-lg-4 col-md-4 booking-sidebar">
	<div class="sidebar-area default_widgets">
		<?/*php dynamic_sidebar( 'resort-booking' ); */?>

		<h5 class="widget_title">Стоимость</h5>

		<div class="white-blokc"> 

			<div class="price" style="height: auto">
				<!-- <i></i> --><span class="single-prise"><?php echo do_shortcode( '[types field="price-room" id="$current_page"][/types]' );?> руб/сутки<span>
			</div><!-- price -->


			<?/*
			<div class="price">
				<!-- <i></i> --><span class="single-prise"><?php echo do_shortcode( '[types field="new-price" id="$current_page"][/types]' );?> руб/сутки<span>
			</div><!-- price -->
			

			<div class="breakfast">
				<i></i><span class="single-prise">Завтрак в подарок<span>
			</div><!-- breakfast -->*/?>

		</div><!-- white-blokc -->


				<?php 
					global $tmc_option;
					global $resort_option; 
				?>
<!-- 		<h5 style="margin-top: 40px;" class="widget_title">Контактный номер</h5>
			<?php if($topbar_phone = $resort_option['topbar_phone'] ): ?>
				<a href="tel:<?php echo esc_html( $topbar_phone ); ?>"><span class="single-prise"><?php echo esc_html( $topbar_phone ); ?><span></a>
			<?php endif; ?> -->

		<?php echo do_shortcode( '[contact-form-7 id="224" title="Booking"]' );?>


		

	
	</div>
</div>
<?php get_footer(); ?>