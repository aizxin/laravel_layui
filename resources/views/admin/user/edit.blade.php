@extends('layouts.common')
@section('style')
@endsection
@section('content')
<div class="site-demo">
    <div class="layui-tab-content" id="adduser" style="padding: 20px;">
        <section class="panel panel-padding">
            <form class="layui-form" id="usereditreset">
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/user.model.name')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="username" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/user.placeholder.username')!!}" value="{{ $user->username }}" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/user.model.name')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/user.placeholder.name')!!}" value="{{ $user->name }}" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/user.model.password')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="password" lay-verify="required|pass" autocomplete="off" placeholder="{!!trans('admin/user.placeholder.password')!!}" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="useredit">{!!trans('admin/setting.resave')!!}</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
@section('my-js')
<script src="{{ asset('back/js/user/user-save.js') }}"></script>
@endsection


