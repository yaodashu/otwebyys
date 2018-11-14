<?php

// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: Zero Li <35714820@qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Member\Controller;

use User\Api\UserApi;

/**
 * 用户控制器
 * 包括用户中心，用户登录及注册
 */
class UserController extends MemberController {
    /* 用户中心首页 */

    public function index() {
        
    }

    /** 注册页面  
     *  注册步奏的第一步，添加用户资料
     * $source 注册来源，：为1时，配合stype参数，$stype参数取值： 0：仅返回id，1：围观，2，拍卖,3，即时帮帮，4，询价，5，试驾，6，置换，10，卖车返回
     */
    public function register($username = '', $mobile = '', $password = '', $email = '', $verify = '', $type = 'start', $source = '', $stype = '', $id_publish = '', $areaid='',$rankid='') {
        $type = op_t($type);
        if (!C('USER_ALLOW_REGISTER') and $source == '') {
            $this->error('注册已关闭');
        }
        if (IS_POST or $source != '') { //注册用户
            /* 检测验证码 */
            if ((C('VERIFY_OPEN') == 1 or C('VERIFY_OPEN') == 2) and $source == '') {
                if (!check_verify($verify)) {
                    $this->error('验证码输入错误。');
                }
            }

            // 调用Ucenter注册接口注册用户
            $User = new UserApi;
            $uid = $User->register($username, $password, $email, $mobile,'0',$areaid,$rankid);
            if (0 < $uid) { //注册成功
                $uid = $User->login($username, $password); //通过账号密码取到uid
                D('User/Member')->login($uid, false); //登陆
                $reg_weibo = C('USER_REG_WEIBO_CONTENT'); //用户注册的微博内容
                if ($reg_weibo != '') {//为空不发微博
                    D('Weibo/Weibo')->addWeibo($uid, $reg_weibo);
                }
                if ($source == '1') {
                    switch ($stype) {
                        case '1':
                            $data_id = D('Home/Index')->publish_interest($id_publish, $username);
                            break;
                        case '2':
                            $data_id = D('Home/Index')->publish_bidders($id_publish, $username);
                            break;
                        case '3':
                            $data_id = D('Home/Index')->publish_helpnow($id_publish, $username);
                            break;
                        case '4':
                            $data_id = D('Home/Index')->publish_askprice($id_publish, $username);
                            break;
                        case '5':
                            $data_id = D('Home/Index')->publish_applydrive($id_publish, $username);
                            break;
                        case '6':
                            $data_id = D('Home/Index')->publish_applychange($id_publish, $username);
                            break;
                        case '7':
                            $data_id = D('Home/Index')->technician_apply($id_publish,$username);
                            break;
                        default :
                            $data_id=0;
                            break;
                    }
                    $Member = D('User/Member')->login($uid, $remember == 'on'); //登录用户
                    $current_user = callApi('User/getProfile');
                    $current_user['data_id'] = $data_id; 
                    if($stype=='0'){
                        return $uid;
                    }
                    else{
                        $this->ajaxReturn($current_user);                        
                    }
                    //echo '<script>window.close();</script>';
                    //$this->success('', U('/Home/Index'));
                } else {
                    $this->success('', U('Member/User/step3'));
//                    $this->success('', U('Member/User/step2'));
                }
            } else { //注册失败，显示错误信息
                if ($source == '1' and $uid == -3) {
                    $uid = $User->login($username, $password); //通过账号密码取到uid
                    if (0 < $uid) {
                        switch ($stype) {
                            case '1':
                                $data_id = D('Home/Index')->publish_interest($id_publish, $username);
                                break;
                            case '2':
                                $data_id = D('Home/Index')->publish_bidders($id_publish, $username);
                                break;
                            case '3':
                                $data_id = D('Home/Index')->publish_helpnow($id_publish, $username);
                                break;
                            case '4':
                                $data_id = D('Home/Index')->publish_askprice($id_publish, $username);
                                break;
                            case '5':
                                $data_id = D('Home/Index')->publish_applydrive($id_publish, $username);
                                break;
                            case '6':
                                $data_id = D('Home/Index')->publish_applychange($id_publish, $username);
                                break;
                            case '7':
                                $data_id = D('Home/Index')->technician_apply($id_publish,$username);
                                break;
                            default :
                                $data_id=0;
                                break;
                        }
                        $Member = D('User/Member')->login($uid, $remember == 'on'); //登录用户
                        $current_user = callApi('User/getProfile');
                        $current_user['data_id'] = $data_id; 
                        if($stype=='0'){
                            return $uid;
                        }
                        else{
                            $result[0] = $current_user;
                            $this->ajaxReturn($result);                        
                        }
                        //echo '<script>window.close();</script>';
                        //$this->success('', U('/Home/Index'));
                    } else {
                        $this->error($this->showRegError($uid));
                    }
                } else {
                    $this->error($this->showRegError($uid));
                }
            }
        } else { //显示注册表单
	    
	    //查询得到门店列表
	    $arealist = M()->query("select * from ot_sys_enum_area where 1 ORDER BY disorder");
	    $this->assign("arealist",$arealist);
	    //查询得到设计师级别列表
	    $ranklist = M()->query("select * from ot_sys_enum_rank where 1 ORDER BY disorder");
	    $this->assign("ranklist",$ranklist);
	    
            $this->assign('type', $type);
            $this->display();
        }
    }

