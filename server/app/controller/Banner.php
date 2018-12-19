<?php 
/**
 * 置顶窗口（轮播图）--控制器
 * author：yzs
 * create：2017.8.15
 */
namespace app\controller;

class Banner extends Common{
	/**
	 * 置顶窗口列表
	 */
	public function index(){
		$params = input('get.');
		$position = input('get.position', -1);
		$title = input('get.title');
		$cond = [];
		if($position != -1){
			$cond['position'] = $position;
		}
		if($title){
			$cond['title'] = ['like', '%'.$title.'%'];
		}
		$list = D('Banner')->getList($cond);
		return view('', ['cond' => $params, 'list' => $list]);
	}
	/**
	 * 置顶操作
	 */
	public function dotop(){
		$ret = ['code' => 1, 'msg' => '成功', 'errors' => []];
		$data = input('post.');
		$res = D('Banner')->addData($data);
		if(!empty($res['errors'])){
			$ret['code'] = 2;
			$ret['msg'] = '失败';
			$ret['errors'] = $res['errors'];
		}
		$this->jsonReturn($ret);
	}
	/**
	 * 取消置顶
	 */
	public function canceltop(){
		$ret = ['code' => 1, 'msg' => '成功'];
		$ids = input('get.ids');
		try{
			$res = D('Banner')->remove(['id' => ['in', $ids]]);
		}catch(MyException $e){
			$ret['code'] = 2;
			$ret['msg'] = '取消置顶失败';
		}
		$this->jsonReturn($ret);
	}
}
?>