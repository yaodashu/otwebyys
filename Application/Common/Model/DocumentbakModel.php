<?php
namespace Common\Model;
use Think\Model;
class DocumentModel extends Model {
    protected $fields = array(
       'id',
	    'uid',
	    'name',
	    'title',
	    'category_id',
	    'group_id',
	    'description',
	    'root',
	    'pid',
	    'model_id',
	    'type',
	    'position',
	    'link_id',
	    'cover_id',
	    'display',
	    'deadline',
	    'attach',
	    'view',
	    'comment',
	    'extend',
	    'level',
	    'create_time',
	    'update_time',
	    'status',
	    'writer',
	    'source',
	    'mid',
	    'keywords',
	    'dutyadmin',
	    'userip',
		'_pk'=>'id',
		'_autoInc'=>true
	);
}