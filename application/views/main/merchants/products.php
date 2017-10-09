<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>瑶琳商户购票中心</title>
    <link href="<?php echo base_url() ?>/ui/css/mobile/sp.css" rel="stylesheet"/>
    <script src="<?php echo base_url() ?>ui/js/main/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/ui/plugins/layui/pop.js"></script>
</head>
<body>
    <div class="sp_con">
<?php if ($products): ?>
    <?php foreach ($products as $product): ?>
        <div class="sp_conleft">
            <img src="<?php echo base_url(); ?>ui/img/sp_1.jpg" />
            <h1 class="name"><?php echo $product['name'] ?></h1>
            <p class="description"><?php echo $product['description'] ?></p>
            <div class="sp_jg">
                <div class="sp_l">¥<?php echo $product['unitPrice'] / 100 ?> <span>¥<?php echo $product['originalUnitPrice'] / 100 ?></span> </div>
                <div class="sp_r">
                    <div class="sp_ra"><a href="javascript:void(0);" class="minus">-</a></div>
                    <div class="sp_rb">1</div>
                    <div class="sp_rc"><a href="javascript:void(0)" class="plus">+</a></div>
                </div>
            </div>
            <div class="sp_btn item" data-product-id="<?php echo $product['id'] ?>" data-product-fee="<?php echo $product['unitPrice'] / 100 ?>">
                <a href="javascript:void(0);">立即购买</a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
    </div>
    <form id="frmContent" action="<?php echo base_url() ?>merchants/shop/initJSAPI" method="POST">
        <input type="hidden" name="productId" id="hdnProductId" value="">
        <input type="hidden" name="productName" id="hdnProductName" value="">
        <input type="hidden" name="productDescription" id="hdnProductDescription" value="">
        <input type="hidden" name="productFee" id="hdnProductFee" value="">
        <input type="hidden" name="productQuantity" id="hdnProductQuantity" value="">
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.plus').click(function() {
                var number = $(this).parent().siblings('.sp_rb').html();
                $(this).parent().siblings('.sp_rb').html(parseInt(number) + 1);
            });

            $('.minus').click(function() {
                var number = $(this).parent().siblings('.sp_rb').html();
                if ((parseInt(number) - 1) > 0) {
                    $(this).parent().siblings('.sp_rb').html(parseInt(number) - 1);
                }
            });

            $('.item').click(function() {
                $('#hdnProductId').val($(this).attr('data-product-id'));
                $('#hdnProductName').val($(this).parent().children('.name').html());
                $('#hdnProductDescription').val($(this).parent().children('.description').html());
                $('#hdnProductFee').val($(this).attr('data-product-fee'));
                $('#hdnProductQuantity').val($(this).siblings('.sp_jg').children().children('.sp_rb').html());

                $('#frmContent').submit();
            });
        });
    </script>
</body>
</html>