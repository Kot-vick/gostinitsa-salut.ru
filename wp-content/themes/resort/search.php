<?php
/**
 * The template for displaying search results pages.
 *
 * @package 
 */

global $post;
resort_get_header();
if($post){

		$tmc_result = $post->ID;
			
	}

 ?>
 	
	<div id="content-wrap" class="container">
		<div class="col-md-4 col-sm-12 search_sidebar awsm">
			<?php dynamic_sidebar( 'resort-left-sidebar'); ?>
		</div>
		
		<div id="primary" class="col-md-8 col-sm-12 tab-content left-sidebar sectpad search-page-results ">
			<main id="main" class="site-main">
				<?php $resort_args = array('post_type' =>  'any', 's' => $s, 'paged' => $paged); query_posts($resort_args);

				if ( have_posts() ) :
					get_template_part('loop-regular'); ?>					
				<?php else : ?>				
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
			</main><!-- #main -->
		</div><!-- #primary -->
		

		
	</div> <!-- /#content-wrap -->
	
	
<?php get_footer(); ?>