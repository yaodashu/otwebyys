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
class ShejishiController extends HomeController {
    public $pageSize; 
    protected function _initialize() {
	parent::_initialize();
	$this->pageSize=8;
    }

    //系统案例首页
    public function index(){ 
    
	$area = $_REQUEST['area'];
	$fengge = $_REQUEST['fengge'];
	$jushi = $_REQUEST['jushi'];
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
	 $map_str = "document.status=1";
	if($area){
	    //先根据ID查询得到名称
	   //$areadata =   M("sys_enum_area")->where(array("evalue"=>$area))->find(); 
	    //$map_str .= " and area = '{$areadata['ename']}'";
	    $map['area']=$area;
	} 
	if($rank){
	    $map['rank']=$rank;
	}
	//echo $fengge."-".$jushi."-".$map_str;
	
	//查询前先更新一个设计师的预约人数，取时间最小的10个记录，再取随机数，修改对应的次数
//	$lists_rzloupan1=D("ShejishiView")->where("document.status =1 and document_shejishi.lastupdatenum+86400>=". time())->order("lastupdatenum")->find(); 
//	if(empty($lists_rzloupan1)){
//	    $lists_rzloupan1=D("ShejishiView")->where("document.status =1 and document_shejishi.lastupdatenum+86400<". time())->order("lastupdatenum")->limit("10")->select(); 
//	    $indexlp = rand(0, sizeof($lists_rzloupan1)-1);
//	    $boo =D("")->execute("update ot_document_shejishi set yuyuenum=yuyuenum+1,lastupdatenum=".time()." where id=".$lists_rzloupan1[$indexlp]['id']);
//	}
	//更新设计师真实案例数目
	
	
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
	    $lists_data1=D("ShejishiView")->where("document.status=1 and (document.title like '%{$keyword}%' or document_shejishi.nickname like '%{$keyword}%')")->order("real_zuoping desc,level desc,document.id desc")->limit($start.",".$psize)->select(); 
	}else{
	    $lists_data1=D("ShejishiView")->where($map)->order("real_zuoping desc,level desc,document.id desc")->limit($start.",".$psize)->select(); 
	}
	//根据设计师查询对应的作品数目
	$strs ="";
	foreach ($lists_data1 as $k1=>$v1){
	    if($v1['sno']){
		$strs = (empty($strs))?("'".$v1['sno']."'"):($strs.",'".$v1['sno']."'"); 
	    }
	    //拆分擅长字段
	    $temps =null;
	    if(strpos("@".$v1['shanchang'],"、")>0){
		$temps= explode("、", $v1['shanchang']);
		$lists_data1[$k1]['shanchangs']=$temps;
	    }else if(strpos("@".$v1['shanchang'],"，")>0){
		$temps= explode("，", $v1['shanchang']);
		$lists_data1[$k1]['shanchangs']=$temps;
	    }else if(strpos("@".$v1['shanchang'],",")>0){
		$temps= explode(",", $v1['shanchang']);
		$lists_data1[$k1]['shanchangs']=$temps;
	    }else if($v1['shanchang']){
		$lists_data1[$k1]['shanchangs'][]=$v1['shanchang'];
	    }
	    //每个设计师的2个最新案例
	    $_sql ="select a.sno,b.id,d.cover_id,p.path pathinfo from ot_document_shejishi a,ot_document_anli b,ot_document d,ot_picture p where a.sno=b.shejishi and b.id=d.id and d.cover_id=p.id and d.`status`=1 and a.sno in ({$v1['sno']}) ORDER BY d.create_time LIMIT 2";
	    $anlis = M()->query($_sql);
	    $lists_data1[$k1]['anlis']=$anlis;	    
	}
//	echo $strs;
	if($strs){
	    //查询每个设计师的作品数目
	    $_sql = "select shejishi,count(d.id) count from ot_document_anli a,ot_document d where a.id=d.id and d.`status`>0 and a.shejishi in ({$strs}) GROUP BY shejishi";
	    $counts = M()->query($_sql);
//	    var_dump($counts);
	    foreach ($lists_data1 as $k1=>$v1){
		foreach ($counts as $k2=>$v2){
		    if($v1['sno']==$v2['shejishi']){ 
			$lists_data1[$k1]['count']=$lists_data1[$k1]['num_zuoping'] + $v2['count'];
		    } 
		}
	    }
	    //查询每个设计师的列表头像
	    $counts =null ;
	    $_sql = "select a.id,a.sno,d.path headerpic from ot_document_shejishi a,ot_picture d where a.headerpic=d.id and a.sno in ({$strs})";
	    $counts = M()->query($_sql);
    //	    var_dump($counts);
	    foreach ($lists_data1 as $k1=>$v1){
		foreach ($counts as $k2=>$v2){
		    if($v1['sno']==$v2['sno']){ 
			$lists_data1[$k1]['headerpic']=($v2['headerpic'])?$v2['headerpic']:$v1['picpath'];
		    } 
		}
	    }
	}  
	
