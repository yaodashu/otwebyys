<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Api\Controller;
use Think\Controller;

/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用分组名称
 */
class ResearchController extends Controller {
    
	public $errcode; //错误定义
    
	/* 空操作，用于输出404页面 */
	public function _empty(){
		$this->redirect('Index/index');
	}

	/**
	 * 
	* errcode：100 成功
	* errcode：-105 记录不存在
	* errcode：-104 配置信息错误
	* errcode：-103 重复提交
	* errcode：-102 数据参数错误
	* errcode：-101 验证失败
	* errcode：-100 数据写入错误
	 */
	protected function _initialize(){
	    $this->errcode["succ"]=array("errcode"=>"100","errmsg"=>"SUCCESS","errmsg_en"=>"SUCCESS"); //错误定义
	    $this->errcode["dataempty"]=array("errcode"=>"-105","errmsg"=>"记录不存在","errmsg_en"=>"query is empty");
	    $this->errcode["configerr"]=array("errcode"=>"-104","errmsg"=>"配置错误","errmsg_en"=>"config error");
	    $this->errcode["repeat"]=array("errcode"=>"-103","errmsg"=>"重复提交","errmsg_en"=>"data repeat");
	    $this->errcode["paramerr"]=array("errcode"=>"-102","errmsg"=>"参数错误","errmsg_en"=>"param error");
	    $this->errcode["checkfail"]=array("errcode"=>"-101","errmsg"=>"检查失败","errmsg_en"=>"check failed");
	    $this->errcode["datafail"]=array("errcode"=>"-100","errmsg"=>"数据操作失败","errmsg_en"=>"database failed");
		
	    /* 读取站点配置 */
	    $config = api('Config/lists');
	    C($config); //添加配置 
	    
		
	}
	
