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
class GongdiController extends HomeController {
    public $pageSize; 
    protected function _initialize() {
	parent::_initialize();
	$this->pageSize=4;
    }

    //系统案例首页
    public function index(){

//        $category = D('Category')->getTree();
//        $lists    = D('Document')->lists(null);
//
//        $this->assign('category',$category);//栏目
//        $this->assign('lists',$lists);//列表
//        $this->assign('page',D('Document')->page);//分页
    
	$area = $_REQUEST['area']; 
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
	if($area){
	    $map['areaid']=$area;
	} 
	if($keyword){
	    //关键词搜索：案例名称、楼盘名称、设计师名字	    
	    $count=D("GongdiView")->where("document.status=1 and (document.title like '%{$keyword}%' or document_gongdi.loupan like '%{$keyword}%' or document.description like '%{$keyword}%' )")->count();
	}else{ 
	    $count=D("GongdiView")->where($map)->count();	    
	}
	$page =new \Think\Pagedz($count,$this->pageSize);
	$start = $page->firstRow;
	$psize = $page->listRows; 
	
	 
	if($keyword){
	    //关键词搜索：案例名称、楼盘名称、设计师名字	    
	    $lists_gongdi1=D("GongdiView")->where("document.status=1 and (document.title like '%{$keyword}%' or document_gongdi.loupan like '%{$keyword}%' or document.description like '%{$keyword}%' )")->order("level desc,document.id desc")->limit($start.",".$psize)->select(); 
	}else{ 
	    $lists_gongdi1=D("GongdiView")->where($map)->order("level desc,document.id desc")->limit($start.",".$psize)->select(); 
	}
	//echo $count."<br>";var_dump($map); var_dump($lists_gongdi1);
	
        $this->assign('lists_gongdi1',$lists_gongdi1);//列表
        $this->assign('lists_count',$count);//列表
	 	
	$this->assign('area',$area);//  
	$this->assign('keyword',$keyword);// 
	//
	//设置分页主题，如果没有这个设置，页面上不会显示有多少个记录 
	$page->setConfig('theme', '%HOMEPAGE% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %GOPAGE%');
	//将分页显示到前端
	$str_page = $page->show();
	$this->assign("_page",$str_page);
            
	//获取楼盘区县	
	$_sql ="select s.ename,s.evalue from ot_sys_enum_loupanarea s where s.`isvalid`=1 order by disorder desc ";    
	 $areas= M()->query($_sql);	
	 //var_dump($areas);
        $this->assign('areas',$areas);//列表
	
        $this->display();
    }
    
    //系统案例详情页
    public function detail(){
	$aid=$_REQUEST['aid'];
	if(empty($aid)){
	    redirect("/index.php/home/gongdi/index");
	}
	
	//查询案例详情
	$gongdi_view=D("GongdiView")->where(array("id"=>$aid))->find(); 		
	$gongdi_data = D("Document_gongdi")->where(array("id"=>$aid))->find();
//	$document_data = D("Document")->where(array("id"=>$aid))->find();
	//设计师
	if($gongdi_data['shejishi']){
	    $shejishi_view = D("ShejishiView")->where(array("sno"=>$gongdi_data['shejishi']))->find();
	}
	$gongdi_data['imgids_kg_path']=$gongdi_data['imgids_sg_path']=$gongdi_data['imgids_jg_path']="";
	//查询案例的开工、施工、竣工图
	if($gongdi_data['zxstep']>2 && $gongdi_data['imgids_jg']){
	    $idp= intval($gongdi_data['imgids_jg']);
	    $pic_jg = D()->query("select * from ot_picture where id={$idp}");
	    if($pic_jg){
		$gongdi_data['imgids_jg_path']=$pic_jg[0]['path'];
	    }
	}//查询案例的开工、施工、竣工图
	if($gongdi_data['zxstep']>1 && $gongdi_data['imgids_sg']){
	    $idp= intval($gongdi_data['imgids_sg']);
	    $pic_jg = D()->query("select * from ot_picture where id={$idp}");
	    if($pic_jg){
		$gongdi_data['imgids_sg_path']=$pic_jg[0]['path'];
	    }
	}//查询案例的开工、施工、竣工图
	if($gongdi_data['imgids_kg']){
	    $idp= intval($gongdi_data['imgids_kg']);
	    $pic_jg = D()->query("select * from ot_picture where id={$idp}");
	    if($pic_jg){
		$gongdi_data['imgids_kg_path']=$pic_jg[0]['path'];
	    }
	}
	
	
	//查询设楼盘案例
	if($gongdi_view['dtitle']){
	    $anlis_view = D("AnliView")->where(array("document.status=1 and (document.title like '".$rzloupan_view['dtitle']."' or document.id >0 )"))->order("level desc")->limit("3")->select();
	    $this->assign('anlis_view',$anlis_view);//  
	}	
	$oo = M()->execute("update ot_document set view=view+1 where id={$aid}");
	
	$this->assign('aid',$aid);//  
	$this->assign('gongdi_view',$gongdi_view);//  
	$this->assign('gongdi_data',$gongdi_data);//  
//	$this->assign('document_data',$document_data);//  
	
	$this->assign('shejishi_view',$shejishi_view);//  
                 
        $this->display();
    }
    
    public function ajaxGetData(){  
	$area = $_REQUEST['area'];
	$keyword = $_REQUEST['keyword'];
	$pindex = max(1, intval($_REQUEST['page']));
	$psize  = $this->pageSize;
	$start = ($pindex-1)*$psize;
	 
	$map['status']='1';
	if($area){
	    $map['areaid']= intval($area);
	} 
	if($keyword){
	    //关键词搜索：案例名称、楼盘名称、设计师名字	    
	    $lists_gongdi1=D("GongdiView")->where("document.status=1 and (document.title like '%{$keyword}%' or document_gongdi.loupan like '%{$keyword}%' or document.description like '%{$keyword}%' )")->order("level desc")->limit($start.",".$psize)->select(); 
	    $count=D("GongdiView")->where("document.status=1 and (document.title like '%{$keyword}%' or document_gongdi.loupan like '%{$keyword}%' or document.description like '%{$keyword}%' )")->count();
	}else{ 
	    $lists_gongdi1=D("GongdiView")->where($map)->order("level desc")->limit($start.",".$psize)->select(); 
	    $count=D("GongdiView")->where($map)->count();
	}
	//检查是否最后一页
	if($start+$psize>=$count){
	    $is_last = "1";
	}else{
	    $is_last = "0";
	}
	
	if($lists_gongdi1){ 	    
	    exit(json_encode(array("code"=>"0","msg"=>"ok","is_last"=>$is_last,"total"=>$count,"num"=> sizeof($lists_gongdi1),"data"=>$lists_gongdi1))); 
	}else{
	    exit(json_encode(array("code"=>"10001","msg"=>"查询结果为空！","is_last"=>$is_last))); 
	} 
	exit(json_encode(array("code"=>"10002","msg"=>"未知错误！","is_last"=>$is_last))); 
    }

}