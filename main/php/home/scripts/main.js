document.addEventListener('DOMContentLoaded', function() {


    // windowScroll = window.pageYOffset;
    // windowHeight = document.documentElement.clientHeight;
    // headerHeight = document.querySelector('.header').clientHeight;
    // menuOpen = document.querySelector('.menu-open .mobile-menu');
    // document.addEventListener('click', ()=> {
    //     menuOpen.style.top =`calc(${this.DOM.windowHeight - this.DOM.windowScroll + this.DOM.headerHeight}px)`;
    //     console.log(this.DOM.menuOpen.style.top);
    // })
    const so4 = new MobileMenu();
});

$(function() {
    var state = false;
    var pos;
    $('.mobile-menu__btn').click(function() {
        if (state == false) {
            pos = $(window).scrollTop();
            $('body').addClass('fixed').css({ 'top': -pos });
            state = true;
        } else {
            $('body').removeClass('fixed').css({ 'top': 0 });
            // $('.mobile-menu').removeClass('.menu-open').css({'top': pos + 80});
            window.scrollTo(0, pos);
            state = false;
        }
    });
});