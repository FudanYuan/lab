<?php
/**
 * 最新动态模型
 * Author yzs
 * Create 2017.8.18
 */
namespace app\model;

use think\Model;

class News extends Model
{
    protected $table = 'lab_news';
    protected $pk = 'id';
    protected $fields = array(
        'id', 'title', 'author', 'tagid', 'href', 'digest', 'img', 'img_origin',
        'content', 'istop', 'ispublish', 'toptime', 'publishtime', 'regular_publishtime',
        'isrecommend', 'recommendtime', 'recomm_pos', 'recomm_begintime',
        'recomm_endtime', 'count_view', 'status', 'createtime', 'updatetime'
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
    const INDEX_KEY = CACHE_NAME;
    const INDEX_NEWS_KEY = 'news';

    /**
     * 动态列表
     * @param array $cond
     */
    public function getList($cond = [], $limit = -1)
    {
        $cond['a.status'] = 1;
        $cond['a.ispublish'] = 1;
        $res = $this->alias('a')->field(
            'a.id,a.title,b.title as tagname,a.digest,a.img,a.href,a.publishtime, a.isrecommend')
            ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
            ->where($cond)
            ->order('a.recommendtime desc, a.publishtime desc')
            ->paginate(12);
        if($limit != -1){
            $res = $this->alias('a')->field(
                'a.id,a.title,b.title as tagname,a.digest,a.img,a.href,a.publishtime, a.isrecommend')
                ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
                ->where($cond)
                ->order('a.publishtime desc, a.recommendtime desc')
                ->limit($limit)
                ->select();
        }
        return $res;
    }

    /**
     * 根据ID获取动态信息
     * @param unknown $id
     */
    public function getById($id)
    {
        $res = $this->alias('a')->field('a.id,a.title,a.author,a.content,a.count_view,
        b.title as tagname,a.publishtime')
            ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
            ->where(['a.id' => $id, 'a.status' => 1, 'a.ispublish' => 1])->find();
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
        $res = $this->alias('a')->field('a.id,a.title,b.title as tagname,a.img,a.digest')
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
        $res = json_decode(cache_hash_hget(self::INDEX_KEY, self::INDEX_NEWS_KEY), true);
        if (empty($res)) {
            $cond = [
                'a.status' => 1,
                'a.ispublish' => 1,
                'a.isrecommend' => 1,
            ];
            $res = $this->alias('a')->field('a.id,a.title,b.title as tagname,a.digest,a.img, a.publishtime')
                ->where($cond)
                ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
                ->order('a.recommendtime desc,a.recomm_pos,a.publishtime desc')
                ->limit(10)
                ->select();
            cache_hash_hset(self::INDEX_KEY, self::INDEX_NEWS_KEY, json_encode($res));
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