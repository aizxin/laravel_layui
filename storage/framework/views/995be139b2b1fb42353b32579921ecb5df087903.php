<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>登录</title>
        <link rel="stylesheet" href="<?php echo e(asset('back/plugin/layui/css/layui.css?v=1.0.9')); ?>" media="all">
        <link rel="stylesheet" href="<?php echo e(asset('back/css/login.css')); ?>" />
    </head>

    <body class="beg-login-bg" >
        <div class="beg-login-box">
            <header>
                <h1>后台登录</h1>
            </header>
            <div class="beg-login-main layui-form">
                <form class="layui-form">
                    <div class="layui-form-item">
                        <label class="beg-login-icon">
                            <i class="layui-icon">&#xe612;</i>
                        </label>
                        <input type="text" name="username" lay-verify="required" autocomplete="off" placeholder="管理员账号" class="layui-input">
                    </div>
                    <div class="layui-form-item">
                        <label class="beg-login-icon">
                        <i class="layui-icon">&#xe642;</i>
                    </label>
                        <input type="password" name="password" lay-verify="required|password" autocomplete="off" placeholder="管理员密码" class="layui-input">
                    </div>
                    <div class="layui-form-item">
                        <div class="">
                        <button class="layui-input layui-btn layui-btn-primary" lay-submit lay-filter="login" style="font-size: 20px;color: #fff;">
                            登&nbsp;&nbsp;&nbsp;&nbsp;录
                        </button>
                        </div>
                        <div class="beg-clear"></div>
                    </div>
                </form>
            </div>
            <footer>
                <p>技术 © <a href="https://chouchongkeji.com">臭虫科技</a></p>
            </footer>
        </div>
        <script src="<?php echo e(asset('back/plugin/layui/layui.js')); ?>" charset="utf-8"></script>
        <script src="<?php echo e(asset('back/plugin/es6-promise/promise.js')); ?>"></script>
        <script src="<?php echo e(asset('back/plugin/axios/axios.min.js')); ?>" charset="utf-8"></script>
        <script>
            layui.config({
                base: "<?php echo e(asset('back/plugin/layui')); ?>/"
            }).use(['form'], function(){
                var form = layui.form()
                    ,$ = layui.jquery
                    ,layer = layui.layer;
                axios.defaults.headers.common = {
                    'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>",
                    'X-Requested-With': 'XMLHttpRequest'
                };

                //自定义验证规则
                form.verify({
                    password: [/(.+){6,12}$/, '密码必须6到12位']
                });
                //监听提交
                form.on('submit(login)', function(data){
                    axios.post('/login', data.field)
                    .then(function (response) {
                        if(response.data.code == 200){
                            layer.msg(response.data.message,{icon: 6,shade: 0.5,shift: 1,time: 1000},function(){
                                window.location.href = '/admin';
                            })
                        }else{
                            layer.msg(response.data.message,{icon: 5,shade: 0.5,shift: 1,time: 1000})
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    return false;
                });
            });
        </script>
    </body>

</html>