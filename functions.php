<?php
/**
* Theme functions used by Neuro.
*
* Authors: Tyler Cunningham
* Copyright: © 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Neuro.
* @since 2.0
*/

/**
* Define global theme functions.
*/ 
	$themename = 'neuro';
	$themenamefull = 'Neuro';
	$themeslug = 'ne';
	$pagedocs = 'http://cyberchimps.com/question/using-the-neuro-page-options/';
	$sliderdocs = 'http://cyberchimps.com/question/how-to-use-the-feature-slider-in-neuro/';
	$root = get_template_directory_uri(); 	
	
/**
* Assign new default font.
*/ 
function neuro_default_font( $font ) {
	$font = 'Helvetica';
	return $font;
}
add_filter( 'response_default_font', 'neuro_default_font' );

function neuro_remove_credit() {
	remove_action ( 'response_secondary_footer', 'response_secondary_footer_credit' );
}
add_action( 'init', 'neuro_remove_credit' );

/**
* Basic theme setup.
*/ 
function neuro_theme_setup() {
	if ( ! isset( $content_width ) ) $content_width = 608; //Set content width
	
	add_theme_support(
		'post-formats',
		array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
	);

	add_theme_support( 'post-thumbnails' );
	add_theme_support('automatic-feed-links');
	add_editor_style();
}
add_action( 'after_setup_theme', 'neuro_theme_setup' );

/**
* Redirect user to theme options page after activation.
*/ 
if ( is_admin() && isset($_GET['activated'] ) && $pagenow =="themes.php" ) {
	wp_redirect( 'themes.php?page=neuro' );
}

/**
* Add link to theme options in Admin bar.
*/ 
function neuro_admin_link() {
	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array( 'id' => 'neuro', 'title' => 'Neuro Pro Options', 'href' => admin_url('themes.php?page=neuro')  ) ); 
}
add_action( 'admin_bar_menu', 'neuro_admin_link', 113 );

/**
* Custom markup for gallery posts in main blog index.
*/ 
function neuro_custom_gallery_post_format( $content ) {
	global $options, $themeslug, $post;
	$root = get_template_directory_uri(); 
	
	ob_start();?>
	
		<?php if ($options->get($themeslug.'_post_formats') == '1') : ?>
			<div class="postformats"><!--begin format icon-->
				<img src="<?php echo get_template_directory_uri(); ?>/images/formats/gallery.png" />
			</div><!--end format-icon-->
		<?php endif;?>
				<h2 class="posts_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					<!--Call @Core Meta hook-->
			<?php response_post_byline(); ?>
				<?php
				if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1' && !is_single() ) {
 		 			echo '<div class="featured-image">';
 		 			echo '<a href="' . get_permalink($post->ID) . '" >';
 		 				the_post_thumbnail();
  					echo '</a>';
  					echo '</div>';
				}
			?>	
				<div class="entry" <?php if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1' ) { echo 'style="min-height: 115px;" '; }?>>
				
				<?php if (!is_single()): ?>
				<?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>

				<figure class="gallery-thumb">
					<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
					<br /><br />
					This gallery contains <?php echo $total_images ; ?> images
					<?php endif;?>
				</figure><!-- .gallery-thumb -->
				<?php endif;?>
				
				<?php if (is_single()): ?>
					<?php the_content(); ?>
				<?php endif;?>
				</div><!--end entry-->

				<div style=clear:both;></div>
	<?php	
	$content = ob_get_clean();
	
	return $content;
}
add_filter('response_post_formats_gallery_content', 'neuro_custom_gallery_post_format' ); 
	
/**
* Set custom post excerpt link text based on theme option.
*/ 
function neuro_excerpt_link($more) {

	global $themename, $themeslug, $options, $post;
    
    	if ($options->get($themeslug.'_excerpt_link_text') == '') {
    		$linktext = '(Read More...)';
   		}
    	else {
    		$linktext = $options->get($themeslug.'_excerpt_link_text');
   		}

	return '<a href="'. get_permalink($post->ID) . '"> <br /><br /> '.$linktext.'</a>';
}
add_filter('excerpt_more', 'neuro_excerpt_link');

/**
* Set custom post excerpt length based on theme option.
*/ 
function neuro_excerpt_length($length) {

	global $themename, $themeslug, $options;
	
		if ($options->get($themeslug.'_excerpt_length') == '') {
    		$length = '55';
    	}
    	else {
    		$length = $options->get($themeslug.'_excerpt_length');
    	}
    	
	return $length;
}
add_filter('excerpt_length', 'neuro_excerpt_length');

