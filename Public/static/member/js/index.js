/*
 * Lazy Load - jQuery plugin for lazy loading images
 *
 * Copyright (c) 2007-2012 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   http://www.appelsiini.net/projects/lazyload
 *
 * Version:  1.8.3
 *
 */

define("wannaBuy/sweetCountdown",[],function(){function e(e){var n=e.endTime-e.nowTime,r=setInterval(function(){n-=1e3,n<=0?(clearInterval(r),e.zeroCallback instanceof Function&&e.zeroCallback()):t(n,e.ctn,e.word,e.showDay)},1e3);t(n,e.ctn,e.word,e.showDay)}function t(e,t,r,i){e=Math.floor(e/1e3);var s=""+r.pre||"",o=Math.floor(e/3600),u="",a=0;i?(u=Math.floor(o/24),u>0&&(s+='<span class="down-day">'+u+(r.day||":")+"</span>"),a=o%24):a=o;var f=Math.floor((e-o*3600)/60),l=e-o*3600-f*60;s+='<span class="down-hour">'+a+(r.hour||":")+"</span>",s+='<span class="down-minute">'+n(f)+(r.minute||":")+"</span>",s+='<span class="down-second">'+n(l)+(r.second||":")+"</span>",s+=r.after||"",t.html(s)}function n(e){return e>=10?e:"0"+e}return{mini:e}}),function(e,t,n,r){var i=e(t);e.fn.lazyload=function(n){function s(){var t=0;o.each(function(){var n=e(this);if(f.skip_invisible&&!n.is(":visible"))return;if(!e.abovethetop(this,f)&&!e.leftofbegin(this,f))if(!e.belowthefold(this,f)&&!e.rightoffold(this,f))n.trigger("appear"),t=0;else if(++t>f.failure_limit)return!1})}var o=this,u,f={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:t,data_attribute:"original",skip_invisible:!0,appear:null,load:null};return n&&(r!==n.failurelimit&&(n.failure_limit=n.failurelimit,delete n.failurelimit),r!==n.effectspeed&&(n.effect_speed=n.effectspeed,delete n.effectspeed),e.extend(f,n)),u=f.container===r||f.container===t?i:e(f.container),0===f.event.indexOf("scroll")&&u.bind(f.event,function(e){return s()}),this.each(function(){var t=this,n=e(t);t.loaded=!1,n.one("appear",function(){if(!this.loaded){if(f.appear){var r=o.length;f.appear.call(t,r,f)}e("<img />").bind("load",function(){n.hide().attr("src",n.data(f.data_attribute))[f.effect](f.effect_speed),t.loaded=!0;var r=e.grep(o,function(e){return!e.loaded});o=e(r);if(f.load){var i=o.length;f.load.call(t,i,f)}}).attr("src",n.data(f.data_attribute))}}),0!==f.event.indexOf("scroll")&&n.bind(f.event,function(e){t.loaded||n.trigger("appear")})}),i.bind("resize",function(e){s()}),/iphone|ipod|ipad.*os 5/gi.test(navigator.appVersion)&&i.bind("pageshow",function(t){t.originalEvent.persisted&&o.each(function(){e(this).trigger("appear")})}),e(t).load(function(){s()}),this},e.belowthefold=function(n,s){var o;return s.container===r||s.container===t?o=i.height()+i.scrollTop():o=e(s.container).offset().top+e(s.container).height(),o<=e(n).offset().top-s.threshold},e.rightoffold=function(n,s){var o;return s.container===r||s.container===t?o=i.width()+i.scrollLeft():o=e(s.container).offset().left+e(s.container).width(),o<=e(n).offset().left-s.threshold},e.abovethetop=function(n,s){var o;return s.container===r||s.container===t?o=i.scrollTop():o=e(s.container).offset().top,o>=e(n).offset().top+s.threshold+e(n).height()},e.leftofbegin=function(n,s){var o;return s.container===r||s.container===t?o=i.scrollLeft():o=e(s.container).offset().left,o>=e(n).offset().left+s.threshold+e(n).width()},e.inviewport=function(t,n){return!e.rightoffold(t,n)&&!e.leftofbegin(t,n)&&!e.belowthefold(t,n)&&!e.abovethetop(t,n)},e.extend(e.expr[":"],{"below-the-fold":function(t){return e.belowthefold(t,{threshold:0})},"above-the-top":function(t){return!e.belowthefold(t,{threshold:0})},"right-of-screen":function(t){return e.rightoffold(t,{threshold:0})},"left-of-screen":function(t){return!e.rightoffold(t,{threshold:0})},"in-viewport":function(t){return e.inviewport(t,{threshold:0})},"above-the-fold":function(t){return!e.belowthefold(t,{threshold:0})},"right-of-fold":function(t){return e.rightoffold(t,{threshold:0})},"left-of-fold":function(t){return!e.rightoffold(t,{threshold:0})}})}(jQuery,window,document),define("lib/lazyload",function(){}),define("index_11/index",["wannaBuy/sweetCountdown","lib/lazyload"],function(e,t){function r(e){var t=e.split(" "),n=t[0],r=n.split("-"),i=r[1]+"/"+r[2]+"/"+r[0];return[i,t[1]].join(" ")}var n={};$(document).ready(function(){var e=$(".flex-viewport").unslider({speed:500,delay:3e3,keys:!0,dots:!0,fluid:!0});$(".flex-prev").click(function(){e.data("unslider").stop(),e.data("unslider").prev()}),$(".flex-next").click(function(){e.data("unslider").stop(),e.data("unslider").next()}),$("#choose-nav img").lazyload({}),$("#main-service img").lazyload({}),$("#car-life img").lazyload({})});var i={init:function(){i.initChooseNav(),i.initLimitSaleHover(),i.initLimitSaleCountdown(),i.initWhoBuySlide()},initChooseNav:function(){var e=!1,t=!1;$("#choose_brand").on("mouseenter",function(){e=!0;var t=this;setTimeout(function(){e&&$(t).addClass("active")},300)}).on("mouseleave",function(){e=!1;var t=this;setTimeout(function(){e||$(t).removeClass("active")},300)}),$("#choose_model").on("mouseenter",function(){t=!0;var e=this;setTimeout(function(){t&&$(e).addClass("active")},300)}).on("mouseleave",function(){t=!1;var e=this;setTimeout(function(){t||$(e).removeClass("active")},300)})},initLimitSaleHover:function(){var e=$(".limit-sale .limit-info, .limit-sale .car-info .img-ctn"),t=$(".limit-sale");e.on("mouseenter",function(){t.addClass("hover")}).on("mouseleave",function(){t.removeClass("hover")})},initLimitSaleCountdown:function(){var t=(new Date(r($("#nowtime").val()))).valueOf(),n=(new Date(r($(".limit-sale-left-time").attr("deadline")))).valueOf();e.mini({nowTime:Number(t),endTime:Number(n),zeroCallback:function(){$(".left-time-data").html("限时优惠已结束")},ctn:$(".left-time-data"),showDay:!0,word:{pre:"",day:" 天 ",hour:" 时 ",minute:" 分 ",second:" 秒 "}})},initWhoBuySlide:function(){$("#who-buy .flexslider").unslider({speed:500,delay:3e3,keys:!0,dots:!0,fluid:!0})}},s={markAdviceRead:function(e){$.ajax({type:"GET",url:n.markAdivceRead}).always(e)}},o=document.body,u=$("#header"),a,f={bind:function(){$(".gift-card.has-advice .go").on("click",f.markAdviceRead),$(window).on("scroll",f.headerFixedScroll)},markAdviceRead:function(e){e.preventDefault();var t=$(this).parents(".gift-card"),r=Number(t.find(".advice-count").text());r>0&&s.markAdviceRead(function(){window.location.href=n.wishCardPageUrl})},headerFixedScroll:function(){a||(a=setTimeout(function(){var e=o.scrollTop;e>50&&(u.hasClass("fixed-scroll")||u.addClass("fixed-scroll")),e<30&&u.removeClass("fixed-scroll"),a=null},50))}},l={init:function(e){$.extend(n,e),i.init(),f.bind()}};return l});

