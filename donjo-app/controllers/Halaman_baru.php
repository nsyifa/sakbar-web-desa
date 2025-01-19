<?php

/*
 *
 * File ini bagian dari:
 *
 * OpenSID
 *
 * Sistem informasi desa sumber terbuka untuk memajukan desa
 *
 * Aplikasi dan source code ini dirilis berdasarkan lisensi GPL V3
 *
 * Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * Hak Cipta 2016 - 2024 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 *
 * Dengan ini diberikan izin, secara gratis, kepada siapa pun yang mendapatkan salinan
 * dari perangkat lunak ini dan file dokumentasi terkait ("Aplikasi Ini"), untuk diperlakukan
 * tanpa batasan, termasuk hak untuk menggunakan, menyalin, mengubah dan/atau mendistribusikan,
 * asal tunduk pada syarat berikut:
 *
 * Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam
 * setiap salinan atau bagian penting Aplikasi Ini. Barang siapa yang menghapus atau menghilangkan
 * pemberitahuan ini melanggar ketentuan lisensi Aplikasi Ini.
 *
 * PERANGKAT LUNAK INI DISEDIAKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, BAIK TERSURAT MAUPUN
 * TERSIRAT. PENULIS ATAU PEMEGANG HAK CIPTA SAMA SEKALI TIDAK BERTANGGUNG JAWAB ATAS KLAIM, KERUSAKAN ATAU
 * KEWAJIBAN APAPUN ATAS PENGGUNAAN ATAU LAINNYA TERKAIT APLIKASI INI.
 *
 * @package   OpenSID
 * @author    Tim Pengembang OpenDesa
 * @copyright Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * @copyright Hak Cipta 2016 - 2024 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 * @license   http://www.gnu.org/licenses/gpl.html GPL V3
 * @link      https://github.com/OpenSID/OpenSID
 *
 */

use App\Enums\StatusEnum;
use App\Enums\TampilanArtikelEnum;
use App\Models\Agenda;
use App\Models\HalamanBaru;
use App\Models\Kategori;
use App\Models\Menu;
use App\Models\SettingAplikasi;
use App\Models\UserGrup;

defined('BASEPATH') || exit('No direct script access allowed');

class Halaman_baru extends Admin_Controller
{
    public $modul_ini     = 'admin-web';
    public $sub_modul_ini = 'halaman_baru';

    public function __construct()
    {
        parent::__construct();
        // isCan('b', 'halaman-baru');
        // Jika offline_mode dalam level yang menyembunyikan website,
        // tidak perlu menampilkan halaman website
        // if ($this->setting->offline_mode >= 2) {
        //     redirect('beranda');

        //     exit;
        // }
    }

    public function index(): void
    {
        // if ($cat === null) {
        //     $cat = -1;
        // }
        $data['status']        = [StatusEnum::YA => 'Aktif', StatusEnum::TIDAK => 'Tidak Aktif'];
        // $data['cat']           = $cat;
        // $data['list_kategori'] = Kategori::with(['children' => static fn ($q) => $q->orderBy('urut')])->whereParrent(0)->get()->toArray();
        // $data['kategori']      = (int) $cat > 0 ? Kategori::select(['kategori'])->find($cat)->kategori : '';

        view('admin.web.halaman_baru.index', $data);
    }

    public function datatables()
    {
        // if ($this->input->is_ajax_request()) {
        $status    = $this->input->get('status') ?? null;
        // $cat       = $this->input->get('cat') ?? '-1';
        $canUpdate = true;
        $canDelete = true;

        return datatables()->of(HalamanBaru::query()->when($status != null, static fn($q) => $q->whereEnabled($status)))
            ->addColumn('ceklist', static function ($row) use ($canDelete) {
                if ($canDelete) {
                    return '<input type="checkbox" name="id_cb[]" value="' . $row->id . '"/>';
                }
            })
            ->addIndexColumn()
            ->addColumn('aksi', static function ($row) use ($canDelete, $canUpdate): string {
                $aksi = '';
                if ($canUpdate) {
                    $aksi .= '<a href="' . ci_route('halaman_baru.form.', encrypt($row->id)) . '" class="btn bg-orange btn-sm" title="Ubah Data"><i class="fa fa-edit"></i></a> ';
                    if ($canDelete) {
                        $aksi .= '<a href="#" data-href="' . ci_route('halaman_baru.delete.' . $row->kategori, encrypt($row->id)) . '" class="btn bg-maroon btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a> ';
                    }
                    if ($row->enabled == '1') {
                        $aksi .= '<a href="' . ci_route('halaman_baru.lock' . '.enabled', encrypt($row->id)) . '" class="btn bg-navy btn-sm" title="Non Aktifkan Halaman"><i class="fa fa-unlock"></i></a> ';
                        // $aksi .= '<a href="' . ci_route('halaman_baru.lock.' . '.slider', encrypt($row->id)) . '" class="btn bg-gray btn-sm" title="' . (($row->slider == 1) ? 'Keluarkan dari slide' : 'Masukkan ke dalam slide') . '">
                        //         <i class="' . ($row->slider == 1 ? 'fa fa-pause' : 'fa fa-play') . '"></i>
                        //     </a> ';
                    } else {
                        $aksi .= '<a href="' . ci_route('halaman_baru.lock.' . '.enabled', encrypt($row->id)) . '" class="btn bg-navy btn-sm" title="Aktifkan Halaman"><i class="fa fa-lock"></i></a> ';
                    }
                }

                return $aksi . ('<a href="' . $row->url_slug . '" target="_blank" class="btn bg-green btn-sm" title="Lihat Halaman"><i class="fa fa-eye"></i></a>');
            })
            ->editColumn('tgl_upload', static fn($row) => tgl_indo2($row->tgl_upload))
            ->rawColumns(['aksi', 'ceklist'])
            ->make();
        // }

        return show_404();
    }

