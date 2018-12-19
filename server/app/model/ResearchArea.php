<?php
/**
 * 研究方向模型
 * Author yzs
 * Create 2017.8.17
 */
namespace app\model;

use think\Model;

class ResearchArea extends Model
{
    protected $table = 'lab_research_area';
    protected $pk = 'id';
    protected $fields = array(
        'id', 'title', 'tagid', 'digest', 'img', 'img_origin', 'content', 'istop', 'ispublish',
        'toptime', 'publishtime', 'isrecommend', 'recommendtime', 'recomm_pos', 'recomm_begintime',
        'recomm_endtime', 'status', 'createtime', 'updatetime'
    );
    protected $type = [
        'id' => 'integer',
        'tagid' => 'integer',
        'iscurrent' => 'integer',
        'istop' => 'integer',
        'ispublish' => 'integer',
        'isrecommend' => 'integer',
        'recomm_pos' => 'integer',
        'status' => 'integer'
    ];

    /**
     * 研究方向列表
     * @param array $cond
     */
    public function getList($cond = [], $order = '')
    {
        if (!isset($cond['a.status'])) {
            $cond['a.status'] = ['<>', 2];
        }
        if (!$order) {
            $order = 'a.publishtime desc';
        }
        $res = $this->alias('a')->field(
            'a.id,a.title,a.tagid,b.title as tag_title,a.digest,
            a.img,a.publishtime,a.count_view,a.ispublish,a.isrecommend')
            ->join('lab_tag b', 'a.tagid=b.id')
            ->where($cond)
            ->order($order)
            ->paginate(10);
        return $res;
    }

    /**
     * 根据ID获取研究方向
     * @param unknown $id
     */
    public function getById($id, $field = '')
    {
        if (!$field)
            $field = 'id,title,tagid,digest,img,img_origin,content,count_view,
            ispublish,isrecommend';
        $res = $this->field($field)
            ->where(['id' => $id])
            ->find();
        return $res;
    }

    /**
     * 添加研究方向
     * @param unknown $data
     */
    public function addData($data)
    {
        $ret = [];
        $errors = $this->filterField($data);
        $ret['errors'] = $errors;
        if (empty($errors)) {
            $curTime = time();
            if (isset($data['ispublish']) && $data['ispublish'])
                $data['publishtime'] = $curTime;
            if (!isset($data['status']))
                $data['status'] = 1;
            $data['updatetime'] = $curTime;
            $data['createtime'] = time();
            $this->save($data);
        }
        return $ret;
    }

    /**
     * 更新内容
     * {@inheritDoc}
     * @see \think\Model::save()
     */
    public function saveData($id, $data = [])
    {
        $ret = [];
        $errors = $this->filterField($data);
        $ret['errors'] = $errors;
        if (empty($errors)) {
            $curTime = time();
            if (isset($data['ispublish']) && $data['ispublish'])
                $data['publishtime'] = $curTime;
            $data['updatetime'] = $curTime;
            $this->save($data, ['id' => $id]);
        }
        return $ret;
    }

    /**
     * 删除内容
     * @param array $cond
     */
    public function remove($cond = [])
    {
        $res = $this->save(['status' => 2], $cond);
        $data = $this->field('id,istop')->where($cond)->select();
        $ids = [];
        foreach ($data as $v) {
            if ($v['istop']) array_push($ids, $v['id']);
        }
        if (!empty($ids)) {
            D('Banner')->remove(['section' => 1, 'conid' => ['in', $ids]]);
        }
        if ($res === false) throw new MyException('2', '删除失败');
        return $res;
    }

    /**
     * 推荐
     */
    public function doRecomm($data)
    {
        $errors = [];
        $id = $data['conid'];
        unset($data['conid']);
        if (isset($data['recomm_begintime_str'])) {
            $data['recomm_begintime'] = $data['recomm_begintime_str'] ? strtotime($data['recomm_begintime_str']) : 0;
            unset($data['recomm_begintime_str']);
        }
        if (isset($data['recomm_endtime_str'])) {
            $data['recomm_endtime'] = $data['recomm_endtime_str'] ? strtotime($data['recomm_endtime_str']) : 0;
            unset($data['recomm_endtime_str']);
        }
        if (isset($data['recomm_pos']) && !$data['recomm_pos']) {
            $errors['recomm_pos'] = '请选择推荐位置';
        }
        if (isset($data['recomm_begintime']) && !$data['recomm_begintime']) {
            $errors['recomm_begintime'] = '开始时间不能为空';
        }
        if (isset($data['recomm_endtime']) && !$data['recomm_endtime']) {
            $errors['recomm_endtime'] = '结束时间不能为空';
        }
        if (isset($data['recomm_begintime']) && $data['recomm_begintime']
            && isset($data['recomm_endtime']) && $data['recomm_endtime']) {
            if ($data['recomm_begintime'] >= $data['recomm_endtime']){
                $errors['all'] = '时间区间不正确';
            }
        }
        $ret = ['errors' => $errors];
        if (empty($errors)) {
            $check = $this->checkTime($data);
            if ($check) {
                $data['isrecommend'] = 1;
                $data['recommendtime'] = $_SERVER['REQUEST_TIME'];
                $data['updatetime'] = $_SERVER['REQUEST_TIME'];
                $res = $this->save($data, ['id' => $id]);
                if ($res) {
                    D('Sys')->regularRecommend($id, 1, $data['recomm_begintime']);
                    D('Sys')->regularRecommendEnd($id, 1, $data['recomm_endtime']);
                }
            } else {
                $ret['errors'] = ['all' => '该位置此时间段已有推荐'];
            }
        }
        return $ret;
    }

    /**
     * 取消推荐
     * @param unknown $id
     */
    public function cancelRecomm($id)
    {
        return $this->save(['isrecommend' => 0], ['id' => $id]);
    }

    /**
     * 检测推荐位置是否已有推荐
     * @param unknown $data
     */
    private function checkTime($data)
    {
        $ret = true;
        $res = $this->field('recomm_begintime,recomm_endtime')->where(['status' => 1, 'isrecommend' => 1, 'recomm_pos' => $data['recomm_pos']])->select();
        if (!empty($res)) {
            foreach ($res as $v) {
                if (($data['recomm_begintime'] >= $v['recomm_begintime'] && $data['recomm_begintime'] <= $v['recomm_endtime']) ||
                    ($data['recomm_endtime'] >= $v['recomm_begintime'] && $data['recomm_endtime'] <= $v['recomm_endtime'])
                ) {
                    $ret = false;
                    break;
                }
            }
        }
        return $ret;
    }

    private function unsetOhterField(&$data)
    {
        foreach ($this->strField as $v) {
            $str = $v . '_str';
            if (isset($data[$str])) unset($data[$str]);
        }
    }

    private function filterField($data)
    {
        $errors = [];
        if (isset($data['title']) && !$data['title']) {
            $errors['title'] = '标题不能为空';
        }
        if (isset($data['tagid']) && !$data['tagid']) {
            $errors['tagid'] = '标签不能为空';
        }
        if (isset($data['img']) && !$data['img']) {
            $errors['img'] = '封面不能为空';
        }
        if (isset($data['digest']) && !$data['digest']) {
            $errors['digest'] = '摘要不能为空';
        }
        if (isset($data['content']) && !$data['content']) {
            $errors['content'] = '内容不能为空';
        }
        return $errors;
    }
}

?>