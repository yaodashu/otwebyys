<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的小窝|<?php echo ($ftitle); ?></title>
<meta name="keywords" content="我的小窝新闻" />
<meta name="description" content="我的小窝新闻" />
<link rel="stylesheet" href="/Public/home/css/swiper.css"> 

<!--<script src="/Public/home/js/mobile.js" type="text/javascript"></script>-->
<link href="/Public/home/css/style.css" type="text/css" rel="Stylesheet" />
<script src="/Public/home/js/jquery.js" type="text/javascript"></script>
<script src="/Public/home/js/jquery.cookies.js" type="text/javascript"></script>
<script src="/Public/home/js/common.js" type="text/javascript"></script>

<!--<script src="/Public/home/images/jQueryRotate.js" type="text/javascript"></script>
<script src="/Public/home/images/swiper.js" type="text/javascript"></script>-->
<style>
    .div2 a .tabs:hover{
	color: #0000FF;
	font-weight: 600;
    }
</style>
<script type="text/javascript">
$(function () {
    do_banner1();
    //alert(getQueryString('fengge')); 
    init_param();
     

})
/*0 banner1*/
function do_banner1(){ 
    //此类型新闻的图层显示介绍文字
    $('#banner1 ul li').hover(function(){  
		 //图片放大
		//先记录上是哪层div高度 
		var dValue=$(this).find("div").height(); 
		 $(this).find("div").css("height",dValue);
		 
		var wValue=1.1 * $(this).find("a img").width(); 
		var hValue=1.1 * $(this).find("a img").height(); 
		$(this).find("a img").animate({width: wValue, 
		height: hValue, 
		left:("-"+(0.1 * $(this).find("a img").width())/2), 
		top:("-"+(0.1 * $(this).find("a img").height())/2)}, 800);  
	},function(){ 
	    //图片缩小
	    $(this).find("a img").animate({width: "100%", 
	    height: "100%", 
	    left:"0px", 
	    top:"0px"}, 600 ); 
	});
}
/*1 banner1*/
function init_param(){ 
}

function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
} 

var is_last=false;
var loading=false;
var page=2;
var first =true;
//更新条件重新查询数据
function query_search(type,id){  
    if(type=='1' || type=='2' || type=='3'){
	$("#query1_keyword").val("");
    }
    //异步重新查询数据:1风格，2居室；3设计师；5关键词；4加载更多
    if(type=='1' || type=='2' || type=='3' || type=='5'){
	page = 1; 
    }
    
    //20170815修改为直接跳转，分页查询
    if(true){
	var turl ="http://"+document.domain+"/index.php/home/article/index/"; 
	var condition="";
	if($("#ftype").val()!=""){
	    condition = condition + "ftype/"+$("#ftype").val()+"/";
	}	
	if($("#query1_keyword").val()!=""){
	    condition = condition + "keyword/"+$("#query1_keyword").val()+"/";
	}
	location.href=turl+condition;
    }
    return;    
    
    var turl ="http://"+document.domain+"/index.php/home/article/ajaxGetNews/page/"+page;
    $.ajax({
	url:turl,
	type : 'POST',
	dataType : "json",
	cache:false,
	data : {
		'ftype' : $("#ftype").val(), 
		'keyword' : $("#query1_keyword").val()
	},
	success:function(result){
	    var total = 0;
	    if(result.is_last=="1"){
		is_last ="1";		
		$("#more").html('已加载全部');
	    }else{
		is_last ="0";
		$("#more").html('加载更多');
	    }
	    var htmlstr="";
	    if(result.code=='0'){
		total = result.total;
//		alert(result.data.length);
//		//拼装html添加到html末尾
		for(var item=0;item<result.data.length;item++){    
		    htmlstr =htmlstr+'<li key="'+result.data[item].id+'">';
		    htmlstr =htmlstr+'	    <div class="div1">';
		    htmlstr =htmlstr+'				<a href="/index.php/home/article/detail/aid/'+result.data[item].id+'" target="_blank">';
		    
			if(result.data[item].picpath !="" && result.data[item].picpath !=null && result.data[item].picpath !=undefined){
		    htmlstr =htmlstr+'				    <img src="'+result.data[item].picpath+'" width="100%" height="100%" alt="'+result.data[item].title+'" /></a>';
			}else{
		    htmlstr =htmlstr+'				    <img src="'+result.data[item].litpic+'" width="100%" height="100%" alt="'+result.data[item].title+'" /></a>';
			}  
		    htmlstr =htmlstr+'			    </div>';
		    htmlstr =htmlstr+'			    <div class="div2">';
		    htmlstr =htmlstr+'				<p class="style1"><b style="font-weight: 500;"><a href="/index.php/home/anli/detail/aid/'+result.data[item].id+'" target="_blank">'+result.data[item].dtitle+'</a></b></p>';
		    htmlstr =htmlstr+'				<p class="style2"  style=" text-overflow: ellipsis;  display: -webkit-box;   -webkit-line-clamp: 2;  -webkit-box-orient: vertical;"><b>'+result.data[item].description+'...</b></p>'; 
		    htmlstr =htmlstr+'				<p class="style8"><b><a href="/index.php/home/article/detail/aid/'+result.data[item].id+'" target="_blank">查看详情<span>+</span></a></b></p>';			     
		    htmlstr =htmlstr+'			    </div> ';
		    htmlstr =htmlstr+'			</li> ';
		    
//					    mySwiper.appendSlide('<div class="swiper-slide"><img alt="'+result.banner1[item].title+'" src="'+result.banner1[item].logo_url+'" style="width:100%;"></div>');
		} 
//		$("#accordion").css("dispaly","block");
//		$("#main").append(result.data);
//		    do_msg(); 
		page++; 
		loading=false;		    
	    }else if(result.code=='10001'){  
	    }
	    //如果不是加载更多，则直接替换，否则需要进行追加操作
	    if(type!="4"){
		$("#newslist ul").html(htmlstr);
//		$("#query_count span").html("共"+total+"套大宅装修设计新闻");
	    }else{  
		$("#newslist ul").append(htmlstr); 
	    }
    }});
    
}

