<?php
namespace Common\Model;
use Think\Model;
class LoupanModel extends Model {
    protected $fields = array(
        'id',  
	    'content',
	    'imgids',
	    'custnum', 
	    'areaid', 
	    'ltype', 
	    'lastupdatenum',
		'_pk'=>'id',
		'_autoInc'=>true
	);
}