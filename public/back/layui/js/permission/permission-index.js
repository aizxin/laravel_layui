/**
 *  公用列表
 */
layui.define(['global', 'form', 'laypage'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        laypage = layui.laypage;
    $(function() {
        var aPermissionList = new Vue({
            el: '#permissionlist',
            data: {
                permission: [],
                search: {
                    pageSize: 15
                },
                pages: 10
            },
            created: function() {
                this.list()
            },
            methods: {
                addhtml: function() {
                    var index = layer.load(1);
                    window.location.href = Aizxin.U('permission/create');
                },
                changelist: function() {
                    this.search.page = 1;
                    this.list();
                },
                list: function() {
                    var index = layer.load(1);
                    var _this = this;
                    axios.post(Aizxin.U('permission/index'), this.search)
                        .then(function(response) {
                            if (_this.pages != response.data.data.last_page) {
                                _this.$set('pages', response.data.data.last_page)
                                _this.page();
                            }
                            setTimeout(function() {
                                layer.close(index);
                                $('#list').find('tbody').css('display', 'table-row-group');
                                _this.$set('permission', response.data.data.data);
                            }, 1000);
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                    form.render('checkbox');
                },
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
                elDelete: function(id) {
                    var _this = this;
                    layer.confirm('确认是否删除', {
                        icon: 1,
                        title: '删除权限节点'
                    }, function(index) {
                        axios.delete(Aizxin.U('permission') + '/' + id).then(function(response) {
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
                edithtml: function(id) {
                    var index = layer.load(1);
                    window.location.href = Aizxin.U('permission') + '/' + id + '/edit';
                },
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
    });
    exports('permission-index', {});
});