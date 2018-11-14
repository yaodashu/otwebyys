<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Mob\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class OtherController extends HomeController {
    public $pageSize; 
    protected function _initialize() {
	parent::_initialize();
	$this->pageSize=6;
    }

    //系统搜索首页
    public function search(){ 
    
	$kwtype = $_REQUEST['kwtype']; 
	$_REQUEST['keyword'] =trim($_REQUEST['keyword']);
	$keyword = empty($_REQUEST['keyword'])?"我的小窝":$_REQUEST['keyword']; 
	$qtype = $_REQUEST['qtype']?$_REQUEST['qtype']:""; 
	 
	 //页码
	$pindex = max(1, intval($_REQUEST['page']));
	$psize  = $this->pageSize;
	$start = ($pindex-1)*$psize;
     
	
	//查询,需要从内容表中查询，查询字段：document表name/title/description，分为几个类：案例、文章（新闻、档案）、工地、热装楼盘、设计师
	
	
	$where = " document.status = 1"; 
	if($keyword){
	   $where .=" and (document.title like '%{$keyword}%' or document.title like '%{$keyword}%' or document.description like '%{$keyword}%') ";
	} 
	if($qtype){
	    switch ($qtype){
		case "1":
		     $where .=" and document_anli.id>0 ";
		    break;
		case "2":
		     $where .=" and document_shejishi.id>0 ";
		    break;
		case "3":
		     $where .=" and document_loupan.id>0 ";
		    break;
		case "4":
		     $where .=" and document_article.id>0 ";
		    break;
		case "5":
		     $where .=" and document_gongdi.id>0 ";
		    break;		
	    }
	    
	}
	
	$count=D("DocumentView")->where($where)->count();
	$page =new \Think\Page($count,$this->pageSize);
	$start = $page->firstRow;
	$psize = $page->listRows; 
	
	$lists_data1=D("DocumentView")->where($where)->order("level desc")->limit($start.",".$psize)->select(); 
	foreach ($lists_data1 as $k=>$v){
	    $lists_data1[$k]['dt'] =  date('Y-m-d',$v['create_time']);
	    $lists_data1[$k]['dloupan']= (intval($v['dloupan'])>0)?intval($v['dloupan']):0;
	    $lists_data1[$k]['danli']= (intval($v['danli'])>0)?intval($v['danli']):0;
	    $lists_data1[$k]['dgongdi']= (intval($v['dgongdi'])>0)?intval($v['dgongdi']):0;
	    $lists_data1[$k]['dshejishi']= (intval($v['dshejishi'])>0)?intval($v['dshejishi']):0;
	    $lists_data1[$k]['darticle']= (intval($v['darticle'])>0)?intval($v['darticle']):0;
	    $lists_data1[$k]['ftype']= (intval($v['ftype'])>0)?intval($v['ftype']):0;
	}
//	var_dump($lists_data1);
	
        $this->assign('lists_data1',$lists_data1);//列表
        $this->assign('lists_count',$count);//列表	
	
//	/热门案例
	$anli_view=D("AnliView")->where(array("status"=>1))->order("level desc")->find(); 
	$this->assign('anli_view',$anli_view);//  	
	
	//设计师
	$shejishi_view = D("ShejishiView")->where(array("status"=>1))->order("level desc")->limit("2")->select();
	$this->assign('shejishi_view',$shejishi_view);//  	
	  
	$this->assign('kwtype',$kwtype);//  
	$this->assign('keyword',$keyword);//  
	$this->assign('qtype',$qtype);//                   
	//设置分页主题，如果没有这个设置，页面上不会显示有多少个记录
	$page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
	//将分页显示到前端
	$str_page = $page->show();
	$this->assign("_page",$str_page); 
	
        $this->display();
    } 
    
    public function ajaxGetData(){  
	$kwtype = $_REQUEST['kwtype']; 
	$keyword = $_REQUEST['keyword']; 
	$qtype = $_REQUEST['qtype']; 
	
	$pindex = max(1, intval($_REQUEST['page']));
	$psize  = $this->pageSize;
	$start = ($pindex-1)*$psize;
	 
	$map['status']='1';
	if($keyword){
	    $map['rank']=$keyword;
	}
	
	
	$where = " status = 1"; 
	if($keyword){
	   $where .=" and (document.title like '%{$keyword}%' or document.title like '%{$keyword}%' or document.description like '%{$keyword}%') ";
	} 
	if($qtype){
	    switch ($qtype){
		case "1":
		     $where .=" and document_anli.id>0 ";
		    break;
		case "2":
		     $where .=" and document_shejishi.id>0 ";
		    break;
		case "3":
		     $where .=" and document_loupan.id>0 ";
		    break;
		case "4":
		     $where .=" and document_article.id>0 ";
		    break;
		case "5":
		     $where .=" and document_gongdi.id>0 ";
		    break;		
	    }
	    
	}
	
	$lists_data1=D("DocumentView")->where($where)->order("level desc")->limit($start.",".$psize)->select(); 
	$count=D("DocumentView")->where($where)->count();
	foreach ($lists_data1 as $k=>$v){
	    $lists_data1[$k]['dt'] =  date('Y-m-d',$v['create_time']);
	    $lists_data1[$k]['dloupan']= (intval($v['dloupan'])>0)?intval($v['dloupan']):0;
	    $lists_data1[$k]['danli']= (intval($v['danli'])>0)?intval($v['danli']):0;
	    $lists_data1[$k]['dgongdi']= (intval($v['dgongdi'])>0)?intval($v['dgongdi']):0;
	    $lists_data1[$k]['dshejishi']= (intval($v['dshejishi'])>0)?intval($v['dshejishi']):0;
	    $lists_data1[$k]['darticle']= (intval($v['darticle'])>0)?intval($v['darticle']):0;
	    $lists_data1[$k]['ftype']= (intval($v['ftype'])>0)?intval($v['ftype']):0;
	}
	
	//检查是否最后一页
	if($start+$psize>=$count){
	    $is_last = "1";
	}else{
	    $is_last = "0";
	}
	
	if($lists_data1){ 	    
	    exit(json_encode(array("code"=>"0","msg"=>"ok","is_last"=>$is_last,"total"=>$count,"num"=> sizeof($lists_data1),"data"=>$lists_data1))); 
	}else{
	    exit(json_encode(array("code"=>"10001","msg"=>"查询结果为空！","is_last"=>$is_last))); 
	} 
	exit(json_encode(array("code"=>"10002","msg"=>"未知错误！","is_last"=>$is_last))); 
    }

}