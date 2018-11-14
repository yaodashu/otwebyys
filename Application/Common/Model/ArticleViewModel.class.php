<?php 
namespace Common\Model;
use Think\Model\ViewModel;
class ArticleViewModel extends ViewModel {
	protected $viewFields=array(
        'document'=>array(
			'id'=>'did',  
			'uid'=>'uid',
			'name'=>'dname',
			'title'=>'dtitle',
			'category_id'=>'category_id',
			'group_id'=>'group_id',
			'description'=>'description',
			'root'=>'root',
			'pid'=>'pid',
			'model_id'=>'model_id',
			'type'=>'dtype',
			'position'=>'position',
			'link_id'=>'link_id',
			'cover_id'=>'cover_id',
			'view'=>'view',
			'comment'=>'comment',
			'extend'=>'extend',
			'level'=>'level',
			'status'=>'status',
			'create_time'=>'create_time', 
			'litpic'=>'litpic'
			),
		'document_article'=>array(
			  'id',
			    'parse',
			    'content',
			    'template',
			    'bookmark',
			    'ftype',
			'_on'=>'document_article.id=document.id', 
			'_type'=>'LEFT',
			), 
		 'picture'=>array( 
			'path'=>'picpath',
			'_on'=>'document.cover_id=picture.id',
			),
	);
} 
?>