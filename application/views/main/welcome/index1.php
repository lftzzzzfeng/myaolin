<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
    <script src="<?php echo base_url(); ?>ui/plugins/bower_components/jquery/jquery.min.js"></script>
</head>
<body>
    <div id="container">
        <button id="btnWeiBoLogin">微博登陆</button>
        <a href="<?php echo $weiBoAuthorizeUrl ?>" target="_blank">link</a>
        <form action="https://api.weibo.com/oauth2/access_token" method="POST">
            <input type="text" name="client_id" value="4006818404">
            <input type="text" name="client_secret" value="1f2d22a892a6c3552751bd2f5b59b9b6">
            <input type="text" name="grant_type" value="authorization_code">
            <input type="text" name="code" value="dcdf7f859cb3fdc882514f5e13c859a6">
            <input type="text" name="redirect_uri" value="http://www.meijiaxia.online/">
            <input type="submit">
<!--            2.00rAs7eGSVMK4Efc5f76b7321kpHyD-->
        </form>
        <form action="https://api.weibo.com/oauth2/get_token_info" method="POST">
            <input type="text" name="access_token" value="2.00rAs7eGSVMK4Efc5f76b7321kpHyD">
            <input type="submit">
            <!--            2.00rAs7eGSVMK4Efc5f76b7321kpHyD-->
        </form>
        <form action="https://api.weibo.com/2/users/show.json" method="GET">
            <input type="text" name="access_token" value="2.00rAs7eGSVMK4Efc5f76b7321kpHyD">
            <input type="text" name="uid" value="6094254589">
            <input type="submit">
        </form>
    </div>
    <script type="text/javascript">
        var weiBoLoginUrl = 'https://api.weibo.com/oauth2/access_token?client_id=4006818404&client_secret=1f2d22a892a6c3552751bd2f5b59b9b6&grant_type=authorization_code&redirect_uri=http://www.meijiaxia.online/&code=CODE';
        var publicUrl = 'https://api.weibo.com/oauth2/authorize';

        function loginByWeiBo() {

        }

        $(document).ready(function() {
            $('#btnWeiBoLogin').click(function() {
                $.ajax({
                    type: 'POST',
                    dataType: 'jsonp',
                    url: publicUrl,
                    data: {
                        client_id: '4006818404',
                        client_secret: '1f2d22a892a6c3552751bd2f5b59b9b6',
                        code: '2c6662c7f06432e8cc47a3d9001fb38f',
                        redirect_uri: 'http://www.meijiaxia.online/'
                    },
                    success: function(result) {
                        alert(JSON.stringify(result));
                    }
                });
            });
        });
    </script>
</body>
</html>
