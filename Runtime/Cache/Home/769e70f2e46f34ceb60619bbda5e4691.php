<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" id="viewport" content="width=1800,initial-scale=1.0,max-scale=1.0,user-scalable=0" />
<title>长沙我的小窝_湖南点石装饰设计工程有限公司_湖南家装领导者【官方网站】</title>
<meta name="description" content="长沙我的小窝专业从事家居装饰设计，家庭装修设计，装饰装修工程施工，室内设计服务。服务电话：400-048-0731" />
<meta name="keywords" content="长沙我的小窝,长沙装修公司,长沙装饰公司,长沙家装公司,长沙装饰设计,长沙室内装修,长沙别墅装修,长沙装修设计公司,长沙最好的装修公司,长沙有哪些装修公司,长沙哪个装修公司好,长沙知名装修公司" /> 
<link rel="stylesheet" href="/Public/home/css/swiper.css"> 
<!--<script src="/Public/home/js/mobile.js" type="text/javascript"></script>-->
<link href="/Public/home/css/style.css" type="text/css" rel="Stylesheet" />
<script src="/Public/home/js/jquery.js" type="text/javascript"></script>
<script src="/Public/home/js/jquery.cookies.js" type="text/javascript"></script>
<script src="/Public/home/js/common.js" type="text/javascript"></script>  

</head>
<style type="text/css">
  body{
	 font-size:12px; font-family:微软雅黑,Arial; background-color:#f3f1ef; 
    }     
