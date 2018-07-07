<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */
namespace Manager\Controller;

class SystemController extends MainController{

	/**
	 * System setting
	 * @author qyg
	 */

	public function website(){
	    $configModel = M('Config');
	    //请求页面
	    if(IS_GET){
	      $config = $configModel->field('name,value')->select();
	      //转换显示值方式
	      $configInfo = array();
	      foreach ($config as $key => $value) {
	         $configInfo[$value['name']] = $value['value'];
	      }
	      //模版赋值
	      $this->webConfig = $configInfo;
	      //输出页面
	      $this->display();
	      return;
	    }

	    $this->save_config();
	}

	  /**
	   * 保存配置
	   * @author qyg
	   */

	  private function save_config($flag=false){
	      if(IS_POST){
	        //判断是否全部为空
	        if(empty(array_filter(I('post.')))) $this->error('配置不能为空');
	        //修改配置
	        foreach (I('post.') as $key => $value) {
	          $map = array( 'name'=> $key );
	          M('Config')->where($map)->setField('value',$value);
	        }
	        S('WECHAT_WEB_CONFIG',NULL);
	        //返回信息
	        $this->success('保存成功');
	        return;
	      }
	  }
}