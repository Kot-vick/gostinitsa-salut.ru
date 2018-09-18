<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package resort
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments">

	<?php if ( have_comments() ): ?>
		<h4>
			<?php comments_number(); ?>
		</h4>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'callback'    => 'resort_comment'
				) );
			?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
			<nav role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'resort' ); ?></h2>
				<div class="nav-links">
					<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'resort' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'resort' ) ); ?></div>				
				</div>				
			</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ): ?>
		<p><?php esc_html_e( 'Comments are closed.', 'resort' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div>