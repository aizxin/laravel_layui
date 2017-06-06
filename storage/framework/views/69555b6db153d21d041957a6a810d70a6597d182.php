<?php $__env->startSection('content'); ?>
<div class="layui-body site-demo">

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('my-js'); ?>
<script>
layui.use(['global'])
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>