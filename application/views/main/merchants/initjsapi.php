<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>微信支付样例-支付</title>
        <script type="text/javascript">
            //调用微信JS api 支付
            function onBridgeReady(){
                WeixinJSBridge.invoke(
                    'getBrandWCPayRequest',
                    <?php echo $jsApiParameters ?>,
                    function(res){
                        if (res.err_msg == "get_brand_wcpay_request:ok" ) {
                            window.location = '<?php echo base_url() ?>';
                        }     // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
                    }
                );
            }

            function callpay()
            {
                if (typeof WeixinJSBridge == "undefined"){
                    if( document.addEventListener ){
                        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
                    }else if (document.attachEvent){
                        document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
                        document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
                    }
                }else{
                    onBridgeReady();
                }
            }
        </script>
    </head>
    <body>
        <br/>
        <font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px"><?php echo $productFee / 100 ?></span>元钱</b></font><br/><br/>
        <div align="center">
            <button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
        </div>
    </body>
</html>