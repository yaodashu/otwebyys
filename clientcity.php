<?php 
if(@$_REQUEST['ip']){
    $ip= $_REQUEST['ip'];
}else{
    $ip= get_client_ip();
}

$url="http://i.dasn.com.cn/index.php/clientcity/index?ip=".$ip;
$contents=file_get_contents($url);
$result_array= json_decode($contents,true);
//var_dump($result_array);
$city="430100";
$cityname="长沙";
if($result_array['code']==0 && $result_array['data']){ 
    $city=$result_array['data']['city_id'];
    switch ($result_array['data']['city_id']) {
	case "430200":	   
	    $cityname="株洲";
	    break;
	case "430300":	   
	    $cityname="湘潭";
	    break;
	case "430400":	   
	    $cityname="衡阳";
	    break;
	case "430600":	   
	    $cityname="岳阳";
	    break;
	case "430700":	   
	    $cityname="常德";
	    break;
	case "430900":	   
	    $cityname="益阳";
	    break;
	case "431000":	   
	    $cityname="郴州";
	    break;
	case "431100":	   
	    $cityname="永州";
	    break;
	case "431200":	   
	    $cityname="怀化";
	    break;
	case "431300":	   
	    $cityname="娄底";
	    break;
	case "433100":	   
	    $cityname="吉首";
	    break;
	default :
	    $city="520100";
	    $cityname="贵阳";
	    break; 
	default :
	    $city="430100";
	    $cityname="长沙";
	    break; 
    }
}
//echo json_encode(array("cid"=>$city,"cname"=>$cityname));die;
exit(json_encode(array("cid"=>$city,"cname"=>$cityname)));
/*
 * 430200	株洲市
430300	湘潭市
430400	衡阳市
430500	邵阳市
430600	岳阳市
430700	常德市
430800	张家界市
430900	益阳市
431000	郴州市
431100	永州市
431200	怀化市
431300	娄底市
433100	湘西土家族苗族自治州
 */

/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @return mixed
 */
function get_client_ip($type = 0) {
	$type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos    =   array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip     =   trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip     =   $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = ip2long($ip);
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}
?>