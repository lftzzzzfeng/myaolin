<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title></title>
    <link href="<?php echo base_url() ?>/ui/css/mobile/ylwx.css" rel="stylesheet"/>
    <script src="<?php echo base_url() ?>ui/js/main/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/ui/plugins/layui/pop.js"></script>
</head>
<body>
<div class="dl_logo">
    <figure><img src="<?php echo base_url() ?>ui/img/mobile/logo.png"></figure>
</div>
<form action="<?php echo base_url() ?>merchant/signUp" method="POST">
    <div class="dl_con">
        <div class="dl_name">
            <img src="<?php echo base_url() ?>ui/img/mobile/user.png" />
            <div class="dl_right">
                <input name="username" type="text" id="txtUsername" placeholder="用户名" />
            </div>
        </div>
        <div class="dl_name">
            <img style=" width: 6.5%;" src="<?php echo base_url() ?>ui/img/mobile/password.png" />
            <div class="dl_right">
                <input name="password" type="password" id="txtPassword" placeholder="密码" />
            </div>
        </div>
        <div class="dl_name">
            <img style=" width: 6.5%;" src="<?php echo base_url() ?>ui/img/mobile/password.png" />
            <div class="dl_right">
                <input name="repeatPassword" type="password" id="txtRepeatPassword" placeholder="重复密码" />
            </div>
        </div>
        <div class="xz_gq">
            <div class="xz_left">
                <input type="radio" name="type" id="radTypeIndividual" value="1" style="display:none;" />
                <div class="share_radio" style="margin-left: 30%;" onClick="ad_img(this,'radTypeIndividual')"></div> 个人
            </div>
            <div class="xz_left">
                <input type="radio" name="type" id="radTypeCompany" value="2" style="display:none;"  />
                <div class="share_radio" onClick="ad_img(this,'radTypeCompany')"></div> 企业
            </div>
        </div>
        <div class="dl_tj">
            <input type="submit" name="button" id="btnConfirm" value="提交" />
        </div>
        <div class="dl_tj dl_qx">
            <input type="button" name="button" id="btnCancel" value="取消" />
        </div>
    </div>
</form>
<script type="text/javascript">
    function ad_img(obj, radio) {
        $.each($("div[class=share_radio]"), function(ii, ae) {
            ae.style.background = "";
            ae.style.border = "1px solid #e5e5e5";
            ae.style.color = "#e5e5e5";
        });

        obj.style.background = "url(../ui/img/mobile/dian.png) center no-repeat";
        obj.style.border = "1px solid #e5e5e5";
        obj.style.color = "#e5e5e5";
        if (radio == 'radTypeIndividual') {
            document.getElementById('radTypeIndividual').checked = true;
            document.getElementById('radTypeCompany').checked = false;
        } else if (radio == 'radTypeCompany') {
            document.getElementById('radTypeIndividual').checked = false;
            document.getElementById('radTypeCompany').checked = true;
        }
    }
</script>
<script>
    var code = '<?php echo $code ?>';
    var returnMessage = '<?php echo $message ?>';

    var notificationTitle = '提示';
    var message = '';

    function openNotification(title, content) {
        layer.open({
            time: 1500,
            title: title,
            content: content,
            skin: 'layui-layer-molv',
            offset: ['30%', '10%']
        });
    }

    $(document).ready(function() {
        if (code == 1) {
            openNotification(notificationTitle, returnMessage);
        } else if (code == -1) {
            openNotification(notificationTitle, returnMessage);
            setTimeout(function() {
                window.location = '<?php echo (base_url() . 'merchant/login') ?>';
            }, 1000);
        }

        $('#btnConfirm').click(function() {
            var username = $('#txtUsername').val();
            var password = $('#txtPassword').val();
            var repeatPassword = $('#txtRepeatPassword').val();
            var type = '';

            if ($('#radTypeIndividual').is(':checked')) {
                type = $('#radTypeIndividual').val();
            }

            if ($('#radTypeCompany').is(':checked')) {
                type = $('#radTypeCompany').val();
            }

            var isPassed = true;

            if (!username) {
                isPassed = false;
                message = '用户名不能为空';
            }

            if (isPassed && !password) {
                isPassed = false;
                message = '密码不能为空';
            }

            if (isPassed && (password != repeatPassword)) {
                isPassed = false;
                message = '两次输入得密码不匹配';
            }

            if (isPassed && !type) {
                isPassed = false;
                message = '请选择类型: 个人或企业';
            }

            if (!isPassed) {
                openNotification(notificationTitle, message);
                return false;
            } else {
                return true;
            }
        });

        $('#btnCancel').click(function() {
            window.location = '<?php echo base_url() ?>merchant/login';
        });
    });
</script>
</body>
</html>
