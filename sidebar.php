<?php if (dynamic_sidebar('Sidebar Widgets')) : else : ?>
    
        <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
    
		<div class="widget-container">    
		<h2 class="widget-title">Welcome to Neuro</h2>
						<p>Thank you for using Neuro.</p>
						<p>We designed Neuro to be as user friendly as possible, but if you do run into trouble we provide a <a href="http://cyberchimps.com/forum">support forum</a>, and <a href="http://www.cyberchimps.com/neuro/docs/">precise documentation</a>.</p>
						<p>If we were all designers then every WordPress theme would look this good.</p>
						<p>(To remove this Widget login to your admin account, go to Appearance, then Widgets and drag new widgets into Sidebar Widgets)</p>
    	</div>
		
		<div class="widget-container">    
		<h2 class="widget-title"><?php _e('Pages', 'response' ); ?></h2>
		<ul>
    	<?php wp_list_pages('title_li=' ); ?>
    	</ul>
    	</div>
    
		<div class="widget-container">    
    	<h2 class="widget-title"><?php _e( 'Archives', 'response' ); ?></h2>
    	<ul>
    		<?php wp_get_archives('type=monthly'); ?>
    	</ul>
    	</div>
        
		<div class="widget-container">    
       <h2 class="widget-title"><?php _e('Categories', 'response' ); ?></h2>
        <ul>
    	   <?php wp_list_categories('show_count=1&title_li='); ?>
        </ul>
        </div>
        
		<div class="widget-container">    
    	<h2 class="widget-title"><?php _e('WordPress', 'response' ); ?></h2>
    	<ul>
    		<?php wp_register(); ?>
    		<li><?php wp_loginout(); ?></li>
    		<li><a href="<?php echo esc_url( __('http://wordpress.org/', 'response' )); ?>" target="_blank" title="<?php esc_attr_e('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'response'); ?>"> <?php _e('WordPress', 'response' ); ?></a></li>
    		<?php wp_meta(); ?>
    	</ul>
    	</div>
    	
    	<div class="widget-container">
    	<h2 class="widget-title"><?php printf( __('Subscribe', 'response' )); ?></h2>
    	<ul>
    		<li><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)', 'response' ); ?></a></li>
    		<li><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)', 'response' ); ?></a></li>
    	</ul>
    	</div>
	
<?php endif; ?>