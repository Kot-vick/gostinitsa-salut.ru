<?php
	$atts = vc_map_get_attributes( 'tmc_recent_news', $atts );
	extract( $atts );

	if ( $readmore_text == '' ) {
		$readmore_text = __('Read More', 'resort');
	}

	$count  = 0;
	$args = array(
		'posts_per_page' => 5,
		'post_type'      => 'post',
		'post_status'    => 'publish'
		//'nopaging' => true
	);
	$recent_posts = new WP_Query( $args );

	$output = null;
	$output .= '
	<div class="child-page-wrapper recent-news-wrapper '. esc_attr($el_class) .'">';

		if ( $widget_title ) $output .= '
		<h3 class="builder-heading">'. esc_attr($widget_title) .'</h3>';

			if ( $recent_posts->have_posts() ) :

				$output .= '
				<div class="grid-wrapper grid-'.esc_attr($column).'-columns grid-row"><div class="thm-container"><div class="row">';

				while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); $count++;

					if($count <= '2'){
					
					$output .= '<div class="col-md-4 col-sm-6 blog-grid">
				<a href="'. get_the_permalink() .'" class="bg-featured-image">'. get_the_post_thumbnail( get_the_ID(), 'large') .'</a>
				<h4 class="bg-post-title"><a href="'. get_the_permalink() .'">'. get_the_title().'</a></h4>
				<div class="bg-post-excerpt">'.get_the_excerpt().'</div>
				<ul class="list-unstyled nav-pills bg-post-meta">
					<li><a href="'. get_the_permalink() .'"><i class="fa fa-user"></i>'.get_the_author().'</a></li>
					<li><a href="'. get_the_permalink() .'"><i class="fa fa-comments-o"></i>Comments: '.get_comments_number( $post_id ).'</a></li>
				</ul>
			</div>';
				}
					else {
				$output .= '<div class="col-md-4 col-sm-12 more-blog-lists">
				<div class="blog-line row">					
					<h4 class="bl-post-title"><a href="'. get_the_permalink() .'">'. get_the_title().'</a></h4>
					<ul class="list-unstyled nav-pills">
						<li><a href="'. get_the_permalink() .'">5 days ago</a></li>
						<li><a href="'. get_the_permalink() .'">resort</a>, <a href="'. get_the_permalink() .'">repairs</a></li>
					</ul>
				</div></div>';}
					
				endwhile;	
				$output .= '<div class="col-md-4 col-sm-12 more-blog-lists left-right"><div class="blog-line row hover-nothing"><a href="'. get_the_permalink() .'" class="redirect-link">Read All News</a></div></div>';
				else:
					$output .= __( 'News listing is not available under the selected page.', 'resort' );
			endif;

			wp_reset_postdata();

	$output .= '
	</div></div></div></div>';

	echo $output;
	?>