    /* 注册页面step2 */

    public function step2($type = 'upload') {
        $type = op_t($type); //显示上传头像页面
        $this->assign('type', $type);
        $this->display('register');
    }

    /* 注册页面step3 */

    public function step3($type = 'finish') {
        $type = op_t($type);
        $this->assign('type', $type);
        $this->display('register');
    }

    /* 登录页面 */

    public function login($username = '', $password = '', $verify = '', $remember = '', $beforepage = '') {
        if (IS_POST) { //登录验证
            /* 检测验证码 */
            if (!check_verify($verify)) {
                $this->error('验证码输入错误！');
            }

            /* 调用UC登录接口登录 */
            $user = new UserApi;
            $uid = $user->login($username, $password);
            if (0 < $uid) { //UC登录成功
                /* 登录用户 */
                $Member = D('User/Member');
                if ($Member->login($uid, $remember == 'on')) { //登录用户
                    //跳转到登录前页面
                    if ($beforepage) {
			$url =U($beforepage);
                        $this->success('登录成功！', U('Home/Index/index'));
                    } else {
                        $this->success('登录成功！', U('Home/Index/index'));
                    }
                } else {
                    $this->error($Member->getError());
                }
            } else { //登录失败
                switch ($uid) {
                    case -1: $error = '用户不存在或被禁用！';
                        break; //系统级别禁用
                    case -2: $error = '密码错误！';
                        break;
                    default: $error = '未知错误！';
                        break; // 0-接口参数错误（调试阶段使用）
                }
                $this->error($error);
            }
        } else { 
	    //显示登录表单
	    $loginname ="会员";
	    if(!empty(C('HOME_LOGIN_NAME'))){
		    $loginname = C('HOME_LOGIN_NAME');
	    } 
	    $this->assign("loginname",$loginname);
            $this->display();
        }
    }

    /* 退出登录 */

    public function logout() {
        if (is_login()) {
            D('Member')->logout();
            $this->success('退出成功！', U('User/login'));
        } else {
            $this->redirect('User/login');
        }
    }

    /* 退出登录 */

    public function logoutHome() {
        if (is_login()) {
            D('User/Member')->logout();
            $this->success('退出成功！', U('/Home/Index'));
            //  $this->redirect('Home/Index');
        } else {
            $this->redirect('/Home/Index');
        }
    }

    /* 验证码，用于登录和注册 */

    public function verify() {
        $verify = new \Think\Verify();
        $verify->entry(1);
    }

