<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台内容控制器
 * @author huajie <banhuajie@163.com>
 */
class ArticleController extends AdminController {

    /* 保存允许访问的公共方法 */
    static protected $allow = array( 'draftbox','mydocument');

    private $cate_id        =   null; //文档分类id

    /**
     * 检测需要动态判断的文档类目有关的权限
     *
     * @return boolean|null
     *      返回true则表示当前访问有权限
     *      返回false则表示当前访问无权限
     *      返回null，则会进入checkRule根据节点授权判断权限
     *
     * @author 朱亚杰  <xcoolcc@gmail.com>
     */
    protected function checkDynamic(){
        $cates = AuthGroupModel::getAuthCategories(UID);
        switch(strtolower(ACTION_NAME)){
            case 'index':   //文档列表
            case 'add':   // 新增
                $cate_id =  I('cate_id');
                break;
            case 'edit':    //编辑
            case 'update':  //更新
                $doc_id  =  I('id');
                $cate_id =  M('Document')->where(array('id'=>$doc_id))->getField('category_id');
                break;
            case 'setstatus': //更改状态
            case 'permit':    //回收站
                $doc_id  =  (array)I('ids');
                $cate_id =  M('Document')->where(array('id'=>array('in',$doc_id)))->getField('category_id',true);
                $cate_id =  array_unique($cate_id);
                break;
        }
        if(!$cate_id){
            return null;//不明
        }elseif( !is_array($cate_id) && in_array($cate_id,$cates) ) {
            return true;//有权限
        }elseif( is_array($cate_id) && $cate_id==array_intersect($cate_id,$cates) ){
            return true;//有权限
        }else{
            return false;//无权限
        }
    }

    /**
     * 显示左边菜单，进行权限控制
     * @author huajie <banhuajie@163.com>
     */
    protected function getMenu(){
        //获取动态分类
        $cate_auth  =   AuthGroupModel::getAuthCategories(UID); //获取当前用户所有的内容权限节点
        $cate_auth  =   $cate_auth == null ? array() : $cate_auth;
        $cate       =   M('Category')->where(array('status'=>1))->field('id,title,pid,allow_publish')->order('pid,sort')->select();

        //没有权限的分类则不显示
        if(!IS_ROOT){
            foreach ($cate as $key=>$value){
                if(!in_array($value['id'], $cate_auth)){
                    unset($cate[$key]);
                }
            }
        }

        $cate           =   list_to_tree($cate);    //生成分类树

        //获取分类id
        $cate_id        =   I('param.cate_id');
        $this->cate_id  =   $cate_id;

        //是否展开分类
        $hide_cate = false;
        if(ACTION_NAME != 'recycle' && ACTION_NAME != 'draftbox' && ACTION_NAME != 'mydocument'){
            $hide_cate  =   true;
        }

        //生成每个分类的url
        foreach ($cate as $key=>&$value){
            $value['url']   =   'Article/index?cate_id='.$value['id'];
            if($cate_id == $value['id'] && $hide_cate){
                $value['current'] = true;
            }else{
                $value['current'] = false;
            }
            if(!empty($value['_child'])){
                $is_child = false;
                foreach ($value['_child'] as $ka=>&$va){
                    $va['url']      =   'Article/index?cate_id='.$va['id'];
                    if(!empty($va['_child'])){
                        foreach ($va['_child'] as $k=>&$v){
                            $v['url']   =   'Article/index?cate_id='.$v['id'];
                            $v['pid']   =   $va['id'];
                            $is_child = $v['id'] == $cate_id ? true : false;
                        }
                    }
                    //展开子分类的父分类
                    if($va['id'] == $cate_id || $is_child){
                        $is_child = false;
                        if($hide_cate){
                            $value['current']   =   true;
                            $va['current']      =   true;
                        }else{
                            $value['current']   =   false;
                            $va['current']      =   false;
                        }
                    }else{
                        $va['current']      =   false;
                    }
                }
            }
        }
        $this->assign('nodes',      $cate);
        $this->assign('cate_id',    $this->cate_id);

        //获取面包屑信息
        $nav = get_parent_category($cate_id);
        $this->assign('rightNav',   $nav);

        //获取回收站权限
        $this->assign('show_recycle', IS_ROOT || $this->checkRule('Admin/article/recycle'));
        //获取草稿箱权限
        $this->assign('show_draftbox', C('OPEN_DRAFTBOX'));
        //获取审核列表权限
        $this->assign('show_examine', IS_ROOT || $this->checkRule('Admin/article/examine'));
	
	//获得需要更新静态文件的列表
        $cate_caches       =   M('Category')->where(array('status'=>1,"cacheupdate"=>1))->field('id,name,title,pid,allow_publish')->order('pid,sort')->select(); 
	$this->assign("cate_caches",$cate_caches);
    }

