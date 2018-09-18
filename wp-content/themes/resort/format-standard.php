<?php /* ************* POST FORMAT IMAGE ************** */

$thumbsize = 'resort-blog-large';
?>
<div <?php post_class("full_width mbot80 standard-post single-blog-post red-margin")?> id="post-<?php the_ID(); ?>">
	<div class="wdt_img news_img shadow_effect effect-apollo ">
		<?php if ( has_post_thumbnail()): 	?>
		
		<a href="<?php the_permalink()  ?>">
			<?php  
			
				echo get_the_post_thumbnail($post->ID, $thumbsize, array('class'=>'img-responsive'));
			
			 ?>
		</a>
		<?php endif;?>

	</div>
	<h3 class="fnt_25 mbot20 news_head no_after entry-title "><a href="<?php echo the_permalink(); ?>"><?php  echo the_title(); ?></a></h3>
	<p class="bye-margin"><?php echo get_the_excerpt(); ?></p>
		<a href="<?php echo the_permalink(); ?>" class="more-link"><?php echo  esc_html_e('Read More', 'resort'); ?></a>
</div>