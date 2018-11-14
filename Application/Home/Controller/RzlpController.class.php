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
class RzlpController extends HomeController {
    public $pageSize; 
    protected function _initialize() {
	parent::_initialize();
	$this->pageSize=12;
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
	$map['ltype']='2';  //热装楼盘
	if($area){
	    $map['areaid']=$area;
	} 
//	//取时间最小的10个记录，再取随机数，修改对应的次数
//	$lists_rzloupan1=D("document_loupan")->where("lastupdatenum+86400>=". time())->limit("1")->find(); 
//	if(empty($lists_rzloupan1)){
//	    $lists_rzloupan1=D("document_loupan")->where("lastupdatenum+86400<". time())->order("lastupdatenum")->limit("10")->select(); 
//	    $indexlp = rand(0, sizeof($lists_rzloupan1)-1);
//	    $boo =D("")->execute("update ot_document_loupan set custnum=custnum+1,lastupdatenum=".time()." where id=".$lists_rzloupan1[$indexlp]['id']);
//	}
	
	if($keyword){  
	    $count=D("LoupanView")->where("document.status=1 and document_loupan.ltype=2 and (document.title like '%{$keyword}%' or document.description like '%{$keyword}%' )")->count();
	}else{ 
	    $count=D("LoupanView")->where($map)->count();	    
	}
	$page =new \Think\Pagedz($count,$this->pageSize);
	$start = $page->firstRow;
	$psize = $page->listRows; 
	
	if($keyword){
	    $lists_rzloupan1=D("LoupanView")->where("document.status=1 and document_loupan.ltype=2 and (document.title like '%{$keyword}%' or document.description like '%{$keyword}%' )")->order("level desc,document.id desc")->limit($start.",".$psize)->select(); 
	}else{ 
	    $lists_rzloupan1=D("LoupanView")->where($map)->order("level desc,document.id desc")->limit($start.",".$psize)->select(); 
	}
	$str = ""; 
	foreach ($lists_rzloupan1 as $rk=>$rv){
	    $total = $total + $rv['custnum']; 
	    if($rv['id']){
		$str = ($str)?($str."','".trim($rv['id'])):trim($rv['id']);
	    }
	}
	if($str){
	    $anlis = D()->query("select a.rzloupan,count(a.id) count from ot_document_anli a,ot_document d where d.id=a.id and d.status=1 and rzloupan in('".$str."') GROUP BY a.rzloupan ");
	    foreach ($anlis as $av){
		foreach ($lists_rzloupan1 as $rk=>$rv){ 
		    if(trim($av['rzloupan'])==trim($rv['id'])){			
			if($lists_rzloupan1[$rk]['custnum']>0){
			    //如果设置了基数，则不取实际案例数
			    $lists_rzloupan1[$rk]['custnum']=$av['count']+$lists_rzloupan1[$rk]['custnum'];
			     $total = $total + $av['count'];
			}else{
			    $lists_rzloupan1[$rk]['custnum']=$av['count']+$lists_rzloupan1[$rk]['custnum'];
			     $total = $total + $av['count'];
			}
		    }
		}
	    }
	}
	//获取楼盘区县	
	$_sql ="select s.ename,s.evalue from ot_sys_enum_loupanarea s where s.`isvalid`=1 order by disorder desc ";    
	 $areas= M()->query($_sql);	
	 //var_dump($areas);
        $this->assign('areas',$areas);//列表
		
	//查询总用户数
	//$total=D("LoupanView")->field("sum(custnum) total")->where($map)->find();
	//$total = ($total)?$total['total']:"0";
        $this->assign('total',$total);//列表
//	var_dump($lists_rzloupan1);
	
        $this->assign('lists_rzloupan1',$lists_rzloupan1);//列表
        $this->assign('lists_count',$count);//列表
	 	
	$this->assign('area',$area);//  
	$this->assign('keyword',$keyword);//
	//
	//设置分页主题，如果没有这个设置，页面上不会显示有多少个记录 
	$page->setConfig('theme', '%HOMEPAGE% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %GOPAGE%');
	//将分页显示到前端
	$str_page = $page->show();
	$this->assign("_page",$str_page); 
	
        $this->assign('l_url',"http://".$_SERVER['SERVER_NAME']);//列表
        $this->assign('ltype',"2");//列表
        if($_REQUEST['tst']){
	    $this->display("index_bak");
	}else{
	    $this->display();
	}
    }
    
