
var regex_number=/^\d{7}$|^\d{8}$|^\d{11}$|^\d{3}(-)?\d{8}$|^\d{4}(-)?\d{7,8}$/;
function do_calltel(){
    //alert("inital calltel");
    $("#call_btn").click(function(){ 
        var obj=$(this);
        var calltel_tel=$("#calltel1_keyword");
        var val_calltel_tel=$.trim(calltel_tel.val());
        if(!regex_number.test(val_calltel_tel)){
            alert("温馨提示：联系电话格式不正确！");
            calltel_tel.focus();
            calltel_tel.select();
           return false;
        }
        var val_calltel_name=encodeURIComponent("");
        val_calltel_tel=encodeURIComponent(val_calltel_tel);
        var val_calltel_content=encodeURIComponent("[来源页面："+document.title+"]");
        var url=encodeURIComponent(location.href);
        var sourceid=obj.attr("sourceid");
        if(!sourceid){sourceid=1;}
        window.open("http://i.dasn.com.cn/index.php/calltel/dooperate?name="+val_calltel_name+"&tel="+val_calltel_tel+"&content="+val_calltel_content+"&url="+url+"&sourceid="+sourceid);
        calltel_tel.val("");
        return false;
    });
}

function do_p_article_anli_old(){
    var imgs = document.getElementById('anliimgs');
    var wdth= imgs.clientWidth;
//    alert(wdth);
    var margin_left = (wdth-960)/2;
    $("#anliimgs").css("margin-left",margin_left);
    
    $(".anlidetail .style13,.anlidetail .style14").fadeTo(0,0.8);
    var div1=$("#anliimgs .div1");
    var div2=$("#anliimgs .div2");
    var div3=$("#anliimgs .div3");
    var div4=$("#anliimgs .div4");
    var div5=$("#anliimgs .div5");
    var div6=$("#anliimgs .div6");
    var div7=$("#anliimgs .div7");
	div5.fadeTo(0,0.8);
	div6.fadeTo(0,0.8);
    div2.append('<a href="javascript:void(0);">&lt;</a>');
    div3.append('<a href="javascript:void(0);">&gt;</a>');
    div4.append("<ul></ul>");
    var div1img=div1.find("img");
    var div4ul=div4.find("ul");
    $.each(list_simg,function(idx){div4ul.append('<li><p>'+(idx+1)+'/'+list_simg.length+'</p><img src="'+list_bimg[idx]+'" width="137" height="100" /></li>');});
    var div4li=div4ul.find("li");
    div4li.click(function(){
        var idx=$(this).index();
		div7.fadeTo(0,0.5).html('<a href="'+$(this).find("img").attr("src")+'" target="_blank">查看原图</a>');
        var oldidx=div4li.filter(".current").index();
        if(idx==oldidx){return false;}
        div1img.attr("src",list_bimg[idx]);
        div4li.removeClass("current").eq(idx).addClass("current");
        var marginleft=parseInt(div4ul.css("marginLeft").replace("px",""));
        marginleft=oldidx>idx?marginleft+145:marginleft-145;
        var max=0;
        var min=div4li.length>6?0-(div4li.length-6)*145:0;
        if(oldidx==0&&idx==div4li.length-1){marginleft=min;}
        if(oldidx==div4li.length-1&&idx==0){marginleft=max;}
        marginleft=marginleft>max?max:marginleft;
        marginleft=marginleft<min?min:marginleft;
        div4ul.animate({marginLeft:marginleft},0);
        return false;
    }).eq(0).addClass("current").click();
    div2.click(function(){var count=div4li.length;var idx=div4li.filter(".current").index();idx=--idx<0?count-1:idx;div4li.eq(idx).click();return false;});
    div3.click(function(){var count=div4li.length;var idx=div4li.filter(".current").index();idx=++idx>count-1?0:idx;div4li.eq(idx).click();return false;});
    div5.hover(function(){$(this).addClass("div5hover");div7.hide();},function(){$(this).removeClass("div5hover");div7.fadeTo(0,0.5);}).click(function(){div2.click()});
    div6.hover(function(){$(this).addClass("div6hover");div7.hide();},function(){$(this).removeClass("div6hover");div7.fadeTo(0,0.5);}).click(function(){div3.click()});
}

