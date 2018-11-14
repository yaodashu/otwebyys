if(location.href.indexOf("com")>=0){
	//alert("website");
	document.writeln("<script src=\"http:\/\/i.dasn.com.cn\/public\/website\/mdasn.js\" charset=\"utf-8\" type=\"text\/javascript\"><\/script>");
}
function initviewport(){
	var viewport=document.getElementById("viewport");
	if(viewport){
		viewport.content="width=480,initial-scale="+screen.width/480+",max-scale="+screen.width/480+",user-scalable=0";
	}
}
initviewport();

var regex_number=/^\d{7}$|^\d{8}$|^\d{11}$|^\d{3}(-)?\d{8}$|^\d{4}(-)?\d{7,8}$/;
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

if(location.href.indexOf("v.hnyphz.com")>=0){document.writeln("<div style=\"height:0;overflow:hidden;display:none;\"><script src=\"http:\/\/s4.cnzz.com\/stat.php?id=1261440941&web_id=1261440941\" language=\"JavaScript\"><\/script><\/div>");}
else{document.writeln("<div style=\"height:0;overflow:hidden;display:none;\"><script src=\"http:\/\/s4.cnzz.com\/stat.php?id=1261415824&web_id=1261415824\" language=\"JavaScript\"><\/script><\/div>");}

var swiperlist,swiperitems,swiperidx,swipersrc;
$(function(){
//	$(".swiperlist li").click(function(){
//		swiperitems=[];
//		$(this).parent('ul').find('li').each(function(){swiperitems.push($(this).attr('src'));});
//		swiperidx=$(this).index();
//		swiperlist=$.photoBrowser({items:swiperitems,initIndex:swiperidx});
//		swiperlist.open();
//	});
});
$(function(){ 
    do_the_gb();
})




