<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title></title>
        <link href="<?php echo base_url() ?>/ui/css/mobile/ylwx.css" rel="stylesheet"/>
        <script src="<?php echo base_url() ?>ui/js/main/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            function ad_img(obj,radio){
                $.each($("div[class=share_radio]"),function(ii,ae){
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
                    obj.style.background = "url(../ui/img/mobile/dian.png) center no-repeat";
                    obj.style.border = "1px solid #e5e5e5";
                    obj.style.color = "#e5e5e5";
                    document.getElementById(radio).checked = true;
                }
            }
        </script>
    </head>
    <body>
        <div class="dl_logo">
            <figure><img src="<?php echo base_url() ?>ui/img/mobile/logo.png"></figure>
        </div>
        <div class="dl_con">
            <div class="dl_name">
                <img src="<?php echo base_url() ?>ui/img/mobile/user.png" />
                <div class="dl_right">
                    <input type="text" name="textfield" id="textfield" placeholder="用户名" />
                </div>
            </div>
            <div class="dl_warn"><p>用户名错误</p></div>
            <div class="dl_name">
                <img style="width: 6.5%;" src="<?php echo base_url() ?>ui/img/mobile/password.png" />
                <div class="dl_right">
                    <input type="text" name="textfield" id="textfield" placeholder="密码" />
                </div>
            </div>
            <div class="dl_warn"><p>密码错误</p></div>
            <div class="xz_gq">
                <div class="xz_left">
                    <input type="radio" name="radio1" id="radio1_1" value="radio1" style="display:none;"  />
                    <div class="share_radio" style="margin-left: 30%;" onClick="ad_img(this,'radio1_1')"></div> 个人
                </div>
                <div class="xz_left">
                    <input type="radio" name="radio1" id="radio1_2" value="radio2" style="display:none;"  />
                    <div class="share_radio" onClick="ad_img(this,'radio1_2')"></div> 企业
                </div>
            </div>
            <div class="dl_tj">
                <input type="submit" name="button" id="button" value="提交" />
            </div>
            <div class="dl_tj dl_qx">
                <input type="reset" name="button" id="button" value="取消" />
            </div>
            <p>没有账号？请<a href="<?php echo base_url() ?>merchant/signup">注册</a></p>
        </div>
    </body>
</html>