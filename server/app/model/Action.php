<?php 
/**
 * 操作模型
 * Author yzs
 * Create 2017.8.18
 */
namespace app\model;

use think\Model;
use think\Db;

class Action extends Model{
 	protected $table = 'lab_action_admin';
 	protected $pk = 'id';
 	protected $fields = array(
 		'id', 'name','tag','pid','pids','level','status','createtime','updatetime'
 	);
 	protected $type = [
 			'id' => 'integer',
 			'pid' => 'integer',
 			'level' => 'integer',
 			'status' => 'integer'
 		];
 	const ROLE_ACTIONS = 'admin_role_actions';
 	
 	/**
 	 * 获取格式化后的操作列表
 	 */
 	public function getActions(){
 		$data = [];
 		$actions = $this->field('id,name,tag,pid,pids,level')
            ->where('status', 1)
            ->select();
 		/*$level2 = [];
 		$level3 = [];
 		$level4 = [];
 		foreach($actions as $v){
 			switch($v['level']){
 				case 1:
 					$data[$v['id']] = ['name' => $v['name'], 'pid' => $v['pid']];
 					break;
 				case 2:
 					array_push($level2, $v);
 					break;
 				case 3:
 					array_push($level3, $v);
 					break;
 				case 4:
 					array_push($level4, $v);
 					break;
 			}
 		}
 		foreach($level2 as $v){
 			$data[$v['pid']]['children'][$v['id']] = ['name' => $v['name'], 'pid' => $v['pid']];
 		}
 		foreach($level3 as $v){
 			$pids = explode('-', $v['pids']);
 			$data[$pids[0]]['children'][$pids[1]]['children'][$v['id']] = ['name' => $v['name'], 'pid' => $v['pid']];
 		}
 		foreach($level4 as $v){
 			$pids = explode('-', $v['pids']);
 			$data[$pids[0]]['children'][$pids[1]]['children'][$pids[2]]['children'][$v['id']] = ['name' => $v['name'], 'pid' => $v['pid']];
 		}
 		return $data;*/
 		return $actions;
 	}
 }
?>