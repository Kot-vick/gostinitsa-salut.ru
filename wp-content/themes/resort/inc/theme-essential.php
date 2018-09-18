<?php
// Comment Section
function tmc_wp_move_comment_field_to_bottom( $fields )
{
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'tmc_wp_move_comment_field_to_bottom' );

// To Add Place holders
add_filter( 'comment_form_default_fields', 'tmc_wp_comment_placeholders' );
function tmc_wp_comment_placeholders( $fields )
{
    $fields['author'] = str_replace('<input','<input placeholder="'.__('Enter your name','resort'). '"', $fields['author'] );	
	$fields['email'] = str_replace('<input','<input placeholder="'. __('Enter your email','resort'). '"',$fields['email']);	
	$fields['email'] = str_replace('<input','<input placeholder="'. __('Enter your email','resort'). '"',$fields['email']);	
    return $fields;
}
add_filter( 'comment_form_defaults', 'tmc_wp_textarea_insert' );

function tmc_wp_textarea_insert( $fields )
{
	$fields['comment_field'] = str_replace('<textarea','<textarea placeholder="'. __('Write Message','resort'). '"',$fields['comment_field']);	
    return $fields;
}
// To remove Website field
function tmc_alter_comment_form_fields($fields){
    $fields['url'] = '';  //removes website field
    return $fields;
}
add_filter('comment_form_default_fields','tmc_alter_comment_form_fields');


if ( ! function_exists( 'resort_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own resort_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @return void
 */
function resort_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php esc_html__( 'Pingback:', 'resort' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'resort' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
        // Proceed with normal comments.
        global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment clearfix">

            <?php echo get_avatar( $comment, 60 ); ?>

            <div class="comment-wrapper">

                <header class="comment-meta comment-author vcard">
                    <?php
                        printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
                            get_comment_author_link(),
                            // If current post author is also comment author, make it known visually.
                            ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'resort' ) . '</span>' : ''
                        );
                        printf( '<a class="comment-time" href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            /* translators: 1: date, 2: time */
                            sprintf( __( '%1$s', 'resort' ), get_comment_date() )
                        );
                        comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'resort' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
                        edit_comment_link( __( 'Edit', 'resort' ), '<span class="edit-link">', '</span>' );
                    ?>
                </header><!-- .comment-meta -->

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php esc_html__( 'Your comment is awaiting moderation.', 'resort' ); ?></p>
                <?php endif; ?>

                <div class="comment-content entry-content">
                    <?php comment_text(); ?>
                    <?php  ?>
                </div><!-- .comment-content -->

            </div><!--/comment-wrapper-->

        </article><!-- #comment-## -->
    <?php
        break;
    endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'tmc_get_header_style' ) ) {
	function tmc_get_header_style() {
		global $resort_option;		
		if ( isset( $resort_option['header_style'] )) {
			$header_style = $resort_option['header_style'];
		} else {
			$header_style = 'tmc_header_1';
		} 
		return $header_style;
	}
}
function header_layout($header_style)
{	

	switch($header_style) {	
		case 'tmc_header_2':
			if( is_front_page() || is_home() ){
				get_template_part( 'headers/header_style2' );
			} else{
				get_template_part( 'headers/header_style1' );
			}
			break;
		case 'tmc_header_3':
			if(is_front_page() || is_home()){
				get_template_part( 'headers/header_style3' );
			} else{
				get_template_part( 'headers/header_style1' );
			}
			break;					 	
		default:
			// header style 1
			get_template_part( 'headers/header_style1' );
			break; 
		} 	
}

// Header Function
if ( ! function_exists( 'resort_get_header' ) ) {
	function resort_get_header() {
		$header = '';
		return get_header( $header );
	}
}
// TMC Updater
if ( ! function_exists( 'tmc_updater' ) ) {
	function tmc_updater() {
	global $resort_option;
		if(!empty($resort_option['envato_username'])){
				$envato_username = $resort_option['envato_username'];
		}
		if(!empty($resort_option['envato_api'])){
				$envato_api_key = $resort_option['envato_api'];
		}

		if ( ! empty( $envato_username ) && ! empty( $envato_api_key ) ) {
			$envato_username = trim( $envato_username );
			$envato_api_key  = trim( $envato_api_key );
			if ( ! empty( $envato_username ) && ! empty( $envato_api_key ) ) {
				load_template( get_template_directory() . '/inc/updater/envato-theme-update.php' );

				if ( class_exists( 'Envato_Theme_Updater' ) ) {
					Envato_Theme_Updater::init( $envato_username, $envato_api_key, 'resort' );
				}
			}
		}
	}

	add_action( 'after_setup_theme', 'tmc_updater' );
}

