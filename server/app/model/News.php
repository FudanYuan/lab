<?php
/**
 * 最新动态模型
 * Author yzs
 * Create 2017.8.17
 */

namespace app\model;

use think\Model;

class News extends Model
{
    protected $table = 'lab_news';
    protected $pk = 'id';
    protected $fields = array(
        'id', 'title', 'author', 'tagid', 'href', 'digest', 'img', 'img_origin', 'content', 'istop', 'ispublish',
        'toptime', 'publishtime', 'regular_publishtime', 'count_view', 'isrecommend', 'recommendtime', 'recomm_pos', 'recomm_begintime',
        'recomm_endtime', 'status', 'createtime', 'updatetime'
    );
    protected $type = [
        'id' => 'integer',
        'tagid' => 'integer',
        'istop' => 'integer',
        'ispublish' => 'integer',
        'isrecommend' => 'integer',
        'recomm_pos' => 'integer',
        'status' => 'integer'
    ];
    private $strField = ['regular_publishtime'];

    /**
     * 动态列表
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
            'a.id,a.title,a.tagid,b.title as tag_title,a.author,a.digest,a.img,
 			a.publishtime,a.count_view,a.ispublish,a.isrecommend')
            ->join('lab_tag b', 'a.tagid=b.id')
            ->where($cond)
            ->order($order)
            ->paginate(10);
        return $res;
    }

    /**
     * 根据ID获取动态信息
     * @param unknown $id
     */
    public function getById($id)
    {
        $res = $this->field('id,title,tagid,img,img_origin,author,
 		ispublish,isrecommend,digest,content,href,regular_publishtime')
            ->where(['id' => $id])->find();
        if ($res['regular_publishtime']) {
            $res['regular_publishtime_str'] = date('Y-m-d H:i',
                $res['regular_publishtime']);
        }
        return $res;
    }

    /**
     * 添加动态
     * @param $data
     * @return array
     */
    public function addData($data)
    {
        $ret = [];
        $this->timeTostamp($data);
        $this->unsetOhterField($data);
        $errors = $this->filterField($data);
        $ret['errors'] = $errors;
        $flag = false;
        if (empty($errors)) {
            $curTime = time();
            if (isset($data['ispublish']) && $data['ispublish']) {
                if (isset($data['regular_publishtime']) && $data['regular_publishtime']) {
                    $flag = true;
                    $data['ispublish'] = 0;
                } else {
                    $data['publishtime'] = $curTime;
                }
            }
            if (!isset($data['status']))
                $data['status'] = 1;
            $data['createtime'] = $curTime;
            $res = $this->save($data);
            if ($res && $flag) {
                D('Sys')->regularPublish($this->id, 4, $data['regular_publishtime']);
            }
        }
        return $ret;
    }

    /**
     * 更新动态
     * {@inheritDoc}
     * @see \think\Model::save()
     */
    public function saveData($id, $data)
    {
        $ret = [];
        $this->timeTostamp($data);
        $this->unsetOhterField($data);
        $errors = $this->filterField($data);
        $ret['errors'] = $errors;
        $flag = false;
        if (empty($errors)) {
            $curTime = time();
            if (isset($data['ispublish']) && $data['ispublish']) {
                if (isset($data['regular_publishtime']) && $data['regular_publishtime']) {
                    $flag = true;
                    $data['ispublish'] = 0;
                } else {
                    $data['publishtime'] = $curTime;
                }
            }
            $data['updatetime'] = $curTime;
            $res = $this->save($data, ['id' => $id]);
            if ($res && $flag) {
                D('Sys')->regularPublish($id, 4, $data['regular_publishtime']);
            }
        }
        return $ret;
    }

    /**
     * 删除动态
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
            D('Banner')->remove(['section' => 4, 'conid' => ['in', $ids]]);
        }
        if ($res === false) throw new MyException('2', '删除失败');
        return $res;
    }

    /**
     * 推荐
     */
    public function doRecomm($data){
        $errors = [];
        $id = $data['conid'];
        unset($data['conid']);
        if(isset($data['recomm_begintime_str'])){
            $data['recomm_begintime'] = $data['recomm_begintime_str'] ? strtotime($data['recomm_begintime_str']) : 0;
            unset($data['recomm_begintime_str']);
        }
        if(isset($data['recomm_endtime_str'])){
            $data['recomm_endtime'] = $data['recomm_endtime_str'] ? strtotime($data['recomm_endtime_str']) : 0;
            unset($data['recomm_endtime_str']);
        }
        if(isset($data['recomm_pos']) && !$data['recomm_pos']){
            $errors['recomm_pos'] = '请选择推荐位置';
        }
        if(isset($data['recomm_begintime']) && !$data['recomm_begintime']){
            $errors['recomm_begintime'] = '开始时间不能为空';
        }
        if(isset($data['recomm_endtime']) && !$data['recomm_endtime']){
            $errors['recomm_endtime'] = '结束时间不能为空';
        }
        if (isset($data['recomm_begintime']) && $data['recomm_begintime']
            && isset($data['recomm_endtime']) && $data['recomm_endtime']) {
            if ($data['recomm_begintime'] >= $data['recomm_endtime']){
                $errors['all'] = '时间区间不正确';
            }
        }
        $ret = ['errors' => $errors];
        if(empty($errors)){
            $check = $this->checkTime($data);
            if($check){
                $data['isrecommend'] = 1;
                $data['recommendtime'] = $_SERVER['REQUEST_TIME'];
                $data['updatetime'] = $_SERVER['REQUEST_TIME'];
                $res = $this->save($data, ['id' => $id]);
                if($res){
                    D('Sys')->regularRecommend($id, 4, $data['recomm_begintime']);
                    D('Sys')->regularRecommendEnd($id, 4, $data['recomm_endtime']);
                }
            }else{
                $ret['errors'] = ['all' => '该位置此时间段已有推荐'];
            }
        }
        return $ret;
    }
    /**
     * 取消推荐
     * @param unknown $id
     */
    public function cancelRecomm($id){
        return $this->save(['isrecommend' => 0], ['id' => $id]);
    }
    /**
     * 检测推荐位置是否已有推荐
     * @param unknown $data
     */
    private function checkTime($data){
        $ret = true;
        $res = $this->field('recomm_begintime,recomm_endtime')->where(['status' => 1,'isrecommend' => 1, 'recomm_pos' => $data['recomm_pos']])->select();
        if(!empty($res)){
            foreach($res as $v){
                if(($data['recomm_begintime'] >= $v['recomm_begintime'] && $data['recomm_begintime'] <= $v['recomm_endtime']) ||
                    ($data['recomm_endtime'] >= $v['recomm_begintime'] && $data['recomm_endtime'] <= $v['recomm_endtime']) ){
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

    private function timeTostamp(&$data)
    {
        isset($data['regular_publishtime_str']) && $data['regular_publishtime'] = $data['regular_publishtime_str'] ?
            strtotime($data['regular_publishtime_str']) : 0;
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
        if (isset($data['author']) && !$data['author']) {
            $errors['author'] = '作者不能为空';
        }
        if (isset($data['digest']) && !$data['digest']) {
            $errors['digest'] = '摘要不能为空';
        }
        if (isset($data['img']) && !$data['img']) {
            $errors['img'] = '封面不能为空';
        }
        if (isset($data['content']) && !$data['content']) {
            $errors['content'] = '内容不能为空';
        }
        /*if(isset($data['href']) && !$data['href']){
            $errors['href'] = '外链链接不能为空';
        }
        if(isset($data['regular_publishtime']) && !$data['regular_publishtime']){
            $errors['regular_publishtime'] = '定时发布时间不能为空';
        }*/
        return $errors;
    }
}

?>