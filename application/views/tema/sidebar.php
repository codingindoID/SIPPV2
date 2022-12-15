<!-- Main Sidebar Container -->
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

                <!-- menu -->
                <?php $this->load->view('tema/menu/superadmin') ?>
                <!-- menu -->
            </ul>
        </nav>
    </div>
</aside>