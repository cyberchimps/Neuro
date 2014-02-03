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
* Text Domain: response
* @package Neuro.
* @since 2.0
*/

/**
* Define global theme functions.
*/ 
	$ne_themename = 'neuro';
	$ne_themenamefull = 'Neuro';
	$ne_themeslug = 'ne';
	$ne_pagedocs = 'http://cyberchimps.com/question/using-the-neuro-page-options/';
	$ne_sliderdocs = 'http://cyberchimps.com/question/how-to-use-the-feature-slider-in-neuro/';
	$ne_root = get_template_directory_uri(); 	
	
	if ( ! isset( $content_width ) ) $content_width = 608; //Set content width

/**
* Establishes 'response' as the textdomain, sets $locale and file path
*
* @since 1.0
*/
function response_text_domain() {
	load_theme_textdomain( 'response', get_template_directory() . '/core/languages' );

	    $locale = get_locale();
	    $locale_file = get_template_directory() . "/core/languages/$locale.php";
	    if ( is_readable( $locale_file ) )
		    require_once( $locale_file );
		
		return;    
}
add_action('after_setup_theme', 'response_text_domain');
	
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

/** Replaces RSS link from HTML 'head' with custom feed also used with the 'social icon' */
function neuro_feed_links() {
	global $ne_themename, $ne_themeslug, $options;
	$my_feed=$options->get($ne_themeslug.'_rsslink');
	if ($my_feed) {
		echo '<link rel="alternate" type="application/rss+xml" title="RSS feed" href="'.$my_feed.'"/>';
	}
	else {
		feed_links();
	}
}
remove_action( 'wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
add_action('wp_head', 'neuro_feed_links');


/**
* Basic theme setup.
*/ 
function neuro_theme_setup() {
	
	$directory = get_template_directory();
/**
* Initialize neuro Core Framework and Pro Extension.
*/ 
	require_once ( $directory . '/core/core-init.php' );

/**
* Call additional files required by theme.
*/ 
	require_once ( $directory . '/includes/classy-options-init.php' ); // Theme options markup.
	require_once ( $directory . '/includes/options-functions.php' ); // Custom functions based on theme options.
	require_once ( $directory . '/includes/meta-box.php' ); // Meta options markup.
	require_once ( $directory . '/includes/presstrends.php' ); // Opt-in PressTrends code.
	
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

	$wp_admin_bar->add_menu( array( 'id' => 'neuro', 'title' => __( 'Neuro Options', 'response' ), 'href' => admin_url('themes.php?page=neuro')  ) ); 
}
add_action( 'admin_bar_menu', 'neuro_admin_link', 113 );

/**
* Custom markup for gallery posts in main blog index.
*/ 
function neuro_custom_gallery_post_format( $content ) {
	global $options, $ne_themeslug, $post;
	$ne_root = get_template_directory_uri(); 
	
	ob_start();?>
	
		<?php if ($options->get($ne_themeslug.'_post_formats') == '1') : ?>
			<div class="postformats"><!--begin format icon-->
				<img src="<?php echo get_template_directory_uri(); ?>/images/formats/gallery.png" />
			</div><!--end format-icon-->
		<?php endif;?>
				<h2 class="posts_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					<!--Call @Core Meta hook-->
			<?php response_post_byline(); ?>
				<?php
				if ( has_post_thumbnail() && $options->get($ne_themeslug.'_show_featured_images') == '1' && !is_single() ) {
 		 			echo '<div class="featured-image">';
 		 			echo '<a href="' . get_permalink($post->ID) . '" >';
 		 				the_post_thumbnail();
  					echo '</a>';
  					echo '</div>';
				}
			?>	
				<div class="entry" <?php if ( has_post_thumbnail() && $options->get($ne_themeslug.'_show_featured_images') == '1' ) { echo 'style="min-height: 115px;" '; }?>>
				
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

	global $ne_themename, $ne_themeslug, $options, $post;
    /**
    	if ($options->get($ne_themeslug.'_excerpt_link_text') == '') {
    		$linktext = '(Read More...)';
    		}
    	else {
    		$linktext = $options->get($ne_themeslug.'_excerpt_link_text');
    		}
    */
	$linktext = __( 'Continue Reading...', 'response' );
	return '</p><a href="'. get_permalink($post->ID) . '">'.$linktext.'</a>';
}
add_filter('excerpt_more', 'neuro_excerpt_link');

/**
* Set custom post excerpt link if excerpt is supplied manually.
*/ 
function manual_excerpt_read_more_link($output) {

	global $ne_themeslug, $options, $post;

	$linktext = $options->get($ne_themeslug.'_excerpt_link_text');
	$linktext = $linktext == '' ? __( 'Continue Reading...', 'response' ) : $linktext;
	
	if(!empty($post->post_excerpt))
		return $output . '</p><a class="more-link" href="'. get_permalink($post->ID) . '">'.$linktext.'</a>';
	else
		return $output;
}
add_filter('the_excerpt', 'manual_excerpt_read_more_link');

/**
* Set custom post excerpt length based on theme option.
*/ 
function neuro_excerpt_length($length) {

	global $ne_themename, $ne_themeslug, $options;
	
		if ($options->get($ne_themeslug.'_excerpt_length') == '') {
    		$length = '55';
    	}
    	else {
    		$length = $options->get($ne_themeslug.'_excerpt_length');
    	}
    	
	return $length;
}
add_filter('excerpt_length', 'neuro_excerpt_length');

/**
* Custom featured image size based on theme options.
*/ 
function neuro_featured_image() {	
	if ( function_exists( 'add_theme_support' ) ) {
	
	global $ne_themename, $ne_themeslug, $options;
	
	if ($options->get($ne_themeslug.'_featured_image_height') == '') {
		$featureheight = '100';
	}		
	else {
		$featureheight = $options->get($ne_themeslug.'_featured_image_height'); 
	}
	if ($options->get($ne_themeslug.'_featured_image_width') == "") {
			$featurewidth = '100';
	}		
	else {
		$featurewidth = $options->get($ne_themeslug.'_featured_image_width'); 
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
		#wrapper input, textarea, #twitterbar, input[type=submit], input[type=reset], #imenu, #fullmenu, .searchform, .post_container, .postformats, .postbar, .post-edit-link, .widget-container, .widget-title, .footer-widget-title, .comments_container, ol.commentlist li.even, ol.commentlist li.odd, .slider_nav, ul.metabox-tabs li, .tab-content, .list_item, .section-info, #of_container #header, .menu ul li a, .submit input, #of_container textarea, #of_container input, #of_container select, #of_container .screenshot img, #of_container .of_admin_bar, #of_container .subsection > h3, .subsection, #of_container #content .outersection .section, #carousel_list, #calloutwrap, #calloutbutton, .box1, .box2, .box3, .es-carousel-wrapper
  		
  	{
  		behavior: url('<?php echo get_template_directory_uri();  ?>/core/library/pie/PIE.php');
	}
	</style>
<?php
}

add_action('wp_head', 'neuro_pie', 8);

/**
* Add Google Analytics support based on theme option.
*/ 
function neuro_google_analytics() {
	global $ne_themename, $ne_themeslug, $options;
	
	echo stripslashes ($options->get($ne_themeslug.'_ga_code'));

}
add_action('wp_head', 'neuro_google_analytics');

/**
* Add custom header scripts support based on theme option.
*/ 
function neuro_custom_scripts() {
	global $ne_themename, $ne_themeslug, $options;
	
	echo stripslashes ($options->get($ne_themeslug.'_custom_header_scripts'));

}
add_action('wp_head', 'neuro_custom_scripts');

	
/**
* Register custom menus for header, footer.
*/ 
function neuro_register_menus() {
	register_nav_menus(
	array( 'header-menu' => __( 'Header Menu', 'response' ))
  );
}
add_action( 'init', 'neuro_register_menus' );
	

/**
* Register widgets.
*/ 
function neuro_widgets_init() {
    register_sidebar(array(
    	'name' => 'Full Sidebar',
    	'id'   => 'sidebar-widgets',
    	'description'   => 'These are widgets for the full sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
    ));
    register_sidebar(array(
    	'name' => 'Left Half Sidebar',
    	'id'   => 'sidebar-left',
    	'description'   => 'These are widgets for the left half sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
    ));    	
    register_sidebar(array(
    	'name' => 'Right Half Sidebar',
    	'id'   => 'sidebar-right',
    	'description'   => 'These are widgets for the right half sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
   	));
   	register_sidebar(array(
		'name' => 'Footer',
		'id' => 'footer-widgets',
		'description' => 'These are the footer widgets',
		'before_widget' => '<div class="four columns footer-widgets %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-widget-title">',
		'after_title' => '</h3>',
	));
}
add_action ('widgets_init', 'neuro_widgets_init');


/** qTranslate Plugin Menu Integration */
add_filter('walker_nav_menu_start_el', 'qtrans_in_nav_el', 10, 4);

function qtrans_in_nav_el($item_output, $item, $depth, $args){

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';

    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';

    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

    

   // Determine integration with qTranslate Plugin

   if (function_exists('qtrans_convertURL')) {

      $attributes .= ! empty( $item->url ) ? ' href="' . qtrans_convertURL(esc_attr( $item->url )) .'"' : '';

   } else {

      $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

   }

   

   $item_output = $args->before;

   $item_output .= '<a'. $attributes .'>';

   $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

   $item_output .= '</a>';

   $item_output .= $args->after;

      

   return $item_output;

}
/** -----------------END----------------- */

add_filter('widget_text', 'do_shortcode', 11); //Using shortcodes in widgets


/** Remove theme update notifications in dashboard */
remove_action ('load-update-core.php', 'wp_update_themes'); 
add_filter ('pre_site_transient_update_themes',create_function ('$a', "return null;"));
/** -----------------------END-------------------- */

/**
* End
*/


/**
* End
*/

?>