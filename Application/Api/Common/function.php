<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

/**
 * @author: caipeichao
 */

/**
 * 参数数量任意，返回第一个非空参数
 * @return mixed|null
 */
function alt() {
    for($i = 0 ; $i < func_num_args(); $i++) {
        $arg = func_get_arg($i);
        if($arg) {
            return $arg;
        }
    }
    return null;
}
/**
 * 获取数组中指定的元素
 * @param type $array 需要被筛选的数组
 * @param type $fields 赛选关键字数组
 * @return type 
 */
function array_gets($array, $fields) {
    $result = array();
    foreach($fields as $e) {
        if(array_key_exists($e, $array)) {
            $result[$e] = $array[$e];
        }
    }
    return $result;
}

/**
 * 将电话保存至session
 * @param type $mobile
 */
function saveMobileInSession($mobile) {
    session_start();
    session('send_sms', array('mobile'=>$mobile));
}

/**
 * 获取session中保存的电话
 * @return type
 */
function getMobileFromSession() {
    return session('send_sms.mobile');
}
//
///**
// * 前台公共库文件
// * 主要定义前台公共函数库
// */
//
///**
// * 检测验证码
// * @param  integer $id 验证码ID
// * @return boolean     检测结果
// * @author 麦当苗儿 <zuojiazi@vip.qq.com>
// */
//function check_verify($code, $id = 1){
//	$verify = new \Think\Verify();
//	return $verify->check($code, $id);
//}
//
///**
// * 获取列表总行数
// * @param  string  $category 分类ID
// * @param  integer $status   数据状态
// * @author 麦当苗儿 <zuojiazi@vip.qq.com>
// */
//function get_list_count($category, $status = 1){
//    static $count;
//    if(!isset($count[$category])){
//        $count[$category] = D('Document')->listCount($category, $status);
//    }
//    return $count[$category];
//}
//
///**
// * 获取段落总数
// * @param  string $id 文档ID
// * @return integer    段落总数
// * @author 麦当苗儿 <zuojiazi@vip.qq.com>
// */
//function get_part_count($id){
//    static $count;
//    if(!isset($count[$id])){
//        $count[$id] = D('Document')->partCount($id);
//    }
//    return $count[$id];
//}
//
///**
// * 获取导航URL
// * @param  string $url 导航URL
// * @return string      解析或的url
// * @author 麦当苗儿 <zuojiazi@vip.qq.com>
// */
//function get_nav_url($url){
//    switch ($url) {
//        case 'http://' === substr($url, 0, 7):
//        case '#' === substr($url, 0, 1):
//            break;        
//        default:
//            $url = U($url);
//            break;
//    }
//    return $url;
//}