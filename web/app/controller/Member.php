<?php 
/**
 * 团队成员--控制器
 * author：yzs
 * create：2017.8.19
 */
namespace app\controller;

class Member extends Common{
	/**
	 * 团队成员首页
	 * @return \think\response\View
	 */
	public function index(){
		$tagid = input('get.tagid');
		$con = [];
		if($tagid){
			$con['tagid'] = $tagid;
		}
		$list = D('Member')->getList($con);
        $cond = [];
        $cond['section'] = ['=', 3];
        $cond['title'] = ['<>', '实验室'];
		$tags = D('Tag')->getList($cond);
		$banners = D('Banner')->getIndexList(5);
		return view('', ['list' => $list, 'tags' => $tags, 'banners' => $banners]);
	}

    /**
     * 导师信息首页
     * @return \think\response\View
     */
    public function tutor(){
        $tagid = input('get.tagid');
        $con = [];
        if($tagid){
            $con['tagid'] = $tagid;
        }
        $list = D('Member')->getList($con);
        $cond = [];
        $cond['section'] = ['=', 3];
        $cond['title'] = ['=', '导师'];
        $tags = D('Tag')->getList($cond);
        $banners = D('Banner')->getIndexList(5);
        return view('', ['list' => $list, 'tags' => $tags, 'banners' => $banners]);
    }

    /**
     * 学生信息首页
     * @return \think\response\View
     */
    public function student(){
        $tagid = input('get.tagid');
        $con = [];
        if($tagid){
            $con['tagid'] = $tagid;
        }
        $list = D('Member')->getList($con);
        $cond = [];
        $cond['section'] = ['=', 3];
        $cond['title'] = ['not in', '实验室,导师'];
        $tags = D('Tag')->getList($cond);
        $banners = D('Banner')->getIndexList(5);
        return view('', ['list' => $list, 'tags' => $tags, 'banners' => $banners]);
    }

    /**
	 * 团队成员介绍页
	 */
	public function info(){
		$id = input('get.id');
		$info = D('Member')->getById($id);
		$recomms = D('Member')->getRecomms(['a.id' => ['<>', $id]]);
		return view('', ['info' => $info, 'recomms' => $recomms]);
	}

    /**
     * 联系我们页面
     */
    public function contact(){
        $info = D('Member')->getLabInfo();
        return view('', ['info' => $info]);
    }

	/**
	 * 微信团队成员首页
	 */
	public function wxindex(){
		$tagid = input('get.tagid');
		$con = [];
		if($tagid){
			$con['tagid'] = $tagid;
		}
		$list = D('Member')->getList($con);
		$tags = D('Tag')->getList(['section' => 3]);
		return view('', ['list' => $list, 'tags' => $tags]);
	}
	/**
	 * 微信团队成员介绍页
	 */
	public function wxinfo(){
		$id = input('get.id');
		$info = D('Member')->getById($id);
		return view('', ['info' => $info]);
	}
}
?>