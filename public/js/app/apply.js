/**
 * invoice model
 * @author widuu <admin@widuu.com>
 */


define(function(require,exports,module){
	// import jquery
	var $   = require('jquery');
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
			if ( data.status == 0) {
					window.reload();
					//alert(data.info);
				}else{
					alert('申请成功!')
					window.location.href = '/user/apply/index';
			}
		}

	});
	

	$(function(){
		// change input 
		$('#pid').change(function(){
			var sel= document.getElementById("pid");
			var index=sel.selectedIndex; 
			var textsel= sel.options[index].value; 
			if (textsel==1){
				document.getElementById("zhuanpiao").style.display = "none";
			}else{
				document.getElementById("zhuanpiao").style.display = "";
			}
		})
	});
});