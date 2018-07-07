/**
 * invoice model
 * @author widuu <admin@widuu.com>
 */
define("invoice_a",[],[{'id':'company_name','name':'企业名称'},{'id':'invoice','name':'税号'},{'id':'address','name':'地址'},{'id':'blank','name':'开户银行'},{'id':'blank_num','name':'银行账号'}]);
define("invoice_b",[],[{'id':'company_name','name':'企业名称'},{'id':'invoice','name':'税号'}])
define(function(require,exports,module){
	var $ = require('jquery');
	var ids_a = require('invoice_a');
	var ids_b = require('invoice_b');
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
		//invalidata input
		$('form').submit(function(){
			var self = $(this);
			var type = $('#pid').val();
			var ids;
			if( type == 1 ){
				ids = ids_b;
			}else{
				ids = ids_a;
			}
			// loop validata data
			for (var i = 0; i < ids.length; i++) {
				var v_id = $('#'+ids[i].id);
				var error_id = v_id.parent().siblings('.error_msg');
				if( v_id.val() == "" ){
					v_id.focus();
					error_id.text(ids[i].name+'不能为空');
					return false;
				}else{
					error_id.text('');
				}
			};
			// post data
			$.post(self.attr("action"), self.serialize(), success, "json");
			return false;
			// callback function 
			function success(data){
				if ( data.status == 0) {
					alert(data.info);
				}else{
					window.reload();
					//window.location.href = data.url;
				}
			}
		});
		// fixed show style
		value = parseFloat($('#price_show').text());
		$("#price_show").text(value.toFixed(2));
	});
});