<div id="content" class="col-lg-10 col-sm-10">
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>admin/payment">付款</a>
            </li>
            <li>
                <a href="javascript:void(0);">付款列表</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well">
                    <h2><i class="glyphicon glyphicon-lock"></i>&nbsp;付款列表</h2>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="搜索">
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-success" href="#">
                                <i class="glyphicon glyphicon-search icon-white"></i>
                                搜索
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-warning pull-right" href="#">
                                <i class="glyphicon glyphicon-plus icon-white"></i>
                                添加
                            </a>
                        </div>
                    </div>
                    <hr />
                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Date registered</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Brown Robert</td>
                            <td class="center">2012/03/01</td>
                            <td class="center">Member</td>
                            <td class="center">
                                <span class="label-warning label label-default">Pending</span>
                            </td>
                            <td class="center">
                                <a class="btn btn-primary" href="#">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Edit
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <ul class="pagination pagination-centered">
                        <li><a href="#">上一页</a></li>
                        <li class="active">
                            <a href="#">1</a>
                        </li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">下一页</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>