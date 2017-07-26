<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="layui-body site-demo" id="userlist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <section class="panel panel-padding">
                <select class="layui-btn layui-btn-small layui-btn-primary ajax-all" v-model="search.pageSize" v-on:change="changelist()">
                    <option value="<?php echo e(config('admin.global.pagination.pageSize')); ?>" selected><?php echo trans('admin/setting.page'); ?></option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                </select>
                <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" @click="allDelete()">
                    <i class="fa fa-trash"></i><?php echo trans('admin/setting.all_delete'); ?>

                </button>
                <button class="layui-btn layui-btn-small modal-catch" data-params='{"content":"#useraddhtml","area":"400px,300px", "title":"<?php echo trans("admin/user.create"); ?>","type":"1"}'>
                    <i class="fa fa-plus-square"></i> <?php echo trans('admin/setting.add'); ?>

                </button>
            </div>
            <div id="list" class="layui-form">
                <table id="example" class="layui-table lay-even">
                    <thead>
                        <tr>
                            <th width="30"><input type="checkbox" id="checkall" data-name="checkbox" lay-filter="allChoose" lay-skin="primary"></th>
                            <th width="60"><?php echo trans('admin/user.model.id'); ?></th>
                            <th><?php echo trans('admin/user.model.username'); ?></th>
                            <th><?php echo trans('admin/user.model.name'); ?></th>
                            <th><?php echo trans('admin/user.role'); ?></th>
                            <th><?php echo trans('admin/setting.make'); ?></th>
                        </tr>
                    </thead>
                    <tbody style="display: none">
                        <tr v-for="vo in user">
                            <td width="30"><input type="checkbox" name="checkbox" value="" lay-skin="primary"></td>
                            <td width="60">{{vo.id}}</td>
                            <td>{{vo.username}}</td>
                            <td>{{vo.name}}</td>
                            <td width="70">
                                <button class="layui-btn" @click="role(vo.id)">
                                    <?php echo trans('admin/user.user_role'); ?>

                                </button>
                            </td>
                            <td width="152">
                                <div class="layui-btn-group">
                                    <button class="layui-btn layui-btn-primary layui-btn-small" @click="edithtml(vo.id)"><i class="layui-icon"></i></button>
                                    <button class="layui-btn layui-btn-danger layui-btn-small" @click="elDelete(vo.id)"><i class="layui-icon"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-right" id="page"></div>
        </section>
        </div>
    </div>
    
    
    
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('my-js'); ?>
<script>
    layui.extend({
        'user': 'js/user/user',
    }).use(['user']);
</script>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.user.role', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('admin.user.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('admin.user.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>