if ( ! function_exists( 'resort_get_socials' ) ) {
	function resort_get_socials( $type = 'header_socials' ) {
		global $resort_option;
		$socials_array  = array();
		$socials_enable = $resort_option['footer_social'];
		
		if($socials_enable)
		{
			
			if($resort_option['twitter-social'])
			{
				$socials_array['twitter'] = $resort_option['twitter-value'];				
			}
			
			if($resort_option['facebook-social'])
			{
				$socials_array['facebook'] = $resort_option['facebook-value'];
			}
												
			if($resort_option['linkedin-social'])
			{
				$socials_array['linkedin'] = $resort_option['linkedin-value'];
			}
								
			if($resort_option['pinterest-social'])
			{
				$socials_array['pinterest'] = $resort_option['pinterest-value'];
			}
								
			if($resort_option['google-social'])
			{
				$socials_array['google'] = $resort_option['google-value'];
			}
			
			if($resort_option['instagram-social'])
			{
				$socials_array['instagram'] = $resort_option['instagram-value'];
			}
												
			if($resort_option['yelp-social'])
			{
				$socials_array['yelp'] = $resort_option['yelp-value'];
			}
								
			if($resort_option['foursquare-social'])
			{
				$socials_array['foursquare'] = $resort_option['foursquare-value'];
			}
												
			if($resort_option['flickr-social'])
			{
				$socials_array['flickr'] = $resort_option['flickr-value'];
			}	
	
			if($resort_option['youtube-social'])
			{
				$socials_array['youtube'] = $resort_option['youtube-value'];
			}
								
			if($resort_option['email-social'])
			{
				$socials_array['email'] = $resort_option['email-value'];
			}
								
			if($resort_option['rss-social'])
			{
				$socials_array['rss'] = $resort_option['rss-value'];
			}	
					
				return $socials_array;
		}
	}
}

function page_title(){
	$post_id        = get_the_ID();
	$is_shop        = false;
	$is_product     = false;
	global $post;
	global $resort_option;
	$tmc_post_type = get_post_type($post);
	

	$page_for_posts = get_option( 'page_for_posts' );
	if ( is_home() || is_category() || is_search() || is_tag() || is_tax() ) {
		$post_id = $page_for_posts;
	}
	if ( ( function_exists( 'is_shop' ) && is_shop() )
		 || ( function_exists( 'is_product_category' ) && is_product_category() )
		 || ( function_exists( 'is_product_tag' ) && is_product_tag() )
	) {
		$is_shop = true;
	}
	if ( function_exists( 'is_product' ) && is_product() ) {
		$is_product = true;
	}
	if ( $is_shop ) {
		$post_id = get_option( 'woocommerce_shop_page_id' );
	}
	$class = 'page_title';
	if ( get_post_meta( $post_id, 'enable_transparent', true ) ) {
		$class .= ' transparent';
	}
	if ( get_post_meta( $post_id, 'disable_title', true ) ) {
		$class .= ' disable_title';
	}

	?>
	<?php if ( ! get_post_meta( $post_id, 'disable_title_box', true ) ): 
	   
	   if(isset($resort_option['header_background']['url']) )
	   {
		   $innerheader = $resort_option['header_background']['url'];
	   } else{
		   $innerheader = get_template_directory_uri() . '/assets/images/tmp/inner-header.jpg';
	   }	   
	   ?>
	   
	   <?php if(isset($resort_option['tilebar_layout']) && $resort_option['tilebar_layout'] == '1'){
			
			$innerheader = '';
    } ?>
	   
	<?php if(isset($resort_option['tilebar_layout']) && $resort_option['tilebar_layout'] != '3'){ ?>
	   <section class="row page-cover final-inner-header" >

	  <?php // style="background-image:url( <?php echo esc_url($innerheader); php )" ?> 

		<div class="container">
		
		<?php if($tmc_post_type == 'post') { ?>
					<h2 class="page-title this-title"><?php echo $resort_option['blog_title']; ?></h2>
			<?php } else { ?>
			
			<h2 class="page-title this-title"><?php echo resort_page_title( ); ?></h2>
				<?php } ?>
		</div>
		</section>
		
	<?php } ?>
		
	<?php endif; ?>
	
	

	<?php if (isset($resort_option['breadcrumb_switch']) && $resort_option['breadcrumb_switch'] == '1')
		{ ?>
		<div class="row final-breadcrumb"> <div class="container"><?php resort_breadcrumbs(); ?> </div></div>
	<?php } ?>
	

<?php 	
}

