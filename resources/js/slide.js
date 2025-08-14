$(document).ready(function () {
    $(".banner__list").owlCarousel({
        items: 1, // Show one item at a time
        loop: true, // Loop the carousel
        autoplay: true, // Auto slide
        autoplayTimeout: 5000, // 5 seconds per slide
        autoplayHoverPause: true, // Pause on hover
        nav: false, // Hide navigation arrows
        dots: false, // Show dots
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
    });
        $(".facial__care").owlCarousel({
        items: 3, // Show one item at a time
        loop: true, // Loop the carousel
        autoplay: true, // Auto slide
        autoplayTimeout: 5000, // 5 seconds per slide
        autoplayHoverPause: true,
        margin: 20, // Pause on hover
        nav: false, // Hide navigation arrows
        dots: false, // Show dots
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 3,
            },
        },
    });
});
