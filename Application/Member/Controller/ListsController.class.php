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
class ListsController extends MemberController {
     public $pageSize; 
     public $current_user;
     protected function _initialize(){
	$this->pageSize=50;
        // 只有登录状态才能访问本页,验证登录.
        $this->is_login();
        // 调用用户API获取当前登录用户信息
        $current_user = callApi('User/getProfile');
	if($current_user['memberlist']!=1){
	    $this->error('您没有权限！', U('Index/index'));
	}
	$this->current_user = $current_user;
        $this->assign('current_user', $current_user); 
        $this->assign('menuname', "lists"); 
    }
    /**
     * 会员中心列表
     */
    public function index(){
	$keyword = $_REQUEST['keyword'];
	//cp936就是指系统里第936号编码格式，也就是GB2312。EUC-CN EUC-CN是GB2312最常用的表示方法。浏览器编码表上的“GB2312”，通常都是指“EUC-CN”表示法。
	//过程中本地笔记本是cp936不需要转码能正常显示
	$encode = mb_detect_encoding($keyword, array('ASCII','GB2312','GBK','UTF-8')); 
	if(in_array(strtoupper($encode), array('CP936','GB2312','EUC-CN'))){	    
	}else{
	    $keyword = iconv('GB2312', 'UTF-8', $keyword);
	}
//	echo $encode;
	
	$this->assign('keyword',$keyword);//
	 //页码
	$pindex = max(1, intval($_REQUEST['page']));
	$psize  = $this->pageSize;
	$start = ($pindex-1)*$psize; 
	
	$map=' id>1 '; 	 
	if($keyword){   
	    $map.=" and (username like '%{$keyword}%' or mobile like '%{$keyword}%' )";    
	} 
	$count=M("ucenter_member")->where($map)->count();	
	$page =new \Think\Pagedz($count,$this->pageSize);
	$start = $page->firstRow;
	$psize = $page->listRows; 
	 
	//地区信息
	$areas = M("sys_enum_area")->where("id>0")->order("disorder")->select(); 
	foreach ($areas as $k1=>$v1){
	    $areas_array[$v1['evalue']]=$v1;
	}
	//门店信息
	$ranks = M("sys_enum_rank")->where("id>0")->order("disorder")->select(); 
	foreach ($ranks as $k1=>$v1){
	    $ranks_array[$v1['evalue']]=$v1;
	}
	//用户组
	$groups = M("right_group")->where("id>0")->select(); 
	foreach ($groups as $k1=>$v1){
	    $groups_array[$v1['id']]=$v1;
	}
	
	
	$lists_data1=M("ucenter_member")->where($map)->order("status desc,rightgroupid desc,id desc")->limit($start.",".$psize)->select(); 
	foreach ($lists_data1 as $k=>$v){
	    $lists_data1[$k]['areaname']=$areas_array[$v['area']]['provincename']."/".$areas_array[$v['area']]['cityname']."/".$areas_array[$v['area']]['ename'];
	    $lists_data1[$k]['rankname']=$ranks_array[$v['rank']]['ename'];
	    $lists_data1[$k]['groupname']=$groups_array[$v['rightgroupid']]['groupname'];
	}
	
        $this->assign('lists',$lists_data1);//列表
        $this->assign('lists_count',$count);//列表
		
	$this->assign('keyword',$keyword);//
	//
	//设置分页主题，如果没有这个设置，页面上不会显示有多少个记录
	$page->setConfig('theme', '%HOMEPAGE% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %GOPAGE%');
	//将分页显示到前端
	$str_page = $page->show();
	$this->assign("_page",$str_page); 
	
        $this->display();
    }
    
    public function detail(){
	$id = $_REQUEST['id'];
	if (IS_POST) { //提交验证
	    if(empty($id)){
	      $this->error('请重新选择会员，如果还出现错误，请退出登录后清除浏览器缓存重新进入！');
	    } 
	    //查询会员信息
	    $ucentermember=M("ucenter_member")->where(array("id"=>$id))->find();   
	    if(empty($ucentermember)){
		$this->error('请重新选择会员！');
	    }
	    $datas['status'] = $_REQUEST['status'];
	    $datas['editlevel'] = $_REQUEST['editlevel']; 
	    $datas['remark'] =$this->current_user['username']."于". date("Y-m-d", time())."时间修改，修改前status：{$ucentermember['status']}，editlevel：{$ucentermember['editlevel']}". "。".$ucentermember['remark']; 
	    $datas['remark'] = substr( $datas['remark'], 0, 800);
	    
	    $boo = M("ucenter_member")->where(array("id"=>$id))->save($datas);
	    
	    $this->success('操作成功！', U('Member/Lists/index'));
	  die;
	  $this->success('操作成功！', U('Member/Lists/index'));
	  $this->error($error);
	}
	
	if(empty($id)){
	    $this->redirect('Lists/index');
	}
	//查询会员信息
	$ucentermember=M("ucenter_member")->where(array("id"=>$id))->find();   
	
	//地区信息
	$areas = M("sys_enum_area")->where("id>0")->order("disorder")->select(); 
	foreach ($areas as $k1=>$v1){
	    $areas_array[$v1['evalue']]=$v1;
	}
	//门店信息
	$ranks = M("sys_enum_rank")->where("id>0")->order("disorder")->select(); 
	foreach ($ranks as $k1=>$v1){
	    $ranks_array[$v1['evalue']]=$v1;
	}
	//用户组
	$groups = M("right_group")->where("id>0")->select(); 
	foreach ($groups as $k1=>$v1){
	    $groups_array[$v1['id']]=$v1;
	}
	$ucentermember['areaname']=$areas_array[$ucentermember['area']]['provincename']."/".$areas_array[$ucentermember['area']]['cityname']."/".$areas_array[$ucentermember['area']]['ename'];
	$ucentermember['rankname']=$ranks_array[$ucentermember['rank']]['ename'];
	$ucentermember['groupname']=$groups_array[$ucentermember['rightgroupid']]['groupname'];
	
	$this->assign("id",$id);
	$this->assign("ucentermember",$ucentermember);
	
        $this->display();
    }
}