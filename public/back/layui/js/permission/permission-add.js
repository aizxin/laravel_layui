layui.define(['form', 'global'], function(exports) {
	var form = layui.form(),
		$ = layui.jquery;
	$(function() {
		//监听提交
		form.on('submit(addpermissionstore)', function(data) {
			data.field.ismenu = data.field.ismenu != undefined ? 1 : 0;
			var index = layer.load(1);
			axios.post(Aizxin.U('permission'), data.field)
				.then(function(response) {
					layer.close(index);
					if (response.data.code == 200) {
						layer.msg(response.data.message, {
							time: 2000
						}, function() {
							window.location.href = Aizxin.U('permission');
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
		this.$body = $('body');
		/*! 注册 data-icon 事件行为 */
		this.$body.on('click', '[data-icon]', function() {
			var href = Aizxin.U('icon');
			var index = layer.load(1);
			Aizxin.layerOpen('图标选择', href, '500', '700', 2, form, index);
		});
		//监听提交
		form.on('submit(editpermissionupdate)', function(data) {
			data.field.ismenu = data.field.ismenu != undefined ? 1 : 0;
			var index = layer.load(1);
			axios.put(Aizxin.U('permission') + "/" + data.field.id, data.field)
				.then(function(response) {
					layer.close(index);
					if (response.data.code == 200) {
						layer.msg(response.data.message, {
							time: 2000
						}, function() {
							window.location.href = Aizxin.U('permission');
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
		form.render('checkbox');
	});
	exports('permission-add', {});
});