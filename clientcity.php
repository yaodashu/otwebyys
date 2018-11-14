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
$cityname="��ɳ";
if($result_array['code']==0 && $result_array['data']){ 
    $city=$result_array['data']['city_id'];
    switch ($result_array['data']['city_id']) {
	case "430200":	   
	    $cityname="����";
	    break;
	case "430300":	   
	    $cityname="��̶";
	    break;
	case "430400":	   
	    $cityname="����";
	    break;
	case "430600":	   
	    $cityname="����";
	    break;
	case "430700":	   
	    $cityname="����";
	    break;
	case "430900":	   
	    $cityname="����";
	    break;
	case "431000":	   
	    $cityname="����";
	    break;
	case "431100":	   
	    $cityname="����";
	    break;
	case "431200":	   
	    $cityname="����";
	    break;
	case "431300":	   
	    $cityname="¦��";
	    break;
	case "433100":	   
	    $cityname="����";
	    break;
	default :
	    $city="520100";
	    $cityname="����";
	    break; 
	default :
	    $city="430100";
	    $cityname="��ɳ";
	    break; 
    }
}
//echo json_encode(array("cid"=>$city,"cname"=>$cityname));die;
exit(json_encode(array("cid"=>$city,"cname"=>$cityname)));
/*
 * 430200	������
430300	��̶��
430400	������
430500	������
430600	������
430700	������
430800	�żҽ���
430900	������
431000	������
431100	������
431200	������
431300	¦����
433100	��������������������
 */

/**
 * ��ȡ�ͻ���IP��ַ
 * @param integer $type �������� 0 ����IP��ַ 1 ����IPV4��ַ����
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
    // IP��ַ�Ϸ���֤
    $long = ip2long($ip);
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}
?>