a.htitle:link{ color:#00352d; }
a.htitle:visited{ color:#00352d; }
a.htitle:hover{ color:#B90000;  }
a.htitle:active{ color:#B90000; }
.list_title{font-size: 32px;width: 134px;color: #333333;font-weight: 600;}
.list_title1{display: inline-block;  float: left;  position: relative;  height: 40px;  margin: 0 0 0 5px;  width: 180px; text-align: left;}
.list_title1 p{position: absolute; bottom: 0; height: 32px; font-size: 20px; color: #999999; }
.list_hr{margin-top: 8px;    display: none;}
.list_more{font-size: 16px;color: #a1a1a1;}
.list_more:hover{color: #183078;}
.hid_hr{}
.div_hr_anli{text-align: center; margin: 10px 0 0 0;  width: 100%;}
.div_hr_anli .hid_hr1{width: 6%; background: #fff; height: 2px; margin: 0 0 0 47%;}
.div_hr_anli .hid_hr2,.div_hr_anli .hid_hr3{width: 8%; background: #fff; height: 2px; margin: 0 0 0 46%;}
.div_hr_anli .hid_hr4,.div_hr_anli .hid_hr5,.div_hr_anli .hid_hr6{width: 14%; background: #fff; height: 2px; margin: 0 0 0 43%;}

#main1 .wh .icon{display: inline-block;width: 69px; height: 69px; border-radius: 34px; background: #182f74;  margin: 22px 0 5px 0%;}
#main1 .wh .icon i{font-size: 38px;line-height: 69px;color:#fff;}
#main1 .wh:hover .icon{ background :#fff;}
#main1 .wh:hover .icon i{color:#263c7d;}
</style>
<script type="text/javascript">
$(function () { 
    do_main3();
    do_main31();
    do_main4();
    do_main5();
//    do_main6();
//    do_main7();
    initviewport();
})
function initviewport(){
	var viewport=document.getElementById("viewport");
	if(viewport){
	//	viewport.content="width=1800,initial-scale="+screen.width/1800+",max-scale="+screen.width/1800+",user-scalable=0";
	}
}

/*0_main3*/
var main3_interval=null; 
function do_main3(){    
    //此类型案例的图层显示介绍文字
    $('.ul_anli_index2 .li-1').hover(function(){  
		//$(this).siblings().find(".hid2").hide(); 
		$(this).find(".hid2").show(); 
		 //图片放大
		var wValue=1.1 * $(this).find("a img").width(); 
		var hValue=1.1 * $(this).find("a img").height(); 
		$(this).find("a img").animate({width: wValue, 
		height: hValue, 
		left:("-"+(0.1 * $(this).find("a img").width())/2), 
		top:("-"+(0.1 * $(this).find("a img").height())/2)}, 500);  
	},function(){ 
	    $(this).find(".hid2").hide();
	    //图片缩小
	    $(this).find("a img").animate({width: "100%", 
	    height: "100%", 
	    left:"0px", 
	    top:"0px"}, 500 ); 
	});
	
    $('.ul_anli_index2 .li-2-div1 .case_pad').hover(function(){  
		$(this).siblings().find(".hid2").hide(); 
		$(this).find(".hid2").show(); 
		 //图片放大
		var wValue=1.1 * $(this).find("a img").width(); 
		var hValue=1.1 * $(this).find("a img").height(); 
		$(this).find("a img").animate({width: wValue, 
		height: hValue, 
		left:("-"+(0.1 * $(this).find("a img").width())/2), 
		top:("-"+(0.1 * $(this).find("a img").height())/2)}, 500);  
	},function(){ 
	    $(this).find(".hid2").hide();
	    //图片缩小
	    $(this).find("a img").animate({width: "100%", 
	    height: "100%", 
	    left:"0px", 
	    top:"0px"}, 500 ); 
	}); 
	
    $('.ul_anli_index2 .li-2-div2 .case_pad').hover(function(){  
		$(this).siblings().find(".hid2").hide(); 
		$(this).find(".hid2").show(); 
		 //图片放大
		var wValue=1.1 * $(this).find("a img").width(); 
		var hValue=1.1 * $(this).find("a img").height(); 
		$(this).find("a img").animate({width: wValue, 
		height: hValue, 
		left:("-"+(0.1 * $(this).find("a img").width())/2), 
		top:("-"+(0.1 * $(this).find("a img").height())/2)}, 500);  
	},function(){ 
	    $(this).find(".hid2").hide();
	    //图片缩小
	    $(this).find("a img").animate({width: "100%", 
	    height: "100%", 
	    left:"0px", 
	    top:"0px"}, 500 ); 
	}); 
	
	//案例底部分页栏目切换
	$("#main3 .case6 ul li").click(function(){  
	    var li=$("#main3 .case6 ul li"); 
	    var case_ul =$("#main3 #case5 .case_list ul");
	    var length=li.length;
	    var idx=$(this).index();  
	    if(idx<=0 || idx>=length){
		idx=0;
	    }
	    li.find("span").removeClass("current").eq(idx).addClass("current"); 
	    case_ul.hide().eq(idx).show();
	})
	
	
//    $("#main3 .case_tyle div").eq(0).addClass("current");//默认第一个风格为当前样式
//    $("#main3 #case5 .case_list").hide().eq(0).show();
//  //$("#main3").hover(function(){main3_interval0();},function(){main3_interval1();});//启动定时器0和定时器1
//  // main3_interval1(); 
//    //一个风格选中
//    $("#main3 .case_tyle div").click(function(){
//      //  if($(this).is(".style1")){return false;}
//        //所有案例多个层切换
//        $(this).addClass("current").siblings().removeClass("current");
//	var idx=$("#main3 .case_tyle div").filter(".current").index();   
//	var numbers=$(".case6 ul li span");
//	numbers.removeClass("current").eq(idx).addClass("current");
//	return;
//	
//	//图片内容
//        var div=$("#main3 #case5 .case_list");
//        var idx=$(this).index();
//        div.hide().eq(idx).show();
//	//alert("div"+div.length);
//    }).hover(function(){$(this).click();},function(){});
} 
function main3_interval0(){if(main3_interval!=null){clearInterval(main3_interval);}} //清除定时器
function main3_interval1(){main3_interval0();main3_interval=setInterval(main3_show,1000*5);} //设置定时器为5秒
//定时器触发更新当前风格,type参数表示案例左右翻页
function main3_show(type){
    var li=$("#main3 .case6 ul li"); 
    var case_ul =$("#main3 #case5 .case_list ul");
    var length=li.length;
    var idx=parseInt($("#main3 .case6 ul li span.current").attr("data"));    
    if(idx>=length || idx<=0){idx=0;}
//    alert("idx"+idx+"length"+length);
    if(type=="pre"){
	if(idx==0){
	    idx=length-1;
	}else if(idx>0){
	    idx=idx-1;
	}		    
    }else{
	if(idx<length-1){
	    idx=idx+1;
	}else{
	    idx=0;  
	}
    }
//    alert("idx"+idx+"length"+length);
    li.find("span").removeClass("current").eq(idx).addClass("current"); 
    case_ul.hide().eq(idx).show();
}
//不同风格案例左右翻页

function do_main31(){
    //获取DIV的宽高，设置flash
    var width = $('.ul_quanjing_index2 .case_pad .vr01').width();
    var height = $('.ul_quanjing_index2 .case_pad .vr01').height();
    
    return;
    $('.ul_quanjing_index2 .vr01').flash({
	    src: 'http://weixin.dasn.com.cn/wkt/quanjing/jo1/scene.swf',
	    width: width,
	    height: height+120
    });
   // return;
    width = $('.ul_quanjing_index2 .vr02').width();
    height = $('.ul_quanjing_index2 .vr02').height();
    $('.ul_quanjing_index2 .vr02').flash({
	    src: 'http://weixin.dasn.com.cn/wkt/quanjing/GSHC/scene.swf',
	    width: width,
	    height: height+95
    });
    width = $('.ul_quanjing_index2 .vr03').width();
    height = $('.ul_quanjing_index2 .vr03').height();
    $('.ul_quanjing_index2 .vr03').flash({
	    src: 'http://weixin.dasn.com.cn/wkt/quanjing/zs1/scene.swf',
	    width: width,
	    height: height+95
    });
    width = $('.ul_quanjing_index2 .vr04').width();
    height = $('.ul_quanjing_index2 .vr04').height();
    $('.ul_quanjing_index2 .vr04').flash({
	    src: 'http://weixin.dasn.com.cn/wkt/quanjing/xdjy1/scene.swf',
	    width: width,
	    height: height+95
    });
}

/*1_main3*/

/*0_main4*/ 
function do_main4(){
    
    //案例底部分页栏目切换
    $("#main4 .shejishi6 ul li").click(function(){  
	var li=$("#main4 .shejishi6 ul li"); 
	var case_ul =$("#main4 #shejishi5 .shejishi_list ul");
	var length=li.length;
	var idx=$(this).index();  
	if(idx<=0 || idx>=length){
	    idx=0;
	}
	li.find("span").removeClass("current").eq(idx).addClass("current"); 
	case_ul.hide().eq(idx).show();
    })
} 
//定时器触发更新当前风格,type参数表示案例左右翻页
function main4_show(type){
    var li=$("#main4 .shejishi6 ul li"); 
    var case_ul =$("#main4 #shejishi5 .shejishi_list ul");
    var length=li.length;
    var idx=parseInt($("#main4 .shejishi6 ul li span.current").attr("data"));    
    if(idx>=length || idx<=0){idx=0;}
//    alert("idx"+idx+"length"+length);
    if(type=="pre"){
	if(idx==0){
	    idx=length-1;
	}else if(idx>0){
	    idx=idx-1;
	}		    
    }else{
	if(idx<length-1){
	    idx=idx+1;
	}else{
	    idx=0;  
	}
    }
//    alert("idx"+idx+"length"+length);
    li.find("span").removeClass("current").eq(idx).addClass("current"); 
    case_ul.hide().eq(idx).show();
}
/*1_main4*/


/*0_main4*/
var main5_interval=null;
function do_main5(){
    //此类型案例的图层显示介绍文字 
   // $('#main5 .loupan_list .ul_loupan_index li').find(".hid2").hide(); 
    $('#main5 .loupan_list .ul_loupan_index li').hover(function(){    
		$(this).find("img").css("z-index","88"); 
		 //图片放大
		var wValue=1.1 * $(this).find("a img").width(); 
		var hValue=1.1 * $(this).find("a img").height(); 
		$(this).find("a img").animate({width: wValue, 
		height: hValue, 
		left:("-"+(0.1 * $(this).find("a img").width())/2), 
		top:("-"+(0.1 * $(this).find("a img").height())/2)}, 500);   
	    //li shadow
//	        box-shadow: -1px 0 5px #999, /*left*/ 1px 0 5px #999, /*right*/ 0 -1px 5px #999, /*top*/ 0 1px 10px #999;
//		$(this).addClass("li_bg");
//		$(this).css("box-shadow","-1px 0 5px #999, 1px 0 5px #999, 0 -1px 5px #999,0 1px 10px #999;");
//		$(this).css("background","#f3f1ef")
	},function(){ 
	    $('#main5 .loupan_list .ul_loupan_index li').find("img").css('z-index','10'); 
//	    //缩小图片
	    $(this).find("a img").animate({width: "100%", 
	    height: "100%", 
	    left:"0px", 
	    top:"0px"}, 500 );  
//	    $(this).removeClass("li_bg");
//		$(this).css("box-shadow","");
//		$(this).css("background","");
	});
	
	//底部分页栏目切换
	$("#main5 .loupan6 ul li").click(function(){  
	    var li=$("#main5 .loupan6 ul li"); 
	    var case_ul =$("#main5 #loupan5 .loupan_list ul");
	    var length=li.length;
	    var idx=$(this).index();  
	    if(idx<=0 || idx>=length){
		idx=0;
	    }
	    li.find("span").removeClass("current").eq(idx).addClass("current"); 
	    case_ul.hide().eq(idx).show();
	}) 
} 
//定时器触发更新当前风格,type参数表示案例左右翻页
function main5_show(type){
    var li=$(".loupan6 ul li"); 
    var case_ul =$("#main5 #loupan5 .loupan_list ul");
    var length=li.length;
    var idx=parseInt($(".loupan6 ul li span.current").attr("data"));    
    if(idx>=length || idx<=0){idx=0;}
//    alert("idx"+idx+"length"+length);
    if(type=="pre"){
	if(idx==0){
	    idx=length-1;
	}else if(idx>0){
	    idx=idx-1;
	}		    
    }else{
	if(idx<length-1){
	    idx=idx+1;
	}else{
	    idx=0;  
	}
    }
//    alert("idx"+idx+"length"+length);
    li.find("span").removeClass("current").eq(idx).addClass("current"); 
    case_ul.hide().eq(idx).show();
}
/*1_main4*/

/*0_main6*/
var main6_interval_rotate=null;
var num=0;
function do_main6(){ 
    $("#why5 .wh .p1 img").hover(function(){  
	$("#why5 .wh .p1 img").removeClass('current');
	$(this).addClass('current');
	main6_interval_rotate1();    
    },function(){main6_interval_rotate0();$("#why5 .wh img.current").css("transform","rotate(0deg)");})
}
function main6_interval_rotate0(){if(main6_interval_rotate!=null){clearInterval(main6_interval_rotate);num=0;}} //清除定时器
function main6_interval_rotate1(){main6_interval_rotate0();num=0;main6_interval_rotate=setInterval(pic_rotate,50*1);} //设置定时器为3秒
function pic_rotate(){ 
//    $("#why5 .wh img.current").html();
   // alert($("#why5 .wh img.current").parent().parent().html());
    num ++; 
    $("#why5 .wh img.current").rotate(15*num); //transform: rotate(0deg);
}
/*1_main6*/

/*0_main7*/
var main7_interval=null;
function do_main7(){
    //新闻、档案切换
    $('#news3 div .case_news').click(function(){
		$(this).addClass('case_news_current').siblings().removeClass('case_news_current');
		$(".case_news_sub").addClass('case_news_sub_current');
		$(this).find(".case_news_sub").removeClass('case_news_sub_current');
		
		var li=$("#main7 #news3 .case_news");
		var idx=li.filter(".case_news_current").index();
		var news_list =$("#news5 .news_list");  
		news_list.hide().eq(idx).show();
		var news_a =$("#news5 #news_more a");  
		news_a.hide().eq(idx).show();
	});
	$('#news3 div .case_news').hover(function(){
		$(this).click();
	},function(){}); 
} 
/*1_main7*/

</script>
<body class="p_index"> 
    <?php include ("./Application/Home/View/default/Common/topnav.html"); ?> 
    <?php include ("./Application/Home/View/default/Common/header.html"); ?> 
    <?php include ("./Application/Home/View/default/Common/hbanner.html"); ?>   
<style>
    #cont1 .wh:hover {
	background: #fff;
	color: #fff;
    }
    #cont1 .wh img {
	width: 100%;
	height: auto;
	margin-top: 22px;
	margin-bottom: 5px;
    }
</style>
<div id="main1" style="width: 1220px;;height: auto;margin: 0 auto;"> 
     <div id="cont1" class="case" style="margin: 2% 0 2% 0%;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;display: inline-block;width: 100%;"> 
	 <div class="wh div1"><a href="/zhuanti/gongyi/" style="text-decoration:none;">
	    <img src="/Public/home/images/nav/nav01.png" alt="欧标工程 生态工艺材料" width="100%"/>
<!--	    <p class="p1">
		<div class="icon icon-green radius icon-list-fun" style="">
		       <i style="padding-top:0px;margin-top:0px;" class="aui-iconfont iconfont">&#xe61e;</i></div>
	    </p>
	    <p class="p2">欧标工艺</p>
	    <p class="p3">点石新欧标耐用更健康</p> -->
	    </a> </div>
	<div class="wh div2"><a href="/q/" style="text-decoration:none;">
		<img src="/Public/home/images/nav/nav02.png" alt="企业规模 全国30城,60店 70000平米自主产业园" width="100%"/>
<!--	    <p class="p1">
		<div class="icon icon-green radius icon-list-fun" style="">
		       <i style="padding-top:0px;margin-top:0px;" class="aui-iconfont iconfont">&#xe62d;</i></div>
	    </p>
	    <p class="p2">点石产业园</p>
	    <p class="p3">7万㎡自主产权式定制家居产业园</p>-->
	    </a></div>
	<div class="wh div3"><a href="/zhuanti/about/" style="text-decoration:none;">
		<img src="/Public/home/images/nav/nav03.png" alt="品牌实力 湖南家装领导者" width="100%"/>
<!--	    <p class="p1">
		<div class="icon icon-green radius icon-list-fun" style="">
		       <i style="padding-top:0px;margin-top:0px;" class="aui-iconfont iconfont">&#xe61b;</i></div>
	    </p>
	    <p class="p2">企业文化</p>
	    <p class="p3">真爱筑家</p> -->
	    </a></div>
	<div class="wh div4"><a href="/zhuanti/gongcheng/" style="text-decoration:none;">
		<img src="/Public/home/images/nav/nav04.png" alt="品质保障 设计与施工双甲级资质" width="100%"/>
<!--	    <p class="p1">
		<div class="icon icon-green radius icon-list-fun" style="">
		       <i style="padding-top:0px;margin-top:0px;" class="aui-iconfont iconfont">&#xe609;</i></div>
	    </p>
	    <p class="p2">工地展示</p>
	    <p class="p3">数字化工程管理</p> -->
	    </a></div>	 
    </div>
    <script>
	$("#cont1 .wh").hover(function(){  
//	    var index = $(this).index();  
//	    $("#cont1 .wh").eq(index).find("p img").attr("src","/Public/home/images/cont1_"+index+"_1.png");  
//	    },function(){ 
//	    var index = $(this).index();  
//	    $("#cont1 .wh").eq(index).find("p img").attr("src","/Public/home/images/cont1_"+index+"_0.png"); 
	    });
    </script>
</div>    

<div style="background: #f5f6f6;width: 100%;">
<div id="main3" style="width:1200px;height: auto;margin-top: 0px;background: #f5f6f6;margin: 0 auto;"> 
     <div id="case0" class="case" style="text-align:center; height: 45px; padding-top: 0px;">  
    </div>  
    <div id="case4" class="case" style="margin-left: 0%;text-align:center; font-size: 16px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;width:100%;display: inline-block;"> 
	<div class="list_title" style="display: inline-block; float: left;text-align: left;">案例展示</div>
	<div class="list_title1" style="display: inline-block;float: left;position: relative;"><p>Case presentation</p></div>
	<div class="case_tyle" style="float:right;height: 30px; margin-top: 10px;">
	    <?php if(is_array($anlifengges)): $i = 0; $__LIST__ = $anlifengges;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$avo): $mod = ($i % 2 );++$i;?><div name="fg_<?php echo ($avo["evalue"]); ?>"><a href="/index.php/home/anli/index/fengge/<?php echo ($avo["evalue"]); ?>" target="_blank"><span style="margin-left: 10px;"><?php echo ($avo["ename"]); ?></span></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
	    <!--<div name="fg_500"><a href="/index.php/home/anli/index/fengge/500" target="_blank"><span>中式</span></a></div>-->
<!--	    <div name="fg_1000"><a href="/index.php/home/anli/index/fengge/1000" target="_blank"><span>欧式</span></a></div>
	    <div name="fg_2500"><a href="/index.php/home/anli/index/fengge/2500" target="_blank"><span>地中海</span></a></div>
	    <div name="fg_1500" style="width:90px;"><a href="/index.php/home/anli/index/fengge/1500" target="_blank"><span>现代简约</span></a></div>
	    <div name="fg_2000"><a href="/index.php/home/anli/index/fengge/2000" target="_blank"><span>田园</span></a></div>
	    <div name="fg_3000"><a href="/index.php/home/anli/index/fengge/3000" target="_blank"><span>东南亚</span></a></div>
	    <div name="fg_3500"><a href="/index.php/home/anli/index/fengge/3500" target="_blank"><span>美式</span></a></div>
	    <div name="fg_4500"><a href="/index.php/home/anli/index/fengge/4500" target="_blank"><span>新古典</span></a></div>
	    <div name="fg_0" style="width:90px;"><a href="/index.php/home/anli/index/" target="_blank"><span>其它风格</span></a></div>-->
	</div>
	<a href="/index.php/home/anli/" style="text-decoration:none;display: none;">
	    <div class="list_more" style="width: 80px;display: inline-block; float: right; text-align: right; padding-right: 5px;">更多 >></div>
	</a>
	<hr class="list_hr" style="width: 99.5%;border-bottom: solid 1px #dcdcdc;"></hr>
    </div>  
    
    <div id="case5" class="case" style="margin: 30px 0 0 0%;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;width: 100%;display: inline-block;"> 
	<div class="case_list">
            <ul class="ul_anli_index2 ul01" style="display:block;"> 
		    <li class="li-1" key="1" style="width:40%;margin:0 0 0 0;"> 
			<div class="case_pad">
			    <?php if($pic['s1']['p1']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s1']['p1']["id"]); ?>.html" target="_blank"> 
				<?php else: ?> 
				    <a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
				<div class="hid2 hid" style="display: none;">				    
				    <div class="d1" style="">
					<?php if($pic['s1']['p1']['id'] != ''): echo ($pic['s1']['p1']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
				    <div class="div_hr_anli"><hr class="hid_hr1"></hr></div>
				    <div class="d2" style="height: 32px;line-height: 32px;">
					<?php if($pic['s1']['p1']['id'] != ''): echo ($pic['s1']['p1']["fenggename"]); ?> | <?php echo ($pic['s1']['p1']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
				</div> 
				<div class="divimg" style="display:inline-block;height: 100%;">
				     <?php if($pic['s1']['p1']['picpath'] != ''): ?><img src="<?php echo ($pic['s1']['p1']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					<?php else: ?> 
					    <img src="/Public/home/images/anli/casep1.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			    
				</div>
			    </a> 
			</div>
		    </li>  
		    <li class="li-2" key="2" style="width:58.6%;margin:0 0 0 1.3%;"> 
			<div class="li-2-div1 case_pad" style="height:46%;display:inline-block;float: left;">			    
			    <div class="li-2-div11 case_pad" style="width:49%;height:100%;display:inline-block;float: left;">
				<?php if($pic['s1']['p2']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s1']['p2']["id"]); ?>.html" target="_blank"> 
				    <?php else: ?> 
					<a href="/index.php/home/anli/" target="_blank"><?php endif; ?>   
				    <div class="hid2 hid" style="width:344px;height: 243px;">				    
					<div class="d1">
					    <?php if($pic['s1']['p2']['id'] != ''): echo ($pic['s1']['p2']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					<div class="div_hr_anli"><hr class="hid_hr2"></hr></div>
					<div class="d2">
					    <?php if($pic['s1']['p2']['id'] != ''): echo ($pic['s1']['p2']["fenggename"]); ?> | <?php echo ($pic['s1']['p2']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
				    </div> 
				    <div class="divimg" style="display:inline-block;height: 100%;width: 100%;"> 	
					<?php if($pic['s1']['p2']['picpath'] != ''): ?><img src="<?php echo ($pic['s1']['p2']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep2.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			    				
				    </div>
				</a> 
			    </div>		    
			    <div class="li-2-div12 case_pad" style="width:49%;height:100%;display:inline-block;float: left;margin: 0 0 0 2%;">				
				<?php if($pic['s1']['p3']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s1']['p3']["id"]); ?>.html" target="_blank"> 
				    <?php else: ?> 
					<a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
				    <div class="hid2 hid" style="width:344px;height: 243px;">				    
					<div class="d1">
					    <?php if($pic['s1']['p3']['id'] != ''): echo ($pic['s1']['p3']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					<div class="div_hr_anli"><hr class="hid_hr3"></hr></div>
					<div class="d2">
					    <?php if($pic['s1']['p3']['id'] != ''): echo ($pic['s1']['p3']["fenggename"]); ?> | <?php echo ($pic['s1']['p3']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
				    </div> 
				    <div class="divimg" style="display:inline-block;height: 100%;width: 100%;">
					<?php if($pic['s1']['p3']['picpath'] != ''): ?><img src="<?php echo ($pic['s1']['p3']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep3.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  	 					
				    </div>
				</a> 
			    </div>
			</div>
			<div class="li-2-div2 case_pad" style="height:51%;display:inline-block;float: left;margin: 2% 0 0 0;">
			    <div class="li-2-div21 case_pad" style="width:32%;height:100%;display:inline-block;float: left;">
				    <?php if($pic['s1']['p4']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s1']['p4']["id"]); ?>.html" target="_blank"> 
					<?php else: ?> 
					    <a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
					<div class="hid2 hid" style="width: 225px;height: 270px;">				    
					    <div class="d1" >
						<?php if($pic['s1']['p4']['id'] != ''): echo ($pic['s1']['p4']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					    <div class="div_hr_anli"><hr class="hid_hr4"></hr></div>
					    <div class="d2" >
						<?php if($pic['s1']['p4']['id'] != ''): echo ($pic['s1']['p4']["fenggename"]); ?> | <?php echo ($pic['s1']['p4']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
					</div> 
					<div class="divimg" style="display:inline-block;height: 100%;width: 100%;">	
					<?php if($pic['s1']['p4']['picpath'] != ''): ?><img src="<?php echo ($pic['s1']['p4']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep4.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			    			 					
					</div>
				</a> 				
			    </div>
			    <div class="li-2-div22 case_pad" style="width:32%;height:100%;display:inline-block;float: left;margin: 0 0 0 2%;">
				    <?php if($pic['s1']['p5']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s1']['p5']["id"]); ?>.html" target="_blank"> 
					<?php else: ?> 
					    <a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
					<div class="hid2 hid" style="width: 225px;height: 270px;">				    
					    <div class="d1" >
						<?php if($pic['s1']['p5']['id'] != ''): echo ($pic['s1']['p5']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					    <div class="div_hr_anli"><hr class="hid_hr5"></hr></div>
					    <div class="d2" >
						<?php if($pic['s1']['p5']['id'] != ''): echo ($pic['s1']['p5']["fenggename"]); ?> | <?php echo ($pic['s1']['p5']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
					</div> 
					<div class="divimg" style="display:inline-block;height: 100%;width: 100%;">	
					<?php if($pic['s1']['p5']['picpath'] != ''): ?><img src="<?php echo ($pic['s1']['p5']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep5.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			 				
				      </div>
				</a> 				
			    </div>
			    <div class="li-2-div23 case_pad" style="width:32%;height:100%;display:inline-block;float: left;margin: 0 0 0 2%;">
				    <?php if($pic['s1']['p6']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s1']['p6']["id"]); ?>.html" target="_blank"> 
					<?php else: ?> 
					    <a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
					<div class="hid2 hid" style="width: 225px;height: 270px;">				    
					    <div class="d1" >
						<?php if($pic['s1']['p6']['id'] != ''): echo ($pic['s1']['p6']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					    <div class="div_hr_anli"><hr class="hid_hr6"></hr></div>
					    <div class="d2" >
						<?php if($pic['s1']['p6']['id'] != ''): echo ($pic['s1']['p6']["fenggename"]); ?> | <?php echo ($pic['s1']['p6']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
					</div> 
					<div class="divimg" style="display:inline-block;height: 100%;width: 100%;">	
					<?php if($pic['s1']['p6']['picpath'] != ''): ?><img src="<?php echo ($pic['s1']['p6']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep6.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			    			 					
					</div>
				</a> 				
			    </div>
			</div>
		    </li>   
            </ul>
            <ul class="ul_anli_index2 ul02" style="display: none;"> 
		    <li class="li-1" key="1" style="width:40%;margin:0 0 0 0;"> 
			<div class="case_pad">
			    <?php if($pic['s2']['p1']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s2']['p1']["id"]); ?>.html" target="_blank"> 
				<?php else: ?> 
				    <a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
				<div class="hid2 hid" style="">				    
				    <div class="d1" style="">
					<?php if($pic['s2']['p1']['id'] != ''): echo ($pic['s2']['p1']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
				    <div class="div_hr_anli"><hr class="hid_hr1"></hr></div>
				    <div class="d2" style="height: 32px;line-height: 32px;">
					<?php if($pic['s2']['p1']['id'] != ''): echo ($pic['s2']['p1']["fenggename"]); ?> | <?php echo ($pic['s2']['p1']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
				</div> 
				<div class="divimg" style="display:inline-block;height: 100%;">
				     <?php if($pic['s2']['p1']['picpath'] != ''): ?><img src="<?php echo ($pic['s2']['p1']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					<?php else: ?> 
					    <img src="/Public/home/images/anli/casep1.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			    
				</div>
			    </a> 
			</div>
		    </li>  
		    <li class="li-2" key="2" style="width:58.6%;margin:0 0 0 1.3%;"> 
			<div class="li-2-div1 case_pad" style="height:46%;display:inline-block;float: left;">			    
			    <div class="li-2-div11 case_pad" style="width:49%;height:100%;display:inline-block;float: left;">
				<?php if($pic['s2']['p2']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s2']['p2']["id"]); ?>.html" target="_blank"> 
				    <?php else: ?> 
					<a href="/index.php/home/anli/" target="_blank"><?php endif; ?>   
				    <div class="hid2 hid" style="width:344px;height: 243px;">				    
					<div class="d1">
					    <?php if($pic['s2']['p2']['id'] != ''): echo ($pic['s2']['p2']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					<div class="div_hr_anli"><hr class="hid_hr2"></hr></div>
					<div class="d2">
					    <?php if($pic['s2']['p2']['id'] != ''): echo ($pic['s2']['p2']["fenggename"]); ?> | <?php echo ($pic['s2']['p2']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
				    </div> 
				    <div class="divimg" style="display:inline-block;height: 100%;width: 100%;"> 	
					<?php if($pic['s2']['p2']['picpath'] != ''): ?><img src="<?php echo ($pic['s2']['p2']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep2.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			    				
				    </div>
				</a> 
			    </div>		    
			    <div class="li-2-div12 case_pad" style="width:49%;height:100%;display:inline-block;float: left;margin: 0 0 0 2%;">				
				<?php if($pic['s2']['p3']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s2']['p3']["id"]); ?>.html" target="_blank"> 
				    <?php else: ?> 
					<a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
				    <div class="hid2 hid" style="width:344px;height: 243px;">				    
					<div class="d1">
					    <?php if($pic['s2']['p3']['id'] != ''): echo ($pic['s2']['p3']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					<div class="div_hr_anli"><hr class="hid_hr3"></hr></div>
					<div class="d2">
					    <?php if($pic['s2']['p3']['id'] != ''): echo ($pic['s2']['p3']["fenggename"]); ?> | <?php echo ($pic['s2']['p3']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
				    </div> 
				    <div class="divimg" style="display:inline-block;height: 100%;width: 100%;">
					<?php if($pic['s2']['p3']['picpath'] != ''): ?><img src="<?php echo ($pic['s2']['p3']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep3.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  	 					
				    </div>
				</a> 
			    </div>
			</div>
			<div class="li-2-div2 case_pad" style="height:51%;display:inline-block;float: left;margin: 2% 0 0 0;">
			    <div class="li-2-div21 case_pad" style="width:32%;height:100%;display:inline-block;float: left;">
				    <?php if($pic['s2']['p4']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s2']['p4']["id"]); ?>.html" target="_blank"> 
					<?php else: ?> 
					    <a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
					<div class="hid2 hid" style="width: 225px;height: 270px;">				    
					    <div class="d1" >
						<?php if($pic['s2']['p4']['id'] != ''): echo ($pic['s2']['p4']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					    <div class="div_hr_anli"><hr class="hid_hr4"></hr></div>
					    <div class="d2" >
						<?php if($pic['s2']['p4']['id'] != ''): echo ($pic['s2']['p4']["fenggename"]); ?> | <?php echo ($pic['s2']['p4']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
					</div> 
					<div class="divimg" style="display:inline-block;height: 100%;width: 100%;">	
					<?php if($pic['s2']['p4']['picpath'] != ''): ?><img src="<?php echo ($pic['s2']['p4']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep4.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			    			 					
					</div>
				</a> 				
			    </div>
			    <div class="li-2-div22 case_pad" style="width:32%;height:100%;display:inline-block;float: left;margin: 0 0 0 2%;">
				    <?php if($pic['s2']['p5']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s2']['p5']["id"]); ?>.html" target="_blank"> 
					<?php else: ?> 
					    <a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
					<div class="hid2 hid" style="width: 225px;height: 270px;">				    
					    <div class="d1" >
						<?php if($pic['s2']['p5']['id'] != ''): echo ($pic['s2']['p5']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					    <div class="div_hr_anli"><hr class="hid_hr5"></hr></div>
					    <div class="d2" >
						<?php if($pic['s2']['p5']['id'] != ''): echo ($pic['s2']['p5']["fenggename"]); ?> | <?php echo ($pic['s2']['p5']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
					</div> 
					<div class="divimg" style="display:inline-block;height: 100%;width: 100%;">	
					<?php if($pic['s2']['p5']['picpath'] != ''): ?><img src="<?php echo ($pic['s2']['p5']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep5.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			 				
					</div>
				</a> 				
			    </div>
			    <div class="li-2-div23 case_pad" style="width:32%;height:100%;display:inline-block;float: left;margin: 0 0 0 2%;">
				    <?php if($pic['s2']['p6']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s2']['p6']["id"]); ?>.html" target="_blank"> 
					<?php else: ?> 
					    <a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
					<div class="hid2 hid" style="width: 225px;height: 270px;">				    
					    <div class="d1" >
						<?php if($pic['s2']['p6']['id'] != ''): echo ($pic['s2']['p6']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					    <div class="div_hr_anli"><hr class="hid_hr6"></hr></div>
					    <div class="d2" >
						<?php if($pic['s2']['p6']['id'] != ''): echo ($pic['s2']['p6']["fenggename"]); ?> | <?php echo ($pic['s2']['p6']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
					</div> 
					<div class="divimg" style="display:inline-block;height: 100%;width: 100%;">	
					<?php if($pic['s2']['p6']['picpath'] != ''): ?><img src="<?php echo ($pic['s2']['p6']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep6.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			    			 					
					</div>
				</a> 				
			    </div>
			</div>
		    </li>   
            </ul>
            <ul class="ul_anli_index2 ul03" style="display: none;"> 
		    <li class="li-1" key="1" style="width:40%;margin:0 0 0 0;"> 
			<div class="case_pad">
			    <?php if($pic['s3']['p1']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s3']['p1']["id"]); ?>.html" target="_blank"> 
				<?php else: ?> 
				    <a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
				<div class="hid2 hid" style="">				    
				    <div class="d1" style="">
					<?php if($pic['s3']['p1']['id'] != ''): echo ($pic['s3']['p1']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
				    <div class="div_hr_anli"><hr class="hid_hr1"></hr></div>
				    <div class="d2" style="height: 32px;line-height: 32px;">
					<?php if($pic['s3']['p1']['id'] != ''): echo ($pic['s3']['p1']["fenggename"]); ?> | <?php echo ($pic['s3']['p1']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
				</div> 
				<div class="divimg" style="display:inline-block;height: 100%;">
				     <?php if($pic['s3']['p1']['picpath'] != ''): ?><img src="<?php echo ($pic['s3']['p1']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					<?php else: ?> 
					    <img src="/Public/home/images/anli/casep1.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			    
				</div>
			    </a> 
			</div>
		    </li>  
		    <li class="li-2" key="2" style="width:58.6%;margin:0 0 0 1.3%;"> 
			<div class="li-2-div1 case_pad" style="height:46%;display:inline-block;float: left;">			    
			    <div class="li-2-div11 case_pad" style="width:49%;height:100%;display:inline-block;float: left;">
				<?php if($pic['s3']['p2']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s3']['p2']["id"]); ?>.html" target="_blank"> 
				    <?php else: ?> 
					<a href="/index.php/home/anli/" target="_blank"><?php endif; ?>   
				    <div class="hid2 hid" style="width:344px;height: 243px;">				    
					<div class="d1">
					    <?php if($pic['s3']['p2']['id'] != ''): echo ($pic['s3']['p2']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					<div class="div_hr_anli"><hr class="hid_hr2"></hr></div>
					<div class="d2">
					    <?php if($pic['s3']['p2']['id'] != ''): echo ($pic['s3']['p2']["fenggename"]); ?> | <?php echo ($pic['s3']['p2']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
				    </div> 
				    <div class="divimg" style="display:inline-block;height: 100%;width: 100%;"> 	
					<?php if($pic['s3']['p2']['picpath'] != ''): ?><img src="<?php echo ($pic['s3']['p2']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep2.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			    				
				    </div>
				</a> 
			    </div>		    
			    <div class="li-2-div12 case_pad" style="width:49%;height:100%;display:inline-block;float: left;margin: 0 0 0 2%;">				
				<?php if($pic['s3']['p3']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s3']['p3']["id"]); ?>.html" target="_blank"> 
				    <?php else: ?> 
					<a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
				    <div class="hid2 hid" style="width:344px;height: 243px;">				    
					<div class="d1">
					    <?php if($pic['s3']['p3']['id'] != ''): echo ($pic['s3']['p3']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					<div class="div_hr_anli"><hr class="hid_hr3"></hr></div>
					<div class="d2">
					    <?php if($pic['s3']['p3']['id'] != ''): echo ($pic['s3']['p3']["fenggename"]); ?> | <?php echo ($pic['s3']['p3']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
				    </div> 
				    <div class="divimg" style="display:inline-block;height: 100%;width: 100%;">
					<?php if($pic['s3']['p3']['picpath'] != ''): ?><img src="<?php echo ($pic['s3']['p3']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep3.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  	 					
				    </div>
				</a> 
			    </div>
			</div>
			<div class="li-2-div2 case_pad" style="height:51%;display:inline-block;float: left;margin: 2% 0 0 0;">
			    <div class="li-2-div21 case_pad" style="width:32%;height:100%;display:inline-block;float: left;">
				    <?php if($pic['s3']['p4']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s3']['p4']["id"]); ?>.html" target="_blank"> 
					<?php else: ?> 
					    <a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
					<div class="hid2 hid" style="width: 225px;height: 270px;">				    
					    <div class="d1" >
						<?php if($pic['s3']['p4']['id'] != ''): echo ($pic['s3']['p4']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					    <div class="div_hr_anli"><hr class="hid_hr4"></hr></div>
					    <div class="d2" >
						<?php if($pic['s3']['p4']['id'] != ''): echo ($pic['s3']['p4']["fenggename"]); ?> | <?php echo ($pic['s3']['p4']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
					</div> 
					<div class="divimg" style="display:inline-block;height: 100%;width: 100%;">	
					<?php if($pic['s3']['p4']['picpath'] != ''): ?><img src="<?php echo ($pic['s3']['p4']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep4.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			    			 					
					</div>
				</a> 				
			    </div>
			    <div class="li-2-div22 case_pad" style="width:32%;height:100%;display:inline-block;float: left;margin: 0 0 0 2%;">
				    <?php if($pic['s3']['p5']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s3']['p5']["id"]); ?>.html" target="_blank"> 
					<?php else: ?> 
					    <a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
					<div class="hid2 hid" style="width: 225px;height: 270px;">				    
					    <div class="d1" >
						<?php if($pic['s3']['p5']['id'] != ''): echo ($pic['s3']['p5']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					    <div class="div_hr_anli"><hr class="hid_hr5"></hr></div>
					    <div class="d2" >
						<?php if($pic['s3']['p5']['id'] != ''): echo ($pic['s3']['p5']["fenggename"]); ?> | <?php echo ($pic['s3']['p5']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
					</div> 
					<div class="divimg" style="display:inline-block;height: 100%;width: 100%;">	
					<?php if($pic['s3']['p5']['picpath'] != ''): ?><img src="<?php echo ($pic['s3']['p5']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep5.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			 				
					</div>
				</a> 				
			    </div>
			    <div class="li-2-div23 case_pad" style="width:32%;height:100%;display:inline-block;float: left;margin: 0 0 0 2%;">
				    <?php if($pic['s3']['p6']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($pic['s3']['p6']["id"]); ?>.html" target="_blank"> 
					<?php else: ?> 
					    <a href="/index.php/home/anli/" target="_blank"><?php endif; ?>  
					<div class="hid2 hid" style="width: 225px;height: 270px;">				    
					    <div class="d1" >
						<?php if($pic['s3']['p6']['id'] != ''): echo ($pic['s3']['p6']["dtitle"]); else: ?>我的小窝装修案例<?php endif; ?></div>
					    <div class="div_hr_anli"><hr class="hid_hr6"></hr></div>
					    <div class="d2" >
						<?php if($pic['s3']['p6']['id'] != ''): echo ($pic['s3']['p6']["fenggename"]); ?> | <?php echo ($pic['s3']['p6']["mianji"]); ?>平米<?php else: ?>查看更多<?php endif; ?></div>
					</div> 
					<div class="divimg" style="display:inline-block;height: 100%;width: 100%;">	
					<?php if($pic['s3']['p6']['picpath'] != ''): ?><img src="<?php echo ($pic['s3']['p6']["picpath"]); ?>" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					   <?php else: ?> 
					       <img src="/Public/home/images/anli/casep6.png" alt="点石定制家装 装修案例" width="100%" height="100%"/><?php endif; ?>  			    			 					
					</div>
				</a> 				
			    </div>
			</div>
		    </li>
            </ul>
	</div>
	
    </div>
    <div class="case6" style="width: 100%;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;height: 120px;display: inline-block;">	
	 <div  style="width: 100%;  height: 30px;line-height: 30px;margin-top: 20px;  text-align: center;  border: 0px solid #77918d; border-radius: 0px;">
	     <span class="casepage" onclick="main3_show('pre');" style="display: inline-block;margin-right: 10px;"><</span>
	     <ul style="">
		 <li><span class="div1 current" data="0"></span></li>	
		 <li><span class="div1" data="1"></span></li>	
		 <li><span class="div1" data="2"></span></li>
	     </ul>
	     <span class="casepage" onclick="main3_show('next');" style="display: inline-block;margin-left: 10px;">></span>
	 </div>	 
    </div>  
</div>
    
    <style>
.iVRWrap{}
.iVRWrap .indexTit{padding-top:120px}
.vr_img_box{overflow:hidden}
.vr_img_left_box{width:100%;height:490px;position:relative;margin:0 0 12px 0}
.vr_img_left_img{width:100%;height:490px;position:relative}
#container-img-1 .psv-canvas{width: 100%;height: 490px;} 
.vr_img_right_box{}
.psv-hud{cursor:pointer !important}
.vr_img_bottom{float:left;width:32%;height:250px;position:relative;margin:0 2% 12px 0}
.container-img{width:100%;height:250px;position:relative}
.vr_state_img{display:block;width:120px;height:35px;position:absolute;top:30px;right:30px}
.vr_case_summery{z-index:21;text-align:center;width:100%;background:rgba(0,0,0,0.5);bottom:0;left:0;position:absolute;line-height:40px;font-size:16px;color:#fff;transition:height 0.5s;-moz-transition:height 0.5s;-webkit-transition:height 0.5s;-o-transition:height 0.5s}
.vr_img_bottom_right{overflow:hidden;margin-right:0}
.vr_link{display:block;color:#fff}
.vr_link span{padding:0 5px}
.iVRWrap .iView{margin-top:20px} 
.iVRWrap span em{font-style: normal;}
 
@media screen and (max-width: 1451px) { 
/*    .vr_img_left_box{height:350px;}
    .vr_img_left_img{height:350px;}
    #container-img-1 .psv-canvas{height: 350px;}
        
    .vr_img_bottom{height:200px;}
    .container-img{height:200px;}*/
}


	</style>
	
<link rel="stylesheet" type="text/css" href="/Public/css/photo-sphere-viewer.min.css">
<script type="text/javascript" src="/Public/js/three.min.js"></script>
<script type="text/javascript" src="/Public/js/D.min.js"></script>
<script type="text/javascript" src="/Public/js/doT.min.js"></script>
<script type="text/javascript" src="/Public/js/uevent.min.js"></script>
<script type="text/javascript" src="/Public/js/photo-sphere-viewer.min.js"></script>

<div id="main31" class="iVRWrap" style="width:1200px;height: auto;margin-top: 0px;padding-bottom: 4%;background: #f5f6f6;margin: 0 auto;"> 
     <div id="quanjin0" class="case" style="text-align:center; height: 45px; padding-top: 0px;">  
    </div>  
    <div id="quanjin4" class="case" style="margin-left: 0%;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;width: 100%;display: inline-block;"> 
	<div class="list_title" style="width:275px;display: inline-block; float: left;text-align: left;">720°全景装修案例</div>
	<div class="list_title1" style="display: inline-block;float: left;position: relative;width: 220px;"><p>720° panoramic  case</p></div>
	<div class="case_tyle" style="width: 30%;display: inline-block;">
	    &nbsp;
	</div>
	<a href="/index.php/home/quanjin/" style="text-decoration:none;">
	    <div class="list_more" style="width: 80px;display: inline-block; float: right; text-align: right; padding-right: 5px;">更多 >></div>
	</a>
	<hr class="list_hr" style="width: 99.5%;border-bottom: solid 1px #dcdcdc;"></hr>
    </div>  
    
    <div id="quanjin5" class="Column case" style="margin: 30px 0 0 0%;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;width: 100%;display: inline-block;"> 
	<div class="vr_img_box">
	    <a class="vr_link" href="javascript:void(0);" title="我的小窝全景案例" target="_blank">
	    <div class="vr_img_left_box">
		<div class="vr_img_left_img" id="container-img-1">
		    <div class="psv-container">
			<div class="psv-loader-container" style="display: none;">
			    <div class="psv-loader">
				<canvas class="psv-loader-canvas" width="150" height="150"></canvas>
				<div class="psv-loader-text" style="max-width: 99px; max-height: 99px;">Loading...</div>				
			    </div>				    
			</div>
			<div class="psv-navbar psv-navbar--open" style="display: none;"></div>
			<div class="psv-hud" style="cursor: move;">
			    <svg class="psv-hud-svg-container"></svg>
			    <div class="psv-tooltip" style="top: -1000px; left: -1000px;">
				<div class="psv-tooltip-arrow"></div>
				<div class="psv-tooltip-content"></div>				    
			    </div>			    
			</div>
			<div class="psv-panel">
			    <div class="psv-panel-resizer"></div>
			    <div class="psv-panel-close-button"></div>
			    <div class="psv-panel-content"></div>			    
			</div>
			<div class="psv-canvas-container" style="opacity: 1;">
			    <canvas class="psv-canvas" style="width: 100%;"></canvas>
			</div>
		    </div>
		</div>
		<img class="vr_state_img" src="/Public/home/images/720/vr_active_play.png">
		<div class="vr_case_summery height1" style="z-index:1">
		    <span>自建别墅<em>&nbsp;|&nbsp;260㎡</em><em>&nbsp;|&nbsp;地中海</em></span>
		</div>
	    </div>
	    </a>
	    <div class="vr_img_right_box clearfix">
		<a class="vr_link" href="javascript:void(0);" title="我的小窝全景案例" target="_blank">
		<div class="vr_img_bottom vr_img_bottom_2">
		    <div class="container-img" id="container-img-2">
			<div class="psv-container">
			    <div class="psv-loader-container" style="display: none;">
				<div class="psv-loader">
				    <canvas class="psv-loader-canvas" width="150" height="150"></canvas>
				    <div class="psv-loader-text" style="max-width: 99px; max-height: 99px;">Loading...</div>				    
				</div>				
			    </div>
			    <div class="psv-navbar psv-navbar--open" style="display: none;"></div>
			    <div class="psv-hud" style="cursor: move;">
				<svg class="psv-hud-svg-container"></svg>
				<div class="psv-tooltip" style="top: -1000px; left: -1000px;">
				    <div class="psv-tooltip-arrow"></div>
				    <div class="psv-tooltip-content"></div>				    
				</div>				    
			    </div>
			    <div class="psv-panel"><div class="psv-panel-resizer"></div><div class="psv-panel-close-button"></div><div class="psv-panel-content"></div></div>
			    <div class="psv-canvas-container" style="opacity: 1;">
				<canvas class="psv-canvas" style=""></canvas>
			    </div>
			</div>
		    </div>
		    <div class="vr_state_img">
			<img src="/Public/home/images/720/vr_play.png" class="vr_play_btn_1">
			<img src="/Public/home/images/720/vr_active_play.png" class="vr_active_play_btn_1" style="display:none">
		    </div>
		    <div class="vr_case_summery height0" style="bottom:-2px;">
			<span>润和紫郡<em>&nbsp;|&nbsp;150㎡</em><em>&nbsp;|&nbsp;新中式</em></span>
		    </div>
		</div>
		</a>
		<a class="vr_link" href="javascript:void(0);" title="我的小窝全景案例" target="_blank">
		<div class="vr_img_bottom vr_img_bottom_3">
		    <div class="container-img" id="container-img-3">
			<div class="psv-container">
			    <div class="psv-loader-container" style="display: none;">
				<div class="psv-loader">
				    <canvas class="psv-loader-canvas" width="150" height="150"></canvas>
				    <div class="psv-loader-text" style="max-width: 99px; max-height: 99px;">Loading...</div></div></div>
				    <div class="psv-navbar psv-navbar--open" style="display: none;"></div>
				    <div class="psv-hud" style="cursor: move;"><svg class="psv-hud-svg-container"></svg><div class="psv-tooltip" style="top: -1000px; left: -1000px;"><div class="psv-tooltip-arrow"></div><div class="psv-tooltip-content"></div></div></div>
				    <div class="psv-panel">
					<div class="psv-panel-resizer"></div>
					<div class="psv-panel-close-button"></div>
					<div class="psv-panel-content"></div>					    
				    </div>
				    <div class="psv-canvas-container" style="opacity: 1;">
					<canvas class="psv-canvas" style=""></canvas>
				    </div>
			</div>
		    </div>
		    <div class="vr_state_img">
			<img src="/Public/home/images/720/vr_play.png" class="vr_play_btn_1">
			<img src="/Public/home/images/720/vr_active_play.png" class="vr_active_play_btn_1" style="display:none">
		    </div>
		    <div class="vr_case_summery height0" style="bottom:-2px;">
			<span>盛世佳苑<em>&nbsp;|&nbsp;140㎡</em><em>&nbsp;|&nbsp;现代简约</em></span>
		    </div>
		</div>
		</a>
		<a class="vr_link" href="javascript:void(0);" title="我的小窝全景案例" target="_blank">
		<div class="vr_img_bottom vr_img_bottom_4" id="end" style="margin:0 0 12px 0;">
		    <div class="container-img" id="container-img-4">
			<div class="psv-container">
			    <div class="psv-loader-container" style="display: none;">
				<div class="psv-loader"><canvas class="psv-loader-canvas" width="150" height="150"></canvas>
				<div class="psv-loader-text" style="max-width: 99px; max-height: 99px;">Loading...</div></div>					    
			    </div>
			    <div class="psv-navbar psv-navbar--open" style="display: none;"></div>
			    <div class="psv-hud" style="cursor: move;"><svg class="psv-hud-svg-container"></svg><div class="psv-tooltip" style="top: -1000px; left: -1000px;"><div class="psv-tooltip-arrow"></div><div class="psv-tooltip-content"></div></div></div>
			    <div class="psv-panel"><div class="psv-panel-resizer"></div><div class="psv-panel-close-button"></div><div class="psv-panel-content"></div></div>
			    <div class="psv-canvas-container" style="opacity: 1;">
				<canvas class="psv-canvas" style=""></canvas>
			    </div>
			</div>
		    </div>
		    <div class="vr_state_img">
			<img src="/Public/home/images/720/vr_play.png" class="vr_play_btn_1">
			<img src="/Public/home/images/720/vr_active_play.png" class="vr_active_play_btn_1" style="display:none">
		    </div>
		    <div class="vr_case_summery height0" style="bottom:-2px;">
			<span>东方明珠<em>&nbsp;|&nbsp;135㎡</em><em>&nbsp;|&nbsp;简欧</em></span>
		    </div>
		</div>
		</a>
	    </div>
	</div>
    </div>  
</div>
<script>
$(function(){
	//全景图上
    try {
        var viewer1 = PhotoSphereViewer({
            container:'container-img-1',
            panorama:'/Public/home/images/720/dsvr01.jpg',
            autoload:true,
            allow_scroll_to_zoom:false,
            navbar:false,
            allow_user_interactions:false,
			//min_fov:90,
			//max_fov:90,
            anim_speed:'1rpm'
        });
        /*viewer1.on('ready',function(){
            viewer1.stopAutorotate();
        })
        $('.vr_img_bottom_1').hover(function(){
            viewer1.startAutorotate();
        },function(){
            viewer1.stopAutorotate();
        })*/
        //全景图下左
        var viewer2 = PhotoSphereViewer({
            container:'container-img-2',
            panorama:'/Public/home/images/720/dsvr02.png',
            autoload:true,
            navbar:false,
            allow_scroll_to_zoom:false,
            allow_user_interactions:false,
			//min_fov:90,
			//max_fov:90
        });
        viewer2.on('ready',function(){
            viewer2.stopAutorotate();
        })
        $('.vr_img_bottom_2').hover(function(){
            viewer2.startAutorotate();
        },function(){
            viewer2.stopAutorotate();
        })
        //全景图下中
        var viewer3 = PhotoSphereViewer({
            container:'container-img-3',
            panorama:'/Public/home/images/720/dsvr03.jpg',
            autoload:true,
            navbar:false,
            allow_scroll_to_zoom:false,
            allow_user_interactions:false,
			//min_fov:90,
			//max_fov:90
        });
        viewer3.on('ready',function(){
            viewer3.stopAutorotate();
        })
        $('.vr_img_bottom_3').hover(function(){
            viewer3.startAutorotate();
        },function(){
            viewer3.stopAutorotate();
        })
        //全景图下右
        var viewer4 = PhotoSphereViewer({
            container:'container-img-4',
            panorama:'/Public/home/images/720/dsvr04.jpg',
            autoload:true,
            navbar:false,
            allow_scroll_to_zoom:false,
            allow_user_interactions:false,
			//min_fov:90,
			//max_fov:90
        });
        viewer4.on('ready',function(){
            viewer4.stopAutorotate();
        })
        $('.vr_img_bottom_4').hover(function(){
            viewer4.startAutorotate();
        },function(){
            viewer4.stopAutorotate();
        });
	var li = $("#container-img-1 .psv-container");
//	alert(li.length);
	if(li.length==2){
	   $("#container-img-1 .psv-container").eq(0).hide();
	}
	li = $("#container-img-2 .psv-container");
//	alert(li.length);
	if(li.length==2){
	   $("#container-img-2 .psv-container").eq(0).hide();
	}
	li = $("#container-img-3 .psv-container");
//	alert(li.length);
	if(li.length==2){
	   $("#container-img-3 .psv-container").eq(0).hide();
	}
	li = $("#container-img-4 .psv-container");
//	alert(li.length);
	if(li.length==2){
	   $("#container-img-4 .psv-container").eq(0).hide();
	}
    }catch (e){
        console.log('no support ie');
        $('#container-img-1').css({
            backgroundColor:'rgba(15,150,8,0.5)',
            backgroundSize:'cover',
            backgroundPosition:'center center'
        })
        $('#container-img-2').css({
            backgroundColor:'rgba(15,150,8,0.5)',
            backgroundSize:'cover',
            backgroundPosition:'center center'
        })
        $('#container-img-3').css({
            backgroundColor:'rgba(15,150,8,0.5)',
            backgroundSize:'cover',
            backgroundPosition:'center center'
        })
        $('#container-img-4').css({
            backgroundColor:'rgba(15,150,8,0.5)',
            backgroundSize:'cover',
            backgroundPosition:'center center'
        })
    }

});
</script>
</div>   
    
<div style="width:100%;height: auto;background: url(/Public/home/images/bg_shejishi.jpg) no-repeat left center;background-size: 100% 100%;">    
    <div id="main4" style="width:1200px;height: auto;margin: 0 auto;"> 
	<div id="shejishi0" class="case" style="text-align:center; height: 45px; padding-top: 0px;">  
	</div>
	 <div id="shejishi4" class="case" style="margin-left: 0%;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;width: 100%;display: inline-block;"> 
	    <div class="list_title" style="color:#fefefe;display: inline-block; float: left;text-align: left;">设计团队</div>
	    <div class="list_title1" style="display: inline-block;float: left;position: relative;color:#fff;"><p style="color:#fff;">Design team</p></div>
	    <div class="shejishi_style" style="display: inline-block;float:right;margin:10 0 0 0;height: 30px;">
		<?php if(is_array($ranks)): $i = 0; $__LIST__ = $ranks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><div name="fg_<?php echo ($so["evalue"]); ?>"><a href="/index.php/home/shejishi/index/rank/<?php echo ($so["evalue"]); ?>" target="_blank"><span><?php echo ($so["ename"]); ?></span></a></div><?php endforeach; endif; else: echo "" ;endif; ?> 
	    </div>
	    <a href="/index.php/home/shejishi/" style="text-decoration:none;display: none;">
		<div class="list_more" style="width: 80px;display: inline-block; float: right; text-align: right; padding-right: 5px;">更多 >></div>
	    </a>
	    <hr class="list_hr" style="width: 99.5%;border-bottom: solid 0.5px #dcdcdc;"></hr>
	</div>    
	<div id="shejishi4" class="case" style="text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;display: inline-block;width: 100%;"> 
	    <div class="shejishi_tyle" style="width: 34%;padding-left: 33%;"> 
	    </div>
	</div>  

	<div id="shejishi5" class="case" style="margin-top: 30px;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;display: inline-block;width: 100%;"> 
	    <div class="shejishi_list" style="width:100%;">
		<ul class="ul_shejishi_index uls01" style="display:block;"> 
		     <li class="li-1" key="1" style="width:27%;margin:0 0 0 0;"> 
			    <div class="case_pad">
				  <?php if($shejishis['s1']['p1']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>shejishi/<?php echo ($shejishis['s1']['p1']["id"]); ?>.html" target="_blank"> 
					<?php else: ?> 
					    <a href="/index.php/home/shejishi/" target="_blank"><?php endif; ?>    
				    <div style="display:inline-block;height: 100%;width:100%;">
					<?php if($shejishis['s1']['p1']['star_cover'] != '' && $shejishis['s1']['p1']['star_cover'] != '0'): ?><img src="<?php echo ($shejishis['s1']['p1']["star_cover"]); ?>" alt="点石定制家装" width="100%" height="100%"/>  
					<?php elseif($shejishis['s1']['p1']['pathinfo'] != '' && $shejishis['s1']['p1']['pathinfo'] != '0'): ?>
						<img src="<?php echo ($shejishis['s1']['p1']["pathinfo"]); ?>" alt="点石定制家装" width="100%" height="100%"/>  
					<?php else: ?>
					    <img src="/Public/Home/images/shejishi/home01.png" alt="点石定制家装" width="100%" height="100%"/><?php endif; ?>    				    
				    </div>
				    <?php if($shejishis['s1']['p1']['id'] != ''): ?><div class="hid4">	 
					    </div>
					<div class="hid3">	
					    <span class="span1"><?php echo ($shejishis['s1']['p1']["nickname"]); ?></span>&nbsp;|&nbsp;<span class="span2"><?php echo ($shejishis['s1']['p1']["rankname"]); ?></span>&nbsp;<span class="span3"></span>
					</div><?php endif; ?>	
				</a> 
			    </div>
			</li>  
			<li class="li-2" key="2" style="width:48.6%;margin:0 0 0 0%;"> 
			    <div class="li-2-div1 case_pad" style="height:50%;width:100%;display:inline-block;float: left;">			    
				<div id="li-2-div11" class="case_pad" style="width:50%;height:100%;display:inline-block;float: left;">
				    <?php if($shejishis['s1']['p2']['aid'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($shejishis['s1']['p2']["aid"]); ?>.html" target="_blank"> 
					  <?php else: ?> 
					  <a href="/index.php/home/anli/" target="_blank"><?php endif; ?> 
					<div style="display:inline-block;height: 100%;width:100%;">
					    <?php if($shejishis['s1']['p2']['home_cover_sheji_pic'] != ''): ?><img src="<?php echo ($shejishis['s1']['p2']["home_cover_sheji_pic"]); ?>" alt="点石定制家装" width="100%" height="100%"/>  
						  <?php else: ?> 
						<img src="/Public/home/images/shejishi/dsstar1_2.png" alt="点石定制家装" width="100%" height="100%"/><?php endif; ?>     				
					</div>
					<?php if($shejishis['s1']['p2']['aid'] != ''): ?><div class="hid4">	 
					    </div>
					    <div class="hid3">	
						<span class="span1"><?php echo ($shejishis['s1']['p2']["atitle"]); ?></span>&nbsp;|&nbsp;
						<span class="span2"><?php echo ($shejishis['s1']['p2']["fenggename"]); ?></span>&nbsp;|&nbsp;
						<span class="span3"><?php echo ($shejishis['s1']['p2']["mianji"]); ?>平米</span>
					    </div><?php endif; ?>	
				    </a> 
				</div>		    
				<div class="li-2-div12 case_pad" style="width:50%;height:100%;display:inline-block;float: left;margin: 0 0 0 0%;">
				    <?php if($shejishis['s1']['p3']['aid'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($shejishis['s1']['p3']["aid"]); ?>.html" target="_blank"> 
					  <?php else: ?> 
					  <a href="/index.php/home/anli/" target="_blank"><?php endif; ?> 
					<div style="display:inline-block;height: 100%;width:100%;">
					    <?php if($shejishis['s1']['p3']['home_cover_sheji_pic'] != ''): ?><img src="<?php echo ($shejishis['s1']['p3']["home_cover_sheji_pic"]); ?>" alt="点石定制家装" width="100%" height="100%"/>  
						  <?php else: ?> 
						<img src="/Public/home/images/shejishi/dsstar1_3.png" alt="点石定制家装" width="100%" height="100%"/><?php endif; ?>     		 			
					</div>
					<?php if($shejishis['s1']['p3']['aid'] != ''): ?><div class="hid4">	 
					    </div>
					    <div class="hid3">	
						<span class="span1"><?php echo ($shejishis['s1']['p3']["atitle"]); ?></span>&nbsp;|&nbsp;
						<span class="span2"><?php echo ($shejishis['s1']['p3']["fenggename"]); ?></span>&nbsp;|&nbsp;
						<span class="span3"><?php echo ($shejishis['s1']['p3']["mianji"]); ?>平米</span>
					    </div><?php endif; ?>	
				    </a> 
				</div>
			    </div>
			    <div class="li-2-div2 case_pad" style="height:50%;width:100%;display:inline-block;float: left;margin: 0% 0 0 0;">
				<div class="li-2-div21 case_pad" style="width:50%;height:100%;display:inline-block;float: left;">
					<div class="sinfo" style="width: 100%;">			    
					    <div class="d1" >
						<?php echo ($shejishis['s1']['p1']["nickname"]); ?></div>
					    <div class="d2" >
						<?php echo ($shejishis['s1']['p1']["rankname"]); ?></div>
					    <div class="d3" >
						从业年限 <?php echo ($shejishis['s1']['p1']["years"]); ?>年 <?php echo ($shejishis['s1']['p1']["areaname"]); ?></div>
					    <div class="d4" >
						<a href="<?php echo ($html_path_pc); ?>shejishi/<?php echo ($shejishis['s1']['p1']["id"]); ?>.html" target="_blank"><div class="div1">查看详情></div></a>&nbsp;&nbsp;
						<a href="/q/" target="_blank"><div class="div2">立即预约></div></a> 
					    </div>
					</div>  

				</div>
				<div class="li-2-div22 case_pad" style="width:50%;height:100%;display:inline-block;float: left;margin: 0 0 0 0%;">
					<?php if($shejishis['s1']['p5']['aid'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($shejishis['s1']['p5']["aid"]); ?>.html" target="_blank"> 
					      <?php else: ?> 
					      <a href="/index.php/home/anli/" target="_blank"><?php endif; ?> 
					    <div style="display:inline-block;height: 100%;width: 100%;">
					    <?php if($shejishis['s1']['p5']['home_cover_sheji_pic'] != ''): ?><img src="<?php echo ($shejishis['s1']['p5']["home_cover_sheji_pic"]); ?>" alt="点石定制家装" width="100%" height="100%"/>  
						  <?php else: ?> 
						<img src="/Public/home/images/shejishi/dsstar1_5.png" alt="点石定制家装" width="100%" height="100%"/><?php endif; ?>     		 							
					    </div>
					    <?php if($shejishis['s1']['p5']['aid'] != ''): ?><div class="hid4">	 
					    </div>
						<div class="hid3">	
						    <span class="span1"><?php echo ($shejishis['s1']['p5']["atitle"]); ?></span>&nbsp;|&nbsp;
						    <span class="span2"><?php echo ($shejishis['s1']['p5']["fenggename"]); ?></span>&nbsp;|&nbsp;
						    <span class="span3"><?php echo ($shejishis['s1']['p5']["mianji"]); ?>平米</span>
						</div><?php endif; ?>	
				    </a> 				
				</div> 
			    </div>
			</li>    
		       <li class="li-3" key="1" style="width:24.3%;margin:0 0 0 0;"> 
			    <div class="case_pad">
				    <?php if($shejishis['s1']['p6']['aid'] != ''): ?><a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($shejishis['s1']['p6']["aid"]); ?>.html" target="_blank"> 
					  <?php else: ?> 
					  <a href="/index.php/home/anli/" target="_blank"><?php endif; ?> 
				    <div style="display:inline-block;height: 100%;width:100%;">
					<?php if($shejishis['s1']['p6']['home_cover_sheji_pic'] != ''): ?><img src="<?php echo ($shejishis['s1']['p6']["home_cover_sheji_pic"]); ?>" alt="点石定制家装" width="100%" height="100%"/>  
					      <?php else: ?> 
					    <img src="/Public/home/images/shejishi/dsstar1_6.png" alt="点石定制家装" width="100%" height="100%"/><?php endif; ?>     		 						    
				    </div> 
				    <?php if($shejishis['s1']['p6']['aid'] != ''): ?><div class="hid4">	 
					    </div>
					<div class="hid3">	
					    <span class="span1"><?php echo ($shejishis['s1']['p6']["atitle"]); ?></span>&nbsp;|&nbsp;
					    <span class="span2"><?php echo ($shejishis['s1']['p6']["fenggename"]); ?></span>&nbsp;|&nbsp;
					    <span class="span3"><?php echo ($shejishis['s1']['p6']["mianji"]); ?>平米</span>
					</div><?php endif; ?>	
				</a> 
			    </div>
			</li>  

		</ul>

		<ul class="ul_shejishi_index uls02" style="display:none;"> 
		     <li class="li-1" key="1" style="width:27%;margin:0 0 0 0;"> 
			    <div class="case_pad">
				 <?php if($shejishis['s2']['p1']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>shejishi/<?php echo ($shejishis['s2']['p1']["id"]); ?>.html" target="_blank"> 
					<?php else: ?> 
					    <a href="/index.php/home/shejishi/" target="_blank"><?php endif; ?>    
				    <div style="display:inline-block;height: 100%;width:100%;">
					<?php if($shejishis['s2']['p1']['star_cover'] != '' && $shejishis['s2']['p1']['star_cover'] != '0'): ?><img src="<?php echo ($shejishis['s2']['p1']["star_cover"]); ?>" alt="点石定制家装" width="100%" height="100%"/>  
					      <?php elseif($shejishis['s2']['p1']['pathinfo'] != '' && $shejishis['s2']['p1']['pathinfo'] != '0'): ?>
						<img src="<?php echo ($shejishis['s2']['p1']["pathinfo"]); ?>" alt="点石定制家装" width="100%" height="100%"/>  
					      <?php else: ?>
					    <img src="/Public/Home/images/shejishi/home01.png" alt="点石定制家装" width="100%" height="100%"/><?php endif; ?>    				    
				    </div> 
				    <?php if($shejishis['s2']['p1']['id'] != ''): ?><div class="hid4">	 
					    </div>
						<div class="hid3">	
							<span class="span1"><?php echo ($shejishis['s2']['p1']["nickname"]); ?></span>&nbsp;|&nbsp;
							<span class="span2"><?php echo ($shejishis['s2']['p1']["rankname"]); ?></span>&nbsp;<span class="span3"></span>
						</div><?php endif; ?>
				</a> 
			    </div>
			</li>  
			<li class="li-2" key="2" style="width:48.6%;margin:0 0 0 0%;"> 
			    <div class="li-2-div1 case_pad" style="height:50%;width:100%;display:inline-block;float: left;">			    
				<div id="li-2-div11" class="case_pad" style="width:50%;height:100%;display:inline-block;float: left;"> 
				    <a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($shejishis['s2']['p2']["aid"]); ?>.html" target="_blank">  
					<div style="display:inline-block;height: 100%;width:100%;"> 
						<img src="<?php echo ($shejishis['s2']['p2']["home_cover_sheji_pic"]); ?>" alt="点石定制家装" width="100%" height="100%"/>   
					</div>
					<?php if($shejishis['s2']['p2']['aid'] != ''): ?><div class="hid4">	 
					    </div>
					    <div class="hid3">	
						<span class="span1"><?php echo ($shejishis['s2']['p2']["atitle"]); ?></span>&nbsp;|&nbsp;<span class="span2"><?php echo ($shejishis['s2']['p2']["fenggename"]); ?></span>&nbsp;|&nbsp;
						<span class="span3"><?php echo ($shejishis['s2']['p2']["mianji"]); ?>平米</span>
					    </div><?php endif; ?>	
				    </a> 
				</div>		    
				<div class="li-2-div12 case_pad" style="width:50%;height:100%;display:inline-block;float: left;margin: 0 0 0 0%;"> 
				    <a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($shejishis['s2']['p3']["aid"]); ?>.html" target="_blank">  
					<div style="display:inline-block;height: 100%;width:100%;"> 
					    <img src="<?php echo ($shejishis['s2']['p3']["home_cover_sheji_pic"]); ?>" alt="点石定制家装" width="100%" height="100%"/>   
					</div>
					<?php if($shejishis['s2']['p3']['aid'] != ''): ?><div class="hid4">	 
					    </div>
					    <div class="hid3">	
						<span class="span1"><?php echo ($shejishis['s2']['p3']["atitle"]); ?></span>&nbsp;|&nbsp;<span class="span2"><?php echo ($shejishis['s2']['p3']["fenggename"]); ?></span>&nbsp;|&nbsp;
						<span class="span3"><?php echo ($shejishis['s2']['p3']["mianji"]); ?>平米</span>
					    </div><?php endif; ?>	
				    </a> 
				</div>
			    </div>
			    <div class="li-2-div2 case_pad" style="height:50%;width:100%;display:inline-block;float: left;margin: 0% 0 0 0;">
				<div class="li-2-div21 case_pad" style="width:50%;height:100%;display:inline-block;float: left;">
					<div class="sinfo" style="width: 100%;">				    
					    <div class="d1" >
						<?php echo ($shejishis['s2']['p1']["nickname"]); ?></div>
					    <div class="d2" >
						<?php echo ($shejishis['s2']['p1']["rankname"]); ?></div>
					    <div class="d3" >
						从业年限 <?php echo ($shejishis['s2']['p1']["years"]); ?>年 <?php echo ($shejishis['s2']['p1']["areaname"]); ?></div>
					    <div class="d4" >
						<a href="<?php echo ($html_path_pc); ?>shejishi/<?php echo ($shejishis['s2']['p1']["id"]); ?>.html" target="_blank"><div class="div1">查看详情></div></a>&nbsp;&nbsp;
						<a href="/q/" target="_blank"><div class="div2">立即预约></div></a>

					    </div>
					</div>  

				</div>
				<div class="li-2-div22 case_pad" style="width:50%;height:100%;display:inline-block;float: left;margin: 0 0 0 0%;"> 
					<a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($shejishis['s2']['p5']["aid"]); ?>.html" target="_blank">  
					    <div style="display:inline-block;height: 100%;width: 100%;"> 
						<img src="<?php echo ($shejishis['s2']['p5']["home_cover_sheji_pic"]); ?>" alt="点石定制家装" width="100%" height="100%"/>  
					    </div>
					    <?php if($shejishis['s2']['p5']['aid'] != ''): ?><div class="hid4">	 
					    </div>
						<div class="hid3">	
						    <span class="span1"><?php echo ($shejishis['s2']['p5']["atitle"]); ?></span>&nbsp;|&nbsp;<span class="span2"><?php echo ($shejishis['s2']['p5']["fenggename"]); ?></span>&nbsp;|&nbsp;
						    <span class="span3"><?php echo ($shejishis['s2']['p5']["mianji"]); ?>平米</span>
						</div><?php endif; ?>	
				    </a> 				
				</div> 
			    </div>
			</li>    
		       <li class="li-3" key="1" style="width:24.3%;margin:0 0 0 0;"> 
			    <div class="case_pad"> 
				<a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($shejishis['s2']['p6']["aid"]); ?>.html" target="_blank">  
				    <div style="display:inline-block;height: 100%;width:100%;"> 
					<img src="<?php echo ($shejishis['s2']['p6']["home_cover_sheji_pic"]); ?>" alt="点石定制家装" width="100%" height="100%"/>   
				    </div> 
				    <?php if($shejishis['s2']['p6']['aid'] != ''): ?><div class="hid4">	 
					    </div>
					<div class="hid3">	
					    <span class="span1"><?php echo ($shejishis['s2']['p6']["atitle"]); ?></span>&nbsp;|&nbsp;
					    <span class="span2"><?php echo ($shejishis['s2']['p6']["fenggename"]); ?></span>&nbsp;|&nbsp;
					    <span class="span3"><?php echo ($shejishis['s2']['p6']["mianji"]); ?>平米</span>
					</div><?php endif; ?>	
				</a> 
			    </div>
			</li>  
		</ul>

		<ul class="ul_shejishi_index uls03" style="display:none;"> 
		     <li class="li-1" key="1" style="width:27%;margin:0 0 0 0;"> 
			    <div class="case_pad">
				 <?php if($shejishis['s3']['p1']['id'] != ''): ?><a href="<?php echo ($html_path_pc); ?>shejishi/<?php echo ($shejishis['s3']['p1']["id"]); ?>.html" target="_blank"> 
					<?php else: ?> 
					    <a href="/index.php/home/shejishi/" target="_blank"><?php endif; ?>    
				    <div style="display:inline-block;height: 100%;width:100%;">
					<?php if($shejishis['s3']['p1']['star_cover'] != '' && $shejishis['s3']['p1']['star_cover'] != '0'): ?><img src="<?php echo ($shejishis['s3']['p1']["star_cover"]); ?>" alt="点石定制家装" width="100%" height="100%"/>  
					    <?php elseif($shejishis['s3']['p1']['pathinfo'] != '' && $shejishis['s3']['p1']['pathinfo'] != '0'): ?>
						<img src="<?php echo ($shejishis['s3']['p1']["pathinfo"]); ?>" alt="点石定制家装" width="100%" height="100%"/>  
					      <?php else: ?>
					    <img src="/Uploads/shejishi/<?php echo ($shejishis['s3']['p1']['sno']); ?>.jpg" alt="点石定制家装" width="100%" height="100%"/><?php endif; ?>    				    
				    </div>  
				    <?php if($shejishis['s3']['p1']['id'] != ''): ?><div class="hid4">	 
					    </div>
					<div class="hid3">	
					    <span class="span1"><?php echo ($shejishis['s3']['p1']["nickname"]); ?></span>&nbsp;|&nbsp;<span class="span2"><?php echo ($shejishis['s3']['p1']["rankname"]); ?></span>&nbsp;<span class="span3"></span>
					</div><?php endif; ?>
				</a> 
			    </div>
			</li>  
			<li class="li-2" key="2" style="width:48.6%;margin:0 0 0 0%;"> 
			    <div class="li-2-div1 case_pad" style="height:50%;width:100%;display:inline-block;float: left;">			    
				<div id="li-2-div11" class="case_pad" style="width:50%;height:100%;display:inline-block;float: left;"> 
				    <a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($shejishis['s3']['p2']["aid"]); ?>.html" target="_blank">  
					<div style="display:inline-block;height: 100%;width:100%;"> 
						<img src="<?php echo ($shejishis['s3']['p2']["home_cover_sheji_pic"]); ?>" alt="点石定制家装" width="100%" height="100%"/>   
					</div>
					<?php if($shejishis['s3']['p2']['aid'] != ''): ?><div class="hid4">	 
					    </div>
					    <div class="hid3">	
						<span class="span1"><?php echo ($shejishis['s3']['p2']["atitle"]); ?></span>&nbsp;|&nbsp;<span class="span2"><?php echo ($shejishis['s3']['p2']["fenggename"]); ?></span>&nbsp;|&nbsp;
						<span class="span3"><?php echo ($shejishis['s3']['p2']["mianji"]); ?>平米</span>
					    </div><?php endif; ?>	
				    </a> 
				</div>		    
				<div class="li-2-div12 case_pad" style="width:50%;height:100%;display:inline-block;float: left;margin: 0 0 0 0%;"> 
				    <a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($shejishis['s3']['p3']["aid"]); ?>.html" target="_blank">  
					<div style="display:inline-block;height: 100%;width:100%;"> 
					    <img src="<?php echo ($shejishis['s3']['p3']["home_cover_sheji_pic"]); ?>" alt="点石定制家装" width="100%" height="100%"/>   
					</div>
					<?php if($shejishis['s3']['p3']['aid'] != ''): ?><div class="hid4">	 
					    </div>
					    <div class="hid3">	
						<span class="span1"><?php echo ($shejishis['s3']['p3']["atitle"]); ?></span>&nbsp;|&nbsp;<span class="span2"><?php echo ($shejishis['s3']['p3']["fenggename"]); ?></span>&nbsp;|&nbsp;
						<span class="span3"><?php echo ($shejishis['s3']['p3']["mianji"]); ?>平米</span>
					    </div><?php endif; ?>	
				    </a> 
				</div>
			    </div>
			    <div class="li-2-div2 case_pad" style="height:50%;width:100%;display:inline-block;float: left;margin: 0% 0 0 0;">
				<div class="li-2-div21 case_pad" style="width:50%;height:100%;display:inline-block;float: left;">
					<div class="sinfo" style="width: 100%;">				    
					    <div class="d1" >
						<?php echo ($shejishis['s3']['p1']["nickname"]); ?></div>
					    <div class="d2" >
						<?php echo ($shejishis['s3']['p1']["rankname"]); ?></div>
					    <div class="d3" >
						从业年限<?php echo ($shejishis['s3']['p1']["years"]); ?>年 <?php echo ($shejishis['s3']['p1']["areaname"]); ?></div>
					    <div class="d4" >
						<a href="<?php echo ($html_path_pc); ?>shejishi/<?php echo ($shejishis['s3']['p1']["id"]); ?>.html" target="_blank"><div class="div1">查看详情></div></a>&nbsp;&nbsp;
						<a href="/q/" target="_blank"><div class="div2">立即预约></div></a>

					    </div>
					</div>  

				</div>
				<div class="li-2-div22 case_pad" style="width:50%;height:100%;display:inline-block;float: left;margin: 0 0 0 0%;"> 
					<a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($shejishis['s3']['p5']["aid"]); ?>.html" target="_blank">  
					    <div style="display:inline-block;height: 100%;width: 100%;"> 
						<img src="<?php echo ($shejishis['s3']['p5']["home_cover_sheji_pic"]); ?>" alt="点石定制家装" width="100%" height="100%"/>  
					    </div>
					    <?php if($shejishis['s3']['p5']['aid'] != ''): ?><div class="hid4">	 
						</div>
						<div class="hid3">	
						    <span class="span1"><?php echo ($shejishis['s3']['p5']["atitle"]); ?></span>&nbsp;|&nbsp;<span class="span2"><?php echo ($shejishis['s3']['p5']["fenggename"]); ?></span>&nbsp;|&nbsp;
						    <span class="span3"><?php echo ($shejishis['s3']['p5']["mianji"]); ?>平米</span>
						</div><?php endif; ?>	
				    </a> 				
				</div> 
			    </div>
			</li>    
		       <li class="li-3" key="1" style="width:24.3%;margin:0 0 0 0;"> 
			    <div class="case_pad"> 
				<a href="<?php echo ($html_path_pc); ?>anli/<?php echo ($shejishis['s3']['p6']["aid"]); ?>.html" target="_blank">  
				    <div style="display:inline-block;height: 100%;width:100%;"> 
					<img src="<?php echo ($shejishis['s3']['p6']["home_cover_sheji_pic"]); ?>" alt="点石定制家装" width="100%" height="100%"/>   
				    </div> 
				    <?php if($shejishis['s3']['p6']['aid'] != ''): ?><div class="hid4">	 
					    </div>
					<div class="hid3">	
					    <span class="span1"><?php echo ($shejishis['s3']['p6']["atitle"]); ?></span>&nbsp;|&nbsp;
					    <span class="span2"><?php echo ($shejishis['s3']['p6']["fenggename"]); ?></span>&nbsp;|&nbsp;
					    <span class="span3"><?php echo ($shejishis['s3']['p6']["mianji"]); ?>平米</span>
					</div><?php endif; ?>	
				</a> 
			    </div>
			</li>  
		</ul>
	    </div> 
	</div>
	<div class="shejishi6" style="width: 100%;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;height: 120px;display: inline-block;margin-bottom: 20px;">	
	     <div  style="width: 100%;  height: 30px;line-height: 30px;margin-top: 20px;  text-align: center; border: 0px solid #77918d; border-radius: 0px;">
		 <span class="shejishipage" onclick="main4_show('pre');" style="display: inline-block;margin-right: 10px;"><</span>
		 <ul style="">
		     <li><span class="div1 current" data="0"></span></li>	
		     <li><span class="div1" data="1"></span></li>	
		     <li><span class="div1" data="2"></span></li>
		 </ul>
		 <span class="shejishipage" onclick="main4_show('next');" style="display: inline-block;margin-left: 10px;">></span>
	     </div>	 
	</div>  
    </div>
</div>
 
<div style="width:100%;height: auto; background:#f5f6f6;">  
    <div id="main5" style="width:1210px;height: auto;margin: 0 auto;display:none;"> 
	  <div id="loupan0" class="case" style="text-align:center; height: 45px; padding-top: 0px;">  
	</div> 
	<div id="loupan1" class="case" style="margin-left:0%;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;width: 1200px;margin-left: 5px;display: inline-block;"> 
	    <div class="list_title" style="display: inline-block; float: left;text-align: left;">热装楼盘</div>
	    <div class="list_title1" style="display: inline-block;float: left;position: relative;"><p>Hot Pack</p></div>
	    <div class="case_tyle" style="width: 30%;display: inline-block;">
		&nbsp;
	    </div>
	    <a href="/index.php/home/rzlp/" style="text-decoration:none;">
		<div class="list_more" style="width: 80px;display: inline-block; float: right; text-align: right; padding-right: 5px;">更多 >></div>
	    </a>
	    <hr class="list_hr" style="width: 99.5%;border-bottom: solid 1px #dcdcdc;"></hr>
	</div>  

	<div id="loupan5" class="case" style="margin-top: 30px;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;display: inline-block;width: 100%;"> 
	    <div class="loupan_list">
		<ul class="ul_loupan_index ull01" style="display:block;">
		    <!--<img src="/Public/home/Public/home/images/loupan_sd.jpg" alt="[field:title/]" width="100%"/></a>-->		
			<?php if(is_array($rzlp1)): $i = 0; $__LIST__ = $rzlp1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r1): $mod = ($i % 2 );++$i;?><li key="<?php echo ($r1["id"]); ?>"> 
				<div style="width:100%;height:100%;overflow: hidden;z-index:2000;">
				    <?php if($r1['id'] != ''): ?><a href="/index.php/home/rzlp/detail/aid/<?php echo ($r1["id"]); ?>" target="_blank" style="">  
					<?php else: ?>
					<a href="/index.php/home/rzlp/" target="_blank" style=""><?php endif; ?>
					<img src="<?php echo ($r1["picpath"]); ?>" alt="<?php echo ($r1["title"]); ?>" width="100%" height="100%"/>
					<div class="hid3 hid" style="display:block;"></div> 	
					<div class="hid2 hid" style="display:block;"> 
						<p class="p0">&nbsp;</p>
						<p class="p1"><?php echo ($r1["dtitle"]); ?></p>
						<p class="p2">已服务<?php echo ($r1["custnum"]); ?>户</p>
						<p class="p3"><div class="div3">了解更多</div></p> 
					</div> 	
				   </a> 
				</div>
			    </li><?php endforeach; endif; else: echo "" ;endif; ?> 
		</ul>  
		<ul class="ul_loupan_index ull02" style="display:none;">
		    <!--<img src="/Public/home/Public/home/images/loupan_sd.jpg" alt="[field:title/]" width="100%"/></a>-->		
			<?php if(is_array($rzlp2)): $i = 0; $__LIST__ = $rzlp2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r2): $mod = ($i % 2 );++$i;?><li key="<?php echo ($r2["id"]); ?>"> 
				<div style="width:100%;height:100%;overflow: hidden;z-index:2000;">
				    <?php if($r2['id'] != ''): ?><a href="/index.php/home/rzlp/detail/aid/<?php echo ($r2["id"]); ?>" target="_blank" style="">  
					<?php else: ?>
					<a href="/index.php/home/rzlp/" target="_blank" style=""><?php endif; ?>
					<img src="<?php echo ($r2["picpath"]); ?>" alt="<?php echo ($r2["title"]); ?>" width="100%" height="100%"/>
					<div class="hid3 hid" style="display:block;"></div> 	
					<div class="hid2 hid" style="display:block;"> 
						<p class="p0">&nbsp;</p>
						<p class="p1"><?php echo ($r2["dtitle"]); ?></p>
						<p class="p2">已服务<?php echo ($r2["custnum"]); ?>户</p>
						<p class="p3"><div class="div3">了解更多</div></p> 
					</div> 	
				   </a> 
				</div>
			    </li><?php endforeach; endif; else: echo "" ;endif; ?> 
		</ul>  
		<ul class="ul_loupan_index ull03" style="display:none;">
		    <!--<img src="/Public/home/Public/home/images/loupan_sd.jpg" alt="[field:title/]" width="100%"/></a>-->		
			<?php if(is_array($rzlp3)): $i = 0; $__LIST__ = $rzlp3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r3): $mod = ($i % 2 );++$i;?><li key="<?php echo ($r3["id"]); ?>"> 
				<div style="width:100%;height:100%;overflow: hidden;z-index:2000;">
				    <?php if($r3['id'] != ''): ?><a href="/index.php/home/rzlp/detail/aid/<?php echo ($r3["id"]); ?>" target="_blank" style="">  
					<?php else: ?>
					<a href="/index.php/home/rzlp/" target="_blank" style=""><?php endif; ?>
					<img src="<?php echo ($r3["picpath"]); ?>" alt="<?php echo ($r3["title"]); ?>" width="100%" height="100%"/>
					<div class="hid3 hid" style="display:block;"></div> 	
					<div class="hid2 hid" style="display:block;"> 
						<p class="p0">&nbsp;</p>
						<p class="p1"><?php echo ($r3["dtitle"]); ?></p>
						<p class="p2">已服务<?php echo ($r3["custnum"]); ?>户</p>
						<p class="p3"><div class="div3">了解更多</div></p> 
					</div> 	
				   </a> 
				</div>
			    </li><?php endforeach; endif; else: echo "" ;endif; ?> 
		</ul>  
	    </div> 
	</div> 
	<div class="loupan6" style="width: 100%;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;height: 120px;display: inline-block;margin-bottom: 20px;">	
	     <div  style="width: 100%;  height: 30px;line-height: 30px;margin-top: 20px;  text-align: center; border: 0px solid #77918d; border-radius: 0px;">
		 <span class="loupanpage" onclick="main5_show('pre');" style="display: inline-block;margin-right: 10px;"><</span>
		 <ul style="">
		     <li><span class="div1 current" data="0"></span></li>	
		     <li><span class="div1" data="1"></span></li>	
		     <li><span class="div1" data="2"></span></li>
		 </ul>
		 <span class="loupanpage" onclick="main5_show('next');" style="display: inline-block;margin-left: 10px;">></span>
	     </div>	 
	</div>  
    </div> 
    
    <div id="main6" style="width:1220px;height: auto;margin: 0 auto;padding-top: 30px; background-color: #f5f6f6;"> 
	<div id="liucheng1" class="case" style="margin-left: 0%;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;width: 1200px;display: inline-block;margin-left: 10px;"> 
	    <div class="list_title" style="display: inline-block; float: left;text-align: left;">装修流程</div>
	    <div class="list_title1" style="display: inline-block;float: left;position: relative;width: 280px;"><p>Decoration process</p></div>
	    <div class="case_tyle" style="width: 30%;display: inline-block;">
		&nbsp;
	    </div>
	    <a href="/q/" target="_blank" style="text-decoration:none;">
		<div class="list_more" style="width: 80px;display: inline-block; float: right; text-align: right; padding-right: 5px;">更多 >></div>
	    </a>
	    <hr class="list_hr" style="width: 99.5%;border-bottom: solid 1px #dcdcdc;"></hr>
	</div> 
	 <div id="cont6" class="case" style="margin: 30px 0 2% 0%;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;display: inline-block;width:100%;"> 
	     <div class="wh div1"><a href="javascript:void(0);" style="text-decoration:none;"></a> 
		 <div class="jindu_f" style="">
		    <p class="p1">
			 <div class="icon icon-green radius icon-list-fun">
			   <i style="" class="aui-iconfont iconfont">&#xe645;</i></div>
		    </p>
		    <p class="p2">咨询阶段</p> 
		 </div>
		<div class="jindu_r" style=""><img src="/Public/home/images/logoright.png" style=""></div>
	    </div>
	    <div class="wh div2"><a href="javascript:void(0);" style="text-decoration:none;"></a>
		  <div class="jindu_f" style="">
		<p class="p1">
		     <div class="icon icon-green radius icon-list-fun">
		       <i style="" class="aui-iconfont iconfont">&#xe612;</i></div>
		</p>
		<p class="p2">签订设计协议</p> 
		 </div>
		<div class="jindu_r" style=""><img src="/Public/home/images/logoright.png" style=""></div>
		</div>
	    <div class="wh div3"><a href="javascript:void(0);" style="text-decoration:none;"></a>
		  <div class="jindu_f" style="">
		<p class="p1">
		     <div class="icon icon-green radius icon-list-fun">
		       <i style="" class="aui-iconfont iconfont">&#xe646;</i></div>
		</p>
		<p class="p2">预算方案</p> 
		 </div>
		<div class="jindu_r" style=""><img src="/Public/home/images/logoright.png" style=""></div>
		</div>
	    <div class="wh div4"><a href="javascript:void(0);" style="text-decoration:none;"></a>
		  <div class="jindu_f" style="">
		<p class="p1">
		     <div class="icon icon-green radius icon-list-fun">
		       <i style="" class="aui-iconfont iconfont">&#xe613;</i></div>
		</p>
		<p class="p2">签约施工</p> 
		 </div>
		<div class="jindu_r" style=""><img src="/Public/home/images/logoright.png" style=""></div>
		</div>	 
	    <div class="wh div5"><a href="javascript:void(0);" style="text-decoration:none;"></a>
		  <div class="jindu_f" style="">
		<p class="p1">
		     <div class="icon icon-green radius icon-list-fun">
		       <i style="" class="aui-iconfont iconfont">&#xe617;</i></div>
		</p>
		<p class="p2">验收结算</p> 
		 </div>
		<div class="jindu_r" style=""><img src="/Public/home/images/logoright.png" style=""></div>
		</div>	 
	    <div class="wh div6"><a href="javascript:void(0);" style="text-decoration:none;"></a>
		  <div class="jindu_f" style="">
		<p class="p1">
		     <div class="icon icon-green radius icon-list-fun">
		       <i style="" class="aui-iconfont iconfont">&#xe610;</i></div>
		</p>
		<p class="p2">环保监测</p> 
		 </div>
		<div class="jindu_r" style=""><img src="/Public/home/images/logoright.png" style=""></div>
		</div>	 
	    <div class="wh div7"><a href="javascript:void(0);" style="text-decoration:none;"></a>
		  <div class="jindu_f" style="">
		<p class="p1">
		     <div class="icon icon-green radius icon-list-fun">
		       <i style="" class="aui-iconfont iconfont">&#xe664;</i></div>
		</p>
		<p class="p2">售后服务</p> 
		 </div> 
		</div>	 
	</div>
	<script> 
	</script>
    </div>  

    <div id="main7" style="width:1200px;height: auto;margin: 0 auto;"> 
	<div id="news0" class="case" style="text-align:center; height: 45px; padding-top: 0px;">  
	</div>
	<div id="news1" class="case" style="margin-left: 0%;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;width: 100%;display: inline-block;"> 
	    <div class="list_title" style="display: inline-block; float: left;text-align: left;">装修攻略</div>
	    <div class="list_title1" style="display: inline-block;float: left;position: relative;width: 280px;"><p>Decoration Raiders</p></div>
	    <div class="case_tyle" style="width: 30%;display: inline-block;">
		&nbsp;
	    </div>
	    <a href="/index.php/home/article/index/ftype/5" target="_blank" style="text-decoration:none;">
		<div class="list_more" style="width: 80px;display: inline-block; float: right; text-align: right; padding-right: 5px;">更多 >></div>
	    </a>
	    <hr class="list_hr" style="width: 99.5%;border-bottom: solid 1px #dcdcdc;"></hr>
	</div> 


	<div id="news5" class="case" style="margin: 30px 0 0 0%;text-align:center; font-size: 14px;color: #3b3a3b;font-family: 微软雅黑;line-height: 40px;width: 100%;display: inline-block;"> 
	    <div class="news_list">
		<ul class="ul_news_index2"> 
			<li class="li-1" key="1" style="width:32.7%;margin:0 1.5% 0 0%;"> 
			    <div class="li-1-div1 case_pad" style="height:52%;display:inline-block;float: left;">
				<div class="div_img" style="display:inline-block;width:100%;height: 100%;">
				    <img src="/Public/home/images/news/gl01.png" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
				</div>
			    </div>    
			    <div class="li-1-div2 case_pad" style="display:inline-block;float: left;background: #fff;margin-top: 12px;">
				<div class="div_img" style="display:inline-block;height: 90%;width: 100%;text-align: left;">
				    <div class="" style="">
					<div style="width:33%;display: inline-block;float: left;margin-top: 3%;">
					    <img src="/Public/home/images/news/news4_0.png" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					</div>
					<div style="margin-left: 2%;width:65%;display: inline-block;">
					    <a href="/index.php/home/article/index/ftype/4" target="_blank" style="text-decoration:none;">
						<div class="news_title" style="">
						   新闻动态
					       </div>
					    </a>
					    <ul class="ul_news_list">
						 <?php if(is_array($lists_news1)): $i = 0; $__LIST__ = $lists_news1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n1): $mod = ($i % 2 );++$i;?><li key='<?php echo ($n1["id"]); ?>' style="width:96%;">  
						      <a href="<?php echo ($html_path_pc); ?>article/<?php echo ($n1["id"]); ?>.html" target="_blank" title="<?php echo ($n1["title"]); ?>" style="">
							  <div class="news_r1" style="width:100%;"> 
							      <span style="font-weight: 600;">·</span>
							      <span class="span1" style="height:30px;font-size: 16px; font-family: 微软雅黑;"> 
								    <?php echo ($n1["dtitle"]); ?>
							      </span> 
							  </div>
							  <div class="news_r2" style="display: none;"><?php echo (date('m-d',$n1["create_time"])); ?> </div>
						      </a>
						  </li><?php endforeach; endif; else: echo "" ;endif; ?> 
					     </ul>		
					</div>
				    </div>    
				</div> 
			    </div>  
			</li>   
			<li class="li-2" key="1" style="width:32.7%;margin:0 1.5% 0 0%;"> 
			    <div class="li-2-div1 case_pad" style="height:52%;display:inline-block;float: left;overflow: hidden;background: #fff;">
				<div class="div_img" style="display:inline-block;width:100%;height: 70%;">
				     <div class="main_title" style="font-size:22px;font-weight: 600;color:#333333;overflow: hidden;  -webkit-line-clamp: 2; text-overflow: ellipsis;display: -webkit-box;-webkit-box-orient: vertical;text-align: left;    padding: 1% 4%;">
				      <?php echo ($news_tj["title"]); ?>
				     </div>
				    <div class="mian_cont" style="margin: 2px 0 7px 0;font-size: 14px;line-height: 22px; color:#a0a0a0; overflow: hidden;  -webkit-line-clamp: 3; text-overflow: ellipsis;display: -webkit-box;-webkit-box-orient: vertical; padding: 0% 3%;">
					<?php echo ($news_tj["description"]); ?>
				    </div>
				</div>
				<div class="div_main" style="margin-top: 5px;display:inline-block;width: 100%;">
				    <a href="<?php echo ($html_path_pc); ?>article/<?php echo ($news_tj["id"]); ?>.html" target="_blank">
					<div class="div1" style="">查看详情 ></div></a>&nbsp;&nbsp;
				    <a href="/q/" target="_blank"><div class="div2" style="">立即咨询></div></a>
				</div>
			    </div>    
			    <div class="li-2-div2 case_pad" style="display:inline-block;float: left;background: #fff;margin-top: 12px;">
				<div class="div_img" style="display:inline-block;height: 90%;width: 100%;text-align: left;">
				    <div class="" style="">
					<div style="width:33%;display: inline-block;float: left;margin-top: 3%;">
					    <img src="/Public/home/images/news/news6_0.png" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
					</div>
					<div style="margin-left: 2%;width:65%;display: inline-block;">
					    <a href="/index.php/home/article/index/ftype/6" target="_blank" style="text-decoration:none;">
						<div class="news_title" style="">
						   工地报道
					       </div>
					    </a>
					    <ul class="ul_news_list">
						 <?php if(is_array($lists_news2)): $i = 0; $__LIST__ = $lists_news2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n2): $mod = ($i % 2 );++$i;?><li key='<?php echo ($n2["id"]); ?>' style="width:96%;">  
						      <a href="<?php echo ($html_path_pc); ?>article/<?php echo ($n2["id"]); ?>.html" target="_blank" title="<?php echo ($n2["title"]); ?>" style="">
							  <div class="news_r1" style="width:100%;"> 
							      <span style="font-weight: 600;">·</span>
							      <span class="span1" style="height:30px;font-size: 16px; font-family: 微软雅黑;">  
								   <?php echo ($n2["dtitle"]); ?>
							      </span> 
							  </div>
							  <div class="news_r2" style="display:none;"><?php echo (date('m-d',$n2["create_time"])); ?> </div>
						      </a>
						  </li><?php endforeach; endif; else: echo "" ;endif; ?> 
					     </ul>		
					</div>
				    </div>    
				</div> 
			    </div>
			</li>  
		    <style>
			.ul_news_list a div{color:#434242;}
			.ul_news_list a:hover div{color:red;}
		    </style>
			<li class="li-3" key="2" style="width:31.5%;margin:0 0% 0 0;">  
			    <div class="li-1-div1 case_pad" style="height:47.8%;display:inline-block;float: left;background: #fff;">
				<div class="div_img" style="display:inline-block;width: 90%; height: 90%;  margin: 3% 5%;">
				    <img src="/Public/home/images/news/news5_0.png" alt="点石定制家装 装修案例" width="100%" height="100%"/>  
				</div>
			    </div>    
			    <div class="li-3-div11 case_pad" style="height:100%;display:inline-block;float: left;background: #fff;"> 
				  <div class="div_img" style="display:inline-block;height: 100%;width: 90%; text-align: left;">
				    <a href="/index.php/home/article/index/ftype/5" target="_blank" style="text-decoration:none;">
					<div class="news_title" style="">
					   装修知识
				       </div>
				    </a> 
				       <ul class="ul_news_list">
					    <?php if(is_array($lists_news3)): $i = 0; $__LIST__ = $lists_news3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n3): $mod = ($i % 2 );++$i;?><li key='<?php echo ($n3["id"]); ?>' style="width:96%;">  
						 <a href="<?php echo ($html_path_pc); ?>article/<?php echo ($n3["id"]); ?>.html" target="_blank" title="<?php echo ($n3["title"]); ?>" style="">
						     <div class="news_r1" style="width:100%;"> 
							 <span style="font-weight: 600;">·</span>
							 <span class="span1" style="height:30px;font-size: 16px; font-family: 微软雅黑;"> 
							     <?php echo ($n3["dtitle"]); ?>
							 </span> 
						     </div>
						     <div class="news_r2" style="display:none;"><?php echo (date('m-d',$n3["create_time"])); ?> </div>
						 </a>
					     </li><?php endforeach; endif; else: echo "" ;endif; ?> 
					</ul>
				  </div>	 
			    </div>	 
			</li>  
		</ul>
	    </div>
	</div>
    </div>    
</div>
    
<?php include ("./Application/Home/View/default/Common/bottomnav.html"); ?> 
<?php include ("./Application/Home/View/default/Common/footer.html"); ?> 
     
</body>
</html>   

<script type="text/javascript">
$(function(){
});
</script> 
<script src="/public/home/js/count.js" type="text/javascript"></script> 
<script src="/public/home/js/footer.js" type="text/javascript"></script>