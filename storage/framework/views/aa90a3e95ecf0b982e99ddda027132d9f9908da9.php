<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="site-demo">
    <div class="layui-tab-content" id="adduser" style="padding: 20px;">
        <section class="panel panel-padding">
            <form class="layui-form" id="userrolereset">
                <input type="hidden" name="id" id="userId" value="<?php echo e($id); ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo trans('admin/user.user_role'); ?></label>
                    <div class="layui-input-inline">
                        <select name="role" lay-filter="roleselect">
                            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item['id']); ?>" <?php echo isset($role['id']) && $item['id'] == $role['id'] ? 'selected' : '';?>><?php echo e($item['name']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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