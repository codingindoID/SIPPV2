<!-- Main Sidebar Container -->
<?php
$level = $this->session->userdata('sipp_ses_level');
$menuAnggota = ['daftar-anggota'];
?>

<aside class="main-sidebar sidebar-light-primary elevation-1 bg-light">
    <!-- Brand Logo -->
    <a href="<?= site_url() ?>" class="brand-link d-flex bg-primary">
        <img src="<?= base_url(LOGO) ?>" alt="AdminLTE Logo" class="brand-image ml-auto mr-auto">
    </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= site_url() ?>" class="nav-link <?= $active == 'beranda' ? 'active' : '' ?>">
                        <i class="nav-icon icofont-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>

                <li class="nav-header">
                    <b>Anggota</b>
                </li>
                <li class="nav-item <?= in_array($active, $menuAnggota, true) ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= in_array($active, $menuAnggota, true) ? 'active' : '' ?>">
                        <i class="nav-icon icofont-users"></i>
                        <p>
                            Anggota
                            <i class="right icofont-rounded-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('anggota') ?>" class="nav-link <?= $active == 'daftar-anggota' ? 'active' : '' ?>">
                                <i class="icofont-check-circled"></i>
                                <p>Daftar Anggota</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- menu -->
                <?php if ($level == SUPERADMIN) : ?>
                    <?php $this->load->view('tema/menu/superadmin') ?>
                <?php endif ?>

                <?php if ($level == ADMIN_KWARAN) : ?>
                    <?php $this->load->view('tema/menu/admin-kwaran') ?>
                <?php endif ?>

                <?php if ($level == ADMIN_GUDEP) : ?>
                    <?php $this->load->view('tema/menu/admin-gudep') ?>
                <?php endif ?>

                <!-- menu -->
            </ul>
        </nav>
    </div>
</aside>