<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Beranda extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data = [
            'active'        => 'beranda'
        ];
        $this->template->load('tema/index', 'index', $data);
    }
}
