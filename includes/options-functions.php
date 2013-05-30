<?php
/**
* Functions related to the Neuro Theme Options.
*
* Author: Tyler Cunningham
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Neuro
* @since 2.0
*/

/* Backgound Option*/

function background_option() {

	global $options, $ne_themeslug;
	$ne_root = get_template_directory_uri();
	$customsource = $options->get($ne_themeslug.'_background_upload');
	$custom = stripslashes($customsource['url']);
	$repeat = $options->get($ne_themeslug.'_bg_image_repeat');
	$position = $options->get($ne_themeslug.'_bg_image_position');
	$attachment = $options->get($ne_themeslug.'_bg_image_attachment');
	$color = $options->get($ne_themeslug.'_background_color');
	
	if ($options->get($ne_themeslug.'_background_image') == "" OR $options->get($ne_themeslug.'_background_image') == "wood" && $options->get($ne_themeslug.'_custom_background') != "1")  {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$ne_root/images/backgrounds/wood.jpg'); background-repeat: repeat; background-position: top left; background-attachment: fixed;}";
		echo '</style>';
	}
	
	if ($options->get($ne_themeslug.'_background_image') == "grey" && $options->get($ne_themeslug.'_custom_background') != "1")  {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$ne_root/images/backgrounds/grey.png'); background-repeat: repeat; background-position: top left; background-attachment: fixed;}";
		echo '</style>';
	}
	
	if ($options->get($ne_themeslug.'_background_image') == "neuro" && $options->get($ne_themeslug.'_custom_background') != "1")  {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$ne_root/images/backgrounds/neurobg.png'); background-repeat: repeat; background-position: top left; background-attachment: fixed;}";
		echo '</style>';
	}
	
	if ($options->get($ne_themeslug.'_background_image')  == "blue" && $options->get($ne_themeslug.'_custom_background') != "1")  {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$ne_root/images/backgrounds/blue.jpg'); background-repeat: repeat; background-position: top center; background-attachment: fixed;}";
		echo '</style>';
	}
	
	if ($options->get($ne_themeslug.'_background_image') == "pink" && $options->get($ne_themeslug.'_custom_background') != "1")   {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$ne_root/images/backgrounds/pink.png'); background-color: #000; background-repeat-x: repeat-x; background-position: top center; background-attachment: fixed;}";
		echo '</style>';
	}
	
	if ($options->get($ne_themeslug.'_background_image') == "space" && $options->get($ne_themeslug.'_custom_background') != "1")  {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$ne_root/images/backgrounds/neuros.jpg'); background-color: #000; background-repeat: repeat-x; background-position: top center; background-attachment: fixed;}";
		echo '</style>';
	}
	
	if ($options->get($ne_themeslug.'_custom_background') == "1") {
	
		echo '<style type="text/css">';
		echo "body {background-image: url('$custom'); background-color: $color; background-repeat: $repeat; background-position: $position; background-attachment: $attachment;}";
		echo '</style>';
	
	}
	
}
add_action( 'wp_head', 'background_option');

/* Header Wrap Option*/
function neuro_header_wrap() {
	global $options, $ne_themeslug;
	$enable = $options->get($ne_themeslug.'_header_wrap');
	
	if ($enable == '1') {
		echo "<style type='text/css'>";
		echo "#fullmenu {border-radius: 0px 0px 0px 0px;}";
		echo "#header_wrap {border-radius: 6px 6px 0px 0px;background-color: #F8F8F8;padding-top: 26px;padding-bottom: 20px;}";
		echo "h1.sitename a {color: black; text-shadow: 1px 2px #fff;}";
		echo "h1.sitename a:hover {color: #0085CF;}";
		echo "</style>";
	}
}
add_action( 'wp_head', 'neuro_header_wrap' );

/* Full width nav options*/
function neuro_full_nav() {
	global $options, $ne_themeslug;
	$enable = $options->get($ne_themeslug.'_full_menu');
	$width = abs( $options->get( $ne_themeslug ."_row_max_width" ) ) - 1 . "px";
	if ($enable == '1') {
		echo "<style type='text/css'>";
		echo ".wrap {border-radius: 0px 0px 0px 0px;}
					#fullmenu {width:". $width .";}";
		echo "</style>";
	}
}
add_action( 'wp_head', 'neuro_full_nav' );

/* Standard Web Layout*/

