/**
 *  公用列表
 */
layui.define(['form', 'laypage', 'aizxin', 'lang'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        aizxin = layui.aizxin,
        lang = layui.lang;
    $(function() {
        form.verify({
            username: function(value) {
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                    return '用户名不能有特殊字符';
                }
                if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                    return '用户名首尾不能出现下划线\'_\'';
                }
                if (/^\d+\d+\d$/.test(value)) {
                    return '用户名不能全为数字';
                }
            },
            pass: [/(.+){6,12}$/, '密码必须6到12位']
        });
        //角色添加 监听提交
        form.on('submit(useradd)', function(data) {
            var index = aizxin.load(1);
            axios.post(aizxin.U('user'), data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        aizxin.msgS(6, response.data.message, function() {
                            top.layer.closeAll();
                            top.vn.list();
                        });
                    } else {
                        layer.close(index);
                        aizxin.msgE(5, response.data.message);
                    }
                }).catch(function(error) {
                    layer.close(index);
                    aizxin.msgE(5, lang.sys.error);
                });
            return false;
        });
        //角色修改 监听提交
        form.on('submit(useredit)', function(data) {
            var index = aizxin.load(1);
            axios.put(aizxin.U('user') + "/" + data.field.id, data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        aizxin.msgS(6, response.data.message, function() {
                            top.layer.closeAll();
                            top.vn.list();
                        });
                    } else {
                        layer.close(index);
                        aizxin.msgE(5, response.data.message);
                    }
                }).catch(function(error) {
                    layer.close(index);
                    aizxin.msgE(5, lang.sys.error);
                });
            return false;
        });
        // 角色分配
        form.on('select(roleselect)', function(data) {
            var index = aizxin.load(1);
            var ids = {
                id: $('#userId').val(),
                role: data.value
            };
            axios.post(aizxin.U('user/role'), ids)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        aizxin.msgS(6, response.data.message, function() {
                            top.layer.closeAll();
                        });
                    } else {
                        layer.close(index);
                        aizxin.msgE(5, response.data.message);
                    }
                }).catch(function(error) {
                    layer.close(index);
                    aizxin.msgE(5, lang.sys.error);
                });
            return false;
        });
    });
    exports('user-save', {});
});