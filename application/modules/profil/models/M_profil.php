<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_profil extends CI_Model
{
    function updateProfil()
    {
        $id_user = $this->session->userdata('sipp_ses_id');
        $cekUsername = $this->db->get_where('tb_user', ['username'  => $this->input->post('username')])->row();
        if ($cekUsername) {
            if ($cekUsername->id_user != $id_user) {
                return [
                    'kode'      => 'error',
                    'msg'       => 'username Sudah Digunakan'
                ];
                die();
            }
        }

        $data = [
            'username'              => $this->input->post('username'),
            'display_name'          => $this->input->post('display_name'),
        ];

        $this->db->where(['id_user'   => $id_user]);
        $cek = $this->db->update('tb_user', $data);
        return $cek ? [
            'kode'      => 'success',
            'msg'       => 'berhasil Update Profil'
        ] : [
            'kode'      => 'error',
            'msg'       => 'gagal Update Profil'
        ];
    }
}
