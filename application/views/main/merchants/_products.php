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
<div class="dl_con">
<?php foreach ($products as $product): ?>
    <div class="dl_name">
        <div class="item" data-product-id="<?php echo $product['id'] ?>" data-product-fee="<?php echo $product['originalUnitPrice'] ?>">
            <?php echo $product['name'] ?>&nbsp;&nbsp;<?php echo $product['originalUnitPrice'] / 100 ?>&nbsp;元钱
        </div>
    </div>
<?php endforeach; ?>
    <form id="frmContent" action="<?php echo base_url() ?>merchants/shop/initJSAPI" method="POST">
        <input type="hidden" name="productId" id="hdnProductId" value="">
        <input type="hidden" name="productFee" id="hdnProductFee" value="">
    </form>
    <div class="dl_tj">
        <input type="button" name="button" id="btnConfirm" value="提交" />
    </div>
</div>
<script>
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
        $('.item').click(function() {
            $('#hdnProductId').val($(this).attr('data-product-id'));
            $('#hdnProductFee').val($(this).attr('data-product-fee'));

            $('#frmContent').submit();
        });
    });
</script>
</body>
</html>
