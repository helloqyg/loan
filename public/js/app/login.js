/**
 * login model
 * @author widuu <admin@widuu.com>
 */
       function init() {
            function keydownFn(e) {
                if(e.which===13){
                    e.preventDefault();
                }
            }
            var $f = document.getElementById('verifyimg');
            $f.addEventListener('keydown', keydownFn);
        }
        init();
define(function(require, exports, module) {
	// import jquery object
	var $ = require('jquery');
	// login validata function and post data function
	var $   = require('jquery');
	require("../validform")($);
	var s = $(".regform").Validform({
		tiptype:function(msg,o,cssctl){
			if( msg == "登录成功"){
				o.type = 2;
			}
			var	objtip = $('#error_str');
			cssctl(objtip,o.type);
			objtip.text(msg);
		},
		label:".label",
		showAllError:true,
		ajaxPost:true,
		callback:function(data){
			if(data.status){
				window.location.href = data.url;
			} else {
				alert(data.info);
				return false;
			}
		}

	});
	
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
		// $("form").submit(function(){
		// 	// acquisition object
		// 	var self = $(this);
		// 	// validata username
	 //        if( $('#username').val() == "" ) {
	 //        	$('#error_str').css('display','block');
	 //        	$('#error_str').text('用户名不能为空');
	 //        	$('#username').focus();
	 //        	return false;
	 //        }
	 //        // validata password
	 //        if( $('#password').val() == "" ){
	 //        	$('#error_str').css('display','block');
	 //        	$('#error_str').text('密码不能为空');
	 //        	$('#password').focus();
	 //        	return false;
	 //        }
	 //        // validata verify code
	 //        if( $('#verifyimg').val() == "" ){
	 //        	$('#error_str').css('display','block');
	 //        	$('#error_str').text('验证码不能为空');
	 //        	$('#verifyimg').focus();
	 //        	return false;
	 //        }
	        
	 //        // post data
		// 	$.post(self.attr("action"), self.serialize(), success, "json");
		// 	return false;
		// 	// callback function 
		// 	function success(data){
		// 		if(data.status){
		// 			window.location.href = data.url;
		// 		} else {
		// 			alert(data.info);
		// 			return false;
		// 		}
		// 	}
		// });
	});
});