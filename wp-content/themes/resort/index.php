<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package resort
 */
resort_get_header(); ?>
<?php global $resort_option; ?>
<?php
if ( ! empty($resort_option['blog_sidebar_type'])) {
	$sidebar_type = $resort_option['blog_sidebar_type'];	
} else {
	$sidebar_type = 'wp';
}
if ( $sidebar_type == 'wp' && isset($resort_option['blog_wp_sidebar'])  ) {	
	$sidebar_id = $resort_option['blog_wp_sidebar'];	
} else {
		if(isset($resort_option['blog_vc_sidebar'])){
			$sidebar_id = $resort_option['blog_vc_sidebar'];
		}
}
if ( ! empty( $sidebar_id) ) {
	 $sidebar_id =  $sidebar_id;	 
} else {
	$sidebar_id = 'resort-right-sidebar';
}

	if ( ! empty($resort_option['blog_sidebar_position'])) {
		$sidebar_position = $resort_option['blog_sidebar_position'];
	} else {
		$sidebar_position = 'right';
	} 	
	
$resort_layout = resort_get_structure( $sidebar_id, $sidebar_type, $sidebar_position); ?>

<?php echo $resort_layout['content_before']; ?>
	<div>
		<?php
			$posts_class = '';
			$paginate_links_data = paginate_links( array('type' => 'array') );

			if( empty( $paginate_links_data ) ) {
				$posts_class .= ' no-paginate';
			}
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class();?>>
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();	
				?>
					<div class="single-blog-post img-cap-effect margin-low-decrease">
						<div class="img-holder">
							<?php
							if( has_post_thumbnail( ) ) {
								echo '<div class="post-thumbnail news-image">';
								the_post_thumbnail( 'blog-large' );
								echo '</div>'; ?>
								<?php if(isset($resort_option['blog_metadata']) && $resort_option['blog_metadata'] == '1'){ ?>
								<?php if(isset($resort_option['blog_multi_checkbox']) && $resort_option['blog_multi_checkbox'][1] == '1'){ ?>

								<div class="date-box">
									<div class="date-inner">
										<div class="date-c-inner">
									<p><?php echo get_the_date("d"); ?><span><?php echo get_the_date("M"); ?></span></p>
									</div>
									</div>
								</div>
							
						<?php } ?>
						<?php } ?>		

							<?php }
							?>
						</div>

						<?php if ( 'post' == get_post_type() ) : ?>
						
						
						
						<?php if(isset($resort_option['blog_metadata']) && $resort_option['blog_metadata'] == '1'){ ?>
						<div class="entry-meta post-page-meta my-color-class">
							<?php if(isset($resort_option['blog_multi_checkbox']) && $resort_option['blog_multi_checkbox'][2] == '1'){ ?>
							<span><i class="fa fa-user"></i><?php echo esc_html__('By:', 'resort'); ?> <a href="<?php echo get_permalink(); ?>"><?php the_author(); ?></a></span>
							<?php } ?>
							<?php if(isset($resort_option['blog_multi_checkbox']) && $resort_option['blog_multi_checkbox'][4] == '1'){ ?>
							<span><i class="fa fa-tag"></i><a href="<?php echo get_permalink(); ?>"><?php echo implode( ', ', wp_get_post_tags( get_the_ID(), array( 'fields' => 'names' ) ) ) ?></a></span>
							<?php } ?>
							<?php if(isset($resort_option['blog_multi_checkbox']) && $resort_option['blog_multi_checkbox'][3] == '1'){ ?>
							<span><i class="fa fa-comments-o"></i><?php echo esc_html__('Comments:', 'resort'); ?> <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></span>
							<?php } ?>
						</div>
						<?php	} ?>
						

						<?php endif; ?>

						<header class="entry-header">
							<div class="meta-info">
							  <div class="content-box">
								<?php if ( 'post' == get_post_type() ) : ?>
									<?php if ( is_sticky( ) ) {
										echo '<span class="genericon genericon-pinned"></span> ';
									} ?>
								</div></div><!-- .entry-meta -->
								<?php endif; ?>	
							<?php the_title( sprintf( '<h3 class="entry-title "><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
						</header><!-- .entry-header -->
						
						<?php
							/* translators: %s: Name of current post */
							the_content( sprintf(
								__( 'Read More %s <span class="meta-nav"></span>', 'resort' ),
								the_title( '<span class="screen-reader-text">"', '"</span>', false )
							) );
						?>

						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'resort' ),
								'after'  => '</div>',
							) );
						?>						
					</div><!-- .entry-content -->
					<?php
				endwhile;
			 elseif ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'resort' ); ?></p>
		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'resort' ); ?></p> 
		<?php	endif;
			?>
		</div>
	</div>
<?php
if(isset($resort_option['blog_pagination']) && $resort_option['blog_pagination'] == '1'){
echo paginate_links( array(
	'type'      => 'list',
	'prev_text' => '<i class="fa fa-chevron-left"></i>',
	'next_text' => '<i class="fa fa-chevron-right"></i>',
) );
}
?>
<?php echo $resort_layout['content_after']; ?>
<?php echo $resort_layout['sidebar_before']; ?>
<?php
if ( $sidebar_id ) {
	if ( $sidebar_type == 'wp' ) {
		$sidebar = true;
	} else {
		$sidebar = get_post( $sidebar_id );
	}
}
if ( isset( $sidebar ) ) {
	if ( $sidebar_type == 'vc' ) { ?>
		<div class="sidebar-area">
			<?php echo apply_filters( 'the_content', $sidebar->post_content ); ?>
		</div>
	<?php } else { ?>
		<div class="sidebar-area default_widgets">
			<?php dynamic_sidebar( $sidebar_id ); ?>
		</div>
	<?php }
}
?>
<?php echo $resort_layout['sidebar_after']; ?>
<?php get_footer(); ?>