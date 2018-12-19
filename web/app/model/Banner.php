<?php
/**
 * 置顶窗口（轮播图）模型
 * Author yzs
 * Create 2017.8.18
 */
namespace app\model;

use think\Model;

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
    const INDEX_KEY = CACHE_NAME;
    const INDEX_BANNER_KEY = 'banner';

    /**
     * 轮播图列表
     * @param array $cond
     */
    public function getList($cond = [], $pageSize = 10)
    {
        $cond['status'] = 1;
        $res = $this->field('id,title,img,section')
            ->order('position')
            ->where($cond)
            ->paginate($pageSize);
        return $res;
    }

    /**
     * 首页轮播图
     * @param int $pageSize
     * @return mixed
     */
    public function getIndexList($pageSize = 10)
    {
        $res = json_decode(cache_hash_hget(self::INDEX_KEY, self::INDEX_BANNER_KEY), true);
        if (empty($res)) {
            $cond['status'] = 1;
            $res = $this->field('id,title,img,section,conid')
                ->order('position')
                ->where($cond)
                ->limit($pageSize)
                ->select();
            foreach ($res as $v) {
                switch ($v['section']) {
                    case 1:// 研究方向
                        $v['url'] = PRO_PATH . '/ResearchArea/info';
                        break;
                    case 2:// 科研成果
                        $v['url'] = PRO_PATH . '/Result/info';
                        break;
                    case 3:// 团队成员
                        $v['url'] = PRO_PATH . '/Member/info';
                        break;
                    case 4:// 最新动态
                        $v['url'] = PRO_PATH . '/News/info';
                        break;
                    case 5:// 联系我们
                        $v['url'] = PRO_PATH . '/Member/contact';
                        break;
                }
            }
            cache_hash_hset(self::INDEX_KEY, self::INDEX_BANNER_KEY, json_encode($res));
        }
        return $res;
    }
}

?>