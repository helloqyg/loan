$('.nav_small_ul li').hover(function(){
	$(this).addClass('select')
},function(){
	$(this).removeClass('select')
	$('.nav_small_ul li :first').addClass('select')
})


//qq 彩色
$('.click-qq').hover(function(){
	$('.click-qq img').attr('src','images/qq_2.png')
},function(){
	$('.click-qq img').attr('src','images/qq.jpg')
})

$('.click-wechat').hover(function(){
	$('.click-wechat img').attr('src','images/wechat_3.png')
},function(){
	$('.click-wechat img').attr('src','images/wechat.jpg')
})


//合同申请select改变
function scan_hide(){
	var a = $('#send').val();
	$.each($(".express tr"), function(i){  
		if (a == 1) {
		   if(i > 2){
		    $(this).hide()
		   }
		}else{
		   	 $(this).show()
		   }   
	}); 


}


