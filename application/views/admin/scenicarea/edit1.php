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
                <div class="box-content">
                    <form id="frmContent" role="form" method="POST" action="<?php echo base_url(); ?>admin/scenicArea/edit/<?php echo $id ? $id : ''; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">多照片<em>(选择多张照片 ctrl + 鼠标左键)</em></label>
                            <input name="scenicAreaImages[]" id="browse" class="btn btn-default" type="file" onchange="previewFiles()" multiple>
                        </div>
                        <div class="form-group">
                            <div id="preview"></div>
                        </div>
                        <button type="submit" class="btn btn-default">返回</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-default">提交</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
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

    function previewFiles() {
        var preview = document.querySelector('#preview');
        var files = document.querySelector('input[type=file]').files;
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
        $('#fileScenicAreaImages').change(function() {
//            var scenicAreaImages = $('#fileScenicAreaImages').val();
//            alert(JSON.stringify(scenicAreaImages));

//            var names = [];
//            for (var i = 0; i < $(this).get(0).files.length; ++i) {
//                names.push($(this).get(0).files[i].name);
//
//                var reader = new FileReader();
//                reader.onload = function(e) {
//                    $('#img' + i).attr('src', e.target.result);
//                };
//                reader.readAsDataURL(this.files[i]);
//            }
        });
    });
</script>