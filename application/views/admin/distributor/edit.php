<div id="content" class="col-lg-10 col-sm-10">
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>admin/distributor">分销商</a>
            </li>
            <li>
                <a href="javascript:void(0);">分销商列表</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/distributor/edit/<?php echo $id ?>">编辑分销商</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-edit"></i>&nbsp;详细信息</h2>
                </div>
<?php if ($this->session->flashdata('savedResult') == 1): ?>
                <div class="alert alert-success">
                    <strong>编辑成功</strong>
                </div>
<?php endif; ?>
                <div class="box-content">
                    <form id="frmContent" role="form" method="POST" action="<?php echo base_url(); ?>admin/distributor/edit/<?php echo $id ? $id : ''; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="txtIncharge">负责人</label>
                            <input name="incharge" id="txtIncharge" type="text" class="form-control" placeholder="负责人" value="<?php echo $incharge ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtMobile">联系电话</label>
                            <input name="mobile" id="txtMobile" type="text" class="form-control" placeholder="联系电话" value="<?php echo $mobile ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtName">公司名称</label>
                            <input name="name" id="txtName" type="text" class="form-control" placeholder="公司名称" value="<?php echo $name ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtDescription">公司描述</label>
                            <textarea name="description" id="txtDescription" class="form-control" rows="2"><?php echo $description ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="txtContent">公司内容</label>
                            <textarea name="content" id="txtContent" class="form-control" rows="4"><?php echo $content ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="txtAddress">公司地址</label>
                            <input name="address" type="text" class="form-control" id="txtAddress" placeholder="公司内容" value="<?php echo $address ?>">
                        </div>
                        <div class="form-group">
                            <label for="ddlStatus">状态</label>
                            <div class="controls">
                                <select name="status" id="ddlStatus" class="form-control">
                                    <option value="">请选择</option>
                                    <option <?php echo ($status == 1 ? "selected" : "") ?> value="1">激活</option>
                                    <option <?php echo ($status == 2 ? "selected" : "") ?> value="2">未激活</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fileLogo">商标</label>
                            <input name="logo" type="file" id="fileLogo" class="upload" data-preview-element-id="imgLogo">
                            <img id="imgLogo" class="form-control" src="<?php echo ($logo ? $logo : "http://placehold.it/150x150") ?>" style="margin-top: 3px; width: 150px; height: 150px" alt="logo" />
                        </div>
                        <div class="form-group">
                            <label for="fileCoverImage">封面</label>
                            <input name="coverImage" type="file" id="fileCoverImage" class="upload" data-preview-element-id="imgCoverImage">
                            <img id="imgCoverImage" class="form-control" src="<?php echo ($coverImage ? $coverImage : "http://placehold.it/150x150") ?>" style="margin-top: 3px; width: 150px; height: 150px" alt="coverImage" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">二维码</label>
                            <img id="imgCoverImage" class="form-control" src="<?php echo ($qrCode ? $qrCode : "http://placehold.it/300x300") ?>" style="margin-top: 3px; width: 300px; height: 300px" alt="qrCode" />
                        </div>
                        <a class="btn btn-primary" href="<?php echo base_url();?>admin/distributor">
                            <i class="glyphicon glyphicon-edit icon-white"></i>
                            返回
                        </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-warning" href="javascript:void(0);" id="aConfirm">
                            <i class="glyphicon glyphicon-edit icon-white"></i>
                            提交
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var notificationTitle = '提示';
    var allowedImageExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];

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
            offset: ['10%', '40%']
        });
    }

    $(document).ready(function() {
        $(".upload").change(function() {
            readURL(this, $(this).attr('data-preview-element-id'));
        });

        CKEDITOR.replace('txtContent', {
            height: 300,
            filebrowserBrowseUrl: '<?php echo base_url(); ?>ui/plugins/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: '<?php echo base_url(); ?>ui/plugins/ckfinder/ckfinder.html?type=Images',
            filebrowserUploadUrl: '<?php echo base_url(); ?>ui/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '<?php echo base_url(); ?>ui/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
        });

        $('#aConfirm').click(function() {
            var incharge = $('#txtIncharge').val();
            var mobile = $('#txtMobile').val();
            var name = $('#txtName').val();
            var description = $('#txtDescription').val();
            var content = $('#txtContent').val();
            var address = $('#txtAddress').val();
            var status = $('#ddlStatus').val();
            var logo = $('#fileLogo').val();
            var coverImage = $('#fileCoverImage').val();

            var message = '';
            var isPassed = true;

            if (mobile && (!(/^\d{11}$/.test(mobile)))) {
                isPassed = false;
                message = '请输入正确手机号';
            }

            if (isPassed) {
                if (!status) {
                    isPassed = false;
                    message = '请选择状态';
                }
            }

            if (isPassed && logo) {
                var extension = logo.split('.')[1];
                if ($.inArray(extension, allowedImageExtension) == -1) {
                    isPassed = false;
                    message = '请上传正确得照片格式';
                }
            }

            if (isPassed && coverImage) {
                var extension = coverImage.split('.')[1];
                if ($.inArray(extension, allowedImageExtension) == -1) {
                    isPassed = false;
                    message = '请上传正确得照片格式';
                }
            }

            if (!isPassed) {
                openNotification(notificationTitle, message);
                return false;
            } else {
                $('#frmContent').submit();
            }
        });
    });
</script>
