<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PLEASE LOGIN</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/icofont/icofont.min.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/dist/img/cikal.png') ?>" type="image/x-icon">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="text-center mb-3">
                    <img src="<?= base_url('assets/dist/img/logo_1.png') ?>" width="120">
                </div>
                <?php if ($this->session->flashdata('error')) : ?>
                    <div class="alert alert-warning" role="alert">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif ?>
                <hr>

                <form action="<?= site_url('login/validasi') ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="icofont-search-user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="icofont-key"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block"><i class="icofont-sign-in"></i> LOGIN</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <hr>
                <div class="text-center mt-2">
                    <p class="p-0 m-0"><small>Official partner :</small></p>
                    <img src="<?= base_url('assets/dist/img/pengen.png') ?>" width="60">
                    <img src="<?= base_url('assets/dist/img/logo_bawah.png') ?>" width="40">
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
</body>

</html>