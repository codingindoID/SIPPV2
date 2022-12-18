<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_beranda extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('sipp_ses_level');
        $this->kwaran = $this->session->userdata('sipp_ses_kwaran');
        $this->pangkalan = $this->session->userdata('sipp_ses_pangkalan');
    }
    function datautama()
    {
        return [
            'kwarran'           => $this->db->get('tb_kwaran')->num_rows(),
            'pangkalan'         => $this->pangkalan(),
            'gudep'             => $this->gudep(),
            'anggota'           => $this->anggota(),
        ];
    }

    function pangkalan()
    {
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('kwaran', $this->kwaran);
        }
        return $this->db->get('tb_pangkalan')->num_rows();
    }

    function gudep()
    {
        $this->db->join('tb_pangkalan', 'tb_pangkalan.id_pangkalan = tb_gudep.id_pangkalan');
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('kwaran', $this->kwaran);
        }
        return $this->db->get('tb_gudep')->num_rows();
    }

    function anggota()
    {
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('kwaran', $this->kwaran);
        }
        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('id_pangkalan', $this->pangkalan);
        }
        $this->db->join('tb_pangkalan', 'tb_pangkalan.id_pangkalan = tb_anggota.id_pangkalan');
        return $this->db->get('tb_anggota')->num_rows();
    }


    function potensi()
    {
        $golonganMuda = ['siaga', 'penggalang', 'penegak', 'pandega'];
        $golonganLain = ['siaga', 'penggalang', 'penegak', 'pandega', 'dewasa'];

        $this->db->where_in('golongan', $golonganMuda);
        $potensiMuda = $this->db->get('tb_anggota')->num_rows();

        $this->db->where_not_in('golongan', $golonganLain);
        $potensilain = $this->db->get('tb_anggota')->num_rows();

        return  [
            'count_muda'    => $potensiMuda,
            'count_dewasa'  => $this->db->get_where('tb_anggota', ['golongan'    => 'dewasa'])->num_rows(),
            'count_lain'    => $potensilain,
        ];
    }
}
