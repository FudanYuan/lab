<?php
/**
 * 团队成员--控制器
 * author：yzs
 * create：2017.8.17
 */
namespace app\controller;

class Member extends Common
{
    /**
     * 在校人员列表
     * @return \think\response\View
     */
    public function curmember()
    {
        $params = input('get.');
        $tagid = input('get.tagid', -1);
        $name = input('get.name');
        $tags = D('Tag')->getList(['section' => 3]);
        $cond = [];
        if ($tagid != -1) {
            $cond['a.tagid'] = $tagid;
        }
        if ($name) {
            $cond['a.name'] = ['like', '%' . $name . '%'];
        }
        $cond['iscurrent'] = 1;
        $list = D('Member')->getList($cond);
        return view('', ['list' => $list, 'cond' => $params, 'tags' => $tags]);
    }

    /**
     * 在校人员创建
     */
    public function cur_create()
    {
        $data = input('post.');
        $tags = D('Tag')->getList(['section' => 3]);
        if (!empty($data)) {
            $res = D('Member')->addData($data);
            if (!empty($res['errors'])) {
                return view('', ['errors' => $res['errors'], 'data' => $data, 'tags' => $tags]);
            } else {
                $url = PRO_PATH . '/Member/curmember';
                return "<script>window.location.href='" . $url . "'</script>";
            }
        } else {
            return view('', ['tags' => $tags]);
        }
    }

    /**
     * 编辑
     */
    public function cur_edit()
    {
        $id = input('get.id');
        $data = input('post.');
        $tags = D('Tag')->getList(['section' => 3]);
        if (!empty($data)) {
            $data['id'] = $id;
            $res = D('Member')->saveData($id, $data);
            if (!empty($res['errors'])) {
                return view('', ['errors' => $res['errors'], 'data' => $data, 'tags' => $tags]);
            } else {
                $url = PRO_PATH . '/Member/curmember';
                return "<script>window.location.href='" . $url . "'</script>";
            }
        } else {
            $data = D('Member')->getById($id);
            return view('', ['errors' => [], 'data' => $data, 'tags' => $tags]);
        }
    }


    /**
     * 校友列表
     * @return \think\response\View
     */
    public function lastmember()
    {
        $params = input('get.');
        $tagid = input('get.tagid', -1);
        $name = input('get.name');
        $tags = D('Tag')->getList(['section' => 3]);
        $cond = [];
        if ($tagid != -1) {
            $cond['a.tagid'] = $tagid;
        }
        if ($name) {
            $cond['a.name'] = ['like', '%' . $name . '%'];
        }
        $cond['iscurrent'] = 0;
        $list = D('Member')->getList($cond);
        return view('', ['list' => $list, 'cond' => $params, 'tags' => $tags]);
    }

    /**
     * 校友创建
     */
    public function last_create()
    {
        $data = input('post.');
        //mydump($data);exit;
        $tags = D('Tag')->getList(['section' => 3]);
        if (!empty($data)) {
            $res = D('Member')->addData($data);
            if (!empty($res['errors'])) {
                return view('', ['errors' => $res['errors'], 'data' => $data, 'tags' => $tags]);
            } else {
                $url = PRO_PATH . '/Member/lastmember';
                return "<script>window.location.href='" . $url . "'</script>";
            }
        } else {
            return view('', ['tags' => $tags]);
        }
    }

    /**
     * 校友编辑
     */
    public function last_edit()
    {
        $id = input('get.id');
        $data = input('post.');
        $tags = D('Tag')->getList(['section' => 3]);
        if (!empty($data)) {
            $data['id'] = $id;
            $res = D('Member')->saveData($id, $data);
            if (!empty($res['errors']))
                return view('', ['errors' => $res['errors'], 'data' => $data, 'tags' => $tags]);
            else {
                $url = PRO_PATH . '/Member/lastmember';
                return "<script>window.location.href='" . $url . "'</script>";
            }
        } else {
            $data = D('Member')->getById($id);
            return view('', ['errors' => [], 'data' => $data, 'tags' => $tags]);
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
            $res = D('Member')->remove(['id' => ['in', $ids]]);
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
        $res = D('Member')->saveData($id, ['ispublish' => 1]);
        $this->jsonReturn(['code' => 1, 'msg' => '成功']);
    }

    /**
     * 推荐
     * @return \think\response\View
     */
    public function dorecomm(){
        $ret = ['code' => 1, 'msg' => '成功', 'errors' => []];
        $data = input('post.');
        $res = D('Member')->doRecomm($data);
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
        $res = D('Member')->cancelRecomm($conid);
        if($res === false){
            $ret['code'] = 2;
            $ret['msg'] = '取消推荐失败';
        }
        $this->jsonReturn($ret);
    }
}
?>