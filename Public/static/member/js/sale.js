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

// 颜色选择变化
function color_change(){
 //   alert($("[name='id_color']").val());
  $("[name='color_dl']").attr('style','display:block');
  var tid="color_id_"+$("[name='id_color']").val();
  $("[name='color_img']").attr('src',$("[name='"+tid+"']").attr('value'));
}

//检测是会员或者非会员
function pub_member_change() {
    if ($(".per_member:checked").val() == 1)
    {
        $("#pub_member_not").attr("style", "display:block");
        $("#pub_member").attr("style", "display:none");
    }
    else
    {
        $("#pub_member_not").attr("style", "display:none");
        $("#pub_member").attr("style", "display:block");
    }
}
//检测销售类型
function publish_type_change() {
    if ($(".publish_type:checked").val() == 1 || $(".publish_type:checked").val() == 3)
    {
        $("[name='price_mark_div']").attr("style", "display:block");
        $("[name='pub_price_div']").attr("style", "display:block");
        $("[name='price_pai_div']").attr("style", "display:none");
        $("[name='price_add_div']").attr("style", "display:none");
        $("[name='time_start_div']").attr("style", "display:none");
        $("[name='time_end_div']").attr("style", "display:none");    
    }
    if ($(".publish_type:checked").val() == 2)
    {
        $("[name='price_mark_div']").attr("style", "display:none");
        $("[name='pub_price_div']").attr("style", "display:none");
        $("[name='price_pai_div']").attr("style", "display:block");
        $("[name='price_add_div']").attr("style", "display:block");
        $("[name='time_start_div']").attr("style", "display:block");
        $("[name='time_end_div']").attr("style", "display:block");        
    }
}

function sale_per_submit() {
    if ($(".carbase_list_id:checked").length != 1)
    {
        toastr.warning("发布信息必须包括一款具体车型");
        return false;
    }
    if ($("[name='title']").val().length < 5)
    {
        toastr.warning("发布名称必须是5位长度以上有效值");
        $("[name='title']").focusin();
        return false;
    }
    if ($("[name='age_drive']").val() == '')
    {
        toastr.warning("车龄不能为空");
        $("[name='age_drive']").focusin();
        return false;
    }
    if ($("[name='age_mile']").val() == '')
    {
        toastr.warning("里程不能为空");
        $("[name='age_mile']").focusin();
        return false;
    }
    if ($("[name='id_color']").val() == '' || $("[name='id_color']").val() == '选择颜色')
    {
        toastr.warning("颜色不能为空");
        // $("[name='id_color']").focusin();
        return false;
    }
    if ($("[name='id_area']").val() == '' || $("[name='id_area']").val() == null)
    {
        toastr.warning("地区不能为空");
        // $("[name='id_color']").focusin();
        return false;
    }
    if ($(".publish_type:checked").val() == 1 || $(".publish_type:checked").val() == 3) {
        if ($("[name='price_mark']").val() == '') {
            toastr.warning("市场估价不能为空");
            $("[name='price_mark']").focusin();
            return false;
        }
        if ($("[name='pub_price']").val() == '') {
            toastr.warning("驾无忧报价不能为空");
            $("[name='pub_price']").focusin();
            return false;
        }
    }
    if ($(".publish_type:checked").val() == 2) {
        if ($("[name='price_pai']").val() == '') {
            toastr.warning("拍卖报价不能为空");
            $("[name='price_pai']").focusin();
            return false;
        }
        if ($("[name='price_add']").val() == '') {
            toastr.warning("拍卖加价不能为空");
            $("[name='price_add']").focusin();
            return false;
        }
    }
        if ($("[name='pub_email']").val() == '') {
            toastr.warning("邮箱地址不能为空");
            $("[name='pub_email']").focusin();
            return false;
        }
    //选择非会员时用户名必输输入，选择会员时会员账户必输输入
    if ($("[name='pub_member']").val().length < 2)
    {
        toastr.warning("会员登录账户名不能为空.");
        return false;
    }
    $("#sale_per").submit();
}
            
            
