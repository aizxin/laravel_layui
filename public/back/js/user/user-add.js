layui.define(['form', 'jquery'], function(exports) {
    var form = layui.form(),
        $ = layui.jquery;
    form.verify({
        //验证可以有两种方法，一种if，一种直接判断
        username: function(value) {
            if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                return '用户名不能有特殊字符';
            }
            if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                return '用户名首尾不能出现下划线\'_\'';
            }
            if (/^\d+\d+\d$/.test(value)) {
                return '用户名不能全为数字';
            }
        },
        pass: [
            /(?!^\[0-9]+$)(?!^[a-zA-Z]+$)(?!^[_#@]+$).{6,20}/, '密码必须6到20位，且不能出现空格'
        ],
        mobile: function(value) {
            if (!new RegExp(/^0?(13|14|15|18|17)[0-9]{9}$/).test(value)) {
                return "手机号格式不正确"
            }
        },
        idcard: function(value) {
            if (!new RegExp(/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/).test(value)) {
                return "身份证号码格式不正确"
            }
        },
        address: function(value) {
            if (value == "") {
                return "请输入正确的详细地址";
            }
        }
    });
    //监听提交
    form.on('submit(demo1)', function(data){
        layer.alert(JSON.stringify(data.field), {
          title: '最终的提交信息'
        })
        return false;
    });

    exports('user-add', {});
});
