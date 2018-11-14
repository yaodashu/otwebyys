<?php 
$url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=41";
$contents=file_get_contents($url);
if($_REQUEST['today']!="1"){
    $contents = $contents +1288;
}else{
    if(empty($contents) || intval($contents)<=0){
	$contents=095;
    }else{  
       if($contents>100){
	$contents = $contents%100;
       } 
       $contents = 100-$contents;
    }
    if($contents<20){
	$contents = $contents+20;
    }
}
echo $contents;
?>