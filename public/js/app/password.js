/**
 * reset password model
 * @author widuu <admin@widuu.com>
 */

define(function(require,exports,module){
	var $ = require('jquery');
	
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
			// validata password
	        if( $('#password').val() == "" ) {
	        	alert('密码不能为空');
	        	$('#password').focus();
	        	return false;
	        }
	        // validata new password
	        if( $('#repassword').val() == "" ){
	        	alert('确认密码不能为空');
	        	return false;
	        }
	        // validata verify code
	        if( $('#password').val() != $('#repassword').val() ){
	        	alert('两次密码不一致');
	        	return false;
	        }
	        // validata verify code
	        if( $('#verifyimg').val() == "" ){
	        	$('#error_str').css('display','block');
	        	$('#error_str').text('验证码不能为空');
	        	return false;
	        }
	        // post data
			$.post(self.attr("action"), self.serialize(), success, "json");
			return false;
			// callback function 
			function success(data){
				if(data.status){
					alert('修改密码成功');
					window.location.href = data.url;
				}else{
					alert(data.info);
					return false;
				}
			}
		});
	});
});