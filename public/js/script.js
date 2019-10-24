// DROPDOWN FIX
$('ul.nav li.dropdown').hover(function() {
	$(this).find('.dropdown-menu').stop(true, true).delay(100).slideDown(400);
}, function() {
	$(this).find('.dropdown-menu').stop(true, true).delay(100).slideUp(400);
});
$('.carousel').carousel({
	interval: 6000
});

// NAVBAR FIX
// $(window).on('resize', function() {
// 	var windowWidth = $(window).width();
// 	if ( windowWidth > 992 ){
// 		$("#nv-second").removeClass("container-fluid");
// 		$("#nv-second").addClass("container");
// 	}
// else if ( windowWidth < 992 ){
// 	$("#nv-second").removeClass("container");
// 	$("#nv-second").addClass("container-fluid");
// }
// else{
// 	$("#nv-second").addClass("container-fluid");
// 	$("#nv-second").removeClass("container");
// }
// });

  var windowWidth = $(window).width();
  if ( windowWidth > 769 ){
    $(window).scroll(function(){
      var sticky = $('.navbar'),
      scroll = $(window).scrollTop();
      if (scroll >= 800){
        sticky.addClass('fixed');
        $(".logo-holder .logos").attr("src", "images/logo/logo-sq.png");
        $(".logo-holder .logos").addClass("fixed-logo");
        $(".logo-holder .logos").removeClass("logo");
        $(".navbar").css("height", "85px");
        $("nav.navbar").css("top", "0");
        // $(".nav-book").show();
      }
      else {
        sticky.removeClass('fixed');
        $(".logo-holder .logos").removeClass("fixed-logo");
        $(".logo-holder .logos").addClass("logo");
        $(".logo-holder .logos").attr("src", "images/logo/logo.png");
        $(".navbar").css("height", "100px");
        $("nav.navbar").css("top", "30px");
        // $(".nav-book").hide();
      }
    });
  }


// $(window).scroll(function(){
//       var sticky = $('.navbar'),
//       scroll = $(window).scrollTop();
//       if (scroll >= 800){
//         sticky.addClass('fixed');
//         $(".logo-holder .logos").attr("src", "images/logo/logo-sq.png");
//         $(".logo-holder .logos").addClass("fixed-logo");
//         $(".logo-holder .logos").removeClass("logo");
//         $(".navbar").css("height", "75px");
//       }
//       else {
//         sticky.removeClass('fixed');
//         $(".logo-holder .logos").removeClass("fixed-logo");
//         $(".logo-holder .logos").addClass("logo");
//         $(".logo-holder .logos").attr("src", "images/logo/logo.png");
//         $(".navbar").css("height", "100px");
//       }
//     });


// WOW SCRIPT
wow = new WOW(
  {
    boxClass:     'wow',      // default
    animateClass: 'animated', // default
    offset:       0,          // default
    mobile:       false,       // default
    live:         true        // default
  }
  )
  wow.init();

  $(window).on('load', function() { // makes sure the whole site is loaded
    $('.loader-inner').fadeOut(); // will first fade out the loading animation
    $('.loader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
    // $('body').delay(350).css({'overflow':'visible'});
  });

  // jQuery(function(){
  //   jQuery("#mainplayer").YTPlayer();
  // });

  $('[data-toggle="date-pick"]').datepicker();

  $('.carousel').carousel({
    interval: 3000
  });

  $(window).on('load', function(){
    $('.main-mas').masonry({
      itemSelector: '.mas-gal',
      columnWidth: '.mas-gal'
    });
  });

  $('[data-fancybox="gallery"]').fancybox({
    // Options will go here
  });

  $('.big-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.small-slider'
});
$('.small-slider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.big-slider',
    dots: false,
    arrows:false,
    centerMode: false,
    focusOnSelect: true
});
