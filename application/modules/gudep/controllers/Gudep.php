<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Gudep extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_serverside');
        $this->load->model('M_serverside_import');
        $this->load->model('M_gudep');
    }
    public function index()
    {
        $data = [
            'title'             => '<img src="' . base_url('assets/dist/img/flaticon/gudep.png') . '" width="20" class="mr-1">  Gudep',
            'sub'               => 'Master data Gudep',
            'active'            => 'gudep',
            'pangkalan'         => $this->M_gudep->getPangkalan()
        ];
        $this->template->load('tema/index', 'daftar-gudep', $data);
    }

    function simpanGudep()
    {
        $cek = $this->M_gudep->simpanGudep();
        $this->session->set_flashdata($cek['kode'], $cek['msg']);
        redirect('gudep', 'refresh');
    }

    function detilGudepPage($id_gudep)
    {
        $data = [
            'title'             => '<img src="' . base_url('assets/dist/img/flaticon/gudep.png') . '" width="20" class="mr-1">  Gudep',
            'sub'               => 'Detil Data Gudep',
            'active'            => 'gudep',
            'detil'             => $this->M_gudep->getDetilGudep($id_gudep)
        ];
        $this->template->load('tema/index', 'detil-gudep', $data);
    }

    /* ajax */
    function detilGudep()
    {
        $id_gudep = $this->input->post('id_gudep');
        $data = $this->db->get_where('tb_gudep', ['id_gudep' => $id_gudep])->row();
        echo json_encode($data);
    }

    function hapusGudep()
    {
        $id_gudep = $this->input->post('id_gudep');
        $this->db->where(['id_gudep'    => $id_gudep]);
        $cek = $this->db->delete('tb_gudep');
        $res = $cek ?
            [
                'kode'      => 'success',
                'msg'       => 'berhasil'
            ] : [
                'kode'      => 'error',
                'msg'       => 'gagal'
            ];
        echo json_encode($res);
    }

    function ajaxgudep()
    {
        $list = $this->M_serverside->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $o) {
            $html = '<div class="dropdown">';
            $html .= '<a href="#" class="btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
                         <i class="icofont-navigation-menu text-white"></i>
                    </a>';
            $html .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
            $html .= '<a class="dropdown-item" href="' . site_url('gudep/detilGudepPage/') . $o->id_gudep . '"><i class="icofont-eye text-primary"></i> Lihat</a>';
            $html .= '<a class="dropdown-item" href="#" onclick="modalGudep(this)" data-id="' . $o->id_gudep . '"><i class="icofont-gear text-success"></i> Edit</a>';
            $html .= '<a class="dropdown-item" href="#" onclick="hapusGudep(this)" data-id="' . $o->id_gudep . '"><i class="icofont-ui-delete text-danger"></i> Hapus</a>';
            $html .= '</div></div>';

            $row = array();
            $row[] = ($no++) + 1;
            $row[] = $o->no_gudep;
            $row[] = $o->ambalan;
            $row[] = $o->nama_pangkalan;
            $row[] = $this->totalAnggotaGudep($o->id_gudep);
            $row[] = $html;
            $data[] = $row;
        }

        $output = array(
            "draw"                 => $_POST['draw'],
            "recordsTotal"         => $this->M_serverside->count_all(),
            "recordsFiltered"     => $this->M_serverside->count_filtered(),
            "data"                 => $data,
        );
        echo json_encode($output);
    }

    function ajaxGudepImport()
    {
        $list = $this->M_serverside_import->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $o) {
            $row = array();
            $row[] = $o->id_pangkalan;
            $row[] = $o->no_gudep;
            $row[] = $o->nama_pangkalan;
            $row[] = $o->ambalan;
            $data[] = $row;
        }

        $output = array(
            "draw"                 => $_POST['draw'],
            "recordsTotal"         => $this->M_serverside_import->count_all(),
            "recordsFiltered"     => $this->M_serverside_import->count_filtered(),
            "data"                 => $data,
        );
        echo json_encode($output);
    }

    function totalAnggotaGudep($id_gudep)
    {
        return $this->db->get_where('tb_anggota', ['id_gudep'   => $id_gudep])->num_rows();
    }

    function exportExcel()
    {
        $this->M_gudep->excel();
    }
}
