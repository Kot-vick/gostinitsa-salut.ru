jQuery(document).ready(function($) {
	"use strict"; 

	// Sticky header
	$(window).scroll(function() {
		var scrolled = $(this).scrollTop();
		
		if(scrolled > 10) {
			$('#main').css({ 'margin-top' : '50px'});	
			$('#header').css({ 'position' : 'fixed', 'top' : '0px' });
			$('.admin-bar #header').css({ 'position' : 'fixed', 'top' : '32px'});
		} else {
			$('#main').css({ 'margin-top' : '0'});	
			$('#header').css({ 'position' : 'relative', 'top' : 'auto' });
		}
		
	});
	
	
	// Trigger scroll
	setTimeout( function(){ 
		$(window).scroll();
	}, 500 );
	
});

// window.addEventListener("load", function(){
//     document.addEventListener("scroll", function(){

// 		 document.querySelector("#header-wrapper2").classList[window.pageYOffset < 1500 ? "add" : "remove"]("position-fixed");
//     });
// });