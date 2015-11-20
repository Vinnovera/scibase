!function ($){
	"use strict";

	$(document).on('ready', function(){

		//Prevent multiple form submissions
		$('form').on('submit', function(){
		    $('input[type=submit]', this).attr('disabled', 'disabled').val('Please wait...');
		    $('button[type=submit]', this).attr('disabled', 'disabled').text('Please wait...');
		});

		$('.no-js').removeClass('no-js');

		$('.language').on('click', function(e){
			var $this = $(this),
			    ul    = $this.children('ul');

			ul.toggleClass('show');
			$this.on('mouseleave',function(){
				ul.removeClass('show');
			});
		});

		$('.foldable-list-headline').on('click', function(e){
			$(this).closest('.foldable-list-item').toggleClass('open');
		});

		$('.foldable-list-actions .expand-btn').on('click', function(e){
			if ($(this).text() == '+ Expand All') {
				$('.foldable-list-item').addClass('open');
				$(this).text('- Minimize All');
			}else{
				$('.foldable-list-item').removeClass('open');
				$(this).text('+ Expand All');
			}
		});

		/*
		$('.post.contact').each(function(){
			var $postfig = $('figure',this);
			var $postbd = $('.bd', this);
			var maxh = $postfig.outerHeight() - 15;
			if(maxh < 0){
				maxh = 130;
			}
			if($postbd.outerHeight() > maxh){
				var h = 0;
				$postbd.children().each(function(){
					h += $(this).outerHeight();
					if(h > maxh){
						var $elem = $(this);
						if(!$elem.hasClass('readmore')){
							//$elem.hide();
						}
					}
				});
			}
		});
		*/

		$('.post.contact > .readmore').click(function(e){
			e.preventDefault();
			if(!$(this).hasClass('down')){
				$(this).parent().find('.bd').addClass('down');
				$(this).addClass('down');
			} else {
				$(this).parent().find('.bd').removeClass('down');
				$(this).removeClass('down');
			}
			
		});
		
		
		//Create unique iframe ID
		
		if($('.slider iframe').length > 0) {
		
			$('.slider iframe').each( function (index) {
				var src = $(this).attr("src");
				if ($(this).attr('src')) {
					$(this).attr("id", "player_"+index);
					$(this).attr("src", src + '&api=1&player_id=player_'+index);
					//console.log(src);
				}
				
			});
			
		}
		
		//VIMEO API with froogaloop.js
		var vimeoPlayers = $('.slider').find('iframe'), player;
	 
	    for (var i = 0, length = vimeoPlayers.length; i < length; i++) {
	            player = vimeoPlayers[i];
	            $f(player).addEvent('ready', ready);
	    }
	 
	    function addEvent(element, eventName, callback) {
	        if (element.addEventListener) {
	            element.addEventListener(eventName, callback, false)
	        } else {
	            element.attachEvent(eventName, callback, false);
	        }
	    }
	 
	    function ready(player_id) {
	        var froogaloop = $f(player_id);
	        froogaloop.addEvent('play', function(data) {
	            $('.slider').flexslider("pause");
	        });
	        froogaloop.addEvent('pause', function(data) {
	            $('.slider').flexslider("play");
	        });
	    }
		

	});

	$(window).load(function() {
		$('.slider').flexslider({
			animation: 'slide',
			directionNav: true,
			controlNav: false,
			animationLoop: true,
			useCSS: false,
			video: true,
			slideshowSpeed: 7000,
			before: function(slider){
	            if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0)
	                  $f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');
	        }
		});
	});

	//Mobile-menu
	new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );


}(window.jQuery);
