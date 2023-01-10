<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_master extends CI_Model
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

    function datautama($id_kwaran = null)
    {
        return [
            'kwarran'           => $this->db->get('tb_kwaran')->num_rows(),
            'pangkalan'         => $this->pangkalan($id_kwaran),
            'gudep'             => $this->gudep($id_kwaran),
            'anggota'           => $this->anggota($id_kwaran),
        ];
    }

    function pangkalan($id_kwaran)
    {
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('kwaran', $this->kwaran);
        }

        if ($id_kwaran) {
            $this->db->where('kwaran', $id_kwaran);
        }
        return $this->db->get('tb_pangkalan')->num_rows();
    }

    function gudep($id_kwaran)
    {
        $this->db->join('tb_pangkalan', 'tb_pangkalan.id_pangkalan = tb_gudep.id_pangkalan');
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('kwaran', $this->kwaran);
        }
        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('tb_pangkalan.id_pangkalan', $this->pangkalan);
        }
        if ($id_kwaran) {
            $this->db->where('kwaran', $id_kwaran);
        }
        return $this->db->get('tb_gudep')->num_rows();
    }

    function anggota($id_kwaran)
    {
        $this->db->select('golongan');
        $this->db->select('tingkat');
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('kwaran', $this->kwaran);
        }
        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('tb_pangkalan.id_pangkalan', $this->pangkalan);
        }
        if ($id_kwaran) {
            $this->db->where('kwaran', $id_kwaran);
        }
        $this->db->join('tb_pangkalan', 'tb_pangkalan.id_pangkalan = tb_anggota.id_pangkalan');
        return $this->db->get('tb_anggota')->num_rows();
    }

    function potensi($id_kwaran = null)
    {
        return  [
            'count_muda'    => $this->potensiMuda($id_kwaran),
            'count_dewasa'  => $this->potensiDewasa($id_kwaran),
            'count_lain'    => $this->potensiLain($id_kwaran),
        ];
    }

    function potensiMuda($id_kwaran)
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

        if ($id_kwaran) {
            $this->db->where('id_kwaran', $id_kwaran);
        }

        $potensiMuda = $this->db->get('tb_anggota')->num_rows();

        foreach ($golonganMuda as $gol) {
            $data[]     = [
                $gol => $this->potensiSubTingkat($gol, $id_kwaran)
            ];
        }

        return [
            'total'     => $potensiMuda,
            'data'      => $data
        ];
    }

    function potensiLain($id_kwaran)
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

        if ($id_kwaran) {
            $this->db->where('id_kwaran', $id_kwaran);
        }

        return $this->db->get('tb_anggota')->num_rows();
    }

    function potensiDewasa($id_kwaran)
    {
        $this->db->select('id_anggota');
        $this->db->where('golongan', 'dewasa');

        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('id_kwaran', $this->kwaran);
        }

        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('id_pangkalan', $this->pangkalan);
        }

        if ($id_kwaran) {
            $this->db->where('id_kwaran', $id_kwaran);
        }

        $potensiDewasa = $this->db->get('tb_anggota')->num_rows();

        $data[]     = [
            'dewasa' => $this->potensiSubTingkat('dewasa', $id_kwaran)
        ];

        return [
            'total'     => $potensiDewasa,
            'data'      => $data
        ];
    }

    function potensiSubTingkat($golongan, $id_kwaran)
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

            if ($id_kwaran) {
                $this->db->where('id_kwaran', $id_kwaran);
            }

            $ting = $this->db->get_where('tb_anggota', ['golongan'  => $golongan, 'tingkat' => $t->sub_tingkat])->num_rows();
            $data[] = [
                $t->sub_tingkat => $ting
            ];
        }
        return $data;
    }
}
