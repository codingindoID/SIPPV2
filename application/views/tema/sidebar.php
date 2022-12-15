<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info elevation-1">
    <!-- Brand Logo -->
    <a href="<?= site_url() ?>" class="brand-link bg-info d-flex">
        <img src="<?= base_url(LOGO) ?>" alt="AdminLTE Logo" class="brand-image img-circle m-auto">
        <div style=" height: 27px;"></div>
        <!-- <span class="brand-text font-weight-light"><?= APPNAME ?></span> -->
        <!-- <span class="brand-text font-weight-light"><?= APPNAME ?></span> -->
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

                <!-- menu -->
                <?php $this->load->view('tema/menu/superadmin') ?>
                <!-- menu -->
            </ul>
        </nav>
    </div>
</aside>