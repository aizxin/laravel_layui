<?php $__env->startSection('style'); ?>
<style type="text/css">
    .layui-tree li i {
        padding-left: 2px;
        color: #fff;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="layui-body site-demo" id="rolelist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!--列表-->
                    <section class="panel panel-padding">
                        <div class="group-button">
                            <select class="layui-btn layui-btn-small layui-btn-primary ajax-all" v-model="search.pageSize" v-on:change="changelist()">
                                <option value="<?php echo e(config('admin.global.pagination.pageSize')); ?>" selected><?php echo trans('admin/setting.page'); ?></option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                            </select>
                            <?php if (Auth::check() && Auth::user()->hasPermission('role.destroy')): ?>
                            <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" @click="allDelete()">
                                <i class="fa fa-trash"></i><?php echo trans('admin/setting.all_delete'); ?>

                            </button>
                            <?php endif; ?>
                            <?php if (Auth::check() && Auth::user()->hasPermission('role.create')): ?>
                            <button class="layui-btn layui-btn-small" @click="addhtml()">
                                <i class="fa fa-plus-square"></i> <?php echo trans('admin/setting.add'); ?>

                            </button>
                            <?php endif; ?>
                        </div>
                        <div id="list" class="layui-form">
                            <table id="example" class="layui-table lay-even">
                                <thead>
                                    <tr>
                                        <th width="30"><input type="checkbox" id="checkall" data-name="checkbox" lay-filter="allChoose" lay-skin="primary"></th>
                                        <th width="60"><?php echo trans('admin/role.model.id'); ?></th>
                                        <th><?php echo trans('admin/role.model.name'); ?></th>
                                        <th><?php echo trans('admin/role.model.slug'); ?></th>
                                        <?php if (Auth::check() && Auth::user()->hasPermission('role.show')): ?>
                                        <th><?php echo trans('admin/role.permission'); ?></th>
                                        <?php endif; ?>
                                        <th><?php echo trans('admin/setting.make'); ?></th>
                                    </tr>
                                </thead>
                                <tbody style="display: none">
                                    <tr v-for="vo in role">
                                        <td width="30"><input type="checkbox" data-name="{{vo.id+'checkbox'}}" value="{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                        <td width="60"><em v-text="vo.id"></em></td>
                                        <td><em v-text="vo.name"></em></td>
                                        <td><em v-text="vo.slug"></em></td>
                                        <?php if (Auth::check() && Auth::user()->hasPermission('role.show')): ?>
                                        <td>
                                            <button class="layui-btn" @click="permission(vo.id)">
                                                <?php echo trans('admin/role.permission_role'); ?>

                                            </button>
                                        </td>
                                        <?php endif; ?>
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
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('my-js'); ?>
<script src="<?php echo e(asset('back/js/role/role.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>