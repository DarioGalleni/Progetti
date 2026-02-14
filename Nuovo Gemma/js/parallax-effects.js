/**
 * PARALLAX EFFECTS & MODERN ANIMATIONS
 * Gestisce tutti gli effetti di parallax e animazioni moderne del sito
 */

(function ($) {
    'use strict';

    // ===== SCROLL PROGRESS INDICATOR =====
    function initScrollProgress() {
        const progressBar = $('<div class="scroll-progress"></div>');
        $('body').prepend(progressBar);

        $(window).on('scroll', function () {
            const winScroll = $(this).scrollTop();
            const height = $(document).height() - $(window).height();
            const scrolled = (winScroll / height) * 100;
            $('.scroll-progress').css('width', scrolled + '%');
        });
    }

    // ===== SCROLL REVEAL ANIMATIONS =====
    function initScrollReveal() {
        const reveals = $('.reveal, .reveal-left, .reveal-right, .reveal-up');

        function checkReveal() {
            reveals.each(function () {
                const elementTop = $(this).offset().top;
                const elementBottom = elementTop + $(this).outerHeight();
                const viewportTop = $(window).scrollTop();
                const viewportBottom = viewportTop + $(window).height();

                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $(this).addClass('active');
                }
            });
        }

        // Check on scroll and load
        $(window).on('scroll', checkReveal);
        $(window).on('load', checkReveal);
        checkReveal(); // Initial check
    }

    // ===== PARALLAX SCROLLING EFFECT =====
    function initParallaxScroll() {
        $(window).on('scroll', function () {
            const scrolled = $(window).scrollTop();

            // Hero parallax effect
            if ($('#homepage').length) {
                $('#homepage').css({
                    'transform': `translateY(${scrolled * 0.5}px)`
                });
            }

            // Parallax sections
            $('.parallax-section').each(function () {
                const speed = $(this).data('speed') || 0.5;
                const yPos = -(scrolled * speed);
                $(this).css({
                    'background-position': `center ${yPos}px`
                });
            });

            // Parallax images
            $('.img-parallax').each(function () {
                const elementTop = $(this).offset().top;
                const speed = $(this).data('speed') || 0.2;
                const yPos = (scrolled - elementTop) * speed;

                $(this).find('img').css({
                    'transform': `translateY(${yPos}px)`
                });
            });
        });
    }

    // ===== MAGNETIC BUTTON EFFECT =====
    function initMagneticEffect() {
        if ($(window).width() > 768) {
            $('.magnetic').on('mousemove', function (e) {
                const $this = $(this);
                const relX = e.pageX - $this.offset().left;
                const relY = e.pageY - $this.offset().top;
                const moveX = (relX - $this.width() / 2) * 0.3;
                const moveY = (relY - $this.height() / 2) * 0.3;

                $this.css({
                    transform: `translate(${moveX}px, ${moveY}px)`
                });
            });

            $('.magnetic').on('mouseleave', function () {
                $(this).css({
                    transform: 'translate(0, 0)'
                });
            });
        }
    }

    // ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
    function initSmoothScroll() {
        $('a[href^="#"]').on('click', function (e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 1000, 'easeInOutCubic');
            }
        });
    }

    // ===== FLOATING ELEMENTS =====
    function initFloatingElements() {
        $('.float-animation').each(function (index) {
            const delay = index * 0.5;
            $(this).css({
                'animation-delay': `${delay}s`
            });
        });
    }

    // ===== PARALLAX LAYERS (Advanced) =====
    function initParallaxLayers() {
        $(window).on('scroll', function () {
            const scrolled = $(window).scrollTop();

            $('.parallax-layer').each(function () {
                const depth = $(this).data('depth') || 0.5;
                const movement = -(scrolled * depth);

                $(this).css({
                    transform: `translateY(${movement}px)`
                });
            });
        });
    }

    // ===== STAGGER ANIMATION DELAYS =====
    function initStaggerAnimations() {
        $('.stagger-1').css('animation-delay', '0.1s');
        $('.stagger-2').css('animation-delay', '0.2s');
        $('.stagger-3').css('animation-delay', '0.3s');
    }

    // ===== INIT ALL ON DOCUMENT READY =====
    $(document).ready(function () {
        initScrollProgress();
        initScrollReveal();
        initParallaxScroll();
        initMagneticEffect();
        initSmoothScroll();
        initFloatingElements();
        initParallaxLayers();
        initStaggerAnimations();

        // Smooth reveal on page load
        setTimeout(() => {
            $('body').addClass('loaded');
        }, 100);
    });

    // ===== EASING FUNCTIONS =====
    $.extend($.easing, {
        easeInOutCubic: function (x, t, b, c, d) {
            if ((t /= d / 2) < 1) return c / 2 * t * t * t + b;
            return c / 2 * ((t -= 2) * t * t + 2) + b;
        }
    });

})(jQuery);