    /**
     * 分类文档列表页
     * @param integer $cate_id 分类id
     * @param integer $model_id 模型id
     * @param integer $position 推荐标志
     * @param integer $group_id 分组id
     */
    public function index($cate_id = null, $model_id = null, $position = null,$group_id=null){
        //获取左边菜单
        $this->getMenu();

        if($cate_id===null){
            $cate_id = $this->cate_id;
        }
        if(!empty($cate_id)){
            $pid = I('pid',0);
            // 获取列表绑定的模型
            if ($pid == 0) {
                $models     =   get_category($cate_id, 'model');
		// 获取分组定义
		$groups		=	get_category($cate_id, 'groups');
		if($groups){
			$groups	=	parse_field_attr($groups);
		}
            }else{ // 子文档列表
                $models     =   get_category($cate_id, 'model_sub');
            }
            if(is_null($model_id) && !is_numeric($models)){
                // 绑定多个模型 取基础模型的列表定义
                $model = M('Model')->getByName('document');
            }else{
                $model_id   =   $model_id ? : $models;
                //获取模型信息
                $model = M('Model')->getById($model_id);
                if (empty($model['list_grid'])) {
                    $model['list_grid'] = M('Model')->getFieldByName('document','list_grid');
                }                
            }
            $this->assign('model', explode(',', $models));
        }else{
            // 获取基础模型信息
            $model = M('Model')->getByName('document');
            $model_id   =   null;
            $cate_id    =   0;
            $this->assign('model', null);
        }

        //解析列表规则
        $fields =	array();
        $grids  =	preg_split('/[;\r\n]+/s', trim($model['list_grid']));
        foreach ($grids as &$value) {
            // 字段:标题:链接
            $val      = explode(':', $value);
            // 支持多个字段显示
            $field   = explode(',', $val[0]);
            $value    = array('field' => $field, 'title' => $val[1]);
            if(isset($val[2])){
                // 链接信息
                $value['href']  =   $val[2];
                // 搜索链接信息中的字段信息
                preg_replace_callback('/\[([a-z_]+)\]/', function($match) use(&$fields){$fields[]=$match[1];}, $value['href']);
            }
            if(strpos($val[1],'|')){
                // 显示格式定义
                list($value['title'],$value['format'])    =   explode('|',$val[1]);
            }
            foreach($field as $val){
                $array  =   explode('|',$val);
                $fields[] = $array[0];
            }
        }

        // 文档模型列表始终要获取的数据字段 用于其他用途
        $fields[] = 'category_id';
        $fields[] = 'model_id';
        $fields[] = 'pid';
        // 过滤重复字段信息
        $fields =   array_unique($fields);
        // 列表查询
        $list   =   $this->getDocumentList($cate_id,$model_id,$position,$fields,$group_id);
        // 列表显示处理
        $list   =   $this->parseDocumentList($list,$model_id);
	//var_dump($list);die;
        
        $this->assign('model_id',$model_id);
		$this->assign('group_id',$group_id);
        $this->assign('position',$position);
        $this->assign('groups', $groups);
        $this->assign('list',   $list);
        $this->assign('list_grids', $grids);
        $this->assign('model_list', $model);
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);
        $this->display();
    }

    /**
     * 默认文档列表方法
     * @param integer $cate_id 分类id
     * @param integer $model_id 模型id
     * @param integer $position 推荐标志
     * @param mixed $field 字段列表
     * @param integer $group_id 分组id
     */
    protected function getDocumentList($cate_id=0,$model_id=null,$position=null,$field=true,$group_id=null){
        /* 查询条件初始化 */
        $map = array();
        if(isset($_GET['title'])){
            $map['title']  = array('like', '%'.(string)I('title').'%');
        }
        if(isset($_GET['status'])){
            $map['status'] = I('status');
            $status = $map['status'];
        }else{
            $status = null;
            $map['status'] = array('in', '0,1,2');
        }
        if ( isset($_GET['time-start']) ) {
            $map['update_time'][] = array('egt',strtotime(I('time-start')));
        }
        if ( isset($_GET['time-end']) ) {
            $map['update_time'][] = array('elt',24*60*60 + strtotime(I('time-end')));
        }
        if ( isset($_GET['nickname']) ) {
            $map['uid'] = M('Member')->where(array('nickname'=>I('nickname')))->getField('uid');
        }

        // 构建列表数据
        $Document = M('Document');

        if($cate_id){
            $map['category_id'] =   $cate_id;
        }
        $map['pid']         =   I('pid',0);
        if($map['pid']){ // 子文档列表忽略分类
            unset($map['category_id']);
        }
        $Document->alias('DOCUMENT');
        if(!is_null($model_id)){
            $map['model_id']    =   $model_id;
            if(is_array($field) && array_diff($Document->getDbFields(),$field)){
                $modelName  =   M('Model')->getFieldById($model_id,'name');
                $Document->join('__DOCUMENT_'.strtoupper($modelName).'__ '.$modelName.' ON DOCUMENT.id='.$modelName.'.id');
                $key = array_search('id',$field);
                if(false  !== $key){
                    unset($field[$key]);
                    $field[] = 'DOCUMENT.id';
                }
            } //20181102增加，如果model_id不为空，查询模型对应的默认搜索和高级搜索配置：search_key/search_list
	    $search_info = M("model")->field("search_key,search_list")->where(array("id"=>$model_id))->find();
	    if($search_info['search_key']){
		unset($map['title']);
		$keys_array = explode(",", $search_info['search_key']); 
		if(is_array($keys_array) && isset($_GET['title'])){
		    $gtitle = (string)I('title'); 
		    foreach ($keys_array as $key=>$val){
//			$map[$val]  = array('like', '%'.$gtitle.'%');
			$tempstr = (!empty($tempstr))?($tempstr.' or '.$val .' like '."'%".$gtitle."%'"):($val .' like '."'%".$gtitle."%'"); 
		    } 
		    if($tempstr){
			$map['_string'] = " ".$tempstr." ";
		    }
		}
	    }
	    if($search_info['search_list']){
		$keys_array = explode(",", $search_info['search_list']); 
		if(is_array($keys_array) && isset($_GET['htitle'])){
		    $gtitle = (string)I('htitle'); 
		    foreach ($keys_array as $key=>$val){
//			$map[$val]  = array('like', '%'.$gtitle.'%');
			$tempstr = (!empty($tempstr))?($tempstr.' or '.$val .' like '."'%".$gtitle."%'"):($val .' like '."'%".$gtitle."%'"); 
		    }  
		    if($tempstr){
			$map['_string'] = " ".$tempstr."";
		    }
		}
	    }           
        }
        if(!is_null($position)){
            $map[] = "position & {$position} = {$position}";
        }
		if(!is_null($group_id)){
			$map['group_id']	=	$group_id;
		}
        $list = $this->lists($Document,$map,'level DESC,DOCUMENT.id DESC',$field);

        if($map['pid']){
            // 获取上级文档
            $article    =   $Document->field('id,title,type')->find($map['pid']);
            $this->assign('article',$article);
        }
        //检查该分类是否允许发布内容
        $allow_publish  =   get_category($cate_id, 'allow_publish');

        $this->assign('status', $status);
        $this->assign('allow',  $allow_publish);
        $this->assign('pid',    $map['pid']);

        $this->meta_title = '文档列表';
        return $list;
    }

    /**
     * 设置一条或者多条数据的状态
     * @author huajie <banhuajie@163.com>
     */
    public function setStatus($model='Document'){
        return parent::setStatus('Document');
    }

    /**
     * 文档新增页面初始化
     * @author huajie <banhuajie@163.com>
     */
    public function add(){
        //获取左边菜单
        $this->getMenu();

        $cate_id    =   I('get.cate_id',0);
        $model_id   =   I('get.model_id',0);
		$group_id	=	I('get.group_id','');

        empty($cate_id) && $this->error('参数不能为空！');
        empty($model_id) && $this->error('该分类未绑定模型！');

        //检查该分类是否允许发布
        $allow_publish = check_category($cate_id);
        !$allow_publish && $this->error('该分类不允许发布内容！');

        // 获取当前的模型信息
        $model    =   get_document_model($model_id);

        //处理结果
        $info['pid']            =   $_GET['pid']?$_GET['pid']:0;
        $info['model_id']       =   $model_id;
        $info['category_id']    =   $cate_id;
		$info['group_id']		=	$group_id;

        if($info['pid']){
            // 获取上级文档
            $article            =   M('Document')->field('id,title,type')->find($info['pid']);
            $this->assign('article',$article);
        }
	
        //获取表单字段排序
        $fields = get_model_attribute($model['id']);	
	
	if(in_array($info['model_id'], array(2,12,17,19,21))){
	    foreach ($fields[1] as $tb=>$vb){
		if($vb['name']=='level'){
		    //查找表中level最大值 20170921
		    $level_max  =   M('Document')->field('max(`level`) `level`')->where(array("model_id"=>$info['model_id'],"category_id"=>$info['category_id']))->find();
		    $values = intval($level_max['level'])+1;
		    $fields[1][$tb]['value'] = (string)$values;
		}
	    }
	}
	
	
        $this->assign('info',       $info);
        $this->assign('fields',     $fields);
        $this->assign('type_list',  get_type_bycate($cate_id));
        $this->assign('model',      $model);
        $this->meta_title = '新增'.$model['title'];
        $this->display();
    }

    /**
     * 文档编辑页面初始化
     * @author huajie <banhuajie@163.com>
     */
    public function edit(){
        //获取左边菜单
        $this->getMenu();

        $id     =   I('get.id','');
        if(empty($id)){
            $this->error('参数不能为空！');
        }

        // 获取详细数据 
        $Document = D('Document');
        $data = $Document->detail($id);
        if(!$data){
            $this->error($Document->getError());
        }

        if($data['pid']){
            // 获取上级文档
            $article        =   $Document->field('id,title,type')->find($data['pid']);
            $this->assign('article',$article);
        }
        // 获取当前的模型信息
        $model    =   get_document_model($data['model_id']);

        $this->assign('data', $data);
        $this->assign('model_id', $data['model_id']);
        $this->assign('model',      $model);

        //获取表单字段排序
        $fields = get_model_attribute($model['id']);
        $this->assign('fields',     $fields);


        //获取当前分类的文档类型
        $this->assign('type_list', get_type_bycate($data['category_id']));

        $this->meta_title   =   '编辑文档';
        $this->display();
    }

    /**
     * 更新一条数据
     * @author huajie <banhuajie@163.com>
     */
    public function update(){
        $document   =   D('Document');
        $res = $document->update();
        if(!$res){
            $this->error($document->getError());
        }else{
            $this->success($res['id']?'更新成功':'新增成功', Cookie('__forward__'));
        }
    }

    /**
     * 待审核列表
     */
    public function examine(){
        //获取左边菜单
        $this->getMenu();

        $map['status']  =   2;
        if ( !IS_ROOT ) {
            $cate_auth  =   AuthGroupModel::getAuthCategories(UID);
            if($cate_auth){
                $map['category_id']    =   array('IN',$cate_auth);
            }else{
                $map['category_id']    =   -1;
            }
        }
        $list = $this->lists(M('Document'),$map,'update_time desc');
        //处理列表数据
        if(is_array($list)){
            foreach ($list as $k=>&$v){
                $v['username']      =   get_nickname($v['uid']);
            }
        }

        $this->assign('list', $list);
        $this->meta_title       =   '待审核';
        $this->display();
    }

    /**
     * 回收站列表
     * @author huajie <banhuajie@163.com>
     */
    public function recycle(){
        //获取左边菜单
        $this->getMenu();

        $map['status']  =   -1;
        if ( !IS_ROOT ) {
            $cate_auth  =   AuthGroupModel::getAuthCategories(UID);
            if($cate_auth){
                $map['category_id']    =   array('IN',$cate_auth);
            }else{
                $map['category_id']    =   -1;
            }
        }
        $list = $this->lists(M('Document'),$map,'update_time desc');

        //处理列表数据
        if(is_array($list)){
            foreach ($list as $k=>&$v){
                $v['username']      =   get_nickname($v['uid']);
            }
        }

        $this->assign('list', $list);
        $this->meta_title       =   '回收站';
        $this->display();
    }

    /**
     * 写文章时自动保存至草稿箱
     * @author huajie <banhuajie@163.com>
     */
    public function autoSave(){
        $res = D('Document')->autoSave();
        if($res !== false){
            $return['data']     =   $res;
            $return['info']     =   '保存草稿成功';
            $return['status']   =   1;
            $this->ajaxReturn($return);
        }else{
            $this->error('保存草稿失败：'.D('Document')->getError());
        }
    }

    /**
     * 草稿箱
     * @author huajie <banhuajie@163.com>
     */
    public function draftBox(){
        //获取左边菜单
        $this->getMenu();

        $Document   =   D('Document');
        $map        =   array('status'=>3,'uid'=>UID);
        $list       =   $this->lists($Document,$map);
        //获取状态文字
        //int_to_string($list);

        $this->assign('list', $list);
        $this->meta_title = '草稿箱';
        $this->display();
    }

    /**
     * 我的文档
     * @author huajie <banhuajie@163.com>
     */
    public function mydocument($status = null, $title = null){
        //获取左边菜单
        $this->getMenu();

        $Document   =   D('Document');
        /* 查询条件初始化 */
        $map['uid'] = UID;
        if(isset($title)){
            $map['title']   =   array('like', '%'.$title.'%');
        }
        if(isset($status)){
            $map['status']  =   $status;
        }else{
            $map['status']  =   array('in', '0,1,2');
        }
        if ( isset($_GET['time-start']) ) {
            $map['update_time'][] = array('egt',strtotime(I('time-start')));
        }
        if ( isset($_GET['time-end']) ) {
            $map['update_time'][] = array('elt',24*60*60 + strtotime(I('time-end')));
        }
        //只查询pid为0的文章
        $map['pid'] = 0;
        $list = $this->lists($Document,$map,'update_time desc');
        $list = $this->parseDocumentList($list,1);

        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);
        $this->assign('status', $status);
        $this->assign('list', $list);
        $this->meta_title = '我的文档';
        $this->display();
    }

    /**
     * 还原被删除的数据
     * @author huajie <banhuajie@163.com>
     */
    public function permit(){
        /*参数过滤*/
        $ids = I('param.ids');
        if(empty($ids)){
            $this->error('请选择要操作的数据');
        }

        /*拼接参数并修改状态*/
        $Model  =   'Document';
        $map    =   array();
        if(is_array($ids)){
            $map['id'] = array('in', $ids);
        }elseif (is_numeric($ids)){
            $map['id'] = $ids;
        }
        $this->restore($Model,$map);
    }

    /**
     * 清空回收站
     * @author huajie <banhuajie@163.com>
     */
    public function clear(){
        $res = D('Document')->remove();
        if($res !== false){
            $this->success('清空回收站成功！');
        }else{
            $this->error('清空回收站失败！');
        }
    }

    /**
     * 移动文档
     * @author huajie <banhuajie@163.com>
     */
    public function move() {
        if(empty($_POST['ids'])) {
            $this->error('请选择要移动的文档！');
        }
        session('moveArticle', $_POST['ids']);
        session('copyArticle', null);
        $this->success('请选择要移动到的分类！');
    }

    /**
     * 拷贝文档
     * @author huajie <banhuajie@163.com>
     */
    public function copy() {
        if(empty($_POST['ids'])) {
            $this->error('请选择要复制的文档！');
        }
        session('copyArticle', $_POST['ids']);
        session('moveArticle', null);
        $this->success('请选择要复制到的分类！');
    }

    /**
     * 粘贴文档
     * @author huajie <banhuajie@163.com>
     */
    public function paste() {
        $moveList = session('moveArticle');
        $copyList = session('copyArticle');
        if(empty($moveList) && empty($copyList)) {
            $this->error('没有选择文档！');
        }
        if(!isset($_POST['cate_id'])) {
            $this->error('请选择要粘贴到的分类！');
        }
        $cate_id = I('post.cate_id');   //当前分类
        $pid = I('post.pid', 0);        //当前父类数据id

        //检查所选择的数据是否符合粘贴要求
        $check = $this->checkPaste(empty($moveList) ? $copyList : $moveList, $cate_id, $pid);
        if(!$check['status']){
            $this->error($check['info']);
        }

        if(!empty($moveList)) {// 移动    TODO:检查name重复
            foreach ($moveList as $key=>$value){
                $Model              =   M('Document');
                $map['id']          =   $value;
                $data['category_id']=   $cate_id;
                $data['pid']        =   $pid;
                //获取root
                if($pid == 0){
                    $data['root'] = 0;
                }else{
                    $p_root = $Model->getFieldById($pid, 'root');
                    $data['root'] = $p_root == 0 ? $pid : $p_root;
                }
                $res = $Model->where($map)->save($data);
            }
            session('moveArticle', null);
            if(false !== $res){
                $this->success('文档移动成功！');
            }else{
                $this->error('文档移动失败！');
            }
        }elseif(!empty($copyList)){ // 复制
            foreach ($copyList as $key=>$value){
                $Model  =   M('Document');
                $data   =   $Model->find($value);
                unset($data['id']);
                unset($data['name']);
                $data['category_id']    =   $cate_id;
                $data['pid']            =   $pid;
                $data['create_time']    =   NOW_TIME;
                $data['update_time']    =   NOW_TIME;
                //获取root
                if($pid == 0){
                    $data['root'] = 0;
                }else{
                    $p_root = $Model->getFieldById($pid, 'root');
                    $data['root'] = $p_root == 0 ? $pid : $p_root;
                }

                $result   =  $Model->add($data);
                if($result){
                    $logic      =   D(get_document_model($data['model_id'],'name'),'Logic');
                    $data       =   $logic->detail($value); //获取指定ID的扩展数据
                    $data['id'] =   $result;
                    $res        =   $logic->add($data);
                }
            }
            session('copyArticle', null);
            if($res){
                $this->success('文档复制成功！');
            }else{
                $this->error('文档复制失败！');
            }
        }
    }

    /**
     * 检查数据是否符合粘贴的要求
     * @author huajie <banhuajie@163.com>
     */
    protected function checkPaste($list, $cate_id, $pid){
        $return = array('status'=>1);
        $Document = D('Document');

        // 检查支持的文档模型
        $modelList =   M('Category')->getFieldById($cate_id,'model');   // 当前分类支持的文档模型
        foreach ($list as $key=>$value){
            //不能将自己粘贴为自己的子内容
            if($value == $pid){
                $return['status'] = 0;
                $return['info'] = '不能将编号为 '.$value.' 的数据粘贴为他的子内容！';
                return $return;
            }
            // 移动文档的所属文档模型
            $modelType  =   $Document->getFieldById($value,'model_id');
            if(!in_array($modelType,explode(',',$modelList))) {
                $return['status'] = 0;
                $return['info'] = '当前分类的文档模型不支持编号为 '.$value.' 的数据！';
                return $return;
            }
        }

        // 检查支持的文档类型和层级规则
        $typeList =   M('Category')->getFieldById($cate_id,'type'); // 当前分类支持的文档模型
        foreach ($list as $key=>$value){
            // 移动文档的所属文档模型
            $modelType  =   $Document->getFieldById($value,'type');
            if(!in_array($modelType,explode(',',$typeList))) {
                $return['status'] = 0;
                $return['info'] = '当前分类的文档类型不支持编号为 '.$value.' 的数据！';
                return $return;
            }
            $res = $Document->checkDocumentType($modelType, $pid);
            if(!$res['status']){
                $return['status'] = 0;
                $return['info'] = $res['info'].'。错误数据编号：'.$value;
                return $return;
            }
        }

        return $return;
    }

    /**
     * 文档排序
     * @author huajie <banhuajie@163.com>
     */
    public function sort(){
        if(IS_GET){
            //获取左边菜单
            $this->getMenu();

            $ids        =   I('get.ids');
            $cate_id    =   I('get.cate_id');
            $pid        =   I('get.pid');

            //获取排序的数据
            $map['status'] = array('gt',-1);
            if(!empty($ids)){
                $map['id'] = array('in',$ids);
            }else{
                if($cate_id !== ''){
                    $map['category_id'] = $cate_id;
                }
                if($pid !== ''){
                    $map['pid'] = $pid;
                }
            }
            $list = M('Document')->where($map)->field('id,title')->order('level DESC,id DESC')->select();

            $this->assign('list', $list);
            $this->meta_title = '文档排序';
            $this->display();
        }elseif (IS_POST){
            $ids = I('post.ids');
            $ids = array_reverse(explode(',', $ids));
            foreach ($ids as $key=>$value){
                $res = M('Document')->where(array('id'=>$value))->setField('level', $key+1);
            }
            if($res !== false){
                $this->success('排序成功！');
            }else{
                $this->error('排序失败！');
            }
        }else{
            $this->error('非法请求！');
        }
    }
    
    
    /*
     * 新增静态化操作功能，对特定内容按全局缓存路径结构生成静态化文件
     * 1、index.php开启全局配置，增加：define('HTML_PATH', './HTML/');//生成静态页面的文件位置
     * 2、/HTML/目录子目录结构为model/action/xxx.html格式，代表模块名称/操作名/文件名称。与config.php配置文件中缓存规则参数一致。配置规则参考如下：
    'HTML_CACHE_ON'   => true,     // 开启静态缓存
    'HTML_CACHE_TIME' => 604800,   // 全局静态缓存有效期（秒）(3600*24*7=604800)
    'HTML_FILE_SUFFIX'=> '.html',  // 设置静态缓存文件后缀
     *  'HTML_CACHE_RULES'=> array(    // 定义静态缓存规则
	     // 定义格式1 数组方式
	     //后一个参数是静态缓存有效期,单位为秒。如果不定义，则会获取配置参数HTML_CACHE_TIME 的设置值，如果定义为0则表示永久缓存。
	     'Index:index'    =>array('{:module}/{:controller}',86400),
	    // 'Anli:index'    =>array('{:module}/{:controller}/{fengge}_{jushi}_{mianji}_{p}_list',120),
	     'Anli:detail'    =>array('{:module}/{:controller}/{aid}'),
	     'Shejishi:index'    =>array('{:module}/{:controller}/{area}_{rank}_{p}_list'),
	     'Shejishi:detail'    =>array('{:module}/{:controller}/{aid}'),
     * 
     */
    
    /**
     * 更新首页缓存 
     */
    public function createindex(){
        //获取左边菜单
        $this->getMenu();
	if(IS_POST && IS_AJAX){
	    if($_REQUEST['del']==1){
		if(file_exists("./HTML/Home/Index.html")){
		    unlink("./HTML/Home/Index.html");
		    die(json_encode(array("errCode"=>"0","message"=>"SUCCESS")));//$this->success('更新成功');
		}
		if(file_exists("./HTML/home/index.html")){
		    unlink("./HTML/iome/index.html");
		    die(json_encode(array("errCode"=>"0","message"=>"SUCCESS")));$this->success('更新成功');
		}
		die(json_encode(array("errCode"=>"10000","message"=>"缓存文件不存在！")));
	    }else if($_REQUEST['del']==2){
		if(file_exists("./HTML/Mob/Index.html")){
		    unlink("./HTML/Mob/Index.html");
		    die(json_encode(array("errCode"=>"0","message"=>"SUCCESS")));$this->success('更新成功');
		}
		if(file_exists("./HTML/mob/index.html")){
		    unlink("./HTML/mob/index.html");
		    die(json_encode(array("errCode"=>"0","message"=>"SUCCESS")));$this->success('更新成功');
		} 
		die(json_encode(array("errCode"=>"10000","message"=>"缓存文件不存在！")));
	    }
	}
	
        $this->assign('list',   $list); 
        $this->display();
    }
    
    /**
     * 更新文件 
     */
    public function createdocument(){
        //获取左边菜单
        $this->getMenu();
	$dtype= empty($_REQUEST['dtype'])?"shejishi":$_REQUEST['dtype'];
	$updsort= empty($_REQUEST['updsort'])?"1":$_REQUEST['updsort'];//更新时间排序，默认按PC端更新时间
	
	     //页码
	$pageSize = 40;
	$pindex = max(1, intval($_REQUEST['p']));
	$psize  = $pageSize;
	$start = ($pindex-1)*$psize;
	
	$map['document.status']='1';
	$sortcondition = ($updsort==1)?("cacheupdate_pc,"):("cacheupdate_mob,");
	if($dtype=='shejishi'){
	    
	}else if($dtype=='anli'){
	    
	}else if($dtype=='news'){
	    
	}
	//获得视图名称，驼峰命名，如shejishi目录视图名为Shejishi
	$dirtemp = strtoupper(substr($dtype, 0,1)). substr($dtype, 1); 
	
	$count=D($dirtemp."View")->where($map)->count();

	$page =new \Think\Page($count,$pageSize);
	$start = $page->firstRow;
	$psize = $page->listRows;
	

	$list=D($dirtemp."View")->where($map)->order($sortcondition."document.id desc")->limit($start.",".$psize)->select();  
      //  var_dump($list[0]);
	$timenow = time()-1200; 
	$total =  D($dirtemp."View")->where("document.status=1")->count();   
	$complete_pc =  D($dirtemp."View")->where("document.status=1 and cacheupdate_pc>{$timenow}")->count();  
	$complete_mob =  D($dirtemp."View")->where("document.status=1 and cacheupdate_mob>{$timenow}")->count();  
	
	//设置分页主题，如果没有这个设置，页面上不会显示有多少个记录
	$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
	//将分页显示到前端
	$str_page = $page->show();
	$this->assign("_page",$str_page);
	
	
        $this->assign('total',   $total);
        $this->assign('complete_pc',   $complete_pc);
        $this->assign('complete_mob',   $complete_mob);
        $this->assign('updsort',   $updsort);
        $this->assign('dtype',   $dtype);
        $this->assign('list',   $list); 
        $this->display();
    }
        
    /**
     * 更新内容页缓存 
     */
    public function ajaxUpdateDocument(){ 
	if(IS_POST && IS_AJAX){ 
	    if(empty($_REQUEST['dtype'])){
		die(json_encode(array("errCode"=>"10000","message"=>"参数错误，请刷新后重试！")));
	    }
	     die(json_encode(array("errCode"=>"0","message"=>"SUCCESS")));$this->success('更新成功');
	}
    }
    
    /**
     * 原理就是：每一个栏目或者内容都唯一的URL路径，根据链接将内容提取出来，然后重新保存文件就是静态化之后的文件。页面中原有的a标签带有的链接，
     * 都通过正则表达式匹配之后，重新替换，以保证在一个静态页面中点击链接跳转到的下一个页面也是HTML/目录下的静态化页面。
     * 参数分别为（栏目或内容的URL路径，静态文件保存路径，生成静态文件的文件名）
     * @param string $url
     * @param type $dir
     * @param type $filename
     * @return type
     */
   public function createHtml($url,$dir,$filename){
 
	$content = file_get_contents($url);                 //获取内容
	
	if (!is_dir($dir)){                                 //如果目录不存在
		mkdir(iconv("UTF-8", "GBK", $dir),0777,true);   //创建目录(777权限)
	}
	
	/**
	 * 文档中的动态链接暂时不做替换，缓存生成静态文档后，如果文档中还有其他文档的连接是动态，暂时保留， 我们只在查询列表中打开进入详情页采用静态路径
	 */
	if(0){
	    
	    //-------------------------------------------处理导航链接-------------------------
	    $listurls = "/[\'|\"]\/App\/Index\/articalList\/id\/(.*?)[\'|\"]/";
	    preg_match_all($listurls,$content,$matchlist);
	    foreach ( $matchlist[1] as $key => $value ) {
		    $value = trim($value);
		    $map['catdir'] = $value;
		    $cat = M('cms_cate')->where($map)->limit(1)->find();
		    if($cat['lv'] == 1){
			    $listurl = "\"/HTML/".$value.".html\"";
		    }else if(!empty($cat['pid']) && ($cat['lv'] == 2)){
			    $pid = $cat['pid'];
			    $tmap['id']=$pid;
			    $pcat = M('cms_cate')->where($tmap)->limit(1)->find();
			    $pcatdir = $pcat['catdir'];
			    $listurl = "\"/HTML/".$pcatdir."/".$value.".html\"";
		    }

		    $content = str_replace ( $matchlist[0][$key], $listurl, $content ); 
	    }
	    //-----------------------------------------------------------------------------------


	    //------------------------------------处理文章列表页---------------------------------
	    //列表页链接进入内容页
	    $infourl = "/href=[\'|\"]\/App\/Index\/articalInfo\/id\/(.*?)[\'|\"]/";
	    preg_match_all($infourl,$content,$matchlist);
	    foreach($matchlist[1] as $key => $value){
		    $value = trim($value);
		    $map['id'] = $value;
		    $cateid = M('Artical')->where($map)->limit(1)->getField('cateid');
		    $cat = M('cms_cate')->where('id=' . $cateid)->limit(1)->find();
		    if($cat['lv'] == 1){
			    $info = "href='/HTML/".$cat['catdir']."/".$value.".html'";
		    }else if(!empty($cat['pid']) && ($cat['lv'] == 2)){
			    $pid = $cat['pid'];
			    $tmap['id']=$pid;
			    $pcat = M('cms_cate')->where($tmap)->limit(1)->find();
			    $pcatdir = $pcat['catdir'];      
			    $info = "href='/HTML/".$pcatdir."/".$cat['catdir']."/".$value.".html'";
		    }

		    $content = str_replace ( $matchlist[0][$key], $info, $content ); 
	    }

	    //文章列表分页
	    $page = "/<a (.*?) href=[\'|\"]\/Index\/articalList\/id\/(.*?)\/p\/(.*?)[\'|\"]>/";
	    preg_match_all($page,$content,$matchpage);
	    foreach ( $matchpage[3] as $key1 => $value1 ) {
		    foreach ( $matchpage[1] as $key2 => $value2 ) {
			    if($key1 == $key2){
				    $value1 = trim($value1);
				    $value2 = trim($value2);
				    $url = '<a '.$value2.' href="/HTML/'.$matchpage[2][0].'_'.$value1.'.html">';
				    $content = str_replace ( $matchpage[0][$key1], $url, $content );
			    }
		    }
	    } 
	    //-----------------------------------------------------------------------------------
	}
	
	//生成的文件路径与文件名
	$path = $dir."/".$filename.".html";
	if(file_exists($path)){
		unlink($path);                   //删除已有的同名文件
	}
	//'w' 写入方式打开，将文件指针指向文件头并将文件大小截为零。如果文件不存在则尝试创建之。  
	$fp = fopen($path, "w");             
	$flag = fwrite($fp, $content);       //写入内容
	fclose($fp);
	
	return $flag;                        //返回写入标识[成功/失败]
}

    //首页页面静态化,如果根目录下PC和手机要两个index.html会有冲突，所以可以首页不静态化，直接用缓存的静态文件放在HTML目录的不同模块下，如Home和Mob分别是PC和手机目录
    public function setindexhtml(){

	    $host = I("server.HTTP_HOST");

	    $url = 'http://'.$host.'/index.php';

	    $dir = './';               //存放路径

	    $filename = 'index';       //分类名当文件名
	    $res = createHtml($url,$dir,$filename);
	    if($res){
		    $this->ajaxReturn(array("status"=>"1","msg"=>"操作成功"));
	    }else{
		    $this->ajaxReturn(array("status"=>"0","msg"=>"操作失败"));
	    }
    }

    //文章列表页静态化，包括对分页查询列表和单页内容进行静态化功能，暂不使用分页列表静态化，方法中表需根据实际后台调整
    public function sethtmlbak2018(){
	    $_G = F('f_data');
	    $id =  I("get.id"); //文章内容id编号
	    $m = M('cms_cate'); //文章分类表
	    if (!$id) {
		    $info['status'] = 0;
		    $info['msg'] = 'ID不能为空!';
		    $this->ajaxReturn($info);
	    }
	    $catdir = trim($id);
	    $map['catdir']=$catdir;
	    $cat = $m->where($map)->limit(1)->find(); //查询分类配置表获取分类信息记录
	    if (empty($cat)) {
		    $info['status'] = 0;
		    $info['msg'] = '操作失败,请检查此分类!';
		    $this->ajaxReturn($info);
	    }
	    $psize = $_G['pagesize']['svalue'];          //每个分页展示几条数据
	    $tmap['cateid'] = $cat['id'];
	    $tmap['status'] = 1;
	    if($cat['model'] == 'artical'){
		    $count = M('artical')->where($tmap)->count();//当前分类下文章总数
	    }else if($cat['model'] == 'product'){
		    $count = M('product')->where($tmap)->count();
	    }
	    $pagecount = ceil(intval($count)/intval($psize));   //分页数(向上取整)
	    $host = I("server.HTTP_HOST");
	    //多页面,列表分页
	    if($pagecount > 1){
		    for($i=1;$i<=$pagecount;$i++){
			    $url = 'http://'.$host.'/App/Index/articalList/id/'.$catdir.'/p/'.$i.'';
			    if($cat['lv'] == 1){
				    $dir = './HTML/';  //存放路径
			    }else if(!empty($cat['pid']) && ($cat['lv'] == 2)){   //当前类有父级分类
				    $pid = $cat['pid'];
				    $tmap['id']=$pid;
				    $pcat = $m->where($tmap)->limit(1)->find();
				    $pcatdir = $pcat['catdir'];
				    $dir = './HTML/'.$pcatdir;    //存放路径
			    }
			    $filename = $catdir.'_'.$i;           //分类名[当前文件名]
			    $res = createHtml($url,$dir,$filename);//创建静态文件
			    if(!$res){
				    $this->ajaxReturn(array("status"=>"0","msg"=>"操作失败"));exit();
			    }
		    }
	    }
	    //单页面
	    $url = 'http://'.$host.'/App/Index/articalList/id/'.$catdir.'';
	    if($cat['lv'] == 1){
		    $dir = './HTML/';                //存放路径
	    }else if(!empty($cat['pid']) && ($cat['lv'] == 2)){
		    $pid = $cat['pid'];
		    $tmap['id']=$pid;
		    $pcat = $m->where($tmap)->limit(1)->find();
		    $pcatdir = $pcat['catdir'];
		    $dir = './HTML/'.$pcatdir;      //存放路径
	    }
	    $filename = $catdir;                    //分类名当文件名
	    $res = createHtml($url,$dir,$filename);
	    if($res){
		    $this->ajaxReturn(array("status"=>"1","msg"=>"静态页面创建成功"));
	    }else{
		    $this->ajaxReturn(array("status"=>"0","msg"=>"操作失败"));
	    }
    }

    
    //内容页面静态化，不包括查询列表页面,静态化指定id的文档内容
    public function sethtml(){
	    $id =  I("get.id"); //需要静态化的文档内容页id
	    $otype = I("get.otype");//1更新pc端
	    if (!$id) {
		    $info['status'] = 0;
		    $info['msg'] = 'ID不能为空!';
		    $this->ajaxReturn($info);
	    }
	    $map['id'] = $id;
	    //先查询模型分类获得文档分类表名称 
	    //$map   = array('status' => 1, 'extend' => 1);
	    $document = M('document')->field("id,model_id")->where($map)->find();//
	    $cat = M('Model')->field("id,name")->where(array("id"=>$document['model_id']))->find();//
	    if (empty($cat['name'])) {
		    $info['status'] = 0;
		    $info['msg'] = '操作失败,请检查此分类!';
		    $this->ajaxReturn($info);
	    }
	    $host = I("server.HTTP_HOST");
	    //获得目录，驼峰命名
	    $dirtemp = strtoupper(substr($cat['name'], 0,1)). substr($cat['name'], 1);
	    if(strtolower($dirtemp)=="article"){ 
	    }
	   // echo $dirtemp;die;
	    
	    //移动和pc端都需要更新  
	    if($otype==1){
		$dir = './HTML/Home/'.$dirtemp;     //pc端存放路径
		$url = 'http://'.$host.'/index.php/home/'.$dirtemp.'/detail/aid/'.$id.'';
	    }else{
		$dir = './HTML/Mob/'.$dirtemp;     //移动端存放路径 
		$url = 'http://'.$host.'/index.php/mob/'.$dirtemp.'/detail/aid/'.$id.'';
	    }
	    
	    $filename = $id;        //ID当文件名
	    $res = $this->createHtml($url,$dir,$filename);
	    if($res){
		    if($otype==1){
			//更新数据库中缓存更新时间
			M('document')->where(array("id"=>$value['id']))->save(array("cacheupdate_pc"=> time()));
		    }
		    if($otype==2){
			//更新数据库中缓存更新时间
			M('document')->where(array("id"=>$value['id']))->save(array("cacheupdate_mob"=> time()));
		    }
	    
		    $this->ajaxReturn(array("status"=>"1","msg"=>"静态页面创建成功"));
	    }else{
		    $this->ajaxReturn(array("status"=>"0","msg"=>"操作失败"));
	    }
    }

    //一键静态化当前分类下所有文章内容页页面
    public function sethtmlall(){
	    //C('DEFAULT_THEME','App/default/');
	    $data = I('get.');
	    $cateid = $data['cateid'];//对应document表model_id参数
	    $otype = $data['otype'];//1更新pc端
	    $map['model_id'] = $cateid;
	    $map['status'] = 1;
	    $cat = M('Model')->field("id,name")->where(array("id"=>$cateid))->find();//
	    if (empty($cat['name'])) {
		    $info['status'] = 0;
		    $info['msg'] = '操作失败,请检查此分类!';
		    $this->ajaxReturn($info);
	    }
	    //查询所有文档ID
	    $timenow = time()-1200;
	    if($otype==1){
		$dfiles = M('document')->field("id,title")->where("model_id={$cateid} and status=1 and cacheupdate_pc<{$timenow}")->limit("10")->select();
	    }else{
		$dfiles = M('document')->field("id,title")->where("model_id={$cateid} and status=1 and cacheupdate_mob<{$timenow}")->limit("10")->select();
	    }
	    $host = I("server.HTTP_HOST");
	    //获得目录，驼峰命名
	    $dirtemp = strtoupper(substr($cat['name'], 0,1)). substr($cat['name'], 1);
	    if(strtolower($dirtemp)=="article"){
//		$dirtemp="News";
	    }
	    foreach($dfiles as $key => $value){
		    if($otype==1){
			$dir = './HTML/Home/'.$dirtemp;     //pc端存放路径
			$url = 'http://'.$host.'/index.php/home/'.$dirtemp.'/detail/aid/'.$value['id'].'';
		    }else{
			$dir = './HTML/Mob/'.$dirtemp;     //移动端存放路径 
			$url = 'http://'.$host.'/index.php/mob/'.$dirtemp.'/detail/aid/'.$value['id'].'';
		    } 
		    $filename = $value['id'];
		    $res = $this->createHtml($url,$dir,$filename);                  //创建静态文件
		    if(!$res){
			   // $this->ajaxReturn(array("status"=>"0","msg"=>"操作失败"));
			   // exit();
			//失败后续更新下一个
		    }else{
			if($otype==1){
			    //更新数据库中缓存更新时间
			    M('document')->where(array("id"=>$value['id']))->save(array("cacheupdate_pc"=> time()));
			}
			if($otype==2){
			    //更新数据库中缓存更新时间
			    M('document')->where(array("id"=>$value['id']))->save(array("cacheupdate_mob"=> time()));
			}
		    }
	    }
	    //循环完成后，查询更新情况，10分钟内更新的才是本次更新的，否则是以前的
	    $total =  M('document')->where($map)->count();  
	    $complete_pc =  M('document')->where("model_id={$cateid} and status=1 and cacheupdate_pc>{$timenow}")->count();  
	    $complete_mob =  M('document')->where("model_id={$cateid} and status=1 and cacheupdate_mob>{$timenow}")->count();
	    $left=$total;
	    if($otype==1){
		$left = $total-$complete_pc;
	    }else{
		$left = $total-$complete_mob;
	    }
	    $this->ajaxReturn(array("status"=>"1","msg"=>"静态页面创建成功","total"=>$total,"complete_pc"=>$complete_pc,"complete_mob"=>$complete_mob,"left"=>$left));
    }

    //一键删除静态化分类文档目录
    public function delFiles(){
	    //C('DEFAULT_THEME','App/default/');
	    $data = I('get.');
	    $cateid = $_REQUEST['cateid'];//对应document表model_id参数
	    $otype = $_REQUEST['otype'];//1更新pc端
	    $keepthis = $_REQUEST['keepthis'];//保留本次更新文件
	    $map['model_id'] = $cateid;
	    $map['status'] = 1;
	    $cat = M('Model')->field("id,name")->where(array("id"=>$cateid))->find();//
	    if (empty($cat['name'])) {
		    $info['status'] = 0;
		    $info['msg'] = '操作失败,请检查此分类!';
		    $this->ajaxReturn($info);
	    }
	    //获得目录，驼峰命名
	    $dirtemp = strtoupper(substr($cat['name'], 0,1)). substr($cat['name'], 1);
	    if(strtolower($dirtemp)=="article"){
		//$dirtemp="News";
	    }
	    //删除文档目录
	    if($otype==1){
		$dir = './HTML/Home/'.$dirtemp;     //pc端存放路径
		$url = 'http://'.$host.'/index.php/home/'.$dirtemp.'/detail/aid/'.$value['id'].'';
	    }else{
		$dir = './HTML/Mob/'.$dirtemp;     //移动端存放路径 
		$url = 'http://'.$host.'/index.php/mob/'.$dirtemp.'/detail/aid/'.$value['id'].'';
	    } 
	   if (is_dir($dir)){                                 //如果目录不存在 
	       //删除整个目录
	        //先删除目录下的文件：
		$dh=opendir($dir);
		while ($file=readdir($dh)) {
		  if($file!="." && $file!="..") {
		    $fullpath=$dir."/".$file;
		    if(!is_dir($fullpath)) {
			if($keepthis==1){
			    $mtime = filemtime($fullpath);	 
			    $ctime = filectime($fullpath);
			    $mtime_dt = date("Y-m-d H:i:s",$mtime);
			    $ctime_dt = date("Y-m-d H:i:s",$ctime);
			    if($mtime< time()-1200 && $ctime<time()-1200){
				unlink($fullpath);
			    }
			}else{
			    unlink($fullpath);
			}
		    } else {
			deldir($fullpath);
		    }
		  }
		}

		closedir($dh);
		if($keepthis==1){ 
		}else{
		    //删除当前文件夹：
		    if(rmdir($dir)) {
		      //return true;
		    } else {
    //		  //return false;
			$info['status'] = 0;
			$info['msg'] = '删除失败!';
			$this->ajaxReturn($info);
		    }
		}
	    }
	    
	    //更新分类文档缓存时间
	    if($otype==1){
		//更新数据库中缓存更新时间
		M('document')->where(array("model_id"=>$cateid))->save(array("cacheupdate_pc"=> 0));
	    }
	    if($otype==2){
		//更新数据库中缓存更新时间
		M('document')->where(array("model_id"=>$cateid))->save(array("cacheupdate_mob"=> 0));
	    }
	    
	    $this->ajaxReturn(array("status"=>"1","msg"=>"操作成功"));
    }
    
}