<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Free HTML5 Bootstrap Admin Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
        <meta name="author" content="Muhammad Usman">
        <!-- The styles -->
        <link id="bs-css" href="<?php echo base_url();?>ui/css/bootstrap-cerulean.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>ui/css/charisma-app.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>ui/plugins/bower_components/jquery/jquery.min.js"></script>
        <!-- The fav icon -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>/ui/img/favicon.ico">
    </head>
    <body>
        <div class="ch-container">
            <div class="row">
                <div class="row">
                    <div class="col-md-12 center login-header">
                        <h2>瑶琳管理后台</h2>
                    </div>
                    <!--/span-->
                </div><!--/row-->
                <div class="row">
                    <div class="well col-md-5 center login-box">
                        <div class="alert alert-info">
<?php if ($responseCode == 1): ?>
                            请输入用户名和密码登陆
<?php else: ?>
                            用户名或密码输入错误
<?php endif;?>
                        </div>
                        <form class="form-horizontal" action="<?php echo base_url() ?>admin/login" method="POST">
                            <fieldset>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                                    <input name="username" type="text" id="txtUsername" class="form-control" placeholder="用户名" value="<?php echo $username; ?>">
                                </div>
                                <div class="clearfix"></div><br>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                                    <input name="password" type="password" id="txtPassword" class="form-control" placeholder="密码">
                                </div>
                                <div class="clearfix"></div>
<!--                                <div class="input-prepend">-->
<!--                                    <label class="remember" for="remember"><input type="checkbox" id="remember"> Remember me</label>-->
<!--                                </div>-->
                                <div class="clearfix"></div>
                                <p class="center col-md-5">
                                    <button type="submit" class="btn btn-primary" id="btnLogin">登陆</button>
                                </p>
                            </fieldset>
                        </form>
                    </div>
                    <!--/span-->
                </div><!--/row-->
            </div><!--/fluid-row-->
        </div><!--/.fluid-container-->
        <!-- external javascript -->
        <script src="<?php echo base_url(); ?>/ui/plugins/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>/ui/plugins/layui/pop.js"></script>
        <script type="text/javascript">
            function openNotification(title, content) {
                layer.open({
                    time: 1500,
                    title: title,
                    content: content,
                    skin: 'layui-layer-molv',
                    offset: ['10%', '40%']
                });
            }

            $(document).ready(function() {
                $('#btnLogin').click(function() {
                    var username = $.trim($('#txtUsername').val());
                    var password = $.trim($('#txtPassword').val());

                    var notificationTitle = '提示';
                    var isPassed = true;
                    var message = '';

                    if (!username) {
                        isPassed = false;
                        message = '请输入用户名';
                    }

                    if (isPassed) {
                        if (!password) {
                            isPassed = false;
                            message = '请输入密码';
                        }
                    }

                    if (!isPassed) {
                        openNotification(notificationTitle, message);
                    } else {
                        return true;
                    }

                    return false;
                });
            });
        </script>
    </body>
</html>
