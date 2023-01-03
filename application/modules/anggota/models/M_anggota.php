<?php
defined('BASEPATH') or exit('No direct script access allowed');

ini_set('memory_limit', '1024M');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class M_anggota extends CI_Model
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

    function tahunAjaran()
    {
        if ($this->level == ADMIN_GUDEP) {
            $where = [
                'id_pangkalan'      => $this->pangkalan,
            ];

            $this->db->select('ta');
            $this->db->group_by('ta');
            $this->db->where($where);
            return $this->db->get('tb_anggota')->result();
        }
        return [];
    }

    function getPangkalanGroup()
    {
        $this->db->group_by('id_pangkalan');
        $this->db->select('nama_pangkalan');
        $this->db->select('tb_anggota.id_pangkalan');
        $this->db->join('tb_pangkalan', 'tb_pangkalan.id_pangkalan = tb_anggota.id_pangkalan');
        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('kwaran', $this->kwaran);
        }
        return $this->db->get('tb_anggota')->result();
    }

    function getKwaranForm()
    {
        if ($this->level != SUPERADMIN) {
            $this->db->where('id_kwaran', $this->kwaran);
        }
        return $this->db->order_by('nama_kwaran', 'asc')->get('tb_kwaran')->result();
    }

    function alamat()
    {
        $desa       = $this->db->get_where('tb_desa', ['id_desa' => $this->input->post('desa')])->row();
        $kecamatan  = $this->db->get_where('tb_kecamatan', ['id_kecamatan' => $this->input->post('kecamatan')])->row();
        $rt         = $this->input->post('rt');
        $rw         = $this->input->post('rw');

        $alamat     = $desa->nama_desa . " , RT : " . $rt . " / RW : " . $rw . " , kecamatan " . $kecamatan->nama_kecamatan;
        $alamat     = strtoupper($alamat);

        return $alamat;
    }

    function simpanAnggota()
    {
        $alamat = $this->alamat();
        $darah = ($this->input->post('darah') == 'Tidak Tahu') ? 'Tidak Tahu' :  $this->input->post('darah');

        $data = [
            'id_kwaran'         => $this->input->post('kwaran'),
            'id_pangkalan'      => $this->input->post('id_pangkalan'),
            'id_gudep'          => $this->input->post('gudep'),
            'ta'                => $this->input->post('ta'),
            'nama'              => $this->input->post('nama'),
            'tempat_lahir'      => $this->input->post('tempat_lahir'),
            'tanggal_lahir'     => date('Y-m-d', strtotime($this->input->post('tgl_lahir'))),
            'alamat'            => $alamat,
            'rt'                => $this->input->post('rt'),
            'rw'                => $this->input->post('rw'),
            'desa'              => $this->input->post('desa'),
            'agama'             => $this->input->post('agama'),
            'kecamatan'         => $this->input->post('kecamatan'),
            'gol_darah'         => $darah,
            'golongan'          => $this->input->post('golongan'),
            'tingkat'           => $this->input->post('tingkat'),
            'kta'               => $this->input->post('kta'),
            'tempat_kmd'        => $this->input->post('tempat_kmd'),
            'tahun_kmd'         => $this->input->post('tahun_kmd'),
            'golongan_kmd'      => $this->input->post('golongan_kmd'),
            'tempat_kml'        => $this->input->post('tempat_kml'),
            'tahun_kml'         => $this->input->post('tahun_kml'),
            'golongan_kml'      => $this->input->post('golongan_kml'),
            'tempat_kpd'        => $this->input->post('tempat_kpd'),
            'tahun_kpd'         => $this->input->post('tahun_kpd'),
            'golongan_kpd'      => $this->input->post('golongan_kpd'),
            'tempat_kpl'        => $this->input->post('tempat_kpl'),
            'tahun_kpl'         => $this->input->post('tahun_kpl'),
            'golongan_kpl'      => $this->input->post('golongan_kpl'),
            'no_kmd'            => $this->input->post('no_kmd'),
            'pel_kmd'           => $this->input->post('pel_kmd'),
            'no_kml'            => $this->input->post('no_kml'),
            'pel_kml'           => $this->input->post('pel_kml'),
            'no_kpd'            => $this->input->post('no_kpd'),
            'pel_kpd'           => $this->input->post('pel_kpd'),
            'no_kpl'            => $this->input->post('no_kpl'),
            'pel_kpl'           => $this->input->post('pel_kpl'),
            'password'          => md5(12345)
        ];

        $id_anggota = $this->input->post('id_anggota');
        if ($id_anggota) {
            $data['id_anggota'] = $id_anggota;
            $this->db->where(['id_anggota'  => $id_anggota]);
            $cek = $this->db->update('tb_anggota', $data);
        } else {
            $data['id_anggota'] = uniqid() . '-' . uniqid();
            $cek = $this->db->insert('tb_anggota', $data);
        }

        if ($cek) {
            $res = [
                'kode'      => 'success',
                'msg'       => 'Data Berhasil Disimpan'
            ];
        } else {
            $res = [
                'kode'      => 'error',
                'msg'       => 'Data Gagal Disimpan'
            ];
        }
        return $res;
    }

    function bulkHapus()
    {
        $ta = $this->input->post('ta');
        $id_pangkalan = $this->input->post('id_pangkalan');
        if ($this->level == ADMIN_GUDEP) {
            $id_pangkalan = $this->pangkalan;
        }

        $this->db->where(['id_pangkalan'    => $id_pangkalan, 'ta'   => $ta]);
        $cek = $this->db->delete('tb_anggota');
        return $cek ? [
            'kode'  => 'success',
            'msg'   => 'berhasil'
        ] : [
            'kode'  => 'error',
            'msg'   => 'gagal'
        ];
    }

    function getKwaranImport()
    {
        if ($this->level !=  SUPERADMIN) {
            $this->db->where('id_kwaran', $this->kwaran);
        }
        return  $this->db->order_by('nama_kwaran', 'asc')->get('tb_kwaran')->result();
    }

    function proses_import()
    {
        $data = [];
        $nama_file = uniqid() . ".xls";
        $config['upload_path']          = './excel/';
        $config['allowed_types']        = 'xls|xlsx';
        $config['max_size']             = 5000;
        $config['file_name']               = $nama_file;
        $this->load->library('upload', $config);
        $this->upload->overwrite = true;
        if (!$this->upload->do_upload('file')) {
            $res = [
                'kode'    => 'error',
                'msg'    =>   $this->upload->display_errors()
            ];
        } else {
            //proses import
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($config['upload_path'] . $config['file_name']);
            $worksheet = $spreadsheet->getActiveSheet()->toArray();

            for ($i = 1; $i < count($worksheet); $i++) {
                if ($worksheet[$i][0] != '' && $worksheet[$i][1] != '') {

                    //handling session level
                    $kwaran = $this->kwaran;
                    $id_pangkalan = $this->pangkalan;
                    if ($this->level == SUPERADMIN) {
                        $kwaran = $worksheet[$i][0];
                    }

                    if ($this->level != ADMIN_GUDEP) {
                        $id_pangkalan = $worksheet[$i][0];
                    }

                    $gudep             = $this->db->get_where('tb_gudep', ['no_gudep' => sprintf('%02s', $worksheet[$i][0]) . '.' . sprintf('%03s', $worksheet[$i][2])])->row();
                    if ($gudep) {
                        $id_gudep         = $gudep->id_gudep;
                        $data[$i] = [
                            'id_anggota'            => uniqid(),
                            'id_kwaran'             => $kwaran,
                            'id_pangkalan'          => $id_pangkalan,
                            'id_gudep'              => $id_gudep,
                            'ta'                    => $worksheet[$i][3],
                            'nama'                  => $worksheet[$i][4],
                            'tempat_lahir'          => $worksheet[$i][5],
                            'tanggal_lahir'         => date('Y-m-d', strtotime($worksheet[$i][6])),
                            'alamat'                => $worksheet[$i][7],
                            'agama'                 => $worksheet[$i][8],
                            'gol_darah'             => ($worksheet[$i][9] == '') ? 'Tidak Tahu' : $worksheet[$i][8],
                            'golongan'              => strtolower($worksheet[$i][10]),
                            'tingkat'               => strtolower($worksheet[$i][11]),
                            'kta'                   => $worksheet[$i][12],
                            'tempat_kmd'            => $worksheet[$i][13],
                            'tahun_kmd'             => $worksheet[$i][14],
                            'golongan_kmd'          => $worksheet[$i][15],
                            'tempat_kml'            => $worksheet[$i][16],
                            'tahun_kml'             => $worksheet[$i][17],
                            'golongan_kml'          => $worksheet[$i][18],
                            'tempat_kpd'            => $worksheet[$i][19],
                            'tahun_kpd'             => $worksheet[$i][20],
                            'golongan_kpd'          => $worksheet[$i][21],
                            'tempat_kpl'            => $worksheet[$i][22],
                            'tahun_kpl'             => $worksheet[$i][23],
                            'golongan_kpl'          => $worksheet[$i][24],
                            'petugas'               => $this->session->userdata('ses_id')
                        ];
                    }
                }
            }
            unlink($config['upload_path'] . $config['file_name']);

            $cek =     $this->db->insert_batch('tb_anggota', $data);
            if ($cek) {
                $res = [
                    'kode'        => 'success',
                    'msg'        => 'Import Anggota Sukses'
                ];
            } else {
                $res = [
                    'kode'        => 'error',
                    'msg'        => 'Import Anggota Gagal'
                ];
            }
        }

        return $res;
    }


    /* EXPORT */
    function dataAnggotaPerLevel()
    {
        $this->db->join('tb_pangkalan', 'tb_pangkalan.id_pangkalan = tb_anggota.id_pangkalan');
        $this->db->join('tb_gudep', 'tb_gudep.id_gudep = tb_anggota.id_gudep');
        $this->db->join('tb_kwaran', 'tb_kwaran.id_kwaran = tb_pangkalan.kwaran');

        if ($this->level == ADMIN_KWARAN) {
            $this->db->where('tb_kwaran.id_kwaran', $this->kwaran);
        }

        if ($this->level == ADMIN_GUDEP) {
            $this->db->where('tb_pangkalan.id_pangkalan', $this->pangkalan);
        }

        return $this->db->get('tb_anggota')->result();
    }

    function excel()
    {
        $anggota = $this->dataAnggotaPerLevel();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Asal Kwaran');
        $sheet->setCellValue('C1', 'Asal Pangkalan');
        $sheet->setCellValue('D1', 'Nama Anggota');
        $sheet->setCellValue('E1', 'No KTA');
        $sheet->setCellValue('F1', 'Alamat');
        $sheet->setCellValue('G1', 'Tempat Lahir');
        $sheet->setCellValue('H1', 'Tanggal Lahir');
        $sheet->setCellValue('I1', 'Golongan Darah');
        $sheet->setCellValue('J1', 'Golongan Kepramukaan');
        $sheet->setCellValue('K1', 'Tingkatan');
        $sheet->setCellValue('L1', 'tempat_kmd');
        $sheet->setCellValue('M1', 'tahun_kmd');
        $sheet->setCellValue('N1', 'golongan_kmd');
        $sheet->setCellValue('O1', 'tempat_kml');
        $sheet->setCellValue('P1', 'tahun_kml');
        $sheet->setCellValue('Q1', 'golongan_kml');
        $sheet->setCellValue('R1', 'tempat_kpd');
        $sheet->setCellValue('S1', 'tahun_kpd');
        $sheet->setCellValue('T1', 'golongan_kpd');
        $sheet->setCellValue('U1', 'tempat_kpl');
        $sheet->setCellValue('V1', 'tahun_kpl');
        $sheet->setCellValue('W1', 'golongan_kpl');
        $sheet->setCellValue('X1', 'AGAMA');

        $no = 1;
        $x = 2;
        foreach ($anggota as $row) {
            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row->nama_kwaran);
            $sheet->setCellValue('C' . $x, $row->nama_pangkalan);
            $sheet->setCellValue('D' . $x, $row->nama);
            $sheet->setCellValue('E' . $x, $row->kta);
            $sheet->setCellValue('F' . $x, $row->alamat);
            $sheet->setCellValue('G' . $x, $row->tempat_lahir);
            $sheet->setCellValue('H' . $x, $this->_set_tanggal($row->tanggal_lahir));
            $sheet->setCellValue('I' . $x, $row->gol_darah == 'Tidak Tahu' ? '-' : $row->gol_darah);
            $sheet->setCellValue('J' . $x, $row->golongan);
            $sheet->setCellValue('K' . $x, $row->tingkat);
            $sheet->setCellValue('L' . $x, $row->tempat_kmd);
            $sheet->setCellValue('M' . $x, $this->_set_tahun($row->tahun_kmd));
            $sheet->setCellValue('N' . $x, $row->golongan_kmd);
            $sheet->setCellValue('O' . $x, $row->tempat_kml);
            $sheet->setCellValue('P' . $x, $this->_set_tahun($row->tahun_kml));
            $sheet->setCellValue('Q' . $x, $row->golongan_kml);
            $sheet->setCellValue('R' . $x, $row->tempat_kpd);
            $sheet->setCellValue('S' . $x, $this->_set_tahun($row->tahun_kpd));
            $sheet->setCellValue('T' . $x, $row->golongan_kpd);
            $sheet->setCellValue('U' . $x, $row->tempat_kpl);
            $sheet->setCellValue('V' . $x, $this->_set_tahun($row->tahun_kpl));
            $sheet->setCellValue('W' . $x, $row->golongan_kpl);
            $sheet->setCellValue('X' . $x, $row->agama);
            $x++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Rekap Anggota';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    private function _set_tanggal($tanggal)
    {
        if ($tanggal == null || $tanggal == '0000-00-00' || $tanggal == '') {
            $hasil = '-';
        } else {
            $hasil = date('d-m-Y', strtotime($tanggal));
        }

        return $hasil;
    }


    private function _set_tahun($tahun)
    {
        if ($tahun == null || $tahun == '' || $tahun == 0) {
            $hasil = '-';
        } else {
            $hasil = $tahun;
        }

        return $hasil;
    }
}
