<?php $__env->startSection('style'); ?>
<style type="text/css" media="screen">
	.page-404 {
    max-width: 400px;
    z-index: 100;
    margin: 0 auto;
    padding-top: 40px;
    text-align: center;
}
.page-404 h1 {
    font-size: 170px;
    margin: 0;
    font-weight: 100;
}
.page-404 h3 {
    font-size: 16px;
    margin-top: 5px;
    margin-bottom: 10px;
    font-weight: 600;
}
.page-404 .error-desc {
    color: #676a6c;
    line-height: 32px;
    font-size: 0;
}
.page-404 .error-desc span {
    font-size: 13px;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="layui-body site-demo">
	<div class="page-404">
		<h1>404</h1>
			<h3 class="font-bold">页面未找到！</h3>
		<div class="error-desc">
			<span>老张，页面让你给吃了~<a href="<?php echo e($previousUrl); ?>" class="btn btn-success">返回上一页</a></span>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('my-js'); ?>
<script>
layui.use(['global'])
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>