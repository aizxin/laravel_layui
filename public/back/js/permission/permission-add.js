layui.define(['form', 'aizxin', 'lang'], function(exports) {
	var form = layui.form(),
		aizxin = layui.aizxin,
		lang = layui.lang,
		$ = layui.jquery;
	$(function() {
		//监听提交
		form.on('submit(addpermissionstore)', function(data) {
			data.field.ismenu = data.field.ismenu != undefined ? 1 : 0;
			var index = layer.load(1);
			axios.post(aizxin.U('permission'), data.field)
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
		this.$body = $('body');
		/*! 注册 data-icon 事件行为 */
		this.$body.on('click', '[data-icon]', function() {
			aizxin.open(lang.permission.icon, aizxin.U("icon"), ['500px', '400px']);
		});
		//监听提交
		form.on('submit(editpermissionupdate)', function(data) {
			data.field.ismenu = data.field.ismenu != undefined ? 1 : 0;
			var index = layer.load(1);
			axios.put(aizxin.U('permission') + "/" + data.field.id, data.field)
				.then(function(response) {
					layer.close(index);
					if (response.data.code == 200) {
						aizxin.msgS(6, response.data.message, function() {
							top.layer.closeAll();
							top.vn.toplist();
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
		form.render('checkbox');
	});
	exports('permission-add', {});
});