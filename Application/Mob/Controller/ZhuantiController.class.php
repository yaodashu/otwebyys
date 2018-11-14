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
class ZhuantiController extends HomeController {

	//工艺
    public function index(){
	$url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=11";
	$contents=file_get_contents($url);
	if(empty($contents)){
	    $contents=301;
	}else{
	    if($contents>300){
		$contents=$contents - 201;
	    }
	}
	$this->assign("renshu",$contents);
	
        $this->display();
    }
    
	//报价
    public function baojia(){
	$url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=50";
	$contents=file_get_contents($url); 
	if(empty($contents)){
	    $contents=1101;
	}else{
	    if($contents<1000){
		$temp = $contents/1000;
		$contents=$contents + $temp;
	    }
	}
	$this->assign("renshu",$contents);
	
	$_sql = "SELECT anli.*,f.ename fenggename,d.title dtitle,p.path picpath FROM ot_document_anli anli LEFT JOIN ot_sys_enum_fengge f on anli.fengge=f.evalue,ot_document d LEFT JOIN ot_picture p on d.cover_id=p.id 
		    WHERE anli.id=d.id and d.`status`>0 ORDER BY anli.mobilesort desc LIMIT 4";
	$lists_anli1 = M()->query($_sql);
        $this->assign('lists_anli1',$lists_anli1);//列表
	
//	$lists_anli1=D("AnliView")->where(array("status"=>1))->order("level desc")->limit("4")->select();  
//	$this->assign("lists_anli1",$lists_anli1);    
	
        $this->display();
    }
	//报价
    public function baojiazxfq(){
	$url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=50";
	$contents=file_get_contents($url); 
	if(empty($contents)){
	    $contents=1101;
	}else{
	    if($contents<1000){
		$temp = $contents/1000;
		$contents=$contents + $temp;
	    }
	}
	$this->assign("renshu",$contents);
	 
	
        $this->display();
    }
	//工艺
    public function gongyi(){
	
        $this->display();
    }
	//品牌
    public function brand(){
	
        $this->display();
    }
	//工艺
    public function jiazhuangjie(){
	$url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=11";
	$contents=file_get_contents($url);
	if(empty($contents)){
	    $contents=301;
	}else{
	    if($contents>300){
		$contents=$contents - 201;
	    }
	}
	$this->assign("renshu",$contents);
	
        $this->display();
    }
	//工艺
    public function ganen(){
	$url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=15&time=".date("Y-m-d",time());
	if(empty($contents) || intval($contents)<=0){
	    $contents=95;
	}else{  
	   if($contents>95){
	    $contents = $contents%95;
	   } 
	   $contents = 95-$contents;
	}
	if($contents<40){
	    $contents = $contents+40;
	}
	$this->assign("renshu",$contents);
	
        $this->display();
    }
	//工艺
    public function kaimenhong(){
	$url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=17&time=".date("Y-m-d",time());
	$contents=file_get_contents($url); 
	if(empty($contents) || intval($contents)<=0){
	    $contents=95;
	}else{  
	   if($contents>95){
	    $contents = $contents%95;
	   } 
	   $contents = 95-$contents;
	}
	if($contents<40){
	    $contents = $contents+40;
	}
	$this->assign("renshu",$contents);
	
        $this->display();
    }
	//工艺
    public function shejiqushi(){
	$url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=26&time=".date("Y-m-d",time());
	$contents=file_get_contents($url);
	if(empty($contents)){
	   $contents=95;
       }else{  
	   $diffday = round((time()-strtotime("2017-12-29"))/86400);
	   $contents= 500-$contents+$diffday*20;
       //		 $contents=$contents-1520; 
       }
       if($contents>100){
	   $contents = intval($contents/100);
       }
       if($contents<20){
	   $contents = $contents+20;
       }
	$this->assign("renshu",$contents);
	
        $this->display();
    }
	//常规全房专题
    public function vr720(){
	$url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=36&time=".date("Y-m-d",time());
	$contents=file_get_contents($url); 
	if(empty($contents) || intval($contents)<=0){
	    $contents=95;
	}else{  
	   if($contents>95){
	    $contents = $contents%95;
	   } 
	   $contents = 95-$contents;
	}
	if($contents<40){
	    $contents = $contents+40;
	}
	$this->assign("renshu",$contents);
	
        $this->display();
    }
	//常规全房专题
    public function quanfang(){
	$url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=41&time=".date("Y-m-d",time());
	$contents=file_get_contents($url);
	if(empty($contents) || intval($contents)<=0){
	    $contents=95;
	}else{  
	   if($contents>95){
	    $contents = $contents%95;
	   } 
	   $contents = 95-$contents;
	}
	if($contents<40){
	    $contents = $contents+40;
	}
	$this->assign("renshu",$contents);
	
        $this->display();
    }
	//特权日
    public function tequanri(){
	$url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=6&time=".date("Y-m-d",time());
	$contents=file_get_contents($url); 
	if(empty($contents) || intval($contents)<=0){
	    $contents=95;
	}else{  
	   if($contents>95){
	    $contents = $contents%95;
	   } 
	   $contents = 95-$contents;
	}
	if($contents<40){
	    $contents = $contents+40;
	}
	$this->assign("renshu",$contents);
	
        $this->display();
    }
    public function zhounianqing(){
	    $url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=8&time=".date("Y-m-d",time());
	    $contents=file_get_contents($url);
	     		  
	    if(empty($contents)){
		$contents=095;
	    }else{  
//		$diffday = round((time()-strtotime("2017-11-17"))/86400); 
//		$contents= 1980-$contents+$diffday*16;
//		 $contents=$contents-1520; 
	    }
		//判断是上午还是下午
		//echo date("H",time());
		if(intval(date("H",time()))<13){
		      $contents= 200- $contents;
			if($contents<60){
			$contents = $contents+60;
			}			
		}else{
		      $contents= 100- $contents;
			if($contents<30){
			$contents = $contents+30;
		}
	    }
	$this->assign("renshu",$contents);
	
        $this->display();
    }

}