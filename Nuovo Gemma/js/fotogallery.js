(function($) {
    'use strict';
  
    $('.site-menu-toggle').click(function(){
      var $this = $(this);
      if ( $('body').hasClass('menu-open') ) {
        $this.removeClass('open');
        $('.js-site-navbar').fadeOut(400);
        $('body').removeClass('menu-open');
      } else {
        $this.addClass('open');
        $('.js-site-navbar').fadeIn(400);
        $('body').addClass('menu-open');
      }
    });
  
    $('nav .dropdown').hover(function(){
      var $this = $(this);
      $this.addClass('show');
      $this.find('> a').attr('aria-expanded', true);
      $this.find('.dropdown-menu').addClass('show');
    }, function(){
      var $this = $(this);
      $this.removeClass('show');
      $this.find('> a').attr('aria-expanded', false);
      $this.find('.dropdown-menu').removeClass('show');
    });
  
    $('#dropdown04').on('show.bs.dropdown', function () {
      console.log('show');
    });
  
    // aos
    AOS.init({
      duration: 1000
    });
  
    // home slider
    $('.home-slider').owlCarousel({
      loop:true,
      autoplay: true,
      margin:10,
      animateOut: 'fadeOut',
      animateIn: 'fadeIn',
      nav:true,
      autoplayHoverPause: true,
      items: 1,
      autoheight: true,
      navText : ["<span class='ion-chevron-left'></span>","<span class='ion-chevron-right'></span>"],
      responsive:{
        0:{
          items:1,
          nav:false
        },
        600:{
          items:1,
          nav:false
        },
        1000:{
          items:1,
          nav:true
        }
      }
    });
  
    // owl carousel
    var majorCarousel = $('.js-carousel-1');
    majorCarousel.owlCarousel({
      loop:true,
      autoplay: true,
      stagePadding: 7,
      margin: 20,
      animateOut: 'fadeOut',
      animateIn: 'fadeIn',
      nav: true,
      autoplayHoverPause: true,
      items: 3,
      navText : ["<span class='ion-chevron-left'></span>","<span class='ion-chevron-right'></span>"],
      responsive:{
        0:{
          items:1,
          nav:false
        },
        600:{
          items:2,
          nav:false
        },
        1000:{
          items:3,
          nav:true,
          loop:false
        }
      }
    });
  
    // owl carousel
    var major2Carousel = $('.js-carousel-2');
    major2Carousel.owlCarousel({
      loop:true,
      autoplay: true,
      stagePadding: 7,
      margin: 20,
      // animateOut: 'fadeOut',
      // animateIn: 'fadeIn',
      nav: true,
      autoplayHoverPause: true,
      autoHeight: true,
      items: 3,
      navText : ["<span class='ion-chevron-left'></span>","<span class='ion-chevron-right'></span>"],
      responsive:{
        0:{
          items:1,
          nav:false
        },
        600:{
          items:2,
          nav:false
        },
        1000:{
          items:3,
          dots: true,
          nav:true,
          loop:false
        }
      }
    });
  
    var siteStellar = function() {
      $(window).stellar({
        responsive: false,
        parallaxBackgrounds: true,
        parallaxElements: true,
        horizontalScrolling: false,
        hideDistantElements: false,
        scrollProperty: 'scroll'
      });
    }
    siteStellar();
  
    var smoothScroll = function() {
      var $root = $('html, body');
  
      $('a.smoothscroll[href^="#"]').click(function () {
        $root.animate({
          scrollTop: $( $.attr(this, 'href') ).offset().top
        }, 500);
        return false;
      });
    }
    smoothScroll();
  
    // ALBUMFOTO CONTIENE TUTTE LE FOTO NELLACARTELLA OMINOMA   

let albumfoto = ['big_1587569141301_1.jpg', 'big_1587569141305_1.jpg', 'big_1587569142103.jpg', 'big_1587569317302_1.jpg', 'big_1587569541303_1.jpg', 'big_1587569541304_3.jpg', 'big_1587652104_DSC7541.jpg', 'big_1587652104_DSC7546.jpg', 'big_1587652105_DSC7547.jpg', 'big_1587652105_DSC7549.jpg', 'big_1587652108_DSC7680.jpg', 'big_1587652108_DSC7682.jpg', 'big_1587652110_DSC7704-Pano.jpg', 'big_1587652151_DSC7741.jpg', 'big_1587652151_DSC7742.jpg', 'big_1587652152_DSC7745.jpg', 'big_1587652153_DSC7749.jpg', 'big_1587652153_DSC7755.jpg', 'big_1587652154_DSC7761.jpg', 'big_1587652155_DSC7767.jpg', 'big_1587652156102.jpg', 'big_1587652156103.jpg', 'big_1587652157103_1.jpg', 'big_1587652158301_1.jpg', 'big_1587652213301_2.jpg', 'big_1587652213301_3.jpg', 'big_1587652214302_1.jpg', 'big_1587652214302_2.jpg', 'big_1587652215302_3.jpg', 'big_1587652215302_4.jpg', 'big_1587652216303_1.jpg', 'big_1587652216303_2.jpg', 'big_1587652217303_3.jpg', 'big_1587652218304_1.jpg', 'big_1587652218304_2.jpg', 'big_1587652219304_3.jpg', 'big_1587652219304_4.jpg', 'big_1587652220305_1.jpg', 'big_1587652220305_2.jpg', 'big_1587652221big_home-page-standard-album-relax-e-tranquillita-2105.jpg', 'big_1587652221sala-1.jpg', 'big_1587652221Sala.jpg', 'big_1587652222Scale.jpg', 'big_1587652222Soffitto.jpg', 'mid_1587569141301_1.jpg', 'mid_1587569141305_1.jpg', 'mid_1587569142103.jpg', 'mid_1587569317302_1.jpg', 'mid_1587569541303_1.jpg', 'mid_1587569541304_3.jpg', 'mid_1587652103_DSC7494.jpg', 'mid_1587652104_DSC7541.jpg', 'mid_1587652104_DSC7546.jpg', 'mid_1587652105_DSC7547.jpg', 'mid_1587652105_DSC7549.jpg', 'mid_1587652106_DSC7556.jpg', 'mid_1587652107_DSC7660.jpg', 'mid_1587652107_DSC7663.jpg', 'mid_1587652108_DSC7680.jpg', 'mid_1587652108_DSC7682.jpg', 'mid_1587652109_DSC7702.jpg', 'mid_1587652110_DSC7704-Pano.jpg', 'mid_1587652110_DSC7730.jpg', 'mid_1587652111_DSC7733.jpg', 'mid_1587652111_DSC7737.jpg', 'mid_1587652150_DSC7740.jpg', 'mid_1587652151_DSC7741.jpg', 'mid_1587652151_DSC7742.jpg', 'mid_1587652152_DSC7743.jpg', 'mid_1587652152_DSC7745.jpg', 'mid_1587652153_DSC7749.jpg', 'mid_1587652153_DSC7755.jpg', 'mid_1587652153_DSC7759.jpg', 'mid_1587652154_DSC7761.jpg', 'mid_1587652154_DSC7762.jpg', 'mid_1587652155_DSC7763.jpg', 'mid_1587652155_DSC7767.jpg', 'mid_1587652156102.jpg', 'mid_1587652156103.jpg', 'mid_1587652157103_1.jpg', 'mid_1587652158301_1.jpg', 'mid_1587652213301_2.jpg', 'mid_1587652213301_3.jpg', 'mid_1587652214302_1.jpg', 'mid_1587652214302_2.jpg', 'mid_1587652215302_3.jpg', 'mid_1587652215302_4.jpg', 'mid_1587652216303_1.jpg', 'mid_1587652216303_2.jpg', 'mid_1587652217303_3.jpg', 'mid_1587652218304_1.jpg', 'mid_1587652218304_2.jpg', 'mid_1587652219304_3.jpg', 'mid_1587652219304_4.jpg', 'mid_1587652220305_1.jpg', 'mid_1587652220305_2.jpg', 'mid_1587652221big_home-page-standard-album-relax-e-tranquillita-2105.jpg', 'mid_1587652221sala-1.jpg', 'mid_1587652221Sala.jpg', 'mid_1587652222Scale.jpg', 'mid_1587652222Soffitto.jpg', 'normal_1587569141301_1.jpg', 'normal_1587569141305_1.jpg', 'normal_1587569142103.jpg', 'normal_1587569317302_1.jpg', 'normal_1587569541303_1.jpg', 'normal_1587569541304_3.jpg', 'normal_1587652103_DSC7494.jpg', 'normal_1587652104_DSC7541.jpg', 'normal_1587652104_DSC7546.jpg', 'normal_1587652105_DSC7547.jpg', 'normal_1587652105_DSC7549.jpg', 'normal_1587652106_DSC7556.jpg', 'normal_1587652107_DSC7660.jpg', 'normal_1587652107_DSC7663.jpg', 'normal_1587652108_DSC7680.jpg', 'normal_1587652108_DSC7682.jpg', 'normal_1587652109_DSC7702.jpg', 'normal_1587652110_DSC7704-Pano.jpg', 'normal_1587652110_DSC7730.jpg', 'normal_1587652111_DSC7733.jpg', 'normal_1587652111_DSC7737.jpg', 'normal_1587652150_DSC7740.jpg', 'normal_1587652151_DSC7741.jpg', 'normal_1587652151_DSC7742.jpg', 'normal_1587652152_DSC7743.jpg', 'normal_1587652152_DSC7745.jpg', 'normal_1587652153_DSC7749.jpg', 'normal_1587652153_DSC7755.jpg', 'normal_1587652153_DSC7759.jpg', 'normal_1587652154_DSC7761.jpg', 'normal_1587652154_DSC7762.jpg', 'normal_1587652155_DSC7763.jpg', 'normal_1587652155_DSC7767.jpg', 'normal_1587652156102.jpg', 'normal_1587652156103.jpg', 'normal_1587652157103_1.jpg', 'normal_1587652158301_1.jpg', 'normal_1587652213301_2.jpg', 'normal_1587652213301_3.jpg', 'normal_1587652214302_1.jpg', 'normal_1587652214302_2.jpg', 'normal_1587652215302_3.jpg', 'normal_1587652215302_4.jpg', 'normal_1587652216303_1.jpg', 'normal_1587652216303_2.jpg', 'normal_1587652217303_3.jpg', 'normal_1587652218304_1.jpg', 'normal_1587652218304_2.jpg', 'normal_1587652219304_3.jpg', 'normal_1587652219304_4.jpg', 'normal_1587652220305_1.jpg', 'normal_1587652220305_2.jpg', 'normal_1587652221big_home-page-standard-album-relax-e-tranquillita-2105.jpg', 'normal_1587652221sala-1.jpg', 'normal_1587652221Sala.jpg', 'normal_1587652222Scale.jpg', 'normal_1587652222Soffitto.jpg', 'small_1587569141301_1.jpg', 'small_1587569141305_1.jpg', 'small_1587569142103.jpg', 'small_1587569317302_1.jpg', 'small_1587569541303_1.jpg', 'small_1587569541304_3.jpg', 'small_1587652103_DSC7494.jpg', 'small_1587652104_DSC7541.jpg', 'small_1587652104_DSC7546.jpg', 'small_1587652105_DSC7547.jpg', 'small_1587652105_DSC7549.jpg', 'small_1587652106_DSC7556.jpg', 'small_1587652107_DSC7660.jpg', 'small_1587652107_DSC7663.jpg', 'small_1587652108_DSC7680.jpg', 'small_1587652108_DSC7682.jpg', 'small_1587652109_DSC7702.jpg', 'small_1587652110_DSC7704-Pano.jpg', 'small_1587652110_DSC7730.jpg', 'small_1587652111_DSC7733.jpg', 'small_1587652111_DSC7737.jpg', 'small_1587652150_DSC7740.jpg', 'small_1587652151_DSC7741.jpg', 'small_1587652151_DSC7742.jpg', 'small_1587652152_DSC7743.jpg', 'small_1587652152_DSC7745.jpg', 'small_1587652153_DSC7749.jpg', 'small_1587652153_DSC7755.jpg', 'small_1587652153_DSC7759.jpg', 'small_1587652154_DSC7761.jpg', 'small_1587652154_DSC7762.jpg', 'small_1587652155_DSC7763.jpg', 'small_1587652155_DSC7767.jpg', 'small_1587652156102.jpg', 'small_1587652156103.jpg', 'small_1587652157103_1.jpg', 'small_1587652158301_1.jpg', 'small_1587652213301_2.jpg', 'small_1587652213301_3.jpg', 'small_1587652214302_1.jpg', 'small_1587652214302_2.jpg', 'small_1587652215302_3.jpg', 'small_1587652215302_4.jpg', 'small_1587652216303_1.jpg', 'small_1587652216303_2.jpg', 'small_1587652217303_3.jpg', 'small_1587652218304_1.jpg', 'small_1587652218304_2.jpg', 'small_1587652219304_3.jpg', 'small_1587652219304_4.jpg', 'small_1587652220305_1.jpg', 'small_1587652220305_2.jpg', 'small_1587652221big_home-page-standard-album-relax-e-tranquillita-2105.jpg', 'small_1587652221sala-1.jpg', 'small_1587652221Sala.jpg', 'small_1587652222Scale.jpg', 'small_1587652222Soffitto.jpg']


let fotogallery = ['big_1587569141301_1.jpg', 'big_1587569141305_1.jpg', 'big_1587569142103.jpg', 'big_1587569317302_1.jpg', 'big_1587569541303_1.jpg', 'big_1587569541304_3.jpg', 'big_1587652104_DSC7541.jpg', 'big_1587652104_DSC7546.jpg', 'big_1587652105_DSC7547.jpg', 'big_1587652105_DSC7549.jpg', 'big_1587652108_DSC7680.jpg', 'big_1587652108_DSC7682.jpg', 'big_1587652110_DSC7704-Pano.jpg', 'big_1587652151_DSC7741.jpg', 'big_1587652151_DSC7742.jpg', 'big_1587652152_DSC7745.jpg', 'big_1587652153_DSC7749.jpg', 'big_1587652153_DSC7755.jpg', 'big_1587652154_DSC7761.jpg', 'big_1587652155_DSC7767.jpg', 'big_1587652156102.jpg', 'big_1587652156103.jpg', 'big_1587652157103_1.jpg', 'big_1587652158301_1.jpg', 'big_1587652213301_2.jpg', 'big_1587652213301_3.jpg', 'big_1587652214302_1.jpg', 'big_1587652214302_2.jpg', 'big_1587652215302_3.jpg', 'big_1587652215302_4.jpg', 'big_1587652216303_1.jpg', 'big_1587652216303_2.jpg', 'big_1587652217303_3.jpg', 'big_1587652218304_1.jpg', 'big_1587652218304_2.jpg', 'big_1587652219304_3.jpg', 'big_1587652219304_4.jpg', 'big_1587652220305_1.jpg', 'big_1587652220305_2.jpg', 'big_1587652221big_home-page-standard-album-relax-e-tranquillita-2105.jpg', 'big_1587652221sala-1.jpg', 'big_1587652221Sala.jpg', 'big_1587652222Scale.jpg', 'big_1587652222Soffitto.jpg']



let swiperWrapper = document.querySelector(".swiper-wrapper")
      
fotogallery.forEach(element =>
      {
      let div = document.createElement("div")
      div.classList.add("swiper-slide")
      div.innerHTML = 
      `
      <img class="img-fluid rounded shadow-lg p-3 bg-body-tertiary" src="/images/photogallery/${element}" alt="foto"/>
      
      `

      swiperWrapper.appendChild(div)
      }
);



let slider = document.querySelector(".d-none");
let si = document.querySelector("#si");
let no = document.querySelector("#no");

si.addEventListener('click', function() {
  slider.classList.remove('d-none');
  si.classList.add('d-none');
  no.classList.add('d-none');
});

no.addEventListener('click', function() {
  slider.classList.remove('d-none');
});

    
  
    var goToTop = function() {
      $('.js-gotop').on('click', function(event){
        event.preventDefault();
  
        $('html, body').animate({
          scrollTop: $('html').offset().top
        }, 500, 'easeInOutExpo');
        
        return false;
      });
  
      $(window).scroll(function(){
        var $win = $(window);
        if ($win.scrollTop() > 200) {
          $('.js-top').addClass('active');
        } else {
          $('.js-top').removeClass('active');
        }
      });
    };
  
  })(jQuery);
  