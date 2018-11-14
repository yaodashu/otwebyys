
$(function (){     
    do_headerf();
})

/*0 banner1*/
function do_headerf(){  
 var headerf_html = '';
    headerf_html += ' <div class="div1">';  
headerf_html += '        <a href="/" title="长沙最好的大宅装修公司"><img src="/public/home/images/yatai_logo.png" alt="长沙我的小窝" /></a>';  
headerf_html += '    </div>';  
headerf_html += '    <div class="div2"> ';  
headerf_html += '	<a href="/index.php/home/anli/"><div>装修案例</div></a>';  
headerf_html += '	<a href="/index.php/home/shejishi/"><div>设计团队</div></a>';  
headerf_html += '	<a href="/index.php/home/gongdi/"><div>施工管理</div></a>                                   ';
headerf_html += '	<a href="/zhuanti/yanjiuyuan/"><div>别墅研究院</div></a>                                    ';
headerf_html += '	<a href="/zhuanti/gongyi/"><div>施工保障</div></a>                                          ';
headerf_html += '	<a href="/about/"><div>关于亚太</div></a>                                                   ';
headerf_html += '    </div>                                                                                   ';
headerf_html += '    <div class="div3">                                                                       ';
headerf_html += '	<div class="tel">                                                                           ';
headerf_html += '	    <a target="_blank" href="tel:4000480731" style="text-decoration:none;">                 ';
headerf_html += '		<div style="float: left;padding-top: 23px;">                                              ';
headerf_html += '		    <img src="/public/home/images/logo_tel.png" style="border:none;float: right;"></div> ';
headerf_html += '		<div style="padding-top: 0%;">400-048-0731</div>                                         ';
headerf_html += '	    </a>                                                                                   ';
headerf_html += '	</div>                                                                                     ';
headerf_html += '	<div class="search">                                                                       ';
headerf_html += '	    <form target="_blank" id="form_search" action="/index.php/home/other/search">          ';
headerf_html += '		<input type="hidden" name="kwtype" value="0">                                            ';
headerf_html += '		<input name="keyword" type="text" class="style1 keyword" style="float: left;width: 140px;height: 26px;color: #969393;margin-top: -5px; padding-left: 10px;border: 1px solid #c3c2c2;" value="" placeholder="输入关键词搜索" onfocus="if (value ==&#39;输入关键词搜索&#39;){value =&#39;&#39;}" onblur="if (value ==&#39;&#39;){value=&#39;输入关键词搜索&#39;}">';  
headerf_html += '		<!--<input type="submit" value="输入关键词搜索" class="style2" title="输入关键词搜索">-->  ';  
headerf_html += '		<a href="javascript:go_search();">';  
headerf_html += '		    <img src="/public/home/images/logo_search.png" style="border:none;float: left; height:30px;margin-top: -5px;">';  
headerf_html += '		</a>';  
headerf_html += '	    </form> ';  
headerf_html += '	</div>';  
headerf_html += '    </div> ';  

    $('#headerf').html(headerf_html);

} 