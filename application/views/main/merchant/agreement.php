<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title></title>
    <link href="<?php echo base_url() ?>/ui/css/mobile/ylwx.css" rel="stylesheet"/>
    <script src="<?php echo base_url() ?>ui/js/main/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        function ad_img(obj,radio){
            $.each($("div[class=share_radioa]"),function(ii,ae){
                ae.style.background = "";
                ae.style.border = "1px solid #e5e5e5";
                ae.style.color = "#e5e5e5";
            });
            if(obj.style.background){
                obj.style.background = "#f6f6f6";
                obj.style.border = "1px solid #e5e5e5";
                obj.style.color = "#e5e5e5";
                document.getElementById(radio).checked = false;
            }else{
                obj.style.background = "url(../ui/img/mobile/dui.png) center no-repeat";
                obj.style.border = "1px solid #e5e5e5";
                obj.style.color = "#e5e5e5";
                document.getElementById(radio).checked = true;
            }
        }
    </script>
</head>
<body>
<div class="fw_con">
    <p class="fw_p">瑶琳服务协议</p>
    <p class="fw_pa"> 通常，您在使用“瑶琳”服务时，“瑶琳”会收集多种信息，以提高运行效率，尽我们所能为您提供最佳服务和体验。在此特别提醒您认真阅读、充分理解本《服务协议》（下称《协议》）--- 您应认真阅读、充分理解本《协议》中各条款，包括免除或者限制“瑶琳”责任的免责条款及对您的权利限制条款。请您审慎阅读并选择接受或不接受本《协议》（未成年人应在法定监护人陪同下阅读）。除非您接受本《协议》所有条款， 否则您无权注册、登录或使用“瑶琳”所提供的相关服
        务。您的注册、登录、 使用等行为将视为对本《协议》的接
        受，并同意接受本《协议》各项条款的约束。 本《协议》是您与桐庐瑶琳森林公园旅游有限公司之间关于您注册、 登录、使用“瑶琳”服务所订立的协议。</p>
    <p class="fw_p">使用规则</p>
    <p class="fw_pb">1、您充分了解并同意，瑶琳仅为您提供信息分享、传送及获取的平台，您必须为自己注册帐号下的一切行为负责，包括您所传送的任何内容以及由此产生的任何结果。 您应对瑶琳中的内容自行加以判断，并承担因使用内容而引起的所有风险，包括因对内容的正确性、完整性或实用性的依赖而产生的风险。
        <br />2、您在瑶琳服务中或通过瑶琳所传送的任何内容并不反映桐庐瑶琳森林公园有限公司的观点或政策，桐庐瑶琳森林公园有限公司对此不承担任何责任。</p>
</div>
<div class="xz_gq fw_a">
    <div class="xz_left">
        <input type="radio" name="radio1" id="radio1_1" value="radio1" style="display:none;" />
        <div class="share_radioa" style="margin-left: 30%;" onClick="ad_img(this,'radio1_1')"></div> 同意
    </div>
    <div class="xz_left">
        <input type="radio" name="radio1" id="radio1_2" value="radio2" style="display:none;" />
        <div class="share_radioa" onClick="ad_img(this,'radio1_2')"></div> 不同意
    </div>
</div>
<div class="fw_next"><a href="#">下一步＞</a></div>
</body>
</html>
