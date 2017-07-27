/**
 *  公用列表
 */
layui.define(['global', 'form', 'laypage', 'aizxin', 'lang'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        aizxin = layui.aizxin,
        lang = layui.lang,
        laypage = layui.laypage;
    $(function() {
        // 管理员修改视图vue
        var useredithtml1 = new Vue({
            el: '#useredithtml',
            data: {
                euser: {},
            },
            methods: {
                userhtml: function(id) {
                    var _this = this;
                    axios.get(aizxin.U('user') + '/' + id)
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
        window.vn = new Vue({
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
                    var index = aizxin.load(1);
                    var _this = this;
                    axios.post(aizxin.U('user/index'), this.search).then(function(response) {
                        if (_this.pages != response.data.data.last_page) {
                            _this.$set('pages', response.data.data.last_page);
                            _this.page();
                        }
                        layer.close(index);
                        $('#list').find('tbody').css('display', 'table-row-group');
                        _this.$set('user', response.data.data.data);
                        _this.$nextTick(function() {
                            form.render();
                        });
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
                            ids.push(item.value);
                        }
                    });
                    if (!ids.length) {
                        aizxin.msgE(5, lang.user.delE);
                        return;
                    };
                    this.elDelete(ids.join(","));
                },
                // 单删除
                elDelete: function(id) {
                    var _this = this;
                    aizxin.confirm(lang.sys.del, lang.sys.clear + lang.user.index, function(index) {
                        axios.delete(aizxin.U('user') + '/' + id).then(function(response) {
                            layer.close(index);
                            if (response.data.code == 200) {
                                aizxin.msgS(6, response.data.message, function() {
                                    _this.list();
                                });
                            } else {
                                aizxin.msgE(5, response.data.message);
                            }
                        }).catch(function(error) {
                            console.log(error);
                        });
                    });
                },
                // 管理员添加
                addHtml: function() {
                    aizxin.open(lang.user.create, aizxin.U("user/create"), ['526px', '400px']);
                },
                // 管理员修改的open
                edithtml: function(id) {
                    aizxin.open(lang.user.edit, aizxin.U('user') + '/' + id + '/edit', ['526px', '400px']);
                },
                // 权限分配
                role: function(id) {
                    aizxin.open(lang.user.role, aizxin.U('user') + '/' + id, ['526px', '300px']);
                }
            }
        });
    });
    exports('user', {});
});