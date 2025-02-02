<form action="<?php echo e($form_action); ?>" method="post" id="validasi">
    <div class="modal-body">
        <input name="parrent" type="hidden" value="<?php echo e($menu_utama['id'] ?? 0); ?>" />
        <?php if($menu_utama): ?>
        <div class="form-group">
            <label class="control-label" for="menu_utama">Menu Utama</label>
            <select name="parrent" class="form-control input-sm required">
                <option value="0">Menu Utama</option>
                <?php $__empty_1 = true; $__currentLoopData = $menu_utama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <option value="<?php echo e($key); ?>" <?= ($key==$menu['parrent']) ? 'selected' : ''; ?>><?php echo e($item); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>
            </select>
        </div>
        <?php endif; ?>
        <div class="form-group">
            <label class="control-label" for="nama">Nama</label>
            <input name="nama" class="form-control input-sm required nomor_sk" maxlength="50" type="text" value="<?php echo e($menu['nama']); ?>" />
        </div>
        <?php if(!empty($menu['link'])): ?>
        <div class="form-group">
            <label class="control-label" for="link_sebelumnya">Link Sebelumnya</label>
            <input class="form-control input-sm" type="text" value="<?php echo e($menu['link_url']); ?>" disabled />
        </div>
        <?php endif; ?>
        <div class="form-group">
            <label class="control-label" for="link">Jenis Link</label>
            <select class="form-control input-sm required" id="link_tipe" name="link_tipe" onchange="ganti_jenis_link(this);">
                <option option value="">-- Pilih Jenis Link --</option>
                <?php $__currentLoopData = $link_tipe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>" <?= ($menu['link_tipe']==$id) ? 'selected' : ''; ?>><?php echo e($nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group" id="jenis_link" style="<?php if(!$menu['link_tipe']): ?> display:none; <?php endif; ?>">
            <label class="control-label" for="link">Link</label>
            <select id="artikel_statis" class="form-control input-sm jenis_link select2" name="<?php echo e(jecho($menu['link_tipe'], 1, 'link')); ?>" style="<?php if($menu['link_tipe'] != 1): ?> display:none; <?php endif; ?>">
                <option value="">-- Pilih Artikel Statis --</option>
                <?php $__currentLoopData = $artikel_statis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="artikel/<?php echo e($data['id']); ?>" <?= ($menu['link']=="artikel/{$data['id']}") ? 'selected' : ''; ?>><?php echo e($data['judul']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select id="halaman_baru" class="form-control input-sm jenis_link select2" name="<?php echo e(jecho($menu['link_tipe'], 1, 'link')); ?>" style="<?php if($menu['link_tipe'] != 12): ?> display:none; <?php endif; ?>">
                <option value="">-- Pilih Halaman Baru --</option>
                <?php $__currentLoopData = $halaman_baru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="halaman/<?php echo e($data['slug']); ?>" <?= ($menu['link']=="halaman/{$data['slug']}") ? 'selected' : ''; ?>><?php echo e($data['judul']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select id="kategori_artikel" class="form-control input-sm jenis_link" name="<?php echo e(jecho($menu['link_tipe'], 8, 'link')); ?>" style="<?php if($menu['link_tipe'] != 8): ?> display:none; <?php endif; ?>">
                <option value="">-- Pilih Kategori Artikel --</option>
                <?php $__currentLoopData = $kategori_artikel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="kategori/<?php echo e($data['slug']); ?>" <?= ($menu['link']=="kategori/{$data['slug']}") ? 'selected' : ''; ?>><?php echo e($data['kategori']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select id="statistik_penduduk" class="form-control input-sm jenis_link" name="<?php echo e(jecho($menu['link_tipe'], 2, 'link')); ?>" style="<?php if($menu['link_tipe'] != 2): ?> display:none; <?php endif; ?>">
                <option value="">-- Pilih Statistik Penduduk --</option>
                <?php $__currentLoopData = $statistik_penduduk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="statistik/<?php echo e($id); ?>" <?= ($menu['link']=="statistik/{$id}") ? 'selected' : ''; ?>><?php echo e($nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select id="statistik_keluarga" class="form-control jenis_link input-sm" name="<?php echo e(jecho($menu['link_tipe'], 3, 'link')); ?>" style="<?php if($menu['link_tipe'] != 3): ?> display:none; <?php endif; ?>">
                <option value="">-- Pilih Statistik Keluarga --</option>
                <?php $__currentLoopData = $statistik_keluarga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="statistik/<?php echo e($id); ?>" <?= ($menu['link']=="statistik/{$id}") ? 'selected' : ''; ?>><?php echo e($nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select id="statistik_program_bantuan" class="form-control input-sm jenis_link" name="<?php echo e(jecho($menu['link_tipe'], 4, 'link')); ?>" style="<?php if($menu['link_tipe'] != 4): ?> display:none; <?php endif; ?>">
                <option value="">-- Pilih Statistik Program Bantuan --</option>
                <?php $__currentLoopData = $statistik_kategori_bantuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="statistik/<?php echo e($id); ?>" <?= ($menu['link']=="statistik/{$id}") ? 'selected' : ''; ?>><?php echo e($nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $statistik_program_bantuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="statistik/50<?php echo e($nama['id']); ?>" <?= ($menu['link']=="statistik/50{$nama['id']}") ? 'selected' : ''; ?>><?php echo e($nama['nama']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select id="statis_lainnya" class="form-control input-sm jenis_link" name="<?php echo e(jecho($menu['link_tipe'], 5, 'link')); ?>" style="<?php if($menu['link_tipe'] != 5): ?> display:none; <?php endif; ?>">
                <option value="">-- Pilih Halaman Statis Lainnya --</option>
                <?php $__currentLoopData = $statis_lainnya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>" <?= ($menu['link']==$id) ? 'selected' : ''; ?>><?php echo e(str_replace(['[Pemerintah Desa]', '[Desa]'], [ucwords(setting('sebutan_pemerintah_desa')), ucwords(setting('sebutan_desa'))], $nama)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select id="artikel_keuangan" class="form-control input-sm jenis_link" name="<?php echo e(jecho($menu['link_tipe'], 6, 'link')); ?>" style="<?php if($menu['link_tipe'] != 6): ?> display:none; <?php endif; ?>">
                <option value="">-- Pilih Artikel Keuangan --</option>
                <?php $__currentLoopData = $artikel_keuangan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="artikel/<?php echo e($data['id']); ?>" <?= ($menu['link']=="artikel/{$data['id']}") ? 'selected' : ''; ?>><?php echo e($data['judul']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select id="kelompok" class="form-control input-sm jenis_link required" name="<?php echo e(jecho($menu['link_tipe'], 7, 'link')); ?>" style="<?php if($menu['link_tipe'] != 7): ?> display:none; <?php endif; ?>">
                <option value="">Pilih Kelompok</option>
                <?php $__currentLoopData = $kelompok; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="data-kelompok/<?php echo e($kel['id']); ?>" <?= ($menu['link']=="data-kelompok/{$kel['id']}") ? 'selected' : ''; ?>><?php echo e($kel['nama'] . ' (' . $kel['master'] . ')'); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select id="lembaga" class="form-control input-sm jenis_link required" name="<?php echo e(jecho($menu['link_tipe'], 7, 'link')); ?>" style="<?php if($menu['link_tipe'] != 7): ?> display:none; <?php endif; ?>">
                <option value="">Pilih Lembaga</option>
                <?php $__currentLoopData = $lembaga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="data-lembaga/<?php echo e($lem['id']); ?>" <?= ($menu['link']=="data-lembaga/{$lem['id']}") ? 'selected' : ''; ?>><?php echo e($lem['nama'] . ' (' . $lem['master'] . ')'); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select id="suplemen" class="form-control input-sm jenis_link required" name="<?php echo e(jecho($menu['link_tipe'], 9, 'link')); ?>" style="<?php if($menu['link_tipe'] != 9): ?> display:none; <?php endif; ?>">
                <option value="">Pilih Suplemen</option>
                <?php $__currentLoopData = $suplemen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="data-suplemen/<?php echo e($sup['id']); ?>" <?= ($menu['link']=="data-suplemen/{$sup['id']}") ? 'selected' : ''; ?>><?php echo e($sup['nama']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select id="status_idm" class="form-control input-sm jenis_link required" name="<?php echo e(jecho($menu['link_tipe'], 10, 'link')); ?>" style="<?php if($menu['link_tipe'] != 10): ?> display:none; <?php endif; ?>">
                <option value="">Pilih Tahun</option>
                <?php $__currentLoopData = tahun(2020); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="status-idm/<?php echo e($thn); ?>" <?= ($menu['link']=="status-idm/{$thn}") ? 'selected' : ''; ?>><?php echo e($thn); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <span id="eksternal" class="jenis_link" style="<?php if($menu['link_tipe'] != 99): ?> display:none; <?php endif; ?>">
                <input name="<?php echo e(jecho($menu['link_tipe'], 99, 'link')); ?>" class="form-control input-sm" type="text" value="<?php echo e($menu['link']); ?>" />
                <span class="text-sm text-red">(misalnya: https://opendesa.id)</span>
            </span>
        </div>
    </div>
    <div class="modal-footer">
        <?php echo batal(); ?>

        <button type="submit" class="btn btn-social btn-info btn-sm confirm"><i class="fa fa-check"></i> Simpan</button>
    </div>
</form>
<?php echo $__env->make('admin.layouts.components.form_modal_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    function ganti_jenis_link(elm) {
        let jenis = $(elm).val()
        $('#jenis_link').show();
        $('.jenis_link').hide();
        $('.jenis_link').removeAttr("name");
        $('.jenis_link').removeClass('required');
        // Select2 membuat span terpisah dan perlu ditangani khusus
        $('span.select2').hide();
        $('#eksternal > input').attr('name', '');

        if (jenis == '1') {
            $('#artikel_statis').show();
            $('#artikel_statis').attr('name', 'link');
            $('#artikel_statis').addClass('required');
        } else if (jenis == '2') {
            $('#statistik_penduduk').show();
            $('#statistik_penduduk').attr('name', 'link');
            $('#statistik_penduduk').addClass('required');
        } else if (jenis == '3') {
            $('#statistik_keluarga').show();
            $('#statistik_keluarga').attr('name', 'link');
            $('#statistik_keluarga').addClass('required');
        } else if (jenis == '4') {
            $('#statistik_program_bantuan').show();
            $('#statistik_program_bantuan').attr('name', 'link');
            $('#statistik_program_bantuan').addClass('required');
        } else if (jenis == '5') {
            $('#statis_lainnya').show();
            $('#statis_lainnya').attr('name', 'link');
            $('#statis_lainnya').addClass('required');
        } else if (jenis == '6') {
            $('#artikel_keuangan').show();
            $('#artikel_keuangan').attr('name', 'link');
            $('#artikel_keuangan').addClass('required');
        } else if (jenis == '7') {
            $('#kelompok').show();
            $('#kelompok').attr('name', 'link');
            $('#kelompok').addClass('required');
        } else if (jenis == '8') {
            $('#kategori_artikel').show();
            $('#kategori_artikel').attr('name', 'link');
            $('#kategori_artikel').addClass('required');
        } else if (jenis == '9') {
            $('#suplemen').show();
            $('#suplemen').attr('name', 'link');
            $('#suplemen').addClass('required');
        } else if (jenis == '10') {
            $('#status_idm').show();
            $('#status_idm').attr('name', 'link');
            $('#status_idm').addClass('required');
        } else if (jenis == '11') {
            $('#lembaga').show();
            $('#lembaga').attr('name', 'link');
            $('#lembaga').addClass('required');
        } else if (jenis == '12') {
            $('#halaman_baru').show();
            $('#halaman_baru').attr('name', 'link');
            $('#halaman_baru').addClass('required');
        } else if (jenis == '99') {
            $('#eksternal').show();
            $('#eksternal > input').show();
            $('#eksternal > input').attr('name', 'link');
        } else {
            $('#jenis_link').hide();
        }

        $('select.jenis_link:visible').select2({
            width: '100%',
            dropdownAutoWidth: true
        });
    }

    $(document).ready(function() {

        $('#batal').click(function() {
            $('#link_tipe').change();
        });

        setTimeout(function() {
            $('#link_tipe').change();
        }, 500);
    });
</script><?php /**PATH C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\resources\views/admin/web/menu/ajax_form.blade.php ENDPATH**/ ?>