<?php
/**
 * The Template for displaying all archive products
 *
 * Override this template by copying it to yourtheme/tp-hotel-booking/archive-room.php
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
 *
 * @hooked hotel_booking_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked hotel_booking_breadcrumb - 20
 */
do_action( 'hotel_booking_before_main_content' );
?>

<?php
/**
 * hotel_booking_archive_description hook
 *
 * @hooked hotel_booking_taxonomy_archive_description - 10
 * @hooked hotel_booking_room_archive_description - 10
 */
do_action( 'hotel_booking_archive_description' );
?>

<?php if ( have_posts() ) : ?>

	<?php
	/**
	 * hotel_booking_before_room_loop hook
	 *
	 * @hooked hotel_booking_result_count - 20
	 * @hooked hotel_booking_catalog_ordering - 30
	 */
	do_action( 'hotel_booking_before_room_loop' );
	?>

	<?php hotel_booking_room_loop_start(); ?>

	<?php hotel_booking_room_subcategories(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

			<?php $content = wp_trim_words( get_the_content(), $num_words = 30, $more = null ); ?>
<div class="reveal-new-pad">		
<div class="room-wrapper">
	<div class="media">
		<div class="media-left">		
		<?php do_action( 'hotel_booking_loop_room_thumbnail' ); ?>
		</div>
		
		<div class="media-body">
		<?php do_action( 'hotel_booking_loop_room_title' ); ?>
		<p><?php echo  $content; ?> </p>
		<h3><?php echo esc_html__('Удобства номера','resort'); ?></h3>
		<h6><?php echo esc_html__('Удобная кровать, Прикроватная тумбочка, Мягкий стул, Телевизор с плоским экраном, Кондиционер, Сейф, Мини бар','resort'); ?></h6>
		</div>
		
		<div class="media-right">
		<?/*php do_action( 'hotel_booking_loop_room_price' ); */?>
		<div class="price-archive">
			<span class="single-prise"><?php echo do_shortcode( '[types field="price-room" id="$current_page"][/types]' );?><br/>руб/сутки<span>
		</div><!-- price -->
		
		<?/*
		<div class="price-archive">
			<span class="single-prise"><?php echo do_shortcode( '[types field="new-price" id="$current_page"][/types]' );?> <br/>руб/сутки<span>
		</div><!-- price -->
		*/?>
		
		<div class="awsm-management"><a href="<?php echo get_permalink(); ?>"><?php echo esc_html__('Просмотреть','resort'); ?></a></div>
		</div>
	</div>
</div>
</div>		
		
		
		
	<?php endwhile; // end of the loop. ?>

	<?php hotel_booking_room_loop_end(); ?>

	<?php
	/**
	 * hotel_booking_after_room_loop hook
	 *
	 * @hooked hotel_booking_pagination - 10
	 */
	do_action( 'hotel_booking_after_room_loop' );
	?>

<?php endif; ?>

<?php
/**
 * hotel_booking_after_main_content hook
 *
 * @hooked hotel_booking_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'hotel_booking_after_main_content' );
?>

<?php
/**
 * hotel_booking_sidebar hook
 *
 * @hooked hotel_booking_get_sidebar - 10
 */
do_action( 'hotel_booking_sidebar' );
?>

<?php get_footer(); ?>