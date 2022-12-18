<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_pangkalan extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('sipp_ses_level');
        $this->kwaran = $this->session->userdata('sipp_ses_kwaran');
    }

    function getPangkalan()
    {
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('kwaran', $this->kwaran);
        }
        return $this->db->get('tb_pangkalan')->result();
    }

    function simpanPangkalan()
    {
        $id_pangkalan = $this->input->post('id_pangkalan');
        $data = [
            'nama_pangkalan'        => $this->input->post('nama_pangkalan'),
            'alamat_pangkalan'      => $this->input->post('alamat_pangkalan'),
            'kwaran'                => $this->input->post('kwaran'),
            'kamabigus'             => $this->input->post('kamabigus'),
            'kagudep'               => $this->input->post('kagudep'),
            'jumlah_pembina'        => $this->input->post('jumlah_pembina')
        ];

        if ($id_pangkalan) {
            $this->db->where(['id_pangkalan'    => $id_pangkalan]);
            $cek = $this->db->update('tb_pangkalan', $data);
        } else {
            $cek = $this->db->insert('tb_pangkalan', $data);
        }

        return $cek ? [
            'kode'      => 'success',
            'msg'       => 'berhasil'
        ] : [
            'kode'      => 'error',
            'msg'       => 'berhasil'
        ];
    }
}
