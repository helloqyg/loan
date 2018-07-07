/**
 * login model
 * @author widuu <admin@widuu.com>
 */

define(function(require, exports, module) {
	// import jquery object
	var $ = require('jquery');
	// login validata function and post data function
	$(function(){
		// reload verify code
		$(".verifyimg").click(function(){
			var verifyimg = $(".verifyimg").attr("src");
            if( verifyimg.indexOf('?')>0){
                $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
            }else{
                $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
            }
        });
        // validata input verify code
        $("#verifyimg").blur(function(){
			$.get("/user/login/check_verify",{code: $(this).val()},function(data){
				if( data == 0){
					$('#error_str').css('display','block');
	        		$('#error_str').text('验证码错误');
	        		$('#login_button').attr('type','button');
					return false;
				}else{
					$('#login_button').attr('type','submit');
					$('#error_str').text('');
				}
			});
		});
		// form post data
		$("form").submit(function(){
			// acquisition object
			var self = $(this);
			// validata username
	        if( $('#email').val() == "" ) {
	        	$('#error_str').css('display','block');
	        	$('#error_str').text('负责人邮箱不能为空');
	        }else{
	        	$('#error_str').text('');
	        }
	        // validata verify code
	        if( $('#verifyimg').val() == "" ){
	        	$('#error_str').css('display','block');
	        	$('#error_str').text('验证码不能为空');
	        }else{
	        	$('#error_str').text('');
	        }
	        
	        // post data
			$.post(self.attr("action"), self.serialize(), success, "json");
			return false;
			// callback function 
			function success(data){
				if(data.status){
					$('form').css('display','none');
					$('.success-tip').css('display','block');
					$('#success-tip').text(data.info);
				} else {
					alert(data.info);
					return false;
				}
			}
		});
	});
});