<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/tp-hotel-booking/content-single-room.php
 *
 * @author        ThimPress
 * @package       wp-hotel-booking/templates
 * @version       1.6
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php
/**
 * hotel_booking_before_single_product hook
 *
 */
do_action( 'hotel_booking_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
?>

<div id="room-<?php the_ID(); ?>" <?php post_class( 'hb_single_room' ); ?>>

	<?php
	/**
	 * hotel_booking_before_loop_room_summary hook
	 *
	 * @hooked hotel_booking_show_room_sale_flash - 10
	 * @hooked hotel_booking_show_room_images - 20
	 */
	do_action( 'hotel_booking_before_single_room' );
	?>

    <div class="summary entry-summary">

		<?php
		

		/**
		 * hotel_booking_loop_room_single_price
		 */
		//do_action( 'hotel_booking_loop_room_price' );

		/**
		 * hotel_booking_single_room_gallery hook
		
		do_action( 'hotel_booking_single_room_gallery' );						*/			?>						
		<div class="fotorama" data-allowfullscreen="true" data-width="100%"  data-nav = "thumbs" data-maxheight="463px">		
		<?php	$pictures = get_post_custom_values( 'wpcf-pictures', $post->ID );
			if ( $pictures) {
				foreach ( $pictures as $val_key => $val_val ) {	
					echo '<img src="';
						echo $val_val;
					echo '" >';				
				}
			}									
		?>				
		</div>	
		<h3>Описание номера</h3>	
		<?

		/**
		 * hotel_booking_single_room_title hook
		 */
		// do_action( 'hotel_booking_single_room_title' );
		
		
		/**
		 * hotel_booking_single_room_infomation hook
		 */
		do_action( 'hotel_booking_single_room_infomation' );
		?>

    </div><!-- .summary -->

	<?php
	/**
	 * hotel_booking_after_loop_room hook
	 *
	 * @hooked hotel_booking_output_room_data_tabs - 10
	 * @hooked hotel_booking_upsell_display - 15
	 * @hooked hotel_booking_output_related_products - 20
	 */
	do_action( 'hotel_booking_after_single_room' );
	?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'hotel_booking_after_single_product' ); ?>
