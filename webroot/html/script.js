$(document).ready(function(){
	var show_menu = false;
	var recent_slider_each = 245;
	//drop down menu
	$('#menu-list').click(function(){
		var button_position = $(this).position();
		$('#main-menu').css('top',button_position+'px');
		if(show_menu == false){
			$('#main-menu').slideDown();
			show_menu = true;
		}else{
			$('#main-menu').slideUp();
			show_menu = false;
		}
	});
	
	
	$(window).resize(function(){
		//show the menu
		if($('#background').width() >= 800){
			$('#main-menu').show();
			show_menu = true;
		}else{
			$('#main-menu').hide();
			show_menu = false;
		}
		
		//recent slidier
		if($('.recent-slider').length > 0){
			var recent_slider_width = $('.recent-slider').width();
			if(recent_slider_width <= 225){
				var total_slide = 1;
				var slide_width = recent_slider_width ;
			}else if(recent_slider_width <= 470){
				var total_slide = 2;
				var slide_width = (recent_slider_width - 20)/2 ;
			}else if(recent_slider_width <= 715){
				var total_slide = 3;
				var slide_width = (recent_slider_width - 40)/3;
			}else{
				var total_slide = 4;
				var slide_width = (recent_slider_width - 60)/4 ;
			}
			recent_slider_each = slide_width+20; 
			
			$('.recent-slider').find('.recent-each').css('width',slide_width+'px');
			$('.recent-slider').find('.recent-each').css('height',slide_width+'px');
			$('.recent-slider').find('.recent-container').css('left','0px');
			
			var new_slider_height = slide_width+55;
			$('.recent-slider').height(new_slider_height);
			
			//update information
			$('.recent-slider').find('.recent-current').html(total_slide);
			$('.recent-slider').find('.recent-number-show').html(total_slide);
		}
	});

	
	//RECENT SLIDER
	//check broswer size
	if($('.recent-slider').length > 0){
		var recent_slider_width = $('.recent-slider').width();
		if(recent_slider_width <= 225){
			var total_slide = 1;
			var slide_width = recent_slider_width ;
		}else if(recent_slider_width <= 470){
			var total_slide = 2;
			var slide_width = (recent_slider_width - 20)/2 ;
		}else if(recent_slider_width <= 715){
			var total_slide = 3;
			var slide_width = (recent_slider_width - 40)/3;
		}else{
			var total_slide = 4;
			var slide_width = (recent_slider_width - 60)/4 ;
		}
		recent_slider_each = slide_width+20; 
		
		$('.recent-slider').find('.recent-each').css('width',slide_width+'px');
		$('.recent-slider').find('.recent-each').css('height',slide_width+'px');
		$('.recent-slider').find('.recent-container').css('left','0px');
		
		var new_slider_height = slide_width+55;
		$('.recent-slider').height(new_slider_height);
			
		//update information
		$('.recent-slider').find('.recent-current').html(total_slide);
		$('.recent-slider').find('.recent-number-show').html(total_slide);
		
		//prev button
		$('.recent-button-prev').click(function(){
			var root 				= $(this).parent().parent().parent();
			var current_id 			= parseInt( $(root).find('.recent-current').html() );
			var total 				= parseInt( $(root).find('.recent-total').html() );
			if(current_id != total){
				$(root).find('.recent-container').animate({
					left: '-='+recent_slider_each
				}, 200, function() {
					// Animation complete.
				});
				var next_current_id = current_id + 1;
				$(root).find('.recent-current').html(next_current_id);
			}
		});
		
		//next button
		$('.recent-button-next').click(function(){
			var root 				= $(this).parent().parent().parent();
			var current_id 			= parseInt( $(root).find('.recent-current').html() );
			var total 				= parseInt( $(root).find('.recent-total').html() );
			var recent_number_show	= parseInt( $(root).find('.recent-number-show').html() );
			if(current_id != recent_number_show){
				$(root).find('.recent-container').animate({
					left: '+='+recent_slider_each
				}, 200, function() {
					// Animation complete.
				});
				var next_current_id = current_id - 1;
				$(root).find('.recent-current').html(next_current_id);
			}
		});
	}
		
	//ACCORDION
	$('.accor-title').click(function(){
		var parent_each = $(this).parent();
		var accor_icon = $(parent_each).find('.accor-icon').html();
		if(accor_icon == '+'){
			var parent_accor = $(parent_each).parent();
			var accor_content = $(parent_each).find('.accor-content');
			$(parent_accor).find('.accor-content').each(function(){
				if(this != accor_content){
					$(this).slideUp("fast");
					$(this).parent().find('.accor-icon').html('+');
				}
			});
			$(accor_content).slideDown("fast");
			$(parent_each).find('.accor-icon').html('-');
		}else{
			var accor_content = $(parent_each).find('.accor-content');
			$(accor_content).slideUp("fast");
			$(parent_each).find('.accor-icon').html('+');
		}
	});
	
	//TAB
	$('.tab-title').click(function(){
		var tab_id = $(this).find('.tab-id').html();
		var parent_top = $(this).parent();
		var parent_tab = $(parent_top).parent();
		$(parent_top).find('.tab-title').removeClass("tab-current");
		$(this).addClass("tab-current");
		$(parent_tab).find('.tab-content').hide();
		$(parent_tab).find('.tab-content'+tab_id).show();
	});
	
	//TESTIMONIALS
	$('.testimonials-button-next').click(function(){
		var root 				= $(this).parent().parent().parent();
		var current_id 			= parseInt( $(root).find('.testimonials-current-id').html() );
		var total 				= parseInt( $(root).find('.testimonials-total').html() );
		var next_currennt_id 	= 1;
		if(current_id == total ){
			next_current_id = 1;
		}else{
			next_current_id = current_id + 1;
		}
		$(root).find('.testimonials-current-id').html(next_current_id);
		
		$(root).find('.testimonials-each').each(function(){
			var this_id = parseInt( $(this).find('.testimonials-id').html() );
			if( this_id == next_current_id){
				$(this).fadeIn(1000);
			}else{
				$(this).hide();
			}
		});
	});
	
	$('.testimonials-button-prev').click(function(){
		var root 				= $(this).parent().parent().parent();
		var current_id 			= parseInt( $(root).find('.testimonials-current-id').html() );
		var total 				= parseInt( $(root).find('.testimonials-total').html() );
		var next_currennt_id 	= 1;
		if(current_id == 1 ){
			next_current_id = total;
		}else{
			next_current_id = current_id - 1;
		}
		$(root).find('.testimonials-current-id').html(next_current_id);
		
		$(root).find('.testimonials-each').each(function(){
			var this_id = parseInt( $(this).find('.testimonials-id').html() );
			if( this_id == next_current_id){
				$(this).fadeIn(1000);
			}else{
				$(this).hide();
			}
		});
	});
	
	//recent projects widgets
	$('.recent-project-button-next').click(function(){
		var root 				= $(this).parent().parent().parent();
		var current_id 			= parseInt( $(root).find('.recent-project-current-id').html() );
		var total 				= parseInt( $(root).find('.recent-project-total').html() );
		var next_currennt_id 	= 1;
		if(current_id == total ){
			next_current_id = 1;
		}else{
			next_current_id = current_id + 1;
		}
		$(root).find('.recent-project-current-id').html(next_current_id);
		
		$(root).find('.recent-project-each').each(function(){
			var this_id = parseInt( $(this).find('.recent-project-id').html() );
			if( this_id == next_current_id){
				$(this).fadeIn(1000);
			}else{
				$(this).hide();
			}
		});
	});
	
	$('.recent-project-button-prev').click(function(){
		var root 				= $(this).parent().parent().parent();
		var current_id 			= parseInt( $(root).find('.recent-project-current-id').html() );
		var total 				= parseInt( $(root).find('.recent-project-total').html() );
		var next_currennt_id 	= 1;
		if(current_id == 1 ){
			next_current_id = total;
		}else{
			next_current_id = current_id - 1;
		}
		$(root).find('.recent-project-current-id').html(next_current_id);
		
		$(root).find('.recent-project-each').each(function(){
			var this_id = parseInt( $(this).find('.recent-project-id').html() );
			if( this_id == next_current_id){
				$(this).fadeIn(1000);
			}else{
				$(this).hide();
			}
		});
	});
	
	$('body').prepend('<div id="back_top"></div>');
	
	$('#back_top').click(function(){
		$('html, body').animate({scrollTop:0}, 'normal');
		 return false;
	});
	
	$(window).scroll(function() {
		if($(this).scrollTop() != 0) {
			$('#back_top').fadeIn();	
		} else {
			$('#back_top').fadeOut();
		}
	});
	
	if($(window).scrollTop() != 0) {
		$('#back_top').show();	
	} else {
		$('#back_top').hide();
	}
	
	//menu dropdown for small device
	jQuery('#main-menu-select').change(function(){
		window.location.replace(jQuery('#main-menu-select').val());
	});
});