<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $menuPresenter = app('Aizxin\Presenters\MenuPresenter'); ?>
<div class="layui-body site-demo">
    <div class="layui-tab-content" id="addpermission" style="padding: 50px;">
        <section class="panel panel-padding">
            <div class="group-button">
                <span class="layui-btn layui-btn-small layui-btn-primary ajax-all">
                   <?php echo trans('admin/permission.edit'); ?>

                </span>
            </div>
            <form class="layui-form" style="padding: 17px;">
                <input type="hidden" name="id" value="<?php echo e($per->id); ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo trans('admin/permission.model.parent_id'); ?></label>
                    <div class="layui-input-inline">
                        <select name="parent_id" lay-verify="required" lay-search="">
                            <?php echo $menuPresenter->topMenuList($permission,$per->parent_id); ?>

                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo trans('admin/permission.model.name'); ?></label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="<?php echo trans('admin/permission.placeholder.name'); ?>" class="layui-input" value="<?php echo e($per->name); ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo trans('admin/permission.model.slug'); ?></label>
                    <div class="layui-input-inline">
                        <input type="text" name="slug" lay-verify="required" placeholder="<?php echo trans('admin/permission.placeholder.slug'); ?>" autocomplete="off" class="layui-input" value="<?php echo e($per->slug); ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo trans('admin/permission.model.ismenu'); ?></label>
                    <div class="layui-input-block">
                        <input name="ismenu" lay-skin="switch" lay-text="<?php echo trans('admin/setting.yes'); ?>|<?php echo trans('admin/setting.no'); ?>" type="checkbox" <?php echo $per->ismenu?'checked':'' ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo trans('admin/permission.model.issort'); ?></label>
                    <div class="layui-input-inline">
                        <input type="text" name="issort" lay-verify="required" placeholder="<?php echo trans('admin/permission.placeholder.issort'); ?>" autocomplete="off" class="layui-input" value="<?php echo e($per->issort); ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                      <label class="layui-form-label"><?php echo trans('admin/permission.model.icon'); ?></label>
                      <div class="layui-input-block">
                        <input type="text" name="icon" placeholder="<?php echo trans('admin/permission.placeholder.icon'); ?>" autocomplete="off" class="layui-input-inline layui-input" value="<?php echo e($per->icon); ?>">
                        <span class='layui-btn layui-btn-primary' style='padding:0 12px;min-width:45.2px'>
                            <i id='icon-preview' style='font-size:1.2em' class='<?php echo e($per->icon); ?>'></i>
                        </span>
                        <button type='button' data-icon='icon' class='layui-btn layui-btn-primary'><?php echo trans('admin/setting.select_icon'); ?></button>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label"><?php echo trans('admin/permission.model.description'); ?></label>
                    <div class="layui-input-block">
                        <textarea placeholder="<?php echo trans('admin/permission.placeholder.description'); ?>" name="description" class="layui-textarea" style="width: 20%"><?php echo e($per->description); ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="editpermissionupdate"><?php echo trans('admin/setting.resave'); ?></button>
                        <!-- <button type="reset" class="layui-btn layui-btn-primary"><?php echo trans('admin/setting.reset'); ?></button> -->
                        <a onclick="window.history.go(-1)" class="layui-btn layui-btn-primary"><?php echo trans('admin/setting.goback'); ?></a>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('my-js'); ?>
<script>
    layui.extend({
        'permission-add': 'js/permission/permission-add'
    }).use(['permission-add'])
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>