/**
 *  公用列表
 */
layui.define(['form', 'aizxin', 'lang'], function(exports) {
    var $ = layui.jquery,
        form = layui.form(),
        aizxin = layui.aizxin,
        lang = layui.lang;
    $(function() {
        var ids = $('#ids').val();
        if (ids.length > 0) {
            var permission = ids.split(",");
            for (var i = 0; i < permission.length; i++) {
                $('#role' + permission[i]).prop('checked', true);
            }
            form.render();
        }
        //角色添加 监听提交
        form.on('submit(roleadd)', function(data) {
            var index = layer.load(1);
            axios.post(aizxin.U('role'), data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        aizxin.msgS(6, response.data.message, function() {
                            top.layer.closeAll();
                            top.vn.list();
                        })
                    } else {
                        layer.close(index)
                        aizxin.msgE(5, response.data.message)
                    }
                }).catch(function(error) {
                    layer.close(index);
                    aizxin.msgE(5, lang.sys.error)
                });
            return false;
        });
        //角色修改 监听提交
        form.on('submit(roleedit)', function(data) {
            var index = layer.load(1);
            axios.put(aizxin.U('role') + "/" + data.field.id, data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        aizxin.msgS(6, response.data.message, function() {
                            top.layer.closeAll();
                            top.vn.list();
                        })
                    } else {
                        layer.close(index)
                        aizxin.msgE(5, response.data.message)
                    }
                }).catch(function(error) {
                    layer.close(index);
                    aizxin.msgE(5, lang.sys.error)
                });
            return false;
        });
        // 角色权限 监听权限选择
        form.on('checkbox(role)', function(data) {
            //单击顶级菜单
            var el = $(data.elem).parent('cite').parent('a').parent('li');
            if (el.length > 0) {
                el.find("ul").each(function(i, n) {
                    $(n).find('input').prop("checked", function() {
                        return data.elem.checked;
                    });
                })
            }
            //单击二级菜单
            var eel = el.parent('ul').parent("li");
            if (eel.length > 0) {
                var had_check = true;
                eel.children('ul').find('li').each(function(i, n) {
                    if ($(n).find('input').prop("checked") && !data.elem.checked) {
                        had_check = false;
                    }
                })
                if (had_check) {
                    eel.children('a').find('input').prop("checked", function() {
                        return data.elem.checked;
                    });
                }
            }
            // 单击三级菜单
            var sel = eel.parent('ul').parent("li");
            if (sel.length > 0) {
                var had_check = true;
                sel.children('ul').find('li').each(function(i, n) {
                    if ($(n).find('input').prop("checked") && !data.elem.checked) {
                        had_check = false;
                    }
                })
                if (had_check) {
                    sel.children('a').find('input').prop("checked", function() {
                        return data.elem.checked;
                    });
                }
            }

            form.render();
        });
        //角色权限 监听提交
        form.on('submit(rolepermissionadd)', function(data) {
            var index = layer.load(1);
            axios.post(aizxin.U('role/permission'), data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        aizxin.msgS(6, response.data.message, function() {
                            top.layer.closeAll();
                        })
                    } else {
                        layer.close(index)
                        aizxin.msgE(5, response.data.message)
                    }
                }).catch(function(error) {
                    layer.close(index);
                    aizxin.msgE(5, lang.sys.error)
                });
            return false;
        });
    });
    exports('role-add', {});
});