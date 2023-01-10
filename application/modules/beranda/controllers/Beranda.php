<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Beranda extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_master');
    }
    public function index()
    {
        $data = [
            'active'        => 'beranda',
            'title'         => 'Beranda',
            'sub'           => 'beranda',
            'count'         => $this->M_master->dataUtama(),
            'potensi'       => $this->M_master->potensi()
        ];
        $this->template->load('tema/index', 'index', $data);
    }
}
