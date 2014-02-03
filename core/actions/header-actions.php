<?php
/**
* Header actions used by the CyberChimps Response Core Framework
*
* Author: Tyler Cunningham
* Copyright: © 2012
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

/**
* Response header actions
*/
add_action( 'response_after_head_tag', 'response_font' );
add_action( 'response_head_tag', 'response_html_attributes' );
add_action( 'response_head_tag', 'response_meta_tags' );
add_action( 'response_head_tag', 'response_title_tag' );
add_action( 'response_head_tag', 'response_link_rel' );

add_action( 'response_header_sitename', 'response_header_sitename_content');
add_action( 'response_header_site_description', 'response_header_site_description_content' );
add_action( 'response_header_social_icons', 'response_header_social_icons_content' );

add_action( 'response_navigation', 'response_nav' );
add_action( 'response_404_content', 'response_404_content_handler' );

add_action( 'response_logo_icons', 'response_logo_icons_content');
add_action( 'response_custom_header_element', 'response_custom_header_element_content');
add_action( 'response_logo_register', 'response_logo_register_content');
add_action( 'response_banner', 'response_banner_content');

add_action( 'response_subheader', 'response_subheader_content');

/**
* Define content of subheader
*/
function response_subheader_content() {
?>
	<div id="subheader">
		<div class="container">
			<div class="row">
				<div class="five columns">

				<!-- Begin @Core header description hook -->
					<?php response_header_site_description(); ?> 
				<!-- End @Core header description hook -->				
				</div>	
			
				<div class="seven columns">
					<div class="subheader_icons">
				
					<!-- Begin @Core header social icon hook -->
						<?php response_header_social_icons(); ?> 
					<!-- End @Core header contact social icon hook -->			
					</div>	
				</div>
			</div><!--end row-->
		</div>	
	</div>
<?php
}

/**
* Establishes the theme font family.
*
* @since 1.0
*/
function response_font() {
	global $ne_themeslug, $options; //Call global variables
	$family = apply_filters( 'response_default_font_family', 'Helvetica, sans-serif' );
	
	if ($options->get($ne_themeslug.'_font') == "" ) {
		$font = apply_filters( 'response_default_font', 'Arial' );
	}		
	else {
		$font = $options->get($ne_themeslug.'_font'); 
	} ?>
	
	<body style="font-family:'<?php echo ereg_replace("[^A-Za-z0-9]", " ", $font ); ?>', <?php echo $family; ?>" <?php body_class(); ?> > <?php
}

/**
* Establishes the theme HTML attributes
*
* @since 1.0
*/
function response_html_attributes() { ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class=""> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
<head profile="http://gmpg.org/xfn/11"> <?php 
}

/**
* Establishes the theme META tags (including SEO options)
*
* @since 1.0
*/
function response_meta_tags() { ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><?php
	global $ne_themeslug, $options, $post; //Call global variables
	if(!$post) return; // in case of 404 page or something?>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="distribution" content="global" />
<meta name="language" content="<?php bloginfo( 'language' ); ?>" /> 
<meta name="viewport" content="initial-scale=1.0; maximum-scale=3.0; width=device-width"/><?php
}

/**
* Establishes the theme title tags.
*
* @since 1.0
*/
function response_title_tag() {
	echo '<title>'; 
	wp_title( ' - ' );
	echo '</title>';    
}

/**
* Sets the header link rel attributes
*
* @since 1.0
*/
function response_link_rel() {
global $ne_themeslug, $options; //Call global variables
	$favicon = $options->get($ne_themeslug.'_favicon'); //Calls the favicon URL from the theme options 
	
	?>

<?php if( $options->get( $ne_themeslug.'_favicon_toggle' ) == true ): ?>
	<link rel="shortcut icon" href="<?php echo esc_url( $favicon['url'] ); ?>" type="image/x-icon" />
<?php endif; ?>

<?php if( $options->get($ne_themeslug.'_apple_touch_toggle') == true && is_array( $options->get($ne_themeslug.'_apple_touch') ) ): ?>
<!--  For apple touch icon -->
<?php $apple_icon = $options->get($ne_themeslug.'_apple_touch'); ?>
<link rel="apple-touch-icon" href="<?php echo $apple_icon['url']; ?>"/>
<?php endif; ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php
}


