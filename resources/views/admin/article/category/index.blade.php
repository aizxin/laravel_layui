@extends('layouts.admin')
@section('style')
<style type="text/css" media="screen">
	.i-size {
		font-size: 23px;
	}
	.i-size em{
		font-size: 16px;
	}
</style>
@endsection
@section('content')
<div class="layui-body site-demo" id="articleCategoryList">
    <div class="site-demo-area">
        <div class="layui-tab-content" style="padding: 16px;">
            <div class="container-fluid larry-wrapper">
                <!--列表-->
                <section class="panel panel-padding">
                	<div class="group-button">
                        <button class="layui-btn layui-btn-small" id="btn-showarticle">
                            <i class="fa fa-plus-square"></i> 添加
                        </button>
                    </div>
                    <div style="display: inline-block; padding: 10px;">
                        <ul class="layui-box layui-tree">
                            <li v-for = 'vo in category'>
                            	<i class="fa i-size" v-bind:class="[$index == iSndex?'fa-caret-down':'fa-caret-right']" @click="showChild($index,vo.child,'iSndex')"></i>
                            	<a href="javascript:;">
                            		<cite>@{{vo.name}}</cite>
                            		<!-- <i class="fa fa-plus-square i-size" @click="addCategory(vo)"></i> -->
                            		<i class="fa fa-check-square-o i-size" @click="editCategory(vo)"></i>
                            		<i class="fa fa-trash i-size" @click="deleteCategory(vo)"></i>
                            	</a>
                                <ul v-bind:class="[$index == iSndex?'layui-show':'']">
                                    <li v-for = 'v in vo.child'>
                                    	<i class="fa i-size" v-bind:class="[$index == eliSndex?'fa-caret-down':'fa-caret-right']" @click="elShowChild($index,v.child)"></i>
		                            	<a href="javascript:;">
		                            		<cite>@{{v.name}}</cite>
		                            		<!-- <i class="fa fa-plus-square i-size" @click="addCategory(v)"></i> -->
		                            		<i class="fa fa-check-square-o i-size" @click="editCategory(v)"></i>
		                            		<i class="fa fa-trash i-size" @click="deleteCategory(v)"></i>
		                            	</a>
		                            	<ul v-bind:class="[$index == eliSndex?'layui-show':'']">
		                                    <li v-for = 'vt in v.child'>
		                                    	<i class="fa i-size" v-bind:class="[$index == sliSndex?'fa-caret-down':'fa-caret-right']" @click="slShowChild($index,vt.child)"></i>
				                            	<a href="javascript:;">
				                            		<cite>@{{vt.name}}</cite>
				                            		<i class="fa fa-check-square-o i-size" @click="editCategory(vt)"></i>
				                            		<i class="fa fa-trash i-size" @click="deleteCategory(vt)"></i>
				                            	</a>
		                                    </li>
		                                </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="site-demo-result">
        <div class="layui-tab-content" style="padding: 16px;">
        	<div class="container-fluid larry-wrapper">
	            <section class="panel panel-padding">
			        <form class="layui-form" id="ArticleCategoryReset">
			        	<input type="hidden" name="id" value="0" id="acid">
			            <div class="layui-form-item">
			                <label class="layui-form-label">顶级分类</label>
			                <div class="layui-input-inline" id="selectParentId">
			                </div>
			            </div>
			            <div class="layui-form-item">
			                <div class="layui-inline">
			                    <label class="layui-form-label">分类名称</label>
			                    <div class="layui-input-inline">
			                        <input type="text" name="name" id="acname" lay-verify="required" autocomplete="off" class="layui-input">
			                    </div>
			                </div>
			            </div>
			            <div class="layui-form-item">
			                <label class="layui-form-label">是否显藏</label>
			                <div class="layui-input-block">
			                    <input type="checkbox" name="status" id="acopen" lay-skin="switch" lay-verify="required" lay-filter="switchTest" lay-text="显示|隐藏">
			                </div>
			            </div>
			            <div class="layui-form-item">
			                <div class="layui-input-block">
			                    <button class="layui-btn" lay-submit="" lay-filter="addArticleCategory">立即提交</button>
			                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
			                </div>
			            </div>
			        </form>
			    </section>
			</div>
        </div>
    </div>
</div>
@endsection @section('my-js')
<script>
    layui.extend({
        'article-category': 'js/article/article-category'
    }).use(['article-category']);
</script>
@endsection
