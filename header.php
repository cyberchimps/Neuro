<?php 

/*
	Header
	
	Creates the Neuro header. 
	
	Copyright (C) 2011 CyberChimps
*/
$options = get_option('neuro') ; 
?>
<!DOCTYPE html>
<html <?php language_attributes('xhtml'); ?>>

<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<?php if ($options['ne_home_description'] != ''): ?>
	<!-- Inserts META Home Description -->
	<?php  $homedescription = $options['ne_home_description']; ?>
		<meta name="description" content="<?php echo $homedescription ?>" />
		<?php endif;?> 
		<?php if ($options['ne_home_keywords'] != ''): ?>
	<!-- Inserts META Keywords -->	
	<?php  $homekeywords = $options['ne_home_keywords'] ; ?>
		<meta name="keywords" content="<?php echo $homekeywords ?>" />
	<?php endif;?> 
	<meta name="distribution" content="global" />
	<meta name="language" content="en" />
<!-- Page title -->
	<title>
			<?php  $hometitle = $options['ne_home_title']; ?>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.esc_html($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title('');  }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_front_page() AND $hometitle == '') {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      elseif (is_front_page() AND $hometitle != '') {
		         bloginfo('name'); echo ' - '; echo $hometitle ; }
		      else {
		         echo ' - '; bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>	
	<?php  
	$tdurl = get_template_directory_uri();
	$favicon = $options['ne_favicon']; ?>
	
	<?php if ($options['ne_favicon'] == ""): ?>
			
		<link rel="shortcut icon" href="<?php echo "$tdurl/images/favicon.ico" ; ?>" type="image/x-icon" />
		<?php endif;?>
		<?php if ($options['ne_favicon'] != ""): ?>
			<link rel="shortcut icon" href="<?php echo stripslashes($favicon); ?>" type="image/x-icon" />
	<?php endif;?>
		
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
		<?php  
		if ($options['ne_font'] == "")
			$font = 'Helvetica+Neue';
			
		else
			$font = $options['ne_font']; 
			?>
	
	<?php $fontstrip =  ereg_replace("[^A-Za-z0-9]", " ", $font ); ?>		
	
	<link href='http://fonts.googleapis.com/css?family=<?php echo $font ?>' rel='stylesheet' type='text/css' />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	

	
	<?php wp_head(); ?>
	
	
</head>

<body style="font-family:'<?php echo $fontstrip ?>'" <?php body_class(); ?> >
	
	<div id="page-wrap">
		
		<div id="main">

			<div id="header">
				<div id="headerwrap">
					<div id="header_right">
							<div id="social">
								<?php get_template_part('icons', 'header'); ?>
							</div><!-- end social -->
						<br />
							<div id="searchbar">
								<?php get_search_form(); ?>
							</div>	
					</div><!-- end header_right -->
					<!-- Inserts Site Logo -->
					<?php  $logo = $options['ne_logo'] ; ?>
					<?php 	 if ( $logo != ''): ?>
							<div id="logo_img">
								<a href="<?php echo home_url(); ?>/"><img src="<?php echo stripslashes($logo); ?>" alt="logo"></a>
							</div>
						<?php endif;?>
						<?php if ($logo == '' ):?>
							<div id="logo">
								<h1 class="sitename"><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?> </a></h1>
							</div>
						<?php endif;?> 
					<div id="description">
						<h1 class="description"><?php bloginfo('description'); ?></h1>
					</div>
				</div><!-- end headerwrap -->
				
				
				<?php get_template_part('nav', 'header' ); ?>
				
			</div><!-- end header -->
