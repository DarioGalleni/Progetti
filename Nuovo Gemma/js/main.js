(function ($) {
  'use strict';

  // NAVBAR TOGGLE
  $('.site-menu-toggle').click(function () {
    var $this = $(this);
    if ($('body').hasClass('menu-open')) {
      $this.removeClass('open');
      $('.js-site-navbar').fadeOut(400);
      $('body').removeClass('menu-open');
    } else {
      $this.addClass('open');
      $('.js-site-navbar').fadeIn(400);
      $('body').addClass('menu-open');
    }
  });

  // OWL CAROUSEL (REVIEWS)
  var major2Carousel = $('.js-carousel-2');
  if (major2Carousel.length) {
    major2Carousel.owlCarousel({
      loop: true,
      autoplay: true,
      stagePadding: 7,
      margin: 20,
      nav: false,
      autoplayHoverPause: true,
      autoHeight: true,
      items: 3,
      navText: ["<span class='ion-chevron-left'></span>", "<span class='ion-chevron-right'></span>"],
      responsive: {
        0: {
          items: 1,
          nav: false
        },
        600: {
          items: 2,
          nav: false
        },
        1000: {
          items: 3,
          dots: true,
          nav: false,
          loop: true
        }
      }
    });
  }

  // HEADER SCROLL EFFECT
  var windowScroll = function () {
    $(window).scroll(function () {
      var $win = $(window);
      if ($win.scrollTop() > 200) {
        $('.js-site-header').addClass('scrolled');
      } else {
        $('.js-site-header').removeClass('scrolled');
      }
    });
  };
  windowScroll();

  // LOGO VISIBILITY ON SCROLL
  $(document).ready(function () {
    var lastScrollTop = 0;
    $(window).scroll(function () {
      var scrollTop = $(this).scrollTop();
      if (scrollTop > 200 && scrollTop > lastScrollTop) {
        $('.no_wrap').removeClass('d-none');
      } else {
        if (scrollTop <= 200) {
          $('.no_wrap').addClass('d-none');
        }
      }
      lastScrollTop = scrollTop;
    });
  });

})(jQuery);