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
class QuanjinController extends HomeController {
    public $pageSize; 
    public $mianjis;
    protected function _initialize() {
	parent::_initialize();
	$this->pageSize=6; 
	//定义面积的最最大最小值
	$this->mianjis= array("1"=>array("min"=>1,"max"=>90),
	    "2"=>array("min"=>90,"max"=>100),
	    "3"=>array("min"=>100,"max"=>110),
	    "4"=>array("min"=>110,"max"=>120),
	    "5"=>array("min"=>120,"max"=>130),
	    "6"=>array("min"=>130,"max"=>140),
	    "7"=>array("min"=>140,"max"=>11110)); 
    } 

    //系统案例首页
    public function index(){
	
//        $category = D('Category')->getTree();
//        $lists    = D('Document')->lists(null);
//
//        $this->assign('category',$category);//栏目
//        $this->assign('lists',$lists);//列表
//        $this->assign('page',D('Document')->page);//分页
    
	$fengge = $_REQUEST['fengge'];
	$jushi = $_REQUEST['jushi'];
	$shejishi = $_REQUEST['shejishi'];
	$keyword = $_REQUEST['keyword'];
	$mianji = $_REQUEST['mianji'];
	//cp936就是指系统里第936号编码格式，也就是GB2312。EUC-CN EUC-CN是GB2312最常用的表示方法。浏览器编码表上的“GB2312”，通常都是指“EUC-CN”表示法。
	//过程中本地笔记本是cp936不需要转码能正常显示
	$encode = mb_detect_encoding($keyword, array('ASCII','GB2312','GBK','UTF-8')); 
	if(in_array(strtoupper($encode), array('CP936','GB2312','EUC-CN'))){	    
	}else{
	    $keyword = iconv('GB2312', 'UTF-8', $keyword);
	}
//	echo $encode;
	 
	 //页码
	$pindex = max(1, intval($_REQUEST['p']));
	$psize  = $this->pageSize;
	$start = ($pindex-1)*$psize;
     
	
	//查询装修案例 
	$map['status']='1';
	if($fengge){
	    $map['fengge']=$fengge;
	}
	if($jushi){
	    $map['jushi']=$jushi;
	}
	if($shejishi){
	    $map['shejishi']=$shejishi;
	} 
	if(intval($mianji)>0){
	    $map['mianji']= array("BETWEEN",array($this->mianjis[$mianji]['min'],$this->mianjis[$mianji]['max']));
//	    $map['mianji']= array("lt",$this->mianjis[$mianji]['max']);	    
	}
	if($keyword){
	   $count=D("QuanjinView")->where("document.status=1 and (document.title like '%{$keyword}%' or document_quanjin.loupan like '%{$keyword}%' or document_shejishi.nickname like '%{$keyword}%' )")->count();
	}else{
	    $count=D("QuanjinView")->where($map)->count();
	}
	$page =new \Think\Pagedz($count,$this->pageSize);
	$start = $page->firstRow;
	$psize = $page->listRows;
		
	if($keyword){
	    //关键词搜索：案例名称、楼盘名称、设计师名字	    
	    $lists_anli1=D("QuanjinView")->where("document.status=1 and (document.title like '%{$keyword}%' or document_quanjin.loupan like '%{$keyword}%' or document_shejishi.nickname like '%{$keyword}%' )")->order("level desc,document.id desc")->limit($start.",".$psize)->select(); 
	}else{
	    $lists_anli1=D("QuanjinView")->where($map)->order("level desc,document.id desc")->limit($start.",".$psize)->select();  
	}
	 
        $this->assign('lists_anli1',$lists_anli1);//列表
        $this->assign('lists_count',$count);//列表
	
	//案例风格
	$_sql ="select DISTINCT r.evalue,r.ename from ot_sys_enum_fengge r,ot_document_anli a,ot_document d where r.evalue=a.fengge and a.id=d.id and d.`status`=1 ORDER BY r.disorder";
	$_sql ="select DISTINCT r.evalue,r.ename from ot_sys_enum_fengge r where r.`isvalid`=1 ORDER BY r.disorder";
	$anlifengges = M()->query($_sql);
	$this->assign("anlifengges",$anlifengges);
	
	//案例户型
//	$_sql ="select DISTINCT r.evalue,r.ename from ot_sys_enum_jushi r,ot_document_anli a,ot_document d where r.evalue=a.fengge and a.id=d.id and d.`status`=1 ORDER BY r.disorder";
	$_sql ="select DISTINCT r.evalue,r.ename from ot_sys_enum_jushi r where r.isvalid=1 ORDER BY r.disorder";
	$jushis = M()->query($_sql);
	$this->assign("jushis",$jushis);
	
//	//获取设计师列表 
//	$maps['status']=1;
//	$lists_shejishi1=D("ShejishiView")->where($maps)->order("level desc")->limit("0,100")->select(); 
//        $this->assign('lists_shejishi1',$lists_shejishi1);//列表
	
	//设置分页主题，如果没有这个设置，页面上不会显示有多少个记录 
	$page->setConfig('theme', '%HOMEPAGE% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %GOPAGE%');
	//将分页显示到前端
	$str_page = $page->show();
//	$param_extend = "";
//	if($fengge){
//	    $param_extend ="/fengge/".$fengge;
//	}
//	if($jushi){
//	    $param_extend .="/jushi/".$jushi;
//	}
//	if($shejishi){
//	    $param_extend .="/shejishi/".$shejishi;
//	}
//	if($keyword){
//	    $param_extend .="/keyword/".$keyword;
//	}
//	$str_page = str_replace(".html", $param_extend.".html", $str_page);
	
	$this->assign("_page",$str_page);
	
	$this->assign('fengge',$fengge);// 
	$this->assign('jushi',$jushi);// 
	$this->assign('shejishi',$shejishi);// 
	$this->assign('keyword',$keyword);// 
                 
        $this->display();
    }
    
