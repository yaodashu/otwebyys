<?php
namespace Common\Model;
use Think\Model;
class QuanjinModel extends Model {
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
	    'edate',
	    'out_url',
	    'pic_vr1',
		'_pk'=>'id',
		'_autoInc'=>true
	);
}