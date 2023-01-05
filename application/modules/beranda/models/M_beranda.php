<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_beranda extends CI_Model
{
    protected $level;
    protected $kwaran;
    protected $pangkalan;
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
        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('tb_pangkalan.id_pangkalan', $this->pangkalan);
        }
        return $this->db->get('tb_gudep')->num_rows();
    }

    function anggota()
    {
        $this->db->select('golongan');
        $this->db->select('tingkat');
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('kwaran', $this->kwaran);
        }
        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('tb_pangkalan.id_pangkalan', $this->pangkalan);
        }
        $this->db->join('tb_pangkalan', 'tb_pangkalan.id_pangkalan = tb_anggota.id_pangkalan');
        return $this->db->get('tb_anggota')->num_rows();
    }

    function potensi()
    {
        return  [
            'count_muda'    => $this->potensiMuda(),
            'count_dewasa'  => $this->potensiDewasa(),
            'count_lain'    => $this->potensiLain(),
        ];
    }

    function potensiMuda()
    {
        $golonganMuda = ['siaga', 'penggalang', 'penegak', 'pandega'];
        $this->db->select('id_anggota');
        $this->db->where_in('golongan', $golonganMuda);
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('id_kwaran', $this->kwaran);
        }

        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('id_pangkalan', $this->pangkalan);
        }

        $potensiMuda = $this->db->get('tb_anggota')->num_rows();

        foreach ($golonganMuda as $gol) {
            $data[]     = [
                $gol => $this->potensiSubTingkat($gol)
            ];
        }

        return [
            'total'     => $potensiMuda,
            'data'      => $data
        ];
    }

    function potensiLain()
    {
        $golonganExclude = ['siaga', 'penggalang', 'penegak', 'pandega', 'dewasa'];
        $this->db->select('id_anggota');
        $this->db->where_not_in('golongan', $golonganExclude);
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('id_kwaran', $this->kwaran);
        }

        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('id_pangkalan', $this->pangkalan);
        }

        return $this->db->get('tb_anggota')->num_rows();
    }

    function potensiDewasa()
    {
        $this->db->select('id_anggota');
        $this->db->where('golongan', 'dewasa');

        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('id_kwaran', $this->kwaran);
        }

        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('id_pangkalan', $this->pangkalan);
        }

        $potensiDewasa = $this->db->get('tb_anggota')->num_rows();

        $data[]     = [
            'dewasa' => $this->potensiSubTingkat('dewasa')
        ];

        return [
            'total'     => $potensiDewasa,
            'data'      => $data
        ];
    }

    function potensiSubTingkat($golongan)
    {
        $this->db->select('sub_tingkat');
        $tingkat = $this->db->get_where('tb_tingkatan', ['tingkat'  => $golongan])->result();

        foreach ($tingkat as $t) {
            $this->db->select('tingkat');

            if ($this->level == ADMIN_KWARAN) {
                $this->db->where('id_kwaran', $this->kwaran);
            }

            if ($this->level == ADMIN_GUDEP) {
                $this->db->where('id_pangkalan', $this->pangkalan);
            }

            $ting = $this->db->get_where('tb_anggota', ['golongan'  => $golongan, 'tingkat' => $t->sub_tingkat])->num_rows();
            $data[] = [
                $t->sub_tingkat => $ting
            ];
        }
        return $data;
    }
}