    //系统案例详情页
    public function detail(){
	$aid=$_REQUEST['aid'];
	if(empty($aid)){
	    redirect("/index.php/home/rzloupan/index");
	}
	
	//查询案例详情
	$rzloupan_view=D("LoupanView")->where(array("id"=>$aid))->find(); 		
	$rzloupan_data = D("Document_loupan")->where(array("id"=>$aid))->find();
	 
//	$document_data = D("Document")->where(array("id"=>$aid))->find();
	//设计师
//	if($rzloupan_data['shejishi']){
//	    $shejishi_view = D("ShejishiView")->where(array("sno"=>$rzloupan_data['shejishi']))->find();
//	}
	
	 //页码
	$pindex = max(1, intval($_REQUEST['page']));
	$psize  = 6;
	$start = ($pindex-1)*$psize;	
	//查询设楼盘案例
	if($rzloupan_view['id']){
	    
//	    $count=D("AnliView")->where(array("document.status=1 and (rzloupan ='".trim($rzloupan_view['id'])."')"))->count();
//	    
//	    $page =new \Think\Page($count,$psize);
//	    $start = $page->firstRow;
//	    $psize = $page->listRows; 
	    //查询楼盘案例
	    $anlis_view = D("AnliView")->where(array("document.status=1 and (rzloupan ='".$rzloupan_view['id']."')"))->order("level desc")->limit("9")->select();
	    $this->assign('anlis_view',$anlis_view);//  
	    
//	    //设置分页主题，如果没有这个设置，页面上不会显示有多少个记录
//	    $page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
//	    //将分页显示到前端
//	    $str_page = $page->show();
//	    $this->assign("_page",$str_page); 
	     
	    $rzloupan_view['custnum'] = ($rzloupan_view['custnum']>0)?($rzloupan_view['custnum']):($rzloupan_view['custnum'] + $count);  
	    $rzloupan_data['custnum'] = ($rzloupan_data['custnum']>0)?($rzloupan_data['custnum']):($rzloupan_data['custnum'] + $count); 
	    
	    
	    //查询楼盘工地
	    $gongdis_view = D("GongdiView")->where(array("document.status=1 and (document_gongdi.loupan ='".$rzloupan_view['id']."')"))->order("level desc")->limit("3")->select();
	    //var_dump($gongdis_view);
	    $this->assign('gongdis_view',$gongdis_view);//  
	}
		
	$oo = M()->execute("update ot_document set view=view+1 where id={$aid}");
	
	//楼盘图集转换成图片路径
		
	if(!empty($rzloupan_data['imgids'])){
	    $imgs_data = D("picture")->where("id in({$rzloupan_data['imgids']})")->select();
	    $this->assign('imgs_data',$imgs_data);//  
	}
	
	$this->assign('aid',$aid);//  
	$this->assign('rzloupan_view',$rzloupan_view);//  
	$this->assign('rzloupan_data',$rzloupan_data);//  
//	$this->assign('document_data',$document_data);//  
	
//	$this->assign('shejishi_view',$shejishi_view);//  
        $this->assign('ltype',"2");//列表
           
	//查询报名人数
	$url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=0&time=".date("Y-m-d",time());//date("Y-m-d",time())
	$renshu=file_get_contents($url); 	
	$renshu = intval($renshu);
	if(date("H",time())>=18){
	    $renshu=$renshu+90;
	}else if(date("H",time())>=14){
	    $renshu=$renshu+60;
	}else if(date("H",time())>=10){
	    $renshu=$renshu+30;
	}else if(date("H",time())>=8){
	    $renshu=$renshu+10;
	}
        $this->assign('renshu',$renshu);//列表
	
        $this->display();
    }
    
    public function ajaxGetData(){  
	$area = $_REQUEST['area'];
	$keyword = $_REQUEST['keyword'];
	$pindex = max(1, intval($_REQUEST['page']));
	$psize  = $this->pageSize;
	$start = ($pindex-1)*$psize;
	 
	$map['status']='1';
	$map['ltype']='2';  //热装楼盘
	if($area){
	    $map['areaid']= intval($area);
	} 
	if($keyword){
	    //关键词搜索：案例名称、楼盘名称、设计师名字	    
	    $lists_rzloupan1=D("LoupanView")->where("document.status=1 and document_loupan.ltype=2 and (document.title like '%{$keyword}%' or document.description like '%{$keyword}%' )")->order("level desc")->limit($start.",".$psize)->select(); 
	    $count=D("LoupanView")->where("document.status=1 and document_loupan.ltype=2 and (document.title like '%{$keyword}%' or document.description like '%{$keyword}%' )")->count();
	}else{ 
	    $lists_rzloupan1=D("LoupanView")->where($map)->order("level desc")->limit($start.",".$psize)->select(); 
	    $count=D("LoupanView")->where($map)->count();
//	    $total=D("LoupanView")->field("sum(custnum) total")->where($map)->find();
//	    $total = ($total)?$total['total']:"0";
	}
	
	$str = ""; 
	foreach ($lists_rzloupan1 as $rk=>$rv){
	    $total = $total + $rv['custnum']; 
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
			 $total = $total + $av['count'];
		    }
		}
	    }
	}
	
	//检查是否最后一页
	if($start+$psize>=$count){
	    $is_last = "1";
	}else{
	    $is_last = "0";
	}
	
	if($lists_rzloupan1){ 	    
	    exit(json_encode(array("code"=>"0","msg"=>"ok","is_last"=>$is_last,"total"=>$total,"num"=> sizeof($lists_rzloupan1),"data"=>$lists_rzloupan1))); 
	}else{
	    exit(json_encode(array("code"=>"10001","msg"=>"查询结果为空！","is_last"=>$is_last))); 
	} 
	exit(json_encode(array("code"=>"10002","msg"=>"未知错误！","is_last"=>$is_last))); 
    }

}