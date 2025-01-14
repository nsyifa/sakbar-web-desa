@include('admin.layouts.components.form_modal_validasi')
<script>
    $(function() {
        let _objParams = $('#tabeldata').DataTable().ajax.params()
        delete(_objParams.draw)
        delete(_objParams.search)
        $('input[name=params]').val(JSON.stringify(_objParams))
        $('input[name=judul]').val($('#judul-statistik').text())
        // copy id_rb terpilih ke form ini
        let _clone = $('#tabeldata').find('input[name="id_cb[]"]:checked').clone()
        $('#checkbox_div').append(_clone)
    })

    function cetak() {
        const privasi_nik = $('#privasi_nik:checked').val();
        if (privasi_nik == "on") {
            $("#form-cetak").attr("action", "{{ $action }}/1");
        } else {
            $("#form-cetak").attr("action", "{{ $action }}/0");
        }
        $('#modalBox').modal('hide');


    }
</script>
<form target="_blank" action="" method="post" id="form-cetak">
    <div class='modal-body'>
        <div class="row">
            <div class="col-sm-12">
                <label for="nama">Centang kotak berikut apabila NIK/No. KK ingin disensor</label>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="hidden" name="params" value="">
                    <input type="hidden" name="judul" value="">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="privasi_nik">
                        <label class="form-check-label" for="cetak_privasi_nik">Sensor NIK/No. KK</label>
                    </div>
                </div>
            </div>
            <div class="form-group hide" id="checkbox_div">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        {!! batal() !!}
        <button type="submit" onclick="cetak()" class="btn btn-social btn-info btn-sm"><i class="fa fa-check"></i> {{ ucwords($aksi) }}</button>
    </div>
</form>