/**
* Custom featured image size based on theme options.
*/ 
function neuro_featured_image() {	
	if ( function_exists( 'add_theme_support' ) ) {
	
	global $themename, $themeslug, $options;
	
	if ($options->get($themeslug.'_featured_image_height') == '') {
		$featureheight = '100';
	}		
	else {
		$featureheight = $options->get($themeslug.'_featured_image_height'); 
	}
	if ($options->get($themeslug.'_featured_image_width') == "") {
			$featurewidth = '100';
	}		
	else {
		$featurewidth = $options->get($themeslug.'_featured_image_width'); 
	} 
	set_post_thumbnail_size( $featurewidth, $featureheight, true );
	}	
}
add_action( 'init', 'neuro_featured_image', 11);	

/**
* Attach CSS3PIE behavior to elements
*/   
function neuro_pie() { ?>
	
	<style type="text/css" media="screen">
		#wrapper input, textarea, #twitterbar, input[type=submit], input[type=reset], #imenu, .searchform, .post_container, .postformats, .postbar, .post-edit-link, .widget-container, .widget-title, .footer-widget-title, .comments_container, ol.commentlist li.even, ol.commentlist li.odd, .slider_nav, ul.metabox-tabs li, .tab-content, .list_item, .section-info, #of_container #header, .menu ul li a, .submit input, #of_container textarea, #of_container input, #of_container select, #of_container .screenshot img, #of_container .of_admin_bar, #of_container .subsection > h3, .subsection, #of_container #content .outersection .section, #carousel_list, #calloutwrap, #calloutbutton, .box1, .box2, .box3, .es-carousel-wrapper
  		
  	{
  		behavior: url('<?php echo get_template_directory_uri();  ?>/core/library/pie/PIE.htc');
	}
	</style>
<?php
}

add_action('wp_head', 'neuro_pie', 8);

/**
* Custom post types for Slider, Carousel.
*/ 
function neuro_create_post_type() {

	global $themename, $themeslug, $options, $root;
	
	register_post_type( $themeslug.'_custom_slides',
		array(
			'labels' => array(
				'name' => __( 'Feature Slides' ),
				'singular_name' => __( 'Slides' )
			),
			'public' => true,
			'show_ui' => true, 
			'supports' => array('custom-fields', 'title'),
			'taxonomies' => array( 'slide_categories'),
			'has_archive' => true,
			'menu_icon' => "$root/images/pro/slider.png",
			'rewrite' => array('slug' => 'slides')
		)
	);
	
	register_post_type( $themeslug.'_featured_posts',
		array(
			'labels' => array(
				'name' => __( 'Carousel' ),
				'singular_name' => __( 'Posts' )
			),
			'public' => true,
			'show_ui' => true, 
			'supports' => array('custom-fields'),
			'taxonomies' => array( 'carousel_categories'),
			'has_archive' => true,
			'menu_icon' => "$root/images/pro/carousel.png",
			'rewrite' => array('slug' => 'slides')
		)
	);
}
add_action( 'init', 'neuro_create_post_type' );

/**
* Custom taxonomies for Slider, Carousel.
*/ 
function neuro_custom_taxonomies() {

	global $themename, $themeslug, $options;
	
	register_taxonomy(
		'slide_categories',		
		$themeslug.'_custom_slides',		
		array(
			'hierarchical' => true,
			'label' => 'Slide Categories',	
			'query_var' => true,	
			'rewrite' => array( 'slug' => 'slide_categories' ),	
		)
	);
	register_taxonomy(
		'carousel_categories',		
		$themeslug.'_carousel_categories',		
		array(
			'hierarchical' => true,
			'label' => 'Carousel Categories',	
			'query_var' => true,	
			'rewrite' => array( 'slug' => 'carousel_categories' ),	
		)
	);
}
add_action('init', 'neuro_custom_taxonomies', 0);

/**
* Assign default category for Slider, Carousel posts.
*/ 
function neuro_custom_taxonomy_default( $post_id, $post ) {

	global $themename, $themeslug, $options;	

	if( 'publish' === $post->post_status ) {

		$defaults = array(

			'slide_categories' => array( 'default' ), 'carousel_categories' => array( 'default' ),

			);

		$taxonomies = get_object_taxonomies( $post->post_type );

		foreach( (array) $taxonomies as $taxonomy ) {

			$terms = wp_get_post_terms( $post_id, $taxonomy );

			if( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {

				wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );

			}
		}
	}
}

add_action( 'save_post', 'neuro_custom_taxonomy_default', 100, 2 );

/**
* Edit columns for slider post type.
*/ 
add_filter('manage_edit-ne_custom_slides_columns', 'slider_edit_columns');
add_action('manage_ne_custom_slides_posts_custom_column',  'slides_columns_display', 10, 2);

