<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Profil extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_profil');
    }
    public function index()
    {
        $data = [
            'title'     => 'Profil',
            'sub'       => 'profil saya',
            'active'    => 'profil',
            'profil'    => $this->db->get_where('tb_user', ['id_user'    => $this->session->userdata('sipp_ses_id')])->row()
        ];
        $this->template->load('tema/index', 'index', $data);
    }

    function updateProfil()
    {
        $cek = $this->M_profil->updateProfil();
        $this->session->set_flashdata($cek['kode'], $cek['msg']);
        redirect('profil', 'refresh');
    }
}
