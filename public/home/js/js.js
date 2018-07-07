$('.nav_small_ul li').hover(function () {
    $(this).addClass('select')
}, function () {
    $(this).removeClass('select')
    $('.nav_small_ul li :first').addClass('select')
})


//qq 彩色
$('.click-qq').hover(function () {
    $('.click-qq img').attr('src', '/public/home/images/qq_2.png')
}, function () {
    $('.click-qq img').attr('src', '/public/home/images/qq.jpg')
})

$('.click-wechat').hover(function () {
    $('.click-wechat img').attr('src', '/public/home/images/wechat_3.png')
}, function () {
    $('.click-wechat img').attr('src', '/public/home/images/wechat.jpg')
})


//合同申请select改变
function scan_hide() {
    var a = $('#send').val();
    $.each($(".express tr"), function (i) {
        if (a == 1) {
            if (i > 2) {
                $(this).hide()
            }
        } else {
            $(this).show()
        }
    });


}

//wechat float
function wechat_float() {
    $('#macro-wx-box').show();
}

function wechat_float_close() {
    $('#macro-wx-box').hide();
}

//左侧特效
// $('.side_left  li').hover(function(){
// 	$(this).addClass('side_select')

// },function(){
// 	$('.side_left  li').removeClass('side_select')
// 	$('.side_left  li:first').addClass('side_select')

// })


var url = location.href;

if (url.indexOf('password') >= 1) {
    $('.password').addClass('side_select');
    $('.password').css('color', '#ffffff')
}
if (url.indexOf('company') >= 1) {
    $('.company_a').addClass('side_select');
    $('.company_a').css('color', '#ffffff')
}
if (url.indexOf('adver') >= 1) {
    $('.ad_a').addClass('side_select');
    $('.ad_a').css('color', '#ffffff')
}
if (url.indexOf('apply/receipt') >= 1) {
    $('.order').addClass('side_select');
    $('.order').css('color', '#ffffff')
}
if (url.indexOf('/apply/index') >= 1) {
    $('.con').addClass('side_select');
    $('.con').css('color', '#ffffff')
}
//help
if (url.indexOf('/help/novice') >= 1) {
    $('.novice_a').addClass('side_select');
    $('.novice_a').css('color', '#ffffff')
}

if (url.indexOf('/help/manual') >= 1) {
    $('.manual').addClass('side_select');
    $('.manual').css('color', '#ffffff')
}

if (url.indexOf('/help/process') >= 1) {
    $('.process').addClass('side_select');
    $('.process').css('color', '#ffffff')
}

if (url.indexOf('/help/account') >= 1) {
    $('.account_a').addClass('side_select');
    $('.account_a').css('color', '#ffffff')
}

if (url.indexOf('/help/download') >= 1) {
    $('.download_a').addClass('side_select');
    $('.download_a').css('color', '#ffffff')
}

if (url.indexOf('/help/contact') >= 1) {
    $('.contact_a').addClass('side_select');
    $('.contact_a').css('color', '#ffffff')
}
if (url.indexOf('/help/news') >= 1) {
    $('.news_a').addClass('side_select');
    $('.news_a').css('color', '#ffffff')
}

//广告预订 搜索点击效果
// $('#ad_search_1 ul li:gt(0)').click(function(){
// 	$('#ad_search_1 ul li').removeClass('ad_selected')
// 	$(this).addClass('ad_selected')
// })

// $('#ad_search_2 ul li:gt(0)').click(function(){
// 	$('#ad_search_2 ul li').removeClass('ad_selected')
// 	$(this).addClass('ad_selected')
// })


//广告预订 搜索点击效果
var url = window.location.href;

var flag = url.indexOf('ae_id/')
if (flag != -1) {
    var parmes = url.split('/');
    //return tp_id value
    var tp_id = $.inArray('tp_id', parmes) + 1
    var tp_id = parseInt(parmes[tp_id]) + 1
    //return ae_id value
    var ae_id = $.inArray('ae_id', parmes) + 1
    var ae_id = parseInt(parmes[ae_id]) + 1
    $('#ad_search_1 ul li:eq(' + ae_id + ')').addClass('ad_selected')
    $('#ad_search_2 ul li:eq(' + tp_id + ')').addClass('ad_selected')
}



