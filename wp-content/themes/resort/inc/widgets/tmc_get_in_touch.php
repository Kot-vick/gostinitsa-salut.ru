<?php
class tmc_Get_In_Touch extends WP_Widget {

	public function __construct() {

		// Widget actual processes
        parent::__construct(
	 		'tmc_get_in_touch',                                                          // tmchampion ID
			__('TMC Get In Touch','resort'),                                         // Name
			array( 'description' => __( 'Eye catching posts widget', 'resort' ), )  // Args
		);
	}

 	public function form( $instance )
	{
		/* Set up default widget settings. */
        $defaults = array(
            'title'      => '',
            'post_order' => 'date'
        );
        $instance         = wp_parse_args( (array) $instance, $defaults );
		
		
		 if ( isset( $instance[ 'footer_getintouch_title' ] ) ) {
            $footer_getintouch_title = $instance[ 'footer_getintouch_title' ];
        } else {
            $footer_getintouch_title = '';
        }
		 if ( isset( $instance[ 'footer_address' ] ) ) {
            $footer_address = $instance[ 'footer_address' ];
        } else {
            $footer_address = '';
        }
		 if ( isset( $instance[ 'footer_phone' ] ) ) {
            $footer_phone = $instance[ 'footer_phone' ];
        } else {
            $footer_phone = '';
        }
		 if ( isset( $instance[ 'footer_email' ] ) ) {
            $footer_email = $instance[ 'footer_email' ];
        } else {
            $footer_email = '';
        }
		
        ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id('footer_getintouch_title'); ?>"><?php _e( 'Title:', 'resort' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'footer_getintouch_title' ); ?>" name="<?php echo $this->get_field_name( 'footer_getintouch_title' ); ?>" type="text" value="<?php echo esc_attr( $footer_getintouch_title ); ?>" />
			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('footer_address'); ?>"><?php _e( 'Address:', 'resort' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'footer_address' ); ?>" name="<?php echo $this->get_field_name( 'footer_address' ); ?>" type="text" value="<?php echo esc_attr( $footer_address ); ?>" />
			
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id('footer_phone'); ?>"><?php _e( 'Phone:', 'resort' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'footer_phone' ); ?>" name="<?php echo $this->get_field_name( 'footer_phone' ); ?>" type="text" value="<?php echo esc_attr( $footer_phone ); ?>" />
		</p>
		
    	<p>
    		<label for="<?php echo $this->get_field_id('footer_email'); ?>"><?php _e( 'Email:', 'resort' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'footer_email' ); ?>" name="<?php echo $this->get_field_name( 'footer_email' ); ?>" type="text" value="<?php echo esc_attr( $footer_email ); ?>" />
		</p>

		
		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $instance = array();
		$instance[ 'footer_getintouch_title' ]= strip_tags( $new_instance['footer_getintouch_title'] );
        $instance[ 'footer_address' ]= strip_tags( $new_instance['footer_address'] );
		$instance[ 'footer_phone' ]= strip_tags( $new_instance['footer_phone'] );
		$instance['footer_email'] = strip_tags( $new_instance['footer_email'] );
        

		return $instance;
	}

	public function widget( $args, $instance )
	{
		// Outputs the content of the widget
        extract( $args );
		global $tmc_option;
		echo $before_widget;
	?>
	
		           <h4 class="widget_title"><?php echo esc_attr($instance[ 'footer_getintouch_title' ]);?></h4>
                    <div class="widget-contact-list row m0">
                       <ul>
                            <li>
                                <i class="fa fa-map-marker"></i>
                                <div class="fleft location_address">
									<?php echo esc_attr($instance[ 'footer_address' ]);?>
                                </div>
                                
                            </li>
                            <li>
                                <i class="fa fa-phone"></i>
                                <div class="fleft contact_no">
                                    <a href="tel:<?php echo esc_attr($instance[ 'footer_phone' ]);?>"><?php echo esc_attr($instance[ 'footer_phone' ]);?></a>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-envelope-o"></i>
                                <div class="fleft contact_mail">
                                    <a href="mailto:<?php echo esc_url($instance[ 'footer_email' ]);?>"><?php echo esc_attr($instance[ 'footer_email' ]);?></a>
                                </div>
                            </li>
                        </ul>
                    </div>
	<?php

        wp_reset_postdata();
    	echo $after_widget;
	}
}
register_widget( 'tmc_get_in_touch' );