AOS.init({
    duration: 2000,
    once:false,
    mirror:false,
});

$(window).on("scroll", function(){
    // console.log($('.banner')[0]['offsetHeight']);
    if($(window).scrollTop() > $('.banner')[0]['offsetHeight']){
        $('header').addClass('visible');
        $('header').removeClass('invisible');
    }else{
        $('header').addClass('invisible');
        $('header').removeClass('visible');
    }
});