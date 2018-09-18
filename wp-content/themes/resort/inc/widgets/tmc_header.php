<?php 
class tmc_Header extends WP_Widget {

	public function __construct() {

		// Widget actual processes
        parent::__construct(
	 		'tmc_header',                                                                // Base ID
			__('TMC Header','resort'),                                               // Name
			array( 'description' => __( 'Eye catching posts widget', 'resort' ), )  // Args
		);
	}

 	public function form( $instance ) {

		/* Set up default widget settings. */
        $defaults = array(
            'title'      => '',
            'number'     => 8,
            'post_order' => 'date'
        );
        $instance         = wp_parse_args( (array) $instance, $defaults );

        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = '';
        }

        $number = intval($instance[ 'number' ]);
        if($number<=0){
            $number = 4;
        }

        $post_order_types = array(
           'comment_count' => 'Popular Gallery',
            'date'          => 'Recent Gallery',
            'rand'          => 'Random Gallery'
        );
        ?>

		<p>
    		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','resort'); ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
    	<p>
    		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('How many posts to show ?' ,'resort') ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'post_order' ); ?>"><?php _e('Posts order:', 'resort') ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name( 'post_order' );?>" id="<?php echo $this->get_field_id( 'post_order' );?>">
                <?php foreach ( $post_order_types as $post_order_type=>$post_order_value ) { ?>
                    <option value="<?php echo $post_order_type; ?>" <?php echo ($post_order_type == $instance['post_order']) ? 'selected="selected" ' : '';?>><?php echo $post_order_value; ?></option>
                <?php } ?>
            </select>
        </p>
        
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $instance = array();
        $instance[ 'title' ]      = strip_tags( $new_instance['title'] );
        $instance[ 'number' ]     = intval($new_instance[ 'number' ]);
        $instance[ 'post_order' ] = $new_instance[ 'post_order' ];
		return $instance;
	}

	public function widget( $args, $instance )
	{
		// Outputs the content of the widget
        extract( $args );
        $title      = apply_filters( 'widget_title', $instance['title'] );
        $post_order = $instance['post_order'];
        $number     = intval($instance['number']);
        if($number<=0) $number = 4;
        
		echo $before_widget;

       

        $args = array(
            'post_type' => 'gallery',
            'post_status' => 'publish',
            'posts_per_page' => $number,
            'orderby' => $post_order
        );
        $the_query = new WP_Query( $args );
        $count     = 0;

        if ( $the_query->have_posts() ) :
        echo '<div class="side-menu-widget gallery-widget">
            <div class="title-box">';
				 // Widget title
				if ( ! empty( $title ) ) echo $before_title . esc_attr($title) . $after_title;
				echo '
                <span class="decor-line inline"></span>
            </div>
            <ul class="list-inline">';
            while ( $the_query->have_posts() ) : $the_query->the_post();
                $count ++;
                ?>
		
			
                <li>
                  <a href="<?php the_permalink(); ?>">
							<?php
							if( has_post_thumbnail() ) { the_post_thumbnail( array(80,80) ); }
							?>
						</a>
                </li>


                <?php
            endwhile;
        echo '</ul></div>';
        endif;
        wp_reset_postdata();
        
    	echo $after_widget;
	}
}
register_widget( 'tmc_Header' );