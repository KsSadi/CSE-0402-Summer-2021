(function ($) {
    "use strict";

    /*---------------------------------------------------
        Portfolio Filter
    ----------------------------------------------------*/
    var Container = $('#portfolio-area');
    Container.imagesLoaded(function () {
        var portfolio = $('.portfolio-menu');
        portfolio.on('click', 'button', function () {
            $(this).addClass('active').siblings().removeClass('active');
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
        var $grid = $('.portfolio-list').isotope({
            itemSelector: '.grid-item'
        });

    });

    /*---------------------------------------------------
        Main Slider
    ----------------------------------------------------*/
    $('.silder').owlCarousel({
        loop: true,
        navText: ['<i class="icofont icofont-simple-left"></i>', '<i class="icofont icofont-simple-right"></i>'],
        nav: true,
        autoplay: true,
        autoplayTimeout: 5000,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            960: {
                items: 1
            },
            1200: {
                items: 1
            },
            1920: {
                items: 1
            }
        }
    });

    /*---------------------------------------------------
        Testimonial Carousel
    ----------------------------------------------------*/
    $('.testimonial').owlCarousel({
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            991: {
                items: 1
            },
            1200: {
                items: 1
            },
            1920: {
                items: 1
            }
        }
    });

    /*---------------------------------------------------
        Partner Carousel
    ----------------------------------------------------*/
    $('.partner').owlCarousel({
        margin: 20,
        responsive: {
            0: {
                items: 2
            },
            768: {
                items: 4
            },
            960: {
                items: 4
            },
            1200: {
                items: 5
            },
            1920: {
                items: 5
            }
        }
    });

    /*---------------------------------------------------
        Counter
    ----------------------------------------------------*/
    $('.counter-single h2').counterUp({
        delay: 10, // the delay time in ms
        time: 1000 // the speed time in ms
    });

    /*---------------------------------------------------
            Magnific PopUp
    ----------------------------------------------------*/
    $('.popup-img').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    $('.popup-video').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    /*---------------------------------------------------
        Smooth Scroll
    ----------------------------------------------------*/
    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 500);

    });

    /*---------------------------------------------------
        Site Preloader
    ----------------------------------------------------*/
    $(window).on('load', function () {
        $('.preload-main').delay(1000).fadeOut(800);
    });


}(jQuery));
