<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;

/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用分组名称
 */
class TestbaseController extends Controller {

	public $url_pc_online;
	public $url_mobile_online;
    
	/* 空操作，用于输出404页面 */
	public function _empty(){ 
		$this->redirect('Index/index');
	} 
	
	public function __construct() { 
	    echo "Testbase __construct out <br>";
	}
	public function _initialize() { 
	    echo "Testbase _initialize out <br>";
	} 
	
	public function addition($x,$y) { 
	  echo "addition <br>";
	  $GLOBALS['gz'] =$GLOBALS['gz']+ $x + $y; 
	  $GLOBALS['gz1'] = 2; 
	  global $gz2;
	  $gz2 = 2;
      } 

}
