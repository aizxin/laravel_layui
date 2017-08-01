<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="layui-body site-demo" id="articlelist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <!--列表-->
            <section class="panel panel-padding">
                <div class="group-button">
                    <select class="layui-btn layui-btn-small layui-btn-primary ajax-all" v-model="search.pageSize" v-on:change="changelist()">
                        <option value="<?php echo e(config('admin.global.pagination.pageSize')); ?>" selected><?php echo trans('admin/setting.page'); ?></option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                    </select>
                    <?php if (Auth::check() && Auth::user()->hasPermission('article.destroy')): ?>
                    <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" @click="allDelete()">
                        <i class="fa fa-trash"></i><?php echo trans('admin/setting.all_delete'); ?>

                    </button>
                    <?php endif; ?>
                    <?php if (Auth::check() && Auth::user()->hasPermission('article.create')): ?>
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
                                <th width="60"><?php echo trans('admin/article.model.id'); ?></th>
                                <th><?php echo trans('admin/article.model.title'); ?></th>
                                <th><?php echo trans('admin/article.model.author'); ?></th>
                                <th><?php echo trans('admin/article.category'); ?></th>
                                <th><?php echo trans('admin/setting.sort'); ?></th>
                                <th><?php echo trans('admin/setting.make'); ?></th>
                            </tr>
                        </thead>
                        <tbody style="display: none">
                            <tr v-for="vo in article">
                                <td width="30"><input type="checkbox" data-name="{{vo.id+'checkbox'}}" value="{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                <td width="60"><em v-text="vo.id"></em></td>
                                <td><em v-text="vo.title"></em></td>
                                <td><em v-text="vo.author"></em></td>
                                <td><em v-text="vo.category.name"></em></td>
                                <td><input type="text" v-model="vo.rank" @input="sortArticle(vo)" class="layui-input" style="width: 50px"></td>
                                <td width="152">
                                    <div class="layui-btn-group">
                                    <?php if (Auth::check() && Auth::user()->hasPermission('article.edit')): ?>
                                        <button @click="edithtml(vo.id)" class="layui-btn layui-btn-primary layui-btn-small"><i class="layui-icon"></i></button>
                                    <?php endif; ?>
                                    <?php if (Auth::check() && Auth::user()->hasPermission('article.destroy')): ?>
                                        <button class="layui-btn layui-btn-danger layui-btn-small" @click="elDelete(vo.id)"><i class="layui-icon"></i></button>
                                    <?php endif; ?>
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
<script src="<?php echo e(asset('back/js/article/article-index.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>