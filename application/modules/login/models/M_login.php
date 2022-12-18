<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_login extends CI_Model
{
    function validasi()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $cek = $this->db->get_where('tb_user', ['md5(username)'     => md5($username)])->row();
        if (!$cek) {
            return [
                'kode'      => 'error',
                'msg'      => 'username tidak terdaftar',
            ];
            die();
        } else {
            $where = [
                'md5(username)'     => md5($username),
                'password'          => md5($password),
            ];
            $cek = $this->db->get_where('tb_user', $where)->row();
            if (!$cek) {
                return [
                    'kode'      => 'error',
                    'msg'       => 'Password Salah',
                ];
                die();
            } else {
                $array = [
                    'sipp_ses_id'           => $cek->id_user,
                    'sipp_ses_username'     => $cek->username,
                    'sipp_ses_level'        => $cek->level,
                    'sipp_ses_pangkalan'    => $cek->id_pangkalan,
                    'sipp_ses_kwaran'       => $cek->id_kwaran,
                    'sipp_ses_display'      => $cek->display_name,
                    'sipp_ses_email'        => $cek->email
                ];
                $this->session->set_userdata($array);

                return [
                    'kode'      => 'success',
                    'msg'       => "selemat datang $cek->username",
                ];
                die();
            }
        }
    }
}
