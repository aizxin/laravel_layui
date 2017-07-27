layui.define(['form', 'global', 'upload'], function(exports) {
	var form = layui.form(),
		$ = layui.jquery,
		layer = layui.layer,
		upload = layui.upload,
		Aizxin = layui.global;
	var ipth;

	$(function() {
		// 图片上传
		Aizxin.uploadQiniu('#article-upload', 'LAY_demo_upload', $('.i-delete'));
		// 文件删除
		$('.ad-upload').on('click', function() {
			var url = LAY_demo_upload.src;
			Aizxin.deleQiniu(url, $("#LAY_demo_upload"));
		});

		function printLog(title, info) {
			window.console && console.log(title, info);
		}
		// 初始化七牛上传
		function uploadInit() {
			var editor = this;
			var btnId = editor.customUploadBtnId;
			var containerId = editor.customUploadContainerId;
			// 创建上传对象
			var uploader = Qiniu.uploader({
				runtimes: 'html5,flash,html4', //上传模式,依次退化
				browse_button: btnId, //上传选择的点选按钮，**必需**
				uptoken_url: Aizxin.U('qiniu'),
				//Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
				// uptoken : '<Your upload token>',
				//若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
				// unique_names: true,
				// 默认 false，key为文件名。若开启该选项，SDK会为每个文件自动生成key（文件名）
				save_key: true,
				// 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK在前端将不对key进行任何处理
				domain: 'http://' + window.conf.QINIU_DOMAINS_DEFAULT + '/',
				//bucket 域名，下载资源时用到，**必需**
				container: containerId, //上传区域DOM ID，默认是browser_button的父元素，
				max_file_size: '100mb', //最大文件体积限制
				flash_swf_url: Aizxin.U('back') + '/plugin/qiniu/js/Moxie.swf', //引入flash,相对路径
				filters: {
					mime_types: [
						//只允许上传图片文件 （注意，extensions中，逗号后面不要加空格）
						{
							title: "图片文件",
							extensions: "jpg,gif,png,bmp"
						}
					]
				},
				max_retries: 3, //上传失败最大重试次数
				dragdrop: true, //开启可拖曳上传
				drop_element: 'editor-container', //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
				chunk_size: '4mb', //分块上传时，每片的体积
				auto_start: true, //选择文件后自动上传，若关闭需要自己绑定事件触发上传
				init: {
					'FilesAdded': function(up, files) {
						plupload.each(files, function(file) {
							// 文件添加进队列后,处理相关的事情
							// printLog('on FilesAdded');
						});
					},
					'BeforeUpload': function(up, file) {
						// 每个文件上传前,处理相关的事情
						// printLog('on BeforeUpload');
						layer.load(1, {
							shade: 0.5
						});
					},
					'UploadProgress': function(up, file) {
						// 显示进度条
						editor.showUploadProgress(file.percent);
					},
					'FileUploaded': function(up, file, info) {
						// 每个文件上传成功后,处理相关的事情
						// 其中 info 是文件上传成功后，服务端返回的json，形式如
						// {
						//    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
						//    "key": "gogopher.jpg"
						//  }
						// printLog(info);
						// 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html

						var domain = up.getOption('domain');
						var res = $.parseJSON(info);
						var sourceLink = domain + res.key; //获取上传成功后的文件的Url
						// printLog(sourceLink);
						// 插入图片到editor
						editor.command(null, 'insertHtml', '<img src="' + sourceLink + '" style="max-width:100%;"/>')
					},
					'Error': function(up, err, errTip) {
						//上传出错时,处理相关的事情
						printLog('on Error');
					},
					'UploadComplete': function() {
						//队列文件处理完毕后,处理相关的事情
						// printLog('on UploadComplete');
						// 隐藏进度条
						editor.hideUploadProgress();
						layer.closeAll('loading');
					},
					// Key 函数如果有需要自行配置，无特殊需要请注释
					//,
					// 'Key': function(up, file) {
					//     // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
					//     // 该配置必须要在 unique_names: false , save_key: false 时才生效
					//     var key = "";
					//     // do something with key here
					//     return key
					// }
				}
			});
			// domain 为七牛空间（bucket)对应的域名，选择某个空间后，可通过"空间设置->基本设置->域名设置"查看获取
			// uploader 为一个plupload对象，继承了所有plupload的方法，参考http://plupload.com/docs
		}
		// 生成编辑器
		var editor = new wangEditor('article-content');
		editor.config.customUpload = true;
		editor.config.customUploadInit = uploadInit;
		editor.create();
		// 文章添加
		form.on('submit(addarticlestore)', function(data) {
			data.field.id = 0;
			var url = LAY_demo_upload.src;
			data.field.thumb = url.indexOf(window.conf.QINIU_DOMAINS_DEFAULT) > 0 ? url : '';
			data.field.content = editor.$txt.html();
			var index = layer.load(1, {
				shade: 0.5,
				shade: 0.5
			});
			axios.post(Aizxin.U('article'), data.field)
				.then(function(response) {
					layer.close(index);
					if (response.data.code == 200) {
						layer.msg(response.data.message, {
							time: 1000,
							shade: 0.5
						}, function() {
							window.location.href = Aizxin.U('article');
						});
					} else {
						layer.msg(response.data.message, {
							icon: 5,
							shade: 0.5
						});
					}
				}).catch(function(error) {
					layer.close(index);
					layer.msg('系统错误', {
						icon: 5,
						shade: 0.5
					});
				});
			return false;
		});
		// 文章修改
		form.on('submit(editarticleupdate)', function(data) {
			var url = LAY_demo_upload.src;
			data.field.thumb = url.indexOf(window.conf.QINIU_DOMAINS_DEFAULT) > 0 ? url : '';
			data.field.content = editor.$txt.html();
			var index = layer.load(1, {
				shade: 0.5
			});
			axios.post(Aizxin.U('article'), data.field)
				.then(function(response) {
					layer.close(index);
					if (response.data.code == 200) {
						layer.msg(response.data.message, {
							time: 1000,
							shade: 0.5
						}, function() {
							window.location.href = Aizxin.U('article');
						});
					} else {
						layer.msg(response.data.message, {
							icon: 5,
							shade: 0.5
						});
					}
				}).catch(function(error) {
					layer.close(index);
					layer.msg('系统错误', {
						icon: 5,
						shade: 0.5
					});
				});
			return false;
		});
	});
	exports('article-add', {});
});