<div id="content" class="col-lg-10 col-sm-10">
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>admin/scenicArea">景区相册</a>
            </li>
            <li>
                <a href="javascript:void(0);">景区相册列表</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/scenicArea/edit/<?php echo $id ?>">编辑景区相册</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well">
                    <h2><i class="glyphicon glyphicon-edit"></i>&nbsp;详细信息</h2>
                </div>
                <?php if ($this->session->flashdata('savedResult') == 1): ?>
                    <div class="alert alert-success">
                        <strong>编辑成功</strong>
                    </div>
                <?php endif; ?>
                <div class="box-content">
                    <form id="frmContent" role="form" method="POST" action="<?php echo base_url(); ?>admin/scenicArea/edit/<?php echo $id ? $id : ''; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="txtTitle">标题</label>
                            <input name="title" id="txtTitle" type="text" class="form-control" placeholder="标题" value="<?php echo $title ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtDescription">描述</label>
                            <textarea name="description" id="txtDescription" class="form-control" rows="2"><?php echo $description ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="txtHits">推荐</label>
                            <div class="checkbox">
                                <label>
                                    <input name="isRecommended" type="checkbox" <?php echo ($isRecommended == 1 ? "checked" : "") ?>>
                                    是
                                </label>
                            </div>
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
                            <label for="fileCoverImage">封面</label>
                            <input name="coverImage" type="file" id="fileCoverImage" class="upload" data-preview-element-id="imgCoverImage">
                            <img id="imgCoverImage" class="form-control" src="<?php echo ($coverImage ? $coverImage : "http://placehold.it/150x150") ?>" style="margin-top: 3px; width: 150px; height: 150px" alt="coverImage" />
                        </div>
                        <div class="form-group">
                            <label for="fileScenicAreaImages">多照片<em>(选择多张照片 ctrl + 鼠标左键)</em></label>
                            <input name="scenicAreaImages[]" id="fileScenicAreaImages" class="btn btn-default" type="file" onchange="previewFiles()" multiple>
                        </div>
                        <div class="form-group">
                            <div id="preview">
<?php if ((isset($showScenicAreaImages)) && count($showScenicAreaImages) > 0): ?>
    <?php foreach ($showScenicAreaImages as $scenicAreaImage): ?>
                                <img style="height: 100px; width: 100px; margin: 2px; padding: 2px; border: 1px solid" src="<?php echo $scenicAreaImage ?>" />
    <?php endforeach; ?>
<?php endif; ?>
                            </div>
                        </div>
                        <a class="btn btn-primary" href="<?php echo base_url();?>admin/scenicArea">
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

    function previewFiles() {
        var preview = document.querySelector('#preview');
        var files = document.querySelector('#fileScenicAreaImages').files;
        preview.innerHTML = '';

        if (files) {
            if (files.length <= 6) {
                [].forEach.call(files, readAndPreview);
            } else {
                alert('不能上传超过6张照片');
            }
        }

        function readAndPreview(file) {
            if ( /\.(jpe?g|png|gif)$/i.test(file.name)) {
                var reader = new FileReader();

                reader.addEventListener("load", function() {
                    var image = new Image();
                    image.height = 100;
                    image.width = 100;
                    image.title = file.name;
                    image.src = this.result;
                    image.style.margin = '2px';
                    image.style.padding = '2px';
                    image.style.border = '1px solid';
                    preview.appendChild(image);
                }, false);

                reader.readAsDataURL(file);
            } else {
                alert('请选择正确照片格式');
            }
        }
    }

    $(document).ready(function() {
        $(".upload").change(function() {
            readURL(this, $(this).attr('data-preview-element-id'));
        });

        $('#aConfirm').click(function() {
            var title = $('#txtTitle').val();
            var status = $('#ddlStatus').val();
            var coverImage = $('#fileCoverImage').val();

            var message = '';
            var isPassed = true;

            if (!title) {
                isPassed = false;
                message = '请填写标题';
            }

            if (isPassed) {
                if (!status) {
                    isPassed = false;
                    message = '请选择状态';
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
