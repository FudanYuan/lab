<?php
/**
 * 科研结果模型
 * Author yzs
 * Create 2017.8.18
 */
namespace app\model;

use think\Model;

class Result extends Model
{
    protected $table = 'lab_result';
    protected $pk = 'id';
    protected $fields = array(
        'id', 'title', 'tagid', 'research_id','href', 'digest', 'img', 'img_origin', 'file', 'file_origin',
        'content', 'istop', 'ispublish','toptime', 'publishtime', 'count_view', 'status',
        'createtime', 'updatetime'
    );
    protected $type = [
        'id' => 'integer',
        'tagid' => 'integer',
        'research_id' => 'integer',
        'istop' => 'integer',
        'ispublish' => 'integer',
        'isrecommend' => 'integer',
        'recomm_pos' => 'integer',
        'status' => 'integer'
    ];
    const INDEX_KEY = CACHE_NAME;
    const INDEX_RESULT_KEY = 'result';
    const INDEX_PAPER_KEY = 'paper';
    const INDEX_HONOR_KEY = 'honor';
    const INDEX_PATENT_KEY = 'patent';

    /**
     * 科研成果列表
     * @param array $cond
     */
    public function getList($cond = [], $index_tag = 0)
    {
        if($index_tag){
            switch ($index_tag){
                case 1:
                    $cond['b.title'] = '论文发表';
                    break;
                case 2:
                    $cond['b.title'] = '荣誉奖励';
                    break;
                case 3:
                    $cond['b.title'] = '专利发明';
                    break;
            }
        }
        $cond['a.status'] = 1;
        $cond['a.ispublish'] = 1;
        $res = $this->alias('a')->field(
            'a.id,a.title,b.title as tagname,a.research_id, c.title as research_title,a.digest,a.img,a.href,a.file')
            ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
            ->join('lab_research_area c', 'c.id=a.research_id', 'LEFT')
            ->where($cond)
            ->order('a.publishtime desc')
            ->paginate(100);
        return $res;
    }

    /**
     * 根据ID获取科研成果信息
     * @param unknown $id
     */
    public function getById($id)
    {
        $cond = [
            'a.id' => $id,
            'a.status' => 1,
            'a.ispublish' => 1
        ];
        $res = $this->alias('a')->field('a.id,a.title,a.content,a.count_view,
        b.title as tagname, a.research_id, c.title as research_title,a.publishtime')
            ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
            ->join('lab_research_area c', 'c.id=a.research_id', 'LEFT')
            ->where($cond)
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
        $res = $this->alias('a')->field('a.id,a.title,b.title as tagname,a.research_id, c.title as research_title,a.img,a.digest')
            ->where($cond)
            ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
            ->join('lab_research_area c', 'c.id=a.research_id', 'LEFT')
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
        $res = json_decode(cache_hash_hget(self::INDEX_KEY, self::INDEX_RESULT_KEY), true);
        if (empty($res)) {
            $cond = [
                'a.status' => 1,
                'a.ispublish' => 1,
                'a.isrecommend' => 1,
            ];
            $res = $this->alias('a')->field('a.id,a.title,b.title as tagname,a.research_id, c.title as research_title,a.digest,a.img')
                ->where($cond)
                ->join('lab_tag b', 'a.tagid=b.id', 'LEFT')
                ->join('lab_research_area c', 'c.id=a.research_id', 'LEFT')
                ->order('a.recommendtime desc,a.recomm_pos,a.publishtime desc')
                ->limit(6)
                ->select();
            cache_hash_hset(self::INDEX_KEY, self::INDEX_RESULT_KEY, json_encode($res));
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