/**
 * user register model
 * @author widuu <admin@widuu.com>
 */

define(function(require, exports, module) {
	// import jquery
	var $   = require('jquery');
	require("../validform")($);
	var s = $(".regform").Validform({
		tiptype:function(msg,o,cssctl){
			var	objtip = o.obj.parent().siblings().eq(1);
			/*
			if(o.type == 3){
				objtip = $("#check_user");
			}*/
			if(o.type != 1){
				cssctl(objtip,o.type);
				objtip.text(msg);
			}
		},
		label:".label",
		showAllError:true,
		ajaxPost:true,
		callback:function(data){
			if(data.status){
				window.location.href = data.url;
			} else {
				return false;
			}
		}

	});
	var js = require('dialog');
	// document reload function
	$(function(){
		// open agreement page
		$('#agreement').click(function(){
			js.doModal("dialog",60,false,{left:'center',top:100},"#333333");
		});
		// close agreement page
		$('#close_dialog').click(function(){
			js.closeModal('dialog');
		})
		// agree agreement function
		$('#agreeProtocal').click(function(){
			$("#buyprotocal").hide();
			$("#Agree").attr("checked","true");
			js.closeModal('dialog');
		});
	});
});