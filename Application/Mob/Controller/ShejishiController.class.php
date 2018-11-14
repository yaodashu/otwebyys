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
class ShejishiController extends HomeController {
    public $pageSize; 
    protected function _initialize() {
	parent::_initialize();
	$this->pageSize=12;
    }

    //系统案例首页
    public function index(){ 
    
	$rank = $_REQUEST['rank'];  
	$keyword = $_REQUEST['keyword'];
	//cp936就是指系统里第936号编码格式，也就是GB2312。EUC-CN EUC-CN是GB2312最常用的表示方法。浏览器编码表上的“GB2312”，通常都是指“EUC-CN”表示法。
	//过程中本地笔记本是cp936不需要转码能正常显示
	$encode = mb_detect_encoding($keyword, array('ASCII','GB2312','GBK','UTF-8')); 
	if(in_array(strtoupper($encode), array('CP936','GB2312','EUC-CN'))){	    
	}else{
	    $keyword = iconv('GB2312', 'UTF-8', $keyword);
	}
//	echo $encode;
	 
	 //页码
	$pindex = max(1, intval($_REQUEST['page']));
	$psize  = $this->pageSize;
	$start = ($pindex-1)*$psize;
     
	
	//查询装修案例 
	 $map['status']='1';
	if($rank){
	    $map['rank']=$rank;
	}
	
	//查询前先更新一个设计师的预约人数，取时间最小的10个记录，再取随机数，修改对应的次数
	$lists_rzloupan1=D("ShejishiView")->where("document.status =1 and document_shejishi.lastupdatenum+86400>=". time())->order("lastupdatenum")->find(); 
	if(empty($lists_rzloupan1)){
	    $lists_rzloupan1=D("ShejishiView")->where("document.status =1 and document_shejishi.lastupdatenum+86400<". time())->order("lastupdatenum")->limit("10")->select(); 
	    $indexlp = rand(0, sizeof($lists_rzloupan1)-1);
	    $boo =D("")->execute("update ot_document_shejishi set yuyuenum=yuyuenum+1,lastupdatenum=".time()." where id=".$lists_rzloupan1[$indexlp]['id']);
	}
	if($keyword){
	    //关键词搜索：案例名称、楼盘名称、设计师名字	    
	    $count=D("ShejishiView")->where("document.status=1 and (document.title like '%{$keyword}%' or document_shejishi.nickname like '%{$keyword}%' )")->count();
	}else{	
	    $count=D("ShejishiView")->where($map)->count();
	}
	$page =new \Think\Pagedz($count,$this->pageSize);
	$start = $page->firstRow;
	$psize = $page->listRows; 
	if($keyword){
	    //关键词搜索：案例名称、楼盘名称、设计师名字	    
	    $lists_data1=D("ShejishiView")->where("document.status=1 and (document.title like '%{$keyword}%' or document_shejishi.nickname like '%{$keyword}%')")->order("level desc")->limit($start.",".$psize)->select(); 
	}else{
	    $lists_data1=D("ShejishiView")->where($map)->order("level desc")->limit($start.",".$psize)->select(); 
	}
        $this->assign('lists_data1',$lists_data1);//列表
        $this->assign('lists_count',$count);//列表
	  
	$this->assign('rank',$rank);//  
	$this->assign('keyword',$keyword);// 
	//
	//设置分页主题，如果没有这个设置，页面上不会显示有多少个记录
//	$page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
	$page->setConfig('theme', '%HOMEPAGE% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %GOPAGE%');
	//将分页显示到前端
	$str_page = $page->show();
	$this->assign("_page",$str_page);
	
	$_sql ="select DISTINCT r.evalue,r.ename from ot_sys_enum_rank r where r.isvalid=1 ORDER BY r.disorder";
	$anlifengges = M()->query($_sql);
	$this->assign("ranks",$anlifengges);        
	
	
        $this->display();
    }
    
    //设计师详情页，接入参数为设计师编号
    public function detail(){
	$aid=$_REQUEST['aid']; 
	$sno=$_REQUEST['sno'];
	if(empty($aid) && empty($sno)){
	    redirect("/index.php/home/shejishi/index");
	} 
	
	//查询案例详情
	if($sno){
	    $s_view=D("ShejishiView")->where(array("sno"=>$sno))->find(); 		
	    $s_data = D("Document_shejishi")->where(array("sno"=>$sno))->find();
	}else if($aid){
	    $s_view=D("ShejishiView")->where(array("id"=>$aid))->find(); 		
	    $s_data = D("Document_shejishi")->where(array("id"=>$aid))->find();
	} 
	//查询设计师案例
	$anlis_count=0;
	if($s_data){ 
	    $anlis_view = D("AnliView")->where(array("shejishi"=>$s_data['sno']))->order("level desc")->select();
	   $anlis_count = count($anlis_view);
	}
	$this->assign("anlis_count",$anlis_count);	
	
	$oo = M()->execute("update ot_document set view=view+1 where id={$aid}");
	
	$this->assign('aid',aid);//
	$this->assign('ano',$ano);//  
	$this->assign('s_view',$s_view);//  
	$this->assign('s_data',$s_data);//  
//	$this->assign('document_data',$document_data);//  
	
	$this->assign('anlis_view',$anlis_view);//  
                 
        $this->display();
    }
    
    public function ajaxGetShejishi(){  
	$rank = $_REQUEST['rank']; 
	$keyword = $_REQUEST['keyword'];
	$pindex = max(1, intval($_REQUEST['page']));
	$psize  = $this->pageSize;
	$start = ($pindex-1)*$psize;
	 
	$map['status']='1';
	if($rank){
	    $map['rank']=$rank;
	}
	
	if($keyword){
	    //关键词搜索：案例名称、楼盘名称、设计师名字	    
	    $lists_data1=D("ShejishiView")->where("document.status=1 and (document.title like '%{$keyword}%' or document_shejishi.nickname like '%{$keyword}%')")->order("level desc")->limit($start.",".$psize)->select(); 
	    $count=D("ShejishiView")->where("document.status=1 and (document.title like '%{$keyword}%' or document_shejishi.nickname like '%{$keyword}%' )")->count();
	}else{
	    $lists_data1=D("ShejishiView")->where($map)->order("level desc")->limit($start.",".$psize)->select(); 
	    $count=D("ShejishiView")->where($map)->count();
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