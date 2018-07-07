/**
 * elevator-expo order system js
 * @author widuu <admin@widuu.com>
 */

define(function(require, exports, module){
	var $ = require('jquery');
	$(function(){
		$('#order_trade').click(function(){
			var aid = $("input[name='aid']").val();
	   		var remark = $("textarea[name='remark']").val();
	   		var type = $('input:radio[name="type"]:checked').val();
	   		//alert(type);return false;
			$.ajax({
				type : "POST",
  				url  : "/user/booth/pay.html",
  				data : {id:aid,remark:remark,type:2,pay_type:type},
  				success: function(data){
  					if(data.url_model == 2){ 
  						window.location.href="/user/booth/pay_up/"+aid+".html?type=1"
  					}
  					if(data.status==0){
						alert(data.info);
					}else{
						$("#info").html(data.info);
					}
  				}
			});
		});
		// fixed price show style
		var value=0;
		$("span[id*='price_']").each(function(){
			id = $(this).attr('id');
			value = parseFloat($('#'+id).text());
			$("#"+id).text(value.toFixed(2));
		});
	});
});