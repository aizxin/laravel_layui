@extends('layouts.admin')
@section('style')
<style type="text/css">

    .layui-tree li i {
        padding-left: 2px;
        color: #fff;
    }
</style>
@endsection
@section('content')
<div class="layui-body site-demo" id="rolelist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!--列表-->
                    <section class="panel panel-padding">
                        <div class="group-button">
                            <select class="layui-btn layui-btn-small layui-btn-primary ajax-all" v-model="search.pageSize" v-on:change="changelist()">
                                <option value="{{config('admin.global.pagination.pageSize')}}" selected>{!!trans('admin/setting.page')!!}</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                            </select>
                            @permission('role.destroy')
                            <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" @click="allDelete()">
                                <i class="fa fa-trash"></i>{!!trans('admin/setting.all_delete')!!}
                            </button>
                            @endpermission
                            @permission('role.create')
                            <button class="layui-btn layui-btn-small modal-catch" data-params='{"content":"#roleaddhtml","area":"400px,400px", "title":"{!!trans("admin/role.create")!!}","type":"1"}'>
                                <i class="fa fa-plus-square"></i> {!!trans('admin/setting.add')!!}
                            </button>
                            @endpermission
                        </div>
                        <div id="list" class="layui-form">
                            <table id="example" class="layui-table lay-even">
                                <thead>
                                    <tr>
                                        <th width="30"><input type="checkbox" id="checkall" data-name="checkbox" lay-filter="allChoose" lay-skin="primary"></th>
                                        <th width="60">{!!trans('admin/role.model.id')!!}</th>
                                        <th>{!!trans('admin/role.model.name')!!}</th>
                                        <th>{!!trans('admin/role.model.slug')!!}</th>
                                        @permission('role.permission')
                                        <th>{!!trans('admin/role.permission')!!}</th>
                                        @endpermission
                                        <th>{!!trans('admin/setting.make')!!}</th>
                                    </tr>
                                </thead>
                                <tbody style="display: none">
                                    <tr v-for="vo in role">
                                        <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                        <td width="60"><em v-text="vo.id"></em></td>
                                        <td><em v-text="vo.name"></em></td>
                                        <td><em v-text="vo.slug"></em></td>
                                        @permission('role.permission')
                                        <td>
                                            <button class="layui-btn" @click="permission(vo.id)">
                                                {!!trans('admin/role.permission_role')!!}
                                            </button>
                                        </td>
                                        @endpermission
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
    @extends('admin.role.create')
    @extends('admin.role.edit')
    @extends('admin.role.permission')
</div>
@endsection
@section('my-js')
<script>
    layui.extend({
        'role': 'js/role/role'
    }).use(['role']);
</script>
@endsection
