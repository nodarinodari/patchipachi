let swiper = new Swiper('.swiper', {
    centeredSlides: true,
    slidesPerView:1,
    loop: true,
    spaceBetween: 30,
    SimulateTouch: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
});