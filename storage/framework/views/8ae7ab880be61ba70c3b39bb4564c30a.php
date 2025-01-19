<div class="row">
    <?php if($jenis_peristiwa == 5 && !$penduduk['tgl_peristiwa']): ?>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label for="tgl_peristiwa">Tanggal Pindah Masuk</label>
                <div class="input-group input-group-sm date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control input-sm pull-right tgl_sekarang required" name="tgl_peristiwa" type="text" value="<?php echo e($penduduk['tgl_peristiwa'] ? rev_tgl($penduduk['tgl_peristiwa']) : date('d-m-Y')); ?>">
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(!$penduduk['tgl_lapor']): ?>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label for="tgl_lapor">Tanggal Lapor</label>
                <div class="input-group input-group-sm date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control input-sm pull-right tgl_sekarang required" name="tgl_lapor" type="text" value="<?php echo e($penduduk['tgl_lapor'] ? rev_tgl($penduduk['tgl_lapor']) : date('d-m-Y')); ?>">
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class='col-sm-12'>
        <div class="form-group subtitle_head">
            <label class="text-right"><strong>DATA DIRI :</strong></label>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="nik">NIK <code id="tampil_nik" style="display: none;"> (Sementara) </code></label>
            <div class="input-group input-group-sm">
                <span class="input-group-addon">
                    <input type="checkbox" title="Centang jika belum memiliki NIK" id="nik_sementara" <?= ($jenis_peristiwa == 1 || $cek_nik == 0) ? 'checked' : ''; ?>>
                </span>
                <input
                    id="nik"
                    name="nik"
                    class="form-control input-sm required nik"
                    type="text"
                    placeholder="Nomor NIK"
                    value="<?php echo e($penduduk['nik']); ?>"
                    <?php if($cek_nik == '0'): echo 'readonly'; endif; ?>
                ></input>
            </div>
        </div>
    </div>
    <div class='col-sm-8'>
        <div class='form-group'>
            <label for="nama">Nama Lengkap <code> (Tanpa Gelar) </code> </label>
            <input
                id="nama"
                name="nama"
                class="form-control input-sm required nama"
                maxlength="100"
                type="text"
                placeholder="Nama Lengkap"
                value="<?php echo e(strtoupper($penduduk['nama'])); ?>"
            ></input>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class="row">
            <div class="col-sm-12">
                <div class='form-group'>
                    <label for="nama">Status Kepemilikan Identitas</label>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
                            <thead class="bg-gray disabled color-palette">
                                <tr>
                                    <th width='25%'>Wajib Identitas</th>
                                    <th>Identitas Elektronik</th>
                                    <th>Status Rekam</th>
                                    <th>Tag ID Card</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php if($penduduk['wajib_ktp'] != null): ?>
                                        <td width='25%'><?php echo e(strtoupper($penduduk['wajib_ktp'])); ?></td>
                                    <?php else: ?>
                                        <td width='25%'><label id="wajib_ktp"></label></td>
                                    <?php endif; ?>
                                    <td>
                                        <select name="ktp_el" id="ktp_el" class="form-control input-sm wajib_identitas" onchange="show_hide_ktp_el($(this).find(':selected').val())">
                                            <option value="">Pilih Identitas-EL</option>
                                            <?php $__currentLoopData = $ktp_el; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?= (($jenis_peristiwa == '1' && $key == 3) || $penduduk['ktp_el'] == $key) ? 'selected' : ''; ?>>
                                                    <?php echo e(strtoupper($nama)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td width='25%'>
                                        <select name="status_rekam" class="form-control input-sm wajib_identitas">
                                            <option value="">Pilih Status Rekam</option>
                                            <?php $__currentLoopData = $status_rekam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?= ($penduduk['status_rekam'] == $key) ? 'selected' : ''; ?>>
                                                    <?php echo e(strtoupper($nama)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td width='25%'>
                                        <input
                                            id="tag_id_card"
                                            name="tag_id_card"
                                            class="form-control input-sm digits"
                                            type="text"
                                            minlength="10"
                                            maxlength="17"
                                            placeholder="Tag Id Card"
                                            value="<?php echo e($penduduk['tag_id_card']); ?>"
                                        ></input>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="section_ktp_el">
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="tempat_cetak_ktp">Tempat Penerbitan KTP</label>
                    <input
                        id="tempat_cetak_ktp"
                        name="tempat_cetak_ktp"
                        class="form-control input-sm"
                        maxlength="150"
                        type="text"
                        placeholder="Tempat Penerbitan KTP"
                        value="<?php echo e($penduduk['tempat_cetak_ktp']); ?>"
                    ></input>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="tanggal_cetak_ktp">Tanggal Penerbitan KTP</label>
                    <div class="input-group input-group-sm date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input class="form-control input-sm pull-right" id="tanggal_cetak_ktp" name="tanggal_cetak_ktp" type="text" value="<?php echo e($penduduk['tanggal_cetak_ktp'] ? date('d-m-Y', strtotime($penduduk['tanggal_cetak_ktp'])) : ''); ?> }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="no_kk_sebelumnya">Nomor KK Sebelumnya</label>
            <input
                id="no_kk_sebelumnya"
                name="no_kk_sebelumnya"
                class="form-control input-sm no_kk"
                maxlength="30"
                type="text"
                placeholder="No KK Sebelumnya"
                value="<?php echo e(strtoupper($penduduk['no_kk_sebelumnya'])); ?>"
            ></input>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="kk_level">Hubungan Dalam Keluarga</label>
            <select id="kk_level" class="form-control input-sm required select2" name="kk_level">
                <option value="">Pilih Hubungan Keluarga</option>
                <?php $__currentLoopData = $hubungan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penduduk['kk_level'] == $key) ? 'selected' : ''; ?> <?= ($key == 1 && $keluarga['status_dasar'] == '2') ? 'disabled' : ''; ?>>
                        <?php echo e(strtoupper($value)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="sex">Jenis Kelamin </label>
            <select class="form-control input-sm required" name="sex" onchange="ubah_sex($(this).find(':selected').val());">
                <option value="">Jenis Kelamin</option>
                <option value="1" <?= ($penduduk['id_sex'] == \App\Enums\JenisKelaminEnum::LAKI_LAKI) ? 'selected' : ''; ?>>Laki-Laki</option>
                <option value="2" <?= ($penduduk['id_sex'] == \App\Enums\JenisKelaminEnum::PEREMPUAN) ? 'selected' : ''; ?>>Perempuan</option>
            </select>
        </div>
    </div>
    <div class='col-sm-7'>
        <div class='form-group'>
            <label for="agama_id">Agama</label>
            <select class="form-control input-sm required" name="agama_id">
                <option value="">Pilih Agama</option>
                <?php $__currentLoopData = $agama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penduduk['agama_id'] == $key) ? 'selected' : ''; ?>><?php echo e(strtoupper($value)); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class='col-sm-5'>
        <div class='form-group'>
            <label for="status">Status Penduduk </label>
            <select class="form-control input-sm required" id="status_penduduk" name="status" onchange="show_hide_penduduk_tidak_tetap($(this).find(':selected').val())" <?= ($penduduk['no_kk']) ? 'disabled' : ''; ?>>
                <option value="">Pilih Status Penduduk</option>
                <?php $__currentLoopData = $status_penduduk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penduduk['id_status'] == $key) ? 'selected' : ''; ?>><?php echo e(strtoupper($value)); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div id="section_penduduk_tidak_tetap">
        <div class='col-sm-12'>
            <div class="form-group subtitle_head">
                <label class="text-right"><strong>DATA PENDUDUK TIDAK TETAP :</strong></label>
            </div>
        </div>
        <div class='col-sm-8'>
            <div class='form-group'>
                <label for="maksud_tujuan_kedatangan">Maksud dan Tujuan Kedatangan</label>
                <textarea id="maksud_tujuan_kedatangan" name="maksud_tujuan_kedatangan" class="form-control input-sm" style="resize: none" placeholder="Maksud dan Tujuan Kedatangan"><?php echo e($penduduk['maksud_tujuan_kedatangan']); ?></textarea>
            </div>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class="form-group subtitle_head">
            <label class="text-right"><strong>DATA KELAHIRAN :</strong></label>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="akta_lahir">Nomor Akta Kelahiran </label>
            <input
                id="akta_lahir"
                name="akta_lahir"
                class="form-control input-sm nomor_sk"
                type="text"
                maxlength="40"
                placeholder="Nomor Akta Kelahiran"
                value="<?php echo e($penduduk['akta_lahir']); ?>"
            ></input>
        </div>
    </div>
    <div class='col-sm-8'>
        <div class='form-group'>
            <label for="tempatlahir">Tempat Lahir</label>
            <input
                id="tempatlahir"
                name="tempatlahir"
                class="form-control input-sm required"
                maxlength="100"
                type="text"
                placeholder="Tempat Lahir"
                value="<?php echo e(strtoupper($penduduk['tempatlahir'])); ?>"
            ></input>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="tanggallahir">Tanggal Lahir</label>
            <div class="input-group input-group-sm date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input class="form-control input-sm pull-right required" id="tgl_lahir" name="tanggallahir" type="text" value="<?php echo e($penduduk['tanggallahir']); ?>">
            </div>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="waktulahir">Waktu Kelahiran </label>
            <div class="input-group input-group-sm date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input class="form-control input-sm pull-right" id="jammenit_1" name="waktu_lahir" type="text" value="<?php echo e($penduduk['waktu_lahir']); ?>">
            </div>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="tempat_dilahirkan">Tempat Dilahirkan</label>
            <select class="form-control input-sm" name="tempat_dilahirkan">
                <option value="">Pilih Tempat Dilahirkan</option>
                <?php $__currentLoopData = $tempat_dilahirkan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penduduk['tempat_dilahirkan'] == $key) ? 'selected' : ''; ?>><?php echo e(strtoupper($value)); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class='row'>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="jenis_kelahiran">Jenis Kelahiran</label>
                    <select class="form-control input-sm" name="jenis_kelahiran">
                        <option value="">Pilih Jenis Kelahiran</option>
                        <?php $__currentLoopData = $jenis_kelahiran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?= ($penduduk['jenis_kelahiran'] == $key) ? 'selected' : ''; ?>>
                                <?php echo e(strtoupper($value)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="kelahiran_anak_ke">Anak Ke <code>(Isi dengan angka)</code></label>
                    <input
                        id="kelahiran_anak_ke"
                        name="kelahiran_anak_ke"
                        class="form-control input-sm number"
                        min="1"
                        max="20"
                        type="number"
                        placeholder="Anak Ke-"
                        value="<?php echo e($penduduk['kelahiran_anak_ke']); ?>"
                    ></input>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="penolong_kelahiran">Penolong Kelahiran</label>
                    <select class="form-control input-sm" name="penolong_kelahiran">
                        <option value="">Pilih Penolong Kelahiran</option>
                        <?php $__currentLoopData = $penolong_kelahiran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?= ($penduduk['penolong_kelahiran'] == $key) ? 'selected' : ''; ?>><?php echo e(strtoupper($nama)); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class='row'>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="berat_lahir">Berat Lahir <code>( Gram )</code></label>
                    <input
                        id="berat_lahir"
                        name="berat_lahir"
                        class="form-control input-sm number"
                        maxlength="6"
                        type="text"
                        placeholder="Berat Lahir"
                        value="<?php echo e(strtoupper($penduduk['berat_lahir'])); ?>"
                    ></input>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="panjang_lahir">Panjang Lahir <code>( cm )</code></label>
                    <input
                        id="panjang_lahir"
                        name="panjang_lahir"
                        class="form-control input-sm number"
                        maxlength="3"
                        type="text"
                        placeholder="Panjang Lahir"
                        value="<?php echo e(strtoupper($penduduk['panjang_lahir'])); ?>"
                    ></input>
                </div>
            </div>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class="form-group subtitle_head">
            <label class="text-right"><strong>PENDIDIKAN DAN PEKERJAAN :</strong></label>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="pendidikan_kk_id">Pendidikan Dalam KK </label>
            <select class="form-control input-sm required" name="pendidikan_kk_id">
                <option value="">Pilih Pendidikan (Dalam KK) </option>
                <?php $__currentLoopData = $pendidikan_kk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penduduk['pendidikan_kk_id'] == $key || ($jenis_peristiwa == '1' && $key == 1)) ? 'selected' : ''; ?>><?php echo e(strtoupper($value)); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="pendidikan_sedang_id">Pendidikan Sedang Ditempuh </label>
            <select class="form-control input-sm" name="pendidikan_sedang_id">
                <option value="">Pilih Pendidikan</option>
                <?php $__currentLoopData = $pendidikan_sedang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penduduk['pendidikan_sedang_id'] == $key || ($jenis_peristiwa == '1' && $key == 18)) ? 'selected' : ''; ?>><?php echo e(strtoupper($value)); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="pekerjaan_id">Pekerjaaan</label>
            <select class="form-control input-sm required" name="pekerjaan_id">
                <option value="">Pilih Pekerjaan</option>
                <?php $__currentLoopData = $pekerjaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penduduk['pekerjaan_id'] == $key || ($jenis_peristiwa == '1' && $key == '1')) ? 'selected' : ''; ?>><?php echo e(strtoupper($value)); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class="form-group subtitle_head">
            <label class="text-right"><strong>DATA KEWARGANEGARAAN :</strong></label>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class='form-group'>
            <label for="etnis">Suku/Etnis</label>
            <select class="form-control input-sm select2-tags nama_suku" data-url="<?php echo e(ci_route('penduduk.ajax_penduduk_suku')); ?>" data-placeholder="Pilih Suku/Etnis" id="suku" name="suku">
                <option value="">Pilih Suku/Etnis</option>
                <?php if($suku_penduduk): ?>
                    <?php $__currentLoopData = $suku_penduduk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?= ($penduduk['suku'] == $key) ? 'selected' : ''; ?>><?php echo e($key); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <optgroup label="----------"></optgroup>
                <?php endif; ?>
                <?php $__currentLoopData = $suku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penduduk['suku'] == $key) ? 'selected' : ''; ?>><?php echo e($key); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="warganegara_id">Status Warga Negara</label>
            <select class="form-control input-sm required" id="warganegara_id" name="warganegara_id" onchange="show_hide_status_warga_negara($(this).find(':selected').val())">
                <option value="">Pilih Warga Negara</option>
                <?php $__currentLoopData = $warganegara; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penduduk['warganegara_id'] == $key) ? 'selected' : ''; ?>><?php echo e(strtoupper($value)); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class='col-sm-8'>
        <div class='form-group'>
            <label for="dokumen_pasport">Nomor Paspor </label>
            <input
                id="dokumen_pasport"
                name="dokumen_pasport"
                class="form-control input-sm nomor_sk"
                maxlength="45"
                type="text"
                placeholder="Nomor Paspor"
                value="<?php echo e(strtoupper($penduduk['dokumen_pasport'])); ?>"
            ></input>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="tanggal_akhir_paspor">Tgl Berakhir Paspor</label>
            <div class="input-group input-group-sm date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input class="form-control input-sm pull-right" id="tgl_2" name="tanggal_akhir_paspor" type="text" value="<?php echo e($penduduk['tanggal_akhir_paspor']); ?>">
            </div>
        </div>
    </div>
    <div class='col-sm-8' id='field_dokumen_kitas'>
        <div class='form-group'>
            <label for="dokumen_kitas">Nomor KITAS/KITAP </label>
            <input
                id="dokumen_kitas"
                name="dokumen_kitas"
                class="form-control input-sm number"
                maxlength="45"
                type="text"
                placeholder="Nomor KITAS/KITAP"
                value="<?php echo e(strtoupper($penduduk['dokumen_kitas'])); ?>"
            ></input>
        </div>
    </div>
    <div class='col-sm-4' id='field_negara_asal'>
        <div class='form-group'>
            <label for="negara_asal">Negara Asal</label>
            <input
                id="negara_asal"
                name="negara_asal"
                class="form-control input-sm"
                maxlength="10"
                type="text"
                placeholder="Negara Asal"
                value="<?php echo e(strtoupper($penduduk['negara_asal'])); ?>"
            ></input>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class="form-group subtitle_head">
            <label class="text-right"><strong>DATA ORANG TUA :</strong></label>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="ayah_nik"> NIK Ayah </label>
                    <input id="ayah_nik" name="ayah_nik" class="form-control input-sm nik" type="text" placeholder="Nomor NIK Ayah" value="<?php echo e($penduduk['ayah_nik']); ?>"></input>
                </div>
            </div>
            <div class='col-sm-8'>
                <div class='form-group'>
                    <label for="nama_ayah">Nama Ayah </label>
                    <input
                        id="nama_ayah"
                        name="nama_ayah"
                        class="form-control input-sm required nama"
                        maxlength="100"
                        type="text"
                        placeholder="Nama Ayah"
                        value="<?php echo e(strtoupper($penduduk['nama_ayah'])); ?>"
                    ></input>
                </div>
            </div>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="ibu_nik"> NIK Ibu </label>
            <input id="ibu_nik" name="ibu_nik" class="form-control input-sm nik" type="text" placeholder="Nomor NIK Ibu" value="<?php echo e($penduduk['ibu_nik']); ?>"></input>
        </div>
    </div>
    <div class='col-sm-8'>
        <div class='form-group'>
            <label for="nama_ibu">Nama Ibu </label>
            <input
                id="nama_ibu"
                name="nama_ibu"
                class="form-control input-sm required nama"
                maxlength="100"
                type="text"
                placeholder="Nama Ibu"
                value="<?php echo e(strtoupper($penduduk['nama_ibu'])); ?>"
            ></input>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class="form-group subtitle_head">
            <label class="text-right"><strong>ALAMAT :</strong></label>
        </div>
    </div>
    <?php if(!empty($penduduk['no_kk']) || $kk_baru): ?>
        <div class='col-sm-12'>
            <div class='form-group'>
                <label for="alamat">Alamat KK </label>
                <input
                    id="alamat"
                    name="alamat"
                    class="form-control input-sm nomor_sk"
                    maxlength="200"
                    type="text"
                    placeholder="Alamat di Kartu Keluarga"
                    value="<?php echo e($penduduk['alamat']); ?>"
                ></input>
            </div>
        </div>
    <?php endif; ?>
    <?php if(empty($id_kk)): ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group col-sm-3">
                    <label for="dusun"><?php echo e(ucwords(setting('sebutan_dusun'))); ?> <?php if(!(empty($penduduk['no_kk']) && empty($kk_baru))): ?>
                            <?php echo e('KK'); ?>

                        <?php endif; ?>
                    </label>
                    <select id="dusun" class="form-control input-sm select2 required">
                        <option value="">Pilih <?php echo e(ucwords(setting('sebutan_dusun'))); ?></option>
                        <?php $__currentLoopData = $wilayah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyDusun => $dusun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($keyDusun); ?>" <?= ($keyDusun == $penduduk['wilayah']['dusun']) ? 'selected' : ''; ?>><?php echo e($keyDusun); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label for="rw">RW <?php if(!(empty($penduduk['no_kk']) && empty($kk_baru))): ?>
                            <?php echo e('KK'); ?>

                        <?php endif; ?>
                    </label>
                    <select id="rw" name="rw" class="form-control input-sm select2 required">
                        <option value="">Pilih RW</option>
                        <?php $__currentLoopData = $wilayah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyDusun => $dusun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <optgroup value="<?php echo e($keyDusun); ?>" label="<?php echo e(ucwords(setting('sebutan_dusun')) . ' ' . $keyDusun); ?>" <?= ($penduduk['wilayah']['dusun'] != $keyDusun) ? 'disabled' : ''; ?>>
                                <?php $__currentLoopData = $dusun; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyRw => $rw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($keyDusun); ?>__<?php echo e($keyRw); ?>" <?= ($penduduk['wilayah']['rw'] == $keyRw && $penduduk['wilayah']['dusun'] == $keyDusun) ? 'selected' : ''; ?>><?php echo e($keyRw); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label for="rt">RT <?php if(!(empty($penduduk['no_kk']) && empty($kk_baru))): ?>
                            <?php echo e('KK'); ?>

                        <?php endif; ?>
                    </label>
                    <select id="id_cluster" name="id_cluster" class="form-control input-sm select2 required">
                        <option value="">Pilih RT</option>
                        <?php $__currentLoopData = $wilayah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyDusun => $dusun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $dusun; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyRw => $rw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <optgroup value="<?php echo e($keyDusun); ?>__<?php echo e($keyRw); ?>" label="<?php echo e('RW ' . $keyRw); ?>" <?= ($penduduk['wilayah']['rw'] != $keyRw || $penduduk['wilayah']['dusun'] != $keyDusun) ? 'disabled' : ''; ?>>
                                    <?php $__currentLoopData = $rw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($rt->id); ?>" <?= ($penduduk['id_cluster'] == $rt->id) ? 'selected' : ''; ?>><?php echo e($rt->rt); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </optgroup>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class='col-sm-12'>
        <div class='form-group'>
            <label for="alamat_sebelumnya">Alamat Sebelumnya </label>
            <input
                id="alamat_sebelumnya"
                name="alamat_sebelumnya"
                class="form-control input-sm nomor_sk <?php echo e(jecho($jenis_peristiwa, 5, 'required')); ?>"
                maxlength="200"
                type="text"
                placeholder="Alamat Sebelumnya"
                value="<?php echo e($penduduk['alamat_sebelumnya']); ?>"
            ></input>
        </div>
    </div>
    <?php if(!$penduduk['no_kk'] && !$kk_baru): ?>
        <div class='col-sm-12'>
            <div class='form-group'>
                <label for="alamat_sekarang">Alamat Sekarang </label>
                <input
                    id="alamat_sekarang"
                    name="alamat_sekarang"
                    class="form-control input-sm"
                    maxlength="200"
                    type="text"
                    placeholder="Alamat Sekarang"
                    value="<?php echo e($penduduk['alamat_sekarang']); ?>"
                ></input>
            </div>
        </div>
    <?php endif; ?>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="telepon"> Nomor Telepon </label>
            <input
                id="telepon"
                name="telepon"
                class="form-control input-sm number"
                type="text"
                maxlength="20"
                placeholder="Nomor Telepon"
                value="<?php echo e($penduduk['telepon']); ?>"
            ></input>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="email"> Email </label>
            <input id="email" name="email" class="form-control input-sm email" maxlength="50" placeholder="Alamat Email" value="<?php echo e($penduduk['email']); ?>"></input>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="telegram"> Telegram </label>
            <input name="telegram" class="form-control input-sm number" maxlength="100" type="text" placeholder="Akun Telegram" value="<?php echo e($penduduk['telegram']); ?>"></input>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="hubung_warga"> Cara Hubung Warga </label>
            <select class="form-control input-sm" name="hubung_warga">
                <option value="">Pilih Cara Hubungi</option>
                <?php $__currentLoopData = ['SMS', 'Email', 'Telegram']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if((bool) setting('aktifkan_sms') === false && $value === 'SMS'): ?>
                        <?php continue; ?>;
                    <?php endif; ?>

                    <option value="<?php echo e($value); ?>" <?= ($penduduk['hubung_warga'] == $value) ? 'selected' : ''; ?>><?php echo e($value); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class="form-group subtitle_head">
            <label class="text-right"><strong>STATUS PERKAWINAN :</strong></label>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="status_kawin">Status Perkawinan</label>
            <select class="form-control input-sm required" name="status_kawin" <?php if($jenis_peristiwa == '1'): ?> onload="disable_kawin_cerai($(this).find(':selected').val())" <?php endif; ?> onchange="disable_kawin_cerai($(this).find(':selected').val())" id="status_perkawinan">
                <option value="">Pilih Status Perkawinan</option>
                <?php $__currentLoopData = $kawin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penduduk['status_kawin'] == $key || ($jenis_peristiwa == '1' && $key == 1)) ? 'selected' : ''; ?>><?php echo e(strtoupper($value)); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <?php if($penduduk['agama_id'] == 0 || null === $penduduk['agama_id']): ?>
                <label for="akta_perkawinan">No. Akta Nikah (Buku Nikah)/Perkawinan </label>
            <?php elseif($penduduk['agama_id'] == 1): ?>
                <label for="akta_perkawinan">No. Akta Nikah (Buku Nikah) </label>
            <?php else: ?>
                <label for="akta_perkawinan">No. Akta Perkawinan </label>
            <?php endif; ?>
            <input
                id="akta_perkawinan"
                name="akta_perkawinan"
                class="form-control input-sm nomor_sk"
                type="text"
                maxlength="40"
                placeholder="Nomor Akta Perkawinan"
                value="<?php echo e($penduduk['akta_perkawinan']); ?>"
            ></input>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="tanggalperkawinan">Tanggal Perkawinan <code>(Wajib diisi apabila status KAWIN)</code></label>
            <div class="input-group input-group-sm date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input class="form-control input-sm pull-right" id="tgl_3" name="tanggalperkawinan" type="text" value="<?php echo e($penduduk['tanggalperkawinan'] ? date('d-m-Y', strtotime($penduduk['tanggalperkawinan'])) : ''); ?>">
            </div>
        </div>
    </div>
    <div class='col-sm-8'>
        <div class='form-group'>
            <label for="akta_perceraian">Akta Perceraian </label>
            <input
                id="akta_perceraian"
                name="akta_perceraian"
                class="form-control input-sm nomor_sk"
                maxlength="40"
                type="text"
                placeholder="Akta Perceraian"
                value="<?php echo e(strtoupper($penduduk['akta_perceraian'])); ?>"
            ></input>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="tanggalperceraian">Tanggal Perceraian <code>(Wajib diisi apabila status CERAI)</code></label>
            <div class="input-group input-group-sm date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input class="form-control input-sm pull-right" id="tgl_4" name="tanggalperceraian" type="text" value="<?php echo e($penduduk['tanggalperceraian']); ?>">
            </div>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class="form-group subtitle_head">
            <label class="text-right"><strong>DATA KESEHATAN :</strong></label>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class="row">
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="golongan_darah_id">Golongan Darah</label>
                    <select class="form-control input-sm required" name="golongan_darah_id">
                        <option value="">Pilih Golongan Darah</option>
                        <?php $__currentLoopData = $golongan_darah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?= ($penduduk['golongan_darah_id'] == $key) ? 'selected' : ''; ?>>
                                <?php echo e(strtoupper($value)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="cacat_id">Cacat</label>
                    <select class="form-control input-sm" name="cacat_id">
                        <option value="">Pilih Jenis Cacat</option>
                        <?php $__currentLoopData = $cacat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?= ($penduduk['cacat_id'] == $key) ? 'selected' : ''; ?>>
                                <?php echo e(strtoupper($value)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="sakit_menahun_id">Sakit Menahun</label>
                    <select class="form-control input-sm" name="sakit_menahun_id">
                        <option value="">Pilih Sakit Menahun</option>
                        <?php $__currentLoopData = $sakit_menahun; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?= ($penduduk['sakit_menahun_id'] == $key) ? 'selected' : ''; ?>>
                                <?php echo e(strtoupper($value)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class='col-sm-4' id="akseptor_kb">
        <div class='form-group'>
            <label for="cara_kb_id">Akseptor KB</label>
            <select class="form-control input-sm" name="cara_kb_id">
                <option value="">Pilih Cara KB Saat Ini</option>
                <?php $__currentLoopData = $cara_kb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penduduk['cara_kb_id'] == $key) ? 'selected' : ''; ?>><?php echo e(strtoupper($value)); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div id='isian_hamil' class='col-sm-4'>
        <div class='form-group'>
            <label for="hamil">Status Kehamilan </label>
            <select class="form-control input-sm" name="hamil">
                <option value="">Pilih Status Kehamilan</option>
                <?php $__currentLoopData = $kehamilan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penduduk['hamil'] == $key) ? 'selected' : ''; ?>><?php echo e(strtoupper($value)); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="id_asuransi">Asuransi Kesehatan</label>
            <select class="form-control input-sm" name="id_asuransi" onchange="show_hide_asuransi($(this).find(':selected').val());">
                <option value="">Pilih Asuransi</option>
                <?php $__currentLoopData = $pilihan_asuransi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penduduk['id_asuransi'] == $key) ? 'selected' : ''; ?>><?php echo e(strtoupper($value)); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div id='asuransi_pilihan' class='col-sm-4'>
        <div class='form-group'>
            <label id="label-no-asuransi" for="no_asuransi">No Asuransi </label>
            <input
                id="no_asuransi"
                name="no_asuransi"
                class="form-control input-sm nomor_sk"
                type="text"
                maxlength="100"
                placeholder="Nomor Asuransi"
                value="<?php echo e($penduduk['no_asuransi']); ?>"
            ></input>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">
                <div class='form-group'>
                    <label id="label-no-bpjs-ketenagakerjaan" for="bpjs_ketenagakerjaan">Nomor BPJS
                        Ketenagakerjaan</label>
                    <input
                        id="bpjs_ketenagakerjaan"
                        name="bpjs_ketenagakerjaan"
                        class="form-control input-sm nomor_sk"
                        type="text"
                        maxlength="100"
                        placeholder="Nomor BPJS Ketenagakerjaan"
                        value="<?php echo e($penduduk['bpjs_ketenagakerjaan']); ?>"
                    ></input>
                </div>
            </div>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class="form-group subtitle_head">
            <label class="text-right"><strong>LAINNYA :</strong></label>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class="row">
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="bahasa_id">Dapat Membaca Huruf</label>
                    <select class="form-control input-sm" id="bahasa_id" name="bahasa_id">
                        <option value="0">Pilih Isian</option>
                        <?php $__currentLoopData = $bahasa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?= ($penduduk['bahasa_id'] == $key) ? 'selected' : ''; ?>>
                                <?php echo e(strtoupper($value)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class='col-sm-8'>
                <div class='form-group'>
                    <label for="ket">Keterangan</label>
                    <textarea id="ket" name="ket" class="form-control input-sm" rows="3" placeholder="Keterangan"><?php echo e($penduduk['ket']); ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('css'); ?>
    <style>
        .select2-results__option[aria-disabled=true] {
            display: none;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tgl_lahir').datetimepicker({
                format: 'DD-MM-YYYY',
                locale: 'id',
                maxDate: 'now',
            });

            $('.select2-tags').select2({
                tags: true
            });

            var addOrRemoveRequiredAttribute = function() {
                var tglsekarang = new Date();
                var tgllahir = parseInt($('#tgl_lahir').val().substring(6, 10));
                var selisih = tglsekarang.getFullYear() - tgllahir;
                var wajib_identitas = $('.wajib_identitas');
                var status_perkawinan = document.getElementById("status_perkawinan").value;
                if (selisih > 16 || (status_perkawinan != '' && status_perkawinan > 1)) {
                    $('#wajib_ktp').text('WAJIB');
                } else {
                    $('#wajib_ktp').text('BELUM WAJIB');
                }
            };

            $("#tgl_lahir").on('change keyup paste click keydown', addOrRemoveRequiredAttribute);
            $("#status_perkawinan").on('change keyup paste click keydown select', addOrRemoveRequiredAttribute);
            $(".form-control").on('change keyup paste click keydown select', addOrRemoveRequiredAttribute);

            $('#tag_id_card').focus();

            $("#kk_level").change(function() {
                var selected = $(this).val();

                orang_tua();

                if (selected == 2 || selected == 3) {
                    $("#status_perkawinan").val("2").change();
                } else {
                    $("#status_perkawinan").val("").change();
                }
            });

            $("select[name='sex']").change();
            $("select[name='status_kawin']").change();
            $("select[name='id_asuransi']").change();

            $('#nik_sementara').change(function() {
                var cek_nik = '<?php echo e($cek_nik); ?>';
                var nik_sementara_berikut = '<?php echo e($nik_sementara); ?>';
                var nik_asli = '<?php echo e($penduduk['nik']); ?>';
                if ($('#nik_sementara').prop('checked')) {
                    $('#nik').removeClass('nik');
                    if (cek_nik != '0') $('#nik').val(nik_sementara_berikut);
                    $('#nik').prop('readonly', true);
                    $('#tampil_nik').show();
                } else {
                    $('#nik').addClass('nik');
                    $('#nik').val(nik_asli);
                    $('#nik').prop('readonly', false);
                    $('#tampil_nik').hide();
                }
            });

            $('#nik_sementara').change();

            show_hide_penduduk_tidak_tetap($('#status_penduduk').val());
            show_hide_status_warga_negara($('#warganegara_id').val());
            show_hide_ktp_el($('#ktp_el').val());

            $('#mainform #dusun').change(function() {
                let _label = $(this).find('option:selected').val()
                $('#mainform #rw').find(`optgroup`).prop('disabled', 1)
                if ($(this).val()) {
                    $('#mainform #rw').closest('div').show()
                    $('#mainform #rw').find(`optgroup[value="${_label}"]`).prop('disabled', 0)
                } else {
                    $('#mainform #rw').closest('div').hide()
                }
                $('#mainform #rw').val('')
                $('#mainform #rw').trigger('change')
            })

            $('#mainform #rw').change(function() {
                let _label = $(this).find('option:selected').val()
                $('#mainform #id_cluster').find(`optgroup`).prop('disabled', 1)
                if ($(this).val()) {
                    $('#mainform #id_cluster').closest('div').show()
                    $('#mainform #id_cluster').find(`optgroup[value="${_label}"]`).prop('disabled', 0)
                } else {
                    $('#mainform #id_cluster').closest('div').hide()
                }
                $('#mainform #id_cluster').val('')
                $('#mainform #id_cluster').trigger('change')
            })

            <?php if(!$penduduk['id']): ?>
                $('#mainform #dusun').trigger('change')
            <?php endif; ?>
        });

        $('#mainform').on('reset', function(e) {
            setTimeout(function() {
                $("select[name='sex']").change();
                $("select[name='status_kawin']").change();
                $("select[name='id_asuransi']").change();
            });
        });

        function ubah_sex(sex) {
            var old_foto = $('#old_foto').val();

            (sex == '2') ? $("#isian_hamil").show(): $("#isian_hamil").hide();

            if (old_foto == '') {
                $('#foto').attr("src", AmbilFoto(old_foto, 'kecil_', sex))
            }
        };

        function reset_hamil() {
            setTimeout(function() {
                $('select[name=sex]').change();
            });
        };

        function show_hide_asuransi(asuransi) {
            if (asuransi == '1' || asuransi == '') {
                $('#asuransi_pilihan').hide();
            } else {
                if (asuransi == '99') {
                    $('#label-no-asuransi').text('Nama/nomor Asuransi');
                } else {
                    $('#label-no-asuransi').text('No Asuransi');
                }

                $('#asuransi_pilihan').show();
            }
        }

        function AmbilFoto(foto, ukuran = "kecil_", sex) {
            //Jika penduduk ada foto, maka pakai foto tersebut
            //Jika tidak, pakai foto default
            if (foto) {
                ukuran_foto = ukuran || null
                file_foto = '<?php echo e(LOKASI_USER_PICT); ?>' + ukuran_foto + foto;
            } else {
                file_foto = sex == '2' ? '<?php echo e(FOTO_DEFAULT_WANITA); ?>' : '<?php echo e(FOTO_DEFAULT_PRIA); ?>';
            }

            return file_foto;
        }

        function disable_kawin_cerai(status) {
            // Status 1 = belum kawin, 2 = kawin, 3 = cerai hidup, 4 = cerai mati
            switch (status) {
                case '1':
                    $("#akta_perkawinan").attr('disabled', true);
                    $("input[name=tanggalperkawinan]").attr('disabled', true);
                    $("#akta_perceraian").attr('disabled', true);
                    $("input[name=tanggalperceraian]").attr('disabled', true);
                    $('#wajib_ktp').text('BELUM WAJIB');
                    $('#akseptor_kb').hide();
                    break;
                case '2':
                    $("#akta_perkawinan").attr('disabled', false);
                    $("input[name=tanggalperkawinan]").attr('disabled', false);
                    $("#akta_perceraian").attr('disabled', true);
                    $("input[name=tanggalperceraian]").attr('disabled', true);
                    $('#wajib_ktp').text('WAJIB');
                    $('#akseptor_kb').show();
                    break;
                case '3':
                    $("#akta_perkawinan").attr('disabled', false);
                    $("input[name=tanggalperkawinan]").attr('disabled', false);
                    $("#akta_perceraian").attr('disabled', false);
                    $("input[name=tanggalperceraian]").attr('disabled', false);
                    $('#wajib_ktp').text('WAJIB');
                    $('#akseptor_kb').show();
                    break;
                case '4':
                    $("#akta_perkawinan").attr('disabled', false);
                    $("input[name=tanggalperkawinan]").attr('disabled', false);
                    $("#akta_perceraian").attr('disabled', false);
                    $("input[name=tanggalperceraian]").attr('disabled', false);
                    $('#wajib_ktp').text('WAJIB');
                    $('#akseptor_kb').show();
                    break;
            }
        }

        function show_hide_penduduk_tidak_tetap(status) {
            // status 1 = TETAP, 2 = TIDAK TETAP
            if (status == 2) {
                $('#section_penduduk_tidak_tetap').fadeIn();
            } else {
                $('#section_penduduk_tidak_tetap').fadeOut();
            }
        }

        function show_hide_status_warga_negara(warganegaraId) {
            // warganegara_id 1 = WNI, 2 = WNA, 3 = DUA KEWARGANEGARAAN
            if (warganegaraId == 2 || warganegaraId == 3) {
                $('#field_negara_asal').fadeIn();
                $('#field_dokumen_kitas').fadeIn();
            } else {
                $('#field_negara_asal').fadeOut();
                $('#field_dokumen_kitas').fadeOut();
            }
        }

        function show_hide_ktp_el(status) {
            // status 1 = BELUM MEMILIKI KTP-EL, 2 = SUDAH MEMILIKI KTP-EL
            if (status == 2) {
                $('#section_ktp_el').fadeIn();
            } else {
                $('#section_ktp_el').fadeOut();
            }
        }

        function orang_tua() {
            var id_kk = $('#id_kk').val();
            var kk_level = $('#kk_level').val();
            if (id_kk && kk_level == 4) {
                $('#ayah_nik').val('<?php echo e($data_ayah['nik']); ?>');
                $('#nama_ayah').val('<?php echo e($data_ayah['nama']); ?>');
                $('#ibu_nik').val('<?php echo e($data_ibu['nik']); ?>');
                $('#nama_ibu').val('<?php echo e($data_ibu['nama']); ?>');
            } else {
                $('#ayah_nik').val('<?php echo e($penduduk['ayah_nik']); ?>');
                $('#nama_ayah').val('<?php echo e($penduduk['nama_ayah']); ?>');
                $('#ibu_nik').val('<?php echo e($penduduk['ibu_nik']); ?>');
                $('#nama_ibu').val('<?php echo e($penduduk['nama_ibu']); ?>');
            }
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\resources\views/admin/penduduk/penduduk_form_isian_bersama.blade.php ENDPATH**/ ?>