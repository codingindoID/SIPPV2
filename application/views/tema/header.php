<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SINENAME ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/icofont/icofont.min.css') ?>">
    <!-- jQuery -->
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>custom.css">
    <link rel="shortcut icon" href="<?= base_url('assets/dist/img/cikal.png') ?>" type="image/x-icon">
    <div id="base_url" data-id="<?= site_url() ?>"></div>
</head>
<?php
if ($this->session->flashdata('success')) {
    $flash_type = 'success';
    $data_flash = $this->session->flashdata('success');
} else if ($this->session->flashdata('warning')) {
    $flash_type = 'warning';
    $data_flash = $this->session->flashdata('warning');
} else if ($this->session->flashdata('error')) {
    $flash_type = 'error';
    $data_flash = $this->session->flashdata('error');
} else {
    $flash_type = '';
    $data_flash = '';
}
?>
<!-- flash -->

<input type="hidden" id="x_flash" value="<?= $flash_type ?>">
<input type="hidden" id="m_flash" value="<?= $data_flash ?>">