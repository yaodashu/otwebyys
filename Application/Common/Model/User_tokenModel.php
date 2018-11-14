<?php
namespace Common\Model;
use Think\Model;
class User_tokenModel extends Model {
    protected $fields = array(
        'uid',  
	'token',
	'time', 
	'_pk'=>'uid'
	);
}