<?php 
$sourceid= 1;
$time ="";
if(!empty($_REQUEST['today'])){
  $time = date("Y-m-d", time());  
}
$url="http://i.dasn.com.cn/index.php/baomingrenshu/index?sourceid=".$sourceid."&time=".$time; 
$contents=file_get_contents($url);
if(empty($contents) || intval($contents)<=0){
    $contents=138;
}else{  
   if($contents>138){
    $contents = $contents%138;
   } 
   $contents = 138-$contents;
}
if($contents<20){
    $contents = $contents+20;
}
echo $contents;
?>