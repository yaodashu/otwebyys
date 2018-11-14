$.extend({getUrlVars: function(){var vars = [], hash;var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');for(var i = 0; i < hashes.length; i++){hash = hashes[i].split('=');vars.push(hash[0]);vars[hash[0]] = hash[1];}return vars;},getUrlVar: function(name){var val=$.getUrlVars()[name];return val==undefined?"":val;}});

(function($){
    $.fn.unselectable=function() {
        this.each(function(){
            this.onselectstart=function(){return false;};
            this.unselectable='on';
            this.style.MozUserSelect='none';
			this.ondragstart=function(){return false;};
        });
    };
})(jQuery);

//function initviewport(){
//	if(screen.width==0){return;}
//	var metaviewport=document.getElementById("metaviewport");
//	var targetdensitydpi=128;
//	switch(screen.width){
//	    case 480:targetdensitydpi=160;break;
//	    case 640:targetdensitydpi=128;break;
//	    case 800:targetdensitydpi=128;break;
//	    case 1280:targetdensitydpi=80;break;
//	}
//	if(metaviewport){if(screen.width>320){metaviewport.content="width=320,target-densitydpi="+targetdensitydpi+",user-scalable=no";
//		$("#citysdz").css("min-width","80px");
//		$("#citysdz").css("height","54px");
//		$("#citysdz").css("line-height","54px");
//	    }}
//}
//initviewport();

var regex_number=/^\d{7}$|^\d{8}$|^\d{11}$|^\d{3}(-)?\d{8}$|^\d{4}(-)?\d{7,8}$/;

function getElementsByClassName(className) {
    var all=document.all?document.all:document.getElementsByTagName('*');
    var elements=new Array();
    for(var e=0;e<all.length;e++){if(all[e].className==className){all[e].setAttribute("keyno",elements.length);elements[elements.length]=all[e];}}
    return elements;
}

function do_the_img(){
	//var max_w=window.screen.width;
	var max_w=308;
	var images=document.getElementsByTagName("img");
	for(var i=0;i<images.length;i++){
		if(images[i].getAttribute("zoom")!="0"&&images[i].width!=320&&images[i].width>max_w){
			images[i].style.height=images[i].height*max_w/images[i].width+"px";
			images[i].style.width="308px";
		}
	}
}

function do_the_gb(){
    var m_gb_submit=getElementsByClassName("m_gb_submit");
    var m_gb_name=getElementsByClassName("m_gb_name");
    var m_gb_tel=getElementsByClassName("m_gb_tel");
    var m_gb_content=getElementsByClassName("m_gb_content");
    for(var i=0;i<m_gb_submit.length;i++){
m_gb_submit[i].onclick=function(){
var obj=this;
var keyno=obj.getAttribute("keyno");
var name=m_gb_name[keyno];
var val_name=name.value;
if(val_name.length<1){alert("温馨提示：请输入您的称呼！");name.focus();name.select();return false;}
var tel=m_gb_tel[keyno];
var val_tel=tel.value;
if(!regex_number.test(val_tel)){alert("温馨提示：联系电话格式不正确！");tel.focus();tel.select();return false;}
var content=m_gb_content[keyno];
var val_content=content.value;
val_name=encodeURIComponent(val_name);
val_tel=encodeURIComponent(val_tel);
val_content=encodeURIComponent(val_content+"<br />[来源页面："+document.title+"]");
var url=encodeURIComponent(location.href);
var sourceid=obj.getAttribute("sourceid");
if(!sourceid){sourceid=1;}
window.open("http://i.dasn.com.cn/index.php/calltel/dooperate?name="+val_name+"&tel="+val_tel+"&content="+val_content+"&url="+url+"&sourceid="+sourceid);
name.value="";
tel.value="";
content.value="";
return false;
        }
    }
}

function do_the_header() {$("#header .div4").click(function(){$("#nav").toggle();});}

function do_the_gototop(){
    $("#gototop,#inav ul li:eq(2) a").click(function(){window.scrollTo(0,0);return false;});
}

function do_the_search(){
    var searchsubmit=document.getElementById("searchsubmit");
    var searchinput=document.getElementById("searchinput");
    if(searchsubmit){searchsubmit.onclick=function(){if(searchinput.value=="搜索 > 开启首席大宅装修之旅"||searchinput.value=="搜索 &gt; 开启首席大宅装修之旅"){searchinput.focus();return false;}return true;}}
}


function do_the_flexslider(){
    if($("#anliimgs")[0]){$("#anliimgs ul.slides").html("");$.each(list_bimg,function(i){$("#anliimgs ul.slides").append('<li><img src="http://yatai.dasn.com.cn'+list_bimg[i]+'" alt="" /></li>');});}
	$(".flexslider").flexslider({animation: "slide",animationLoop: false,itemWidth: 320});
}

window.onload=function(){
	setTimeout("initviewport()",1000);
	do_the_img();
	do_the_gb();
	do_the_gototop();
	do_the_search();
	do_the_header();
	if($(".flexslider")[0]){do_the_flexslider();}
}

if(location.href.indexOf("com")>=0){
document.writeln("<div style=\"height:0;overflow:hidden;display:none;\"><script src=\"http:\/\/v1.cnzz.com\/stat.php?id=5892954&web_id=5892954\" language=\"JavaScript\"><\/script><script type=\"text\/javascript\">var _bdhmProtocol = ((\"https:\" == document.location.protocol) ? \" https:\/\/\" : \" http:\/\/\");document.write(unescape(\"%3Cscript src=\'\" + _bdhmProtocol + \"hm.baidu.com\/h.js%3Fc6b778127b60c5f182b84f33cc73d623\' type=\'text\/javascript\'%3E%3C\/script%3E\"));<\/script><\/div>");
}