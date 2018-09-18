<?php
if ( !defined( 'ABSPATH' ) ) {
	exit();
}
?>
<div class="hb-order-new-customer" id="hb-order-new-customer">
    <div class="hb-col-padding hb-col-border">
        <h4><?php _e( 'New Customer', 'resort' ); ?></h4>
        <ul class="hb-form-table col-2">
            <li class="hb-form-field">
                <label class="hb-form-field-label"><?php _e( 'Title', 'resort' ); ?>
                    <span class="hb-required">*</span> </label>

                <div class="hb-form-field-input">
					<?php hb_dropdown_titles( array( 'selected' => $customer->title ) ); ?>
                </div>
            </li>
            <li class="hb-form-field">
                <label class="hb-form-field-label"><?php _e( 'First name', 'resort' ); ?>
                    <span class="hb-required">*</span></label>

                <div class="hb-form-field-input">
                    <input type="text" name="first_name" value="<?php echo esc_attr( $customer->first_name ); ?>" placeholder="<?php _e( 'First name', 'resort' ); ?>" />
                </div>
            </li>
            <li class="hb-form-field">
                <label class="hb-form-field-label"><?php _e( 'Last name', 'resort' ); ?>
                    <span class="hb-required">*</span></label>

                <div class="hb-form-field-input">
                    <input type="text" name="last_name" value="<?php echo esc_attr( $customer->last_name ); ?>" placeholder="<?php _e( 'Last name', 'resort' ); ?>" required />
                </div>
            </li>
            <li class="hb-form-field">
                <label class="hb-form-field-label"><?php _e( 'Address', 'resort' ); ?>
                    <span class="hb-required">*</span></label>

                <div class="hb-form-field-input">
                    <input type="text" name="address" value="<?php echo esc_attr( $customer->address ); ?>" placeholder="<?php _e( 'Address', 'resort' ); ?>" />
                </div>
            </li>
            <li class="hb-form-field">
                <label class="hb-form-field-label"><?php _e( 'City', 'resort' ); ?>
                    <span class="hb-required">*</span></label>

                <div class="hb-form-field-input">
                    <input type="text" name="city" value="<?php echo esc_attr( $customer->city ); ?>" placeholder="<?php _e( 'City', 'resort' ); ?>" />
                </div>
            </li>
            <li class="hb-form-field">
                <label class="hb-form-field-label"><?php _e( 'State', 'resort' ); ?>
                    <span class="hb-required">*</span></label>

                <div class="hb-form-field-input">
                    <input type="text" name="state" value="<?php echo esc_attr( $customer->state ); ?>" placeholder="<?php _e( 'State', 'resort' ); ?>" />
                </div>
            </li>
        </ul>
        <ul class="hb-form-table col-2">
            <li class="hb-form-field">
                <label class="hb-form-field-label"><?php _e( 'Postal Code', 'resort' ); ?>
                    <span class="hb-required">*</span></label>

                <div class="hb-form-field-input">
                    <input type="text" name="postal_code" value="<?php echo esc_attr( $customer->postal_code ); ?>" placeholder="<?php _e( 'Postal code', 'resort' ); ?>" />
                </div>
            </li>
            <li class="hb-form-field">
                <label class="hb-form-field-label"><?php _e( 'Country', 'resort' ); ?>
                    <span class="hb-required">*</span></label>

                <div class="hb-form-field-input">
					<?php hb_dropdown_countries( array( 'name' => 'country', 'show_option_none' => __( 'Country', 'resort' ), 'selected' => $customer->country ) ); ?>
                </div>
            </li>
            <li class="hb-form-field">
                <label class="hb-form-field-label"><?php _e( 'Phone', 'resort' ); ?>
                    <span class="hb-required">*</span></label>

                <div class="hb-form-field-input">
                    <input type="text" name="phone" value="<?php echo esc_attr( $customer->phone ); ?>" placeholder="<?php _e( 'Phone Number', 'resort' ); ?>" />
                </div>
            </li>
            <li class="hb-form-field">
                <label class="hb-form-field-label"><?php _e( 'Email', 'resort' ); ?>
                    <span class="hb-required">*</span></label>

                <div class="hb-form-field-input">
                    <input type="email" name="email" value="<?php echo esc_attr( $customer->email ); ?>" placeholder="<?php _e( 'Email address', 'resort' ); ?>" />
                </div>
            </li>
            <li class="hb-form-field">
                <label class="hb-form-field-label"><?php _e( 'Fax', 'resort' ); ?></label>

                <div class="hb-form-field-input">
                    <input type="text" name="fax" value="<?php echo esc_attr( $customer->fax ); ?>" placeholder="<?php _e( 'Fax', 'resort' ); ?>" />
                </div>
            </li>
        </ul>
        <input type="hidden" name="existing-customer-id" value="" />
    </div>
</div>