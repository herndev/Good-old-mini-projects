// SCROLL ANIMATION
AOS.init({
    duration: 2000,
    once:false,
    mirror:true,
});


$(document).ready(function(){
    
    // Dialog
    $('.dialogClose').on('click',function(){
        $('.bg-dialog').removeClass('dialog-show');
        $('.bg-dialog').addClass('dialog-close');
    });
    
    $('.dialogShow').on('click',function(){
        $('.bg-dialog').removeClass('dialog-close');
        $('.bg-dialog').addClass('dialog-show');
        console.log(this.id);
    });
});

// SCROLL FUNTION
// $(window).on("scroll", function(){
//     if($(window).scrollTop() > $('.banner')[0]['offsetHeight']){
//         $('header').addClass('visible');
//         $('header').removeClass('invisible');
//     }else{
//         $('header').addClass('invisible');
//         $('header').removeClass('visible');
//     }
// });