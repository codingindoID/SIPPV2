<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Anggota extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_serverside');
        $this->load->model('M_anggota');
        $this->level = $this->session->userdata('sipp_ses_level');
        $this->kwaran = $this->session->userdata('sipp_ses_kwaran');
    }

    public function index()
    {
        $data = [
            'title'     => 'Anggota',
            'active'    => 'daftar-anggota',
            'sub'       => 'Daftar Anggota',
            'pangkalan' => $this->M_anggota->getPangkalanGroup(),
            'kwarran'   => $this->db->order_by('nama_kwaran', 'asc')->get('tb_kwaran')->result()
        ];
        $this->template->load('tema/index', 'daftar-anggota', $data);
    }

    function formTambahAnggota()
    {
        $data = [
            'title'     => 'Anggota',
            'active'    => 'daftar-anggota',
            'sub'       => 'Daftar Anggota',
            'darah'     => $this->db->get('tb_darah')->result(),
            'golongan'  => $this->db->get('tb_golongan')->result(),
            'kecamatan' => $this->db->get('tb_kecamatan')->result(),
            'kwaran'    => $this->db->order_by('nama_kwaran', 'asc')->get('tb_kwaran')->result()
        ];
        $this->template->load('tema/index', 'form-anggota', $data);
    }

    function formEditAnggota($id_anggota)
    {
        $anggota = $this->db->get_where('tb_anggota', ['id_anggota' => $id_anggota])->row();
        $pangkalan = ($anggota->id_kwaran) ? $this->db->get_where('tb_pangkalan', ['kwaran' => $anggota->id_kwaran])->result() : [];
        $gudep = ($anggota->id_pangkalan) ? $this->db->get_where('tb_gudep', ['id_pangkalan' => $anggota->id_pangkalan])->result() : [];
        $tingkat = ($anggota->golongan) ? $this->db->get_where('tb_tingkatan', ['tingkat' => $anggota->golongan])->result() : [];
        $desa = ($anggota->kecamatan) ? $this->db->get_where('tb_desa', ['id_kecamatan' => $anggota->kecamatan])->result() : [];

        $data = [
            'title'     => 'Anggota',
            'active'    => 'daftar-anggota',
            'sub'       => 'Daftar Anggota',
            'darah'     => $this->db->get('tb_darah')->result(),
            'golongan'  => $this->db->get('tb_golongan')->result(),
            'kecamatan' => $this->db->get('tb_kecamatan')->result(),
            'kwaran'    => $this->db->order_by('nama_kwaran', 'asc')->get('tb_kwaran')->result(),
            'pangkalan'   => $pangkalan,
            'gudep'     => $gudep,
            'tingkat'     => $tingkat,
            'desa'     => $desa,
            'anggota'   => $anggota
        ];
        $this->template->load('tema/index', 'form_edit_anggota', $data);
    }

    function simpanAnggota()
    {
        $id_anggota = $this->input->post('id_anggota');
        $cek = $this->M_anggota->simpanAnggota();
        $this->session->set_flashdata($cek['kode'], $cek['msg']);
        $page = $id_anggota ? 'anggota/formEditAnggota/' . $id_anggota  : 'anggota';
        redirect($page, 'refresh');
    }

    function formImport()
    {
        $data = [
            'title'     => 'Anggota',
            'active'    => 'daftar-anggota',
            'sub'       => 'Daftar Anggota',
            'darah'     => $this->db->get('tb_darah')->result(),
            'golongan'  => $this->db->get('tb_golongan')->result(),
            'kecamatan' => $this->db->get('tb_kecamatan')->result(),
            'kwaran'    => $this->M_anggota->getKwaranImport()
        ];
        $this->template->load('tema/index', 'import', $data);
    }

    function upload()
    {
        $cek = $this->M_anggota->proses_import();
        $this->session->set_flashdata($cek['kode'], $cek['msg']);
        redirect('anggota/formImport', 'refresh');
    }

    /* ajax */
    function ajaxAnggota($id_kwaran = null)
    {
        $list = $this->M_serverside->get_datatables($id_kwaran);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $o) {
            $linkEdit = site_url() . 'anggota/formEditAnggota/' . $o->id_anggota;
            $button = '<div class="dropdown">';
            $button .= '<a href="#" class="btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icofont-navigation-menu text-white"></i></a>';
            $button .= ' <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
            $button .= '<a target="__blank" href="' . $linkEdit . '" type="button" class="dropdown-item"><i class="icofont-eye text-primary"></i> Detail</a>';
            $button .= '<a data-id="' . $o->id_anggota . '" onclick="hapusBaris(this)" type="button" class="dropdown-item"><i class="icofont-ui-delete text-danger"></i> Hapus</a>';
            $button .= '</div></div>';

            $row = array();
            $row[] = ($no++) + 1;
            $row[] = $o->nama;
            $row[] = $o->nama_pangkalan;
            $row[] = $o->ambalan;
            $row[] = $o->golongan;
            $row[] = $o->ta;
            $row[] = $button;

            $data[] = $row;
        }

        $output = array(
            "draw"                 => $_POST['draw'],
            "recordsTotal"         => $this->M_serverside->count_all(),
            "recordsFiltered"     => $this->M_serverside->count_filtered(),
            "data"                 => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function hapusAngota()
    {
        $id_anggota = $this->input->post('id_anggota');
        $this->db->where(['id_anggota'  => $id_anggota]);
        $cek = $this->db->delete('tb_anggota');
        echo $cek ? json_encode([
            'kode'  => 'success',
            'msg'   => 'data dihapus'
        ]) : json_encode([
            'kode'  => 'error',
            'msg'   => 'Gagal'
        ]);
    }

    function getTahunBulkHapus()
    {
        $id_pangkalan = $this->input->post('id_pangkalan');
        $this->db->select('ta');
        $this->db->group_by('ta');
        $data = $this->db->get_where('tb_anggota', ['id_pangkalan'   => $id_pangkalan])->result();
        echo json_encode($data);
    }

    function bulkHapus()
    {
        $cek = $this->M_anggota->bulkHapus();
        $this->session->set_flashdata($cek['kode'], $cek['msg']);
        redirect('anggota', 'refresh');
    }
}
