<?php

/**
 * Application 对Model层进行二次封装
 *
 * @version   0.11
 * @copyright Copyright (c) 2015 http://www.widuu.com
 * @date      2015/10/13
 */


namespace Com;

class Data extends \Think\Model{
	
	/**
	 * Model层getFieldByName的二次封装
	 * @param  $model 数据库模块的名称
	 * @param  $value 针对的值
	 * @param  $id    要获取的值的ID
	 * @return 		  返回对应的结果
	 * @author widuu <admin@widuu.com>
	 */

	static public function get_field($model,$value,$name,$id){
		//第一个字母改为大写
		$model = ucfirst($model);
		$action = "getFieldBy".ucfirst($name);
		return M($model)->{$action}($value,$id);
	}

	/**
	 * Model层getFieldByName的二次封装
	 * @param  $model 	   数据库模块的名称
	 * @param  $model_data 为Model指定对应的值
	 * @param  $action     操作方法(save|add)
	 * @param  $flag       标识符，true为D方法，false为M方法。
	 * @param  $re 		   是否返回错误信息，true为不返回，false为返回
	 * @return Bool|String 返回执行结果(true|false),或者返回错误信息String
	 * @author widuu <admin@widuu.com>
	 */

	static public function model_add($model,$model_data = array(),$action,$flag=false,$re = false){
		$model = ucfirst($model);
		if($flag){
			$model = D($model);
		}else{
			$model = M($model);
		}
		// 创建数据
		if($model->create()){
			// 如果数据不为空
			if(!empty($model_data)){
				foreach ($model_data as $key => $value) {
					$model->{$key} = $value;
				}
			}
			if($model->{$action}()){
				return true;
			}else{
				return false;
			}
		}else{
			if($re) return false;
			return $model->getError();
		}
	}

	/**
	 * 重写Model中的find方法
	 * @param $model 模型
	 * @param $pri   主键id
	 * @param $where 查询条件
	 * @param $field 查询字段
	 * @param $flag  标识符，true为D方法，false为M方法
	 * @author widuu <admin@widuu.com>
	 */

	static public function get_one($model,$pri,$where=array(),$field=array(),$flag=false){
		$model = ucfirst(strtolower($model));
		// 根据判断获取对应的模型
		if( $flag ){
			$find_model = D($model);
		}else{
			$find_model = M($model);
		}
		// 返回查询条件和字段限制
		if( count($where)!=0 && count($field)!=0 ){
			return $find_model->where($where)->field(implode(',', $field))->find($pri);
		}
		// 返回查询条件
		if( count($where)!=0 && count($field) == 0 ){
			return $find_model->where($where)->find($pri);
		}
		// 返回字段类型
		if( count($where)==0 && count($field) != 0 ){
			return $find_model->field(implode(',', $field))->find($pri);
		}
		// 返回主键类型
		return $find_model->find($pri);
	}

}