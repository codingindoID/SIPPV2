<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_kwaran extends CI_Model
{
    function simpanKwaran()
    {
        $id_kwaran = $this->input->post('id_kwaran');
        $nama_kwaran = $this->input->post('nama_kwaran');
        $data = [
            'nama_kwaran'           => $nama_kwaran,
            'nomor_kwaran'          => $this->input->post('nomor_kwaran'),
            'alamat_kwaran'         => $this->input->post('alamat_kwaran'),
            'kamabiran'             => $this->input->post('kamabiran'),
            'kakwaran'              => $this->input->post('kakwaran'),
            'status_kepemilikan'    => $this->input->post('status_kepemilikan'),
            'sifat_kepemilikan'     => $this->input->post('sifat_kepemilikan'),
            'nomor_sk'              => $this->input->post('nomor_sk'),
            'tgl_sk'                => $this->input->post('tgl_sk'),
            'awal_bakti'            => $this->input->post('awal_bakti'),
            'akhir_bakti'           => $this->input->post('akhir_bakti')
        ];

        if ($id_kwaran) {
            $this->db->where(['id_kwaran'   => $id_kwaran]);
            $cek = $this->db->update('tb_kwaran', $data);
        } else {
            $cek_nama = $this->db->get_where('tb_kwaran', ['nama_kwaran' => $nama_kwaran])->row();
            if ($cek_nama) {
                return [
                    'kode'      => 'error',
                    'msg'       => 'Nama ' . ucfirst(KWARAN) . ' Sudah Dipakai'
                ];
                die();
            }

            $cek = $this->db->insert('tb_kwaran', $data);
        }

        return $cek ? [
            'kode'      => 'success',
            'msg'       => 'berhasil'
        ] : [
            'kode'      => 'error',
            'msg'       => 'berhasil'
        ];
    }

    function potensi($id_kwaran)
    {
        return [
            'pangkalan'         => $this->db->get_where('tb_pangkalan', ['kwaran' => $id_kwaran])->num_rows(),
            'gudep'             => $this->db->join('tb_pangkalan', 'tb_pangkalan.id_pangkalan=tb_gudep.id_pangkalan')->get_where('tb_gudep', ['kwaran' => $id_kwaran])->num_rows(),
            'anggota'           => $this->db->get_where('tb_anggota', ['id_kwaran' => $id_kwaran])->num_rows(),
        ];
    }
}
