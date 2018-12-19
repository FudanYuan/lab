<?php 
/**
 * 置顶窗口（轮播图）--控制器
 * author：yzs
 * create：2017.8.18
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
}
?>