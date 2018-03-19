/*
Initial Map
*/

var map;
function initMap() {
  // //map options
  // var mapId = document.getElementById('map');
  // var options ={
  //   zoom: 18,
  //   center:{lat: 18.804906, lng: 98.921597}
  // }

  // // new map
  // var map = new google.maps.Map(mapId,options);

  // // marker
  // var marker = new google.maps.Marker({
  //   position:{lat: 18.804906, lng: 98.921597},
  //   map:map
	// });
	
	// console.log("initial google map.");
}

// When the DOM is ready, run this function
/* =================================
   PRE LOADER
=================================== */
// makes sure the whole site is loaded
jQuery(window).load(function () {
	
	'use strict';
        // will first fade out the loading animation
	jQuery(".status").fadeOut();
        // will fade out the whole DIV that covers the website.
	jQuery(".preloader").delay(1000).fadeOut("slow");
});

/* =================================
   ANIMATION
=================================== */
var wow = new WOW(
  {
    mobile: false  // trigger animations on mobile devices (default is true)
  }
);
wow.init();

/* =================================
   MAP
=================================== */
$(document).ready(function() {

  //#HEADER
	var slideHeight = $(window).height();
	$('#headere-top figure .item').css('height',slideHeight);

	$(window).resize(function(){'use strict',
		$('#headere-top figure .item').css('height',slideHeight);
	});


  //Scroll Menu
	$(window).on('scroll', function(){
		if( $(window).scrollTop()>100 ){
			$('.header-top .header-fixed-wrapper').addClass('navbar-fixed-top animated fadeInDown');
		} else {
			$('.header-top .header-fixed-wrapper').removeClass('navbar-fixed-top animated fadeInDown');
		}
	});

	 $(window).scroll(function(){                          
            if ($(this).scrollTop() > 200) {
                $('#menu').fadeIn(500);
            } else {
                $('#menu').fadeOut(500);
            }
});

// image viewer
$('.thumbnail').viewbox({
	setTitle: true //add caption if link has title attribute
	,margin: 20
	,resizeDuration: 300
	,openDuration: 200
	,closeDuration: 200
	,closeButton: true
	,navButtons: true
	,closeOnSideClick: true
	,nextOnContentClick: false
	,useGestures: true
});

	// Navigation Scroll
	$(window).scroll(function(event) {
		Scroll();
	});

	$('.navbar-collapse ul li a').on('click', function() {  
		$('html, body').animate({scrollTop: $(this.hash).offset().top - 1}, 1000);
		return false;
	});

	// User define function
	function Scroll() {
		var contentTop      =   [];
		var contentBottom   =   [];
		var winTop      =   $(window).scrollTop();
		var rangeTop    =   200;
		var rangeBottom =   500;

		$('.navbar-collapse').find('.scroll a').each(function(){
			contentTop.push( $( $(this).attr('href') ).offset().top);
			contentBottom.push( $( $(this).attr('href') ).offset().top + $( $(this).attr('href') ).height() );
		})

		$.each( contentTop, function(i){
			if ( winTop > contentTop[i] - rangeTop ){
				$('.navbar-collapse li.scroll')
				.removeClass('active')
				.eq(i).addClass('active');			
			}
		})
	};

  // affix
  var width = $(window).width();
  var top = $('.tp-banner-container').length == 0 ? -1 : $('.section-one').offset().top - $('.navbar').height() * 2;
  $('.navbar').affix({
    offset: {
      top: top
    , bottom: function () {
        return (this.bottom = $('.footer').outerHeight(true))
      }
    }
  });

	var owl = $("#owl-demo");
	
      owl.owlCarousel({
        itemsCustom : [
          [0, 1],
          [450, 1],
          [600, 1],
          [700, 1],
          [1000, 1],
          [1200, 1],
          [1400, 1],
          [1600, 1]
        ],
        navigation : true,
		autoPlay : 3000,
      });
	
	  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
		});
		
		//advanture slider
		$('.adventures-slider').slick({  
			infinite: true,    
			autoplay:true,
			arrows:false,
			fade:true
		});

		//elephant slider
		$('.elephant-slider').slick({  
			infinite: true,    
			autoplay:true,
			arrows:false,
			fade:true
		});

		$('.culture-slider').slick({  
			infinite: true,    
			autoplay:true,
			arrows:false,
			fade:true
		});
		


	});