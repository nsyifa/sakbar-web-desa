<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('title'); ?>
<h1>
    Halaman Baru
</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="active">Halaman Baru</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <!-- <div class="col-md-3">
        <?php echo $__env->make('admin.web.artikel.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div> -->
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <a href="<?php echo e(ci_route('halaman_baru.form')); ?>" id="btn-add" class="btn btn-social btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-plus"></i> Tambah Halaman Baru</a>
                <a href="#confirm-delete" title="Hapus Data" onclick="deleteAllBox('mainform', '<?php echo e(ci_route(`halaman_baru.delete`)); ?>')" class="btn btn-social btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</a>
            </div>
            <div class="box-body">
                <div class="row mepet">
                    <div class="col-sm-2">
                        <select id="status" class="form-control input-sm select2">
                            <option value="">Pilih Status</option>
                            <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>"><?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <hr class="batas">
                <?php echo form_open(null, 'id="mainform" name="mainform"'); ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tabeldata">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkall" /></th>
                                <th class="padat">NO</th>
                                <th class="padat">AKSI</th>
                                <th nowrap>JUDUL</th>
                                <!-- <th nowrap>HIT</th> -->
                                <th width="15%" nowrap>DIPOSTING PADA</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('admin.layouts.components.konfirmasi_hapus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- <?php echo $__env->renderWhen($cat == 'statis', 'admin.web.artikel.reset_hit_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?> -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        var TableData = $('#tabeldata').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo e(ci_route('halaman_baru.datatables')); ?>",
                data: function(req) {
                    req.status = $('#status').val();
                    console.log($('#status').val())
                }
            },
            columns: [{
                    data: 'ceklist',
                    class: 'padat',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'DT_RowIndex',
                    class: 'padat',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'aksi',
                    class: 'aksi',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'judul',
                    name: 'judul',
                    searchable: true,
                    orderable: true
                },
                {
                    data: 'tgl_upload',
                    name: 'tgl_upload',
                    searchable: false,
                    orderable: true
                },
            ],
            order: [
                [4, 'desc']
            ],
        });

        // if (hapus == 0) {
        //     TableData.column(0).visible(false);
        // }

        // if (ubah == 0) {
        //     TableData.column(2).visible(false);
        // }

        $('#status').change(function() {
            TableData.draw()
        })
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\resources\views/admin/web/halaman_baru/index.blade.php ENDPATH**/ ?>