    /**
     * 获取用户注册错误信息
     * @param  integer $code 错误编码
     * @return string        错误信息
     */
    private function showRegError($code = 0) {
        switch ($code) {
            case -1: $error = '用户名长度必须在16个字符以内！';
                break;
            case -2: $error = '用户名被禁止注册！';
                break;
            case -3: $error = '用户名被占用！';
                break;
            case -4: $error = '密码长度必须在6-30个字符之间！';
                break;
            case -5: $error = '邮箱格式不正确！';
                break;
            case -6: $error = '邮箱长度必须在1-32个字符之间！';
                break;
            case -7: $error = '邮箱被禁止注册！';
                break;
            case -8: $error = '邮箱被占用！';
                break;
            case -9: $error = '手机格式不正确！';
                break;
            case -10: $error = '手机被禁止注册！';
                break;
            case -11: $error = '手机号被占用！';
                break;
            default: $error = '未知错误';
        }
        return $error;
    }

    /**
     * 修改密码提交
     * @author huajie <banhuajie@163.com>
     */
    public function profile() {
        if (!is_login()) {
            $this->error('您还没有登陆', U('User/login'));
        }
        if (IS_POST) {
            //获取参数
            $uid = is_login();
            $password = I('post.old');
            $repassword = I('post.repassword');
            $data['password'] = I('post.password');
            empty($password) && $this->error('请输入原密码');
            empty($data['password']) && $this->error('请输入新密码');
            empty($repassword) && $this->error('请输入确认密码');

            if ($data['password'] !== $repassword) {
                $this->error('您输入的新密码与确认密码不一致');
            }

            $Api = new UserApi();
            $res = $Api->updateInfo($uid, $password, $data);
            if ($res['status']) {
                $this->success('修改密码成功！');
            } else {
                $this->error($res['info']);
            }
        } else {
            $this->display();
        }
    }

    /**
     * 用户信息管理页面
     * @param type $username        用户名（用户名无法修改）
     * @param type $signature       称谓（编辑可修改称谓,如: 张先生, 王小姐, 李云龙）
     * @param type $mobile          手机（编辑可修改手机,如: 13900000000）
     * @param type $email           邮箱（编辑可修改邮箱, 如: alex.xiao@sina.com）
     * @param type $nickname        昵称（编辑可修改昵称, 如: 情逆三世缘）
     * @param type $birthday        生日（编辑可修改生日, 如: 2000-1-1）
     */
    public function info($username = '', $signature = '', $mobile = '', $email = '', $nickname = '', $birthday = '') {
        // 只有登录状态才能访问本页,验证登录.
        $this->is_login();
        // 调用用户API获取当前登录用户信息
        $current_user = callApi('User/getProfile');
        $this->assign('current_user', $current_user);
        if (IS_POST) { //注册用户
	    
	    $areaid =intval(I('post.areaid'));
	    $rankid =intval(I('post.rankid'));
	    if($areaid>0){
		$umember['area'] = $areaid;
	    }
	    if($rankid>0){
		$umember['rank'] = $rankid;
	    }
	    if($umember){
		$current_user = callApi('User/getProfile');  
		if($current_user['uid'] && ($areaid!=$current_user['areaid'] || $rankid!=$current_user['rankid'])){
		    $umember['update_time']= time();
		    M("ucenter_member")->where(array("id"=>$current_user['uid']))->save($umember);
		}
	    }
	    
            // 调用API,传入参数更新用户信息
            $update_result = callApi('User/setProfile', array($signature, $email, $mobile, null, null, $birthday, $nickname));
            if ($update_result['success']) { 
                $this->success('', U('Member/User/info'));
            } else {
                $this->error('修改失败,请稍候再试或与管理员联系');
            }
        } else { //显示注册表单
	    
	    //查询得到门店列表
	    $arealist = M()->query("select * from ot_sys_enum_area where 1 ORDER BY disorder");
	    $this->assign("arealist",$arealist);
	    //查询得到设计师级别列表
	    $ranklist = M()->query("select * from ot_sys_enum_rank where 1 ORDER BY disorder");
	    $this->assign("ranklist",$ranklist);
            $this->display();
        }
    }

