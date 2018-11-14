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
class ArticleController extends HomeController {
    public $pageSize; 
    public $filecate;
    protected function _initialize() {
	parent::_initialize();
	$this->pageSize=6;
	
	//文档分类 
	$catelists= M("aticle_cate")->where("1")->order("displayorder desc")->select(); 
	foreach ($catelists as $k=>$v){
	    $temps[$v['id']]=$v['title'];
	} 
	$this->filecate = $temps;
	unset($temps);  
	$this->assign("catelists",$catelists);
	$this->assign("filecate",$this->filecate);
    }

    //系统新闻列表页
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
     
	//文档类型4：新闻；5：装修档案
	$ftype=$_REQUEST['ftype']?$_REQUEST['ftype']:"4";
	
	//查询文档新闻、装修文档类型 
	
	$map='document.status=1';
	if($ftype){
	    $map.=" and ftype =".$ftype;
	} 
	
	if($keyword){   
	    $map.=" and (document.title like '%{$keyword}%' or document.description like '%{$keyword}%' )";    
	} 
	$count=D("ArticleView")->where($map)->count();	
	$page =new \Think\Pagedz($count,$this->pageSize);
	$start = $page->firstRow;
	$psize = $page->listRows; 
	 
	$lists_data1=D("ArticleView")->where($map)->order("level desc,document.id desc")->limit($start.",".$psize)->select(); 
	
        $this->assign('lists_data1',$lists_data1);//列表
        $this->assign('lists_count',$count);//列表
	
//	//获取设计师列表 
//	$maps['status']=1;
//	$lists_shejishi1=D("ShejishiView")->where($maps)->order("level desc")->limit("0,100")->select(); 
//        $this->assign('lists_shejishi1',$lists_shejishi1);//列表
	
	//查询最新装修案例 
	$mapa['status']=1;  //现代简约风格 
	$lists_anli1=D("AnliView")->where($mapa)->order("create_time desc")->limit("3")->select();
	$this->assign('lists_anli1',$lists_anli1);//
	
	
	$ftitle = $this->filecate[$ftype]; 
        $this->assign('filecate',$this->filecate);//列表
	
        $this->assign('ftype',$ftype);//列表
        $this->assign('ftitle',$ftitle);//列表
	
	$this->assign('keyword',$keyword);//
	//
	//设置分页主题，如果没有这个设置，页面上不会显示有多少个记录
	$page->setConfig('theme', '%HOMEPAGE% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %GOPAGE%');
	//将分页显示到前端
	$str_page = $page->show();
	$this->assign("_page",$str_page); 
                 
        $this->display();
    }
    
    //系统案例详情页
    public function detail(){
	$aid=$_REQUEST['aid'];
	if(empty($aid)){
	    redirect("/index.php/home/article/index");
	}
	
	//查询案例详情
	$data_view=D("ArticleView")->where(array("id"=>$aid))->find(); 		
	$data_data = D("Document_article")->where(array("id"=>$aid))->find();
//	$document_data = D("Document")->where(array("id"=>$aid))->find();
//	
//	
	//查询最新装修案例 
	$mapa['status']=1;  //现代简约风格 
	$lists_anli1=D("AnliView")->where($mapa)->order("create_time desc")->limit("3")->select();
	$this->assign('lists_anli1',$lists_anli1);//
	 	 
	 
	 //上一篇，下一篇	
	$data_pre = D("ArticleView")->where(array("id"=>array("lt",$aid)))->order("id desc")->find();
	$data_next = D("ArticleView")->where(array("id"=>array("gt",$aid)))->order("id")->find();
	 
	$oo = M()->execute("update ot_document set view=view+1 where id={$aid}");
	
	$ftitle = $this->filecate[$ftype]; 
	
        $this->assign('ftitle',$ftitle);//列表
	 
	$this->assign('aid',$aid);//  
	$this->assign('data_view',$data_view);//  
	$this->assign('data_data',$data_data);//  
//	$this->assign('document_data',$document_data);//  
	
	$this->assign('anlis_view',$anlis_view);//
	$this->assign('anli_view',$anli_view);//  
	$this->assign('data_pre',$data_pre);//  
	$this->assign('data_next',$data_next);//  
                 
        $this->display();
    }
    
    public function ajaxGetNews(){   
	$ftype = $_REQUEST['ftype'];
	$keyword = $_REQUEST['keyword'];
	$pindex = max(1, intval($_REQUEST['page']));
	$psize  = $this->pageSize;
	$start = ($pindex-1)*$psize;
	 
	$map='document.status=1';
	if($ftype){
	    $map.=" and ftype =".$ftype;
	} 
	if($keyword){
	    //关键词搜索：案例名称、楼盘名称、设计师名字	    
	    $map.=" and (document.title like '%{$keyword}%' or document.title like '%{$keyword}%' )"; 
	} 
	$lists_anli1=D("ArticleView")->where($map)->order("level desc")->limit($start.",".$psize)->select(); 
	$count=D("ArticleView")->where($map)->count();
	//检查是否最后一页
	if($start+$psize>=$count){
	    $is_last = "1";
	}else{
	    $is_last = "0";
	}
	
	if($lists_anli1){ 	    
	    exit(json_encode(array("code"=>"0","msg"=>"ok","is_last"=>$is_last,"total"=>$count,"num"=> sizeof($lists_anli1),"data"=>$lists_anli1))); 
	}else{
	    exit(json_encode(array("code"=>"10001","msg"=>"查询结果为空！","is_last"=>$is_last))); 
	} 
	exit(json_encode(array("code"=>"10002","msg"=>"未知错误！","is_last"=>$is_last))); 
    }

}