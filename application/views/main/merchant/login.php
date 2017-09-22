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
        <form action="<?php echo base_url() ?>merchant/login" method="POST">
            <div class="dl_con">
                <div class="dl_name">
                    <img src="<?php echo base_url() ?>ui/img/mobile/user.png" />
                    <div class="dl_right">
                        <input type="text" name="username" id="txtUsername" placeholder="用户名" />
                    </div>
                </div>
                <div class="dl_name">
                    <img style="width: 6.5%;" src="<?php echo base_url() ?>ui/img/mobile/password.png" />
                    <div class="dl_right">
                        <input type="password" name="password" id="txtPassword" placeholder="密码" />
                    </div>
                </div>
                <div class="dl_tj">
                    <input type="submit" name="button" id="btnConfirm" value="提交" />
                </div>
                <div class="dl_tj dl_qx">
                    <input type="button" name="button" id="btnCancel" value="回到网站首页" />
                </div>
                <p>没有账号？请<a href="<?php echo base_url() ?>merchant/signup">注册</a></p>
            </div>
        </form>
        <script type="text/javascript">
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
                }

                $('#btnConfirm').click(function() {
                    var username = $('#txtUsername').val();
                    var password = $('#txtPassword').val();

                    var isPassed = true;

                    if (!username) {
                        isPassed = false;
                        message = '用户名不能为空';
                    }

                    if (isPassed && !password) {
                        isPassed = false;
                        message = '密码不能为空';
                    }

                    if (!isPassed) {
                        openNotification(notificationTitle, message);
                        return false;
                    } else {
                        return true;
                    }
                });

                $('#btnCancel').click(function() {
                    window.location = '<?php echo base_url() ?>';
                });
            });
        </script>
    </body>
</html>