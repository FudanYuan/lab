<?php 
/**
 * 首页--控制器
 * author：yzs
 * create：2017.8.15
 */
namespace app\controller;

use think\Db;

class Index extends Common{
	/**
	 * 首页
	 * @return \think\response\View
	 */
	public function index(){
		return view('', []);
	}
	/**
	 * 清除缓存
	 */
	public function clearcache(){
		$ret = ['errorcode' => 0, 'msg' => '成功'];
		cache_del(CACHE_NAME);
		$this->jsonReturn($ret);
	}

    /**
     * 获取定时任务---命令（shell定时执行）
     */
    public function regularcommand(){
        $flag = false;
        //定时发布
        $publish = D('Sys')->getPublish();
        mydump($publish);
        if(!empty($publish)){
            foreach($publish as $v){
                $v = json_decode($v, true);
                $sec = $this->getSection($v['section']);
                D($sec)->saveData($v['conid'], ['ispublish' => 1]);
            }
            $flag = true;
        }
        //定时推荐开始
        $recomm = D('Sys')->getRecommend();
        mydump($recomm);
        if(!empty($recomm)){
            foreach($recomm as $v){
                $v = json_decode($v, true);
                $sec = $this->getSection($v['section']);
                D($sec)->saveData($v['conid'], ['recommendtime' => $v['time']]);
            }
            $flag = true;
        }
        //定时推荐结束
        $recommEnd = D('Sys')->getRecommendEnd();
        mydump($recommEnd);
        if(!empty($recommEnd)){
            foreach($recommEnd as $v){
                $v = json_decode($v, true);
                $sec = $this->getSection($v['section']);
                D($sec)->saveData($v['conid'], ['isrecommend' => 0]);
            }
            $flag = true;
        }
        //定时置顶
        $top = D('Sys')->getTop();
        mydump($top);
        if(!empty($top)){
            foreach($top as $v){
                $v = json_decode($v, true);
                D('Banner')->saveData($v['id'], ['status' => 1]);
            }
            $flag = true;
        }
        //定时置顶结束
        $topEnd = D('Sys')->getTopEnd();
        mydump($topEnd);
        if(!empty($topEnd)){
            foreach($topEnd as $v){
                $v = json_decode($v, true);
                D('Banner')->remove(['id' => $v['id']]);
            }
            $flag = true;
        }
        //清空缓存
        if($flag) cache_del('web_index');
    }

    private function getSection($secid){
		switch($secid){
            case 1: //研究方向
                $sec = 'ResearchArea';
                break;
            case 2: //科研成果
                $sec = 'Result';
                break;
            case 3: //团队成员
                $sec = 'Member';
                break;
            case 4: //最新动态
                $sec = 'News';
                break;
		}
		return $sec;
	}
}
?>