<?php
/**
* Initializes the Neuro Theme Options
*
* Author: Tyler Cunningham
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

require( get_template_directory() . '/core/classy-options/classy-options-framework/classy-options-framework.php');

add_action('init', 'chimps_init_options');

function chimps_init_options() {

global $options, $ne_themeslug, $ne_themename, $ne_themenamefull;
$options = new ClassyOptions($ne_themename, $ne_themenamefull." Options");

$terms2 = get_terms('category', 'hide_empty=0');

	$blogoptions = array();
                                    
	$blogoptions['all'] = "All";

    	foreach($terms2 as $term) {

        	$blogoptions[$term->slug] = $term->name;

        }


$options
	->section("Welcome")
		->info("<h1>Neuro</h1>
		
<p><strong>A Responsive Blog WordPress Theme with Drag and Drop Theme Options</strong></p>

<p>Neuro includes a Responsive Design (which magically adjusts to mobile devices such as the iPhone and iPad), Responsive Slider, Drag & Drop Header Elements, Page and Blog Elements, simplified Theme Options, and is built with HTML5 and CSS3.</p>

<p>To get started simply work your way through the options below, add your content, and always remember to hit save after making any changes.</p>

<p>The Neuro Slider options are under the Neuro Pro Page Options which are available below the Page content entry area in WP-Admin when you edit a page. This way you can configure each page individually. You will also find the Drag & Drop Page Elements editor within the response Pro Page Options as well.</p>

<p>We tried to make Neuro Pro as easy to use as possible, but if you still need help please read the <a href='http://cyberchimps.com/neuropro/docs/' target='_blank'>documentation</a>, and visit our <a href='http://cyberchimps.com/forum/pro/' target='_blank'>support forum</a>.</p>

<p>Thank you for using Neuro Pro.</p>
")
	->section("Design")
		->open_outersection()
			->select($ne_themeslug."_color_scheme", "Select a Skin Color", array( 'options' => array("black" => "Black (default)", "grey" => "Grey", "pink" => "Pink"), 'default' => 'black'))
			->checkbox($ne_themeslug."_responsive_video", "Responsive Videos")
		->close_outersection()
		->subsection("Typography")
			->select($ne_themeslug."_font", "Choose a Font", array( 'options' => array("Helvetica" => "Helvetica (default)", "Arial" => "Arial", "Courier New" => "Courier New", "Georgia" => "Georgia", "Lucida Grande" => "Lucida Grande", "Tahoma" => "Tahoma", "Times New Roman" => "Times New Roman", "Verdana" => "Verdana", "Maven+Pro" => "Maven Pro", "Ubuntu" => "Ubuntu")))			
		->subsection_end()
		->subsection("Background")
			->images($ne_themeslug."_background_image", "Select a background", array( 'options' => array(  'blue' => TEMPLATE_URL . '/images/backgrounds/thumbs/blue.jpg', 'wood' => TEMPLATE_URL . '/images/backgrounds/thumbs/wood.jpg', 'neuro' => TEMPLATE_URL . '/images/backgrounds/thumbs/neurobg.png'), 'default' => 'wood'))
			->checkbox($ne_themeslug."_custom_background", "Use a custom background")
			->color($ne_themeslug."_background_color", "Custom Background Color")
			->upload($ne_themeslug."_background_upload", "Background Image")
			->radio($ne_themeslug."_bg_image_position", "Image Position", array( 'options' => array("top left" => "Left", "top center" => "Center", "top right" => "Right")))
			->radio($ne_themeslug."_bg_image_repeat", "Image Repeat", array( 'options' => array( "repeat" => "Tile", "repeat-x" => "Tile Horizontally", "repeat-y" => "Tile Vertically", "no-repeat" => "No Tile")))
			->radio($ne_themeslug."_bg_image_attachment", "Image Attachment", array( 'options' => array("scroll" => "Scroll", "fixed" => "Fixed")))
		->subsection_end()

		->subsection("Layout")
			->text($ne_themeslug."_row_max_width", "Row Max Width", array('default' => '980px'))
		->subsection_end()
		->subsection("Custom Colors")
			->color($ne_themeslug."_text_color", "Text Color")
			->color($ne_themeslug."_sitetitle_color", "Site Title Color")
			->color($ne_themeslug."_tagline_color", "Site Description Color")
		->subsection_end()
		->section("Header")
		->open_outersection()
			->section_order("header_section_order", "Drag & Drop Header Elements", array('options' => array("response_logo_icons" => "Logo + Icons", "response_banner" => "Banner", "response_custom_header_element" => "Custom"), 'default' => 'response_logo_icons'))
			->upload($ne_themeslug."_banner", "Banner Image")
			->textarea($ne_themeslug."_custom_header_element", "Custom HTML")
		->close_outersection()
			->subsection("Header Options")
			->checkbox($ne_themeslug."_subheader", "Subheader")
			->checkbox($ne_themeslug."_header_wrap", "Header Wrap")
			->checkbox($ne_themeslug."_full_menu", "Full Width Menu" , array('default' => true))
			->checkbox($ne_themeslug."_custom_logo", "Custom Logo" , array('default' => true))
			->upload($ne_themeslug."_logo", "Logo", array('default' => array('url' => TEMPLATE_URL . '/images/neuro.png')))
			->checkbox($ne_themeslug."_favicon_toggle", "Favicon" , array('default' => false))
			->upload($ne_themeslug."_favicon", "Custom Favicon", array('default' => array('url' => TEMPLATE_URL . '/images/favicon.ico')))
			->checkbox($ne_themeslug."_apple_touch_toggle", "Apple Touch Icon" , array('default' => false))
			->upload($ne_themeslug."_apple_touch", "Apple Touch Icon", array('default' => array('url' => TEMPLATE_URL . '/images/apple-icon.png')))
		->subsection_end()
		->subsection("Social")
			->images($ne_themeslug."_icon_style", "Icon set", array( 'options' => array('legacy' => TEMPLATE_URL . '/images/social/thumbs/icons-classic.png', 'default' =>
TEMPLATE_URL . '/images/social/thumbs/icons-default.png' ), 'default' => 'default' ) )
			->text($ne_themeslug."_twitter", "Twitter Icon URL", array('default' => 'http://twitter.com'))
			->checkbox($ne_themeslug."_hide_twitter_icon", "Hide Twitter Icon", array('default' => true))
			->text($ne_themeslug."_facebook", "Facebook Icon URL", array('default' => 'http://facebook.com'))
			->checkbox($ne_themeslug."_hide_facebook_icon", "Hide Facebook Icon" , array('default' => true))
			->text($ne_themeslug."_gplus", "Google + Icon URL", array('default' => 'http://plus.google.com'))
			->checkbox($ne_themeslug."_hide_gplus_icon", "Hide Google + Icon" , array('default' => true))
			->text($ne_themeslug."_flickr", "Flickr Icon URL", array('default' => 'http://flikr.com'))
			->checkbox($ne_themeslug."_hide_flickr", "Hide Flickr Icon")
			->text($ne_themeslug."_linkedin", "LinkedIn Icon URL", array('default' => 'http://linkedin.com'))
			->checkbox($ne_themeslug."_hide_linkedin", "Hide LinkedIn Icon")
			->text($ne_themeslug."_pinterest", "Pinterest Icon URL", array('default' => 'http://pinterest.com'))
			->checkbox($ne_themeslug."_hide_pinterest", "Hide Pinterest Icon")
			->text($ne_themeslug."_youtube", "YouTube Icon URL", array('default' => 'http://youtube.com'))
			->checkbox($ne_themeslug."_hide_youtube", "Hide YouTube Icon")
			->text($ne_themeslug."_googlemaps", "Google Maps Icon URL", array('default' => 'http://maps.google.com'))
			->checkbox($ne_themeslug."_hide_googlemaps", "Hide Google maps Icon")
			->text($ne_themeslug."_email", "Email Address")
			->checkbox($ne_themeslug."_hide_email", "Hide Email Icon")
			->text($ne_themeslug."_rsslink", "RSS Icon URL")
			->checkbox($ne_themeslug."_hide_rss_icon", "Hide RSS Icon" , array('default' => true))
		->subsection_end()
		->subsection("Tracking and Scripts")
			->textarea($ne_themeslug."_ga_code", "Google Analytics Code")
			->textarea($ne_themeslug."_custom_header_scripts", "Custom Header Scripts")
		->subsection_end()
	->section("Blog")
		->open_outersection()
			->section_order($ne_themeslug."_blog_section_order", "Drag & Drop Blog Elements", array('options' => array("response_index" => "Post Page", "response_blog_slider" => "Feature Slider",  "response_callout_section" => "Callout Section"), "default" => 'response_blog_slider,response_index'))
		->close_outersection()
		->subsection("Blog Options")
			->images($ne_themeslug."_blog_sidebar", "Sidebar Options", array( 'options' => array("none" => TEMPLATE_URL . '/images/options/none.png',"two-right" => TEMPLATE_URL . '/images/options/tworight.png', "right-left" => TEMPLATE_URL . '/images/options/rightleft.png', "left" => TEMPLATE_URL . '/images/options/left.png',  "right" => TEMPLATE_URL . '/images/options/right.png'), 'default' => 'right'))
			->checkbox($ne_themeslug."_post_formats", "Post Format Icons",  array('default' => true))
			->checkbox($ne_themeslug."_show_excerpts", "Post Excerpts")
			->text($ne_themeslug."_excerpt_link_text", "Excerpt Link Text", array('default' => '(More)…'))
			->text($ne_themeslug."_excerpt_length", "Excerpt Character Length", array('default' => '55'))
			->checkbox($ne_themeslug."_show_featured_images", "Featured Images")
			->select($ne_themeslug."_featured_image_align", "Featured Image Alignment", array( 'options' => array("key1" => "Left", "key2" => "Center", "key3" => "Right")))
			->text($ne_themeslug."_featured_image_height", "Featured Image Height", array('default' => '100'))
			->text($ne_themeslug."_featured_image_width", "Featured Image Width", array('default' => '100'))	
			->multicheck($ne_themeslug."_hide_byline", "Post Byline Elements", array( 'options' => array($ne_themeslug."_hide_author" => "Author" , $ne_themeslug."_hide_categories" => "Categories", $ne_themeslug."_hide_date" => "Date", $ne_themeslug."_hide_comments" => "Comments",  $ne_themeslug."_hide_tags" => "Tags"), 'default' => array( $ne_themeslug."_hide_tags" => true, $ne_themeslug."_hide_author" => true, $ne_themeslug."_hide_date" => true, $ne_themeslug."_hide_comments" => true, $ne_themeslug."_hide_categories" => true ) ) )
		->subsection_end()
		->subsection("Feature Slider")
			->upload($ne_themeslug."_blog_slide_one_image", "Slide One Image", array('default' => array('url' => TEMPLATE_URL . '/images/neurofreeslider.jpg')))
			->text($ne_themeslug."_blog_slide_one_url", "Slide One Link", array('default' => 'http://cyberchimps.com'))
			->upload($ne_themeslug."_blog_slide_two_image", "Slide Two", array('default' => array('url' => TEMPLATE_URL . '/images/neurofreeslider.jpg')))
			->text($ne_themeslug."_blog_slide_two_url", "Slide Two Link", array('default' => 'http://cyberchimps.com'))
			->upload($ne_themeslug."_blog_slide_three_image", "Slide Three", array('default' => array('url' => TEMPLATE_URL . '/images/neurofreeslider.jpg')))
			->text($ne_themeslug."_blog_slide_three_url", "Slide Three Link", array('default' => 'http://cyberchimps.com'))
		->subsection_end()
		->subsection("Callout Options")
			->textarea($ne_themeslug."_blog_callout_text", "Enter your Callout text")
		->subsection_end()
		->section("Templates")
		->subsection("Single Post")
			->images($ne_themeslug."_single_sidebar", "Sidebar Options", array( 'options' => array("left" => TEMPLATE_URL . '/images/options/left.png', "two-right" => TEMPLATE_URL . '/images/options/tworight.png', "right-left" => TEMPLATE_URL . '/images/options/rightleft.png', "none" => TEMPLATE_URL . '/images/options/none.png', "right" => TEMPLATE_URL . '/images/options/right.png'), 'default' => 'right'))
			->checkbox($ne_themeslug."_single_breadcrumbs", "Breadcrumbs", array('default' => true))
			->checkbox($ne_themeslug."_single_show_featured_images", "Featured Images")
			->checkbox($ne_themeslug."_single_post_formats", "Post Format Icons",  array('default' => true))
			->multicheck($ne_themeslug."_single_hide_byline", "Post Byline Elements", array( 'options' => array($ne_themeslug."_hide_author" => "Author" , $ne_themeslug."_hide_categories" => "Categories", $ne_themeslug."_hide_date" => "Date", $ne_themeslug."_hide_comments" => "Comments",  $ne_themeslug."_hide_tags" => "Tags"), 'default' => array( $ne_themeslug."_hide_tags" => true, $ne_themeslug."_hide_author" => true, $ne_themeslug."_hide_date" => true, $ne_themeslug."_hide_comments" => true, $ne_themeslug."_hide_categories" => true ) ) )
			->checkbox($ne_themeslug."_post_pagination", "Post Pagination Links",  array('default' => true))
		->subsection_end()	
		->subsection("Archive")
			->images($ne_themeslug."_archive_sidebar", "Sidebar Options", array( 'options' => array("left" => TEMPLATE_URL . '/images/options/left.png', "two-right" => TEMPLATE_URL . '/images/options/tworight.png', "right-left" => TEMPLATE_URL . '/images/options/rightleft.png', "none" => TEMPLATE_URL . '/images/options/none.png', "right" => TEMPLATE_URL . '/images/options/right.png'), 'default' => 'right'))
			->checkbox($ne_themeslug."_archive_breadcrumbs", "Breadcrumbs", array('default' => true))
			->checkbox($ne_themeslug."_archive_show_excerpts", "Post Excerpts", array('default' => true))
			->checkbox($ne_themeslug."_archive_show_featured_images", "Featured Images")
			->checkbox($ne_themeslug."_archive_post_formats", "Post Format Icons",  array('default' => true))
			->multicheck($ne_themeslug."_archive_hide_byline", "Post Byline Elements", array( 'options' => array($ne_themeslug."_hide_author" => "Author" , $ne_themeslug."_hide_categories" => "Categories", $ne_themeslug."_hide_date" => "Date", $ne_themeslug."_hide_comments" => "Comments",  $ne_themeslug."_hide_tags" => "Tags"), 'default' => array( $ne_themeslug."_hide_tags" => true, $ne_themeslug."_hide_author" => true, $ne_themeslug."_hide_date" => true, $ne_themeslug."_hide_comments" => true, $ne_themeslug."_hide_categories" => true ) ) )
			->subsection_end()
		->subsection("Search")
			->images($ne_themeslug."_search_sidebar", "Sidebar Options", array( 'options' => array("left" => TEMPLATE_URL . '/images/options/left.png', "two-right" => TEMPLATE_URL . '/images/options/tworight.png', "right-left" => TEMPLATE_URL . '/images/options/rightleft.png', "none" => TEMPLATE_URL . '/images/options/none.png', "right" => TEMPLATE_URL . '/images/options/right.png'), 'default' => 'right'))
			->checkbox($ne_themeslug."_search_show_excerpts", "Post Excerpts", array('default' => true))
		->subsection_end()
		->subsection("404")
			->images($ne_themeslug."_404_sidebar", "Select the Sidebar Type", array( 'options' => array("left" => TEMPLATE_URL . '/images/options/left.png', "two-right" => TEMPLATE_URL . '/images/options/tworight.png', "right-left" => TEMPLATE_URL . '/images/options/rightleft.png', "none" => TEMPLATE_URL . '/images/options/none.png', "right" => TEMPLATE_URL . '/images/options/right.png'), 'default' => 'right'))
			->textarea($ne_themeslug."_custom_404", "Custom 404 Content")
		->subsection_end()
	->section("Footer")
		->open_outersection()
			->text($ne_themeslug."_footer_text", "Footer Copyright Text")
		->close_outersection()	
;
}
