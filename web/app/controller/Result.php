<?php 
/**
 * 科研成果--控制器
 * author：yzs
 * create：2017.8.18
 */
namespace app\controller;

class Result extends Common{
	/**
	 * 科研成果首页
	 * @return \think\response\View
	 */
	public function index(){
		$tagid = input('get.tagid');
        $index_tagid = input('get.index_tagid');
        $index_research_id = input('get.research_id');
        $con = [];
        $tag_name = '';
		if($tagid){
			$con['a.tagid'] = $tagid;
            $tag_select = D('Tag')->getById($tagid);
            $tag_name = $tag_select['title'];
		}
		$list = D('Result')->getList($con, $index_tagid);
        $tags = D('Tag')->getList(['section' => 2], $index_tagid);
        $research = D('ResearchArea')->getList();
        $banners = D('Banner')->getIndexList(5);
		return view('', ['list' => $list, 'tags' => $tags, 'tag_name' => $tag_name, 'research' => $research, 'banners' => $banners]);
	}
	/**
	 * 科研成果详情页
	 */
	public function info(){
		$id = input('get.id');
		$info = D('Result')->getById($id);
        $recomms = D('Result')->getRecomms(['a.id' => ['<>', $id]]);
		return view('', ['info' => $info, 'recomms' => $recomms]);
	}

	/**
     * 更新访问量
     */
	public function updateView(){
	    $data = input('post.');
        $id = input('post.id', -1);
        $info = D('Result')->getById($id);
        $count = $info['count_view'];
        D('Result')->updateView($id, $count);
    }
}
?>