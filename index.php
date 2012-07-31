<?php
/**
* Index template used by Neuro.
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

	global $options, $ne_themeslug, $post; // call globals
	$reorder = $options->get($ne_themeslug.'_blog_section_order');		
?>

<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="wrap">
		<?php
			foreach(explode(",", $options->get($ne_themeslug.'_blog_section_order')) as $fn) {
				if(function_exists($fn)) {
					call_user_func_array($fn, array());
				}
			}
		?>
		</div>
	</div>
</div><!--end container-->

<?php get_footer(); ?>