    //系统案例详情页
    public function detail(){
	$aid=$_REQUEST['aid'];
	if(empty($aid)){
	    redirect("/index.php/home/quanjin/index");
	} 
	//检查如果是手机则跳转手机官网对应案例位置 
	if(isMobile()){ 
	    redirect("/index.php/mob/quanjin/detail/aid/".$aid); 
	}else{
	    
	}
	
	//查询案例详情
	$anli_view=D("QuanjinView")->where(array("id"=>$aid))->find(); 		
	$anli_data = D("Document_quanjin")->where(array("id"=>$aid))->find();
//	$document_data = D("Document")->where(array("id"=>$aid))->find();
	//设计师
	if($anli_data['shejishi']){
	    $shejishi_view = D("ShejishiView")->where(array("sno"=>$anli_data['shejishi']))->find();
	}	
	if($anli_data['pic_vr1']){
	    $_sql = "select * from ot_picture where id={$anli_data['pic_vr1']} ";
	    $pdata = M()->query($_sql);
	    $anli_data['pic_vr1_path']= $pdata[0]['path'];
	}
	
	$oo = M()->execute("update ot_document set view=view+1 where id={$aid}");
	
	$str = trim($anli_data['imgids'],",");
	if(!empty($str)){ 
	    $detail_imgs = D("picture")->where("id in (".$str.")")->select();
	    foreach ($detail_imgs as $k=>$v){
		$temps[]=$domain.$v['path'];
	    }
	    $this->assign('imgurls',$temps);//  
	    
	}else if(empty($anli_data['content']) && !empty($anli_data['imgurls'])){
	   //如果案例的详情内容不存在，而迁移图片存在，则解压缩迁移的图片
	    $anli_data['imgurls']= str_replace("{/dede:img}", "", $anli_data['imgurls']);
	    $anli_data['imgurls']= str_replace("\r\n", "", $anli_data['imgurls']);
	    $anli_data['imgurls'] = trim($anli_data['imgurls']);
	    $imgs = explode("} /", $anli_data['imgurls']);
	    $temps =array();
	    foreach ($imgs as $k =>$t){
		$array_t = explode("{", $t);
		$imgs[$k]  =$array_t[0];
		if($k>0){
		    $temps[]=$domain."/". str_replace(" ","",$imgs[$k]);
		}
	    }
	    $this->assign('imgurls',$temps);//  
	   // $temp['imgsurl'] = implode(";",$temps); 
	}
	
	$anlis_view = D("QuanjinView")->where(array("status"=>1))->order("level desc")->limit("3")->select();
	$this->assign('anlis_view',$anlis_view);//  
	
//	var_dump($pdata);
//	var_dump($anli_data);die;
	
	$imgs_num = sizeof($temps);
	$this->assign('imgs_num',$imgs_num);//  
	$imgs_str = implode(";", $temps);
	$this->assign('imgs_str',$imgs_str);//  
	
	$this->assign('aid',$aid);//  
	$this->assign('anli_view',$anli_view);//  
	$this->assign('anli_data',$anli_data);//  
//	$this->assign('document_data',$document_data);//  
	
	$this->assign('shejishi_view',$shejishi_view);//  
                 
	//echo "detail";die;
        $this->display();
    }
    
