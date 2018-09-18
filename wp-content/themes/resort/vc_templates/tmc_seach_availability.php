<?php
if ( !defined( 'ABSPATH' ) ) {
	exit();
}
if(function_exists('hb_get_request'))
{
	$check_in_date  = hb_get_request( 'check_in_date' );
	$check_out_date = hb_get_request( 'check_out_date' );
	$adults         = hb_get_request( 'adults', 0 );
	$max_child      = hb_get_request( 'max_child', 0 );
	$uniqid         = uniqid();
}
else
{
	return;
}
?>
<div class="home-search">
<div id="hotel-booking-search-<?php echo uniqid(); ?>" class="hotel-booking-search search-sec search-sec-homet">
<div class="overlay">
	<div class="border">
    <form name="hb-search-form" action="<?php echo get_home_url().'/hotel-search/'; ?>" class="hb-search-form-<?php echo esc_attr( $uniqid ) ?>">
        <ul class="hb-form-table">
            <li class="hb-form-field ser-in-box">
                <div class="hb-form-field-input hb_input_field">
                    <input type="text" name="check_in_date" id="check_in_date_<?php echo esc_attr( $uniqid ); ?>" class="hb_input_date_check" value="<?php echo esc_attr( $check_in_date ); ?>" placeholder="<?php _e( 'Дата заезда', 'resort' ); ?>" />
                </div>
            </li>
			
            <li class="hb-form-field ser-in-box">
                <div class="hb-form-field-input hb_input_field">
                    <input type="text" name="check_out_date" id="check_out_date_<?php echo esc_attr( $uniqid ) ?>" class="hb_input_date_check" value="<?php echo esc_attr( $check_out_date ); ?>" placeholder="<?php _e( 'Дата выезда', 'resort' ); ?>" />
                </div>
            </li>

            <li class="hb-form-field ser-in-box">
                <div class="hb-form-field-input">
					<?php
					hb_dropdown_numbers(
						array(
							'name'              => 'adults_capacity',
							'min'               => 1,
							'max'               => hb_get_max_capacity_of_rooms(),
							'show_option_none'  => __( 'Взрослых', 'resort' ),
							'selected'          => $adults,
							'option_none_value' => 0,
							'options'           => hb_get_capacity_of_rooms()
						)
					);
					?>
                </div>
            </li>

            <li class="hb-form-field ser-in-box">
                <div class="hb-form-field-input">
					<?php
					hb_dropdown_numbers(
						array(
							'name'              => 'max_child',
							'min'               => 1,
							'max'               => hb_get_max_child_of_rooms(),
							'show_option_none'  => __( 'Детей', 'resort' ),
							'option_none_value' => 0,
							'selected'          => $max_child,
							'options'           => hb_get_children_of_rooms()
						)
					);
					?>
                </div>
            </li>
        </ul>
		<?php wp_nonce_field( 'hb_search_nonce_action', 'nonce' ); ?>
        <input type="hidden" name="hotel-booking" value="results" />
        <input type="hidden" name="action" value="hotel_booking_parse_search_params" />
        <p class="hb-submit ser-in-box">
            <!-- <button type="submit"><?php _e( 'Найти', 'resort' ); ?></button> -->
            <a style="
            	font-size: 14px;
			    font-weight: 600;
			    background: #2795bc;
			    color: #fff;
			    border: 0;
			    text-transform: uppercase;
			    max-width: 300px;
			    padding: 12px 50px;
			    top: 6px;
			    position: relative;
    			"

    		href="/rooms/">Найти</a>
        </p>
    </form>
</div>
</div>
</div></div>