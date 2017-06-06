/**
 *  公用列表
 */
layui.define(['global', 'form', 'laypage', 'laytpl'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        laypage = layui.laypage,
        laytpl = layui.laytpl;
    $(function() {
        // 角色修改视图vue
        var roleedithtml = new Vue({
            el: '#roleedithtml',
            data: {
                elrole: {},
            },
            methods: {
                rolehtml: function(id) {
                    var _this = this;
                    axios.get(Aizxin.U('role') + '/' + id)
                        .then(function(response) {
                            _this.$set('elrole', response.data.role);
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
            }
        });
        // 角色列表vue
        var aroleList = new Vue({
            el: '#rolelist',
            data: {
                role: [],
                search: {
                    pageSize: 15
                },
                pages: 10
            },
            created: function() {
                this.list();
            },
            methods: {
                // 页数
                changelist: function() {
                    this.search.page = 1;
                    this.list();
                },
                // 列表
                list: function() {
                    var index = layer.load(1);
                    var _this = this;
                    axios.post(Aizxin.U('role/index'), this.search)
                        .then(function(response) {
                            if (_this.pages != response.data.data.last_page) {
                                _this.$set('pages', response.data.data.last_page);
                                _this.page();
                            }
                            setTimeout(function() {
                                layer.close(index);
                                $('#list').find('tbody').css('display', 'table-row-group');
                                _this.$set('role', response.data.data.data);
                            }, 1000);
                            form.render();
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                // 分页
                page: function() {
                    var _this = this;
                    laypage({
                        cont: 'page',
                        pages: this.pages,
                        skip: true,
                        jump: function(obj, first) {
                            if (!first) {
                                _this.search.page = obj.curr;
                                _this.list();
                            }
                        }
                    });
                },
                // 批量删除
                allDelete: function() {
                    var ids = [];
                    var child = $('#list').find('tbody input[type="checkbox"]');
                    child.each(function(index, item) {
                        if (item.checked) {
                            ids.push(item.value)
                        }
                    });
                    if (!ids.length) {
                        layer.msg('没有删除的节点', {
                            icon: 5
                        });
                        return;
                    };
                    this.elDelete(ids.join(","));
                },
                // 单删除
                elDelete: function(id) {
                    var _this = this;
                    layer.confirm('确认是否删除', {
                        icon: 1,
                        title: '删除角色'
                    }, function(index) {
                        axios.delete(Aizxin.U('role') + '/' + id).then(function(response) {
                                layer.close(index);
                                if (response.data.code == 200) {
                                    layer.msg(response.data.message, {
                                        icon: 2
                                    })
                                    _this.list();
                                } else {
                                    layer.msg(response.data.message, {
                                        icon: 5
                                    })
                                }
                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    });
                },
                // 角色修改的open
                edithtml: function(id) {
                    layer.open({
                        type: 1,
                        title: '角色修改',
                        full: false,
                        shadeClose: true,
                        shade: 0.3,
                        content: $('#roleedithtml'),
                        area: ['400px', '400px'],
                        anim: 5,
                        success: function(layero, index) {
                            $('#roleeditreset')[0].reset();
                            roleedithtml.rolehtml(id);
                        }
                    });
                },
                // 权限分配
                permission: function(id) {
                    var indexload = layer.load(1);
                    var permission = [];
                    layer.open({
                        type: 1,
                        title: '角色权限',
                        full: false,
                        shadeClose: true,
                        shade: 0.3,
                        content: $('#rolepermissionhtml'),
                        area: ['800px', '800px'],
                        anim: 5,
                        success: function(layero, index) {
                            axios.get(Aizxin.U('role')+'/'+id+'/edit').then(function(response) {
                                if (response.data.code == 200) {
                                    permission = response.data.permission;
                                }
                            });
                            axios.get(Aizxin.U('role/create')).then(function(response) {
                                layer.close(indexload);
                                var getTpl = rolepermissionhtml.innerHTML;
                                laytpl(getTpl).render(response.data, function(html) {
                                    rolepermissionhtml.innerHTML = html;
                                    if (permission.length) {
                                        for (var i = 0; i < permission.length; i++) {
                                            $('#role' + permission[i]).prop('checked', true);
                                        }
                                    }
                                    $('#roleId').val(id)
                                    form.render();
                                });
                            })
                            .catch(function(error) {
                                layer.closeAll();
                                layer.msg('系统错误', {
                                    icon: 5
                                });
                            });
                        }
                    });
                }
            }
        });
        //全选
        form.on('checkbox(allChoose)', function(data) {
            var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
            child.each(function(index, item) {
                item.checked = data.elem.checked;
            });
            form.render('checkbox');
        });
        //角色添加 监听提交
        form.on('submit(roleadd)', function(data) {
            var index = layer.load(1);
            axios.post(Aizxin.U('role'), data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        layer.msg(response.data.message, {
                            time: 2000
                        }, function() {
                            aroleList.list();
                            layer.closeAll();
                        });
                    } else {
                        layer.msg(response.data.message, {
                            icon: 5
                        });
                    }
                }).catch(function(error) {
                    layer.close(index);
                    layer.msg('系统错误', {
                        icon: 5
                    });
                });
            return false;
        });
        //角色修改 监听提交
        form.on('submit(roleedit)', function(data) {
            var index = layer.load(1);
            axios.put(Aizxin.U('role') + "/" + data.field.id, data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        layer.msg(response.data.message, {
                            time: 2000
                        }, function() {
                            aroleList.list();
                            layer.closeAll();
                        });
                    } else {
                        layer.msg(response.data.message, {
                            icon: 5
                        });
                    }
                }).catch(function(error) {
                    layer.close(index);
                    layer.msg('系统错误', {
                        icon: 5
                    });
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
            axios.post(Aizxin.U('role/permission'), data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        layer.msg(response.data.message, {
                            time: 2000
                        }, function() {
                            layer.closeAll();
                        });
                    } else {
                        layer.msg(response.data.message, {
                            icon: 5
                        });
                    }
                }).catch(function(error) {
                    layer.close(index);
                    layer.msg('系统错误', {
                        icon: 5
                    });
                });
            return false;
        });
    });
    exports('role', {});
});