    //系统案例详情页
    public function vr(){
	$aid=$_REQUEST['aid'];
	if(empty($aid)){
	    redirect("/index.php/home/quanjin/index");
	} 
	//检查如果是手机则跳转手机官网对应案例位置 
	if(isMobile()){ 
	    redirect("/index.php/mob/quanjin/detail/aid/".$aid); 
	}else{
	    
	}
	
	//查询案例详情
	$anli_view=D("QuanjinView")->where(array("id"=>$aid))->find(); 		
	$anli_data = D("Document_quanjin")->where(array("id"=>$aid))->find();
//	$document_data = D("Document")->where(array("id"=>$aid))->find();
	//设计师
	if($anli_data['shejishi']){
	    $shejishi_view = D("ShejishiView")->where(array("sno"=>$anli_data['shejishi']))->find();
	}	
	
	$oo = M()->execute("update ot_document set view=view+1 where id={$aid}");
	
	$str = trim($anli_data['imgids'],",");
	if(!empty($str)){ 
	    $detail_imgs = D("picture")->where("id in (".$str.")")->select();
	    foreach ($detail_imgs as $k=>$v){
		$temps[]=$domain.$v['path'];
	    }
	    $this->assign('imgurls',$temps);//  
	    
	}else if(empty($anli_data['content']) && !empty($anli_data['imgurls'])){
	   //如果案例的详情内容不存在，而迁移图片存在，则解压缩迁移的图片
	    $anli_data['imgurls']= str_replace("{/dede:img}", "", $anli_data['imgurls']);
	    $anli_data['imgurls']= str_replace("\r\n", "", $anli_data['imgurls']);
	    $anli_data['imgurls'] = trim($anli_data['imgurls']);
	    $imgs = explode("} /", $anli_data['imgurls']);
	    $temps =array();
	    foreach ($imgs as $k =>$t){
		$array_t = explode("{", $t);
		$imgs[$k]  =$array_t[0];
		if($k>0){
		    $temps[]=$domain."/". str_replace(" ","",$imgs[$k]);
		}
	    }
	    $this->assign('imgurls',$temps);//  
	   // $temp['imgsurl'] = implode(";",$temps); 
	}
	
	$anlis_view = D("QuanjinView")->where(array("status"=>1))->order("level desc")->limit("3")->select();
	$this->assign('anlis_view',$anlis_view);//  
	
	
	
	$imgs_num = sizeof($temps);
	$this->assign('imgs_num',$imgs_num);//  
	$imgs_str = implode(";", $temps);
	$this->assign('imgs_str',$imgs_str);//  
	
	$this->assign('aid',$aid);//  
	$this->assign('anli_view',$anli_view);//  
	$this->assign('anli_data',$anli_data);//  
//	$this->assign('document_data',$document_data);//  
	
	$this->assign('shejishi_view',$shejishi_view);//  
                 
	//echo "detail";die;
        $this->display();
    }
    
