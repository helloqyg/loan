/**
 * register model
 * @author widuu <admin@widuu.com>
 */

define(function(require, exports, module) {
	// import validata id data
	var ids = require('id_data');

	// import jquery
	var $   = require('jquery');
		//require('../validform.min')($);
		require("../validform")($);
	var s = $(".regform").Validform({
		tiptype:function(msg,o,cssctl){
			// console.log
			// var objtip;
			// if( o.obj.attr('class') == 'lx_input'){
			// 	objtip = $('.error_lx');
			// }else{
			var	objtip = o.obj.parent().siblings().eq(1);
			//}
			//var 
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
	
	s.addRule([
	/*
	{
		ele:"select",
		datatype:"*"
	},*/
	{
		ele:"#c_name",
		datatype:"s",
		nullmsg:"企业法人姓名不能为空！",
	},
	{
		ele:"#c_duties",
		datatype:"s",
		nullmsg:"企业法人职务不能为空！",
	},
	{
		ele:"#c_tel",
		datatype:"n6-11",
		nullmsg:"企业法人固定电话不能为空！",
	},
	{
		ele:"#c_phone",
		datatype:"m",
		nullmsg:"企业法人手机号码不能为空！",
		errormsg:"企业法人手机号码不正确",
	},
	{
		ele:"#c_email",
		datatype:"e",
		nullmsg:"企业法人邮箱不能为空！",
		errormsg:"企业法人的邮箱不正确",
	},
	{
		ele:"#c_fax",
		datatype:"n6-11",
		nullmsg:"企业法人传真不能为空！",
		errormsg:"企业法人的传真不正确",
	},
	{
		ele:"#f_name",
		datatype:"s",
		nullmsg:"负责人姓名不能为空！",
	},
	{
		ele:"#f_duties",
		datatype:"s",
		nullmsg:"负责人职务不能为空！",
	},
	{
		ele:"#f_tel",
		datatype:"n6-11",
		nullmsg:"负责人固定电话不能为空！",
	},
	{
		ele:"#f_phone",
		datatype:"m",
		nullmsg:"负责人手机号码不能为空！",
		errormsg:"负责人手机号码不正确",
	},
	{
		ele:"#f_email",
		datatype:"e",
		nullmsg:"负责人邮箱不能为空！",
		errormsg:"负责人的邮箱不正确",
	},
	{
		ele:"#f_fax",
		datatype:"n6-11",
		nullmsg:"负责人传真不能为空！",
		errormsg:"负责人的传真不正确",
	},
	]);
});