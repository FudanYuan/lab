<?php 
/**
 * 首页--控制器
 * author：yzs
 * create：2017.8.18
 */
namespace app\controller;

use think\Db;

class Index extends Common{
	/**
	 * 首页
	 * @return \think\response\View
	 */
	public function index(){
		$banners = D('Banner')->getIndexList(5);
		$news = D('News')->getList([],8);
        $researchs = D('ResearchArea')->getIndexRecomms();
        $introduce = D('Member')->getLabInfo();
		return view('', [
		    'introduce'=> $introduce,
            'banners' => $banners,
            'news' => $news,
            'researchs' => $researchs
		]);
	}
	public function wxindex(){
		return view('', []);
	}

    /**
     * 清除缓存,测试用
     */
    public function clearcache(){
        $ret = ['errorcode' => 0, 'msg' => '成功'];
        cache_del('web_index');
        cache_del('banner');
        cache_del('research_area');
        cache_del('member');
        cache_del('lab');
        cache_del('news');
        $this->jsonReturn($ret);
    }

}
?>