//围拍，如果是已登录用户，直接接入后台围拍表，如果没有登录，弹出提示框输入联系方式
function weipai(stype,id_carpublish){  
    //alert($("[name='interest_"+id_carpublish+"']").html());
   // alert($("[name='interest_"+id_carpublish+"']").html()); 
   // $("[name='interest_"+id_carpublish+"']").html("围观("+stype.toString()+")");    
     
    $("#stype").val(stype);
    $("#id_carpublish").val(id_carpublish); 
    if($("#liuyanUserName").val()==''){ 
        $(".Layer").attr('style','display:block;'); 
     }
     else
     {
        //添加围拍信息记录
        var ajax_url = "/Home/Index/GuanZhu.html?stype="+stype+"&id_publish="+id_carpublish+"&username="+$("#liuyanUserName").val(); 
       // window.open(ajax_url,'_blank');
       $.getJSON(ajax_url, function (data) {
                    $.each(data, function (i, item) {
                        if(item['success']){
                        switch($("#stype").val())
                        {
                            case '1':
                                //计数加1 
                                var count=$("[name='interest_"+$("#id_carpublish").val()+"']").html().replace("围观(", "").replace(")", ""); 
                                if(!isNaN(count))
                                    count=parseInt(count) + 1;
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"围观已成功，提交重复！");                                    
                                }
                                else{
                                    $("[name='interest_"+$("#id_carpublish").val()+"']").html("围观("+count.toString()+")");
                                    toastr.success(item['nickname']+"围观提交成功！");
                                }
                                break;
                            case '2':
                                //计数加1
                                var count=$("[name='bidders_"+$("#id_carpublish").val()+"']").html().replace("参拍(", "").replace(")", ""); 
                                if(!isNaN(count))
                                    count=parseInt(count) + 1; 
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"参拍已成功，提交重复！");                                    
                                }
                                else{ 
                                    $("[name='bidders_"+$("#id_carpublish").val()+"']").html("参拍("+count.toString()+")");  
                                    toastr.success(item['nickname']+"参拍提交成功！");       
                                }
                                break;
                            case '3':
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"技术帮帮已成功，提交重复！");                                    
                                }
                                else{ 
                                    toastr.success(item['nickname']+"技术帮帮提交成功！");
                                }
                                break;
                            case '4':
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"询底价已成功，提交重复！");                                    
                                }
                                else{ 
                                toastr.success(item['nickname']+"询底价提交成功！"); 
                            }
                                break;
                            case '5':
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"试驾已成功，提交重复！");                                    
                                }
                                else{ 
                                toastr.success(item['nickname']+"试驾提交成功！"); 
                            }
                                break;
                            case '6':
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"置换已成功，提交重复！");                                    
                                }
                                else{ 
                                toastr.success(item['nickname']+"置换提交成功！"); 
                            }
                                break; 
                            case '7':
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"技师预约已成功，提交重复！");                                    
                                }
                                else{ 
                                toastr.success(item['nickname']+"技师预约提交成功！"); 
                            }
                                break; 
                        }
                    }
                    });
                });
     }
}

