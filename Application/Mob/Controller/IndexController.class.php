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
class IndexController extends HomeController {

	//系统首页
    public function index(){

//        $category = D('Category')->getTree();
//        $lists    = D('Document')->lists(null);
//
//        $this->assign('category',$category);//栏目
//        $this->assign('lists',$lists);//列表
//        $this->assign('page',D('Document')->page);//分页
//        
	//查询案例	
	$_sql = "SELECT anli.*,f.ename fenggename,d.title dtitle,p.path picpath FROM ot_document_anli anli LEFT JOIN ot_sys_enum_fengge f on anli.fengge=f.evalue,ot_document d LEFT JOIN ot_picture p on d.cover_id=p.id 
		    WHERE anli.id=d.id and d.`status`>0 ORDER BY anli.mobilesort desc LIMIT 4";
	$lists_anli1 = M()->query($_sql);
        $this->assign('lists_anli1',$lists_anli1);//列表
	
	
	
	//查询设计团队，分两次，先查询11个，再查询其余设计师 
	$maps['status']=1;
	$maps['rank'] = array("in",array("500","1000"));
	$lists_shejishi1=D("ShejishiView")->where($maps)->order("rank,level desc")->limit("0,3")->select(); 
        $this->assign('lists_shejishi1',$lists_shejishi1);//列表 
	 
	
	//查询新闻
	$mapf['status']=1;
	$mapf['ftype']='4';
	$lists_news1=D("ArticleView")->where($mapf)->order("create_time desc,level")->limit("2")->select();
	//查询装修档案 
	$mapf['ftype']='5';
	$lists_news2=D("ArticleView")->where($mapf)->order("create_time desc,level")->limit("3")->select(); 
	
        $this->assign('lists_news1',$lists_news1);//列表
        $this->assign('lists_news2',$lists_news2);//列表
	
                 
        $this->display();
    }
    
    
    public function ajaxGetAnli(){  
	 	    
	//没种风格取一个案列
	$_sql = "SELECT anli.*,f.ename fenggename,d.title dtitle,p.path picpath FROM ot_document_anli anli LEFT JOIN ot_sys_enum_fengge f on anli.fengge=f.evalue,ot_document d LEFT JOIN ot_picture p on d.cover_id=p.id 
		    WHERE anli.id=d.id and d.`status`>0 ORDER BY anli.mobilesort desc LIMIT 4";
	$lists_anli1 = M()->query($_sql);
	//var_dump($lists_anli1);die;
	
	if($lists_anli1){ 	    
	    exit(json_encode(array("code"=>"1","msg"=>"ok","total"=>$count,"num"=> sizeof($lists_anli1),"data"=>$lists_anli1))); 
	}else{
	    exit(json_encode(array("code"=>"0","msg"=>"查询结果为空！","is_last"=>$is_last))); 
	} 
	exit(json_encode(array("code"=>"0","msg"=>"未知错误！","is_last"=>$is_last))); 
    }
    

}