//点击加载更多，追加数据
function load_more(){
    if($("#more").html()=='加载更多'){
	//异步查询数据，如果有结果则追加到末尾 
	query_search('4',-1);
    }else{
	alert("您好，已经加载全部结果，请重新选择条件查询或刷新页面！");
    }
} 
//综合关键词搜索
function keyword_search(){ 
    if($("#query1_keyword").val()==''){
	 alert("请输入有效新闻名称信息")
	    return;
    }
    //情况查询其它条件
    $("#fengge"+"_inp").val("");
    $("#jushi"+"_inp").val("");
    $("#shejishi"+"_inp").val("");
    query_search('5',-1);
} 

//刷新页面
function search_new(type,page){ 
    //判断是分类还是关键词搜索
    if(type=='1'){
	//情况查询其它条件
	//$("#area"+"_inp").val(""); 
    }else{
	$("#query1_keyword").val("");
    } 
    if(parseInt(page)>0){}else{
	page=1;
    } 
    var turl ="http://"+document.domain+"/index.php/home/article/index/"; 
    var condition="";
    if($("#ftype").val()!=""){
	condition = condition + "ftype/"+$("#ftype").val()+"/";
    }    
    if($("#query1_keyword").val()!=""){
	condition = condition + "keyword/"+$("#query1_keyword").val()+"/";
    }
    location.href=turl+condition;
} 
</script>
</head>
<body class="p_list_anli" style="background: #f5f5f5;">
    <?php include ("./Application/Home/View/default/Common/topnav.html"); ?> 
    <?php include ("./Application/Home/View/default/Common/header.html"); ?> 
     
    
<div id="toppic" style="width:100%;height: auto;margin-top: 0px; background-color: #f5f6f6;"> 
    <img src="/Public/home/images/news/banner.jpg" alt="我的小窝" width="100%"/>
</div>
    
<div>  
    
    <div id="main" class="main">
        <div id="abox" style="    width: 1200px;
    margin: 0 auto;
    display: block;
    padding: 0;
    float: none;margin-bottom: 20px;">
	    <div id="position">
		<div class="div1"> 你所在的位置：<a href='/' target="_blank" style="color:#999999;">首页</a> &gt; <a href='javascript:void(0);' target="_blank" style="color:#333333;"><?php echo ($ftitle); ?></a>
		</div>
		<div class='div2'> 
		    <?php if(is_array($catelists)): $i = 0; $__LIST__ = $catelists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/index.php/home/article/index/ftype/<?php echo ($vo["id"]); ?>" target="_blank"><div <?php if($ftype == $vo['id']): ?>class='tabs tabs1 current'<?php else: ?> class='tabs tabs1'<?php endif; ?>><?php echo ($vo["title"]); ?><br><hr></hr></div></a><?php endforeach; endif; else: echo "" ;endif; ?>