    public function form($id = null): void
    {
        // isCan('u');

        // $this->set_hak_akses_rfm();

        if (null !== $id) {
            $id        = decrypt($id);
            $halaman   = HalamanBaru::query()->findOrFail($id);

            $data['halaman']     = $halaman->toArray();
            $data['form_action'] = ci_route('halaman_baru.update', $id);
            $data['id']          = $id;
        } else {
            $data['halaman']     = null;
            $data['form_action'] = ci_route('halaman_baru.insert');
        }

        // $data['cat']           = $cat;
        // $data['list_tampilan'] = TampilanArtikelEnum::all();

        view('admin.web.halaman_baru.form', $data);
    }

    public function insert(): void
    {
        $data = $this->input->post();
        if (empty($data['judul']) || empty($data['isi'])) {
            redirect_with('error', 'Judul atau isi harus diisi', ci_route('halaman_baru'));
        }

        // Batasi judul menggunakan teks polos
        $data['judul']    = judul($data['judul']);

        $fp          = time();

        $data['id_user']     = auth()->id;

        // Kontributor tidak dapat mengaktifkan artikel
        if (auth()->id_grup == 4) {
            $data['enabled'] = StatusEnum::TIDAK;
        }

        if ($data['tgl_upload'] == '') {
            $data['tgl_upload'] = date('Y-m-d H:i:s');
        } else {
            $tempTgl            = date_create_from_format('d-m-Y H:i:s', $data['tgl_upload']);
            $data['tgl_upload'] = $tempTgl->format('Y-m-d H:i:s');
        }

        $data['slug'] = unique_slug('halaman_baru', $data['judul']);

        try {
            $halaman = HalamanBaru::create($data);
            redirect_with('success', 'Halaman berhasil ditambahkan', ci_route('halaman_baru'));
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            redirect_with('error', 'Halaman gagal ditambahkan', ci_route('halaman_baru'));
        }
    }

    private function ambil_data_agenda(array &$data): array
    {
        $agenda               = [];
        $agenda['tgl_agenda'] = $data['tgl_agenda'];
        unset($data['tgl_agenda']);
        $agenda['koordinator_kegiatan'] = $data['koordinator_kegiatan'];
        unset($data['koordinator_kegiatan']);
        $agenda['lokasi_kegiatan'] = $data['lokasi_kegiatan'];
        unset($data['lokasi_kegiatan']);

        return $agenda;
    }

    public function update($id = 0): void
    {
        $halaman = HalamanBaru::findOrFail($id);
        // if (! $halaman->bolehUbah()) {
        //     redirect_with('error', 'Pengguna tidak diijinkan mengubah halaman ini', ci_route('halaman_baru'));
        // }
        // if (! in_array(auth()->id_grup, (new UserGrup())->getGrupSistem()) && $artikel->id_user != auth()->id) {
        //     redirect_with('error', 'Anda tidak memiliki hak akses untuk mengubah artikel ini', ci_route('halaman_baru'));
        // }
        $data           = $_POST;
        // $hapus_lampiran = $data['hapus_lampiran'];
        // unset($data['hapus_lampiran']);

        if (empty($data['judul']) || empty($data['isi'])) {
            redirect_with('error', 'Judul atau isi harus diisi', ci_route('halaman_baru'));
        }

        // Batasi judul menggunakan teks polos
        $data['judul']    = judul($data['judul']);
        // $data['tampilan'] = (int) $data['tampilan'];

        $fp          = time();
        // $list_gambar = ['gambar', 'gambar1', 'gambar2', 'gambar3'];

        if ($data['tgl_upload'] == '') {
            $data['tgl_upload'] = date('Y-m-d H:i:s');
        } else {
            $tempTgl            = date_create_from_format('d-m-Y H:i:s', $data['tgl_upload']);
            $data['tgl_upload'] = $tempTgl->format('Y-m-d H:i:s');
        }

        $data['slug'] = unique_slug('artikel', $data['judul'], $id);

        try {
            $halaman->update($data);
            redirect_with('success', 'Halaman berhasil disimpan', ci_route('halaman_baru'));
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            redirect_with('error', 'Halaman gagal disimpan', ci_route('halaman_baru'));
        }
    }

