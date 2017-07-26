@extends('layouts.common')
@section('style')
@endsection
@section('content')
@inject('menuPresenter','Aizxin\Presenters\MenuPresenter')
<div class="site-demo">
    <div class="layui-tab-content" id="addpermission" style="padding: 20px;">
        <section class="panel panel-padding">
            <form class="layui-form" style="padding: 17px;">
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/permission.model.parent_id')!!}</label>
                    <div class="layui-input-inline">
                        <select name="parent_id" lay-verify="required" lay-search="">
                            {!!$menuPresenter->topMenuList($permission)!!}
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/permission.model.name')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/permission.placeholder.name')!!}" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/permission.model.slug')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="slug" lay-verify="required" placeholder="{!!trans('admin/permission.placeholder.slug')!!}" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/permission.model.ismenu')!!}</label>
                    <div class="layui-input-block">
                        <input name="ismenu" lay-skin="switch" lay-filter="switchTest" lay-text="{!!trans('admin/setting.no')!!}|{!!trans('admin/setting.yes')!!}" type="checkbox">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/permission.model.issort')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="issort" lay-verify="required" placeholder="{!!trans('admin/permission.placeholder.issort')!!}" autocomplete="off" class="layui-input" value="1">
                    </div>
                </div>
                <div class="layui-form-item">
                      <label class="layui-form-label">{!!trans('admin/permission.model.icon')!!}</label>
                      <div class="layui-input-block">
                        <input type="text" name="icon" placeholder="{!!trans('admin/permission.placeholder.icon')!!}" autocomplete="off" class="layui-input-inline layui-input">
                        <span class='layui-btn layui-btn-primary' style='padding:0 12px;min-width:45.2px'>
                            <i id='icon-preview' style='font-size:1.2em' class=''></i>
                        </span>
                        <button type='button' data-icon='icon' class='layui-btn layui-btn-primary'>{!!trans('admin/setting.select_icon')!!}</button>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">{!!trans('admin/permission.model.description')!!}</label>
                    <div class="layui-input-block">
                        <textarea placeholder="{!!trans('admin/permission.placeholder.description')!!}" name="description" class="layui-textarea" style="width: 60%"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="addpermissionstore">{!!trans('admin/setting.save')!!}</button>
                        <button type="reset" class="layui-btn layui-btn-primary">{!!trans('admin/setting.reset')!!}</button>
                        <a onclick="window.history.go(-1)" class="layui-btn layui-btn-primary">{!!trans('admin/setting.goback')!!}</a>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
@section('my-js')
<script src="{{ asset('back/js/permission/permission-add.js') }}"></script>
@endsection

