<?php 
namespace Common\Model;
use Think\Model\ViewModel;
class DocumentViewModel extends ViewModel {
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
			'litpic'=>'litpic',
			'_type'=>'LEFT',
			),
		'document_loupan'=>array(
			 'id'=>'dloupan',  
			'_on'=>'document_loupan.id=document.id',
			'_type'=>'LEFT',
			), 
		'document_anli'=>array(
			 'id'=>'danli',  
			'_on'=>'document_anli.id=document.id',
			'_type'=>'LEFT',
			), 
		'document_quanjin'=>array(
			 'id'=>'quanjin',  
			 'out_url'=>'out_url',  
			'_on'=>'document_quanjin.id=document.id',
			'_type'=>'LEFT',
			), 
		'document_article'=>array(
			 'id'=>'darticle',  
			 'ftype',  
			'_on'=>'document_article.id=document.id',
			'_type'=>'LEFT',
			), 
		'document_gongdi'=>array(
			 'id'=>'dgongdi',  
			'_on'=>'document_gongdi.id=document.id',
			'_type'=>'LEFT',
			), 
		'document_shejishi'=>array(
			 'id'=>'dshejishi',  
			'_on'=>'document_shejishi.id=document.id',
			'_type'=>'LEFT',
			),
        'picture'=>array( 
			'path'=>'picpath',
			'_on'=>'document.cover_id=picture.id',
			), 
	);
} 
?>