/**
* Header left content (sitename or logo)
*
* @since 1.0
*/
function response_header_sitename_content() {
	global $ne_themeslug, $options; //Call global variables
	$logo = $options->get($ne_themeslug.'_logo'); //Calls the logo URL from the theme options
	if( $url = $options->get($ne_themeslug.'_logo_url_toggle' ) == 1 )
	{
		$url = $options->get($ne_themeslug.'_logo_url') != '' ? $options->get($ne_themeslug.'_logo_url') : get_home_url();
	}
	else {
		$url = get_home_url();
	}
	
	if ($options->get($ne_themeslug.'_custom_logo') == '1') { ?>
	<div id="logo">
		<a href="<?php echo esc_url( $url ); ?>/"><img src="<?php echo esc_url( $logo['url'] ); ?>" alt="logo"></a>
	</div> <?php
	}
						
	else{ ?>
		<h1 class="sitename"><a href="<?php echo esc_url( $url ); ?>/"><?php bloginfo('name'); ?> </a></h1>
		<?php
	}						 
}

function response_header_site_description_content() {
	global $ne_themeslug, $options; ?>
	
	<div id="description">
		<h1 class="description"><?php bloginfo('description'); ?>&nbsp;</h1>
	</div> <?php
}


/**
* Social icons
*
* @since 1.0
*/
function response_header_social_icons_content() { 
	global $options, $ne_themeslug; //call globals
	
	// Get template directory uri into variable for further use.
	$template_dir = get_template_directory_uri();
	
	$facebook		= $options->get($ne_themeslug.'_facebook');
	$hidefacebook   = $options->get($ne_themeslug.'_hide_facebook_icon');
	$twitter		= $options->get($ne_themeslug.'_twitter');;
	$hidetwitter    = $options->get($ne_themeslug.'_hide_twitter_icon');;
	$gplus		    = $options->get($ne_themeslug.'_gplus');
	$hidegplus      = $options->get($ne_themeslug.'_hide_gplus_icon');
	$flickr		    = $options->get($ne_themeslug.'_flickr');
	$hideflickr     = $options->get($ne_themeslug.'_hide_flickr');
	$pinterest		= $options->get($ne_themeslug.'_pinterest');
	$hidepinterest	= $options->get($ne_themeslug.'_hide_pinterest');
	$linkedin		= $options->get($ne_themeslug.'_linkedin');
	$hidelinkedin   = $options->get($ne_themeslug.'_hide_linkedin');
	$youtube		= $options->get($ne_themeslug.'_youtube');
	$hideyoutube    = $options->get($ne_themeslug.'_hide_youtube');
	$googlemaps		= $options->get($ne_themeslug.'_googlemaps');
	$hidegooglemaps = $options->get($ne_themeslug.'_hide_googlemaps');
	$email			= $options->get($ne_themeslug.'_email');
	$hideemail      = $options->get($ne_themeslug.'_hide_email');
	$rss			= $options->get($ne_themeslug.'_rsslink');
	$hiderss   		= $options->get($ne_themeslug.'_hide_rss_icon');
	
	if ($options->get($ne_themeslug.'_icon_style') == '') {
		$folder = 'default';
	}
	
	else {
		$folder = $options->get($ne_themeslug.'_icon_style');
	} ?>

	<div id="social">

		<div class="icons">
	
		<?php if ($hidefacebook == '1' AND $facebook != '' OR $hidefacebook == '' AND $facebook != '' ):?>
			<a href="<?php echo esc_url( $facebook ) ?>" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/facebook.png" alt="Facebook" /></a>
		<?php endif;?>
		<?php if ($hidefacebook == '1' AND $facebook == '' OR $hidefacebook == '' AND $facebook == '' ):?>
			<a href="http://facebook.com" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/facebook.png" alt="Facebook" /></a>
		<?php endif;?>
		<?php if ($hidetwitter == '1' AND $twitter != '' OR $hidetwitter == '' AND $twitter != '' ):?>
			<a href="<?php echo esc_url( $twitter ) ?>" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/twitter.png" alt="Twitter" /></a>
		<?php endif;?>
		<?php if ($hidetwitter == '1' AND $twitter == '' OR $hidetwitter == '' AND $twitter == '' ):?>
			<a href="http://twitter.com" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/twitter.png" alt="Twitter" /></a>
		<?php endif;?>
		<?php if ($hidegplus == '1' AND $gplus != ''  OR $hidegplus == '' AND $gplus != '' ):?>
			<a href="<?php echo esc_url( $gplus ) ?>" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/gplus.png" alt="Gplus" /></a>
		<?php endif;?>
		<?php if ($hidegplus == '1' AND $gplus == '' OR $hidegplus == '' AND $gplus == '' ):?>
			<a href="https://plus.google.com" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/gplus.png" alt="Gplus" /></a>
		<?php endif;?>
		<?php if ($hideflickr == '1' AND $flickr != '' ):?>
			<a href="<?php echo esc_url( $flickr ) ?>" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/flickr.png" alt="Flickr" /></a>
		<?php endif;?>
		<?php if ($hideflickr == '1' AND $flickr == '' ):?>
			<a href="https://flickr.com" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/flickr.png" alt="Flickr" /></a>
		<?php endif;?>
		<?php if ($hidepinterest == '1' AND $pinterest != '' ):?>
			<a href="<?php echo esc_url( $pinterest ) ?>" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/pinterest.png" alt="Pinterest" /></a>
		<?php endif;?>
		<?php if ($hidepinterest == '1' AND $pinterest == '' ):?>
			<a href="https://pinterest.com" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/pinterest.png" alt="Pinterest" /></a>
		<?php endif;?>
		<?php if ($hidelinkedin == '1' AND $linkedin != '' ):?>
			<a href="<?php echo esc_url( $linkedin ) ?>" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/linkedin.png" alt="LinkedIn" /></a>
		<?php endif;?>
		<?php if ($hidelinkedin == '1' AND $linkedin == '' ):?>
			<a href="http://linkedin.com" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/linkedin.png" alt="LinkedIn" /></a>
		<?php endif;?>
		<?php if ($hideyoutube == '1' AND $youtube != '' ):?>
			<a href="<?php echo esc_url( $youtube ) ?>" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/youtube.png" alt="YouTube" /></a>
		<?php endif;?>
		<?php if ($hideyoutube == '1' AND $youtube == '' ):?>
			<a href="http://youtube.com" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/youtube.png" alt="YouTube" /></a>
		<?php endif;?>
		<?php if ($hidegooglemaps == '1' AND $googlemaps != ''):?>
			<a href="<?php echo esc_url( $googlemaps ) ?>" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/googlemaps.png" alt="Google Maps" /></a>
		<?php endif;?>
		<?php if ($hidegooglemaps == '1' AND $googlemaps == ''):?>
			<a href="http://google.com/maps" target="_blank" rel="me"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/googlemaps.png" alt="Google Maps" /></a>
		<?php endif;?>
		<?php if ($hideemail == '1' AND $email != ''):?>
			<a href="mailto:<?php echo $email ?>" target="_blank"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/email.png" alt="E-mail" /></a>
		<?php endif;?>
		<?php if ($hideemail == '1' AND $email == ''):?>
			<a href="mailto:no@way.com" target="_blank"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/email.png" alt="E-mail" /></a>
		<?php endif;?>
		<?php if ($hiderss == '1' and $rss != '' OR $hiderss == '' and $rss != '' ):?>
			<a href="<?php echo esc_url( $rss ) ?>" target="_blank"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/rss.png" alt="RSS" /></a>
		<?php endif;?>
		<?php if ($hiderss == '1' and $rss == '' OR $hiderss == '' and $rss == '' ):?>
			<a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><img src="<?php echo $template_dir; ?>/images/social/<?php echo $folder; ?>/rss.png" alt="RSS" /></a>
		<?php endif;?>
	
		</div><!--end icons--> 
		
	</div><!--end social--> <?php
}

