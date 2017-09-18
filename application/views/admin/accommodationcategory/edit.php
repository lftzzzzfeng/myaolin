<div id="content" class="col-lg-10 col-sm-10">
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>admin/accommodationCategory">住在瑶琳类别</a>
            </li>
            <li>
                <a href="javascript:void(0);">住在瑶琳类别列表</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/accommodationCategory/edit/<?php echo $id ?>">编辑住在瑶琳类别</a>
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
                    <form id="frmContent" role="form" method="POST" action="<?php echo base_url(); ?>admin/accommodationCategory/edit/<?php echo $id ? $id : ''; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="txtTitle">标题</label>
                            <input name="title" id="txtTitle" type="text" class="form-control" placeholder="标题" value="<?php echo $title ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtDescription">描述</label>
                            <textarea name="description" id="txtDescription" class="form-control" rows="2"><?php echo $description ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="txtDescription">特殊提供</label>
                        </div>
                        <div class="form-group" id="divSpecial">
<?php if ((isset($showAccommodationCategoryImages)) && count($showAccommodationCategoryImages) > 0): ?>
    <?php foreach ($showAccommodationCategoryImages as $showAccommodationCategoryImage): ?>
                            <div class="form-group">
                                <input name="specialImagesText[<?php echo $showAccommodationCategoryImage['id'] ?>][]" type="text" class="form-control" placeholder="内容" value="<?php echo $showAccommodationCategoryImage['text'] ?>">
                                <input name="specialImages[<?php echo $showAccommodationCategoryImage['id'] ?>][]" class="btn btn-default upload" data-preview-element-id="_imgSpecialImage<?php echo $showAccommodationCategoryImage['id'] ?>" type="file" style="margin-top:3px">
                                <img id="_imgSpecialImage<?php echo $showAccommodationCategoryImage['id'] ?>" src="<?php echo $showAccommodationCategoryImage['image'] ?>" style="margin-top:3px;width:150px;height:150px" alt="<?php echo $showAccommodationCategoryImage['text'] ?>" />
                                &nbsp;
                                <a class="btn btn-info aMinusSpecial" href="javascript:void(0);">
                                    <i class="glyphicon glyphicon-minus icon-white"></i>
                                </a>
                            </div>
    <?php endforeach; ?>
<?php endif; ?>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-warning pull-right" href="javascript:void(0);" id="aAddSpecial">
                                <i class="glyphicon glyphicon-plus icon-white"></i>
                            </a>
                        </div>
                        <br>
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
                        <a class="btn btn-primary" href="<?php echo base_url();?>admin/accommodationCategory">
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
    var countSpecial = 1;

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
        $('#aAddSpecial').click(function() {
            var targetElement = $('#divSpecial');

            var content = '<div class=\"form-group\">';
            content += '<input name=\"specialImagesText[new'+countSpecial+'][]\" type=\"text\" class=\"form-control\" placeholder=\"标题\">';
            content += '<input name=\"specialImages[new'+countSpecial+'][]\" class=\"btn btn-default upload\" data-preview-element-id=\"imgSpecialImage'+countSpecial+'\" type=\"file\" style=\"margin-top:3px\">';
            content += '<img id=\"imgSpecialImage'+countSpecial+'\" src=\"http://placehold.it/150x150\" style=\"margin-top:3px;width:150px;height:150px\" alt=\"coverImage\" />';
            content += '&nbsp;';
            content += '<a class=\"btn btn-info aMinusSpecial\" href=\"javascript:void(0);\">';
            content += '<i class=\"glyphicon glyphicon-minus icon-white\"></i>';
            content += '</a>';
            content += '</div>';

            countSpecial++;
            targetElement.append(content);
        });

        $('#content').on('click', '.aMinusSpecial', function() {
            $(this).parent().remove();
        });

        $('#content').on('change', '.upload', function() {
            readURL(this, $(this).attr('data-preview-element-id'));
        });

        $('#aConfirm').click(function() {
            var title = $('#txtTitle').val();
            var status = $('#ddlStatus').val();

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

            if (!isPassed) {
                openNotification(notificationTitle, message);
                return false;
            } else {
                $('#frmContent').submit();
            }
        });
    });
</script>
