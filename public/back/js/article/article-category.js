layui.define(['global', 'form', 'laypage', 'lang', 'aizxin'], function(exports) {
	var $ = layui.jquery,
		layer = layui.layer,
		form = layui.form(),
		laypage = layui.laypage,
		lang = layui.lang,
		aizxin = layui.aizxin;
	$(function() {
		var articleCategoryList1 = new Vue({
			el: '#articleCategoryList',
			data: {
				category: [],
				caret: 'caret-right',
				iSndex: -1,
				eliSndex: -1,
				sliSndex: -1,
				parent_id: -1,
			},
			created: function() {
				this.list();
			},
			methods: {
				list: function() {
					var _this = this;
					axios.get(aizxin.U('article/category/create')).then(function(response) {
						_this.$set('category', response.data.data);
						_this.selectOption();
					}).catch(function(error) {
						aizxin.msgE(5, lang.permission.delE);
					});
					$('#ArticleCategoryReset')[0].reset();
				},
				showChild: function(index, vo) {
					if (index == this.iSndex) {
						this.$set('iSndex', -1);
					} else {
						if (vo.length > 0) {
							this.$set('iSndex', index);
						}
					}
				},
				elShowChild: function(index, vo) {
					if (index == this.eliSndex) {
						this.$set('eliSndex', -1);
					} else {
						if (vo.length > 0) {
							this.$set('eliSndex', index);
						}
					}
				},
				slShowChild: function(index, vo) {
					if (index == this.sliSndex) {
						this.$set('sliSndex', -1);
					} else {
						if (vo.length > 0) {
							this.$set('sliSndex', index);
						}
					}
				},
				addCategory: function(vo) {
					$('#ArticleCategoryReset')[0].reset();
					this.$set('parent_id', vo.id);
					$('#acid').val(0);
					$('#acopen').attr('checked', false);
					this.selectOption();
				},
				editCategory: function(vo) {
					$('#ArticleCategoryReset')[0].reset();
					$('#acid').val(vo.id);
					$('#acname').val(vo.name);
					$('#acopen').attr('checked', vo.status ? true : false);
					this.$set('parent_id', vo.parent_id);
					this.selectOption();
				},
				deleteCategory: function(vo) {
					if (vo.child.length > 0) {
						aizxin.msgE(5, lang.article.childE);
						return;
					}
					var _this = this;
					aizxin.confirm(lang.sys.del, lang.sys.clear + lang.article.index, function(index) {
						axios.delete(aizxin.U('article/category') + '/' + vo.id).then(function(response) {
								layer.close(index);
								if (response.data.code == 200) {
									layer.msg(response.data.message, {
										icon: 6,
										shade: 0.5
									});
									_this.list();
								} else {
									layer.msg(response.data.message, {
										icon: 5,
										shade: 0.5
									});
								}
							})
							.catch(function(error) {
								console.log(error);
							});
					});
				},
				selectOption: function() {
					var _this = this;
					var html = '<select name="parent_id"><option value="0">' + lang.article.parent + '</option>';
					// layui.each(this.category, function(index, item) {
					// 	var isselect = _this.parent_id == item.id ? 'selected' : '';
					// 	html += '<option ' + isselect + ' value="' + item.id + '">' + item.name + '</option>';
					// 	layui.each(item.child, function(index, vo) {
					// 		var islect = _this.parent_id == vo.id ? 'selected' : '';
					// 		html += '<option ' + islect + ' value="' + vo.id + '">  ├  ' + vo.name + '</option>';
					// 	});
					// });
					html += '</select>';
					$('#selectParentId').html(html);
					form.render();
				},
			}
		});
		// 文章分类添加
		form.on('submit(addArticleCategory)', function(data) {
			var index = layer.load(1, {
				shade: 0.5
			});
			data.field.status = data.field.status != undefined ? 1 : 0;
			axios.post(aizxin.U('article/category'), data.field)
				.then(function(response) {
					layer.close(index);
					if (response.data.code == 200) {
						aizxin.msgS(6, response.data.message, function() {
							$('#acid').val(0);
							articleCategoryList1.list();
							articleCategoryList1.$set('parent_id', 0);
							$('#ArticleCategoryReset')[0].reset();
							form.render('select');
						});
					} else {
						aizxin.msgE(5, response.data.message)
					}
				}).catch(function(error) {
					layer.close(index);
					aizxin.msgE(5, lang.sys.error)
				});
			return false;
		});

	});
	exports('article-category', {});
});