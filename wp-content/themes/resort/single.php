<?php resort_get_header(); ?>
<?php global $resort_option; ?>
<div class="content-area">
	<?php
	while ( have_posts() ) {
		the_post();
			$vc_status = get_post_meta( get_the_ID() , '_wpb_vc_js_status', true); ?>
				<div class="entry-content">
					<?php if ( $vc_status != 'false' && $vc_status == true ): ?>
						<?php the_content(); ?>
					<?php else: ?>
						
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

							if ( ! empty($resort_option['detail_sidebar_position'])) {
								$sidebar_position = $resort_option['detail_sidebar_position'];
							} else {
								$sidebar_position = 'right';
							} 	
							?>
						<?php 
						$resort_layout = resort_get_structure( $sidebar_id, $sidebar_type, $sidebar_position);
						echo $resort_layout['content_before']; ?>
						<div class="without_vc">
							<?php if ( get_post_meta( get_the_ID(), 'disable_title', true ) ): ?>
								<?php the_title( '<h1 class="h2 no_stripe page_title_2">', '</h1>' ); ?>
							<?php endif; ?>
							<div class="post_details">
								<div class="single-blog-post img-cap-effect margin-low-decrease">
									<div class="img-holder">
										<?php
										if( has_post_thumbnail( ) ) {
											echo '<div class="post-thumbnail news-image">';
											the_post_thumbnail( 'blog-large' );
											echo '</div>';
										?>
										<?php if(isset($resort_option['blogdetail_metadata']) && $resort_option['blogdetail_metadata'] == '1'){ ?>
												<?php if(isset($resort_option['blogdetail_multi_checkbox']) && $resort_option['blogdetail_multi_checkbox']['date'] == '1'){ ?>

												<div class="date-box">
													<div class="date-inner">
														<div class="date-c-inner">
													<p><?php echo get_the_date("d"); ?><span><?php echo get_the_date("M"); ?></span></p>
													</div>
													</div>
												</div>
											
										<?php } ?>
										<?php } ?>										
										<?php } ?>
									</div>
									<div class="tmc_post_details clearfix">
										<?php if(isset($resort_option['blogdetail_metadata']) && $resort_option['blogdetail_metadata'] == '1'){ ?>
										<div class="entry-meta post-page-meta my-color-class">
											<?php if(isset($resort_option['blogdetail_multi_checkbox']) && $resort_option['blogdetail_multi_checkbox']['author'] == '1'){ ?>
											<span><i class="fa fa-user"></i><?php echo esc_html__('By:', 'resort'); ?> <a href="<?php echo get_permalink(); ?>"><?php the_author(); ?></a></span>
											<?php } ?>
											<?php if(isset($resort_option['blogdetail_multi_checkbox']) && $resort_option['blogdetail_multi_checkbox']['tag'] == '1'){ ?>
											<span><i class="fa fa-tag"></i><a href="<?php echo get_permalink(); ?>"><?php echo implode( ', ', wp_get_post_tags( get_the_ID(), array( 'fields' => 'names' ) ) ) ?></a></span>
											<?php } ?>
											<?php if(isset($resort_option['blogdetail_multi_checkbox']) && $resort_option['blogdetail_multi_checkbox']['comment'] == '1'){ ?>
											<span><i class="fa fa-comments-o"></i><?php echo esc_html__('Comments:', 'resort'); ?> <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></span>
											<?php } ?>
										</div>
										<?php	} ?>
										</div>

									<header class="entry-header">
										<?php the_title( sprintf( '<h3 class="entry-title margin-low-decrease-up "><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
									</header><!-- .entry-header -->
								</div>
							</div>
							<div class="wpb_text_column">
								<?php the_content(); ?>
							</div>
							
							
							<?php
							wp_link_pages( array(
								'before'      => '<div class="page-links"><label>' . esc_html__( 'Pages:', 'resort' ) . '</label>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '%',
								'separator'   => '',
							) );
							?>
							<?php if ( comments_open() || get_comments_number() ) : ?>
								<div class="tmc_post_comments">
									<?php comments_template(); ?>
								</div>
							<?php endif; ?>
						</div>
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
					<?php endif; ?>
				</div> <!-- #post-## -->		
	<?php } ?>
</div>
<?php get_footer(); ?>