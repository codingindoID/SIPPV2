<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kwaran extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kwaran');
        $this->load->model('M_master');
    }
    public function index()
    {
        $data = [
            'title'             => ucfirst(KWARAN),
            'sub'               => ucfirst(KWARAN) . ' terdaftar',
            'active'            => 'kwarran',
            'sifat_kepemilikan' => $this->db->get('tb_sifat_kepemilikan')->result(),
            'status_kepemilikan' => $this->db->get('tb_status_kepemilikan')->result(),
            'kwaran'            => $this->db->get('tb_kwaran')->result()
        ];
        $this->template->load('tema/index', 'daftar-kwarran', $data);
    }

    function simpanKwaran()
    {
        $cek = $this->M_kwaran->simpanKwaran();
        $this->session->set_flashdata($cek['kode'], $cek['msg']);
        redirect('kwaran', 'refresh');
    }

    function lihat($id_kwaran)
    {
        $kwaran = $this->db->get_where('tb_kwaran', ['id_kwaran' => $id_kwaran])->row();
        $data = [
            'title'             => ucfirst(KWARAN) . ' ' . $kwaran->nama_kwaran,
            'sub'               => $kwaran->nama_kwaran,
            'active'            => 'kwarran',
            'kwaran'            => $kwaran,
            'count'             => $this->M_master->dataUtama($id_kwaran),
            'potensi'           => $this->M_master->potensi($id_kwaran)
        ];
        // echo json_encode($data);
        $this->template->load('tema/index', 'detil-kwaran', $data);
    }

    /* ajax */
    function ajaxDetillKwaran()
    {
        $id_kwaran = $this->input->post('id_kwaran');
        $data = $this->db->get_where('tb_kwaran', ['id_kwaran'  => $id_kwaran])->row();
        echo json_encode($data);
    }

    function hapusKwaran()
    {
        $id_kwaran = $this->input->post('id_kwaran');
        $this->db->where(['id_kwaran'    => $id_kwaran]);
        $cek =  $this->db->delete('tb_kwaran');
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