	//设计师分店	
	$_sql = "select evalue,ename from ot_sys_enum_area a where a.isvalid=1 ORDER BY disorder";
	$areas = M()->query($_sql);
        $this->assign('areas',$areas);//列表
	//设计师级别
	$_sql = "select evalue,ename from ot_sys_enum_rank a where a.isvalid=1 ORDER BY disorder";
	$ranks = M()->query($_sql);
        $this->assign('ranks',$ranks);//列表
	
	//var_dump($lists_data1);
	
        $this->assign('lists_data1',$lists_data1);//列表
        $this->assign('lists_count',$count);//列表
	  
	$this->assign('area',$area);// 
	$this->assign('fengge',$fengge);// 
	$this->assign('jushi',$jushi);// 
	$this->assign('rank',$rank);//  
	$this->assign('keyword',$keyword);// 
	//
	//设置分页主题，如果没有这个设置，页面上不会显示有多少个记录 
	$page->setConfig('theme', '%HOMEPAGE% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %GOPAGE%');
	//将分页显示到前端
	$str_page = $page->show();
	$this->assign("_page",$str_page);
                 
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
	    $s_view=D("ShejishiView")->where(array("sno"=>$sno,"status"=>1))->find(); 		
	    $s_data = D("Document_shejishi")->where(array("sno"=>$sno))->find();
	}else if($aid){
	    $s_view=D("ShejishiView")->where(array("id"=>$aid))->find(); 		
	    $s_data = D("Document_shejishi")->where(array("id"=>$aid))->find();
	} 
	if($s_data){
//	    头像
	    $_sql = "select a.id,a.sno,d.path headerpic from ot_document_shejishi a,ot_picture d where a.headerpic=d.id and a.id in ({$s_data['id']})";
	    $counts = M()->query($_sql);
	    $s_data['headerpic'] = $counts[0]['headerpic']?$counts[0]['headerpic']:$s_data['headerpic'];
//	    作品数目
	    $_sql = "select shejishi,count(d.id) count from ot_document_anli a,ot_document d where a.id=d.id and d.`status`>0 and a.shejishi in ({$s_data['sno']})";
	    $counts1 = M()->query($_sql);
	    $s_data['num_zuoping'] = $s_data['num_zuoping'] + $counts1[0]['count'];
	    
	}
	
	//查询设计师经典案例	
	if($s_data){	    
		//检查如果是手机则跳转手机官网对应案例位置 
		if(isMobile()){ 
		    redirect("/index.php/mob/shejishi/detail/aid/".$aid); 
		}else{

		}  
	    $anlis_view = D("AnliView")->where(array("shejishi"=>$s_data['sno'],"status"=>1))->order("level desc")->limit("6")->select();
	}
	//查询设计师经典全景案例	
	if($s_data){	    
		//检查如果是手机则跳转手机官网对应案例位置 
		if(isMobile()){ 
		    redirect("/index.php/mob/shejishi/detail/aid/".$aid); 
		}else{

		}  
	    $quanjins_view = D("QuanjinView")->where(array("shejishi"=>$s_data['sno'],"status"=>1))->order("level desc")->limit("6")->select();
	}	
	
	//推荐设计师
//	$shejishis_view = D("ShejishiView")->where(array("status"=>1))->order("level desc")->limit("18")->select();
	    $_sql = "select a.id,a.sno,d.title dtitle,p.path headerpic,p1.path picpath from ot_document_shejishi a LEFT JOIN ot_picture p on a.headerpic=p.id 
,ot_document d LEFT JOIN ot_picture p1 on d.cover_id=p1.id where a.id=d.id and (p.id!='' or p1.id!='') ORDER BY d.`level` desc limit 8 ";
	    $shejishis_view = M()->query($_sql);
	//var_dump($shejishis_view);
	
	$oo = M()->execute("update ot_document set view=view+1 where id={$aid}");
	
	$this->assign('aid',aid);//
	$this->assign('ano',$ano);//  
	$this->assign('s_view',$s_view);//  
	$this->assign('s_data',$s_data);//  
//	$this->assign('document_data',$document_data);//  
	
	$this->assign('anlis_view',$anlis_view);//  
	$this->assign('quanjins_view',$quanjins_view);//  
	$this->assign('shejishis_view',$shejishis_view);//  
                 
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

    public function ajaxUpdateRealNum(){
	//查询设计师真实案例数目
	$_sql = "select shejishi,count(d.id) real_zuoping from ot_document d,ot_document_anli a where d.`status`>0 and d.id=a.id group by a.shejishi";
	$nums = M()->query($_sql);
	$s_view=D("ShejishiView")->where("document.status=1 and document_shejishi.real_zuoping<2")->select(); 
	foreach ($nums as $k=>$v){
	    foreach ($s_view as $k2=>$v2){
		if($v['shejishi'] == $v2['sno'] && $v['real_zuoping']>0 && $v['real_zuoping'] !=$v2['real_zuoping'] ){
		    if($v['real_zuoping']>1){
			$oo = M()->execute("update ot_document_shejishi set real_zuoping=2 where id={$v2['id']}");
		    }else if($v['real_zuoping']==1){
			$oo = M()->execute("update ot_document_shejishi set real_zuoping=1 where id={$v2['id']}");
		    }
		}
	    }
	}
	
	exit(json_encode(array("code"=>"0","msg"=>"未知错误！","is_last"=>$is_last))); 
    }
}
