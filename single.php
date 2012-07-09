<?php 
/**
* Single template used by Neuro.
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
* @package Neuro.
* @since 2.0
*/

	global $options, $themeslug, $post, $sidebar, $content_grid; // call globals
	response_sidebar_init(); // sidebar init
	get_header(); // call header

?>

<div class="container">
	<div class="row">
		<div class="wrap">
			<div class="row">
			<?php if ($options->get($themeslug.'_single_breadcrumbs') == "1") { response_breadcrumbs();}?>
			</div>
	<!--Begin @Core post area-->
		<?php response_index(); ?>
	<!--End @Core post area-->
		</div>
	</div>
</div><!--end container-->

<?php get_footer(); ?>