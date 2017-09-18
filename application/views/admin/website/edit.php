<div id="content" class="col-lg-10 col-sm-10">
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>admin/website/edit">编辑网站首页配置信息</a>
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
                    <form id="frmContent" role="form" method="POST" action="<?php echo base_url(); ?>admin/website/edit" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="txtTitle">标题</label>
                            <input name="title" id="txtTitle" type="text" class="form-control" placeholder="标题" value="<?php echo $title ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtContent">内容</label>
                            <textarea name="content" id="txtContent" class="form-control" rows="4"><?php echo $content ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="fileBackgroundImage">背景图片</label>
                            <input name="backgroundImage" type="file" id="fileBackgroundImage" class="upload" data-preview-element-id="imgBackgroundImage">
                            <img id="imgBackgroundImage" class="form-control" src="<?php echo ($backgroundImage ? $backgroundImage : "http://placehold.it/150x150") ?>" style="margin-top: 3px; width: 150px; height: 150px" alt="coverImage" />
                        </div>
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

        $('#aConfirm').click(function() {
            var title = $('#txtTitle').val();
            var backgroundImage = $('#fileBackgroundImage').val();

            var message = '';
            var isPassed = true;

            if (!title) {
                isPassed = false;
                message = '请填写标题';
            }

            if (isPassed && backgroundImage) {
                var extension = backgroundImage.split('.')[1];
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
