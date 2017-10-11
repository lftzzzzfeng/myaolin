<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>订单</title>
    <link href="<?php echo base_url() ?>/ui/css/mobile/ylwx.css" rel="stylesheet"/>
    <link href="<?php echo base_url() ?>/ui/css/mobile/page.css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo base_url() ?>ui/js/main/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>ui/js/mobile/page.js"></script>
</head>
<body style=" background: #fff;">
<div id="divBack" style="margin-left: 5%; margin-top: 2%; border: 1px black dotted; cursor: pointer; text-align: center; background-color: #f2dede; width: 20%;">< 返回</div>
<div class="dd_con">
    <table border="" cellspacing="" cellpadding="" id="divContent">
        <tr>
            <th style="width: 50%">订单号</th>
<!--            <th>商品名称</th>-->
            <th style="width: 25%">付款金额(<em>元</em>)</th>
            <th style="width: 25%">付款状态</th>
        </tr>
<!--        <div id="divContent"></div>-->
    </table>
    <div style="border: 1px black dotted; cursor: pointer; text-align: center; background-color: #f2dede; width: 50%; margin-left: 25%" id="divLoadMore">查看更多</div>
    <script type="text/javascript">
        var pageNumber = 1;

        function loadOrders() {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo (base_url() . 'merchant/loadOrders') ?>',
                data: {
                    pageNumber: pageNumber
                },
                success: loadOrdersSuccess
            });
        }

        function loadOrdersSuccess(result) {
            if (result && result.orders.length > 0) {
                var targetElement = $('#divContent');

                var content = '';
                for (var orderCount = 0; orderCount < result.orders.length; orderCount++) {
                    content += '<tr>';
                    content += '<td style="width: 50%">';
                    content += ''+result.orders[orderCount].orderId+'';
                    content += '</td>';
//                    content += '<td>';
//                    content += ''+result.orders[orderCount].productName+'('+result.orders[orderCount].purchaseQuantity+')';
//                    content += '</td>';
                    content += '<td style="width: 25%">';
                    content += ''+(result.orders[orderCount].totalFee / 100)+'';
                    content += '</td>';
                    content += '<td style="width: 25%">';
                    content += ''+result.orders[orderCount].status+'';
                    content += '</td>';
                    content += '</tr>';
                }

                targetElement.append(content);
                if (result.isMore == false) {
                    $('#divLoadMore').hide();
                }
            } else {
                $('#divLoadMore').hide();
            }
        }

        $(document).ready(function() {
            loadOrders();

            $('#divLoadMore').click(function() {
                pageNumber++;
                loadOrders();
            });

            $('#divBack').click(function() {
                window.location = '<?php echo (base_url() . 'merchant/index') ?>';
            });
        });
    </script>
</div>

</body>
</html>