    public function delete($id = 0): void
    {
        // isCan('h');
        HalamanBaru::destroy($this->request['id_cb'] ?? decrypt($id));
        redirect_with('success', 'Halaman berhasil dihapus', ci_route('halaman_baru'));
    }

    // // hapus artikel dalam kategori
    // public function hapus($cat): void
    // {
    //     isCan('h');
    //     HalamanBaru::where('id_kategori', $cat)->delete();
    //     redirect_with('success', 'Artikel berhasil dihapus', ci_route('web', $cat));
    // }

    // public function ubah_kategori_form($id = 0): void
    // {
    //     $id = decrypt($id);
    //     isCan('u');
    //     $artikel = HalamanBaru::findOrFail($id);
    //     if (! $artikel->bolehUbah()) {
    //         redirect_with('error', 'Pengguna tidak diijinkan mengubah artikel ini');
    //     }

    //     $data['list_kategori']     = Kategori::with(['children' => static fn($q) => $q->orderBy('urut')])->whereParrent(0)->get()->toArray();
    //     $data['form_action']       = ci_route('web.update_kategori', $id);
    //     $data['kategori_sekarang'] = $artikel->id_kategori;
    //     view('admin.web.artikel.ajax_ubah_kategori_form', $data);
    // }

    // public function update_kategori($id = 0): void
    // {
    //     isCan('u');
    //     $artikel = HalamanBaru::findOrFail($id);
    //     if (! $artikel->bolehUbah()) {
    //         redirect_with('error', 'Pengguna tidak diijinkan mengubah artikel ini', ci_route('web', $artikel->id_kategori));
    //     }

    //     $cat                  = $this->input->post('kategori');
    //     $artikel->id_kategori = $cat;
    //     $artikel->save();
    //     redirect_with('sukses', 'Kategori artikel berhasil dirubah', ci_route('web', $cat));
    // }

    public function lock($column, $id = 0): void
    {
        // isCan('u');
        $pesan   = 'Status Halaman';
        $onlyOne = false;

        switch ($column) {
            case 'enabled':
                $pesan = 'Status Halaman';
                break;

            case 'boleh_komentar':
                $pesan = 'Status Komentar';
                break;

            case 'headline':
                $pesan   = 'Status Berita Utama';
                $onlyOne = true;
                break;

            case 'slider':
                $pesan = 'Status Slide';
                break;
        }
        if (HalamanBaru::gantiStatus(decrypt($id), $column, $onlyOne)) {
            redirect_with('success', 'Berhasil Ubah ' . $pesan, ci_route('halaman_baru'));
        }

        redirect_with('error', 'Gagal Ubah ' . $pesan, ci_route('halaman_baru'));
    }

    public function slider(): void
    {
        $this->sub_modul_ini = 'slider';

        view('admin.web.slider.index');
    }

    public function update_slider(): void
    {
        // Kontributor tidak boleh melakukan ini
        isCan('u');

        SettingAplikasi::where('key', 'sumber_gambar_slider')->update(['value' => $this->input->post('pilihan_sumber')]);
        SettingAplikasi::where('key', 'jumlah_gambar_slider')->update(['value' => $this->input->post('jumlah_gambar_slider')]);
        (new SettingAplikasi())->flushQueryCache();
        redirect('web/slider');
    }

    public function reset($cat): void
    {
        isCan('u');
        if ($cat == 'statis') {
            $persen      = $this->input->post('hit');
            $menuArtikel = Menu::active()->artikel()->get();
            if ($menuArtikel) {
                foreach ($menuArtikel as $item) {
                    $id      = str_replace('artikel/', '', $item->link);
                    $artikel = HalamanBaru::find($id);
                    if ($artikel) {
                        $artikel->hit *= $persen / 100;
                        $artikel->save();
                    }
                }
            }
        }

        redirect_with('success', 'Hit telah direset', ci_route('web', $cat));
    }
}
