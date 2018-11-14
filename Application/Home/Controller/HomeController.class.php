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
class HomeController extends Controller {
	public $html_path_pc;
	public $html_path_mob;

	public $url_pc_online;
	public $url_mobile_online;
    
	/* 空操作，用于输出404页面 */
	public function _empty(){
		$this->redirect('Index/index');
	}


    protected function _initialize(){
	
	//是否需要强制登录
	if(C('HOME_NEED_LOGIN')==1){
	    // 检查用户cookie,如果存在登录信息则自动登录
	    D('User/Member')->need_login();

	    // 只有登录状态才能访问本页,验证登录.
	    $this->login();
	    $current_user = session('user_auth');
	    $this->assign("current_user",session('user_auth'));
	}
	
        /* 读取站点配置 */
        $config = api('Config/lists');
        C($config); //添加配置
	
//	$this->url_pc_online =C('WEBSITE_URL_PC_ONLINE');
//	$this->url_mobile_online=C('WEBSITE_URL_MOBILE');
	
	$this->assign('url_pc_online',C('WEBSITE_URL_PC_ONLINE'));// 
	$this->assign('url_mobile_online',C('WEBSITE_URL_MOBILE'));// 

        if(!C('WEB_SITE_CLOSE')){
            $this->error('站点已经关闭，请稍后访问~');
        }
	if(C('HTML_PATH_ON')==1){    
	    $html_path = trim(C('HTML_PATH'),".");
	    $html_path = empty($html_path)?"/":$html_path;//静态根目录
	    $this->html_path_pc = $html_path."home/";
	    $this->html_path_mob = $html_path."mob/";
	    if(C('PC_MOBILE_SPLIT')==1){ 
		$this->html_path_pc = $html_path."";
		$this->html_path_mob = $html_path."";
	    }
	}else{
	    $html_path="";
	    $this->html_path_pc = $html_path."/index.php/home/";
	    $this->html_path_mob = $html_path."/index.php/mob/";
	}
	$this->assign("html_path_pc",$this->html_path_pc);
	$this->assign("html_path_mob",$this->html_path_mob);
    }

	/* 用户登录检测 */
	protected function login(){
		/* 用户登录检测 */
		is_login() || $this->error('您还没有登录，请先登录！', U('Member/User/login'));
	}
	
	/* 用户登录检测 */
	protected function is_login(){
		/* 用户登录检测 */
		is_login() || $this->error('您还没有登录，请先登录！', U('User/login'));
	}

}
