<?php
/**
 * 研究方向模型
 * Author yzs
 * Create 2017.8.18
 */
namespace app\model;

use think\Model;

class ResearchArea extends Model
{
    protected $table = 'lab_research_area';
    protected $pk = 'id';
    protected $fields = array(
        'id', 'title', 'tagid', 'digest', 'img', 'img_origin', 'content', 'istop', 'ispublish',
        'toptime', 'publishtime', 'isrecommend', 'recommendtime', 'recomm_pos',
        'recomm_begintime', 'recomm_endtime', 'status', 'createtime', 'updatetime'
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
    const INDEX_KEY = CACHE_NAME;
    const INDEX_RESEARCH_KEY = 'research_area';

    /**
     *研究方向列表
     * @param array $cond
     */
    public function getList($cond = [], $order='')
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
            ->paginate(12);
        return $res;
    }

    /**
     * 根据ID获取研究方向信息
     * @param unknown $id
     */
    public function getById($id)
    {
        $cond['a.id'] = $id;
        $cond['a.status'] = 1;
        $cond['a.ispublish'] = 1;
        $res = $this->alias('a')->field('a.id,a.title,b.title as tagname,
        a.img,a.digest,a.content,a.publishtime,a.count_view')
            ->where($cond)
            ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
            ->find();
        return $res;
    }

    /**
     * 获取推荐列表
     */
    public function getRecomms($cond = [])
    {
        $cond['a.status'] = 1;
        $cond['a.ispublish'] = 1;
        $cond['a.isrecommend'] = 1;
        $res = $this->alias('a')->field('a.id,a.title,b.title as tagname,
        a.img,a.digest,a.content,a.publishtime,a.count_view')
            ->where($cond)
            ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
            ->order('a.publishtime desc')
            ->limit(3)
            ->select();
        return $res;
    }

    /**
     * 首页推荐
     */
    public function getIndexRecomms()
    {
        $res = json_decode(cache_hash_hget(self::INDEX_KEY, self::INDEX_RESEARCH_KEY), true);
        if (empty($res)) {
            $cond = [
                'a.status' => 1,
                'a.ispublish' => 1,
                'a.isrecommend' => 1
            ];
            $res = $this->alias('a')->field('a.id,a.title,b.title as tagname,
            a.digest,a.img,a.publishtime,a.count_view')
                ->where($cond)->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
                ->order('a.recommendtime desc,a.recomm_pos,a.publishtime desc')
                ->limit(3)
                ->select();
            cache_hash_hset(self::INDEX_KEY, self::INDEX_RESEARCH_KEY, json_encode($res));
        }
        return $res;
    }

    /**
     * 更新阅读量
     * @param $id
     * @param $count
     * @return false|int
     */
    public function updateView($id, $count)
    {
        $data['count_view'] = $count+1;
        $res = $this->save($data, ['id' => $id]);
        return $res;
    }
}

?>