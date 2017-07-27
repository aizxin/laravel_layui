<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="site-demo">
    <div class="layui-tab-content" id="adduser" style="padding: 20px;">
        <section class="panel panel-padding">
            <form class="layui-form" id="usereditreset">
                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo trans('admin/user.model.name'); ?></label>
                    <div class="layui-input-inline">
                        <input type="text" name="username" lay-verify="required" autocomplete="off" placeholder="<?php echo trans('admin/user.placeholder.username'); ?>" value="<?php echo e($user->username); ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo trans('admin/user.model.name'); ?></label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="<?php echo trans('admin/user.placeholder.name'); ?>" value="<?php echo e($user->name); ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo trans('admin/user.model.password'); ?></label>
                    <div class="layui-input-inline">
                        <input type="text" name="password" lay-verify="required|pass" autocomplete="off" placeholder="<?php echo trans('admin/user.placeholder.password'); ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="useredit"><?php echo trans('admin/setting.resave'); ?></button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('my-js'); ?>
<script src="<?php echo e(asset('back/js/user/user-save.js')); ?>"></script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>