    //系统案例详情页
    public function detail_0(){
	$aid=$_REQUEST['aid'];
	if(empty($aid)){
	    redirect("/index.php/home/anli/index");
	} 
	//检查如果是手机则跳转手机官网对应案例位置 
	if(isMobile()){ 
	    redirect("/index.php/mob/anli/detail/aid/".$aid); 
	}else{
	    
	}
	
	//查询案例详情
	$anli_view=D("QuanjinView")->where(array("id"=>$aid))->find(); 		
	$anli_data = D("Document_quanjin")->where(array("id"=>$aid))->find();
//	$document_data = D("Document")->where(array("id"=>$aid))->find();
	//设计师
	if($anli_data['shejishi']){
	    $shejishi_view = D("ShejishiView")->where(array("sno"=>$anli_data['shejishi']))->find();
	}	
	
	$oo = M()->execute("update ot_document set view=view+1 where id={$aid}");
	
	$str = trim($anli_data['imgids'],",");
	if(!empty($str)){ 
	    $detail_imgs = D("picture")->where("id in (".$str.")")->select();
	    foreach ($detail_imgs as $k=>$v){
		$temps[]=$domain.$v['path'];
	    }
	    $this->assign('imgurls',$temps);//  
	    
	}else if(empty($anli_data['content']) && !empty($anli_data['imgurls'])){
	   //如果案例的详情内容不存在，而迁移图片存在，则解压缩迁移的图片
	    $anli_data['imgurls']= str_replace("{/dede:img}", "", $anli_data['imgurls']);
	    $anli_data['imgurls']= str_replace("\r\n", "", $anli_data['imgurls']);
	    $anli_data['imgurls'] = trim($anli_data['imgurls']);
	    $imgs = explode("} /", $anli_data['imgurls']);
	    $temps =array();
	    foreach ($imgs as $k =>$t){
		$array_t = explode("{", $t);
		$imgs[$k]  =$array_t[0];
		if($k>0){
		    $temps[]=$domain."/". str_replace(" ","",$imgs[$k]);
		}
	    }
	    $this->assign('imgurls',$temps);//  
	   // $temp['imgsurl'] = implode(";",$temps); 
	}
	
	$this->assign('aid',$aid);//  
	$this->assign('anli_view',$anli_view);//  
	$this->assign('anli_data',$anli_data);//  
//	$this->assign('document_data',$document_data);//  
	
	$this->assign('shejishi_view',$shejishi_view);//  
                 
        $this->display();
    }
    
    public function ajaxGetAnli(){  
	$fengge = $_REQUEST['fengge'];
	$jushi = $_REQUEST['jushi'];
	$shejishi = $_REQUEST['shejishi'];
	$keyword = $_REQUEST['keyword'];
	$pindex = max(1, intval($_REQUEST['page']));
	$psize  = $this->pageSize;
	$start = ($pindex-1)*$psize;
	 
	$map['status']='1';
	if($fengge){
	    $map['fengge']=$fengge;
	}
	if($jushi){
	    $map['jushi']=$jushi;
	}
	if($shejishi){
	    $map['shejishi']=$shejishi;
	} 
	if($keyword){
	    //关键词搜索：案例名称、楼盘名称、设计师名字	    
	    $lists_anli1=D("QuanjinView")->where("document.status=1 and (document.title like '%{$keyword}%' or document_quanjin.loupan like '%{$keyword}%' or document_shejishi.nickname like '%{$keyword}%' )")->order("level desc")->limit($start.",".$psize)->select(); 
	    $count=D("QuanjinView")->where("document.status=1 and (document.title like '%{$keyword}%' or document_quanjin.loupan like '%{$keyword}%' or document_shejishi.nickname like '%{$keyword}%' )")->count();
	}else{
	    $lists_anli1=D("QuanjinView")->where($map)->order("level desc")->limit($start.",".$psize)->select(); 
	    $count=D("QuanjinView")->where($map)->count();
	}
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