<?php
/**
 * 科研成果--控制器
 * author：yzs
 * create：2017.8.17
 */
namespace app\controller;

class Result extends Common
{
    /**
     * 科研成果列表
     * @return \think\response\View
     */
    public function index()
    {
        $params = input('get.');
        $tagid = input('get.tagid', -1);
        $research_id = input('get.research_id', -1);
        $title = input('get.title');
        $tags = D('Tag')->getList(['section' => 2]);
        $research = D('ResearchArea')->getList();
        $cond = [];
        if ($tagid != -1) {
            $cond['a.tagid'] = $tagid;
        }
        if ($research_id != -1) {
            $cond['a.research_id'] = $research_id;
        }
        if ($title) {
            $cond['a.title'] = ['like', '%' . $title . '%'];
        }
        $list = D('Result')->getList($cond);
        return view('', ['list' => $list, 'cond' => $params, 'tags' => $tags, 'research' => $research]);
    }

    /**
     * 新建
     */
    public function create()
    {
        $data = input('post.');
        $tags = D('Tag')->getList(['section' => 2]);
        $research = D('ResearchArea')->getList();
        if (!empty($data)) {
            $res = D('Result')->addData($data);
            if (!empty($res['errors']))
                return view('', ['errors' => $res['errors'], 'data' => $data, 'tags' => $tags, 'research' => $research]);
            else {
                $url = PRO_PATH . '/Result/index';
                return "<script>window.location.href='".$url."'</script>";
            }
        } else {
            return view('', ['tags' => $tags, 'research' => $research]);
        }
    }

    /**
     * 编辑
     */
    public function edit()
    {
        $id = input('get.id');
        $data = input('post.');
        $tags = D('Tag')->getList(['section' => 2]);
        $research = D('ResearchArea')->getList();
        if (!empty($data)) {
            $data['id'] = $id;
            $res = D('Result')->saveData($id, $data);
            if (!empty($res['errors'])){
                $data['id'] = $id;
                return view('', ['errors' => $res['errors'], 'data' => $data, 'tags' => $tags, 'research' => $research]);
            }
            else {
                $url = PRO_PATH . '/Result/index';
                return "<script>window.location.href='".$url."'</script>";
            }
        } else {
            $data = D('Result')->getById($id);
            return view('', ['errors' => [], 'data' => $data, 'tags' => $tags, 'research' => $research]);
        }
    }

    /**
     * 批量删除
     */
    public function remove()
    {
        $ret = ['code' => 1, 'msg' => '成功'];
        $ids = input('get.ids');
        try {
            $res = D('Result')->remove(['id' => ['in', $ids]]);
        } catch (MyException $e) {
            $ret['code'] = 2;
            $ret['msg'] = '删除失败';
        }
        $this->jsonReturn($ret);
    }

    /**
     * 发布
     */
    public function dopublish()
    {
        $id = input('get.id');
        $res = D('Result')->saveData($id, ['ispublish' => 1]);
        $this->jsonReturn(['code' => 1, 'msg' => '成功']);
    }

    /**
     * 推荐
     * @return \think\response\View
     */
    public function dorecomm(){
        $ret = ['code' => 1, 'msg' => '成功', 'errors' => []];
        $data = input('post.');
        $res = D('Result')->doRecomm($data);
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
        $res = D('Result')->cancelRecomm($conid);
        if($res === false){
            $ret['code'] = 2;
            $ret['msg'] = '取消推荐失败';
        }
        $this->jsonReturn($ret);
    }
}

?>