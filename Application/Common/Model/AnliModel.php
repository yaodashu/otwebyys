<?php
namespace Common\Model;
use Think\Model;
class AnliModel extends Model {
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
	    'home_pos',
	    'home_cover',
	    'home_sort',
	    'detailpic',
	    'edate',
		'_pk'=>'id',
		'_autoInc'=>true
	);
}