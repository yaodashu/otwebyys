
$(function(){
    return;
    //调用统计方法
    var url=location.href;
    var domain=document.domain;
    var u = navigator.userAgent;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
    var isIOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端 
    var isPC = false;
    if(isAndroid){
	isAndroid=1;
	isIOS=0;
	isPC=0;
    }else if(isIOS){
	isAndroid=0;
	isIOS=1;
	isPC=0;
    }else if(!isAndroid && !isIOS){
	isAndroid=0;
	isIOS=0;
	isPC =1;
    } 
//    alert("调用统计，域名:"+domain+",url:"+url);
    if(domain!=""){
	var ajaxUrl ="http://"+domain+"/index.php/home/count/browser/"; 
//	 alert("调用统计，域名:"+domain+",url:"+ajaxUrl);
	 $.ajax({url:ajaxUrl,
		type : 'POST',
		dataType : "json",
		cache:false,
		data : {
			'isAndroid' : isAndroid,
			'isIOS' : isIOS,
			'isPC' : isPC,
			'aurl':url
		},
		success:function(result){  
		    if(result.code=='0' && result.msg=="ok"){ 
			//   alert(result.param);
		    }else{
			//   alert(result.msg);
		    }
	    }});
    }

});