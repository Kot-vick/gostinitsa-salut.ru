<?php /*** The loop to display posts. ***/ 
?>

<div class="blog-posts">
	

<?php
if( have_posts()):

	while ( have_posts() ) : the_post(); 
		if ( get_post_format( $post->ID )):
	
			get_template_part( 'content', get_post_format() );
		else:

			get_template_part('format', 'standard');
		endif;	
	endwhile;
endif;

?>
</div>