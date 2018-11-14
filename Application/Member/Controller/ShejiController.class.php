<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: Zero Li <35714820@qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Member\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class ShejiController extends MemberController {
     public $pageSize; 
     public $current_user;
     protected function _initialize(){
        // 只有登录状态才能访问本页,验证登录.
        $this->is_login();
        // 调用用户API获取当前登录用户信息
        $current_user = callApi('User/getProfile'); 
	$this->pageSize=50;
	$this->current_user = $current_user;
        $this->assign('current_user', $current_user); 
        $this->assign('menuname', "sheji"); 
    }
    /**
     * 会员中心列表
     */
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
	
	//查询装修案例 
	//$map['status']='1';
	$map['uid']=$this->current_user['uid'];
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
	   $count=D("AnliView")->where("document.uid={$map['uid']} and (document.title like '%{$keyword}%' or document_anli.loupan like '%{$keyword}%' or document_shejishi.nickname like '%{$keyword}%' )")->count();
	}else{
	    $count=D("AnliView")->where($map)->count();
	}
	$page =new \Think\Pagedz($count,$this->pageSize);
	$start = $page->firstRow;
	$psize = $page->listRows;
	if($keyword){
	    //关键词搜索：案例名称、楼盘名称、设计师名字	    
	    $lists_data1=D("AnliView")->where("document.uid={$map['uid']} and (document.title like '%{$keyword}%' or document_anli.loupan like '%{$keyword}%' or document_shejishi.nickname like '%{$keyword}%' )")->order("level desc,document.id desc")->limit($start.",".$psize)->select(); 
	}else{
	    $lists_data1=D("AnliView")->where($map)->order("level desc,document.id desc")->limit($start.",".$psize)->select();  
	}
	//var_dump($lists_anli1);
	 
        $this->assign('lists',$lists_data1);//列表
        $this->assign('lists_count',$count);//列表
		
        $this->assign('lists',$lists_data1);//列表
        $this->assign('lists_count',$count);//列表
		
	$this->assign('keyword',$keyword);//
	//
	//设置分页主题，如果没有这个设置，页面上不会显示有多少个记录
	$page->setConfig('theme', '%HOMEPAGE% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %GOPAGE%');
	//将分页显示到前端
	$str_page = $page->show();
	$this->assign("_page",$str_page); 
	
	
        $this->display();
    }
    public function detail(){
	$id = $_REQUEST['id'];
	if (IS_POST) { //提交验证 
	// 
	    if(intval($id)>0){
		//查询会员信息
		$document_data=M("document")->where(array("id"=>$id))->find();  
		$documentanli_data=M("document_anli")->where(array("id"=>$id))->find();  
	    }
		$maxlevel_data=M("document")->field("id,level")->order("level desc")->find(); 
		$newlevel = intval($maxlevel_data['level'])+1;
		$add_document= array(
		    'uid'=>$this->current_user['uid'],
		    'category_id'=>41,
		    'model_id'=>12,
		    'type'=>2,
		    'status'=>1,
		    'create_time'=> time(),
		    'dt'=>date("Y-m-d H:i:s",time()),
		    'level'=>$newlevel,
		    'writer'=> $this->current_user['nickname']?$this->current_user['nickname']:$this->current_user['username'],
		    "title"=>trim($_REQUEST['title']),
		    'description'=>trim($_REQUEST['description']),
		    "keywords"=>trim($_REQUEST['keyword']),		    
		);
		$add_document_anli= array(
		    "atitle"=>trim($_REQUEST['title']),
		    'loupan'=>intval($_REQUEST['loupan']),
		    'jushi'=>intval($_REQUEST['jushi']),
		    'mianji'=>intval($_REQUEST['mianji']),
		    'fengge'=>intval($_REQUEST['fengge']),
		    'zaojia'=>intval($_REQUEST['zaojia']),
		    'fangshi'=>intval($_REQUEST['fangshi']),
		    'zhucai'=>trim($_REQUEST['zhucai']),
		    'gongqi'=>trim($_REQUEST['gongqi']),
		    'edate'=>trim($_REQUEST['edate']),
		    'content'=>$_POST['content'],		    
		);
	    /**
	     * alter table ot_document_anli modify COLUMN `content` text NULL DEFAULT '' COMMENT '详情';
		alter table ot_document_anli modify COLUMN `zhucai` varchar(100) NULL DEFAULT '' COMMENT '主材';
		alter table ot_document_anli modify COLUMN `rzloupan` char(50) NOT NULL DEFAULT '0' COMMENT '热装楼盘ID';
		alter table ot_document_anli modify COLUMN `atitle` varchar(255) NOT NULL DEFAULT '' COMMENT '案例名称1';
	     */
		//补充更新图片 
		$img=$_POST["img"];  
		$today =date("Y-m-d", time());
		$pid=0;
		if($img!=null){
			$i=0;//补充图片开始位置
			foreach($img as $file){
				if($i<1){
				    $md5_file = md5_file($file);
				    $sha1_file = sha1_file($file);
				    //查询图片是否存在
				    if(!empty($md5_file) && !empty($sha1_file)){
					$picturedata =  M("picture")->where(array("md5"=>$md5_file,"sha1"=>$sha1_file))->find(); 
				    }
				    if(empty($picturedata)){
					$file=base64_decode(str_replace('data:image/jpeg;base64,', '', $file));
					$path=$_SERVER['DOCUMENT_ROOT']."\\Uploads\\Picture\\{$today}\\";
    //				    if(!is_readable($path)){mkdir($path,0700);}
					if (!file_exists($path)) {
					    $dir_exist = mkdir($path);
					}else{
					   $dir_exist = true;  
					} 
					$filename=GUID().'.jpg';
					file_put_contents($path.$filename,$file);

					//生成缩略图
					$path1=$_SERVER['DOCUMENT_ROOT']."\\Uploads\\Picture\\thumb\\{$today}\\";
    //				    if(!is_readable($path1)){mkdir($path1,0700);}
					if (!file_exists($path1)) {
					    $dir_exist = mkdir($path1);
					}else{
					   $dir_exist = true;  
					} 
					$image = new \Think\Image(); 
					$image->open($path.$filename);
					$image->thumb(200, 200,\Think\Image::IMAGE_THUMB_CENTER)->save($path1.$filename);

					$picture=null;
					$picture['path']="/Uploads/Picture/{$today}/".$filename;
					// 保存文件
					if(!empty($picture)){
					    $picture['md5']=$md5_file;
					    $picture['sha1']=$sha1_file;
					    $picture['status']=1;
					    $picture['create_time']= time();
					    $pid = M("picture")->add($picture);
					}					
				    }else{
					$pid = $picturedata['id'];
				    }				    
				    $i++;
				}
			}
		}
		if($pid>0){
		    $add_document['cover_id'] = $pid;
		} 
		$img=null;
		$img=$_POST["img2"];  
		$pid=0;
		if($img!=null){
			$i=0;//补充图片开始位置
			foreach($img as $file){
				if($i<1){
				    $md5_file = md5_file($file);
				    $sha1_file = sha1_file($file);
				    //查询图片是否存在
				    if(!empty($md5_file) && !empty($sha1_file)){
					$picturedata =  M("picture")->where(array("md5"=>$md5_file,"sha1"=>$sha1_file))->find(); 
				    }
				    if(empty($picturedata)){
					$file=base64_decode(str_replace('data:image/jpeg;base64,', '', $file));
					$path=$_SERVER['DOCUMENT_ROOT']."\\Uploads\\Picture\\{$today}\\";
    //				    if(!is_readable($path)){mkdir($path,0700);}
					if (!file_exists($path)) {
					    $dir_exist = mkdir($path);
					}else{
					   $dir_exist = true;  
					} 
					$filename=GUID().'.jpg';
					file_put_contents($path.$filename,$file);

					//生成缩略图
					$path1=$_SERVER['DOCUMENT_ROOT']."\\Uploads\\Picture\\thumb\\{$today}\\";
    //				    if(!is_readable($path1)){mkdir($path1,0700);}
					if (!file_exists($path1)) {
					    $dir_exist = mkdir($path1);
					}else{
					   $dir_exist = true;  
					} 
					$image = new \Think\Image(); 
					$image->open($path.$filename);
					$image->thumb(200, 200,\Think\Image::IMAGE_THUMB_CENTER)->save($path1.$filename);

					$picture=null;
					$picture['path']="/Uploads/Picture/{$today}/".$filename;
					// 保存文件
					if(!empty($picture)){
					    $picture['md5']=$md5_file;
					    $picture['sha1']=$sha1_file;
					    $picture['status']=1;
					    $picture['create_time']= time();
					    $pid = M("picture")->add($picture);
					}					
				    }else{
					$pid = $picturedata['id'];
				    }				    
				    $i++;
				}
			}
		}	
		if($pid>0){
		    $add_document_anli['detailpic'] = $pid;
		}
		
		//附件保存
		$_max_size =10485760*5; // 最大50M
		$_file_type = 'txt,zip,tar,doc,docx,xls,xlsx'; // 允许上传文件类型
		$_error_code = array( // 错误码
		    0 => '没有错误发生，文件上传成功',
		    1 => '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值',
		    2 => '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值',
		    3 => '文件只有部分被上传',
		    4 => '没有文件被上传'
		);
		 $files[1] = $_FILES['thefile1'];
		 $files[2] = $_FILES['thefile2'];
		 $files[3] = $_FILES['thefile3'];
		    for($item=1;$item<4;$item++){ 
			$file=$files[$item];
			if ($file) {
			    $filepath = "/Uploads/Attachment/{$today}/";
			    // 若所有检测都通过
			    if (_checkError($file['error'],$_max_size,$_file_type,$_error_code) &&
				_checkMaxSize($file['size'],$_max_size,$_file_type,$_error_code) &&
				_checkFileType(pathinfo($file['name']),$_max_size,$_file_type,$_error_code) &&
				_chekFileIsExists($filepath.$file['name']))
			    {
		//		$name=iconv("UTF-8","gb2312", $name);
		//		move_uploaded_file($tmpname, $this->final_file_path); 
		//		$name=iconv("gb2312","UTF-8", $name);
				if (move_uploaded_file($file['tmp_name'], iconv("UTF-8","gb2312",$_SERVER['DOCUMENT_ROOT'].$filepath.$file['name']))) {
				   // echo '<script>alert("上传成功!")</script>';
				    $attachment[] =array('filename'=> $file['name'],'file' => $filepath.$file['name']);
				} else {
				  //  echo '<script>alert("上传失败!")</script>';
				}
			    }
			}
		    }
		    if($attachment){
			$documentanli_data['attachments']= serialize($attachment);
		    }
		// die;
		if($document_data){
		    M("document")->where(array("id"=>$document_data['id']))->save($add_document);
		    $did = $document_data['id'];
		}else{
		    $did = M("document")->add($add_document);
		}
	    if($did){
		$add_document_anli['id'] = $add_document_anli['aid'] =$did;
		if($documentanli_data){
		    M("document_anli")->where(array("id"=>$documentanli_data['id']))->save($add_document_anli);
		    $aid = $documentanli_data['id'];
		}else{
		    $aid = M("document_anli")->add($add_document_anli); 
		}
	    }
	    if($did && $aid){ 
	    $this->success('操作成功！', U('Member/Sheji/index'));
	    $this->redirect('Sheji/index');
	    }else if(!$did || !$aid){
	      $this->error('操作未完成，请刷新后重新操作！');
	    $this->redirect("Sheji/detail/id/{$did}");
	    } 
	  die;
	}else{ 
	    //居室信息
	    $jushis = M("sys_enum_jushi")->where("id>0")->order("disorder")->select();  
	    $this->assign("jushis",$jushis);  
	    //风格信息
	    $fengges = M("sys_enum_fengge")->where("id>0")->order("disorder")->select();  
	    $this->assign("fengges",$fengges);  
	    //合作方式信息
	    $fangshis = M("sys_enum_fangshi")->where("id>0")->order("disorder")->select();  
	    $this->assign("fangshis",$fangshis);   

	    if(empty($id)){ 
	    }else{
		$anliview_data1=D("AnliView")->where(array("id"=>$id))->find();  
		$document_data=M("document")->where(array("id"=>$id))->find();  
		$documentanli_data=M("document_anli")->where(array("id"=>$id))->find();  
		if($documentanli_data['detailpic']){
		    $anlipicture_data=M("picture")->where(array("id"=>$documentanli_data['detailpic']))->find();  
		    $documentanli_data['picpath'] = $anlipicture_data['path'];
		}
	    }  
	    if($anliview_data1['picpath']){
		$img1=getimagesize($_SERVER['DOCUMENT_ROOT'].$anliview_data1['picpath']); 
		$anliview_data1['img1']=$img1;
	    }
	    if($documentanli_data['picpath']){
		$img2=getimagesize($_SERVER['DOCUMENT_ROOT'].$documentanli_data['picpath']); 
		$anliview_data1['img2']=$img2;
	    }
//	    echo $anliview_data1['picpath'];
//	    var_dump($img1);die;

	    $this->assign("id",$id);
	    $this->assign("anliview_data1",$anliview_data1);
	    $this->assign("document_data",$document_data);
	    $this->assign("documentanli_data",$documentanli_data);

	    $this->display();
	}
    }
}