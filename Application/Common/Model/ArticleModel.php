<?php
namespace Common\Model;
use Think\Model;
class ArticleModel extends Model {
    protected $fields = array(
        'id',
	    'parse',
	    'content',
	    'template',
	    'bookmark',
	    'ftype',
		'_pk'=>'id',
		'_autoInc'=>true
	);
}