    /**
     * 管理头像页面
     */
    public function manageAvatar() {
        // 只有登录状态才能访问本页,验证登录.
        $this->is_login();
        // 调用用户API获取当前登录用户信息
        $current_user = callApi('User/getProfile');
        $this->assign('current_user', $current_user);

        $this->display();
    }

    public function changePassword() {
        // 只有登录状态才能访问本页,验证登录.
        $this->is_login();
        // 调用用户API获取当前登录用户信息
        $current_user = callApi('User/getProfile');
        $this->assign('current_user', $current_user);
        if (IS_POST) {
            //获取参数
            $uid = $current_user['uid'];
            $password = I('post.old');
            $repassword = I('post.repassword');
            $data['password'] = I('post.password');
            empty($password) && $this->error('请输入原密码');
            empty($data['password']) && $this->error('请输入新密码');
            empty($repassword) && $this->error('请输入确认密码');

            if ($data['password'] !== $repassword) {
                $this->error('您输入的新密码与确认密码不一致');
            }

            $Api = new UserApi();
            $res = $Api->updateInfo($uid, $password, $data);
            if ($res['status']) {
                $this->success('修改密码成功！');
            } else {
                $this->error($res['info']);
            }
        } else {
            $this->display();
        }
    }
    public function getSmsCode() {
        if (IS_POST) {
	    $mobile= trim($_REQUEST['mobile']);
	    $code = trim($_REQUEST['code']);
	    $sms = M("sms")->where(array("sid"=>1,"status"=>1))->find();//("SELECT * FROM" . tablename('sms') . " WHERE  sid=1",array(":uniacid"=>$_W['uniacid'])); 
	    
	    $strPol = "0123456789";
	    $max = strlen($strPol)-1;

	    for($i = 0; $i < 4; $i++){
		$str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
	    }
	    $code = $str; 
	     die(json_encode(array("status"=>1,"result"=>array('code'=>$code))));
	     //发送短信，判断是聚合还是其它
	    $vdata = unserialize($sms['data']);
//	    var_dump($vdata);die;
	    if($sms['type']=='juhe'){
		   //聚合短信
		    $sendUrl =($sms['url'])?$sms['url']:"http://v.juhe.cn/sms/send"; //短信接口的URL ,http://v.juhe.cn/sms/send
		    $smsConf = array(
			'key'   => $sms['smssign'], //您申请的APPKEY
			'mobile'    => $mobile, //接受短信的用户手机号码
			'tpl_id'    => $sms['smstplid'], //您申请的短信模板ID，根据实际情况修改
			'tpl_value' =>"#".$vdata[0]['data_temp']."#".'='.$code //您设置的模板变量，根据实际情况修改
		    );
		    
		    $content = juhecurl($sendUrl,$smsConf,1); //请求发送短信 
		    if($content){
			$result = json_decode($content,true);
			$error_code = $result['error_code'];
			if($error_code == 0){
			    //状态为0，说明短信发送成功
			    die(json_encode(array("status"=>1,"result"=>array('code'=>$code))));
			  //show_json(1,array('msg'=>"短信发送成功,短信ID：".$result['result']['sid']));;//  echo "短信发送成功,短信ID：".$result['result']['sid'];
			}else{
			    //状态非0，说明失败
			    $msg = $result['reason'];
//			    echo "短信发送失败(".$error_code.")：".$msg; 
			    die(json_encode(array("status"=>'0',"result"=>array('msg'=>"短信发送失败(".$error_code.")：".$msg))));
			}
		    }else{
			//返回内容异常，以下可根据业务逻辑自行修改
//			echo "请求发送短信失败"; 
			    die(json_encode(array("status"=>'0',"result"=>array('msg'=>"请求发送短信失败"))));
		    } 
	    }
	}
	die;
    }

}
