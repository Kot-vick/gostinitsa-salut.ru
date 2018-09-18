<?php
$atts = vc_map_get_attributes( 'tmc_gallery_one', $atts );
	extract( $atts );
	$output = null;
	$output .= '
	<div class="child-page-wrapper '. esc_attr($el_class) .'">';
	
	if ( $readmore_text == '' )
	{
		$readmore_text = __('Read More', 'resort');
	}

	$col_class = $thumbnail = '';
	if ( $column == 2 ) {
		$col_class = "grid-sm-6";
	} elseif ( $column == 3 ){
		$col_class = "grid-sm-6 grid-md-4";
	} elseif ( $column == 4 ) {
		$col_class = "grid-sm-6 grid-md-3";
	} else {
		$col_class = "grid-sm-6 grid-md-4";
	}
	$count  = 0;

	$slick_rtl = 'false';
	if ( is_rtl() ){
		$slick_rtl = 'true';
	}


	$args = array(
					'post_type' => 'gallery',
					'post_status' => 'publish',
					'order'          => $order,
					'orderby'        => $orderby,
					'posts_per_page' => $number
				);
	$args_c = array(
					 'type'                     => 'post',
					 'child_of'                 => 0,
					 'parent'                   => '',
					 'orderby'                  => 'name',
					 'order'                    => 'ASC',
					 'hide_empty'               => 1,
					 'hierarchical'             => 1,
					 'exclude'                  => '',
					 'number'                   => '',
					 'taxonomy'                 => 'gallery-category',
					 'pad_counts'               => false );  
    
	 $the_service = new WP_Query( $args );
	 $categories = get_categories( $args_c );

	
					$output .= '<script type="text/javascript">
								 jQuery(document).ready(function(){
								   if (jQuery(".mixit-gallery").length) {
								  jQuery(".mixit-gallery").mixItUp();
								  };
								 });
									</script>';
								
				
	if ( $the_service->have_posts() ) :
	
	
		$output .= '<div class="mixit-gallery">';
		 if ( $layout == 'filter' ) { 
   $output .= '<div class="thm-container">
    <div class="project-filter">
     <ul class="gallery-filter anim-5-all text-center">
		<li class="active"><span class="filter" data-filter="all">All</span></li>';
     
       foreach ($categories as $category) {
       $cat = str_replace(" ","_",$category->name);
       
       $output .= '<li><span class="filter" data-filter=".'.esc_attr($cat).'">';
        $output .= $category->name;
       $output .= '</span></li>';     
       }
     $output .= '</ul>
    </div>
   </div>';
	 }
 while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
    
      $terms = get_the_terms (get_the_ID(), 'gallery-category');
	
   if ( !is_wp_error($terms)) : 

   {      
    $arrCat = wp_list_pluck($terms, 'name'); 
	
    
    foreach ($arrCat as $catname) {
     
     $catname = str_replace(" ","_",$arrCat);
    }
    $catlist = implode(" ", $catname);
     
   $output .= '<div class="single-gallery anim-5-all  interoors roof drawing masonryImage mix  '.esc_attr($catlist).' ">
 
      <div class="img-holder hover">
      '.get_the_post_thumbnail( get_the_ID(), 'medium-thumb').'
							<div class="content">
							<div class="link-gallery">
                               <div class="media-right">
                                  <a rel="gallery1" class="fancybox" href="'.get_the_post_thumbnail_url( get_the_ID(), 'medium-thumb').'">
									<i class="icon icon-DSLRCamera"></i>
								</a> 
                                   </div>
                                <div class="media-bottom"><a> '. get_the_title() .'</a></div>
                                
                            </div>							
						</div>
      </div>      
     </div>

    ';
	 if ( $layout == 'grid' ) {
    if ( $count % $column == 0 ) $output .= '
    ';
   }
   } endif;   
  endwhile;

  $output .= '
  </div>';
  else:
   $output .= __( 'Sorry, there is no child pages under your selected page.', 'resort' );
 endif;
 
 wp_reset_postdata();
	
	$output .= '
	</div>';

	echo $output;
	
	?>
	
		