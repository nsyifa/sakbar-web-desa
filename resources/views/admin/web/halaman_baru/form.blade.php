@extends('admin.layouts.index')
@include('admin.layouts.components.asset_validasi')

@section('title')
<h1>
    <h1>Form Halaman Baru</h1>
</h1>
@endsection

@section('breadcrumb')
<li><a href="{{ ci_route('halaman_baru') }}">Daftar Halaman Baru</a></li>
<li class="active">Form Halaman Baru</li>
@endsection

@section('content')
@include('admin.layouts.components.notifikasi')

{!! form_open_multipart($form_action, 'id="validasi"') !!}
<div class="row">
    <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
                <a href="{{ ci_route('halaman_baru')}}" class="btn btn-social btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Halaman">
                    <i class="fa fa-arrow-circle-left "></i>Kembali ke Daftar Halaman
                </a>
                @if ($halaman['slug'])
                <a href="{{ $halaman['url_slug'] }}" target="_blank" class="btn btn-social bg-green btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-eye"></i> Lihat Halaman</a>
                @endif
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
                        value="{{ $halaman['judul'] }}"></input>
                    <span class="help-block"><code>Judul halaman minimal 5 karakter dan maksimal 200 karakter</code></span>
                </div>
                <div class="form-group">
                    <label class="control-label" for="kode_desa">Isi Halaman</label>
                    <textarea name="isi" data-filemanager='{!! json_encode([' external_filemanager_path'=> base_url('assets/kelola_file/'), 'filemanager_title' => 'Responsive Filemanager', 'filemanager_access_key' => $session->fm_key]) !!}' class="form-control input-sm required" style="height:350px;">{{ $halaman['isi'] }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-info">
            <div class="box-body no-padding">
                <div class='box-footer'>
                    {!! batal() !!}
                    <button type='submit' class='btn btn-social btn-info btn-sm pull-right'><i class='fa fa-check'></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</form>
@endsection
@include('admin.layouts.components.datetime_picker')
@push('scripts')
<script type="text/javascript" src="{{ asset('js/tinymce-651/tinymce.min.js') }}"></script>
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        height: 700,
        editimage_cors_hosts: ['lh7-rt.googleusercontent.com', 'ibb.co.com'],
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
            "filemanager": "{{ asset('kelola_file/plugin.min.js') }}"
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
@endpush