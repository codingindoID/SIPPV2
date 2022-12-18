<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pangkalan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pangkalan');
    }
    public function index()
    {
        $data = [
            'title'     => '<img src="' . base_url('assets/dist/img/flaticon/pangkalan.png') . '" width="20" class="mr-1">   Pangkalan',
            'sub'       => 'Master data Pangkalan',
            'active'    => 'pangkalan',
            'pangkalan' => $this->M_pangkalan->getPangkalan(),
            'kwaran'    => $this->db->order_by('id_kwaran', 'asc')->get('tb_kwaran')->result(),
        ];
        //echo json_encode($data);
        $this->template->load('tema/index', 'daftar-pangkalan', $data);
    }

    function simpanPangkalan()
    {
        $cek = $this->M_pangkalan->simpanPangkalan();
        $this->session->set_flashdata($cek['kode'], $cek['msg']);
        redirect('pangkalan', 'refresh');
    }

    function lihat($id_pangkalan)
    {
        $data = [
            'title'             => 'Pangkalan',
            'sub'               => 'Detil Pangkalan',
            'active'            => 'pangkalan',
            'pangkalan'         => $this->db->join('tb_kwaran', 'tb_kwaran.id_kwaran = tb_pangkalan.kwaran')->get_where('tb_pangkalan', ['id_pangkalan'    => $id_pangkalan])->row(),
            'siaga'             => 0,
            'penggalang'        => 0,
            'penegak'           => 0,
            'pandega'           => 0,
            'kmd'               => 0,
            'kml'               => 0,
            'kpd'               => 0,
            'kpl'               => 0,
            'non'               => 0,
            'sub_siaga'         => 0,
            'sub_penggalang'    => 0,
            'sub_penegak'       => 0,
            'sub_pandega'       => 0,
            'anggota'           => $this->db->get_where('tb_anggota', ['id_pangkalan'    => $id_pangkalan])->num_rows(),
        ];
        //echo json_encode($data['sub_pandega']);
        $this->template->load('tema/index', 'detil-pangkalan', $data);
    }

    /* ajax */
    function ajaxDetilPangkalan()
    {
        $id_pangkalan = $this->input->post('id_pangkalan');
        $data = $this->db->get_where('tb_pangkalan', ['id_pangkalan'    => $id_pangkalan])->row();
        echo json_encode($data);
    }

    function hapusPangkalan()
    {
        $id_pangkalan = $this->input->post('id_pangkalan');
        $this->db->where(['id_pangkalan'    => $id_pangkalan]);
        $cek =  $this->db->delete('tb_pangkalan');
        $res = $cek ? [
            'kode'      => 'success',
            'msg'       => 'berhasil'
        ] : [
            'kode'      => 'error',
            'msg'       => 'berhasil'
        ];
        echo json_encode($res);
    }
}