if ( ! function_exists( 'resort_page_title' ) ) {
	function resort_page_title( $display = true ) {
		global $wp_locale;

		$title    = '';

		// If there is a post
		if ( is_single() || ( is_home() && ! is_front_page() ) || ( is_page() && ! is_front_page() ) || is_front_page() ) {
			$title = single_post_title( '', false );
		}

		if ( is_home() ) {
			if ( ! get_option( 'page_for_posts' ) ) {
				$title = $single_posts;
			}
		}

		// If there's a post type archive
		if ( is_post_type_archive() ) {
			$post_type = get_query_var( 'post_type' );
			if ( is_array( $post_type ) ) {
				$post_type = reset( $post_type );
			}
			$post_type_object = get_post_type_object( $post_type );
			if ( ! $post_type_object->has_archive ) {
				$title = post_type_archive_title( '', false );
			}
		}

		// If there's a category or tag
		if ( is_category() || is_tag() ) {
			$title = single_term_title( '', false );
		}

		// If there's a taxonomy
		if ( is_tax() ) {
			$term = get_queried_object();
			if ( $term ) {
				$tax   = get_taxonomy( $term->taxonomy );
				$title = single_term_title( '', false );
			}
		}

		// If there's an author
		if ( is_author() && ! is_post_type_archive() ) {
			$author = get_queried_object();
			if ( $author ) {
				$title = $author->display_name;
			}
		}

		// Post type archives with has_archive should override terms.
		if ( is_post_type_archive() && $post_type_object->has_archive ) {
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				$title = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
			} else {
				$title = post_type_archive_title( '', false );
			}
		}
		
		// If it's a search
		if ( is_search() ) {
			$title = esc_html__( 'Search Results', 'resort' );
		}

		// If it's a 404 page
		if ( is_404() ) {
			$title = esc_html__( 'Page not found', 'resort' );
		}

		if ( $display ) {
			echo esc_html( $title );
		} else {
			return esc_html( $title );
		}
	}
}

if ( ! function_exists( 'resort_breadcrumbs' ) ) {
	function resort_breadcrumbs() {
		if ( function_exists( 'bcn_display' ) && ! get_post_meta( get_the_ID(), 'disable_breadcrumbs', true ) ) { ?>
			<div class="row breadcrumb-row">
				<div class="container">
				<ol class="breadcrumb">
					<li><?php bcn_display(); ?></li>
				</ol>
				</div>
			</div>
		<?php }
	}
}

if ( ! function_exists( 'resort_get_structure' ) ) {
	function resort_get_structure( $sidebar_id, $sidebar_type, $sidebar_position, $layout = false ) {

		$output                   = array();
		$output['content_before'] = $output['content_after'] = $output['sidebar_before'] = $output['sidebar_after'] = '';
		
		if ( $sidebar_type == 'vc' ) {
			if ( $sidebar_id ) {
				$sidebar = get_post( $sidebar_id );
			}
		} else {
			if ( $sidebar_id ) {
				$sidebar = true;
			}
		}

		if ( $sidebar_position == 'right' && isset( $sidebar ) ) {
			$output['content_before'] .= '<div class="row"><div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 "><div class="right-sidebar">';
			$output['content_after'] .= '</div></div>';
			$output['sidebar_before'] .= '<div class="col-lg-4 col-md-4 overflow-sidebar">';
			$output['sidebar_after'] .= '</div></div>'; 
		}

		if ( $sidebar_position == 'left' && isset( $sidebar ) ) {
			$output['content_before'] .= '<div class="row"><div class="col-lg-8 col-lg-push-4 col-md-8 col-md-push-4 col-sm-12 col-xs-12"><div class="left-sidebar">';
			$output['content_after'] .= '</div></div>';
			$output['sidebar_before'] .= '<div class="col-lg-4 col-lg-pull-8 col-md-4 col-md-pull-8">';
			$output['sidebar_after'] .= '</div></div>';
		}

		return $output;
	}
}