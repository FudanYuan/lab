<?php
/**
 * 科研成果模型
 * Author yzs
 * Create 2017.8.16
 */
namespace app\model;

use think\Model;
use think\Db;

class Result extends Model
{
    protected $table = 'lab_result';
    protected $pk = 'id';
    protected $fields = array(
        'id', 'title', 'tagid', 'research_id', 'href', 'digest', 'img', 'img_origin', 'file',
        'file_origin', 'content', 'istop', 'ispublish', 'toptime', 'publishtime',
        'count_view', 'isrecommend', 'recommendtime', 'recomm_pos', 'recomm_begintime',
        'recomm_endtime', 'status', 'createtime', 'updatetime'
    );
    protected $type = [
        'id' => 'integer',
        'tagid' => 'integer',
        'research_id' => 'integer',
        'count_view' => 'integer',
        'istop' => 'integer',
        'ispublish' => 'integer',
        'iscurrent' => 'integer',
        'isrecommend' => 'integer',
        'recomm_pos' => 'integer',
        'status' => 'integer'
    ];

    /**
     * 获取科研成果列表
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
            'a.id,a.title,a.tagid,a.research_id, a.research_id,c.title as research_title,b.title as tag_title,a.digest,a.img,
            a.publishtime,a.href,a.count_view,a.ispublish,a.isrecommend')
            ->join('lab_tag b', 'a.tagid=b.id')
            ->join('lab_research_area c', 'c.id=a.research_id')
            ->where($cond)
            ->order($order)
            ->paginate(10);
        return $res;
    }

    /**
     * 根据Id获取成果
     * @param unknown $id
     */
    public function getById($id)
    {
        $res = $this->alias('a')->field('a.id,a.title,a.tagid,a.research_id, c.title as research_title,
        a.href,a.digest,a.img,a.img_origin,a.file,a.file_origin,a.content,a.ispublish,a.isrecommend,a.digest')
            ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
            ->join('lab_research_area c', 'c.id=a.research_id', 'LEFT')
            ->where(['a.id' => $id])
            ->find();
        return $res;
    }

    /**
     * 添加成果
     * @param $data
     * @return array
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
            $data['createtime'] = $curTime;
            $this->save($data);
        }
        return $ret;
    }

    /**
     * 更新成果
     * {@inheritDoc}
     * @see \think\Model::save()
     */
    public function saveData($id, $data)
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
            D('Banner')->remove(['section' => 2, 'conid' => ['in', $ids]]);
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
                    D('Sys')->regularRecommend($id, 2, $data['recomm_begintime']);
                    D('Sys')->regularRecommendEnd($id, 2, $data['recomm_endtime']);
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

    private function unsetOhterField(&$data){
        foreach($this->strField as $v){
            $str = $v.'_str';
            if(isset($data[$str]))unset($data[$str]);
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
        if (isset($data['author']) && !$data['author']) {
            $errors['author'] = '作者不能为空';
        }
        if (isset($data['digest']) && !$data['digest']) {
            $errors['digest'] = '摘要不能为空';
        }
        if (isset($data['img']) && !$data['img']) {
            $errors['img'] = '封面不能为空';
        }
        if (isset($data['file']) && !$data['file']) {
            $errors['file'] = '文件不能为空';
        }
//        if (isset($data['content']) && !$data['content']) {
//            $errors['content'] = '内容不能为空';
//        }
        /*if(isset($data['href']) && !$data['href']){
            $errors['href'] = '外链链接不能为空';
        }*/
        return $errors;
    }
}

?>