<?php
namespace Common\Model;
use Think\Model;
class ShejishiModel extends Model {
    protected $fields = array(
        'id', 
	 'aid',
	    'nickname',
	    'sno',
	    'content',
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
		'_pk'=>'id',
		'_autoInc'=>true
	);
}