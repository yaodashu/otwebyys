<?php 
namespace Common\Model;
use Think\Model\ViewModel;
class ShejishiViewModel extends ViewModel {
	protected $viewFields=array(
        'document'=>array(
			'id'=>'did',  
			'uid'=>'uid',
			'name'=>'dname',
			'title'=>'dtitle',
			'category_id'=>'category_id',
			'group_id'=>'group_id',
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
		'document_shejishi'=>array(
			  'id', 
			    'aid',
			       'nickname',
			       'sno',
			       'area',
			       'rank',
			       'school',
			       'linian',
			       'years',
			       'shanchang',
				'yuyuenum',
				'lastupdatenum',
				'zuoping',
				'num_zuoping', 
				 'headerpic', 
				'rongyu', 
				'real_zuoping',
			'_on'=>'document_shejishi.id=document.id',
			'_type'=>'LEFT',
			),
        'sys_enum_area'=>array( 
			'ename'=>'areaname',
			'_on'=>'document_shejishi.area=sys_enum_area.evalue',
			'_type'=>'LEFT',
			),
        'sys_enum_rank'=>array( 
			'ename'=>'rankname',
			'disorder'=>'sorder',
			'_on'=>'document_shejishi.rank=sys_enum_rank.evalue',
			'_type'=>'LEFT',
			), 
        'picture'=>array( 
			'path'=>'picpath',
			'_on'=>'document.cover_id=picture.id',
			),
	);
} 
?>