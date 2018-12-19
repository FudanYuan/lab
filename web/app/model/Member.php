<?php
/**
 * 团队成员模型
 * Author yzs
 * Create 2017.8.19
 */
namespace app\model;

use think\Model;

class Member extends Model
{
    protected $table = 'lab_member';
    protected $pk = 'id';
    protected $fields = array(
        'id', 'tagid', 'name', 'tutor', 'phone', 'email', 'address', 'url', 'research_area',
        'position', 'img', 'img_origin', 'bgimg', 'bgimg_origin', 'digest', 'descr',
        'iscurrent', 'istop', 'ispublish', 'toptime', 'publishtime',
        'isrecommend', 'recommendtime', 'recomm_pos', 'recomm_begintime',
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
    const INDEX_KEY = CACHE_NAME;
    const INDEX_MEMBER_KEY = 'member';
    const INDEX_LAB_KEY = 'lab';
    const INDEX_MEMBER_VIEW_KEY = 'lab_count_view';
    const INDEX_LAB_VIEW_KEY = 'lab_count_view';
    /**
     * 团队成员列表
     * @param array $cond
     */
    public function getList($cond = [])
    {
        $cond2 = [];
        if (isset($cond['tagid']) && !empty($cond['tagid'])) {
            $cond2['a.tagid'] = $cond['tagid'];
        }
        $cond2['a.status'] = 1;
        $cond2['a.ispublish'] = 1;
        $cond2['b.title'] = ['<>', '实验室'];
        $res = $this->alias('a')->field('a.id,a.name,a.tutor,a.position,a.img,a.digest,a.url,a.research_area,a.tagid, a.iscurrent')
            ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
            ->where($cond2)
            ->order('publishtime desc')
            ->select();
        return $res;
    }

    /**
     * 根据ID获取团队成员信息
     * @param unknown $id
     */
    public function getById($id)
    {
        $res = $this->alias('a')->field('a.id,a.name,a.tutor,a.phone,a.email,a.address,a.url,
        a.research_area,a.position,b.title as tagname,a.bgimg,a.digest,a.descr')
            ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
            ->where(['a.id' => $id])
            ->find();
        return $res;
    }

    /**
     * 获取推荐列表
     * @param array $cond
     * @return mixed
     */
    public function getRecomms($cond = [])
    {
        $cond['a.status'] = 1;
        $cond['a.ispublish'] = 1;
        $cond['a.isrecommend'] = 1;
        $cond['b.title'] = ['<>', '实验室'];
        $res = $this->alias('a')->field('a.id,a.name,a.tutor,a.img,a.digest,a.url,a.research_area')
            ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
            ->where($cond)
            ->order('a.publishtime desc')
            ->select();
        return $res;
    }

    /**
     * 首页推荐
     */
    public function getIndexRecomms()
    {
        $res = json_decode(cache_hash_hget(self::INDEX_KEY, self::INDEX_MEMBER_KEY), true);
        if (empty($res)) {
            $cond = [
                'a.status' => 1,
                'a.ispublish' => 1,
                'a.isrecommend' => 1,
                'b.title' => ['<>', '实验室']
            ];
            $res = $this->alias('a')->field('a.id,a.name,a.tutor,a.phone,a.email,a.address,
                                 a.position,b.title as tagname,a.img,a.digest,a.descr,a.url,a.research_area')
                ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
                ->where($cond)
                ->order('a.recommendtime desc,a.recomm_pos,a.publishtime desc')
                ->limit(8)
                ->select();
            cache_hash_hset(self::INDEX_KEY, self::INDEX_MEMBER_KEY, json_encode($res));
        }
        return $res;
    }

    /**
     * 获取实验室信息
     */
    public function getLabInfo()
    {
        $res = json_decode(cache_hash_hget(self::INDEX_KEY, self::INDEX_LAB_KEY), true);
        if (empty($res)) {
            $cond = [
                'a.status' => 1,
                'a.ispublish' => 1,
                'b.title' => ['=', '实验室']
            ];
            $res = $this->alias('a')->field('a.id,a.name,b.title as tagname,
                       a.phone,a.email,a.address,a.img,a.digest,a.descr,a.research_area')
                ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
                ->where($cond)
                ->find();
            cache_hash_hset(self::INDEX_KEY, self::INDEX_LAB_KEY, json_encode($res));
        }
        return $res;
    }
}

?>