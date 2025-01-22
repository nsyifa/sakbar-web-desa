<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $pemerintah = ucwords(setting('sebutan_pemerintah_desa')) ?>
<?php $__env->startSection('title'); ?>
    <h1>
        <?php echo e($pemerintah); ?>

        <small>Bagan <?php echo e($pemerintah); ?></small>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(ci_route('pengurus')); ?>"><?php echo e($pemerintah); ?></a></li>
    <li class="active">Bagan <?php echo e($pemerintah); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body">
                    <div id="container"></div>
                    <p class="highcharts-description"></p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/bagan.css')); ?>">
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.components.highchartjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.pengurus.chart_bagan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\resources\views/admin/pengurus/bagan.blade.php ENDPATH**/ ?>