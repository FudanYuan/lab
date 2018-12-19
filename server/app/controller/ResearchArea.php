<?php 
/**
 * 研究方向--控制器
 * author：yzs
 * create：2017.8.17
 */
namespace app\controller;

class ResearchArea extends Common{
	/**
	 * 研究方向列表
	 * @return \think\response\View
	 */
	public function index(){
		$params = input('get.');
		$tagid = input('get.tagid', -1);
		$title = input('get.title');
		$cond = [];
		if($tagid != -1){
			$cond['tagid'] = $tagid;
		}
		if($title){
			$cond['title'] = ['like', '%'.$title.'%'];
		}
		$tags = D('Tag')->getList(['section' => 1]);
		$list = D('ResearchArea')->getList($cond);
		return view('', ['list' => $list, 'tags' => $tags, 'cond' => $params]);
	}
	/**
	 * 批量删除
	 */
	public function remove(){
		$ret = ['code' => 1, 'msg' => '成功'];
		$ids = input('get.ids');
		try{
			$res = D('ResearchArea')->remove(['id' => ['in', $ids]]);
		}catch(MyException $e){
			$ret['code'] = 2;
			$ret['msg'] = '删除失败';
		}
		$this->jsonReturn($ret);
	}
	/**
	 * 新建
	 */
	public function create(){
		$data = input('post.');
		$tags = D('Tag')->getList(['section' => 1]);
		if(!empty($data)){
			$res = D('ResearchArea')->addData($data);
			if(!empty($res['errors']))
				return view('', ['errors' => $res['errors'], 'data' => $data, 'tags' => $tags]);
			else{
                $url = PRO_PATH . '/ResearchArea/index';
                return "<script>window.location.href='".$url."'</script>";
			}
		}else{
			return view('',['tags' => $tags]);
		}
	}
	/**
	 * 编辑
	 */
	public function edit(){
		$id = input('get.id');
		$data = input('post.');
		$tags = D('Tag')->getList(['section' => 1]);
		if(!empty($data)){
            $data['id'] = $id;
			$res = D('ResearchArea')->saveData($id, $data);
			if(!empty($res['errors']))
				return view('', ['errors' => $res['errors'], 'data' => $data, 'tags' => $tags]);
			else{
                $url = PRO_PATH . '/ResearchArea/index';
                return "<script>window.location.href='".$url."'</script>";
			}
		}else{
			$data = D('ResearchArea')->getById($id);
			return view('', ['errors' => [], 'data' => $data, 'tags' => $tags]);
		}
	}
	/**
	 * 发布
	 */
	public function dopublish(){
		$id = input('get.id');
		$res = D('ResearchArea')->saveData($id, ['ispublish' => 1]);
		$this->jsonReturn(['code' => 1, 'msg' => '成功']);
	}

    /**
     * 推荐
     * @return \think\response\View
     */
    public function dorecomm(){
        $ret = ['code' => 1, 'msg' => '成功', 'errors' => []];
        $data = input('post.');
        $res = D('ResearchArea')->doRecomm($data);
        if(!empty($res['errors'])){
            $ret['code'] = 2;
            $ret['msg'] = '失败';
            $ret['errors'] = $res['errors'];
        }
        $this->jsonReturn($ret);
    }
    /**
     * 取消推荐
     */
    public function cancelrecomm(){
        $ret = ['code' => 1, 'msg' => '成功'];
        $conid = input('get.conid');
        $res = D('ResearchArea')->cancelRecomm($conid);
        if($res === false){
            $ret['code'] = 2;
            $ret['msg'] = '取消推荐失败';
        }
        $this->jsonReturn($ret);
    }
}
?>