	/**
	 * http://yatai.dasn.com.cn/index.php/api/Research/questadd/name/余/loupan/东方芙蓉/dong/17栋/qid/1::问题1的答案1, 问题1的答案2$$2::问题2的答案1$$3::问题3的答案1, 问题3的答案2
	 */
	public function questadd(){
	     		 
		
		//$input = file_get_contents('php://input'); //接收POST消息
	
		// file_put_contents('./Runtime/Researchyt.log', microtime().":接收文档调查请求开始，时间：".date("Y-m-d H:i:s",time()).":请求参数input：".input.";\r\n", FILE_APPEND|LOCK_EX);
		 file_put_contents('./Runtime/Researchyt.log', microtime().":接收文档调查请求开始，时间：".date("Y-m-d H:i:s",time()).":请求参数：".json_encode($_REQUEST).";\r\n", FILE_APPEND|LOCK_EX);
		 
		 
	    
		$_REQUEST['name']= urldecode($_REQUEST['name']);
		$_REQUEST['loupan']= urldecode($_REQUEST['loupan']);
		$_REQUEST['dong']= urldecode($_REQUEST['dong']);
		$_REQUEST['qid']= urldecode($_REQUEST['qid']);
		//$_REQUEST['answer']= trim($_REQUEST['answer']);
		$name = trim($_REQUEST['name']);
		$loupan = trim($_REQUEST['loupan']);
		$dong = trim($_REQUEST['dong']);
		$qid = trim($_REQUEST['qid']);
		
		//file_put_contents('./Runtime/Researchyt.log', microtime().":接收到参数name-loupan-dong-qid：".$name."-".$loupan."-".$dong."-".$qid.";\r\n", FILE_APPEND|LOCK_EX);

		$encode = mb_detect_encoding($name, array('ASCII','GB2312','GBK','UTF-8')); 
		if(in_array(strtoupper($encode), array('CP936','GB2312','EUC-CN'))){	    
		}else{
			$name = iconv('GB2312', 'UTF-8', $name);
		}
		$encode = mb_detect_encoding($loupan, array('ASCII','GB2312','GBK','UTF-8')); 
		if(in_array(strtoupper($encode), array('CP936','GB2312','EUC-CN'))){	    
		}else{
			$loupan = iconv('GB2312', 'UTF-8', $loupan);
		}
		$encode = mb_detect_encoding($dong, array('ASCII','GB2312','GBK','UTF-8')); 
		if(in_array(strtoupper($encode), array('CP936','GB2312','EUC-CN'))){	    
		}else{
			$dong = iconv('GB2312', 'UTF-8', $dong);
		}
		$encode = mb_detect_encoding($qid, array('ASCII','GB2312','GBK','UTF-8')); 
		if(in_array(strtoupper($encode), array('CP936','GB2312','EUC-CN'))){	    
		}else{
			//$qid = iconv('GB2312', 'UTF-8', $qid);
		}
		
		
		//$answer = trim($_REQUEST['answer']);
	       if(empty($name)){
		   die(json_encode(array("errcode"=>$this->errcode["paramerr"]['errcode'],"errmsg"=> "姓名".$this->errcode["paramerr"]['errmsg'],"errmsg_en"=> "name ".$this->errcode["paramerr"]['errmsg_en']))); 	     
		}; 
	       if(empty($loupan)){
		   die(json_encode(array("errcode"=>$this->errcode["paramerr"]['errcode'],"errmsg"=> "楼盘".$this->errcode["paramerr"]['errmsg'],"errmsg_en"=> "loupan ".$this->errcode["paramerr"]['errmsg_en']))); 	     
		}; 
	       if(empty($dong)){
		   die(json_encode(array("errcode"=>$this->errcode["paramerr"]['errcode'],"errmsg"=> "楼栋".$this->errcode["paramerr"]['errmsg'],"errmsg_en"=> "dong ".$this->errcode["paramerr"]['errmsg_en']))); 	     
		}; 
	       if(empty($qid)){
		   die(json_encode(array("errcode"=>$this->errcode["paramerr"]['errcode'],"errmsg"=> "问题号".$this->errcode["paramerr"]['errmsg'],"errmsg_en"=> "question ".$this->errcode["paramerr"]['errmsg_en']))); 	     
		}; 
//	       if(empty($_REQUEST['answer'])){
//		   die(json_encode(array("errcode"=>$this->errcode["paramerr"]['errcode'],"errmsg"=> "答案".$this->errcode["paramerr"]['errmsg'],"errmsg_en"=> "answer ".$this->errcode["paramerr"]['errmsg_en']))); 	     
//		}; 

	    //file_put_contents('./Runtime/Researchyt.log', microtime().":接收到参数name-loupan-dong-qid：".$name."-".$loupan."-".$dong."-".$qid.";\r\n", FILE_APPEND|LOCK_EX);

		//先查询用户表是否存在，如果不存在则先添加用户
		$custdata = array("name"=>$name,"loupan"=>$loupan,"dong"=>$dong);
		$customer_data = M("customer")->where($custdata)->find();
		if(empty($customer_data)){
			$str = json_encode(array("name"=>$name,"loupan"=>$loupan,"dong"=>$dong));
			//echo $str;die;
			file_put_contents('./Runtime/Researchyt.log', microtime().":添加用户信息：".$str.";\r\n", FILE_APPEND|LOCK_EX);
		  
			$custdata['id'] =  M("customer")->add($custdata);
		}else{
		    $custdata = $customer_data;
		}
		if(empty($custdata['id'])){
		   die(json_encode(array("errcode"=>$this->errcode["datafail"]['errcode'],"errmsg"=> "用户信息".$this->errcode["datafail"]['errmsg'],"errmsg_en"=> "customer ".$this->errcode["datafail"]['errmsg_en']))); 
		}
		
//		//查询问题编号
//		$quest_data = M("research_quest")->where(array("qid"=>$qid))->find();
//		if(empty($quest_data['id'])){
//		   die(json_encode(array("errcode"=>$this->errcode["dataempty"]['errcode'],"errmsg"=> "问题".$this->errcode["dataempty"]['errmsg'],"errmsg_en"=> "question ".$this->errcode["dataempty"]['errmsg_en']))); 
//		}
		//qid/1::问题1的答案1, 问题1的答案2$$2::问题2的答案1$$3::问题3的答案1, 问题3的答案2
		//1、分离得到问题和答案列表；2、答案和问题列表分开得到问题编号组
		$quests = explode("$$", $qid);
		$questids ="";
		$is_valid_quest = false;
		foreach ($quests as $v){
		    $quests_array = null;
		   $quests_array = explode("::", $v);
		   $questids =$questids.",".$quests_array[0];
		   if($quests_array[1]){
		       $is_valid_quest=true;
		   }
		}		
		if(!$is_valid_quest){
		   die(json_encode(array("errcode"=>$this->errcode["paramerr"]['errcode'],"errmsg_en"=> "question ".$this->errcode["paramerr"]['errmsg_en']))); 			    
		}
		
		//写入问卷纪录
		$answerdata = array("custid"=>$custdata['id'],"questid"=>$questids,"questanswer"=>$qid);
		
		//查询相同问题答卷是否存在
		$answer =  M("research_answer")->where($answerdata)->find();
		if($answer){			
		  $json = json_encode(array("errcode"=>$this->errcode["repeat"]['errcode']));
		 
	      file_put_contents('./Runtime/Researchyt.log', microtime().":返回结果：".$json.";\r\n", FILE_APPEND|LOCK_EX);
		  die(json_encode(array("errcode"=>$this->errcode["repeat"]['errcode'])));   
		}else{	
		     $custdata_c = array("custid"=>$custdata['id']);
		     $answercust =  M("research_answer")->where($custdata_c)->find();
		    if($answercust){
			$booa =  M("research_answer")->where(array("id"=>$answercust['id']))->save($answerdata);
		    }else{			
			$answerdata['createtime']= time();
			$booa =  M("research_answer")->add($answerdata);
		    } 
		}
		if($booa){ 
		       $result = array("errcode"=>$this->errcode["succ"]['errcode'],"errmsg_en"=> $this->errcode["succ"]['errmsg_en']);
		       die(json_encode($result)); 
		   }else{
		       die(json_encode(array("errcode"=>$this->errcode["datafail"]['errcode'],"errmsg_en"=> $this->errcode["datafail"]['errmsg_en']))); 
		   }  
		die; 
	}
	/**
	 * 订单查询接口
	 */
	public function questquery(){
	     
		 //file_put_contents('./Runtime/Researchyt.log', microtime().":查询请求开始，时间：".date("Y-m-d H:i:s",time()).":请求参数：".json_encode($_REQUEST).";\r\n", FILE_APPEND|LOCK_EX);
		 
		$_REQUEST['name']= urldecode($_REQUEST['name']);
		$_REQUEST['loupan']= urldecode($_REQUEST['loupan']);
		$_REQUEST['dong']= urldecode($_REQUEST['dong']);
		
		$name = trim($_REQUEST['name']);
		$loupan = trim($_REQUEST['loupan']);
		$dong = trim($_REQUEST['dong']);
		
		$encode = mb_detect_encoding($name, array('ASCII','GB2312','GBK','UTF-8')); 
		if(in_array(strtoupper($encode), array('CP936','GB2312','EUC-CN'))){	    
		}else{
			$name = iconv('GB2312', 'UTF-8', $name);
		}
		$encode = mb_detect_encoding($loupan, array('ASCII','GB2312','GBK','UTF-8')); 
		if(in_array(strtoupper($encode), array('CP936','GB2312','EUC-CN'))){	    
		}else{
			$loupan = iconv('GB2312', 'UTF-8', $loupan);
		}
		$encode = mb_detect_encoding($dong, array('ASCII','GB2312','GBK','UTF-8')); 
		if(in_array(strtoupper($encode), array('CP936','GB2312','EUC-CN'))){	    
		}else{
			$dong = iconv('GB2312', 'UTF-8', $dong);
		} 
		
		
		$condition ="";
		if(!empty($name)){
		    $condition = $condition . " and c.name like '%".$name."%'";
		}
		if(!empty($loupan)){
		    $condition = $condition . " and c.loupan like '%".$loupan."%'";
		}
		if(!empty($dong)){
		    $condition = $condition . " and c.dong like '%".$dong."%'";
		}
		//页码参数
		$pno =(trim($_REQUEST['pno']) && is_numeric(trim($_REQUEST['pno'])))?intval($_REQUEST['pno']):1; 
		$psize =(trim($_REQUEST['psize']) && is_numeric(trim($_REQUEST['psize'])))?intval($_REQUEST['psize']):50; 
		$start = ($pno-1) * $psize; 
		
		
		//查询结果
		$lists = M()->query("select c.`name`,c.loupan,c.dong,a.id yid,a.questanswer,createtime from ot_research_answer a LEFT JOIN ot_customer c on a.custid=c.id where 1 {$condition} order by a.id desc limit {$start},{$psize}");
		$list_count =M()->query("Select count(DISTINCT a.id) count from ot_research_answer a LEFT JOIN ot_customer c on a.custid=c.id LEFT JOIN ot_research_quest q on a.questid=q.id where 1 {$condition} ");
				
		if($lists){
		    $count = count($lists);
		     die(json_encode(array("errcode"=>$this->errcode["succ"]['errcode'],"errmsg"=> $this->errcode["succ"]['errmsg'],"errmsg_en"=> $this->errcode["succ"]['errmsg_en'],"total"=>$list_count[0]['count'],"num"=>$count,"data"=>$lists)));   
		}else{
		  die(json_encode(array("errcode"=>$this->errcode["dataempty"]['errcode'],"errmsg"=> $this->errcode["dataempty"]['errmsg'],"errmsg_en"=> $this->errcode["dataempty"]['errmsg_en'])));   
		} 
		
	}
	
