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
            <div class="panes">
                <div class="pane">
                    <div class="zl_sc">
                        <p class="zl_p"><span>*</span>上传企业营业执照</p>
                        <div class="zl_pca">
                            <a href="#"><img src="<?php echo base_url() ?>ui/img/mobile/yyzz.png"  /></a>
                            <p>点击图片进行上传</p>
                        </div>
                    </div>
                    <div class="zl_sca">
                        <div class="zl_name">
                            <div class="zl_namel"><p><span>*</span>企业名称</p></div>
                            <div class="zl_namer">
                                <input type="text" name="textfield" id="textfield" placeholder="请输入企业名称" />
                            </div>
                        </div>
                        <div class="zl_name">
                            <div class="zl_namel"><p><span>*</span>企业联络人姓名</p></div>
                            <div class="zl_namer">
                                <input type="text" name="textfield" id="textfield" placeholder="请输入企业联络人姓名" />
                            </div>
                        </div>
                        <div class="zl_name">
                            <div class="zl_namel"><p><span>*</span>联络人电话号码</p></div>
                            <div class="zl_namer">
                                <input type="text" name="textfield" id="textfield" placeholder="请输入企业联络人电话号码" />
                            </div>
                        </div>
                        <div class="zl_name">
                            <div class="zl_namel"><p><span>*</span>开户银行卡</p></div>
                            <div class="zl_namer">
                                <input type="text" name="textfield" id="textfield" placeholder="请输入银行卡号" />
                            </div>
                        </div>

                    </div>
                    <div class="dl_tj">
                        <input type="submit" name="button" id="button" value="提交" />
                    </div>
                    <div class="dl_tj dl_qx">
                        <input type="reset" name="button" id="button" value="取消" />
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
