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
            select: '请选择'
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
        team: {
            index: '队伍',
            detail: '队伍详情',
            delE: '没有删除的队伍',
        },
        orders: {
            index: '订单',
            delE: '没有删除的订单',
        },
        award: {
            index: '奖励',
            hand: '确认奖励已发送',
            delE: '没有删除的奖励',
        },
        apply: {
            index: '报名',
            delE: '没有删除的报名',
        },
        feedback: {
            index: '反馈信息',
            delE: '没有删除的反馈信息',
        },
        activity: {
            index: '活动',
            delE: '没有删除的活动',
            create: '活动添加',
            edit: '活动编辑',
        },
        verify: {

        }
    };
    exports('lang', lang);
});