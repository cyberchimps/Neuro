jQuery(document).ready(function($){
		jQuery('.response-tabbed-wrap').tabs();
});



jQuery(document).ready(function($) {
	$('#halfnav_menu .sub-menu').hide();
	$('#halfnav_menu > li > .sub-menu').append('<span class="nav_arrow"/>');
	$("#halfnav_menu ul").find(".sub-menu").prev().addClass("parent-menu");
	
	$("#halfnav_menu > li").hover( function() {
		$(this).children(".sub-menu").fadeIn("slow");
	}, function () {
		$(this).find(".sub-menu").hide();
	});
	
	$("#halfnav_menu > li > .sub-menu li").hover( function() {
		$(this).children(".sub-menu").slideDown("slow");
	}, function () {
	});
});

jQuery(document).ready(function($) {
	$('#halfnav_menu .children').hide();
	$('#halfnav_menu > li > .children').append('<span class="nav_arrow"/>');
	$("#halfnav_menu ul").find(".children").prev().addClass("parent-menu");
	
	$("#halfnav_menu > li").hover( function() {
		$(this).children(".children").fadeIn("slow");
	}, function () {
		$(this).find(".children").hide();
	});
	
	$("#halfnav_menu > li > .children li").hover( function() {
		$(this).children(".children").slideDown("slow");
	}, function () {
	});
});

jQuery(document).ready(function($) {
	$('#fullnav_menu .sub-menu').hide();
	$('#fullnav_menu > li > .sub-menu').append('<span class="nav_arrow"/>');
	$("#fullnav_menu ul").find(".sub-menu").prev().addClass("parent-menu");
	
	$("#fullnav_menu > li").hover( function() {
		$(this).children(".sub-menu").fadeIn("slow");
	}, function () {
		$(this).find(".sub-menu").hide();
	});
	
	$("#fullnav_menu > li > .sub-menu li").hover( function() {
		$(this).children(".sub-menu").slideDown("slow");
	}, function () {
	});
});
