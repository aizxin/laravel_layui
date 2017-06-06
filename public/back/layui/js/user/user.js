/**
 *  公用列表
 */
layui.define(['laydate', 'global', 'laytpl', 'form', 'laypage'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        laytpl = layui.laytpl,
        form = layui.form(),
        laypage = layui.laypage;
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
        // 管理员修改视图vue
        var useredithtml1 = new Vue({
            el: '#useredithtml',
            data: {
                euser: {},
            },
            methods: {
                userhtml: function(id) {
                    var _this = this;
                    axios.get(Aizxin.U('user') + '/' + id)
                        .then(function(response) {
                            if (response.data.code == 200) {
                                _this.$set('euser', response.data.user);
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
            }
        });
        // 管理袁列表vue
        var auserList = new Vue({
            el: '#userlist',
            data: {
                user: [],
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
                    axios.post(Aizxin.U('user/index'), this.search)
                        .then(function(response) {
                            if (_this.pages != response.data.data.last_page) {
                                _this.$set('pages', response.data.data.last_page);
                                _this.page();
                            }
                            setTimeout(function() {
                                layer.close(index);
                                $('#list').find('tbody').css('display', 'table-row-group');
                                _this.$set('user', response.data.data.data);
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
                        title: '删除管理员'
                    }, function(index) {
                        axios.delete(Aizxin.U('user') + '/' + id).then(function(response) {
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
                        title: '管理员修改',
                        full: false,
                        shadeClose: true,
                        shade: 0.3,
                        content: $('#useredithtml'),
                        area: ['400px', '300px'],
                        anim: 5,
                        success: function(layero, index) {
                            $('#usereditreset')[0].reset();
                            form.render();
                            useredithtml1.userhtml(id);
                        }
                    });
                },
                // 权限分配
                role: function(id) {
                    var indexload = layer.load(1);
                    var permission = [];
                    layer.open({
                        type: 1,
                        title: '角色分配',
                        full: false,
                        shadeClose: true,
                        shade: 0.3,
                        content: $('#userrolehtml'),
                        area: ['400px', '300px'],
                        anim: 5,
                        success: function(layero, index) {
                            axios.get(Aizxin.U('user')+'/'+id+'/edit').then(function(response) {
                                if (response.data.code == 200) {
                                    permission = response.data.data;
                                }
                            });
                            axios.get(Aizxin.U('user/create')).then(function(response) {
                                layer.close(indexload);
                                opt = '<select name="role" lay-filter="roleselect">';
                                layui.each(response.data.data,function(index, item) {
                                    var isselect = permission.id == item.id?'selected':'';
                                    opt += '<option value="'+item.id+'" '+isselect+'>'+item.name+'</option>';
                                });
                                opt +='</select>';
                                $("#userroleselect").html(opt);
                                $('#userId').val(id)
                                form.render();
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
        form.on('submit(useradd)', function(data) {
            var index = layer.load(1);
            axios.post(Aizxin.U('user'), data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        layer.msg(response.data.message, {
                            time: 2000
                        }, function() {
                            auserList.list();
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
        form.on('submit(useredit)', function(data) {
            var index = layer.load(1);
            axios.put(Aizxin.U('user') + "/" + data.field.id, data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        layer.msg(response.data.message, {
                            time: 2000
                        }, function() {
                            auserList.list();
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
        // 角色分配
        form.on('select(roleselect)', function(data) {
            var index = layer.load(1);
            var ids = {
                id:$('#userId').val(),
                role:data.value
            };
            axios.post(Aizxin.U('user/role'), ids)
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
        })
    });
    exports('user', {});
});
