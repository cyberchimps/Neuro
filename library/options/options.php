<?php   

/* 
Portions of code referenced from Theme4Press http://theme4press.com/
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html  
*/

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' ); 


$options = get_option('neuro');

/**
 * Init plugin options to white list our options
 */  
function theme_options_init() {
	
	register_setting( 'ne_options', 'neuro', 'theme_options_validate' );
	add_settings_section('ne_main', '', 'ne_section_text', 'neuro');
	  add_settings_field('ne_filename', '', 'ne_setting_filename', 'neuro', 'ne_main'); 
	wp_register_script('nejquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"), false, '1.4.4');
  wp_register_script('nejqueryui', get_template_directory_uri(). '/library/js/jquery-ui.js');
  wp_register_script('nejquerycookie', get_template_directory_uri(). '/library/js/jquery-cookie.js');
  wp_register_script('necookie', get_template_directory_uri(). '/library/js/cookie.js');
  wp_register_script('nemcolor', get_template_directory_uri(). '/library/js/jscolor/jscolor.js');
  wp_register_style('necss', get_template_directory_uri(). '/library/options/theme-options.css');
}


$themename = "Neuro";
$template_url = get_template_directory_uri();


/**
 * Load up the menu page
 */
 
function theme_options_add_page() {
global $themename, $shortname, $options;
  $page = add_theme_page($themename." Settings", "".$themename." Settings", 'edit_theme_options', 'theme_options', 'theme_options_do_page');  

  add_action('admin_print_scripts-' . $page, 'ne_scripts');
  add_action('admin_print_styles-' . $page, 'ne_styles');  
 
}


function neuro_add_css() {
$options = get_option('neuro');
$color = $options[('ne_color')]; 
$tdurl = get_template_directory_uri();


	if ( $color == 'grey'){

	echo '<link rel="stylesheet" href="', $tdurl, '/library/css/grey.css" type="text/css" />';
	}


	
}
add_action( 'wp_head', 'neuro_add_css');


/*
Background
*/

function neuro_add_background() {
$options = get_option('neuro');

if (isset($options['ne_background']) == "")
			$background = 'grey-background';
			
		else
			$background = $options['ne_background']; 
			

$tdurl = get_template_directory_uri();

$disable = $options['ne_disable_background'];

	if ( $background == 'blue-background' && $disable != '1'){
		echo '<style type="text/css">';
		echo "body {background: url('$tdurl/images/bg/blue.jpg')}";
		echo '</style>';
	}
	
	elseif ( $disable != '1') {
		echo '<style type="text/css">';
		echo "body {background: url('$tdurl/images/bg/wood.jpg')}";
		echo '</style>';
	}
}

add_action( 'wp_head', 'neuro_add_background');

/*
Footer Color
*/

function neuro_add_footer_color() {

$options = get_option('neuro');

if (isset($options['ne_footer_color']) == "")
			$footer = '2C2C2C';
			
		else
			$footer = $options['ne_footer_color']; 
			
echo '<style type="text/css">';
		echo "#footer {background-color: #$footer;}";
		echo '</style>';

}

add_action( 'wp_head', 'neuro_add_footer_color');

/*
Custom CSS
*/

function neuro_custom_css() {
	$options = get_option('neuro');
	$neuro_css_css = $options['ne_css_options'];
	echo '<style type="text/css">' . "\n";
	echo neuro_css_filter ( $neuro_css_css ) . "\n";
	echo '</style>' . "\n";
}

function neuro_css_filter($_content) {
	$_return = preg_replace ( '/@import.+;( |)|((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/))/i', '', $_content );
	$_return = htmlspecialchars ( strip_tags($_return), ENT_NOQUOTES, 'UTF-8' );
	return $_return;
}

		
add_action ( 'wp_head', 'neuro_custom_css' );

$select_background = array(
	'0' => array(
			'value' => 'wood-background',
			'label' => __( 'Wood'),
			'thumbnail' => get_template_directory_uri() . '/images/bg/thumbs/woodlight.jpg',
		),
	
	'1' => array(
			'value' => 'blue-background',
			'label' => __( 'Blue'),
			'thumbnail' => get_template_directory_uri() . '/images/bg/thumbs/blue.png',
		),
	
	);
	
$select_font = array(
	'0' => array('value' =>'Helvetica+Neue','label' => __('Helvetica Neue')),'1' => array('value' =>'Arial','label' => __('Arial')),'2' => array('value' =>'Courier New','label' => __('Courier New')),'3' => array('value' =>'Georgia','label' => __('Georgia')),'4' => array('value' =>'Lucida Grande','label' => __('Lucida Grande')),'5' => array('value' =>'Tahoma','label' => __('Tahoma')),'6' => array('value' =>'Times New Roman','label' => __('Times New Roman')),'7' => array('value' =>'Ubuntu','label' => __('Ubuntu')),

);

$select_color =array(
	'0' => array('value' =>'default','label' => __('Black (default)')),'1' => array('value' =>'grey','label' => __('Grey')),
	
);



$shortname = "ne";

$optionlist = array (

array( "id" => $shortname,
	"type" => "open-tab"),

array( "type" => "open"),
array( "type" => "close"),

array( "type" => "close-tab"),

// General

array( "id" => $shortname."-tab1",
	"type" => "open-tab"),

array( "type" => "open"),


array( "name" => "Choose a font:",  
    "desc" => "(Default is Helvetica Neue)",  
    "id" => $shortname."_font",  
    "type" => "select1",  
    "std" => ""),

    
array( "name" => "Custom Favicon",  
    "desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",  
    "id" => $shortname."_favicon",  
    "type" => "text",  
    "std" => ""),   

array( "name" => "Google Analytics Code",  
    "desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically be added to the footer.",  
    "id" => $shortname."_ga_code",  
    "type" => "textarea",  
    "std" => ""),  

array(  "name" => "Show Facebook Like Button",
        "desc" => "Check this box to show the Facebook Like Button on blog posts",
        "id" => $shortname."_show_fb_like",
        "type" => "checkbox",
        "std" => "false"),  

array( "type" => "close"),

array( "type" => "close-tab"),

array( "id" => $shortname."-tab2",
	"type" => "open-tab"),
 
array( "type" => "open"),

array( "name" => "Choose a color scheme:",  
    "desc" => "(Default is Black)",  
    "id" => $shortname."_color",  
    "type" => "select2",  
    "std" => ""),
    
array( "name" => "Choose a background:",  
    "desc" => "(Default is Wood)",  
    "id" => $shortname."_background",  
    "type" => "radio",  
    "std" => ""),

array( "name" => "Footer Color",  
    "desc" => "Use the color picker to select the footer color (default is 2C2C2C).",  
    "id" => $shortname."_footer_color",  
      "type" => "color1",  
    "std" => "false"),
    
array( "name" => "Custom CSS",  
    "desc" => "Override default Neuro CSS here.",  
    "id" => $shortname."_css_options",  
    "type" => "textarea",  
    "std" => ""),  
    
array( "type" => "close"),
array( "type" => "close-tab"),


// Header

array( "id" => $shortname."-tab3",
	"type" => "open-tab"),
 
array( "type" => "open"),

array( "name" => "Logo URL",  
    "desc" => "Enter the link to your logo image (max-height 80px).",  
    "id" => $shortname."_logo",  
    "type" => "text",  
    "std" => ""),  

array( "name" => "Facebook URL",  
    "desc" => "Enter your Facebook page URL to display the Facebook social icon (to hide enter the word: hide).",  
    "id" => $shortname."_facebook",  
    "type" => "text",  
    "std" => ""),

array( "name" => "Twitter URL",  
    "desc" => "Enter your Twitter URL to display the Twitter social icon (to hide enter the word: hide).",  
    "id" => $shortname."_twitter",  
    "type" => "text",  
    "std" => ""),
    
array( "name" => "Google + URL",  
    "desc" => "Enter your Google + URL to display the Google + social icon (to hide enter the word: hide).",  
    "id" => $shortname."_gplus",  
    "type" => "text",  
    "std" => ""),
    
array( "name" => "LinkedIn URL",  
    "desc" => "Enter your LinkedIn URL to display the LinkedIn social icon (to hide enter the word: hide).",  
    "id" => $shortname."_linkedin",  
    "type" => "text",  
    "std" => ""),  
    
array( "name" => "YouTube URL",  
    "desc" => "Enter your YouTube URL to display the YouTube social icon (to hide enter the word: hide).",  
    "id" => $shortname."_youtube",  
    "type" => "text",  
    "std" => ""),  
    


array( "name" => "Email",  
    "desc" => "Enter your contact email address to display the email social icon (to hide enter the word: hide.",  
    "id" => $shortname."_email",  
    "type" => "text",  
    "std" => ""),
    
array( "name" => "RSS Link",  
    "desc" => "Enter Feedburner URL, or leave blank for default RSS feed (to hide enter the word: hide).",  
    "id" => $shortname."_rsslink",  
    "type" => "text",  
    "std" => ""),   
 
array( "type" => "close"),

array( "type" => "close-tab"),

array( "id" => $shortname."-tab4",
	"type" => "open-tab"),
 
array( "type" => "open"),



array( "name" => "Home Description",  
    "desc" => "Enter the META description of your homepage here.",  
    "id" => $shortname."_home_description",  
    "type" => "textarea",  
    "std" => ""),
    
array( "name" => "Home Keywords",  
    "desc" => "Enter the META keywords of your homepage here (separated by commas).",  
    "id" => $shortname."_home_keywords",  
    "type" => "textarea",  
    "std" => ""),
    
array( "name" => "Optional Home Title",  
    "desc" => "Enter an alternative title of your homepage here (default is site tagline).",  
    "id" => "ne_home_title",  
    "type" => "text",  
    "std" => ""),


array( "type" => "close"),
array( "type" => "close-tab"),

// neuro Slider

array( "id" => $shortname."-tab5",
	"type" => "open-tab"),

array( "type" => "open"),

array( "name" => "Hide Neuro Slider",  
    "desc" => "Check this box to hide the Feature Slider on the homepage.",  
    "id" => $shortname."_hide_slider",  
    "type" => "checkbox",  
    "std" => "false"),
    
array( "name" => "Show posts from category:",  
    "desc" => "(Default is all - WARNING: do not enter a category that does not exist or slider will not display)",  
    "id" => $shortname."_slider_category",  
    "type" => "text",  
    "std" => ""),

array( "name" => "Number of featured posts:",  
    "desc" => "(Default is 5)",  
    "id" => $shortname."_slider_posts_number",  
    "type" => "text",  
    "std" => ""),  

array( "name" => "Slider delay time (in milliseconds):",  
    "desc" => "(Default is 3500)",  
    "id" => $shortname."_slider_delay",  
    "type" => "text",  
    "std" => ""),
    
array( "name" => "Hide the navigation:",  
    "desc" => "Check to disable the slider navigation",  
    "id" => $shortname."_slider_navigation",    
   	"type" => "checkbox",
        "std" => "false"),   
  

array( "type" => "close"),   

array( "type" => "close-tab"),


// Footer

array( "id" => $shortname."-tab6",
	"type" => "open-tab"),

array( "type" => "open"),
  
array( "name" => "Footer Copyright",  
    "desc" => "Enter Copyright text used on the right side of the footer. It can be HTML",  
    "id" => $shortname."_footer_text",  
    "type" => "textarea",  
    "std" => ""),
    
array( "type" => "close"),

array( "type" => "close-tab"),


);  

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $themename, $shortname, $optionlist,  $select_font, $select_color, $select_background;
  

	if ( ! isset( $_REQUEST['updated'] ) ) {
		$_REQUEST['updated'] = false; 
} 
  if( isset( $_REQUEST['reset'] )) { 
            global $wpdb;
            $query = "DELETE FROM $wpdb->options WHERE option_name LIKE 'neuro'";
            $wpdb->query($query); 
            die;
            
     } 
   
?>

	<div class="wrap">
  
<br />
<div class="titletext">Neuro</div>
<br />
<div class="upgrade"><a href="http://cyberchimps.com/neuropro/" target="_blank">Upgrade to Neuro Pro</a> which includes support for multiple color options, a business ready homepage layout, Google Fonts, Custom Neuro Slider, and much more.</div>
<br /><br />



		<?php if ( false !== $_REQUEST['updated'] ) { ?>
		<?php echo '<div id="message" class="updated fade" style="float:left;"><p><strong>'.$themename.' settings saved</strong></p></div>'; ?>
    
    <?php } if( isset( $_REQUEST['reset'] )) { echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset</strong></p></div>'; } ?>  
				


  <form method="post" action="options.php" enctype="multipart/form-data">
  
    <p class="submit" style="clear:left;float: right;">
				<input type="submit" class="button-primary" value="Save Settings" />   
			</p>  
			
	<div class="menu">
	<ul>
		<li><a href="http://cyberchimps.com/support" target="_blank">Support</a></li>
		<li><a href="http://cyberchimps.com/ifeature-free/docs/">Documentation</a></li>
		<li><a href="http://cyberchimps.com/forum/" target="_blank">Forum</a></li>
		<li><a href="http://twitter.com/#!/cyberchimps" target="_blank">Twitter</a></li>
		<li><a href="http://www.facebook.com/CyberChimps" target="_blank">Facebook</a></li>
		<li><a href="http://cyberchimps.com/store/" target="_blank">CyberChimps Store</a></li>
		<li><a href="http://cyberchimpspro.com/" target="_blank">CyberChimps Pro</a></li>
		
	</ul>
	</div>
      
    <div id="tabs" style="clear:both;">   
    <ul class="tabNavigation">
        <li><a href="#ne-tab1"><span>General</span></a></li>
        <li><a href="#ne-tab2"><span>Design</span></a></li>
        <li><a href="#ne-tab3"><span>Header</span></a></li>
        <li><a href="#ne-tab4"><span>SEO</span></a></li>
        <li><a href="#ne-tab5"><span>Neuro Slider</span></a></li>        
        <li><a href="#ne-tab6"><span>Footer</span></a></li>
    
    </ul>
    
    <div class="tabContainer">
		
			<?php settings_fields( 'ne_options' ); ?>
			<?php $options = get_option( 'neuro' ); ?>

			<table class="form-table">   

      <?php foreach ($optionlist as $value) {  
switch ( $value['type'] ) {
 
case "open":
?>

<table width="100%" border="0" style="padding:10px;">

 
<?php break;
 
case "close":
?>


</table><br />
 
<?php break;


case "open-tab":
?>

<div id="<?php echo $value['id']; ?>">

 
<?php break;
 
case "close-tab":
?>


</div>
 
<?php break; 


case 'color1':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%">
    
    <?php
$options = get_option('neuro');

if (isset($options['ne_footer_color']) == "")
			$picker = '2C2C2C';
			
		else
			$picker = $options['ne_footer_color']; 
?>

<input type="text" class="color" id="neuro[ne_footer_color]" name="neuro[ne_footer_color]"  value="<?php echo $picker ;?>" style="width: 300px;">   

<br /><br />
    <b>- Like picking your own colors? <a href="http://cyberchimps.com/neuropro">Upgrade to Neuro Pro</a> to pick your own header, menu, and link colors as well.</b>
    </td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;


case 'radio':
?>
<tr>
<td width="15%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></td>
<td width="42%">

<?php
		foreach ( $select_background as $bg ) {						
?>

<?php  
		if ($options['ne_background'] == "")
			$background = 'wood-background';
			
		else
			$background = $options['ne_background']; 
			?>

<input type="radio" id="<?php echo 'neuro['.$value['id'].']'; ?>" name="<?php echo 'neuro['.$value['id'].']'; ?>" value="<?php echo esc_attr( $bg['value'] ); ?>" <?php if ($background  == $bg['value'] ) { echo 'checked="checked"' ; } ?>" />
								
	<img src="<?php echo esc_url( $bg['thumbnail'] ); ?>"/>								
									
	<?php
		}
?>

<br /><br /><br />

<input type="checkbox" id="neuro[ne_disable_background]" name="neuro[ne_disable_background]" value="1" <?php checked( '1', $options['ne_disable_background'] ); ?>> - Check this box to disable Neuro Backgrounds and use the <a href="<?php echo home_url(); ?>/wp-admin/themes.php?page=custom-background" />WordPress Custom Background</a> option.

<br />

</td>

</tr> 
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php break;

case 'upload':
?>   


<tr>

<td width="15%" rowspan="2" valign="middle"><strong>Custom logo</strong>


 
<tr>
<td width="85%">


    <?php settings_fields('ne_options'); ?>
    <?php do_settings_sections('neuro'); 
    $file = $options['file'];
    echo "<input type='text' name='ne_filename' value='{$file['url']}' size='60' /> <br />";
    echo "<input type='file' name='ne_filename' size='30' />";?>
    
    <br />
    <small>Upload a logo image to use</small>
  


</td>
</tr>


        
        <tr>
<td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


 
<?php break;
 
case 'textarea':
?>
 
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong></label> <br /><small><?php echo $value['desc']; ?></small> </td> 
    <td width="85%"><textarea id="<?php echo 'neuro['.$value['id'].']'; ?>" name="<?php echo 'neuro['.$value['id'].']'; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php echo stripslashes( $options[$value['id']] ); ?></textarea></td>  
 
  
 </tr>
 <tr>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr>
<?php break; 

case 'text':  
?>  
  
<tr>

    <td width="15%" rowspan="2" valign="middle"><label for="<?php echo $value['id']; ?>"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></label>  </td>
    <td width="85%"><input style="width:300px;" name="<?php echo 'neuro['.$value['id'].']'; ?>" id="<?php echo 'ne['.$value['id'].']'; ?>" type="<?php echo $value['type']; ?>" value="<?php if (  $options[$value['id']]  != "") { echo esc_attr($options[$value['id']]) ; } else { echo esc_attr($value['std']) ; } ?>" /></td>

  </tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php
break;


case 'select1':
?>
<tr>
<td width="15%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></td>
<td width="85%"><select style="width:300px;" name="<?php echo 'neuro['.$value['id'].']'; ?>">

<?php
								$selected = $options[$value['id']];
								$p = '';
								$r = '';

								foreach ( $select_font as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";      
								}
								echo $p . $r;   
							?>    

</select></td>
</tr> 
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;


case 'select2':
?>
<tr>
<td width="15%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></td>
<td width="85%"><select style="width:300px;" name="<?php echo 'neuro['.$value['id'].']'; ?>">

<?php
								$selected = $options[$value['id']];
								$p = '';
								$r = '';

								foreach ( $select_color as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";      
								}
								echo $p . $r;   
							?>    

</select></td>
</tr> 
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php
break;
 
case "checkbox":
?>
<tr>
<td width="15%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></td>
<td width="85%">
<input type="checkbox" name="<?php echo 'neuro['.$value['id'].']'; ?>" id="<?php echo 'neuro['.$value['id'].']'; ?>" value="1" <?php checked( '1', $options[$value['id']] ); ?>/>
</td>
</tr>
 
<tr>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ddd;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>


<?php break;
 
}
}
?>

 </div>  
      <div id="top"><a href='#TOP'><img src="<?php echo get_template_directory_uri() ;?>/images/options/top.png" /></a>
      </div>
      <div style="text-align: left;padding: 5px;"><a href="http://cyberchimps.com/" target="_blank"><img src="<?php echo get_template_directory_uri() ;?>/images/options/cyberchimpsmini.png" /></a></div>
    
    </div>    
</form>
    
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
&nbsp;&nbsp;&nbsp;<small>WARNING THIS RESTORES ALL DEFAULTS</small>
</p>
</form>
	</div>

	<?php
}


function theme_options_validate( $input ) {
	global  $select_font, $select_color, $select_background;

	// Assign checkbox value
  
  if ( ! isset( $input['ne_hide_callout'] ) )
		$input['ne_hide_callout'] = null;
	$input['ne_hide_callout'] = ( $input['ne_hide_callout'] == 1 ? 1 : 0 ); 
	
	  if ( ! isset( $input['ne_show_fb_like'] ) )
		$input['ne_show_fb_like'] = null;
	$input['ne_show_fb_like'] = ( $input['ne_show_fb_like'] == 1 ? 1 : 0 ); 
  
  
     if ( ! isset( $input['ne_hide_slider'] ) )
		$input['ne_hide_slider'] = null;
	$input['ne_hide_slider'] = ( $input['ne_hide_slider'] == 1 ? 1 : 0 ); 
  
  
    if ( ! isset( $input['ne_hide_boxes'] ) )
		$input['ne_hide_boxes'] = null;
	$input['ne_hide_boxes'] = ( $input['ne_hide_boxes'] == 1 ? 1 : 0 ); 
  
     if ( ! isset( $input['ne_hide_link'] ) )
		$input['ne_hide_link'] = null;
	$input['ne_hide_link'] = ( $input['ne_hide_link'] == 1 ? 1 : 0 ); 
	
	  if ( ! isset( $input['ne_slider_navigation'] ) )
		$input['ne_slider_navigation'] = null;
	$input['ne_slider_navigation'] = ( $input['ne_slider_navigation'] == 1 ? 1 : 0 ); 
  
if ( ! isset( $input['ne_disable_background'] ) )
		$input['ne_disable_background'] = null;
	$input['ne_disable_background'] = ( $input['ne_disable_background'] == 1 ? 1 : 0 ); 
  	// Strip HTML from certain options
  	
  /* $input['ne_logo'] = wp_filter_nohtml_kses( $input['ne_logo'] ); */
  
   $input['ne_facebook'] = wp_filter_nohtml_kses( $input['ne_facebook'] ); 
    
   $input['ne_twitter'] = wp_filter_nohtml_kses( $input['ne_twitter'] ); 
   
   $input['ne_gplus'] = wp_filter_nohtml_kses( $input['ne_gplus'] ); 
  
   $input['ne_linkedin'] = wp_filter_nohtml_kses( $input['ne_linkedin'] );   
  
   $input['ne_youtube'] = wp_filter_nohtml_kses( $input['ne_youtube'] );  
  
   $input['ne_rsslink'] = wp_filter_nohtml_kses( $input['ne_rsslink'] );  
  
   $input['ne_email'] = wp_filter_nohtml_kses( $input['ne_email'] );   
  
	return $input;    

}

?>
<?php


/* Truncate */

function truncate ($str, $length=10, $trailing='..')
{
 $length-=mb_strlen($trailing);
 if (mb_strlen($str)> $length)
	  {
 return mb_substr($str,0,$length).$trailing;
  }
 else
  {
 $res = $str;
  }
 return $res;
} 
  
/* Custom Menu */   
  
add_action( 'init', 'register_my_menu' );

function register_my_menu() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
}


// Add scripts and stylesheet

  function ne_scripts() {
        wp_enqueue_script('nejquery');
        wp_enqueue_script('nejqueryui');
        wp_enqueue_script('nejquerycookie');
        wp_enqueue_script('necookie');
        wp_enqueue_script('nemcolor');
   }
    
 function ne_styles() {
       wp_enqueue_style('necss');
   }

/* Redirect after activation */

if ( is_admin() && isset($_GET['activated'] ) && $pagenow ==	"themes.php" )
	wp_redirect( 'themes.php?page=theme_options' );
	
if ( isset( $_REQUEST['reset'] ))
  wp_redirect( 'themes.php?page=theme_options' );

?>