<?php $__env->startSection('style'); ?>
<style type="text/css" media="screen">
.layui-tree li i {
    padding-left: 2px;
    color: #fff;
}
ul.ztree li span.button.switch {
    margin-right: 5px
}

ul.ztree ul ul li {
    display: inline-block;
    white-space: normal
}

ul.ztree>li>ul>li {
    padding: 2px
}
ul.ztree>li>ul {
    margin-top: 2px
}

ul.ztree>li {
    padding: 2px;
    padding-right: 25px
}

ul.ztree li {
    white-space: normal!important
}

ul.ztree>li>a>span {
    font-size: 15px;
    font-weight: 700
}

.ztree li {
    padding: 2px;
    margin: 0;
    list-style: none;
    line-height: 14px;
    text-align: left;
    white-space: nowrap;
    outline: 0;
}

.ztree li ul {
    margin: 0;
    padding: 5px 0 0 18px;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="site-demo">
    <div class="layui-tab-content" id="addpermission" style="padding: 20px;">
        <section class="panel panel-padding">
            <input type="hidden" name="ids" id="ids" value="<?php echo e($ids); ?>">
            <form class="layui-form">
                <div class="layui-form-item">
                    <input type="hidden" name="id" id="<?php echo e($id); ?>">
                    <ul id="ztree" class="layui-box layui-tree ztree loading">
                    <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a><cite><input type="checkbox" name="role<?php echo e($item['id']); ?>" id="role<?php echo e($item['id']); ?>" title="<?php echo e($item['name']); ?>" value="<?php echo e($item['id']); ?>" lay-filter="role" lay-skin="primary"/></cite></a>
                            <ul class="layui-show">
                            <?php $__currentLoopData = $item['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a><cite><input type="checkbox" id="role<?php echo e($vo['id']); ?>" name="role<?php echo e($vo['id']); ?>" title="<?php echo e($vo['name']); ?>" value="<?php echo e($vo['id']); ?>" lay-filter="role" lay-skin="primary"/></cite></a>
                                    <ul class="layui-show">
                                    <?php $__currentLoopData = $vo['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a><cite><input id="role<?php echo e($v['id']); ?>" type="checkbox" name="role<?php echo e($v['id']); ?>" title="<?php echo e($v['name']); ?>" value="<?php echo e($v['id']); ?>" lay-filter="role" lay-skin="primary"/></cite></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="rolepermissionadd"><?php echo trans('admin/setting.save'); ?></button>
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