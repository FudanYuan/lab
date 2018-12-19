<?php 
/**
 * 最新动态--控制器
 * author：yzs
 * create：2017.8.18
 */
namespace app\controller;

class News extends Common{
	/**
	 * 最新动态首页
	 * @return \think\response\View
	 */
	public function index(){
		$tagid = input('get.tagid');
		$con = [];
		if($tagid){
			$con['a.tagid'] = $tagid;
		}
		$list = D('News')->getList($con);
		$tags = D('Tag')->getList(['section' => 4]);
		$banners = D('Banner')->getIndexList(10);
		return view('', ['list' => $list, 'tags' => $tags, 'banners' => $banners]);
	}
	/**
	 * 最新动态详情页
	 */
	public function info(){
		$id = input('get.id');
		$info = D('News')->getById($id);
        $recomms = D('News')->getRecomms(['a.id' => ['<>', $id]]);
        $count = $info['count_view'];
        D('News')->updateView($id, $count);
		return view('', ['info' => $info, 'recomms' => $recomms]);
	}
}
?>