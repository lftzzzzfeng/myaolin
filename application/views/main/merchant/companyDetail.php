<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title></title>
    <link href="<?php echo base_url() ?>/ui/css/mobile/ylwx.css" rel="stylesheet"/>
    <script src="<?php echo base_url() ?>ui/js/main/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/ui/plugins/layui/pop.js"></script>
</head>
<body style=" background: #f6f6f6;">
<div class="gr_con">
    <ul>
        <li class="hit">企业用户</li>
    </ul>
<?php if ($this->session->flashdata('savedResult') == -1): ?>
        <div style="text-align: center">存储成功</div>
<?php endif; ?>
    <div class="panes">
        <form action="<?php echo base_url() ?>merchant/companyDetail" method="POST" enctype="multipart/form-data">
            <div class="pane" style="display:block;">
                <div class="zl_sc">
                    <p class="zl_p"><span>*</span>营业执照</p>
                    <div class="zl_pc">
                        <input type="file" name="image" class="upload" data-preview-element-id="imgImage" style="display: none" id="fileImage" />
                        <a href="javascript:void(0);">
<?php if ($merchant['image']): ?>
                            <img src="<?php echo $merchant['image'] ?>" id="imgImage" />
<?php else: ?>
                            <img src="<?php echo base_url() ?>ui/img/mobile/tx.png" id="imgImage" />
<?php endif; ?>
                        </a>
                        <p>点击头像进行上传</p>
                    </div>
                </div>
                <div class="zl_sc">
                    <p class="zl_p"><span>*</span>商标</p>
                    <div class="zl_pc">
                        <input type="file" name="logo" class="upload" data-preview-element-id="imgLogo" style="display: none" id="fileLogo" />
                        <a href="javascript:void(0);">
<?php if ($merchant['logo']): ?>
                            <img src="<?php echo $merchant['logo'] ?>" id="imgLogo" />
<?php else: ?>
                            <img src="<?php echo base_url() ?>ui/img/mobile/tx.png" id="imgLogo" />
<?php endif; ?>
                        </a>
                        <p>点击进行上传</p>
                    </div>
                </div>
                <div class="zl_sc">
                    <p class="zl_p">专属二维码</p>
                    <div class="zl_pc qrCode">
                        <a href="javascript:void(0);">
<?php if ($merchantDetail['id']): ?>
                            <img src="<?php echo $merchant['qrcode'] ?>" id="imgQrCode" />
<?php else: ?>
                            <img src="<?php echo base_url() ?>ui/img/mobile/tx.png" id="imgQrCode" />
<?php endif; ?>
                        </a>
                    </div>
                </div>
                <div class="zl_sca">
                    <div class="zl_name">
                        <div class="zl_namel"><p><span>*</span>类别</p></div>
                        <div class="zl_namer">
                            <select name="type" id="ddlType" style="width: 100%; height: 30px">
                                <option value="">请选择</option>
                                <option value="1" <?php echo ($merchant['type'] == 1 ? "selected" : "") ?>>饭店</option>
                                <option value="2" <?php echo ($merchant['type'] == 2 ? "selected" : "") ?>>旅行社</option>
                                <option value="3" <?php echo ($merchant['type'] == 3 ? "selected" : "") ?>>互联网</option>
                                <option value="4" <?php echo ($merchant['type'] == 4 ? "selected" : "") ?>>其它</option>
                            </select>
                        </div>
                    </div>
                    <div class="zl_name">
                        <div class="zl_namel"><p><span>*</span>企业名称</p></div>
                        <div class="zl_namer">
                            <input type="text" name="username" id="txtUsername" placeholder="企业名称" value="<?php echo $merchant['name'] ?>" />
                        </div>
                    </div>
                    <div class="zl_name">
                        <div class="zl_namel"><p><span>*</span>企业联络人姓名</p></div>
                        <div class="zl_namer">
                            <input type="text" name="companyContactName" id="txtCompanyContactName" placeholder="企业联络人姓名" value="<?php echo $merchant['companyContactName'] ?>" />
                        </div>
                    </div>
                    <div class="zl_name">
                        <div class="zl_namel"><p><span>*</span>联络人电话号码</p></div>
                        <div class="zl_namer">
                            <input type="text" name="contactNumber" id="txtContactNumber" placeholder="联络人电话号码" value="<?php echo $merchant['contactNumber'] ?>" />
                        </div>
                    </div>
                    <div class="zl_name">
                        <div class="zl_namel"><p><span>*</span>开户银行卡号</p></div>
                        <div class="zl_namer">
                            <input type="text" name="bankCardNumber" id="txtBankCardNumber" placeholder="开户银行卡号" value="<?php echo $merchant['bankCardNumber'] ?>"/>
                        </div>
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
    </div>
</div>
<script type="text/javascript">
    var notificationTitle = '提示';
    var allowedImageExtension = ['jpeg', 'jpg', 'png'];

    var phoneReg = /(^\d{11}$)/;

    function readURL(input, previewElementId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#' + previewElementId).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

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
        $(".upload").change(function() {
            readURL(this, $(this).attr('data-preview-element-id'));
        });

        $('#imgImage').click(function() {
            $('#fileImage').click();
        });

        $('#imgLogo').click(function() {
            $('#fileLogo').click();
        });

        $('#btnConfirm').click(function() {
            var type = $('#ddlType').val();
            var username = $('#txtUsername').val();
            var companyContactName = $('#txtCompanyContactName').val();
            var contactNumber = $('#txtContactNumber').val();
            var bankCardNumber = $('#txtBankCardNumber').val();
            var fileImage = $('#fileImage').val();

            var isPassed = true;

            if (!type) {
                isPassed = false;
                message = '类别不能为空';
            }

            if (isPassed && !username) {
                isPassed = false;
                message = '企业名称不能为空';
            }

            if (isPassed && !companyContactName) {
                isPassed = false;
                message = '企业联络人不能为空';
            }

            if (isPassed && !contactNumber) {
                isPassed = false;
                message = '联络人电话号码不能为空';
            }

            if (isPassed && !phoneReg.test(contactNumber)) {
                isPassed = false;
                message = '联络人电话号码不正确';
            }

            if (isPassed && !$.isNumeric(bankCardNumber)) {
                isPassed = false;
                message = '开户银行卡号不正确';
            }

            if (isPassed && fileImage) {
                var extension = fileImage.split('.')[1];
                if (isPassed && ($.inArray(extension, allowedImageExtension) == -1)) {
                    isPassed = false;
                    message = '请上传正确得照片格式';
                }
            }

            if (!isPassed) {
                openNotification(notificationTitle, message);
                return false;
            } else {
                return true;
            }
        });

        $('#btnCancel').click(function() {
            window.location = '<?php echo base_url() ?>merchant';
        });
    });
</script>
</body>
</html>
