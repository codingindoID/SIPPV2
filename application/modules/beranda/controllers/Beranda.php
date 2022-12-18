<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Beranda extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_beranda');
    }
    public function index()
    {
        $data = [
            'active'        => 'beranda',
            'title'         => 'Beranda',
            'sub'           => 'beranda',
            'count'         => $this->M_beranda->dataUtama(),
            'potensi'       => $this->M_beranda->potensi()
        ];
        // echo json_encode($data);
        // die();
        $this->template->load('tema/index', 'index', $data);
    }
}
