@extends('layouts.admin')
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
<div class="layui-body site-demo">
    <div class="layui-tab-content" id="addpermission" style="padding: 50px;">
        <section class="panel panel-padding">
            <div class="group-button">
                <span class="layui-btn layui-btn-small layui-btn-primary ajax-all">
                   {!!trans('admin/article.edit')!!}
                </span>
            </div>
            <form class="layui-form" style="padding: 17px;">
                <input type="hidden" name="id" value="{{$article->id}}">
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/article.model.articleCategoryId')!!}</label>
                    <div class="layui-input-inline">
                        <select name="articleCategoryId" lay-verify="required" lay-search="">
                            {!!$menuPresenter->topMenuList(trans('admin/article.menu'),$category,$article->articleCategoryId)!!}
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/article.model.title')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/article.placeholder.title')!!}" class="layui-input" value="{{$article->title}}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/article.model.thumb')!!}</label>
                    <div class="layui-input-inline">
                        <input name="thumb" class="layui-upload-file" id="article-upload" type="file" >
                        <div class="ad-upload" style="margin-top: 5px;">
                            <i class="fa fa-close i-delete" id="adadddel" <?php if($article->thumb == ''){ echo 'style = "display:none"';} ?>></i>
                            <img id="LAY_demo_upload" src="{{$article->thumb}}" <?php if($article->thumb == ''){ echo 'style = "display:none"';} ?>>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">{!!trans('admin/article.model.content')!!}</label>
                    <div class="layui-input-block">
                        <div style="margin-bottom: 20px;">
                            <div id="article-content">{!! $article->content !!}</div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="editarticleupdate">{!!trans('admin/setting.resave')!!}</button>
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
<script>
    layui.extend({
        'article-add': 'js/article/article-add'
    }).use(['article-add']);
</script>
@endsection

