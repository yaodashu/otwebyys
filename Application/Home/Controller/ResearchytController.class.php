<?php 

namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class ResearchytController extends HomeController {

    public $pageSize; 
	public $days;
    protected function _initialize() {
	parent::_initialize();
	$this->pageSize=20; 
	   
	$this->days =date("Ymd",time());
    }
	//问卷调查列表-亚太
    public function index(){
	
	if($_REQUEST['otype']=="checkkey"){ 
	    if($_REQUEST['key_val']=="yt123456"){
//		$_SESSION['key_research']="1";
		session('key_research',"2");
		die(json_encode(array("errcode"=>"1","errmsg"=>"ok")));
	    }else{
		die(json_encode(array("errcode"=>"0")));
	    }
	    
	}
//	$keys = $_SESSION['key_research'];
	$keys = session('key_research');
	$this->assign("keys",$keys);
	
	
	$keyword = $_REQUEST['keyword'];
	//cp936就是指系统里第936号编码格式，也就是GB2312。EUC-CN EUC-CN是GB2312最常用的表示方法。浏览器编码表上的“GB2312”，通常都是指“EUC-CN”表示法。
	//过程中本地笔记本是cp936不需要转码能正常显示
	$encode = mb_detect_encoding($keyword, array('ASCII','GB2312','GBK','UTF-8')); 
	if(in_array(strtoupper($encode), array('CP936','GB2312','EUC-CN'))){	    
	}else{
	    $keyword = iconv('GB2312', 'UTF-8', $keyword);
	}
	
	 //页码
	$pindex = max(1, intval($_REQUEST['p']));
	$psize  = $this->pageSize;
	$start = ($pindex-1)*$psize;
	
	//查询装修案例
	$map['custid']=array("gt",'0');  //客户信息存在
	$map['questanswer']=array("neq",'');  //答案存在	
	if($keyword){ 
	    $condition = "and ( c.name like '%{$keyword}%' or c.loupan like '%{$keyword}%' or c.dong like '%{$keyword}%')";
	}  
	
	$_sql = "select count(a.id) count from ot_research_answer a,ot_customer c where a.custid=c.id and a.questanswer!='' {$condition} "; 
	//echo $_sql; var_dump($counts);die;
	$counts =M()->query($_sql);
	$count =$counts[0]['count'];	  
	
	$page =new \Think\Page($count,$this->pageSize);
	$start = $page->firstRow;
	$psize = $page->listRows;
	  
	$lists=M()->query("select c.name,c.loupan,c.dong,a.* from ot_research_answer a,ot_customer c where a.custid=c.id and a.questanswer!='' {$condition} order by a.createtime desc limit ".$start.",".$psize); 
	 
        $this->assign('lists',$lists);//列表
        $this->assign('count',$count);//列表
        $this->assign('keyword',$keyword);//列表
                 
	//设置分页主题，如果没有这个设置，页面上不会显示有多少个记录
	$page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
	//将分页显示到前端
	$str_page = $page->show();
	$this->assign("_page",$str_page);
	
        $this->display();
    }
        
	//问卷调查-亚太
    public function detail(){
	
	$id = $_REQUEST['id'];
	 if(empty($id)){
	     //检查输入姓名等条件
		 $_REQUEST['name']= trim(urldecode($_REQUEST['name']));
		$_REQUEST['loupan']= trim(urldecode($_REQUEST['loupan']));
		$_REQUEST['dong']= trim(urldecode($_REQUEST['dong']));
		
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
		 
		 
	     if(!empty($name) && !empty($loupan) && !empty($dong) ){
		   $condition = "and ( c.name = '{$name}' and c.loupan = '{$loupan}' and c.dong = '{$dong}')";
	     }
	     
	 }else{
	     $condition= " and a.id=".$id;
	 } 
	  file_put_contents('./Runtime/Researchyt'.$this->days.'.log', microtime().":查询档案用户答卷，时间：".date("Y-m-d H:i:s",time()).":查询条件：". $condition.";\r\n", FILE_APPEND|LOCK_EX);
		
	 if(empty($condition)){
	     redirect("/index.php/home/researchyt/index");
	 }
	 $_sql = "select c.name,c.loupan,c.dong,a.* from ot_research_answer a,ot_customer c where a.custid=c.id and a.questanswer!='' {$condition} limit 1";
	  
	  file_put_contents('./Runtime/Researchyt'.$this->days.'.log', microtime().":查询档案用户答卷，时间：".date("Y-m-d H:i:s",time()).":查询语句：". $_sql.";\r\n", FILE_APPEND|LOCK_EX);
		
	 $data=M()->query($_sql); 
	 $custdata = $data[0];
	 //拆分解析答案：
	 $results = array();
	 if($custdata['questanswer']){
	     //1、得到题目列表
	     $answer_arr1= explode("$$", $custdata['questanswer']);
	     foreach ($answer_arr1 as $k=> $g){
		 //2、的问题编号和答案字串
		 $answer_arr2 = explode("::", $g);
		 $results[$answer_arr2[0]]=array("qid"=>$answer_arr2[0],"qstr"=> $answer_arr2[1],"answers"=> explode("||", $answer_arr2[1]));
	     }
	 }
	// var_dump($results);die;
	 
	 
	 //查询问题列表
	 $part1 = M("research_quest")->where(array("actid"=>1,"cate1"=>"系统设备部分"))->order("ssort desc")->select();
	 $part2_group = M()->query("select DISTINCT cate2 from ot_research_quest q,ot_research_cate2 c2 where q.cate2=c2.title and actid=1 and cate1='室内空间部分' order by c2.ssort desc");		 
//		 M("research_quest,")->field("DISTINCT cate2")->where(array("actid"=>1,"cate1"=>"室内空间部分"))->order("cate2")->select();
	 $part2 = M("research_quest")->where(array("actid"=>1,"cate1"=>"室内空间部分"))->order("ssort desc")->select();
	 $part3_group = M()->query("select DISTINCT cate2 from ot_research_quest q,ot_research_cate2 c2 where q.cate2=c2.title and actid=1 and cate1='室外空间部分' order by c2.ssort desc");	
	 $part3 = M("research_quest")->where(array("actid"=>1,"cate1"=>"室外空间部分"))->order("ssort desc")->select();
	 foreach ($part1 as $k=>$v){
	     foreach ($results as $rk=>$rv){
		if($v['qid']==$rv['qid']){
		    $part1[$k]['answers'] = $rv['answers'];
		}		 
	     }
	 }
	  foreach ($part2 as $k=>$v){
	     foreach ($results as $rk=>$rv){
		if($v['qid']==$rv['qid']){
		    $part2[$k]['answers'] = $rv['answers'];
		}		 
	     }
	 }
	 //var_dump($part2);die;
	  foreach ($part3 as $k=>$v){
	     foreach ($results as $rk=>$rv){
		if($v['qid']==$rv['qid']){
		    $part3[$k]['answers'] = $rv['answers'];
		}		 
	     }
	 }
	// var_dump($part1);die;
	 
        $this->assign('custdata',$custdata);//列表
        $this->assign('part1',$part1);//列表
        $this->assign('part2_group',$part2_group);//列表
        $this->assign('part2',$part2);//列表
        $this->assign('part3_group',$part3_group);//列表
        $this->assign('part3',$part3);//列表
                 
//	var_dump($part1);
        $this->display();
    }

}