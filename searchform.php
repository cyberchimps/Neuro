<?php 
/**
* Searchform template used by Neuro.
*
* Authors: Tyler Cunningham, Trent Lapinski
* Copyright: © 2012
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

	global $options, $ne_themeslug, $post, $sidebar, $content_grid; // call globals
	response_sidebar_init(); // sidebar init
	get_header(); // call header

?>

<form method="get" class="searchform" action="<?php echo home_url(); ?>/">
	<div id="magnify"><img src="<?php echo get_template_directory_uri() ;?>/images/magnify.png" alt="magnify" /></div>
	<div><input type="text" name="s" class="s" value="<?php _e( 'Search', 'response' ); ?>" id="searchsubmit" onfocus="if (this.value == <?php _e( 'Search', 'response' ); ?>) this.value = '';" /></div>
	<div><input type="submit" class="searchsubmit" value="" /></div>
</form>