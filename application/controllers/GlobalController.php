<?php
defined('BASEPATH') or exit('No direct script access allowed');
class GlobalController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('sipp_ses_level');
        $this->kwaran = $this->session->userdata('sipp_ses_kwaran');
        $this->pangkalan = $this->session->userdata('sipp_ses_pangkalan');
    }

    function ajaxPangkalanByKwaran()
    {
        $kwaran = $this->input->post('kwaran');
        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('id_pangkalan', $this->pangkalan);
        }
        $data = $this->db->get_where('tb_pangkalan', ['kwaran'  => $kwaran])->result();
        echo json_encode($data);
    }

    function getGudepByPangkalan()
    {
        $id_pangkalan = $this->input->post('id_pangkalan');

        $data = $this->db->get_where('tb_gudep', ['id_pangkalan'  => $id_pangkalan])->result();
        echo json_encode($data);
    }

    function getDesaByKecamatan()
    {
        $id_kecamatan = $this->input->post('id_kecamatan');

        $data = $this->db->get_where('tb_desa', ['id_kecamatan'  => $id_kecamatan])->result();
        echo json_encode($data);
    }

    function getTingkatByGolongan()
    {
        $tingkat = $this->input->post('tingkat');

        $data = $this->db->get_where('tb_tingkatan', ['tingkat'  => $tingkat])->result();
        echo json_encode($data);
    }
}
