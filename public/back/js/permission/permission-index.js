/**
 *  公用列表
 */
layui.define(['global', 'lang', 'form', 'laypage', 'aizxin'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        lang = layui.lang,
        laypage = layui.laypage,
        aizxin = layui.aizxin;
    $(function() {
        window.vn = new Vue({
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
                    aizxin.open(lang.permission.create, aizxin.U("permission/create"), ['893px', '680px']);
                },
                changelist: function() {
                    this.search.page = 1;
                    this.list();
                },
                toplist: function() {
                    this.list();
                },
                list: function() {
                    var index = aizxin.load(1);
                    var _this = this;
                    axios.post(aizxin.U('permission/index'), this.search).then(function(response) {
                        if (_this.pages != response.data.data.last_page) {
                            _this.$set('pages', response.data.data.last_page)
                            _this.page();
                        }
                        setTimeout(function() {
                            layer.close(index);
                            $('#list').find('tbody').css('display', 'table-row-group');
                            _this.$set('permission', response.data.data.data);
                        }, 1000);
                    }).catch(function(error) {
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
                        aizxin.msgE(5, lang.permission.delE)
                        return;
                    };
                    this.elDelete(ids.join(","));
                },
                elDelete: function(id) {
                    var _this = this;
                    aizxin.confirm(lang.sys.del, lang.sys.clear + lang.permission.index, function(index) {
                        axios.delete(aizxin.U('permission') + '/' + id).then(function(response) {
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
                edithtml: function(id) {
                    aizxin.open(lang.permission.edit, aizxin.U('permission') + '/' + id + '/edit', ['893px', '680px']);
                },
            }
        });
    });
    exports('permission-index', {});
});