var check = {username:false,password:false,rpassword:true,agree:false,email:true};

$("#Agree").bind("click",function(){
	if(this.checked){
		check.agree = true;
		$("#buyprotocal").hide();
		$("#accept_id").css("visibility","hidden");
	}else{
		check.agree = false;
		$("#buyprotocal").show();
	}
});

function agreement(){
	js.doModal("dialog",60,false,{left:'center',top:100},"#333333");
}

function agreeProtocal(){
	check.agree = true;
	$("#buyprotocal").hide();
	$("#Agree").attr("checked","true");
	js.closeModal('dialog');
};

function check_reg_code()
	{
	var user_name = $("#user_name").val();
	var password = $("#password").val();
	var password_confirm = $("#password_confirm").val();
	var unLength = byteLength(user_name);
	var verifycode = $("#verifycode").val();
	
	var spantip = $("#user_name_tip");
	$(spantip).css("display","block");
	$(spantip).attr("class","reg_span_right");
			
	if(user_name == "")
		{
		$(spantip).text("请输入用户名");
		return false;
		}
		
	if(unLength < 3)
		{
		$(spantip).text("长度不能小于3");
		return false;
		}
	if(unLength > 15)
		{
		$(spantip).text("长度不能大于15");
		return false;
		}
	if(user_name.match(/@$/))
		{
		$(spantip).text("不能以@结尾");
		return false;
		}
	if(user_name.match(/^@/))
		{
		$(spantip).text("不能以@开头");
		return false;
		}
	
	if(password.length < 6)
		{
		$("#password_tip").css("display","none");
		$("#pwd_tip").text("密码长度不能小于6");
		$("#pwd_tip").css("display","block");
		return false;
		}
	if(password.length > 16)
		{
		$("#password_tip").css("display","none");
		$("#pwd_tip").text("密码长度不能大于16");
		$("#pwd_tip").css("display","block");
		return false;
		}
		
	if(password != password_confirm)
		{
		$("#password_tip").css("display","none");
		$("#pwd_tip").text("两次输入密码不一致");
		$("#pwd_tip").css("display","block");
		return false;
		}
		
	if(verifycode == "")
		{
		var spantip = $("#verifycode_tip");
	$(spantip).css("display","block");
	$(spantip).attr("class","reg_span_right");
		$(spantip).text("请输入验证码");
	
		return false;
		}	
	$("#form_register").submit();
	}
