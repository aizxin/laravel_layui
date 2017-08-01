/**
 *  公用列表
 */
layui.define(['global', 'form', 'laypage', 'lang', 'aizxin'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        Aizxin = layui.global,
        laypage = layui.laypage,
        lang = layui.lang,
        aizxin = layui.aizxin;
    $(function() {
        window.vn = new Vue({
            el: '#articlelist',
            data: {
                article: [],
                search: {
                    pageSize: 15
                },
                pages: 10
            },
            created: function() {
                this.list()
            },
            methods: {
                sortArticle: function(vo) {
                    var data = {
                        id: vo.id,
                        rank: vo.rank
                    };
                    aizxin.confirm(lang.sys.title, lang.article.sort, function(index) {
                        axios.post(aizxin.U('article/switch'), data)
                            .then(function(response) {
                                if (response.data.code == 400) {
                                    aizxin.msgE(6, response.data.message);
                                }
                            }).catch(function(error) {
                                aizxin.msgE(5, response.data.message);
                            });
                        layer.close(index);
                    });
                },
                addhtml: function() {
                    aizxin.open(lang.article.create, aizxin.U("article/create"), ['893px', '860px']);
                },
                changelist: function() {
                    this.search.page = 1;
                    this.list();
                },
                list: function() {
                    var index = layer.load(1, {
                        shade: 0.5,
                        shade: 0.5
                    });
                    var _this = this;
                    axios.post(aizxin.U('article/index'), this.search)
                        .then(function(response) {
                            if (_this.pages != response.data.data.last_page) {
                                _this.$set('pages', response.data.data.last_page);
                                _this.page();
                            }
                            layer.close(index);
                            $('#list').find('tbody').css('display', 'table-row-group');
                            _this.$set('article', response.data.data.data);
                            _this.$nextTick(function() {
                                form.render();
                            });
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
                        aizxin.msgE(5, lang.article.delE);
                        return;
                    };
                    this.elDelete(ids.join(","));
                },
                elDelete: function(id) {
                    var _this = this;
                    aizxin.confirm(lang.sys.del, lang.sys.clear + lang.article.article, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.delete(aizxin.U('article') + '/' + id).then(function(response) {
                            layer.close(indexload);
                            if (response.data.code == 200) {
                                aizxin.msgS(6, response.data.message, function() {
                                    _this.list();
                                })
                            } else {
                                aizxin.msgE(5, response.data.message);
                            }
                        }).catch(function(error) {
                            layer.closeAll();
                            aizxin.msgE(5, response.sys.error);
                        });
                    });
                },
                edithtml: function(id) {
                    aizxin.open(lang.article.edit, aizxin.U('article') + '/' + id + '/edit', ['893px', '860px']);
                },
            }
        });
    });
    exports('article-index', {});
});