/**
* Navigation
*
* @since 1.0
*/
function response_nav() {
	global $options, $ne_themeslug; //call globals 
		
	?>
		
	<div class="container">
		<div class="row">

			<div class="twelve columns" id="fullmenu">

			<div id="fullnav" class="twelve columns">
		    <?php wp_nav_menu( array(
		    'theme_location' => 'header-menu', // Setting up the location for the main-menu, Main Navigation.
		    'fallback_cb' => 'response_menu_fallback', //if wp_nav_menu is unavailable, WordPress displays wp_page_menu function, which displays the pages of your blog.
		    'items_wrap'      => '<ul id="fullnav_menu">%3$s</ul>',
			    )
			);
	    	?>
   			</div>
		</div>
	</div>
</div>
 <?php
}

/**
* Custom HTML header element.
*
* @since 1.0
*/
function response_custom_header_element_content() { 
	global $ne_themeslug, $options; ?>
	
	<div class="container">
		<div class="row">
		
			<div class="twelve columns">
				
				<?php echo stripslashes ($options->get($ne_themeslug.'_custom_header_element')); 	?>
						
			</div>	
		</div><!--end row-->
	</div>	

<?php	
}

/**
* Sitename/Register
*
* @since 1.0
*/
function response_logo_register_content() {
global $current_user;
?>

	<div class="container">
		<div class="row">
		
			<div class="seven columns">
				
				<!-- Begin @Core header sitename hook -->
					<?php response_header_sitename(); ?> 
				<!-- End @Core header sitename hook -->
		
			</div>	
			
			<div id="register" class="five columns">
			
			<?php if(!is_user_logged_in()) :?>

		<li><?php wp_loginout(); ?></li> <?php wp_meta(); ?><li> |<?php wp_register(); ?>  </li>

			<?php else :?>

			Welcome back <strong><?php global $current_user; get_currentuserinfo(); echo ($current_user->user_login); ?></strong> | <?php wp_loginout(); ?>

		<?php endif;?>
				
			</div>	
		</div><!--end row-->
	</div>

<?php
}