function neuro_content_layout() {
	global $options, $ne_themeslug, $post;
	
	if (is_single()) {
	$sidebar = $options->get($ne_themeslug.'_single_sidebar');
	}
	elseif (is_archive()) {
	$sidebar = $options->get($ne_themeslug.'_archive_sidebar');
	}
	elseif (is_404()) {
	$sidebar = $options->get($ne_themeslug.'_404_sidebar');
	}
	elseif (is_search()) {
	$sidebar = $options->get($ne_themeslug.'_search_sidebar');
	}
	elseif (is_page()) {
	$sidebar = get_post_meta($post->ID, 'page_sidebar' , true);
	}
	else {
	$sidebar = $options->get($ne_themeslug.'_blog_sidebar');
	}
	
	if ($sidebar == 'two-right' OR $sidebar == '3' ) {
		echo '<style type="text/css">';
		echo "#content.six.columns {width: 50.8%;  margin-right: 2%}";
		echo "#content.six.columns {width: 50.8%;  margin-right: 1.9%\9;}";
		echo "#sidebar-right.three.columns {margin-left: 0%; width: 21.6%;}";
		echo "#sidebar-left.three.columns {margin-left: 0%; width: 21.68%; margin-right:2%}";
		echo "#sidebar-left.three.columns {margin-left: 0%; width: 21.68%; margin-right:1.9%\9;}";
		echo "@-moz-document url-prefix() {#content.six.columns {width: 52.8%;  margin-right: 1.9%} #sidebar-left.three.columns {margin-left: 0%; width: 21.68%; margin-right:1.9%}}";
		echo '</style>';
	}
	if ($sidebar == 'right-left' OR $sidebar == '2' ) {
		echo '<style type="text/css">';
		echo "#content.six.columns {width: 50.8%; margin-left: 2%; margin-right: 2%}";
		echo "#content.six.columns {width: 50.8%; margin-left: 1.9%\9; margin-right: 1.9%\9;}";
		echo "#sidebar-right.three.columns {margin-left: 0%; width: 21.6%;}";
		echo "#sidebar-left.three.columns {margin-left: 0%; width: 21.68%;}";
		echo "@-moz-document url-prefix() {#content.six.columns {width: 52.8%; margin-left: 1.9%; margin-right: 1.9%}}";
		echo '</style>';
	}

}
add_action( 'wp_head', 'neuro_content_Layout' );

/* Widget Title Background*/

function custom_row_width() {
	global $options, $ne_themeslug;
	$maxwidth = $options->get($ne_themeslug.'_row_max_width');
	
	if ($maxwidth != '0' OR $maxwidth =='980px' ) {
		echo '<style type="text/css">';
		echo ".row {max-width: $maxwidth;}";
		echo '</style>';
	}	
}
add_action( 'wp_head', 'custom_row_width' );

/* Widget Title Background*/

function custom_text_color() {
	global $options, $ne_themeslug;
	$color = $options->get($ne_themeslug.'_text_color');
	
	if ($options->get($ne_themeslug.'_text_color') != '' ) {
		echo '<style type="text/css">';
		echo "body {color: $color;}";
		echo '</style>';
	}

}
add_action( 'wp_head', 'custom_text_color' );

/* Adjust postbar width for full width and 2 sidebar configs*/

