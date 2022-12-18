<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_serverside_import extends CI_Model
{
    var $table             = 'tb_gudep';
    var $column_order     = ['tb_pangkalan.id_pangkalan', 'no_gudep', 'nama_pangkalan', 'ambalan'];
    var $column_search     = ['tb_pangkalan.id_pangkalan', 'no_gudep', 'nama_pangkalan', 'ambalan'];
    var $order             = ['nama_pangkalan' => 'asc'];

    public function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('sipp_ses_level');
        $this->kwaran = $this->session->userdata('sipp_ses_kwaran');
        $this->pangkalan = $this->session->userdata('sipp_ses_pangkalan');
    }

    /*serverside penduduk*/
    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from('tb_gudep');
        $this->db->join('tb_pangkalan', 'tb_pangkalan.id_pangkalan = tb_gudep.id_pangkalan');
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('kwaran', $this->kwaran);
        }

        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('tb_pangkalan.id_pangkalan', $this->pangkalan);
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }


    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
