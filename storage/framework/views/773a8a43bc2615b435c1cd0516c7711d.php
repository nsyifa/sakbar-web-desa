<form id="validasi" action="<?php echo e($form_action); ?>" method="post" target="_blank">
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">Tahun</label>
            <select class="form-control input-sm jenis_link select2" name="tahun">>
                <option value="">Semua</option>
                <?php $__currentLoopData = $tahun_laporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tahun['tahun']); ?>"><?php echo e($tahun['tahun']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <?php if(isset($kat) && $kat == 3): ?>
            <div class="form-group">
                <label class="control-label">Jenis Peraturan</label>
                <select class="form-control input-sm select2" name="jenis_peraturan" style="width: 100%;">
                    <option value=''>-- Pilih Jenis Peraturan --</option>
                    <?php $__currentLoopData = $jenis_peraturan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item); ?>"><?php echo e($item); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        <?php endif; ?>
        <?php if($pamong): ?>
            <div class="form-group">
                <label class="control-label">Pamong Tertanda</label>
                <select class="form-control input-sm jenis_link select2 required" name="pamong_ttd">
                    <option value="">Pilih Staf Penandatangan</option>
                    <?php $__currentLoopData = $pamong; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($data['pamong_id']); ?>" <?= ($pamong_ttd['pamong_id'] == $data['pamong_id']) ? 'selected' : ''; ?>>
                            <?php echo e($data['pamong_nama']); ?> (<?php echo e($data['pamong_jabatan']); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">Pamong Mengetahui</label>
                <select class="form-control input-sm jenis_link select2 required" name="pamong_ketahui">
                    <option value="">Pilih Staf Mengetahui</option>
                    <?php $__currentLoopData = $pamong; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($data['pamong_id']); ?>" <?= ($pamong_ketahui['pamong_id'] == $data['pamong_id']) ? 'selected' : ''; ?>>
                            <?php echo e($data['pamong_nama']); ?> (<?php echo e($data['pamong_jabatan']); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        <?php endif; ?>

    </div>
    <div class="modal-footer">
        <?php echo batal(); ?>

        <button type="submit" class="btn btn-social btn-info btn-sm" id="btn-ok">
            <?php if($aksi == 'cetak'): ?>
                <i class='fa fa-print'></i> Cetak
            <?php else: ?>
                <i class='fa fa-download'></i> Unduh
            <?php endif; ?>
        </button>
    </div>
</form>
<?php echo $__env->make('admin.layouts.components.validasi_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
    $('document').ready(function() {
        $('#validasi').submit(function() {
            if ($('#validasi').valid()) {
                $('#modalBox').modal('hide');
            }
        });
    });
</script>
<?php /**PATH C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\resources\views/admin/layouts/components/kades/dialog_cetak.blade.php ENDPATH**/ ?>