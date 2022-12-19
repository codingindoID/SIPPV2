<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
    }
    public function index()
    {
        $this->load->view('index');
    }

    function validasi()
    {
        $cek = $this->M_login->validasi();
        $page = $cek['kode']    == 'success' ? 'beranda' : 'login';
        $this->session->set_flashdata($cek['kode'], $cek['msg']);
        redirect($page, 'refresh');
    }

    function logout()
    {
        $array = [
            'sipp_ses_id', 'sipp_ses_username', 'sipp_ses_level', 'sipp_ses_pangkalan', 'sipp_ses_kwaran', 'sipp_ses_display', 'sipp_ses_email'
        ];
        $this->session->unset_userdata($array);
        $this->session->set_flashdata('error', 'Terimakasih, Semoga Harimu Menyenangkan,. sampai jumpa lagi,..');
        redirect('login', 'refresh');
    }
}
