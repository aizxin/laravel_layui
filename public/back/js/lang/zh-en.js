/**

 @Name：layui.sow 工具集
 @Author：Sow
 @License：MIT

*/

layui.define('jquery', function(exports) {
    "use strict";
    var $ = layui.jquery;
    var lang = lang || {};
    lang = {
        sys: {
            error: '系统错误',
            del: '确认是否删除',
            clear: '删除',
            select: '请选择',
            title: '提示'
        },
        setting: {

        },
        user: {
            login: '登录',
            index: '管理员',
            create: '管理员添加',
            edit: '管理员修改',
            delE: '没有删除的管理员',
            role: '管理员角色分配',
        },
        permission: {
            index: '权限',
            create: '权限添加',
            icon: '图标选择',
            edit: '权限修改',
            delE: '没有删除的权限',
        },
        role: {
            index: '角色',
            create: '角色添加',
            edit: '角色修改',
            delE: '没有删除的角色',
            permission: '角色权限分配'
        },
        article: {
            childE: '有子分类,不能删除',
            index: '分类',
            parent: '顶级分类',
            sort: '确认修改排序?',
            create: '文章添加',
            edit: '文章修改',
            delE: '没有删除的文章',
            article: '文章'
        },
        verify: {

        }
    };
    exports('lang', lang);
});