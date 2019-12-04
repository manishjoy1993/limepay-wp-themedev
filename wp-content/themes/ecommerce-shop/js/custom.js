var $ = jQuery.noConflict();
jQuery(document).ready(function($){
	/*header search input*/
	$(".header-search-icon i").click(function(){
     	$(".search-input ").toggleClass("active");
	});
	
	/*banner slider js start*/
	$('.main-slider-wrap').owlCarousel({
        items:1,
        loop:true,
        dots:true,
        nav: true,
		autoHeight:true,
        navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    });
	/*banner slider js end*/
	
	$('#secondary .rated-section-carousel').owlCarousel({
	    loop:true,
	    margin:50,
	    nav:true,
	    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	});


	$('.rated-section-carousel').owlCarousel({
	    loop:true,
	    margin:50,
	    nav:true,
	    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:2
	        },
	        1000:{
	            items:3
	        }
	    }
	});	

	/*testimonial carousel start*/
	$('#secondary .testimonial-slider').owlCarousel({
	    center: true,
	    loop:false,
	    margin:100,
	    dots: false,
	    nav: true,
	    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
	    responsive:{
	    	0:{
	            items:1
	        },
	        992:{
	            items:1
	        }
	    }
	});
	$('.testimonial-slider').owlCarousel({
	    center: true,
	    loop:false,
	    margin:100,
	    dots: false,
	    nav: true,
	    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
	    responsive:{
	    	0:{
	            items:1
	        },
	        992:{
	            items:2
	        }
	    }
	});

	/*client carousel for less width*/
	var $container = $('#secondary .client-carousel');
	if ( $container.length ){
		$container.owlCarousel({
			center: true,
		    items:1,
		    loop:true,
		    nav: true,
		    dots:false,
		    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],	   
		});
	}	

	/*client carousel start*/
	$('.client-carousel').owlCarousel({
		center: true,
	    items:5,
	    loop:true,
	    nav: true,
	    dots:false,
	    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
	    margin:80,
	    responsive:{
	    	0:{
	            items:2
	        },
	        480:{
	        	items:2
	        },
	        600:{
	            items:3
	        },
	        768:{
	        	items:4
	        },
	        992:{
	            items:5
	        }
	    }
	});
	/*active class adding and removing for latest-trending button*/
	$(".latest-trending-wrap  .button ").click(function() {
        $(".latest-trending-wrap .button.active").removeClass("active"), $(this).addClass("active")
    });
	/*userlogin pop up*/
    $(".user-info a").click(function(){
    	$(".user-info-dialogue").addClass("show");
	});
	$(".popup-close").click(function(){
	    $(".user-info-dialogue").removeClass("show");
	});

	/*tab js*/
	  $('.section-tabs ul li.tab-link').on("click",function () {
	    var tab_id = $(this).attr('data-tab');
	    $('.section-tabs ul li.tab-link').removeClass('current');
	    $('.tab-content').removeClass('current');
	    $(this).addClass('current');
	    $("." + tab_id).addClass('current');
	  });
     
    $(document).on('click', '.plus', function(e) {
        $input = $(this).prev('input.qty');
        var val = parseInt($input.val());
        var step = $input.attr('step');
        step = 'undefined' !== typeof(step) ? parseInt(step) : 1;
        $input.val( val + step ).change();
    });

    $(document).on('click', '.minus', function(e) {
            $input = $(this).next('input.qty');
            var val = parseInt($input.val());
            var step = $input.attr('step');
            step = 'undefined' !== typeof(step) ? parseInt(step) : 1;
            if (val > 0) {
            $input.val( val - step ).change();
        } 
    });  	  
});
jQuery(document).ready(function($) {
	/*FAQ TAB JS*/
	$( "#faq-tabs" ).tabs({ });
	/*mean menu js*/
     jQuery('.main-navigation').meanmenu({
	      meanMenuContainer: '.site-header',
	      meanScreenWidth:"769",
	      meanRevealPosition: "left",
	  });  
});


