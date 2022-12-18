<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="icofont-navigation-menu text-white"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link text-white">
                <marquee behavior="" direction="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae officia fugiat ipsum delectus consequatur facilis cum repudiandae molestias commodi! Impedit quod sint tempore veritatis iste hic reiciendis, aperiam porro ut!</marquee>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <span class="text-bold text-white"> <?= $this->session->userdata('sipp_ses_display') ?></span>
                <img src="<?= base_url('assets/') ?>dist/img/flaticon/user.png" width="30" alt="User Avatar" class="ml-2 mr-3 img-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="<?= site_url('profil') ?>" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?= base_url('assets/') ?>dist/img/cikal.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                <span class="text-bold"> Lihat Profil</span>
                                <p class="text-muted"><small>Anda Dapat Merubah Password Disini</small></p>
                            </h3>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" onclick="logout()" class="dropdown-item dropdown-footer bg-danger"><i class="icofont-logout"></i> Keluar</a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->