<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class M_pangkalan extends CI_Model
{
    protected $level;
    protected $kwaran;
    protected $pangkalan;
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

    function dataExcelExport()
    {
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('kwaran', $this->kwaran);
        }
        $this->db->join('tb_kwaran', 'tb_kwaran.id_kwaran = tb_pangkalan.kwaran');
        return $this->db->get('tb_pangkalan')->result();
    }

    function excel()
    {
        $pangkalan = $this->dataExcelExport();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Asal Kwaran');
        $sheet->setCellValue('C1', 'Nama Pangkalan');
        $sheet->setCellValue('D1', 'Alamat');
        $sheet->setCellValue('E1', 'Ka Mabigus');
        $sheet->setCellValue('F1', 'Ka gudep');
        $sheet->setCellValue('G1', 'Jumlah Pembina');

        $no = 1;
        $x = 2;
        foreach ($pangkalan as $row) {
            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row->nama_kwaran);
            $sheet->setCellValue('C' . $x, $row->nama_pangkalan);
            $sheet->setCellValue('D' . $x, $row->alamat_pangkalan);
            $sheet->setCellValue('E' . $x, $row->kamabigus);
            $sheet->setCellValue('F' . $x, $row->kagudep);
            $sheet->setCellValue('G' . $x, $row->jumlah_pembina);
            $x++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Rekap Pangkalan';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
