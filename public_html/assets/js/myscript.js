$(function() {

  "use strict";

  var topoffset = 50; //variable for menu height
  // var slideqty = $('#featured .item').length;
  // var wheight = $(window).height(); //get the height of the window
  

  // $('.fullheight').css('height', wheight); //set to window tallness  


  // //replace IMG inside carousels with a background image
  // $('#featured .item img').each(function() {
  //   var imgSrc = $(this).attr('src');
  //   $(this).parent().css({'background-image': 'url('+imgSrc+')'});
  //   $(this).remove();
  // });

  //adjust height of .fullheight elements on window resize
    // $(window).resize(function() {
    //   wheight = $(window).height(); //get the height of the window
    //   $('.fullheight').css('height', wheight); //set to window tallness  
    // });



  // //Activate Scrollspy
  //   $('body').scrollspy({
  //     target: 'nav .',
  //     offset: topoffset
  //   });

  // // add inbody class
    // var hash = $(this).find('li.active a').attr('href');
    // if(hash !== '#featured') {
    //   $('header ').addClass('inbody');
    // } else {
    //   $('.wrap .menu').removeClass('inbody');
    // }


  // // // Add an inbody class to nav when scrollspy event fires
  //   $('.scroll').on('activate.bs.scrollspy', function() {
  //     var hash = $(this).find('li.active a').attr('href');
  //     if(hash !== '#featured') {
  //       $('.wrap .menu').addClass('inbody');
  //     } else {
  //       $('.wrap .menu').removeClass('inbody');
  //     }
  //   });


  //Use smooth scrolling when clicking on navigation
    $('.navbar a[href*=#]:not([href=#])').click(function() {
      if (location.pathname.replace(/^\//,'') === 
        this.pathname.replace(/^\//,'') && 
        location.hostname === this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html,body').animate({
            scrollTop: target.offset().top-topoffset+2
          }, 500);
          return false;
        } //target.length
      } //click function
    }); //smooth scrolling

  // //Automatically generate carousel indicators
  //   for (var i=0; i < slideqty; i++) {
  //     var insertText = '<li data-target="#featured" data-slide-to="' + i + '"></li>';
  //     $('#featured ol').append(insertText);
  //   }

  //   $('.carousel').carousel({
  //     interval: false
  //   });

});


$(document).ready(function (e) {
    $(".click").click(function (e) {
        $(this).find('.hovsw').show();
    }, function (e) {
        $(this).find('.hovsw').hide();
    });
});