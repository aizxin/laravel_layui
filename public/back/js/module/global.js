/**

 layui官网

*/

layui.define(['layer', 'code', 'form', 'element', 'util', 'modal'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        util = layui.util,
        modal = layui.modal,
        device = layui.device(),
        jqGlobal = function() {};

    //阻止IE7以下访问
    if (device.ie && device.ie < 8) {
        layer.alert('Layui最低支持ie8，您当前使用的是古老的 IE' + device.ie + '，你丫的肯定不是程序猿！');
    }


    //搜索组件
    form.on('select(component)', function(data) {
        var value = data.value;
        location.href = '/doc/' + value;
    });


    //首页banner
    setTimeout(function() {
        $('.site-zfj').addClass('site-zfj-anim');
        setTimeout(function() {
            $('.site-desc').addClass('site-desc-anim')
        }, 5000)
    }, 100);


    for (var i = 0; i < $('.adsbygoogle').length; i++) {
        (adsbygoogle = window.adsbygoogle || []).push({});
    }

    //展示当前版本
    $('.site-showv').html(layui.v);

    // //固定Bar
    // util.fixbar({
    //     bar1: true,
    //     click: function(type) {
    //         if (type === 'bar1') {
    //             location.href = '/';
    //         }
    //     }
    // });
    //窗口scroll
    ;
    ! function() {
        var main = $('.site-tree').parent(),
            scroll = function() {
                var stop = $(window).scrollTop();
                if ($(window).width() <= 750) {
                    var bottom = $('.footer').offset().top - $(window).height();
                    if (stop > 61 && stop < bottom) {
                        if (!main.hasClass('site-fix')) {
                            main.addClass('site-fix');
                        }
                        if (main.hasClass('site-fix-footer')) {
                            main.removeClass('site-fix-footer');
                        }
                    } else if (stop >= bottom) {
                        if (!main.hasClass('site-fix-footer')) {
                            main.addClass('site-fix site-fix-footer');
                        }
                    } else {
                        if (main.hasClass('site-fix')) {
                            main.removeClass('site-fix').removeClass('site-fix-footer');
                        }
                    }
                    stop = null;
                };

            };
        scroll();
        $(window).on('scroll', scroll);
    }();

    //全选
    form.on('checkbox(allChoose)', function(data) {
        var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
        child.each(function(index, item) {
            item.checked = data.elem.checked;
        });
        form.render('checkbox');
    });
    // 留言
    // ;! function(){
    //     var layerSteward;   //管家窗口
    //     var isStop = false; //是否停止提醒

    //     getNotReplyLeaveMessage();

    //     var interval = setInterval(function () {
    //         getNotReplyLeaveMessage();
    //     }, 60000);  //1分钟提醒一次

    //     function getNotReplyLeaveMessage() {
    //         clearInterval(interval); //停止计时器
    //         var content = '<p>目前有<span>12</span>条留言未回复</p>';
    //         content += '<div class="notnotice" ><a href="javascript:layer.msg(\'跳转到相应页面\')">点击查看</a></div>';
    //         layerSteward = layer.open({
    //             type: 1,
    //             title: '管家提醒',
    //             shade: 0,
    //             resize: false,
    //             area: ['200px', '100px'],
    //             time: 10000, //10秒后自动关闭
    //             skin: 'steward',
    //             closeBtn: 1,
    //             anim: 2,
    //             content: content,
    //             end: function () {
    //                 if (!isStop) {
    //                     interval = setInterval(function () {
    //                         if (!isStop) {
    //                             clearInterval(interval);
    //                             getNotReplyLeaveMessage();
    //                         }
    //                     }, 60000);
    //                 }
    //             }
    //         });
    //         $('.steward').click(function (e) {
    //             event.stopPropagation();    //阻止事件冒泡
    //         });
    //         $('.notnotice').click(function () {
    //             isStop = true;
    //             layer.close(layerSteward);
    //             $('input[lay-filter=steward]').siblings('.layui-form-switch').removeClass('layui-form-onswitch');
    //             $('input[lay-filter=steward]').prop("checked", false);
    //         });
    //         form.on('switch(steward)', function (data) {
    //             if (data.elem.checked) {
    //                 isStop = false;
    //                 clearInterval(interval);
    //                 runSteward();
    //             } else {
    //                 isStop = true;
    //                 layer.close(layerSteward);
    //             }
    //         })
    //     }
    // }();

    //手机设备的简单适配
    var treeMobile = $('.site-tree-mobile'),
        shadeMobile = $('.site-mobile-shade')

    treeMobile.on('click', function() {
        $('body').addClass('site-mobile');
    });

    shadeMobile.on('click', function() {
        $('body').removeClass('site-mobile');
    });
    jqGlobal.prototype.init = function() {
        modal.init();
    }
    var global = new jqGlobal();
    global.init();
    exports('global', {});
});