function do_p_article_anli(){ 
    //获取图片展示的对象元素
    var imgs = document.getElementById('anliimgs');    
    var wdth= imgs.clientWidth;
    var hgth= imgs.clientHeight;//图像上级div高度
    //调整图像,原图像大小533*400,图像按上级div等比例放大
    var imgh = (wdth/533)*400;
    if(hgth<imgh){
	if(imgh>wdth){
	    imgh = wdth;    //设置图片高度不超过宽度
	}
	hgth=imgh;
	$("#anliimgs").css("height",imgh); //从新设置图像上级div高度
    } 
    $("#anliimgs").css("margin-bottom",110); //从新设置图像上级div高度
    //从新设置图像高宽
    $("#anliimgs .div1 img").css("max-width",wdth);
    $("#anliimgs .div1 img").css("max-height",imgh);   
    
//    alert(wdth);
//    alert(hgth);
    var margin_left = 0 ;// (wdth-960)/2;
    $("#anliimgs").css("margin-left",margin_left);
    
    $(".anlidetail .style13,.anlidetail .style14").fadeTo(0,0.8);
    var div1=$("#anliimgs .div1");
    var div2=$("#anliimgs .div2");
    var div3=$("#anliimgs .div3");
    var div4=$("#anliimgs .div4");
    var div5=$("#anliimgs .div5");//前一页
    var div6=$("#anliimgs .div6");//下一页
    var div7=$("#anliimgs .div7");//查看原图
    
    
    //设置左右翻页高度 
	//alert(div1.css("width").replace("px",""));
    $(".p_article_anli .ftitle").css("width",div1.css("width").replace("px",""));
    div5.css("height",hgth);
    div6.css("height",hgth);
    div2.css("margin-top",hgth+10);
    div3.css("margin-top",hgth+10);
    div4.css("margin-top",hgth+10);
    
	div5.fadeTo(0,0.8);
	div6.fadeTo(0,0.8);
    div2.append('<a href="javascript:void(0);">&lt;</a>');
    div3.append('<a href="javascript:void(0);">&gt;</a>');
    div4.append("<ul></ul>");
    var div1img=div1.find("img");
    var div4ul=div4.find("ul");
    $.each(list_simg,function(idx){div4ul.append('<li><p>'+(idx+1)+'/'+list_simg.length+'</p><img src="'+list_bimg[idx]+'" width="137" height="100" /></li>');});
    var div4li=div4ul.find("li");
    div4li.click(function(){
        var idx=$(this).index();
		div7.fadeTo(0,0.5).html('<a href="'+$(this).find("img").attr("src")+'" target="_blank">查看原图</a>');
        var oldidx=div4li.filter(".current").index();
        if(idx==oldidx){return false;}
        div1img.attr("src",list_bimg[idx]);
        div4li.removeClass("current").eq(idx).addClass("current");
        var marginleft=parseInt(div4ul.css("marginLeft").replace("px",""));
        marginleft=oldidx>idx?marginleft+145:marginleft-145;
        var max=0;
        var min=div4li.length>6?0-(div4li.length-6)*145:0;
        if(oldidx==0&&idx==div4li.length-1){marginleft=min;}
        if(oldidx==div4li.length-1&&idx==0){marginleft=max;}
        marginleft=marginleft>max?max:marginleft;
        marginleft=marginleft<min?min:marginleft;
        div4ul.animate({marginLeft:marginleft},0);
        return false;
    }).eq(0).addClass("current").click();
    div2.click(function(){var count=div4li.length;var idx=div4li.filter(".current").index();idx=--idx<0?count-1:idx;div4li.eq(idx).click();return false;});
    div3.click(function(){var count=div4li.length;var idx=div4li.filter(".current").index();idx=++idx>count-1?0:idx;div4li.eq(idx).click();return false;});
    div5.hover(function(){$(this).addClass("div5hover");div7.hide();},function(){$(this).removeClass("div5hover");div7.fadeTo(0,0.5);}).click(function(){div2.click()});
    div6.hover(function(){$(this).addClass("div6hover");div7.hide();},function(){$(this).removeClass("div6hover");div7.fadeTo(0,0.5);}).click(function(){div3.click()});
    
}



$(function(){
     //初始化公共脚本
      if($("#call_btn")[0]){do_calltel();}
     
    
	//图标隐藏菜单
	$(".entrance").hover(function(){
		$(this).children(".user-menu").show();
	},function(){
		$(this).children(".user-menu").hide();
	});

	$('.action .detailed').each(function(){
		$(this).click(function() {
        	detailed_content();
        	return false;
        });
  	});

	$('.action .thinkbox-image').each(function(){
		$(this).click(function() {
        	thinkbox_image();
        	return false;
        });
  	});

	(function(){
		var $nav = $("#nav"), $current = $nav.children("[data-key=" + $nav.data("key") + "]");
		if($nav.length){
			$current.addClass("current");
		} else {
			$("#nav").children().first().addClass("current");
		}
	})();
	 
});
