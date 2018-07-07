<?php

/**
 * Backstage user manager center 
 * @author    qyg
 * @version   0.1
 * @copyright Copyright (c) 2015 http://www.widuu.com
 * @date      2015/08/4
 */

namespace Manager\Controller;

class ChartController extends MainController{

	/**
	 * exhibtion list
	 * @author qyg
	 */

	public function hall(){
		$this->list = M('Hall')->select();
		$this->display();
	}

	/**
	 * add hall
	 * @author qyg
	 */

	public function add(){
		if( IS_GET ){
			$this->display();
		}

		if( IS_POST ){
			$model = M('Hall');
			if( $model->create() ){
				$model->update_time = time();
				$result = $model->add();
				if( $result ){
					$this->success('添加成功','manager/chart/hall');
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->error('创建数据失败');
			}
		}
	}

	/**
	 * edit hall
	 * @author qyg
	 */

	public function edit(){
		if( IS_GET ){
			$this->id   = $id = I('get.id');
			$this->news = M('Hall')->find($id);
			$this->display('add');
		}

		if( IS_POST ){
			$model = M('Hall');
			if( $model->create() ){
				$model->update_time = time();
				$result = $model->save();
				if( $result ){
					$this->success('修改成功','manager/chart/hall');
				}else{
					$this->error('修改失败');
				}
			}else{
				$this->error('创建数据失败');
			}
		}
	}

	/**
	 * booth display
	 * @author qyg
	 */

	public function booth(){
		//$where['hid'] = $id = I('get.id');
		$key = trim($_GET['key']);
        if($key == ""){
        $where['hid'] = $id = I('get.id');
        }
        else{
		$where="booth_num like '%$key%'";
        }
		$booth_model = M('Booth');
		$count= $booth_model->where($where)->count();
		$Page = new \Common\Util\Page($count,12);
		$show = $Page->show();
		//获取数据
		$list = $booth_model->where($where)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		//echo  $booth_model->getLastSql(); 
		$this->list = $list;
		$this->page = $show;
		$this->booth_title = M('Hall')->getFieldById($id,'hall_num');
		//$this->list = M('Booth')->where($where)->select();
		$this->display();
	}

	/**
	 * edit booth
	 * @author qyg
	 */

	public function edit_booth(){
		if( IS_GET ){
			$this->id   = $id = I('get.aid');
			$this->news = $booth =  M('Booth')->find($id);
			$this->hall = M('Hall')->field('id,hall_num')->select(); 
			$this->hid  = $booth['hid'];
			$this->hall_hid = $booth['hid'];
			$this->hall_area = get_hall_area($booth['hid']);
			$this->display('add_booth');
		}

		if( IS_POST ){
			$model = M('Booth');
			if( $model->create() ){
				$model->update_time = time();
				$result = $model->save();
				if( $result ){
					$this->success('修改成功');
				}else{
					$this->error('修改失败');
				}
			}else{
				$this->error('创建数据失败');
			}
		}
	}

	/**
	 * add booth stand
	 * @author qyg
	 */

	public function add_booth(){
		if( IS_GET ){
			$hall_id = I( 'get.id',0,'intval' );
			if( $hall_id == 0 ){
				$this->error('参数错误');
			}
			$this->hall_area = get_hall_area($hall_id);
			$this->hall = M('Hall') ->field('id,hall_num,area')->select();
			$this->hid  = $hall_id;
			$this->display();
		}

		if( IS_POST ){
			$model = M('Booth');	
			if( $model->create() ){
				$model->add_time = time();
				$model->add_user = get_uid(true);
				$result = $model->add();
				if($result){
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->error('创建数据失败');
			}
		}

	}

	/**
	 * Trade manager
	 * @author qyg
	 */

	public function trade(){
		$trade_model = M('Order');
		$count= $trade_model->count();
		$Page = new \Common\Util\Page($count,12);
		$show = $Page->show();
		//获取数据
		$list = $trade_model->where(array('status'=>4,'ad_type'=>1))->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->list = $list;
		$this->page = $show;
		//$this->list = M('Booth')->where($where)->select();
		$this->display();
	}

	/**
     * upload file and image
     * @author qyg
     */

	public function fileupload(){
		$config = array(    
			'maxSize'    =>    3145728,    
			'rootPath'   =>    BASE_PATH.'/upload/',    
			'saveName'   =>    array('uniqid',''),     
			'exts'       =>    array('jpg', 'gif', 'png', 'jpeg','   xls'),   
			'autoSub'    =>    true,    
			'subName'    =>    array('date','Ymd'),
		);

		$upload = new \Think\Upload($config);	
		$info   =   $upload->upload();
		if(!$info) {       
			$this->error($upload->getError());
		}else{
			$data['url'] = $info['upfile']['savepath'].$info['upfile']['savename'];
			$data['state'] = 'SUCCESS';
			echo json_encode($data);
			exit();
		}
	}

	/**
	 * 回执申请
	 * @author qyg
	 */

	public function apply(){
		$this->apply = M('Apply')->order('status asc ,id desc')->select();
		$this->display();
	}

	/**
	 * 操作回执
	 * @author qyg
	 */

	public function ashow(){
			$id = I('get.id',0,'intval');
		if( IS_GET ){
			if( $id == 0 ) $this->error('参数错误');
			$this->id      = $id;
			$this->invoice = M('Apply')->find($id);
			dump($this->invoice);
			$this->display();
		}else{
			$model = M('Apply');
			if( $model->create() ){
				if( $model->save() ){
					//改变订单中的合同申请状态
					$order_id = M('Apply')->where(array('id'=>$id))->field('order_id')->find();
					M('Order')->where(array('id'=>$order_id['order_id']))->save(array('contract'=>4));
					$this->success('审核通过','manager/chart/apply');
				}else{
					$this->error('审核失败');
				}
			}else{
					$this->error('审核失败');
			}
		}
	}

	/**
	 * 展位审核
	 * @author qyg
	 */

	public function examine(){
		$count= M('Reserve')->where(array('status'=>0))->count();
		$Page = new \Common\Util\Page($count,12);
		$show = $Page->show();
		//获取数据
		$list = M('Reserve')->where(array('status'=>0))->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->list = $list;
		$this->page = $show;
		$this->display();
	}

	/**
	 * 删除审核展位
	 * @author qyg
	 */

	public function del(){
		$id = I('get.id',0,'intval');
		if( $id == 0 ){
			$this->error('参数错误');
		}
		//删除操作
		if( M('Reserve')->delete($id) ){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}

	/**
	 * 更新标准展位状态
	 * 
	 * @author qyg
	 */

	public function update(){
		$id = I('get.id',0,'intval');
		if( $id == 0 ){
			$this->error('参数错误');
		}
		//删除操作
		if( M('Reserve')->where(array('id'=>$id))->save(array('status'=>1)) ){
			$this->success('审核成功');
		}else{
			$this->error('审核失败');
		}
	}
	
	/**
	 * 删除展位订单
	 * @author qyg
	 */

	public function trade_del(){
		$id = I('get.id',0,'intval');
		if( $id == 0 ){
			$this->error('参数错误');
		}
		
		$order_info = M('Order')->find($id);
		$where['id'] = $map['pid'] =  $order_info['bid'];
		$booth_num = M('Booth')->where($where)->save(array('status'=>1,'uid'=>'','time'=>''));
		/*
		if($order_info['type'] == 2){
			if($booth_num){
				$result = M('Order')->where($map)->delete();
			}
		}else{*/
			$result = M('Order')->delete($id);
		//}
		
		if($result){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
		/*
		//删除操作
		if( M('Reserve')->delete($id) ){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
		*/
	}
	
	/**
	 * 删除展位订单
	 * @author qyg
	 */

	public function update_trade(){
		$id = I('get.aid',0,'intval');
		$order_info = M('Order')->find($id);
		if( $id == 0 ){
			$this->error('参数错误');
		}
		if(IS_GET){
			
			$where['id'] = $map['pid'] =  $order_info['bid'];
			$booth_num = M('Booth')->field('id,booth_num,hid')->where($where)->find();
			$this->booth_num = $booth_num['booth_num'];
			$this->id = $booth_num['id'];
			$this->booth = M('Booth')->field('id,booth_num,hid')->where(array('status'=>1,'hid'=>$booth_num['hid']))->select();
			$this->display();
		}else{
			$new['id'] = $newid = I('post.newid','','intval');
			$old['id'] = $oldid = I('post.id','','intval');
			if( $order_info['type'] == 2 ){
				$pay = M('Pay')->where(array('pid'=>$oldid))->find();
				M('Pay')->where(array('id'=>$pay['id']))->save(array('pid'=>$newid));
				$result = M('Order')->where(array('id'=>$id))->save(array('bid'=>$newid));
				M('Booth')->where($new)->save(array('status'=>2,'uid'=>$pay['uid'],'time'=>time()));
				M('Booth')->where($old)->save(array('status'=>1,'uid'=>'','time'=>''));
				//$this->success('修改成功');
			}else{
				$result = M('Order')->where(array('id'=>$id))->save(array('bid'=>$newid));
				M('Booth')->where($new)->save(array('status'=>2,'time'=>time()));
				M('Booth')->where($old)->save(array('status'=>1,'uid'=>'','time'=>''));
			}
			$this->success('修改成功');
			
			//$booth_num = M('Booth')->where($where)->save(array('status'=>1,'uid'=>'','time'=>''));
			//$this->success($newid.'--'.$id);
		}
		
		
		
		
	}
}