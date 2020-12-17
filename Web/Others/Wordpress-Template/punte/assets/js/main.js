jQuery(function ($) {

    if ($('#punte-side-navigation').length > 0) {
       
       $('body').on('click keypress','.punte-nav-icon', function(){
            $(this).toggleClass('active');
            $('.punte-mobile-overlay').toggleClass('active');
            $('#punte-side-navigation') .toggleClass('active');
       });

       $('body').on('click touchstart keypress','.mob-menu-close-icon', function(){
            $('.punte-nav-icon').toggleClass('active');
            $('.punte-mobile-overlay').toggleClass('active');
            $('#punte-side-navigation') .toggleClass('active');
       });

       //submenu toggle
        $('.main-side-navigation ul li ul').slideUp();

        $('<div class="sub-toggle" tabindex="0"></div>').insertBefore('.main-side-navigation .menu-item-has-children ul');

        $('body').on('click keypress','.main-side-navigation .sub-toggle', function()  {
            $(this).next('ul.sub-menu').slideToggle(400);
            $(this).parent('li').toggleClass('mob-menu-toggle');
        });

    }

    //Sticky Sidebar
    $('.punte-sticky-sidebar .punte-row > .vc_column_container').theiaStickySidebar({
        // Settings
        additionalMarginTop: 10,
        additionalMarginBottom: 10
    });

    if (punte_options.sticky_sidebar == "1") {
        $('.sidebar, .content-area').theiaStickySidebar({
            // Settings
            additionalMarginTop: 10,
            additionalMarginBottom: 10
        });
    }


 

    //ScrollTop
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            $('#pune-back-top').fadeIn();
        } else {
            $('#pune-back-top').fadeOut();
        }
    });

    $('#pune-back-top').click(function () {
        $('html,body').animate({
            scrollTop: 0
        }, 800);
    })

    /* Wishlist count ajax update */
    jQuery(document).ready(function ($) {
        $('body').on('added_to_wishlist', function () {
            $('.top-wishlist .count').load(yith_wcwl_plugin_ajax_web_url + ' .top-wishlist span', {action:
                        'yith_wcwl_update_single_product_list'});
        });
    });

    $('.menu-item-search a, .punte-mobile-search').click(function () {
        $('.header-search-wrapper').toggleClass('on');
    });

    $('body').on('click keypress','.search-close', function(){
         $('.header-search-wrapper').removeClass('on');
    });
    


    setTimeout(function () {
        $.stellar({
            horizontalScrolling: false,
            responsive: true,
        });
    }, 3000);

    

    if ($('.main-header').length > 0) {
        var onpageOffset = $('.main-header').outerHeight();
    } else {
        onpageOffset = 0
    }

    /*START SMOOTH SCROLL JS*/
    $('#site-navigation').onePageNav({
        navItems: 'a[href^=#]',
        currentClass: 'current',
        changeHash: false,
        scrollSpeed: 750,
        scrollOffset: onpageOffset
    });

    // *only* if we have anchor on the url
    var target = window.location.hash;
    if (target && $(target).length) {
        $('html, body').animate({
            scrollTop: $(target).offset().top - onpageOffset
        }, 1000);
    }
});