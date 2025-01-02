jQuery(document).ready(function($) {
    $('.owl-carousel').owlCarousel({
        loop: false,
        margin: 20,
        nav: true,
        dots: true,
        autoplay: false,
        autoplayTimeout: 5000000,
        autoplayHoverPause: true,
        navText: [
            '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>',
            '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>'
        ],
        responsive: {
            0: {
                items: 1,
                margin: 10
            },
            640: {
                items: 2,
                margin: 15
            },
            1024: {
                items: 3,
                margin: 20
            }
        }
    });
});
