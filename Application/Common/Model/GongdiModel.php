<?php
namespace Common\Model;
use Think\Model;
class GongdiModel extends Model {
    protected $fields = array(
        'id', 
	   'aid',
	    'fengge',
	    'content',
	    'imgids',
	    'shejishi',
	    'loupan',
	    'mianji',
	    'jushi',
	    'zaojia',
	    'fangshi',
	    'zhucai',
	    'gongqi',
	    'edate',
	    'areaid',
	    'zxstep',
	    'imgids_kg',
	    'imgids_sg',
	    'imgids_jg',
		'_pk'=>'id',
		'_autoInc'=>true
	);
}