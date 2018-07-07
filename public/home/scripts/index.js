$(function(){
	$('.main>div').eq(0).show().siblings().hide();
    $('.footer>ul>li').eq(0).addClass('on');
    $.each($('.footer>ul>li'),(index, values)=>{
        $(values).on('click', ()=>{
            $(values).addClass('on').siblings().removeClass('on');
            $('.main>div').eq(index).show().siblings().hide();
        })
    })
    // swiper
    var mySwiper = new Swiper ('.once', {
        loop: true,
        slidesPerView : 2.1,
    })
    var mySwiper = new Swiper ('.seconed', {
        loop: true,
        autoplay: {
            delay: 3500,//1秒切换一次
        },
        effect : 'coverflow',
        slidesPerView: 2,
        centeredSlides: true,
        coverflowEffect: {
            rotate: 30,
            stretch: 10,
            depth: 60,
            modifier: 2,
            slideShadows : true
        },
    })
})