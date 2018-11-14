<?php
//��ʼ��Smarty��Ա���ԵĹ����ļ�init.inc.php
define('ROOT',str_replace("\\","/",dirname(_FILE_)),'/'); //ָ����Ŀ�ĸ�·��
require ROOT.'libs/Smarty.class.php';                     //����smarty���ļ�
$smarty = new Smarty(); 
//ʵ����smarty�����$smarty

/*�Ƽ�ʹ��smarty3���ϰ汾��ʽ����Ĭ��·�������óɹ��󶼷���$smarty������������ʹ��������� */
$smarty->setTemplateDir(ROOT.'templates/');        //��������ģ���ļ���ŵ�Ŀ¼
//     ->addTemplateDir(ROOT.'templates2')         //�������Ӷ��ģ��Ŀ¼��ǰ��̨��һ����
  ->setCompileDir(ROOT.'templates_c/')//�������б������ģ���ļ����Ŀ¼
  ->setPluginsDir(ROOT.'plugins/')//����ģ�����������Ŀ¼
  ->setCacheDir(ROOT.'cache/')//���û����ļ���ŵ�Ŀ¼(��������ű�ʹ��)
  ->setConfigDir(ROOT.'configs');              //����ģ�������ļ���ŵ�Ŀ¼
  
  
$smarty->caching = false;                      //����smarty���濪��1���� 0 �ر� ture���� false �ر�
$smarty->cache_lifetime = 60*60*24             //����ģ�建����ʱ��εĳ���Ϊ1��
$smarty->left_delimiter = '<{';                //����ģ�������е����������
$smarty->right_delimiter = '}>';               //����ģ�������е��ҽ�������



/*��ʼ������˵��*/
//smarty2ʱ�����÷�ʽ��
/*
$smarty->template_dir = "./templates";    //����ģ��Ŀ¼��2.0���÷�����3.0���õ���֧��
$smarty->compile_dir = "./templates_c";    //���ñ���Ŀ¼��2.0���÷�����3.0���õ���init��
$smarty->config_dir = "./configs/"; //���ñ���Ŀ¼��2.0���÷�����3.0���õ���֧��
$smarty->cache_dir = "./cache/"; //���ñ���Ŀ¼��2.0���÷�����3.0���õ���֧��
*/

//smarty3�����Խ����˷�װ������ʹ�����·������з��ʻ��Ŀ¼
$smarty->getCacheDir();                //�õ���ǰ����Ŀ¼·��
$smarty->getTemplateDir();  //�õ���ǰģ��Ŀ¼·��������
$smarty->getConfigDir();               //�õ���ǰ�����ļ�Ŀ¼·��
$smarty->getCompileDir();              //�õ���ǰ����Ŀ¼·��
$smarty->getPluginsDir();              //�õ���ǰ���Ŀ¼·������

//ͬ������ķ�������Ŀ¼���ã�
//�����µ�ģ��Ŀ¼��ע�����ú�ģ��Ŀ¼������ֻ�и�ֵһ��������ԭ���м���ֵ
$smarty->setTemplateDir("./templates/");
$smarty->setCompileDir("./templates_c/");    //�����µı���Ŀ¼
$smarty->setConfigDir("./configs/");         //�����µ������ļ�Ŀ¼
$smarty->setCacheDir("./cache/");//�����µĻ���Ŀ¼
$smarty->setLeftDelimiter('<{');            //���������Ƽ�
$smarty->setRightDelimiter('<{');           //���������Ƽ�
//���õ�ģ���ļ���·��������ģ��Ŀ¼�����У����򱨴���������Ȼ��ԭ����ģ���ļ�������ģ��������������·����
$smarty->addTemplateDir('./templates2/');
//����һ���µĲ��Ŀ¼�������set��ȡ��������飬��Ϊ��ָ
$smarty->addPluginsDir('./myplugins');

//˵������ЩSmarty�����е����÷��������óɹ��󷵻صĻ���Smarty�����($this),���Կ�����
//init.inc.php�ű���Ӧ�õķ�ʽһ�������ö������������ʽ����smarty·����
/*��ʼ������˵��*/
?>