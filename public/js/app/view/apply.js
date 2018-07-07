/**
 * invoice model
 * @author widuu <admin@widuu.com>
 */

define(function(require,exports,module){
	var $ = require('jquery');
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
			// post data
			$.post(self.attr("action"), self.serialize(), success, "json");
			return false;
			// callback function 
			function success(data){
				if ( data.status == 0) {
					alert(data.info);
				}else{
					window.location.href = data.url;
				}
			}
			return false;
		});
	});
});