<?php 
/**
 * 最新动态--控制器
 * author：yzs
 * create：2017.4.8
 */
namespace app\controller;

class News extends Common{
	/**
	 * 最新动态列表
	 * @return \think\response\View
	 */
	public function index(){
		$params = input('get.');
		$tagid = input('get.tagid', -1);
		$title = input('get.title');
		$author = input('get.author');
		$tags = D('Tag')->getList(['section' => 4]);
		$cond = [];
		if($tagid != -1){
			$cond['a.tagid'] = $tagid;
		}
		if($title){
			$cond['a.title'] = ['like', '%'.$title.'%'];
		}
		if($author){
			$cond['a.author'] = ['like', '%'.$author.'%'];
		}
		$list = D('News')->getList($cond);
		return view('', ['list' => $list, 'cond' => $params, 'tags' => $tags]);
	}
	/**
	 * 批量删除
	 */
	public function remove(){
		$ret = ['code' => 1, 'msg' => '成功'];
		$ids = input('get.ids');
		try{
			$res = D('News')->remove(['id' => ['in', $ids]]);
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
		$tags = D('Tag')->getList(['section' => 4]);
		if(!empty($data)){
			$res = D('News')->addData($data);
			if(!empty($res['errors']))
				return view('', ['errors' => $res['errors'], 'data' => $data, 'tags' => $tags]);
			else{
                $url = PRO_PATH . '/News/index';
                return "<script>window.location.href='".$url."'</script>";
			}
		}else{
			return view('', ['tags' => $tags]);
		}
	}
	/**
	 * 编辑
	 */
	public function edit(){
		$id = input('get.id');
		$data = input('post.');
		$tags = D('Tag')->getList(['section' => 4]);
		if(!empty($data)){
		    $data['id'] = $id;
			$res = D('News')->saveData($id, $data);
			if(!empty($res['errors']))
				return view('', ['errors' => $res['errors'], 'data' => $data, 'tags' => $tags]);
			else{
                $url = PRO_PATH . '/News/index';
                return "<script>window.location.href='".$url."'</script>";
			}
		}else{
			$data = D('News')->getById($id);
			return view('', ['errors' => [], 'data' => $data, 'tags' => $tags]);
		}
	}
	/**
	 * 发布
	 */
	public function dopublish(){
		$id = input('get.id');
		$res = D('News')->saveData($id, ['ispublish' => 1]);
		$this->jsonReturn(['code' => 1, 'msg' => '成功']);
	}

    /**
     * 推荐
     * @return \think\response\View
     */
    public function dorecomm(){
        $ret = ['code' => 1, 'msg' => '成功', 'errors' => []];
        $data = input('post.');
        $res = D('News')->doRecomm($data);
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
        $res = D('News')->cancelRecomm($conid);
        if($res === false){
            $ret['code'] = 2;
            $ret['msg'] = '取消推荐失败';
        }
        $this->jsonReturn($ret);
    }
}
?>