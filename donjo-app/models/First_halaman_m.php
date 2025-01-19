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

defined('BASEPATH') || exit('No direct script access allowed');

class First_halaman_m extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('web_sosmed_model');
        // $this->load->model('shortcode_model');
        if (! isset($_SESSION['halaman_baru'])) {
            $_SESSION['halaman_baru'] = [];
        }
    }

    public function get_halaman($url)
    {
        if (is_numeric($url)) {
            $this->db->where('a.id', $url);
        } else {
            $this->db->where('a.slug', $url);
        }

        $query = $this->config_id('a')
            ->select('a.*, YEAR(tgl_upload) AS thn, MONTH(tgl_upload) AS bln, DAY(tgl_upload) AS hri')
            ->from('halaman_baru as a')
            ->where('a.enabled', 1)
            ->where('a.tgl_upload <', date('Y-m-d H:i:s'))
            ->get();

        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            $this->sterilkan_halaman($data);
        }

        return $data;
    }

    private function sterilkan_halaman(&$data): void
    {
        $data['judul'] = htmlspecialchars_decode($this->security->xss_clean($data['judul']));
        $data['slug']  = $this->security->xss_clean($data['slug']);
    }

    public function hit($url): void
    {
        $this->load->library('user_agent');

        $id = $this->config_id()
            ->select('id')
            ->where('slug', $url)
            ->or_where('id', $url)
            ->get('halaman_baru')
            ->row()->id;

        //membatasi hit hanya satu kali dalam setiap session
        if (in_array($id, $_SESSION['halaman_baru']) || $this->agent->is_robot() || crawler()) {
            return;
        }

        $this->config_id()
            ->set('hit', 'hit + 1', false)
            ->where('id', $id)
            ->update('halaman_baru');
        $_SESSION['halaman_baru'][] = $id;
    }

    public function get_halaman_by_id($id)
    {
        return $this->config_id()
            ->select('slug, YEAR(tgl_upload) AS thn, MONTH(tgl_upload) AS bln, DAY(tgl_upload) AS hri, judul, tgl_upload')
            ->where(['id' => $id])
            ->get('halaman_baru')
            ->row_array();
    }
}
