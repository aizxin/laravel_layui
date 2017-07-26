/**
 *  公用列表
 */
layui.define(['global', 'form', 'laypage', 'laytpl', 'aizxin', 'lang'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        laypage = layui.laypage,
        aizxin = layui.aizxin,
        lang = layui.lang,
        laytpl = layui.laytpl;
    $(function() {
        // 角色列表vue
        window.vn = new Vue({
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
                    axios.post(aizxin.U('role/index'), this.search).then(function(response) {
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
                    }).catch(function(error) {
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
                        aizxin.msgE(5, lang.role.delE)
                        return;
                    };
                    this.elDelete(ids.join(","));
                },
                // 单删除
                elDelete: function(id) {
                    var _this = this;
                    aizxin.confirm(lang.sys.del, lang.sys.clear + lang.role.index, function(index) {
                        axios.delete(aizxin.U('role') + '/' + id).then(function(response) {
                            layer.close(index);
                            if (response.data.code == 200) {
                                aizxin.msgS(6, response.data.message, function() {
                                    _this.list();
                                })
                            } else {
                                aizxin.msgE(5, response.data.message);
                            }
                        }).catch(function(error) {
                            console.log(error);
                        });
                    });
                },
                // 角色添加
                addhtml: function() {
                    aizxin.open(lang.role.create, aizxin.U("role/create"), ['526px', '400px']);
                },
                // 角色修改的open
                edithtml: function(id) {
                    aizxin.open(lang.role.edit, aizxin.U('role') + '/' + id + '/edit', ['526px', '400px']);
                },
                // 权限分配
                permission: function(id) {
                    aizxin.open(lang.role.permission, aizxin.U('role') + '/' + id, ['800px', '800px']);
                    // var indexload = layer.load(1);
                    // var permission = [];
                    // layer.open({
                    //     type: 1,
                    //     title: '角色权限',
                    //     full: false,
                    //     shadeClose: true,
                    //     shade: 0.3,
                    //     content: $('#rolepermissionhtml'),
                    //     area: ['800px', '800px'],
                    //     anim: 5,
                    //     success: function(layero, index) {
                    //         axios.get(aizxin.U('role') + '/' + id + '/edit').then(function(response) {
                    //             if (response.data.code == 200) {
                    //                 permission = response.data.permission;
                    //             }
                    //         });
                    //         axios.get(aizxin.U('role/create')).then(function(response) {
                    //                 layer.close(indexload);
                    //                 var getTpl = rolepermissionhtml.innerHTML;
                    //                 laytpl(getTpl).render(response.data, function(html) {
                    //                     rolepermissionhtml.innerHTML = html;
                    //                     if (permission.length) {
                    //                         for (var i = 0; i < permission.length; i++) {
                    //                             $('#role' + permission[i]).prop('checked', true);
                    //                         }
                    //                     }
                    //                     $('#roleId').val(id)
                    //                     form.render();
                    //                 });
                    //             })
                    //             .catch(function(error) {
                    //                 layer.closeAll();
                    //                 layer.msg('系统错误', {
                    //                     icon: 5
                    //                 });
                    //             });
                    //     }
                    // });
                }
            }
        });
    });
    exports('role', {});
});