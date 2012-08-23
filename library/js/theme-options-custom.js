/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {

	
	$("#ne_logo_url_toggle").change(function() {
    var toShow = $("#section-ne_logo_url");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
  $("#section-ne_font").change(function() {
    if($(this).find(":selected").val() == 'custom') {
      $('#section-ne_custom_font').fadeIn();
    } else {
      $('#section-ne_custom_font').hide();
    }
  }).change();
	$("#ne_favicon_toggle").change(function() {
    var toShow = $("#section-ne_favicon");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
		}).change();
	$("#ne_apple_touch_toggle").change(function() {
    var toShow = $("#section-ne_apple_touch");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
		}).change();
   $("#ne_custom_background").change(function() {
    var toShow = $("#section-ne_background_upload, #section-ne_bg_image_position, #section-ne_bg_image_repeat, #section-ne_background_color, #section-ne_bg_image_attachment ");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
   }).change();
  $("#section-ne_menu_font").change(function() {
    if($(this).find(":selected").val() == 'custom') {
      $('#section-ne_custom_menu_font').fadeIn();
    } else {
      $('#section-ne_custom_menu_font').hide();
    }
  }).change();
  $("#ne_show_excerpts").change(function() {
    var toShow = $("#section-ne_excerpt_link_text, #section-ne_excerpt_length");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
  $("#ne_show_featuned_images").change(function() {
    var toShow = $("#section-ne_featuned_image_align, #section-ne_featured_image_height, #section-ne_featured_image_width");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
    $("#ne_disable_footer").change(function() {
    var toShow = $("#section-ne_footer_text, #section-ne_hide_link");
    if($(this).is(':checked')) {
      toShow.fadeIn();
    } else {
      toShow.fadeOut();
    }
  }).change();
    $("#ne_custom_logo").change(function() {
    var toShow = $("#section-ne_logo");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
    $("#ne_blog_custom_callout_options").change(function() {
    var toShow = $("#section-ne_blog_callout_text_color");
    if($(this).is(':checked')) {
      toShow.fadeIn();
    } else {
      toShow.fadeOut();
    }
  }).change();
  $("#ne_slider_type").change(function(){
    var val = $(this).val(),
      post = $("#section-ne_slider_category"),
      custom = $("#section-ne_customslider_category");
    if(val == 'custom') {
      post.hide(); custom.show();
    } else {
      post.show(); custom.hide();
    }
  }).change();
  
  
  $.each(['twitter', 'facebook', 'gplus', 'flickr', 'linkedin', 'pinterest', 'youtube', 'googlemaps', 'email', 'rsslink'], function(i, val) {
	  $("#section-ne_" + val).each(function(){
		  var $this = $(this), $next = $(this).next();
		  $this.find(".controls").css({float: 'left', clear: 'both'});
		  $next.find(".controls").css({float: 'right', width: 80});
		  $next.hide();
		  $this.find('.option').before($next.find(".option"));
		  $this.find("input[type='checkbox']").change(function() {
			  if($(this).is(":checked")) {
				  $(this).closest('.option').next().show();
			  } else {
				  $(this).closest('.option').next().hide();
			  }
		  }).change();
	  });
  });
});	

jQuery(function($) {
	var initialize = function(id) {
		var el = $("#" + id);
		function update(base) {
			var hidden = base.find("input[type='hidden']");
			var val = [];
			base.find('.right_list .list_items span').each(function() {
				val.push($(this).data('key'));
			});
			hidden.val(val.join(",")).change();
			el.find('.right_list .action').show();
			el.find('.left_list .action').hide();
		}
		el.find(".left_list .list_items").delegate(".action", "click", function() {
			var item = $(this).closest('.list_item');
			$(this).closest('.section_order').children('.right_list').children('.list_items').append(item);
			update($(this).closest(".section_order"));
		});
		el.find(".right_list .list_items").delegate(".action", "click", function() {
			var item = $(this).closest('.list_item');
			$(this).val('Add');
			$(this).closest('.section_order').children('.left_list').children('.list_items').append(item);
			$(this).hide();
			update($(this).closest(".section_order"));
		});
		el.find(".right_list .list_items").sortable({
			update: function() {
				update($(this).closest(".section_order"));
			},
			connectWith: '#' + id + ' .left_list .list_items'
		});

		el.find(".left_list .list_items").sortable({
			connectWith: '#' + id + ' .right_list .list_items'
		});

		update(el);
	}

	$('.section_order').each(function() {
		initialize($(this).attr('id'));
	});

	$("input[name='neuro[ne_blog_section_order]']").change(function(){
		var show = $(this).val().split(",");
		var map = {
			response_blog_slider: "subsection-featureslider",
			response_callout_section: "subsection-calloutoptions",
			response_twitterbar_section: "subsection-twtterbaroptions",
			response_index_carousel_section: "subsection-carouseloptions"
			// , response_box_section: ""
		};

		$.each(map, function(key, value) {
			$("#" + value).hide();
			$.each(show, function(i, show_key) {
				if(key == show_key)
					$("#" + value).show();
			});
		});
	}).trigger('change');
	
	$("input[name='neuro[header_section_order]']").change(function(){
		var show = $(this).val().split(",");
		var map = {
			response_sitename_contact: "section-ne_header_contact",
			response_custom_header_element: "section-ne_custom_header_element",
			response_banner: "section-ne_banner"
			// , response_box_section: ""
		};

		$.each(map, function(key, value) {
			$("#" + value).hide();
			$.each(show, function(i, show_key) {
				if(key == show_key)
					$("#" + value).show();
			});
		});
	}).trigger('change');

});
