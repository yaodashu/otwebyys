
$(function (){
    var banner1_html= ' <div id="banner1">';
        banner1_html += ' <ul>';
	banner1_html += ' <li><div class="case_pad"><a href="/" target="_blank"><img src="/public/home/images/banner/banner02.jpg" width="100%" /></a></div></li> ';
	banner1_html += ' </ul>';
	banner1_html += '</div> ';
    $('#div_banner1').html(banner1_html);
    
    do_banner1();
})

/*0 banner1*/
function do_banner1(){  
    //此类型设计师的图层显示介绍文字 
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