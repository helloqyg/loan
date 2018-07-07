define(function(require, exports, module) {
	var $ = require('jquery');
	var js={
		interVal:null,
		doModal:function(element_id,opacity,fix,pos,clr){
			var scrolltop = $(document).scrollTop(); 
			$("#mask_div").remove();//防止已经出现过覆盖层
			var mask = document.createElement("div");
				$(mask).css("background-color","#333");
				if(typeof(clr) != "undefined"){
					$(mask).css("background-color",clr);
				}
				$(mask).css({opacity: opacity/100});
			
			mask.setAttribute("id","mask_div");
			mask.style.position = "absolute";
			mask.style.left = "0px";
			mask.style.top = "0px";
			mask.style.width = js.getBodySize().totalWidth + "px";
			mask.style.height = js.getBodySize().totalHeight + "px";
			mask.style.zIndex = 10000;
			document.body.appendChild(mask);
			
			var cur = document.getElementById(element_id);
			var child = cur.childNodes;
			$(child).css("display","block");
			if(fix){
				$(cur).css("position","fixed");
			}else{
				$(cur).css("position","absolute");
			}
			//显示出来
			$(cur).css("display","block");
			var cur_w = cur.offsetWidth;
			$(cur).css("display","none");
			if(js.getBodySize().width > cur_w){
				if('center' == pos.left){
					cur.style.left = (js.getBodySize().width - cur_w)/2 + js.getBodySize().scrollLeft +"px";
				}else{
					cur.style.left = pos.left+"px";
				}
				
			}else{
				cur.style.left = "0px";
			}
			$(cur).css("display","block");
			
			cur.style.top = scrolltop+pos.top + "px";
			cur.style.zIndex = 90000;
			
			//绑定事件 非IE
			js.interVal = setInterval(function(){
				mask.style.width = js.getBodySize().totalWidth + "px";
				mask.style.height = js.getBodySize().totalHeight + "px";
				if(js.getBodySize().width > cur_w){
					if('center' == pos.left){
						cur.style.left = (js.getBodySize().width - cur_w)/2 + js.getBodySize().scrollLeft +"px";
					}else{
						cur.style.left = pos.left+"px";
					}
					
				}else{
					cur.style.left = "0px";
				}
				
			},100);  
		},
		getBodySize:function(){
			//var w1 = document.body.scrollWidth;document.body.scrollHeight;
			var visible_w = parseInt($("body").width());
			var total_w = parseInt($(document).width());
			var visible_h = parseInt($(window).height());
			var total_h = parseInt($(document).height());
			var sl = parseInt($(document).scrollLeft());
			var st = parseInt($(document).scrollTop());
			return {width:visible_w,height:visible_h,scrollLeft:sl,scrollTop:st,totalWidth:total_w,totalHeight:total_h};
		},
		closeModal:function(element_id){
			var mask = document.getElementById("mask_div");
			if(mask){
				$(mask).css("display","none");
				$(mask).remove();
				document.getElementById(element_id).style.display = "none";
			}
			$("#mask_div").remove();
			clearInterval(js.interVal);
			js.interVal = null;
		}
	};
	module.exports = js;
});