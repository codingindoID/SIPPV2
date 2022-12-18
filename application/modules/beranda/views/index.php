<?php
$level = $this->session->userdata('sipp_ses_level');
?>

<div class="row">
    <?php if ($level == SUPERADMIN) : ?>
        <div class="col-md-6">
            <div class="card card-body bg-custom-teal d-flex pointer" onclick="location.href='<?= site_url('kwaran') ?>'">
                <img src="<?= base_url('assets/dist/img/flaticon/kwarran.png') ?>" width="50" class="m-auto">
                <h5 class="m-auto">Kwarran</h5>
                <h2 class="m-auto text-bold"><?= $count['kwarran'] ?></h2>
            </div>
        </div>
    <?php endif ?>

    <?php
    $aksesMenuIni = [SUPERADMIN, ADMIN_KWARAN];
    if (in_array($level, $aksesMenuIni, true)) : ?>
        <div class="col-md-6">
            <div class="card card-body bg-custom-success d-flex pointer" onclick="location.href='<?= site_url('pangkalan') ?>'">
                <img src="<?= base_url('assets/dist/img/flaticon/pangkalan.png') ?>" width="50" class="m-auto">
                <h5 class="m-auto">Pangkalan</h5>
                <h2 class="m-auto text-bold"><?= number_format($count['pangkalan'], 0) ?></h2>
            </div>
        </div>
    <?php endif ?>
    <div class="col-md-6">
        <div class="card card-body bg-custom-primary d-flex pointer" onclick="location.href='<?= site_url('gudep') ?>'">
            <img src="<?= base_url('assets/dist/img/flaticon/gudep.png') ?>" width="50" class="m-auto">
            <h5 class="m-auto">Gudep</h5>
            <h2 class="m-auto text-bold"><?= number_format($count['gudep'], 0) ?></h2>
        </div>
    </div>
    <div class="<?= $level == ADMIN_KWARAN ? 'col-md-12' : 'col-md-6' ?>">
        <div class="card card-body bg-custom-danger d-flex pointer" onclick="location.href='<?= site_url('anggota') ?>'">
            <img src="<?= base_url('assets/dist/img/flaticon/anggota.png') ?>" width="50" class="m-auto">
            <h5 class="m-auto">Anggota</h5>
            <h2 class="m-auto text-bold"><?= number_format($count['anggota'], 0) ?></h2>
        </div>
    </div>
</div>

<?php $this->load->view('potensi.php') ?>