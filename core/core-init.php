<?php
/**
* Initializes the CyberChimps Response Core Framework
*
* Author: Tyler Cunningham
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
* Text Domain: response
* @package Response
* @since 1.0
*/

$template_dir = get_template_directory();

//Define custom core functions
require_once ( $template_dir . '/core/core-functions.php' );

//Define the core hooks
require_once ( $template_dir . '/core/core-hooks.php' );

//Call the action files

require_once ( $template_dir . '/core/actions/sidebar-actions.php' );
require_once ( $template_dir . '/core/actions/404-actions.php' );
require_once ( $template_dir . '/core/actions/archive-actions.php' ); 
require_once ( $template_dir . '/core/actions/callout-actions.php' );
require_once ( $template_dir . '/core/actions/comments-actions.php' );
require_once ( $template_dir . '/core/actions/index-actions.php' );
require_once ( $template_dir . '/core/actions/global-actions.php' );
require_once ( $template_dir . '/core/actions/header-actions.php' );
require_once ( $template_dir . '/core/actions/footer-actions.php' );
require_once ( $template_dir . '/core/actions/pagination-actions.php' );
require_once ( $template_dir . '/core/actions/twitterbar-actions.php' );
require_once ( $template_dir . '/core/actions/page-actions.php' );
require_once ( $template_dir . '/core/actions/search-actions.php' );
require_once ( $template_dir . '/core/actions/slider-actions.php' );


//Call metabox class file
require_once ( $template_dir . '/core/metabox/meta-box-class.php' );

//CyberChimps Themes Page
require_once ( $template_dir . '/core/classy-options/options-themes.php' );

/**
* End
*/

?>
