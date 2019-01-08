
jQuery(function($){

	jQuery('.testimonial-slider').slick({
		dots: false,
		infinite: true,
		speed: 500,
		arrows:true, 
		autoplay: true,     
      	slidesToShow: 1,
		slide: 'div',		
		cssEase: 'linear'
	});
});