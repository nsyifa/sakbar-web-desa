<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('title'); ?>
    <h1>
        <h1>Lokasi Kantor <?php echo e($nama_wilayah); ?></h1>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tautan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><a href="<?php echo e($tautan['link']); ?>"> <?php echo e($tautan['judul']); ?></a></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="box box-info">
        <form action="<?php echo e($form_action); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <div class="box-body">
                <div id="tampil-map">
                    <input type="hidden" name="zoom" id="zoom" value="<?php echo e($wil_ini['zoom']); ?>" />
                    <input type="hidden" name="map_tipe" id="map_tipe" value="<?php echo e($wil_ini['map_tipe']); ?>" />
                    <input type="hidden" name="id" id="id" value="<?php echo e($wil_ini['id']); ?>" />
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="lat">Latitude</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control input-sm lat" name="lat" id="lat" value="<?php echo e($wil_ini['lat']); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="lat">Longitude</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control input-sm lng" name="lng" id="lng" value="<?php echo e($wil_ini['lng']); ?>" />
                    </div>
                </div>
                <a href="<?php echo e($tautan['link']); ?>" class="btn btn-social bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali"><i class="fa fa-arrow-circle-o-left"></i> Kembali</a>
                <a href="#" class="btn btn-social btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" download="OpenSID.gpx" id="exportGPX"><i class='fa fa-download'></i> Export ke GPX</a>
                <button type='reset' class='btn btn-social btn-danger btn-sm' id="reset-peta"><i class='fa fa-times'></i> Reset</button>
                <?php if(can('u')): ?>
                    <button type='submit' class='btn btn-social btn-info btn-sm pull-right' id="simpan_kantor"><i class='fa fa-check'></i> Simpan</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.components.asset_peta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.layouts.components.konfirmasi', ['periksa_data' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        <?php if(!empty($wil_ini['lat']) && !empty($wil_ini['lng'])): ?>
            var posisi = [<?php echo e($wil_ini['lat']); ?>, <?php echo e($wil_ini['lng']); ?>];
            var zoom = <?php echo e($wil_ini['zoom'] ?: 18); ?>;
        <?php elseif(!empty($wil_atas['lat']) && !empty($wil_atas['lng'])): ?>
            // Jika posisi saat ini belum ada, maka posisi peta akan menampilkan peta desa
            var posisi = [<?php echo e($wil_atas['lat'] . ', ' . $wil_atas['lng']); ?>];
            var zoom = <?php echo e($wil_atas['zoom']); ?>;
        <?php else: ?>
            var posisi = [<?php echo e(config('map.point.lat')); ?>, <?php echo e(config('map.point.lng')); ?>];
            var zoom = <?php echo e(config('map.zoom')); ?>;
        <?php endif; ?>

        window.onload = function() {
            // Inisialisasi tampilan peta
            var peta_kantor = L.map('tampil-map', pengaturan_peta).setView(posisi, zoom);

            // 1. Menampilkan overlayLayers Peta Semua Wilayah
            var marker_desa = [];
            var marker_dusun = [];
            var marker_rw = [];
            var marker_rt = [];

            // OVERLAY WILAYAH DESA
            <?php if(!empty($desa['path'])): ?>
                set_marker_desa(marker_desa, <?php echo json_encode($desa, JSON_THROW_ON_ERROR); ?>, "<?php echo e(ucwords(setting('sebutan_desa')) . ' ' . $desa['nama_desa']); ?>", "<?php echo e(favico_desa()); ?>");
            <?php endif; ?>

            // OVERLAY WILAYAH DUSUN
            <?php if(!empty($dusun_gis)): ?>
                set_marker_multi(marker_dusun, '<?php echo addslashes(json_encode($dusun_gis, JSON_THROW_ON_ERROR)); ?>', '<?php echo e(ucwords(setting('sebutan_dusun'))); ?>', 'dusun', "<?php echo e(favico_desa()); ?>");
            <?php endif; ?>

            // OVERLAY WILAYAH RW
            <?php if(!empty($rw_gis)): ?>
                set_marker(marker_rw, '<?php echo addslashes(json_encode($rw_gis, JSON_THROW_ON_ERROR)); ?>', 'RW', 'rw', "<?php echo e(favico_desa()); ?>");
            <?php endif; ?>

            // OVERLAY WILAYAH RT
            <?php if(!empty($rt_gis)): ?>
                set_marker(marker_rt, '<?php echo addslashes(json_encode($rt_gis, JSON_THROW_ON_ERROR)); ?>', 'RT', 'rt', "<?php echo e(favico_desa()); ?>");
            <?php endif; ?>

            // 2. Menampilkan overlayLayers Peta Semua Wilayah
            <?php if(!empty($wil_atas['path'])): ?>
                var overlayLayers = overlayWil(marker_desa, marker_dusun, marker_rw, marker_rt, "<?php echo e(ucwords(setting('sebutan_desa'))); ?>", "<?php echo e(ucwords(setting('sebutan_dusun'))); ?>");
            <?php else: ?>
                var overlayLayers = {};
            <?php endif; ?>

            // Menampilkan BaseLayers Peta
            var baseLayers = getBaseLayers(peta_kantor, MAPBOX_KEY, JENIS_PETA);

            // Menampilkan dan Menambahkan Peta wilayah + Geolocation GPS
            showCurrentPoint(posisi, peta_kantor);

            <?php if(can('u')): ?>
                //Export/Import Peta dari file GPX
                eximGpxPoint(peta_kantor);
            <?php endif; ?>

            // Menambahkan zoom scale ke peta
            L.control.scale().addTo(peta_kantor);

            // Mencetak peta ke PNG
            cetakPeta(peta_kantor);

            // Menambahkan Legenda Ke Peta
            var legenda_desa = L.control({
                position: 'bottomright'
            });
            var legenda_dusun = L.control({
                position: 'bottomright'
            });
            var legenda_rw = L.control({
                position: 'bottomright'
            });
            var legenda_rt = L.control({
                position: 'bottomright'
            });

            peta_kantor.on('overlayadd', function(eventLayer) {
                if (eventLayer.name === 'Peta Wilayah Desa') {
                    setlegendPetaDesa(legenda_desa, peta_kantor, <?php echo json_encode($desa, JSON_THROW_ON_ERROR); ?>, '<?php echo e(ucwords(setting('sebutan_desa'))); ?>', '<?php echo e($desa['nama_desa']); ?>');
                }

                if (eventLayer.name === 'Peta Wilayah Dusun') {
                    setlegendPeta(legenda_dusun, peta_kantor, '<?php echo addslashes(json_encode($dusun_gis, JSON_THROW_ON_ERROR)); ?>', '<?php echo e(ucwords(setting('sebutan_dusun'))); ?>', 'dusun', '', '');
                }

                if (eventLayer.name === 'Peta Wilayah RW') {
                    setlegendPeta(legenda_rw, peta_kantor, '<?php echo addslashes(json_encode($rw_gis, JSON_THROW_ON_ERROR)); ?>', 'RW', 'rw', '<?php echo e(ucwords(setting('sebutan_dusun'))); ?>');
                }

                if (eventLayer.name === 'Peta Wilayah RT') {
                    setlegendPeta(legenda_rt, peta_kantor, '<?php echo addslashes(json_encode($rt_gis, JSON_THROW_ON_ERROR)); ?>', 'RT', 'rt', 'RW');
                }
            });

            peta_kantor.on('overlayremove', function(eventLayer) {
                if (eventLayer.name === 'Peta Wilayah Desa') {
                    peta_kantor.removeControl(legenda_desa);
                }

                if (eventLayer.name === 'Peta Wilayah Dusun') {
                    peta_kantor.removeControl(legenda_dusun);
                }

                if (eventLayer.name === 'Peta Wilayah RW') {
                    peta_kantor.removeControl(legenda_rw);
                }

                if (eventLayer.name === 'Peta Wilayah RT') {
                    peta_kantor.removeControl(legenda_rt);
                }
            });

            L.control.layers(baseLayers, overlayLayers, {
                position: 'topleft',
                collapsed: true
            }).addTo(peta_kantor);

            // Menampilkan notif error path
            view_error_path();

            // Reset peta type point
            resetPoint(peta_kantor, posisi, zoom);
        }; //EOF window.onload
    </script>
    <script src="<?php echo e(asset('js/leaflet.filelayer.js')); ?>"></script>
    <script src="<?php echo e(asset('js/togeojson.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\resources\views/admin/wilayah/maps_kantor.blade.php ENDPATH**/ ?>