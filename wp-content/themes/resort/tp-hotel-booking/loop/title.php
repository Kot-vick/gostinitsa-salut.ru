<?php
/**
 * Product loop title
 *
 * @author  ThimPress
 * @package wp-hotel-booking/templates
 * @version 1.1.4
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
    <h2>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>

	<script>
		jQuery(document).ready(function($){
	      ~$('.this-title').empty();
	      ~$('.this-title').append('Номера');
	   	});
    </script>

