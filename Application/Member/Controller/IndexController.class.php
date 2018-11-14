<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: Zero Li <35714820@qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Member\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends MemberController {
    /**
     * 会员中心首页
     */
    public function index(){
        // 只有登录状态才能访问本页,验证登录.
        $this->is_login();
        // 调用用户API获取当前登录用户信息
        $current_user = callApi('User/getProfile');
//	var_dump($current_user);die;
	if(empty($current_user['uid'])){
	    $this->error('您还没有登录，请先登录！', U('User/login'));
	}else if(empty($current_user['nickname'])){
	    $this->error('请重新登录！', U('User/login'));
	}
	if($current_user['area']){
	    $area=M("sys_enum_area")->where("evalue=".$current_user['area'])->find();
	    $current_user['areaname'] = $area['ename'];
	    $current_user['provincename'] = $area['provincename'];
	    $current_user['cityname'] = $area['cityname'];
	}
	if($current_user['area']){
	    $rank=M("sys_enum_rank")->where("evalue=".$current_user['rank'])->find();
	    $current_user['rankname'] = $rank['ename'];
	}
	//var_dump($current_user);die;
        $this->assign('current_user', $current_user); 
	
        $this->display();
    }
}