<!--		    <a href="/index.php/home/article/index/ftype/4" target="_blank"><div <?php if($ftype == 4): ?>class='tabs tabs1 current'<?php else: ?> class='tabs tabs1'<?php endif; ?>><?php echo ($filecate['4']); ?><br><hr></hr></div></a>
		    <a href="/index.php/home/article/index/ftype/5" target="_blank"><div <?php if($ftype == 5): ?>class='tabs tabs3 current'<?php else: ?> class='tabs tabs3'<?php endif; ?>><?php echo ($filecate['5']); ?><br><hr></hr></div></a> 
		    <a href="/index.php/home/article/index/ftype/6" target="_blank"><div <?php if($ftype == 6): ?>class='tabs tabs2 current'<?php else: ?> class='tabs tabs2'<?php endif; ?>><?php echo ($filecate['6']); ?><br><hr></hr></div></a>
		    <a href="/index.php/home/article/index/ftype/6" target="_blank"><div <?php if($ftype == 7): ?>class='tabs tabs2 current'<?php else: ?> class='tabs tabs2'<?php endif; ?>><?php echo ($filecate['7']); ?><br><hr></hr></div></a>-->
		</div>
	    </div> 
	</div>
	
	    <input type='hidden' id='ftype' name='ftype' value='<?php echo ($ftype); ?>'></input> 
	
	<div id="nbox1" style="    width: 1200px;
    margin: 0 auto;
    display: block;
    padding: 0;
    float: none;padding-left:0px;">	    
            <div id="newslist" style="display: inline-block;">
                <ul>
		    <?php if(is_array($lists_data1)): $i = 0; $__LIST__ = $lists_data1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li key="<?php echo ($vo["id"]); ?>">
			    <div class="div1">
				<a href="/index.php/home/article/detail/aid/<?php echo ($vo["id"]); ?>.html" target="_blank">
				    <?php if($vo['picpath'] != ''): ?><img src="<?php echo ($vo["picpath"]); ?>" alt="<?php echo ($vo["title"]); ?>新闻" />
					<?php else: ?>  
					    <img src="<?php echo ($vo["litpic"]); ?>" alt="<?php echo ($vo["title"]); ?>新闻" /><?php endif; ?> 
				</a>
			    </div>
			    <div class="div2">
				<style> 
				p.style21::after {
					content:"...";
					font-weight:bold;
					position:absolute;
					bottom:0;
					right:0;
					padding:0 20px 1px 45px; <!---->
				}
				</style>
				<p class="style1" style=" text-overflow: ellipsis;  display: -webkit-box;   -webkit-line-clamp: 1;  -webkit-box-orient: vertical;">
				    <b style="font-weight: 500;"><a href="/index.php/home/article/detail/aid/<?php echo ($vo["id"]); ?>.html" target="_blank"><?php echo ($vo["dtitle"]); ?></a></b></p>
				<p class="style2"  style="overflow:hidden;  text-overflow: ellipsis;  display: -webkit-box;   -webkit-line-clamp: 2;  -webkit-box-orient: vertical;max-height: 55px;">
				   <b><?php echo ($vo['description']); ?></b>
				</p> 
				<p class="style7"><span><?php echo (date('Y-m-d',$vo['create_time'])); ?></span>
				    &nbsp;&nbsp;<span></span></p>
				<p class="style8">				   
				    <b><a href="/index.php/home/article/detail/aid/<?php echo ($vo["id"]); ?>.html" target="_blank">查看详情<span>+</span></a></b></p>			     
			    </div> 
			</li><?php endforeach; endif; else: echo "" ;endif; ?> 
		</ul>
		
		<div class="page_home">
		    <?php echo ($_page); ?>
		</div>
		<script>
		    function pagego(){
			var paget = $("#gop").val();
			var pagep = decodeURI($("#goval").val());
    //		    alert(pagep+"/"+paget);
			if(parseInt(paget)>0){
			    var turl = pagep.replace("[PAGE]",paget);
			    location.href=turl;
			}else{
			    alert("请输入有效页码!");
			    return; 
			}
		    }
		</script>
            </div>
	    <div id="newslist_r" style="">

		  <div style="color: #666666; font-size: 25px;font-family: '微软雅黑'; font-weight: 500;text-align: center;margin: 20px 0 0px 0;">
			 免费获取装修报价
		  </div>

		  <div style="margin: 10px 0 5px 8%; width: 92%; height: 40px; line-height: 40px;  display: inline-block;position: relative; float: left;">
			 <input type="text" placeholder="请输入您的姓名" id="txt_name3" name="txt_name3" style="height: 100%;width: 85%; padding-left: 5%;font-family: '微软雅黑'; font-size: 16px;border: solid 1px #e5e5e5;" />
		  </div>

		  <div style="margin: 10px 0 5px 8%; width: 92%; height: 40px; line-height: 40px;  display: inline-block;position: relative; float: left;">
			 <input type="text" placeholder="请输入您的手机号码" id="txt_tel3" name="txt_tel3" style="height: 100%;width: 85%; padding-left: 5%;font-family: '微软雅黑'; font-size: 16px;border: solid 1px #e5e5e5;" />
		  </div>
		  <div style="margin: 10px 0 5px 8%; width: 92%; height: 40px; line-height: 40px;  display: inline-block;position: relative; float: left;">
			 <input class="name" type="text" id="txt_mianji3" name="txt_mianji3" placeholder="请输入您的房屋面积" style="height: 100%; width: 85%; padding-left: 5%;font-family: '微软雅黑';font-size: 16px;border: solid 1px #e5e5e5;"/>
			 <div style="margin-left:-24px;width: 30px;position: absolute;float: right;font-size: 16px;color:#999999;display: inline-block;height: 46px;line-height: 46px;">㎡</div>
		  </div>

		  <div id="btn_submit3" style="cursor: pointer; margin: 10px 0 5px 24px;width: 84.5%;height: 42px;line-height: 40px;display: inline-block;background-color: #2E4F89;color: #fff;text-align: center;font-size: 16px;font-family: '微软雅黑';border-radius: 4px;">
			 获取报价
		  </div> 
		  <div style="color:#353637;font-size: 12px;font-family: '微软雅黑';text-align: center;margin: 10px 0 10px 0;">
			 ※我们会严格保护您的隐私请放心填写
		  </div>
	    </div>
	    
