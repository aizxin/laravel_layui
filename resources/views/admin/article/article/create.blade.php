@extends('layouts.common')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('back/plugin/wangEditor/css/wangEditor.min.css') }}">
<style type="text/css" media="screen">
    #article-content{
        width: 60%;
        height: 500px;
    }
    .layui-input-block {
        margin-left: 130px;
        min-height: 36px;
    }
    .ad-upload img{
        width: 200px;
        height: 150px
    }
    .ad-upload .i-delete {
        position: absolute;
        /*left: 0;*/
        font-size: 18px;
        color: red;
        cursor: pointer;
        display: none;
    }
    @media screen and (min-width: 750px){
        .content-cheat{
            width:50%
        }
    }
</style>
@endsection
@section('content')
@inject('menuPresenter','Aizxin\Presenters\MenuPresenter')
<div class="site-demo">
    <div class="layui-tab-content" id="addpermission" style="padding: 20px;">
        <section class="panel panel-padding">
            <form class="layui-form" style="padding: 17px;">
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/article.model.articleCategoryId')!!}</label>
                    <div class="layui-input-inline">
                        <select name="articleCategoryId" lay-verify="required" lay-search="">
                            {!!$menuPresenter->topCateList(trans('admin/article.menu'),$category)!!}
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/article.model.title')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/article.placeholder.title')!!}" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">{!!trans('admin/article.model.content')!!}</label>
                    <div class="layui-input-block">
                        <div style="margin-bottom: 20px;">
                            <div id="article-content"></div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="addarticlestore">{!!trans('admin/setting.save')!!}</button>
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
<script type="text/javascript" src="{{ asset('back/plugin/wangEditor/js/lib/jquery-1.10.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/plugin/wangEditor/js/wangEditor.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/plugin/qiniu/js/plupload.full.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/plugin/qiniu/js/i18n/zh_CN.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/plugin/qiniu/qiniu.js') }}"></script>
<script src="{{ asset('back/js/article/article-add.js') }}"></script>
@endsection

