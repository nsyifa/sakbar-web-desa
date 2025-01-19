<?php echo $__env->make('admin.layouts.components.asset_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
<h1>
    <h1>Form Halaman Baru</h1>
</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li><a href="<?php echo e(ci_route('halaman_baru')); ?>">Daftar Halaman Baru</a></li>
<li class="active">Form Halaman Baru</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo form_open_multipart($form_action, 'id="validasi"'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
                <a href="<?php echo e(ci_route('halaman_baru')); ?>" class="btn btn-social btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Halaman">
                    <i class="fa fa-arrow-circle-left "></i>Kembali ke Daftar Halaman
                </a>
                <?php if($halaman['slug']): ?>
                <a href="<?php echo e($halaman['url_slug']); ?>" target="_blank" class="btn btn-social bg-green btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-eye"></i> Lihat Halaman</a>
                <?php endif; ?>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="control-label" for="judul">Judul Halaman</label>
                    <input
                        id="judul"
                        name="judul"
                        class="form-control input-sm required strip_tags judul"
                        type="text"
                        placeholder="Judul Halaman"
                        minlength="5"
                        maxlength="200"
                        value="<?php echo e($halaman['judul']); ?>"></input>
                    <span class="help-block"><code>Judul halaman minimal 5 karakter dan maksimal 200 karakter</code></span>
                </div>
                <div class="form-group">
                    <label class="control-label" for="kode_desa">Isi Halaman</label>
                    <textarea name="isi" data-filemanager='<?php echo json_encode([' external_filemanager_path'=> base_url('assets/kelola_file/'), 'filemanager_title' => 'Responsive Filemanager', 'filemanager_access_key' => $session->fm_key]); ?>' class="form-control input-sm required" style="height:350px;"><?php echo e($halaman['isi']); ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-info">
            <div class="box-body no-padding">
                <div class='box-footer'>
                    <?php echo batal(); ?>

                    <button type='submit' class='btn btn-social btn-info btn-sm pull-right'><i class='fa fa-check'></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.components.datetime_picker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/tinymce-651/tinymce.min.js')); ?>"></script>
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        height: 700,
        editimage_cors_hosts: ['lh7-rt.googleusercontent.com'],
        promotion: false,
        theme: 'silver',
        formats: {
            menjorok: {
                block: 'p',
                styles: {
                    'text-indent': '30px'
                }
            }
        },
        block_formats: 'Paragraph=p; Header 1=h1; Header 2=h2; Header 3=h3; Header 4=h4; Header 5=h5; Header 6=h6; Div=div; Preformatted=pre; Blockquote=blockquote; Menjorok=menjorok',
        style_formats_merge: true,
        plugins: [
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'print', 'preview', 'hr', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'insertdatetime', 'media', 'nonbreaking',
            'table', 'contextmenu', 'directionality', 'emoticons', 'paste', 'textcolor', 'responsivefilemanager', 'code', 'laporan_keuangan', 'penerima_bantuan', 'sotk'
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | blocks",
        toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor | print preview code | fontfamily fontsizeinput",
        toolbar3: "| laporan_keuangan | penerima_bantuan | sotk",
        image_advtab: true,
        external_plugins: {
            "filemanager": "<?php echo e(asset('kelola_file/plugin.min.js')); ?>"
        },
        templates: [{
                title: 'Test template 1',
                content: 'Test 1'
            },
            {
                title: 'Test template 2',
                content: 'Test 2'
            }
        ],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ],
        skin: 'tinymce-5',
        relative_urls: false,
        remove_script_host: false
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\resources\views/admin/web/halaman_baru/form.blade.php ENDPATH**/ ?>