/**
* Logo/Icons header element.
*
* @since 1.0
*/
function response_logo_icons_content() {
?>
	<div class="container">
		<div class="row">
		
			<div class="seven columns">
				
				<!-- Begin @Core header sitename hook -->
					<?php response_header_sitename(); ?> 
				<!-- End @Core header sitename hook -->
			
				
			</div>	
			
			<div id ="register" class="five columns">
				
			<!-- Begin @Core header social icon hook -->
				<?php response_header_social_icons(); ?> 
			<!-- End @Core header contact social icon hook -->	
				
			</div>	
		</div><!--end row-->
	</div>

<?php
}

/**
* Full-Width Logo
*
* @since 3.0
*/
function response_banner_content() {
global $ne_themeslug, $options, $ne_root; //Call global variables
$banner = $options->get($ne_themeslug.'_banner'); //Calls the logo URL from the theme options
$default = "$ne_root/images/pro/banner.jpg";

?>
	<div class="container">
		<div class="row">
		
			<div class="twelve columns">
			<div id="banner">
			
			<?php if ($banner != ""):?>
				<a href="<?php echo home_url(); ?>/"><img src="<?php echo esc_url( $banner['url'] ); ?>" alt="logo"></a>		
			<?php endif; ?>
			
			<?php if ($banner == ""):?>
				<a href="<?php echo home_url(); ?>/"><img src="<?php echo $default; ?>" alt="logo"></a>		
			<?php endif; ?>
			
			</div>		
			</div>	
		</div><!--end row-->
	</div>	

<?php
}



/**
* End
*/

?>