<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class M_gudep extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('sipp_ses_level');
        $this->kwaran = $this->session->userdata('sipp_ses_kwaran');
        $this->pangkalan = $this->session->userdata('sipp_ses_pangkalan');
    }

    function getPangkalan()
    {
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('kwaran', $this->kwaran);
        }

        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('id_pangkalan', $this->pangkalan);
        }
        return $this->db->get('tb_pangkalan')->result();
    }

    function simpanGudep()
    {
        $id_gudep = $this->input->post('id_gudep');

        $data = [
            'no_gudep'          => $this->input->post('no_gudep'),
            'ambalan'           => $this->input->post('ambalan'),
            'id_pangkalan'      => $this->input->post('id_pangkalan'),
        ];

        if ($id_gudep) {
            $this->db->where(['id_gudep'    => $id_gudep]);
            $cek =  $this->db->update('tb_gudep', $data);
        } else {
            $cek = $this->db->insert('tb_gudep', $data);
        }

        return $cek ? [
            'kode'      => 'success',
            'msg'       => 'berhasil'
        ] : [
            'kode'      => 'error',
            'msg'       => 'gagal'
        ];
    }

    function getDetilGudep($id_gudep)
    {
        $this->db->join('tb_pangkalan', 'tb_pangkalan.id_pangkalan = tb_gudep.id_pangkalan');
        $this->db->join('tb_kwaran', 'tb_kwaran.id_kwaran = tb_pangkalan.kwaran');
        return $this->db->get_where('tb_gudep', ['id_gudep' => $id_gudep])->row();
    }

    function dataExcelExport()
    {
        $this->db->join('tb_pangkalan', 'tb_pangkalan.id_pangkalan = tb_gudep.id_pangkalan');
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('kwaran', $this->kwaran);
        }

        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('tb_pangkalan.id_pangkalan', $this->pangkalan);
        }
        return $this->db->get('tb_gudep')->result();
    }

    function excel()
    {
        $pangkalan = $this->dataExcelExport();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NO Gudep');
        $sheet->setCellValue('C1', 'Nama Pangkalan');
        $sheet->setCellValue('D1', 'Satuan');

        $no = 1;
        $x = 2;
        foreach ($pangkalan as $row) {
            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row->no_gudep);
            $sheet->setCellValue('C' . $x, $row->nama_pangkalan);
            $sheet->setCellValue('D' . $x, $row->ambalan);
            $x++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Rekap Gudep';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
