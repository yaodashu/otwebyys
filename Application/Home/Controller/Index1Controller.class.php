<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class Index1Controller extends HomeController {

	//系统首页
    public function index(){

//        $category = D('Category')->getTree();
//        $lists    = D('Document')->lists(null);
//
//        $this->assign('category',$category);//栏目
//        $this->assign('lists',$lists);//列表
//        $this->assign('page',D('Document')->page);//分页

	//查询装修案例
	$map['fengge']=500;  //现代简约风格
	$map['status']=array("gt",'-1');  //现代简约风格
	$lists_anli1=D("AnliView")->where($map)->order("level desc")->limit("12")->select();
        $this->assign('lists_anli1',$lists_anli1);//列表
	
	$map['fengge']=1000;  //新中式风格
	$lists_anli2=D("AnliView")->where($map)->order("level desc")->limit("12")->select();
        $this->assign('lists_anli2',$lists_anli2);//列表
	
	$map['fengge']=1500;  //欧式风格
	$lists_anli3=D("AnliView")->where($map)->order("level desc")->limit("12")->select();
        $this->assign('lists_anli3',$lists_anli3);//列表
	
	$map['fengge']=2000;  //美式风格
	$lists_anli4=D("AnliView")->where($map)->order("level desc")->limit("12")->select();
        $this->assign('lists_anli4',$lists_anli4);//列表
	
	
	$map['fengge']=array("not in",array("500","1000","1500","2000"));  //其它风格
	$lists_anli5=D("AnliView")->where($map)->order("level desc")->limit("12")->select();
        $this->assign('lists_anli5',$lists_anli5);//列表
	
	$map['fengge']=6000;  //实景案例
	$lists_anli6=D("AnliView")->where($map)->order("level desc")->limit("12")->select();
        $this->assign('lists_anli6',$lists_anli6);//列表
	
	//查询设计团队，分两次，先查询11个，再查询其余设计师 
	$maps['status']=1;
	$lists_shejishi1=D("ShejishiView")->where($maps)->order("level desc")->limit("0,11")->select();
	$lists_shejishi2=D("ShejishiView")->where($maps)->order("level desc")->limit("11,50")->select();
        $this->assign('lists_shejishi1',$lists_shejishi1);//列表
        $this->assign('lists_shejishi2',$lists_shejishi2);//列表
	
	//查询热装楼盘列表
	$mapl['status']='1';
	$mapl['ltype']='2';  //热装楼盘
	$lists_rzloupan1=D("LoupanView")->where($mapl)->order("level desc")->limit("0,12")->select(); 
	$str = "";
	foreach ($lists_rzloupan1 as $rk=>$rv){
	    $lists_rzloupan1[$rk]['anli_num']=0;
	    if($rv['dtitle']){
		$str = ($str)?($str."','".trim($rv['dtitle'])):trim($rv['dtitle']);
	    }
	}
	if($str){
	    $anlis = D()->query("select a.rzloupan,count(a.id) count from ot_document_anli a,ot_document d where d.id=a.id and d.status=1 and rzloupan in('".$str."') GROUP BY a.rzloupan ");
	    foreach ($anlis as $av){
		foreach ($lists_rzloupan1 as $rk=>$rv){ 
		    if(trim($av['rzloupan'])==trim($rv['dtitle'])){
			$lists_rzloupan1[$rk]['custnum']=$av['count']+$lists_rzloupan1[$rk]['custnum'];
		    }
		}
	    }
	}
	//
	
        $this->assign('lists_rzloupan1',$lists_rzloupan1);//列表
	
	
	//查询新闻
	$mapf['status']=1;
	$mapf['ftype']='4';
	$lists_news1=D("ArticleView")->where($mapf)->order("create_time desc,level")->limit("4")->select();
	//查询装修档案 
	$mapf['ftype']='5';
	$lists_news2=D("ArticleView")->where($mapf)->order("create_time desc,level")->limit("4")->select();
        $this->assign('lists_news1',$lists_news1);//列表
        $this->assign('lists_news2',$lists_news2);//列表
	
                 
        $this->display();
    }

}