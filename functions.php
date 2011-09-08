<?php

/*
	Functions
	
	Establishes the core Neuro functions.
	
	Copyright (C) 2011 CyberChimps
*/

add_theme_support('automatic-feed-links');
	if ( ! isset( $content_width ) )
	$content_width = 600;
	
add_theme_support( 'post-thumbnails' ); 
set_post_thumbnail_size( 100, 100, true );

// This theme allows users to set a custom background
add_custom_background();

	
// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();


/**
* Attach CSS3PIE behavior to elements
* Add elements here that need PIE applied
*/   
function neuro_render_ie_pie() { ?>
<style type="text/css" media="screen">
#header li a, #headerwrap, #footer, .postmetadata, .post_container, .wp-caption, .sidebar-widget-style, .sidebar-widget-title {
  behavior: url('<?php echo get_template_directory_uri(); ?>/library/pie/PIE.htc');
}
</style>
<?php
}

add_action('wp_head', 'neuro_render_ie_pie', 8);
	
// Load jQuery
	if ( !is_admin() ) {
	   wp_enqueue_script('jquery');
	}


	// Coin Slider 

function neuro_cs_head(){
	 
	$path =  get_template_directory_uri() ."/library/cs/";

	$script = "
		
		<script type=\"text/javascript\" src=\"".$path."scripts/coin-slider.min.js\"></script>
		";
	
	echo $script;
}

add_action('wp_head', 'neuro_cs_head');

	

	// Register superfish scripts
	
function neuro_add_scripts() {
 
    if (!is_admin()) { // Add the scripts, but not to the wp-admin section.
    // Adjust the below path to where scripts dir is, if you must.
    $scriptdir = get_template_directory_uri() ."/library/sf/";
 
    // Register the Superfish javascript files
    wp_register_script( 'superfish', $scriptdir.'sf.js', false, '1.4.8');
    wp_register_script( 'sf-menu', $scriptdir.'sf-menu.js');
    // Now the superfish CSS
   
    //load the scripts and style.
	wp_enqueue_style('superfish-css');
    wp_enqueue_script('superfish');
    wp_enqueue_script('sf-menu');
    } // end the !is_admin function
} //end add_our_scripts function
 
//Add our function to the wp_head. You can also use wp_print_scripts.
add_action( 'wp_head', 'neuro_add_scripts',0);



	// Register menu names
	
	function neuro_register_menus() {
	register_nav_menus(
	array( 'header-menu' => __( 'Header Menu' ), 'extra-menu' => __( 'Extra Menu' ))
  );
}
	add_action( 'init', 'neuro_register_menus' );
	
	// Menu fallback
	
	function neuro_menu_fallback() {
	global $post; ?>
	
	<ul id="menu-nav" class="sf-menu">
	<?php wp_list_pages( 'title_li=&sort_column=menu_order&depth=3'); ?>
	</ul><?php
}

//Register Widgetized Sidebar and Footer
    
function neuro_sidebars(){    
    register_sidebar(array(
    	'name' => 'Sidebar Widgets',
    	'id'   => 'sidebar-widgets',
    	'description'   => 'These are widgets for the sidebar.',
    	'before_widget' => '<div id="%1$s" class="sidebar-widget-style">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="sidebar-widget-title">',
    	'after_title'   => '</h2>'
    ));
	
	register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<div class="footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-widget-title">',
		'after_title' => '</h3>',
	));
}
add_action( 'widgets_init', 'neuro_sidebars');
  
function neuro_admin_link() {

	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array( 'id' => 'Neuro', 'title' => 'Neuro Settings', 'href' => admin_url('themes.php?page=theme_options')  ) ); 
  
}
add_action( 'admin_bar_menu', 'neuro_admin_link', 113 );

//Neuro theme options file
	
require_once ( get_template_directory() . '/library/options/options.php' );
require_once ( get_template_directory() . '/library/options/meta-box.php' );
require_once ( get_template_directory() . '/library/options/options-themes.php' );
?>