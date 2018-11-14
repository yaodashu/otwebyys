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

use OSS\Core\OssException;//不然OssException 报错
/**
 * 测试页面
 */
class TestossController extends HomeController {

    public function __construct() {
	parent::__construct(); 
    }
    public function _initialize(){
	parent::_initialize(); 
    }


    /*
     * 默认展示
     */
    public function index(){
//	var_dump($_SERVER);
	
        $this->display();
    }
    /*
     * 
     */
    public function aliyunoss(){
//	var_dump($_SERVER);
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
				    //更新到阿里云OSS路径
				    vendor('aliyunoss.autoload');
				    $ossClient = new \OSS\OssClient(C('accessKeyId'),C('accessKeySecret'),C('endpoint'));
				    $object ='web001/'. date('Y-m-d').'/'.$filename;//想要保存文件的名称，到OSS路径
				    $file = $_SERVER['DOCUMENT_ROOT'].$picture['path'];//文件路径，必须是本地的。
				    try{
					$getOssInfo = $ossClient->uploadFile(C('bucket'),$object,$file);//本地图片上传到OSS目标位置
					$getOssPdfUrl = $getOssInfo['info']['url'];
					if($getOssPdfUrl){
					   $picture['url']=$getOssPdfUrl;
					   //unlink($file); //删除本土路径下图片					    
					   // rmdir($upload->rootPath.$upload->savePath,0777);//删除本土路径目录
					   
					    $oss_img1= $this->Signatureurl($getOssPdfUrl);
					    $this->assign("oss_img1",$oss_img1);
					}
				    }catch(OssException $e){
					printf($e->getMessage() . "\n");
					return;
				    }
				    
				    $picture['md5']=$md5_file;
				    $picture['sha1']=$sha1_file;
				    $picture['status']=1;
				    $picture['create_time']= time();
				    $pid = M("picture")->add($picture);
				}					
			    }else{
				$pid = $picturedata['id'];
				if($picturedata['url']){
				    $this->assign("oss_img1",$picturedata['url']);
				}else if($picturedata['path']){
				    $this->assign("oss_img1",$picturedata['path']);
				}
			    }				    
			    $i++;
			}
		}
	}
	if($pid>0){
	    $add_document['cover_id'] = $pid;
	} 
	 
        $this->display();
    }
    
    public function Signatureurl($pic){

	   $ak=C('accessKeyId');

	   $sk=C('accessKeySecret');

	   $domain="http://".C('bucket').".".C('endpoint')."/";//图片域名或bucket域名,http://oss-yys-001.oss-cn-shenzhen.aliyuncs.com/

	   $expire=time()+3600;

	   $bucketname=C('bucket');

	   $file= str_replace($domain,"", $pic);//"2018-11-13/0B8FD4DC9EACC4946922C15819AB8B8E.jpg";//或者"mulu/1.jpg@!样式名"  或者 mulu/1.jpg”

	   $StringToSign="GET\n\n\n".$expire."\n/".$bucketname."/".$file;

	   $Sign=base64_encode(hash_hmac("sha1",$StringToSign,$sk,true));

	   $url=$domain.urlencode($file)."?OSSAccessKeyId=".$ak."&Expires=".$expire."&Signature=".urlencode($Sign);

	   return $url;

    }

}