<!--	    <div class="load_more"> 
		<div id="more" onclick="load_more();">加载更多</div>
	    </div> -->
	    
        </div> 
	
	</div>


   
<?php include ("./Application/Home/View/default/Common/bottomnav.html"); ?> 
<?php include ("./Application/Home/View/default/Common/footer.html"); ?> 
     
</body>
</html>   

<script type="text/javascript">
$(function(){
       
		//异步获取报名名额
//                baomingrenshuh();		
		var regex_number=/^\d{7}$|^\d{8}$|^\d{11}$|^\d{3,4}(-)?\d{7,8}$/;
		$("#btn_submit3").click(function(){
		    var obj=$(this);
		    var _name=$("#txt_name3");
		    var val_name=$.trim(_name.val());
		    if(val_name.length<=0){alert("温馨提示：请输入您的真实姓名！");_name.focus();_name.select();return false;}
		    var _tel=$("#txt_tel3");
		    var val_tel=$.trim(_tel.val());
		    if(!regex_number.test(val_tel)){alert("温馨提示：联系电话格式不正确！");_tel.focus();_tel.select();return false;}
		    var _loupan=$("#txt_loupan3");
		    var val_loupan=$.trim(_loupan.val());
		    //if(val_loupan.length<=0){alert("温馨提示：请输入您房子的楼盘名称！");_loupan.focus();_loupan.select();return false;}
		    var _mianji=$("#txt_mianji3");
		    var val_mianji=$.trim(_mianji.val());
	    //        if(val_mianji.length<=0){alert("温馨提示：请输入您房子的面积！");_mianji.focus();_mianji.select();return false;}
		    val_name=encodeURIComponent(val_name);
		    val_tel=encodeURIComponent(val_tel);
		    val_loupan=encodeURIComponent(val_loupan);
		    val_mianji=encodeURIComponent(val_mianji);
		    var val_content=encodeURIComponent("[来源页面："+document.title+"]");
		    var url=encodeURIComponent(location.href);
		    var sourceid=obj.attr("sourceid");
		    if(!sourceid){sourceid=2;}
		    window.open("http://i.dasn.com.cn/index.php/calltel/dooperate?name="+val_name+"&tel="+val_tel+"&loupan="+val_loupan+"&mianji="+val_mianji+"&content="+val_content+"&url="+url+"&sourceid="+sourceid);
		    _name.val("");
		    _tel.val("");
		    _loupan.val("");
		    _mianji.val("");
		    //setTimeout(baomingrenshu,1000*3);
		    return false;
		});
});
</script> 


<script src="/Public/home/js/footer.js" type="text/javascript"></script>
<script src="/public/home/js/count.js" type="text/javascript"></script>