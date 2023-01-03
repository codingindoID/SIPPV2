<div class="row">
    <div class="col-md-6">
        <form action="<?= site_url('profil/updateProfil') ?>" method="post">
            <div class="card card-body d-flex">
                <img src="<?= base_url('assets/') ?>dist/img/cikal.png" alt="User Avatar" width="100" class="m-auto img-circle">
                <p class="mb-2 text-muted text-center">Pangkalan</p>
                <?php
                $pangkalan = $this->db->get_where('tb_pangkalan', ['id_pangkalan'   => $profil->id_pangkalan])->row();
                ?>
                <h5 class="text-bold text-center"><?= $pangkalan->nama_pangkalan ?></h5>
                <hr>
                <p class="mb-2 text-muted">Display Name</p>
                <input type="text" class="form-control" name="display_name" value="<?= $profil->display_name ?>">
                <hr>
                <p class="mb-2 text-muted">Username</p>
                <input type="text" class="form-control" name="username" value="<?= $profil->username ?>">
                <hr>
                <p class="mb-2 text-muted">Password</p>
                <h5 class="text-bold text-primary pointer">********</h5>
                <hr>
                <button class="btn btn-success col-12"><i class="icofont-save"></i> UDPATE PROFIL</button>
            </div>
        </form>
    </div>
</div>