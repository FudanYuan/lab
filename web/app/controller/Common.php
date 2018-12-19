<?php
/**
 * 通用集成模块
 * yzs
 * 2017.8.19
 */
namespace app\controller;

use think\Request;
use think\Controller;

class Common{
	protected function jsonReturn($data){
		header('Content-type: application/json');
		echo json_encode($data);exit;
	}
	protected function exceptionReturn($data){
		header('Content-type: application/json');
		echo json_encode($data);exit;
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
 }
?>