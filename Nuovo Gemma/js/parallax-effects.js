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

    // ===== PARALLAX MOUSE MOVEMENT =====
    function initMouseParallax() {
        $(document).on('mousemove', function (e) {
            const mouseX = e.pageX;
            const mouseY = e.pageY;
            const windowWidth = $(window).width();
            const windowHeight = $(window).height();

            $('.mouse-parallax').each(function () {
                const speed = $(this).data('speed') || 0.05;
                const moveX = (mouseX - windowWidth / 2) * speed;
                const moveY = (mouseY - windowHeight / 2) * speed;

                $(this).css({
                    transform: `translate(${moveX}px, ${moveY}px)`
                });
            });
        });
    }

    // ===== SCROLL REVEAL ANIMATIONS =====
    function initScrollReveal() {
        const reveals = $('.reveal, .reveal-left, .reveal-right');

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
            $('#homepage').css({
                'transform': `translateY(${scrolled * 0.5}px)`
            });

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

    // ===== IMAGE HOVER TILT EFFECT =====
    function initTiltEffect() {
        $('.room-modern, .img-parallax').on('mousemove', function (e) {
            const $this = $(this);
            const relX = e.pageX - $this.offset().left;
            const relY = e.pageY - $this.offset().top;
            const width = $this.width();
            const height = $this.height();

            const rotateY = ((relX - width / 2) / width) * 10;
            const rotateX = ((relY - height / 2) / height) * -10;

            $this.css({
                transform: `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`
            });
        });

        $('.room-modern, .img-parallax').on('mouseleave', function () {
            $(this).css({
                transform: 'perspective(1000px) rotateX(0) rotateY(0) scale(1)'
            });
        });
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

    // ===== COUNTER ANIMATION =====
    function initCounterAnimation() {
        $('.counter').each(function () {
            const $this = $(this);
            const countTo = $this.attr('data-count');

            $({ countNum: 0 }).animate({
                countNum: countTo
            }, {
                duration: 2000,
                easing: 'swing',
                step: function () {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function () {
                    $this.text(this.countNum);
                }
            });
        });
    }

    // ===== LAZY LOADING IMAGES =====
    function initLazyLoad() {
        const lazyImages = $('img[data-src]');

        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            });
        });

        lazyImages.each(function () {
            imageObserver.observe(this);
        });
    }

    // ===== TEXT TYPING ANIMATION =====
    function initTypingEffect() {
        const typed = $('.typed-text');
        if (typed.length) {
            const text = typed.data('text');
            let index = 0;

            function type() {
                if (index < text.length) {
                    typed.append(text.charAt(index));
                    index++;
                    setTimeout(type, 100);
                }
            }

            type();
        }
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

    // ===== INTERSECTION OBSERVER FOR ANIMATIONS =====
    function initIntersectionObserver() {
        const options = {
            threshold: 0.3,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('aos-animate');
                }
            });
        }, options);

        // Observe all AOS elements
        $('[data-aos]').each(function () {
            observer.observe(this);
        });
    }

    // ===== SCROLL ANIMATIONS WITH GSAP-LIKE EFFECT =====
    function initScrollAnimations() {
        $(window).on('scroll', function () {
            const scrollTop = $(window).scrollTop();

            // Fade and scale sections on scroll
            $('.section').each(function () {
                const elementTop = $(this).offset().top;
                const distance = scrollTop - elementTop;
                const windowHeight = $(window).height();

                if (distance < windowHeight && distance > -windowHeight) {
                    const opacity = 1 - Math.abs(distance) / windowHeight * 0.5;
                    const scale = 0.9 + (1 - Math.abs(distance) / windowHeight) * 0.1;

                    $(this).css({
                        opacity: opacity,
                        transform: `scale(${scale})`
                    });
                }
            });
        });
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
        initIntersectionObserver();

        // Optional - initialize only if elements exist
        if ($('.typed-text').length) initTypingEffect();
        if ($('.counter').length) initCounterAnimation();
        if ($('img[data-src]').length) initLazyLoad();

        // Mouse parallax only on desktop
        if ($(window).width() > 768) {
            initMouseParallax();
            initTiltEffect();
        }

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