function postbar_option() {
	global $options, $ne_themeslug;
	
	if ($options->get($ne_themeslug.'_blog_sidebar') == 'two-right' OR $options->get($ne_themeslug.'_blog_sidebar') == 'right-left') {
		echo '<style type="text/css">';
		echo ".postbar {width: 95.4%;}";
		echo '</style>';
	}
	
	if ($options->get($ne_themeslug.'_blog_sidebar') == 'none') {
		echo '<style type="text/css">';
		echo ".postbar {width: 97.8%;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'postbar_option');


/* Featured Image Alignment */

function featured_image_alignment() {

	global $ne_themeslug, $options;
	
	if ($options->get($ne_themeslug.'_featured_image_align') == "key3" ) {
	
		echo '<style type="text/css">';
		echo ".featured-image {float: right;}";
		echo '</style>';
			
	}
	elseif ($options->get($ne_themeslug.'_featured_image_align') == "key2" ) {

		echo '<style type="text/css">';
		echo ".featured-image {text-align: center;}";
		echo '</style>';
		
	}
	else {
		
		echo '<style type="text/css">';
		echo ".featured-image {float: left;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'featured_image_alignment');

/* Post Meta Data width */

function post_meta_data_width() {

	global $ne_themeslug, $options;

	if ($options->get($ne_themeslug.'_blog_sidebar') == "two-right" OR $options->get($ne_themeslug.'_blog_sidebar') == "right-left") {

		echo '<style type="text/css">';
		echo ".postmetadata {width: 480px;}";
		echo '</style>';
		
	}
	
}
add_action( 'wp_head', 'post_meta_data_width');

/* Site Title Color */

function add_sitetitle_color() {

	global $ne_themeslug, $options;

	if ($options->get($ne_themeslug.'_sitetitle_color') == "") {
		$sitetitle = '#717171';
	}
	
	else {
		$sitetitle = $options->get($ne_themeslug.'_sitetitle_color'); 
	}		
	
		echo '<style type="text/css">';
		echo ".sitename a {color: $sitetitle;}";
		echo '</style>';
		
}
add_action( 'wp_head', 'add_sitetitle_color');

/* Link Color */

function add_link_color() {

	global $ne_themeslug, $options;

	if ($options->get($ne_themeslug.'_link_color') != '') {
		$link = $options->get($ne_themeslug.'_link_color'); 
	

		echo '<style type="text/css">';
		echo "a {color: $link;}";
		echo ".meta a {color: $link;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'add_link_color');

/* Link Hover Color */

function add_link_hover_color() {

	global $ne_themeslug, $options;

	if ($options->get($ne_themeslug.'_link_hover_color') != '') {
		$link = $options->get($ne_themeslug.'_link_hover_color'); 
	

		echo '<style type="text/css">';
		echo "a:hover {color: $link;}";
		echo ".meta a:hover {color: $link;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'add_link_hover_color');

/* Tagline Color */

function add_tagline_color() {

	global $ne_themeslug, $options;

	if ($options->get($ne_themeslug.'_tagline_color') != '') {
		$color = $options->get($ne_themeslug.'_tagline_color'); 

		echo '<style type="text/css">';
		echo ".description {color: $color;}";
		echo '</style>';

	}	
}
add_action( 'wp_head', 'add_tagline_color');

/* Post Title Color */

function add_posttitle_color() {

	global $ne_themeslug, $options;

	if ($options->get($ne_themeslug.'_posttitle_color') != '') {
		$posttitle = $options->get($ne_themeslug.'_posttitle_color'); 
			
		echo '<style type="text/css">';
		echo ".posts_title a {color: $posttitle;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'add_posttitle_color');

/* Menu Font */
 
function add_menu_font() {
		
	global $ne_themeslug, $options;	
		
	if ($options->get($ne_themeslug.'_menu_font') == "") {
		$font = 'Arial';
	}		
		
	elseif ($options->get($ne_themeslug.'_menu_font') == 'custom' && $options->get($ne_themeslug.'_custom_menu_font') != "") {
		$font = $options->get($ne_themeslug.'_custom_menu_font');	
	}
	
	else {
		$font = $options->get($ne_themeslug.'_menu_font'); 
	}
	
		$fontstrip =  ereg_replace("[^A-Za-z0-9]", " ", $font );
		
		// register font stylesheet
		if( $font == 'Actor' ||
			$font == 'Coda' ||
			$font == 'Maven Pro' ||
			$font == 'Metrophobic' ||
			$font == 'News Cycle' ||
			$font == 'Nobile' ||
			$font == 'Tenor Sans' ||
			$font == 'Quicksand' ||
			$font == 'Ubuntu') {
			
			// Check if SSL is present, if so then use https othereise use http
			$protocol = is_ssl() ? 'https' : 'http';
			echo "<link href='$protocol://fonts.googleapis.com/css?family=$font' rel='stylesheet' type='text/css' />";
		}
		
		echo '<style type="text/css">';
		echo "#nav ul li a {font-family: $fontstrip;}";
		echo '</style>';
}
add_action( 'wp_head', 'add_menu_font'); 

/* Custom CSS */

function custom_css() {

	global $ne_themeslug, $options;
	
	$custom =$options->get($ne_themeslug.'_css_options');
	echo '<style type="text/css">' . "\n";
	echo  $custom  . "\n";
	echo '</style>' . "\n";
}

function custom_css_filter($_content) {
	$_return = preg_replace ( '/@import.+;( |)|((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/))/i', '', $_content );
	$_return = htmlspecialchars ( strip_tags($_return), ENT_NOQUOTES, 'UTF-8' );
	return $_return;
}
		
add_action ( 'wp_head', 'custom_css' );

?>