<?php
/**
 * 置顶窗口（轮播图）模型
 * Author yzs
 * Create 2017.8.16
 */
namespace app\model;

use think\Model;
use think\Db;

class  Banner extends Model
{
    protected $table = 'lab_banner';
    protected $pk = 'id';
    protected $fields = array(
        'id', 'title', 'position', 'img', 'img_origin', 'section', 'conid', 'begintime', 'endtime', 'status',
        'createtime', 'updatetime'
    );
    protected $type = [
        'id' => 'integer',
        'position' => 'integer',
        'section' => 'integer',
        'conid' => 'integer',
        'status' => 'integer'
    ];
    private $strField = ['begintime', 'endtime'];

    /**
     * 轮播图列表
     * @param array $cond
     */
    public function getList($cond = [])
    {
        $cond['status'] = ['<>', 2];
        $res = $this->field('id,title,position,begintime,endtime,img')->where($cond)->paginate(10);
        return $res;
    }

    /**
     * 修改数据
     * @param integer $id
     * @param array $data
     * @return boolean
     */
    public function saveData($id, $data)
    {
        if (empty($data)) return false;
        $data['updatetime'] = $_SERVER['REQUEST_TIME'];
        return $this->save($data, ['id' => $id]);
    }

    /**
     * 创建数据
     * @param unknown $data
     * @return array $ret
     */
    public function addData($data)
    {
        $ret = [];
        $this->timeTostamp($data);
        $this->unsetOhterField($data);
        if (!empty($data)) {
            $errors = $this->filterField($data);
            $ret['errors'] = $errors;
            if (empty($errors)) {
                $check = $this->checkTime($data);
                if ($check) {
                    $flag = true;
                    Db::startTrans();
                    $this->addTitleToData($data);
                    $data['createtime'] = time();
                    $data['status'] = 1;
                    $res = $this->save($data);
                    if (!$res) $flag = false;
                    else {
                        D('Sys')->regularTop($this->id, $data['begintime']);
                        D('Sys')->regularTopEnd($this->id, $data['endtime']);
                    }
                    switch ($data['section']) {
                        case 1: //研究方向
                            $field = 'title';
                            $sec = 'ResearchArea';
                            break;
                        case 2: //科研成果
                            $field = 'title';
                            $sec = 'Result';
                            break;
                        case 3: //团队成员
                            $field = 'name';
                            $sec = 'Member';
                            break;
                        case 4: //最新动态
                            $field = 'title';
                            $sec = 'News';
                            break;
                    }
                    $res2 = D($sec)->saveData($data['conid'], ['istop' => 1, 'toptime' => $_SERVER['REQUEST_TIME'], 'updatetime' => $_SERVER['REQUEST_TIME']]);
                    if (!$res2) $flag = false;
                    if ($flag) {
                        Db::commit();
                    } else {
                        Db::rollback();
                        $ret['errors'] = ['all' => '置顶失败'];
                    }
                } else {
                    $ret['errors'] = ['all' => '该位置此时间段已有广告'];
                }
            }
        } else {
            $ret = ['errors' => ['all' => '数据不能为空']];
        }
        return $ret;
    }

    /**
     * 删除
     * @param array $cond
     * @return boolean $res
     * @throws
     */
    public function remove($cond = [])
    {
        $res = $this->save(['status' => 2], $cond);
        if ($res === false) throw new MyException('2', '删除失败');
        return $res;
    }

    /**
     * 添加标题
     * @param unknown $data
     */
    private function addTitleToData(&$data)
    {
        switch ($data['section']) {
            case 1: //研究方向
                $field = 'title';
                $sec = 'ResearchArea';
                break;
            case 2: //科研成果
                $field = 'title';
                $sec = 'Result';
                break;
            case 3: //团队成员
                $field = 'name';
                $sec = 'Member';
                break;
            case 4: //最新动态
                $field = 'title';
                $sec = 'News';
                break;
        }
        $res = D($sec)->getById($data['conid'], $field);
        $data['title'] = $res[$field];
    }

    /**
     * 检测插入的广告位置是否已有广告
     * @param unknown $data
     */
    private function checkTime($data)
    {
        $ret = true;
        $res = $this->field('begintime,endtime')->where(['status' => ['<>', 2], 'position' => $data['position']])->select();
        if (!empty($res)) {
            foreach ($res as $v) {
                if (($data['begintime'] >= $v['begintime'] && $data['begintime'] <= $v['endtime']) ||
                    ($data['endtime'] >= $v['begintime'] && $data['endtime'] <= $v['endtime'])
                ) {
                    $ret = false;
                    break;
                }
            }
        }
        return $ret;
    }



    /**
     * 过滤字段
     * @param unknown $data
     */
    private function filterField($data)
    {
        $errors = [];
        if (isset($data['position']) && !$data['position']) {
            $errors['position'] = '位置不能为空';
        }
        if (isset($data['img']) && !$data['img']) {
            $errors['img'] = '背景图不能为空';
        }
        if (isset($data['section']) && !$data['section']) {
            $errors['section'] = '板块不能为空';
        }
        if (isset($data['conid']) && !$data['conid']) {
            $errors['conid'] = '内容ID不能为空';
        }
        if (isset($data['begintime']) && !$data['begintime']) {
            $errors['begintime'] = '开始时间不能为空';
        }
        if (isset($data['endtime']) && !$data['endtime']) {
            $errors['endtime'] = '结束时间不能为空';
        }
        if (isset($data['begintime']) && $data['begintime'] && isset($data['endtime']) && $data['endtime']) {
            if ($data['begintime'] >= $data['endtime']){
                $errors['all'] = '时间区间不正确';
            }
        }
        return $errors;
    }

    /**
     * 清除非数据库字段
     * @param unknown $data
     */
    private function unsetOhterField(&$data)
    {
        foreach ($this->strField as $v) {
            $str = $v . '_str';
            if (isset($data[$str])) unset($data[$str]);
        }
    }

    /**
     * 将字符串时间转化成时间戳
     * @param unknown $data
     */
    private function timeTostamp(&$data)
    {
        isset($data['begintime_str']) && $data['begintime'] = $data['begintime_str'] ? strtotime($data['begintime_str']) : 0;
        isset($data['endtime_str']) && $data['endtime'] = $data['endtime_str'] ? strtotime($data['endtime_str']) : 0;
    }
}

?>