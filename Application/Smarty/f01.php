<?php
//һ���򵥵�smartyʾ��
//���ڿ�
include 'libs/Smarty.class.php';



//ʵ��������
$smarty = new Smarty();

//�޸�Ĭ������

//�����
$smarty->setLeftDelimiter('<{'); //���������Ƽ�
//$smarty->left_delimiter = '<{'; //��������
$smarty->right_delimiter = '}>'; //��������

//����ģ��·��
$smarty->setTemplateDir('view');

//���ñ�����ļ�·��
$smarty->setCompileDir('runtime/view_c');

//���û���·��(Ҫ�����������Ŀ¼�Żᱻʹ��)
$smarty->setCacheDir('runtime/cache');

//���������ļ�·��
$smarty->setConfigDir('config');


//��������
$smarty->assign('title','good');

//����ģ��
$smarty->display('1.html');
?>