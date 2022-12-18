<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
    }

    public function adminKwaran()
    {
        $data = [
            'title'             => 'Admin',
            'sub'               => 'Rekap Admin Kwaran',
            'active'            => 'admin_kwaran',
            'kwaran'            => $this->db->get('tb_kwaran')->result(),
            'admin'             => $this->M_admin->adminKwaran(),
        ];

        $this->template->load('tema/index', 'admin-kwaran', $data);
    }

    public function admingudep()
    {
        $data = [
            'title'             => 'Admin',
            'sub'               => 'Rekap Admin Gudep',
            'active'            => 'admin_gudep',
            'admin'             => $this->M_admin->adminGudep(),
            'kwaran'            => $this->M_admin->getKwaran()
        ];

        $this->template->load('tema/index', 'admin-gudep', $data);
    }

    function simpanAdminKwaran()
    {
        $cek = $this->M_admin->simpanAdminKwaran();
        $this->session->set_flashdata($cek['kode'], $cek['msg']);
        redirect('admin/adminKwaran', 'refresh');
    }

    function simpanAdminGudep()
    {
        $cek = $this->M_admin->simpanAdminGudep();
        $this->session->set_flashdata($cek['kode'], $cek['msg']);
        redirect('admin/admingudep', 'refresh');
    }

    function hapusAdmin()
    {
        $id_user = $this->input->post('id_user');
        $this->db->where(['id_user' => $id_user]);
        $cek =  $this->db->delete('tb_user');
        $res = $cek ? [
            'kode'      => 'success',
            'msg'       => 'berhasil'
        ] : [
            'kode'      => 'error',
            'msg'       => 'berhasil'
        ];
        echo json_encode($res);
    }

    function updatePassword($page)
    {
        $cek = $this->M_admin->updatePassword();
        $this->session->set_flashdata($cek['kode'], $cek['msg']);
        redirect('admin/' . $page, 'refresh');
    }

    /* ajax */
    function detilAdmin()
    {
        $id_user = $this->input->post('id_user');
        $data = $this->db->get_where('tb_user', ['id_user' => $id_user])->row();
        echo json_encode($data);
    }
}
