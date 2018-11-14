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
class IndexController extends HomeController {

    
	//系统首页
    public function index(){  
	header("Location:".U("Article/index"));
//        $category = D('Category')->getTree();
//        $lists    = D('Document')->lists(null);
//
//        $this->assign('category',$category);//栏目
//        $this->assign('lists',$lists);//列表
//        $this->assign('page',D('Document')->page);//分页
//	echo C('URL_MODEL')."<br>";
//	echo U('Index/index',array('id'=>'1'));die;
	
	$site = "http://".$_SERVER['SERVER_NAME'];
	$this->assign("site",$site);
	
	//查询装修案例 
	$map['status']=array("gt",'-1');  //现代简约风格
	$map['home_pos']=array("gt",'0');  //首页位置显示
	$map['home_cover']=array("gt",'0');  //图片存在 
//	$lists_anli1=D("AnliView")->where($map)->order("home_sort,level desc")->limit("100")->select();
	$_sql ="select d.title dtitle,a.id,a.mianji,f.ename fenggename,a.loupan,a.home_pos,a.home_sort,p.path picpath from ot_document_anli a 
LEFT JOIN ot_sys_enum_fengge f on a.fengge= f.evalue
LEFT JOIN ot_picture p on a.home_cover=p.id ,ot_document d
where d.status>0 and d.id=a.id and a.home_pos in (1,2,3,4,5,6) and a.home_sort in(1,2,3) order by a.home_sort limit 30";
	$lists_anli1 =M()->query($_sql); 
        //$this->assign('lists_anli1',$lists_anli1);//列表
	//var_dump($lists_anli1);
	//获取1~10位置图片
	foreach ($lists_anli1 as $key=>$val){ 
	    if(in_array($val['home_pos'], array(1,2,3,4,5,6)) && in_array($val['home_sort'], array(1,2,3))){
		$pic['s'.$val['home_sort']]['p'.$val['home_pos']]=(empty($pic['a'.$val['home_sort']]['p'.$val['home_pos']]))?$val:$pic['a'.$val['home_sort']]['p'.$val['home_pos']];  
	    }
	}	
	//var_dump($pic);
        $this->assign('pic',$pic); 
	
	
	//查询设计团队/之星
	$_sql = "select s.id,s.nickname,s.sno,s.linian,s.years,area.ename areaname,s.star_sort,rank.ename rankname,p1.path star_cover,p3.path pathinfo,anli.home_pos_sheji,anli.id aid,anli.mianji,anli.atitle,fengge.ename fenggename,anli.home_cover_sheji,p4.path home_cover_sheji_pic from ot_document_shejishi s 
		    LEFT JOIN ot_picture p1 on s.star_cover=p1.id
		    LEFT JOIN ot_sys_enum_rank rank on s.rank=rank.evalue 
		    LEFT JOIN ot_sys_enum_area area on s.area=area.evalue 
		    LEFT JOIN ot_document_anli anli on s.sno=anli.shejishi and anli.home_pos_sheji in(2,3,5,6) and anli.home_cover_sheji>0 
		    LEFT JOIN ot_picture p4 on anli.home_cover_sheji = p4.id 
		    LEFT JOIN ot_sys_enum_fengge fengge on anli.fengge = fengge.evalue  
		    ,ot_document d
		    LEFT JOIN ot_picture p3 on d.cover_id=p3.id
		    where s.id=d.id
		    and d.`status`=1 and s.star_sort in(1,2,3) ORDER BY star_sort,anli.home_pos_sheji LIMIT 30";
	$stars_temp =M()->query($_sql);
	//循环查询结果，组装数组
	$shejishis = array();
	foreach($stars_temp as $k1=>$v1){
	    if($v1['id'] && $v1['star_sort'] && $v1['home_pos_sheji']){ 
		//如果设计师不同，则之前的设计师信息清除
		if($shejishis['s'.$v1['star_sort']]['p1']['id'] && $shejishis['s'.$v1['star_sort']]['p1']['id']!=$v1['id']){
		    unset($shejishis['s'.$v1['star_sort']]);
		}
		$shejishis['s'.$v1['star_sort']]['p1']['id']=$v1['id'];//设计师id，
		$shejishis['s'.$v1['star_sort']]['p1']['sno']=$v1['sno'];//设计师编号，
		$shejishis['s'.$v1['star_sort']]['p1']['nickname']=$v1['nickname'];//设计师id，
		$shejishis['s'.$v1['star_sort']]['p1']['years']=$v1['years'];//
		$shejishis['s'.$v1['star_sort']]['p1']['areaname']=$v1['areaname'];//
		$shejishis['s'.$v1['star_sort']]['p1']['linian']=$v1['linian'];//设计师编号，
		$shejishis['s'.$v1['star_sort']]['p1']['rankname']=$v1['rankname'];//设计师职称，
		$shejishis['s'.$v1['star_sort']]['p1']['star_cover']=$v1['star_cover'];//设计师之星头像，
		$shejishis['s'.$v1['star_sort']]['p1']['pathinfo']=$v1['pathinfo'];//设计师默认头像，
		$shejishis['s'.$v1['star_sort']]['p'.$v1['home_pos_sheji']]['aid']=$v1['aid'];//设计师推荐案例编号，
		$shejishis['s'.$v1['star_sort']]['p'.$v1['home_pos_sheji']]['atitle']=$v1['atitle'];//设计师推荐案例名称，
		$shejishis['s'.$v1['star_sort']]['p'.$v1['home_pos_sheji']]['mianji']=$v1['mianji'];//，
		$shejishis['s'.$v1['star_sort']]['p'.$v1['home_pos_sheji']]['fenggename']=$v1['fenggename'];//，
		$shejishis['s'.$v1['star_sort']]['p'.$v1['home_pos_sheji']]['home_cover_sheji_pic']=$v1['home_cover_sheji_pic'];//设计师案例图，
	    }
	}
//	var_dump($stars);
	$this->assign('shejishis',$shejishis);//列表 
	 
	//案例风格
	$_sql ="select DISTINCT r.evalue,r.ename from ot_sys_enum_fengge r where r.ename not like '%其他%' and r.`isvalid`>0 ORDER BY r.disorder";
	$anlifengges = M()->query($_sql);
	$this->assign("anlifengges",$anlifengges);
	
	//设计师职位
	$_sql ="select DISTINCT r.evalue,r.ename from ot_document_shejishi s,ot_document d,ot_sys_enum_rank r where s.aid=d.id and s.rank=r.evalue and d.`status`>0 ORDER BY r.disorder";
	$ranks = M()->query($_sql);
	$this->assign("ranks",$ranks);
	
	
	//查询热装楼盘列表
	$mapl['status']='1';
	$mapl['ltype']='2';  //热装楼盘
	$lists_rzloupan1=D("LoupanView")->where($mapl)->order("level desc")->limit("0,12")->select(); 
	$str = "";
	foreach ($lists_rzloupan1 as $rk=>$rv){
	    $lists_rzloupan1[$rk]['anli_num']=0;
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
				}else{
					$lists_rzloupan1[$rk]['custnum']=$av['count']+$lists_rzloupan1[$rk]['custnum'];
				} 
		    }
		}
	    }
	}
	//
	$rzlp1=$rzlp2=$rzlp3=null;
	for($item=0;$item<count($lists_rzloupan1);$item++){
	    if($item<4){
		$rzlp1[]=$lists_rzloupan1[$item];
	    }else if($item<8){
		$rzlp2[]=$lists_rzloupan1[$item];
	    }else{
		$rzlp3[]=$lists_rzloupan1[$item];
	    }
	}
	unset($lists_rzloupan1);
	
        $this->assign('rzlp1',$rzlp1);//列表
        $this->assign('rzlp2',$rzlp2);//列表
        $this->assign('rzlp3',$rzlp3);//列表
		
	
	//查询新闻
	$mapf['status']=1;
	$mapf['ftype']='4';
	$lists_news1=D("ArticleView")->where($mapf)->order("create_time desc,level")->limit("4")->select();
	//查询装修知识 
	$mapf['ftype']='5';
	$lists_news3=D("ArticleView")->where($mapf)->order("create_time desc,level")->limit("5")->select(); 
        $this->assign('lists_news3',$lists_news3);//列表
	//查询工地报道 
	$mapf['ftype']='6';
	$lists_news2=D("ArticleView")->where($mapf)->order("create_time desc,level")->limit("4")->select();
        $this->assign('lists_news1',$lists_news1);//列表
        $this->assign('lists_news2',$lists_news2);//列表
	
	//重点推荐的一篇文章
	$tuijian= M()->query("select a.id,d.title,d.description from ot_document d,ot_document_article a where d.id=a.id and a.home_tj=1 ORDER BY a.id DESC LIMIT 1");
	
	$news_tj=($tuijian[0])?$tuijian[0]:$lists_news1[0];
	 $this->assign('news_tj',$news_tj);//推荐新闻
	 	
        //var_dump($lists_news2);die;    
        $this->display();
    }

	//系统首页
    public function index1(){
	
	
//        $category = D('Category')->getTree();
//        $lists    = D('Document')->lists(null);
//
//        $this->assign('category',$category);//栏目
//        $this->assign('lists',$lists);//列表
//        $this->assign('page',D('Document')->page);//分页
//	echo C('URL_MODEL')."<br>";
//	echo U('Index/index',array('id'=>'1'));die;
	
	$site = "http://".$_SERVER['SERVER_NAME'];
	$this->assign("site",$site);
	
	//查询装修案例 
	$map['status']=array("gt",'-1');  //现代简约风格
	$map['home_pos']=array("gt",'0');  //首页位置显示
	$map['home_cover']=array("gt",'0');  //图片存在 
//	$lists_anli1=D("AnliView")->where($map)->order("home_sort,level desc")->limit("100")->select();
	$_sql ="select d.title dtitle,a.id,a.mianji,f.ename fenggename,a.loupan,a.home_pos,a.home_sort,p.path picpath from ot_document_anli a 
LEFT JOIN ot_sys_enum_fengge f on a.fengge= f.evalue
LEFT JOIN ot_picture p on a.home_cover=p.id ,ot_document d
where d.id=a.id and a.home_pos in (1,2,3,4,5,6) and a.home_sort in(1,2,3) order by a.home_sort limit 30";
	$lists_anli1 =M()->query($_sql); 
        //$this->assign('lists_anli1',$lists_anli1);//列表
	//var_dump($lists_anli1);
	//获取1~10位置图片
	foreach ($lists_anli1 as $key=>$val){ 
	    if(in_array($val['home_pos'], array(1,2,3,4,5,6)) && in_array($val['home_sort'], array(1,2,3))){
		$pic['s'.$val['home_sort']]['p'.$val['home_pos']]=(empty($pic['a'.$val['home_sort']]['p'.$val['home_pos']]))?$val:$pic['a'.$val['home_sort']]['p'.$val['home_pos']];  
	    }
	}	
	//var_dump($pic);
        $this->assign('pic',$pic); 
	
	
	//查询设计团队/之星
	$_sql = "select s.id,s.nickname,s.sno,s.linian,s.years,area.ename areaname,s.star_sort,rank.ename rankname,p1.path star_cover,p3.path pathinfo,anli.home_pos_sheji,anli.id aid,anli.mianji,anli.atitle,fengge.ename fenggename,anli.home_cover_sheji,p4.path home_cover_sheji_pic from ot_document_shejishi s 
		    LEFT JOIN ot_picture p1 on s.star_cover=p1.id
		    LEFT JOIN ot_sys_enum_rank rank on s.rank=rank.evalue 
		    LEFT JOIN ot_sys_enum_area area on s.area=area.evalue 
		    LEFT JOIN ot_document_anli anli on s.sno=anli.shejishi and anli.home_pos_sheji in(2,3,5,6) and anli.home_cover_sheji>0 
		    LEFT JOIN ot_picture p4 on anli.home_cover_sheji = p4.id 
		    LEFT JOIN ot_sys_enum_fengge fengge on anli.fengge = fengge.evalue  
		    ,ot_document d
		    LEFT JOIN ot_picture p3 on d.cover_id=p3.id
		    where s.id=d.id
		    and d.`status`=1 and s.star_sort in(1,2,3) ORDER BY star_sort,anli.home_pos_sheji LIMIT 30";
	$stars_temp =M()->query($_sql);
	//循环查询结果，组装数组
	$shejishis = array();
	foreach($stars_temp as $k1=>$v1){
	    if($v1['id'] && $v1['star_sort'] && $v1['home_pos_sheji']){ 
		//如果设计师不同，则之前的设计师信息清除
		if($shejishis['s'.$v1['star_sort']]['p1']['id'] && $shejishis['s'.$v1['star_sort']]['p1']['id']!=$v1['id']){
		    unset($shejishis['s'.$v1['star_sort']]);
		}
		$shejishis['s'.$v1['star_sort']]['p1']['id']=$v1['id'];//设计师id，
		$shejishis['s'.$v1['star_sort']]['p1']['sno']=$v1['sno'];//设计师编号，
		$shejishis['s'.$v1['star_sort']]['p1']['nickname']=$v1['nickname'];//设计师id，
		$shejishis['s'.$v1['star_sort']]['p1']['years']=$v1['years'];//
		$shejishis['s'.$v1['star_sort']]['p1']['areaname']=$v1['areaname'];//
		$shejishis['s'.$v1['star_sort']]['p1']['linian']=$v1['linian'];//设计师编号，
		$shejishis['s'.$v1['star_sort']]['p1']['rankname']=$v1['rankname'];//设计师职称，
		$shejishis['s'.$v1['star_sort']]['p1']['star_cover']=$v1['star_cover'];//设计师之星头像，
		$shejishis['s'.$v1['star_sort']]['p1']['pathinfo']=$v1['pathinfo'];//设计师默认头像，
		$shejishis['s'.$v1['star_sort']]['p'.$v1['home_pos_sheji']]['aid']=$v1['aid'];//设计师推荐案例编号，
		$shejishis['s'.$v1['star_sort']]['p'.$v1['home_pos_sheji']]['atitle']=$v1['atitle'];//设计师推荐案例名称，
		$shejishis['s'.$v1['star_sort']]['p'.$v1['home_pos_sheji']]['mianji']=$v1['mianji'];//，
		$shejishis['s'.$v1['star_sort']]['p'.$v1['home_pos_sheji']]['fenggename']=$v1['fenggename'];//，
		$shejishis['s'.$v1['star_sort']]['p'.$v1['home_pos_sheji']]['home_cover_sheji_pic']=$v1['home_cover_sheji_pic'];//设计师案例图，
	    }
	}
//	var_dump($stars);
	$this->assign('shejishis',$shejishis);//列表 
	 
	//案例风格
	$_sql ="select DISTINCT r.evalue,r.ename from ot_sys_enum_fengge r where r.ename not like '%其他%' and r.`isvalid`>0 ORDER BY r.disorder";
	$anlifengges = M()->query($_sql);
	$this->assign("anlifengges",$anlifengges);
	
	//设计师职位
	$_sql ="select DISTINCT r.evalue,r.ename from ot_document_shejishi s,ot_document d,ot_sys_enum_rank r where s.aid=d.id and s.rank=r.evalue and d.`status`>0 ORDER BY r.disorder";
	$ranks = M()->query($_sql);
	$this->assign("ranks",$ranks);
	
	
	//查询热装楼盘列表
	$mapl['status']='1';
	$mapl['ltype']='2';  //热装楼盘
	$lists_rzloupan1=D("LoupanView")->where($mapl)->order("level desc")->limit("0,12")->select(); 
	$str = "";
	foreach ($lists_rzloupan1 as $rk=>$rv){
	    $lists_rzloupan1[$rk]['anli_num']=0;
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
				}else{
					$lists_rzloupan1[$rk]['custnum']=$av['count']+$lists_rzloupan1[$rk]['custnum'];
				} 
		    }
		}
	    }
	}
	//
	$rzlp1=$rzlp2=$rzlp3=null;
	for($item=0;$item<count($lists_rzloupan1);$item++){
	    if($item<4){
		$rzlp1[]=$lists_rzloupan1[$item];
	    }else if($item<8){
		$rzlp2[]=$lists_rzloupan1[$item];
	    }else{
		$rzlp3[]=$lists_rzloupan1[$item];
	    }
	}
	unset($lists_rzloupan1);	
        $this->assign('rzlp1',$rzlp1);//列表
        $this->assign('rzlp2',$rzlp2);//列表
        $this->assign('rzlp3',$rzlp3);//列表
		
	
	//查询新闻
	$mapf['status']=1;
	$mapf['ftype']='4';
	$lists_news1=D("ArticleView")->where($mapf)->order("create_time desc,level")->limit("4")->select();
	//查询装修知识 
	$mapf['ftype']='5';
	$lists_news3=D("ArticleView")->where($mapf)->order("create_time desc,level")->limit("12")->select(); 
        $this->assign('lists_news3',$lists_news3);//列表
	//查询工地报道 
	$mapf['ftype']='6';
	$lists_news2=D("ArticleView")->where($mapf)->order("create_time desc,level")->limit("4")->select();
        $this->assign('lists_news1',$lists_news1);//列表
        $this->assign('lists_news2',$lists_news2);//列表
	
	//重点推荐的一篇文章
	$tuijian= M()->query("select a.id,d.title,d.description from ot_document d,ot_document_article a where d.id=a.id and a.home_tj=1 ORDER BY a.id DESC LIMIT 1");
	
	$news_tj=($tuijian[0])?$tuijian[0]:$lists_news1[0];
	 $this->assign('news_tj',$news_tj);//推荐新闻
	 	
        //var_dump($lists_news2);die;    
        $this->display();
    }

	//系统首页
    public function test(){
		
	if(empty($rzlp1)){
	    $rzlp1=array(
		"0"=>array("id"=>1,"picpath"=>"/Public/Home/images/loupan/loupan01.jpg","dtitle"=>"高鑫","custnum"=>5),
		"1"=>array("id"=>2,"picpath"=>"/Public/Home/images/loupan/loupan02.jpg","dtitle"=>"十里长汀","custnum"=>15),
		"2"=>array("id"=>3,"picpath"=>"/Public/Home/images/loupan/loupan03.jpg","dtitle"=>"高鑫","custnum"=>5),
		"3"=>array("id"=>4,"picpath"=>"/Public/Home/images/loupan/loupan04.jpg","dtitle"=>"高鑫","custnum"=>3),
		"4"=>array("id"=>5,"picpath"=>"/Public/Home/images/loupan/loupan05.jpg","dtitle"=>"高鑫","custnum"=>14),
		"5"=>array("id"=>6,"picpath"=>"/Public/Home/images/loupan/loupan06.jpg","dtitle"=>"高鑫","custnum"=>5),
		"6"=>array("id"=>7,"picpath"=>"/Public/Home/images/loupan/loupan07.jpg","dtitle"=>"高鑫","custnum"=>55),
		"7"=>array("id"=>8,"picpath"=>"/Public/Home/images/loupan/loupan08.jpg","dtitle"=>"高鑫","custnum"=>5),
	    );
	}
        $this->assign('rzlp1',$rzlp1);//列表
        $this->display();
    }
}