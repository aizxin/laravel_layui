@extends('layouts.common')
@section('style')
<style type="text/css" media="screen">
.layui-tree li i {
    padding-left: 2px;
    color: #fff;
}
ul.ztree li span.button.switch {
    margin-right: 5px
}

ul.ztree ul ul li {
    display: inline-block;
    white-space: normal
}

ul.ztree>li>ul>li {
    padding: 2px
}
ul.ztree>li>ul {
    margin-top: 2px
}

ul.ztree>li {
    padding: 2px;
    padding-right: 25px
}

ul.ztree li {
    white-space: normal!important
}

ul.ztree>li>a>span {
    font-size: 15px;
    font-weight: 700
}

.ztree li {
    padding: 2px;
    margin: 0;
    list-style: none;
    line-height: 14px;
    text-align: left;
    white-space: nowrap;
    outline: 0;
}

.ztree li ul {
    margin: 0;
    padding: 5px 0 0 18px;
}
</style>
@endsection
@section('content')
<div class="site-demo">
    <div class="layui-tab-content" id="addpermission" style="padding: 20px;">
        <section class="panel panel-padding">
            <input type="hidden" name="ids" id="ids" value="{{ $ids }}">
            <form class="layui-form">
                <div class="layui-form-item">
                    <input type="hidden" name="id" value="{{ $id }}">
                    <ul id="ztree" class="layui-box layui-tree ztree loading">
                    @foreach ($permission as $item)
                        <li><a><cite><input type="checkbox" name="role{{ $item['id'] }}" id="role{{ $item['id'] }}" title="{{ $item['name'] }}" value="{{ $item['id'] }}" lay-filter="role" lay-skin="primary"/></cite></a>
                            <ul class="layui-show">
                            @foreach ($item['child'] as $vo)
                                <li><a><cite><input type="checkbox" id="role{{ $vo['id'] }}" name="role{{ $vo['id'] }}" title="{{ $vo['name'] }}" value="{{ $vo['id'] }}" lay-filter="role" lay-skin="primary"/></cite></a>
                                    <ul class="layui-show">
                                    @foreach ($vo['child'] as $v)
                                    <li><a><cite><input id="role{{ $v['id'] }}" type="checkbox" name="role{{ $v['id'] }}" title="{{ $v['name'] }}" value="{{ $v['id'] }}" lay-filter="role" lay-skin="primary"/></cite></a></li>
                                    @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            </ul>
                        </li>
                    @endforeach
                    </ul>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="rolepermissionadd">{!!trans('admin/setting.save')!!}</button>
                        <button type="reset" class="layui-btn layui-btn-primary">{!!trans('admin/setting.reset')!!}</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
@section('my-js')
<script src="{{ asset('back/js/role/role-add.js') }}"></script>
@endsection