function contact_close(){
    $(".Layer").attr('style','display:none;');    
}

function checkInput(){  
    if($("#liuyanUserName").val()=='')
    {
        toastr.info("联系人不能为空");
        return false;
    }
    if($("#liuyanMobile").val()=='')
    {
        toastr.info("联系手机号不能为空");
        return false;
    }
    if($("#liuyanEmail").val()=='')
    {
        toastr.info("联系邮箱不能为空");
        return false;
    } 
    
    var ajax_url = "/Member/User/register.html?source=1&username="+$("#liuyanUserName").val()+"&email="+$("#liuyanEmail").val()+"&mobile="+$("#liuyanMobile").val()+"&password="+$("#liuyanPwd").val()+"&stype="+$("#stype").val()+"&id_publish="+$("#id_carpublish").val();
   // window.open(ajax_url,'_blank');    
    $(".Layer").attr('style','display:none;'); 
    $("#liuyanUserName").val('');  
    $.getJSON(ajax_url, function (data) {
                $.each(data, function (i, item) {
                      // alert('3'+" &&"+ item['success']);
                      if(item['success']){
                          switch($("#stype").val()){
                              case '1':  
                                var count=$("[name='interest_"+$("#id_carpublish").val()+"']").html().replace("围观(", "").replace(")", ""); 
                                if(!isNaN(count))
                                    count=parseInt(count) + 1;  
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"围观已成功，提交重复！");                                    
                                }
                                else{ 
                                    $("[name='interest_"+$("#id_carpublish").val()+"']").html("围观("+count.toString()+")");
                                    toastr.success(item['nickname']+"围观提交成功！");
                                }
                                break; 
                              case '2':  
                                var count=$("[name='bidders_"+$("#id_carpublish").val()+"']").html().replace("参拍(", "").replace(")", ""); 
                                if(!isNaN(count))
                                    count=parseInt(count) + 1; 
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"参拍已成功，提交重复！");                                    
                                }
                                else{ 
                                    $("[name='bidders_"+$("#id_carpublish").val()+"']").html("参拍("+count.toString()+")");  
                                    toastr.success(item['nickname']+"参拍提交成功！");
                                  }
                                  break;
                              case '3':  
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"技术帮帮已成功，提交重复！");                                    
                                }
                                else{ 
                                  toastr.success(item['nickname']+"技术帮帮提交成功！");
                              }
                                  break;
                              case '4':  
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"询底价已成功，提交重复！");                                    
                                }
                                else{ 
                                  toastr.success(item['nickname']+"询底价提交成功！");
                              }
                                  break;
                              case '5':  
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"试驾已成功，提交重复！");                                    
                                }
                                else{ 
                                  toastr.success(item['nickname']+"试驾提交成功！");
                              }
                                  break;
                              case '6':  
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"置换已成功，提交重复！");                                    
                                }
                                else{ 
                                  toastr.success(item['nickname']+"置换提交成功！");
                              }
                                  break;
                              case '7':
                                if(item['data_id']==-3){ 
                                    toastr.success(item['nickname']+"技师预约已成功，提交重复！");                                    
                                }
                                else{ 
                                  toastr.success(item['nickname']+"技师预约提交成功！"); 
                              }
                                  break; 
                          }
                          $("#liuyanUserName").val(item['username']); 
                   }
                    });
                });
}