function slider_edit_columns($portfolio_columns){
    $portfolio_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Title', 'column name'),
        "image" => __('Image'),
        "category" => __('Categories'),
        "author" => __('Author'),
        "date" => __('Date'),
    );
   
    return $portfolio_columns;
}
function slides_columns_display($portfolio_columns, $post_id){
	global $post;
	$cat = get_the_terms($post->ID, 'slide_categories');
	$images = get_post_meta($post->ID, 'slider_image' , true);
	
    switch ($portfolio_columns)
    {
        case "image":
        	if ( !empty( $images ) ) {
        		echo '<img src="';
        		echo $images;
        		echo '"style="height: 50px; width: 50px;">';
        	}
        break;
        
        case "category":
        	if ( !empty( $cat ) ) {
                $out = array();
                foreach ( $cat as $c )
                    $out[] = "<a href='edit.php?slide_categories=$c->slug'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'slide_categories', 'display')) . "</a>";
                echo join( ', ', $out );
            } else {
                _e('No Category.');  //No Taxonomy term defined
            }
        break;
	}
}


/**
* Add TypeKit support based on theme option.
*/ 
function neuro_typekit_support() {
	global $themename, $themeslug, $options;
	
	$embed = $options->get($themeslug.'_typekit');
	
	echo stripslashes($embed);

}
add_action('wp_head', 'neuro_typekit_support');

/**
* Add Google Analytics support based on theme option.
*/ 
function neuro_google_analytics() {
	global $themename, $themeslug, $options;
	
	echo stripslashes ($options->get($themeslug.'_ga_code'));

}
add_action('wp_head', 'neuro_google_analytics');

/**
* Add custom header scripts support based on theme option.
*/ 
function neuro_custom_scripts() {
	global $themename, $themeslug, $options;
	
	echo stripslashes ($options->get($themeslug.'_custom_header_scripts'));

}
add_action('wp_head', 'neuro_custom_scripts');

	
/**
* Register custom menus for header, footer.
*/ 
function neuro_register_menus() {
	register_nav_menus(
	array( 'header-menu' => __( 'Header Menu' ), 'footer-menu' => __( 'Footer Menu' ), 'sub-menu' => __( 'Sub Menu' ))
  );
}
add_action( 'init', 'neuro_register_menus' );
	
/**
* Menu fallback if custom menu not used.
*/ 
function neuro_menu_fallback() {
	global $post; ?>
	
	<ul id="nav_menu">
		<?php wp_list_pages( 'title_li=&sort_column=menu_order&depth=3'); ?>
	</ul><?php
}
/**
* Register widgets.
*/ 
function neuro_widgets_init() {
    register_sidebar(array(
    	'name' => 'Full Sidebar',
    	'id'   => 'sidebar-widgets',
    	'description'   => 'These are widgets for the full sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
    ));
    register_sidebar(array(
    	'name' => 'Left Half Sidebar',
    	'id'   => 'sidebar-left',
    	'description'   => 'These are widgets for the left half sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
    ));    	
    register_sidebar(array(
    	'name' => 'Right Half Sidebar',
    	'id'   => 'sidebar-right',
    	'description'   => 'These are widgets for the right half sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
   	));
    	
    register_sidebar(array(
		'name' => 'Box Left',
		'id' => 'box-left',
		'description' => 'This is the left widget of the three-box section',
		'before_widget' => '<div id="box1" class="four columns"><div style="padding:15px;">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="box-widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Box Middle',
		'id' => 'box-middle',
		'description' => 'This is the middle widget of the three-box section',
		'before_widget' => '<div id="box2" class="four columns"><div style="padding:15px;">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="box-widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Box Right',
		'id' => 'box-right',
		'description' => 'This is the right widget of the three-box section',
		'before_widget' => '<div id="box3" class="four columns"><div style="padding:15px;">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="box-widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer',
		'id' => 'footer-widgets',
		'description' => 'These are the footer widgets',
		'before_widget' => '<div class="three columns footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-widget-title">',
		'after_title' => '</h3>',
	));
}
add_action ('widgets_init', 'neuro_widgets_init');

/**
* Initialize neuro Core Framework and Pro Extension.
*/ 
require_once ( get_template_directory() . '/core/core-init.php' );

/**
* Call additional files required by theme.
*/ 
require_once ( get_template_directory() . '/includes/classy-options-init.php' ); // Theme options markup.
require_once ( get_template_directory() . '/includes/options-functions.php' ); // Custom functions based on theme options.
require_once ( get_template_directory() . '/includes/meta-box.php' ); // Meta options markup.

/**
* End
*/

?>