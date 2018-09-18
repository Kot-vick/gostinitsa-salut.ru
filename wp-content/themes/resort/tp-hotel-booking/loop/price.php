<?php
/**
 * Loop Price
 *
 * @author        ThimPress
 * @package       wp-hotel-booking/templates
 * @version       1.1.3
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $hb_settings;
$price_display = apply_filters( 'hotel_booking_loop_room_price_display_style', $hb_settings->get( 'price_display' ) );

$prices = hb_room_get_selected_plan( get_the_ID() );
$prices = isset( $prices->prices ) ? $prices->prices : array();

?><?/*<p><?php echo do_shortcode( '[types field="price-room" id="$current_page"][/types]' );?></p>*/?>
<?php if ( $prices ): ?>
	<?php
	$min = min( $prices );
	$max = max( $prices );
	?>
    <p>
        
		<?php if ( $price_display === 'max' ): ?>

          <?php echo  $max . ' &#8381;' ?>

		<?php elseif ( $price_display === 'min_to_max' && $min !== $max ): ?>

          
				<?php echo  $min  . ' &#8381;Р' ?>
                -
				<?php echo  $max  . ' &#8381;' ?>
		

		<?php else: ?>

   <?php echo  $min  . ' &#8381;' ?>

		<?php endif; ?>
        <span><?php _e( 'Сутки', 'resort' ); ?></span>
    </p>
<?php endif; ?>


