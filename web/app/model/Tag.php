<?php 
/**
 * 标签模型
 * Author yzs
 * Create 2017.8.18
 */
namespace app\model;

use think\Model;

class Tag extends Model{
 	protected $table = 'lab_tag';
 	protected $pk = 'id';
 	protected $fields = array(
        'id', 'title','section','status','createtime','updatetime'
 	);
 	protected $type = [
 			'id' => 'integer',
 			'status' => 'integer'
 		];
 	
 	/**
 	 * 获取标签列表
 	 * @param array $cond
 	 */
 	public function getList($cond = [], $index_tag = 0){
        if($index_tag){
            switch ($index_tag){
                case 1:
                    $cond['title'] = '论文发表';
                    break;
                case 2:
                    $cond['title'] = '荣誉奖励';
                    break;
                case 3:
                    $cond['title'] = '专利发明';
                    break;
            }

            $cond['status'] = 1;
            $res = $this->field('id,title')->where($cond)->select();
            return $res;

        }
 		$cond['status'] = 1;
 		$res = $this->field('id,title')->where($cond)->select();
 		return $res;
 	}
 	/**
 	 * 根据ID获取标签信息
 	 * @param unknown $id
 	 */
 	public function getById($id){
 		$res = $this->field('id,title,section')->where(['id' => $id])->find();
 		return $res;
 	}
 	/**
 	 * 更新标签
 	 * {@inheritDoc}
 	 * @see \think\Model::save()
 	 */
 	public function saveData($id, $data){
 		$ret = [];
 		$errors = $this->filterField($data);
 		$ret['errors'] = $errors;
 		if(empty($errors)){
			$data['updatetime'] = time();
 			$this->save($data, ['id' => $id]);
 		}
 		return $ret;
 	}
 	/**
 	 * 添加标签
 	 * @param unknown $data
 	 */
 	public function addData($data){
 		$ret = [];
 		$errors = $this->filterField($data);
 		$ret['errors'] = $errors;
 		if(empty($errors)){
			$data['createtime'] = time();
 			$this->save($data);
 		}
 		return $ret;
 	}
 	/**
 	 * 删除标签
 	 * @param array $cond
 	 */
 	public function remove($cond = []){
 		$res = $this->save(['status' => 2], $cond);
 		if($res === false) throw new MyException('2', '删除失败');
 		return $res;
 	}
 	/**
 	 * 获取板块列表
 	 */
 	public function getSections(){
 		return [
            1 => ['title' => '研究方向'],
            2 => ['title' => '科研成果'],
            3 => ['title' => '团队成员'],
            4 => ['title' => '最新动态'],
 		];
 	}
 	private function filterField($data){
 		$errors = [];
 		if(isset($data['title']) && !$data['title']){
 			$errors['title'] = '标题不能为空';
 		}
 		return $errors;
 	}
 	
 }
?>