	/**
	 * 订单查询接口
	 */
	public function questuser(){
	     
		 //file_put_contents('./Runtime/Researchyt.log', microtime().":查询请求开始，时间：".date("Y-m-d H:i:s",time()).":请求参数：".json_encode($_REQUEST).";\r\n", FILE_APPEND|LOCK_EX);
		 
		$_REQUEST['uname']= urldecode($_REQUEST['uname']); 
		
		$name = trim($_REQUEST['uname']); 
		if(empty($name)){
		  die(json_encode(array("errcode"=>$this->errcode["paramerr"]['errcode'],"errmsg_en"=> $this->errcode["paramerr"]['errmsg_en'])));   
		}
		
		$encode = mb_detect_encoding($name, array('ASCII','GB2312','GBK','UTF-8')); 
		if(in_array(strtoupper($encode), array('CP936','GB2312','EUC-CN'))){	    
		}else{
			$name = iconv('GB2312', 'UTF-8', $name);
		} 
		
		
		$condition ="";
		if(!empty($name)){
		    $condition = $condition . " and a.username = '".$name."'";
		} 
		//页码参数
		$pno =(trim($_REQUEST['pno']) && is_numeric(trim($_REQUEST['pno'])))?intval($_REQUEST['pno']):1; 
		$psize =(trim($_REQUEST['psize']) && is_numeric(trim($_REQUEST['psize'])))?intval($_REQUEST['psize']):50; 
		$start = ($pno-1) * $psize; 
		
		
		//查询结果
		$lists = M()->query("select * from ot_docuser a where 1 {$condition} order by a.id desc limit {$start},{$psize}");
		$list_count =M()->query("Select count(DISTINCT a.id) count from ot_docuser a where 1 {$condition} ");
				
		if($lists){
		    $count = count($lists);
		     die(json_encode(array("errcode"=>$this->errcode["succ"]['errcode'],"errmsg"=> $this->errcode["succ"]['errmsg'],"errmsg_en"=> $this->errcode["succ"]['errmsg_en'],"pwd"=>$lists[0]['pwd'])));   
		}else{
		  die(json_encode(array("errcode"=>$this->errcode["dataempty"]['errcode'],"errmsg"=> $this->errcode["dataempty"]['errmsg'],"errmsg_en"=> $this->errcode["dataempty"]['errmsg_en'])));   
		} 
		
	}
	
	
	//测使问题提交功能接口
	public function addtest(){
	    
	    //查询结果
	    $lists = M()->query("select c.`name`,c.`loupan`,c.`dong`,a.questanswer,createtime from ot_research_answer a LEFT JOIN ot_customer c on a.custid=c.id where 1 order by a.id desc limit 100");

	    foreach ($lists as $k=>$v){
		$lists[$k]['createtime']=date("Y-m-d H:i:s",$v['createtime']);
	    }
	    $this->assign("lists", $lists);
	
          $this->display();	    
	}

}
