// SCROLL ANIMATION
AOS.init({
    duration: 2000,
    once:false,
    mirror:true,
});

// Typed
var typed = $('.typed');
$(function(){
    typed.typed({
        strings: ['Hernie', 'Designer','Developer'],
        typeSpeed: 200,
        loop: true,
    })
});

// About carousel
$('.services-carousel').owlCarousel({
    autoplay: true,
    loop: true,
    margin: 20,
    dots: false,
    nav: false,
    responsiveClass: true,
    responsive: {0:{items:2}, 320:{items:3}, 768:{items:4}, 900:{items:5}},
});