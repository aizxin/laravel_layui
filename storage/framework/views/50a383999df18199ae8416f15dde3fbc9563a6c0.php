<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="site-demo">
    <div class="layui-tab-content" id="addpermission" style="padding: 20px;">
        <section class="panel panel-padding">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo trans('admin/role.model.name'); ?></label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="<?php echo trans('admin/role.placeholder.name'); ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo trans('admin/role.model.slug'); ?></label>
                    <div class="layui-input-inline">
                        <input type="text" name="slug" lay-verify="required" placeholder="<?php echo trans('admin/role.placeholder.slug'); ?>" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label"><?php echo trans('admin/role.model.description'); ?></label>
                    <div class="layui-input-block">
                        <textarea placeholder="<?php echo trans('admin/role.placeholder.description'); ?>" name="description" class="layui-textarea" lay-verify="required" style="width: 190px;"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="roleadd"><?php echo trans('admin/setting.save'); ?></button>
                        <button type="reset" class="layui-btn layui-btn-primary"><?php echo trans('admin/setting.reset'); ?></button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('my-js'); ?>
<script src="<?php echo e(asset('back/js/role/role-add.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>