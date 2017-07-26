<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    <link rel="stylesheet" href="<?php echo e(asset('back/plugin/layui/css/layui.css?v=1.0.9')); ?>" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('back/plugin/layui/css/global.css')); ?>" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('back/css/font-awesome.min.css')); ?>" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('back/css/main.css?v1.3.3')); ?>" media="all">
    <?php echo $__env->yieldContent('style'); ?>
</head>

<body>
    <div class="layui-layout layui-layout-admin">
    <?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('layouts.left', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="site-tree-mobile layui-hide">
        <i class="layui-icon"></i>
    </div>
    <div class="site-mobile-shade"></div>
</body>
<script src="<?php echo e(asset('back/plugin/layui/layui.js')); ?>" charset="utf-8"></script>
<script src="<?php echo e(asset('back/plugin/vue.min.js')); ?>" charset="utf-8"></script>
<script src="<?php echo e(asset('back/plugin/es6-promise/promise.js')); ?>"></script>
<script src="<?php echo e(asset('back/plugin/axios/axios.min.js')); ?>" charset="utf-8"></script>
<script src="<?php echo e(asset('back/js/config.js')); ?>" charset="utf-8"></script>
<script>
    window.conf ={
        APP:'<?php echo "http://".$_SERVER["HTTP_HOST"];?>',
        QINIU_DOMAINS_DEFAULT:'<?php echo e(env("QINIU_DOMAINS_DEFAULT")); ?>'
    };
    axios.defaults.headers.common = {
        'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>",
        'X-Requested-With': 'XMLHttpRequest'
    };
</script>
<?php echo $__env->yieldContent('my-js'); ?>
</html>