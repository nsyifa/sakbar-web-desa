<?php echo $__env->make('admin.layouts.components.asset_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
    <h1>
        Tema
        <small><?php echo e($action); ?> Data</small>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(site_url('theme')); ?>">Tema</a></li>
    <li class="active"><?php echo e($action); ?> Data</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="box box-info">
        <div class="box-header with-border">
            <a href="<?php echo e(site_url('theme')); ?>" class="btn btn-social btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                <i class="fa fa-arrow-circle-left "></i>Kembali ke Tema
            </a>
        </div>
        <?php echo form_open_multipart($form_action, 'id="validasi"'); ?>

        <div class="box-body">
            <div class="form-group">
                <label>File Tema <code>(.zip)</code></label>
                <div class="input-group">
                    <input type="text" class="form-control input-sm" id="file_path" name="userfile">
                    <input type="file" class="hidden required" id="file" name="userfile" accept=".zip" />
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-sm" id="file_browser"><i class="fa fa-search"></i>&nbsp;Cari</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="reset" class="btn btn-social btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
            <button type="submit" class="btn btn-social btn-info btn-sm pull-right"><i class="fa fa-check"></i>
                Simpan</button>
        </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\resources\views/admin/theme/unggah.blade.php ENDPATH**/ ?>