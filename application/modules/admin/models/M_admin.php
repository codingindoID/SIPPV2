<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_admin extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('sipp_ses_level');
        $this->kwaran = $this->session->userdata('sipp_ses_kwaran');
    }

    function adminKwaran()
    {
        $this->db->join('tb_kwaran', 'tb_kwaran.id_kwaran = tb_user.id_kwaran');
        $this->db->order_by('nama_kwaran', 'asc');
        $this->db->where('level', ADMIN_KWARAN);
        return $this->db->get('tb_user')->result();
    }

    function adminGudep()
    {

        $this->db->join('tb_pangkalan', 'tb_pangkalan.id_pangkalan = tb_user.id_pangkalan');
        $this->db->where('level', ADMIN_GUDEP);
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('id_kwaran', $this->kwaran);
        }
        return $this->db->get('tb_user')->result();
    }

    function getKwaran()
    {
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('id_kwaran', $this->kwaran);
        }
        return $this->db->get('tb_kwaran')->result();
    }

    function simpanAdminKwaran()
    {
        $id_user = $this->input->post('id_user');

        $data = [
            'username'          => $this->input->post('username'),
            'display_name'      => $this->input->post('display_name'),
            'id_kwaran'         => $this->input->post('id_kwaran'),
            'email'             => $this->input->post('email'),
            'level'             => '2'
        ];

        if ($id_user) {
            $this->db->where(['id_user'     => $id_user]);
            $cek = $this->db->update('tb_user', $data);
        } else {
            $cekUsername = $this->db->get_where('tb_user', ['username'  => $this->input->post('username')])->row();
            if ($cekUsername) {
                return [
                    'kode'      => 'error',
                    'msg'       => 'username Sudah Digunakan'
                ];
                die();
            }

            $data['password']       = md5('12345');
            $cek = $this->db->insert('tb_user', $data);
        }

        return $cek ? [
            'kode'      => 'success',
            'msg'       => 'berhasil'
        ] : [
            'kode'      => 'error',
            'msg'       => 'berhasil'
        ];
    }

    function simpanAdminGudep()
    {
        $id_user = $this->input->post('id_user');

        $data = [
            'username'          => $this->input->post('username'),
            'display_name'      => $this->input->post('display_name'),
            'id_kwaran'         => $this->input->post('id_kwaran'),
            'id_pangkalan'      => $this->input->post('id_pangkalan'),
            'email'             => $this->input->post('email'),
            'level'             => '3'
        ];

        if ($id_user) {
            $this->db->where(['id_user'     => $id_user]);
            $cek = $this->db->update('tb_user', $data);
        } else {
            $cekUsername = $this->db->get_where('tb_user', ['username'  => $this->input->post('username')])->row();
            if ($cekUsername) {
                return [
                    'kode'      => 'error',
                    'msg'       => 'username Sudah Digunakan'
                ];
                die();
            }

            $data['password']       = md5('12345');
            $cek = $this->db->insert('tb_user', $data);
        }

        return $cek ? [
            'kode'      => 'success',
            'msg'       => 'berhasil'
        ] : [
            'kode'      => 'error',
            'msg'       => 'berhasil'
        ];
    }

    function updatePassword()
    {
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        if ($password1 != $password2) {
            return [
                'kode'      => 'error',
                'msg'       => 'password tidak sama'
            ];
            die();
        }

        $data     = ['password'     => md5($password1)];

        //update ke database
        $this->db->where('id_user', $this->input->post('id_user'));
        $cek = $this->db->update('tb_user', $data);
        $res = $cek ? [
            'kode'      => 'success',
            'msg'       => 'Password Berhasil Diupdate'
        ] : [
            'kode'      => 'error',
            'msg'       => 'gagal'
        ];
        return $res;
    }
}
