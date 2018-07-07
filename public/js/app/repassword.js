/**
 * reset password model
 * @author widuu <admin@widuu.com>
 */

define(function(require,exports,module){
	var $ = require('jquery');
	
	$(function(){
		//验证密码
		$('#password').blur(function(){
			var self = $(this);
			$.post("/user/account/check_password",{password: $(this).val()},function(data){
				var error_id = self.parent().siblings('.error_msg');
				if( data == 0){
					error_id.text('原始密码错误');
	        		$('#login_button').attr('type','button');
					return false;
				}else{
					$('#login_button').attr('type','submit');
					error_id.text('');
				}
			});
		});

		require("../validform")($);
		var s = $(".regform").Validform({
			tiptype:function(msg,o,cssctl){
				var	objtip = o.obj.parent().siblings().eq(1);
				cssctl(objtip,o.type);
				objtip.text(msg);
			},
			label:".label",
			showAllError:true,
			ajaxPost:true,
			callback:function(data){
				if(data.status == 0){
					alert('修改失败');
				}else{
					alert('修改成功');
				}
				//alert(data.info);
				return false;
			}

		});
	
		// // form post data
		// $("form").submit(function(){
		// 	// acquisition object
		// 	var self = $(this);
		// 	// validata password
	 //        if( $('#password').val() == "" ) {
	 //        	alert('密码不能为空');
	 //        	return false;
	 //        }
	 //        // validata new password
	 //        if( $('#newpassword').val() == "" ){
	 //        	alert('新密码不能为空');
	 //        	return false;
	 //        }
	 //        // validata verify code
	 //        if( $('#repassword').val() != $('#newpassword').val() ){
	 //        	alert('两次密码不一致');
	 //        	return false;
	 //        }
	        
	 //        // post data
		// 	$.post(self.attr("action"), self.serialize(), success, "json");
		// 	return false;
		// 	// callback function 
		// 	function success(data){
		// 		alert(data.info);
		// 		return false;
		// 	}
		// });
	});
});