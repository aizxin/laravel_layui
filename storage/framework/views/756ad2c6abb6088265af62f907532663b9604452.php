<?php $__env->startSection('style'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('back/plugin/wangEditor/css/wangEditor.min.css')); ?>">
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
    @media  screen and (min-width: 750px){
        .content-cheat{
            width:50%
        }
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $menuPresenter = app('Aizxin\Presenters\MenuPresenter'); ?>
<div class="site-demo">
    <div class="layui-tab-content" id="addpermission" style="padding: 20px;">
        <section class="panel panel-padding">
            <form class="layui-form" style="padding: 17px;">
                <input type="hidden" name="id" value="<?php echo e($article->id); ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo trans('admin/article.model.articleCategoryId'); ?></label>
                    <div class="layui-input-inline">
                        <select name="articleCategoryId" lay-verify="required" lay-search="">
                            <?php echo $menuPresenter->topCateList(trans('admin/article.menu'),$category,$article->articleCategoryId); ?>

                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo trans('admin/article.model.title'); ?></label>
                    <div class="layui-input-inline">
                        <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="<?php echo trans('admin/article.placeholder.title'); ?>" class="layui-input" value="<?php echo e($article->title); ?>">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label"><?php echo trans('admin/article.model.content'); ?></label>
                    <div class="layui-input-block">
                        <div style="margin-bottom: 20px;">
                            <div id="article-content"><?php echo $article->content; ?></div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="editarticleupdate"><?php echo trans('admin/setting.resave'); ?></button>
                        <a onclick="window.history.go(-1)" class="layui-btn layui-btn-primary"><?php echo trans('admin/setting.goback'); ?></a>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('my-js'); ?>
<script type="text/javascript" src="<?php echo e(asset('back/plugin/wangEditor/js/lib/jquery-1.10.2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('back/plugin/wangEditor/js/wangEditor.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('back/plugin/qiniu/js/plupload.full.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('back/plugin/qiniu/js/i18n/zh_CN.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('back/plugin/qiniu/qiniu.js')); ?>"></script>
<script src="<?php echo e(asset('back/js/article/article-add.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>