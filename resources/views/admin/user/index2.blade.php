@extends('layouts.admin')
@section('style')
@endsection
@section('content')
<div class="layui-body site-demo">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!--头部搜索-->
                    <section class="panel panel-padding">
                        <form class="layui-form" >
                            <div class="layui-form">
                                <div class="layui-inline">
                                    <select name="city" lay-verify="required">
                                        <option value="0">请选择分类</option>
                                        <option value="010">北京</option>
                                        <option value="021">上海</option>
                                        <option value="0571">杭州</option>
                                    </select>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <input class="layui-input start-date" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="开始日">
                                    </div>
                                    <div class="layui-input-inline">
                                        <input class="layui-input end-date" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="截止日">
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <input class="layui-input" name="keyword" placeholder="关键字">
                                    </div>
                                </div>
                                <div class="layui-inline">
                                    <button lay-submit class="layui-btn" lay-filter="search">查找</button>
                                </div>
                            </div>
                        </form>
                    </section>

                    <!--列表-->
                    <section class="panel panel-padding">
                        <div class="group-button">
                            <select class="layui-btn layui-btn-small layui-btn-primary ajax-all">
                                <option value="0">页数</option>
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" data-name="checkbox" data-params='{"url": "/php/test.php","data":"id=1&name=ni&va=23","confirm":"true"}'>
                                <i class="iconfont">&#xe626;</i> 删除
                            </button>
                            <button class="layui-btn layui-btn-small layui-btn-normal ajax-all" data-name="checkbox" data-params='{"url": "/php/test.php","data":"id=1&name=hao","confirm":"true"}'>
                                <i class="iconfont">&#xe60c;</i> 推荐
                            </button>
                            <button class="layui-btn layui-btn-small layui-btn-normal ajax-all" data-name="checkbox" data-params='{"url": "/php/test.php","data":"id=1&name=hao&va=23"}'>
                                <i class="iconfont">&#xe603;</i> 置顶
                            </button>
                            <button class="layui-btn layui-btn-small layui-btn-normal ajax-all" data-name="checkbox" data-params='{"url": "/php/test.php","data":"id=1&name=hao&va=23"}'>
                                <i class="layui-icon">&#x1005;</i> 审核
                            </button>
                            <button class="layui-btn layui-btn-small" id="btn-showarticle">
                                <i class="iconfont">&#xe649;</i> 添加
                            </button>
                            <!-- <button class="layui-btn layui-btn-small modal-iframe" data-params='{"content": "/user/create", "title": "添加文章","full":"true"}'>
                                <i class="iconfont">&#xe649;</i> 添加
                            </button> -->
                        </div>
                        <div id="list" class="layui-form">
                            <table id="example" class="layui-table lay-even">
                                <thead>
                                    <tr>
                                        <th width="30"><input type="checkbox" id="checkall" data-name="checkbox" lay-filter="check" lay-skin="primary"></th>
                                        <th width="60">序号</th>
                                        <th>标题</th>
                                        <th>连接</th>
                                        <th width="70">排序</th>
                                        <th width="80">审核</th>
                                        <th width="152">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="30"><input type="checkbox" name="checkbox" value="" lay-skin="primary"></td>
                                        <td width="60">序号</td>
                                        <td>标题</td>
                                        <td>连接</td>
                                        <td width="70">排序</td>
                                        <td width="80">审核</td>
                                        <td width="152">操作</td>
                                    </tr>
                                    <tr>
                                        <td width="30"><input type="checkbox" name="checkbox" value="" lay-skin="primary"></td>
                                        <td width="60">序号</td>
                                        <td>标题</td>
                                        <td>连接</td>
                                        <td width="70">排序</td>
                                        <td width="80">审核</td>
                                        <td width="152">操作</td>
                                    </tr>
                                    <tr>
                                        <td width="30"><input type="checkbox" name="checkbox" value="" lay-skin="primary"></td>
                                        <td width="60">序号</td>
                                        <td>标题</td>
                                        <td>连接</td>
                                        <td width="70">排序</td>
                                        <td width="80">审核</td>
                                        <td width="152">操作</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right" id="page"></div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('ahtml')
    @include('admin.user.create')
@endsection
@section('my-js')
<script>
    layui.extend({
        'user-index': 'js/user/user-index',
        'user-add': 'js/user/user-add'
    }).use(['user-index','user-add']);
</script>
</script>
@endsection
