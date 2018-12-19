<?php
/**
 * 研究方向--控制器
 * author：yzs
 * create：2017.8.19
 */
namespace app\controller;

class ResearchArea extends Common{
    /**
     * 研究方向首页
     * @return \think\response\View
     */
    public function index(){
        $tagid = input('get.tagid');
        $con = [];
        if($tagid){
            $con['tagid'] = $tagid;
        }
        $list = D('ResearchArea')->getList($con);
        $tags = D('Tag')->getList(['section' => 1]);
        $banners = D('Banner')->getIndexList(5);
        return view('', ['list' => $list, 'tags' => $tags, 'banners' => $banners]);
    }
    /**
     * 研究方向介绍页
     */
    public function info(){
        $id = input('get.id');
        $info = D('ResearchArea')->getById($id);
        $recomms = D('ResearchArea')->getRecomms(['a.id' => ['<>', $id]]);
        $count = $info['count_view'];
        D('ResearchArea')->updateView($id, $count);
        return view('', ['info' => $info, 'recomms' => $recomms]);
    }

    /**
     * 微信研究方向首页
     */
    public function wxindex(){
        $tagid = input('get.tagid');
        $con = [];
        if($tagid){
            $con['tagid'] = $tagid;
        }
        $list = D('ResearchArea')->getList($con);
        $tags = D('Tag')->getList(['section' => 3]);
        return view('', ['list' => $list, 'tags' => $tags]);
    }
    /**
     * 微信研究方向介绍页
     */
    public function wxinfo(){
        $id = input('get.id');
        $info = D('ResearchArea')->getById($id);
        return view('', ['info' => $info]);
    }
}
?>