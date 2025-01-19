@extends('admin.layouts.index')

@include('admin.layouts.components.asset_datatables')
@section('title')
<h1>
    Halaman Baru
</h1>
@endsection

@section('breadcrumb')
<li class="active">Halaman Baru</li>
@endsection

@section('content')
@include('admin.layouts.components.notifikasi')
<div class="row">
    <!-- <div class="col-md-3">
        @include('admin.web.artikel.nav')
    </div> -->
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <a href="{{ ci_route('halaman_baru.form') }}" id="btn-add" class="btn btn-social btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-plus"></i> Tambah Halaman Baru</a>
                <a href="#confirm-delete" title="Hapus Data" onclick="deleteAllBox('mainform', '{{ ci_route(`halaman_baru.delete`) }}')" class="btn btn-social btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</a>
            </div>
            <div class="box-body">
                <div class="row mepet">
                    <div class="col-sm-2">
                        <select id="status" class="form-control input-sm select2">
                            <option value="">Pilih Status</option>
                            @foreach ($status as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr class="batas">
                {!! form_open(null, 'id="mainform" name="mainform"') !!}
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

@include('admin.layouts.components.konfirmasi_hapus')
<!-- @includeWhen($cat == 'statis', 'admin.web.artikel.reset_hit_modal') -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var TableData = $('#tabeldata').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ ci_route('halaman_baru.datatables') }}",
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
@endpush