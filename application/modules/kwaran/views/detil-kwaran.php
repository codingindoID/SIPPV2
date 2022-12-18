<div class="row">
    <div class="col-sm-6 col-md-4 mt-2">
        <div class="card card-body bg-custom-success text-center">
            <img src="<?= base_url('assets/dist/img/flaticon/pangkalan.png') ?>" width="50" class="m-auto">
            <h5>Pangkalan</h5>
            <h2 class="text-bold"><?= $potensi['pangkalan'] ?></h2>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 mt-2">
        <div class="card card-body bg-custom-primary text-center">
            <img src="<?= base_url('assets/dist/img/flaticon/gudep.png') ?>" width="50" class="m-auto">
            <h5>Gudep</h5>
            <h2 class="text-bold"><?= $potensi['gudep'] ?></h2>
        </div>
    </div>


    <div class="col-sm-6 col-md-4 mt-2">
        <div class="card card-body bg-custom-danger text-center">
            <img src="<?= base_url('assets/dist/img/flaticon/anggota.png') ?>" width="50" class="m-auto">
            <h5>Anggota</h5>
            <h2 class="text-bold"><?= $potensi['anggota'] ?></h2>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header pointer" href="#body_detil" role="button" aria-expanded="false" aria-controls="body_detil" data-toggle="collapse">
        <h5 class="text-bold"><img src="<?= base_url('assets/dist/img/flaticon/kwarran.png') ?>" width="20" class="m-auto"> Detil Kwaran</h5>
    </div>
    <div class="card-body collapse" id="body_detil">
        <div class="form-group row">
            <div class="col-md-6">
                <input type="hidden" id="id_kwaran" value="">
                <label for="exampleInputPassword1">NOMOR KWARAN</label>
                <p class="border rounded-lg border-light-dark p-2"><?php echo $kwaran->nomor_kwaran != null ? $kwaran->nomor_kwaran : '-' ?></p>
            </div>
            <div class="col-md-6">
                <label for="exampleInputPassword1">NAMA KWARAN</label>
                <p class="border rounded-lg border-light-dark p-2"><?php echo $kwaran->nama_kwaran != null ? $kwaran->nama_kwaran : '-' ?></p>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <label for="exampleInputPassword1">ALAMAT KWARAN</label>
                <p class="border rounded-lg border-light-dark p-2"><?php echo $kwaran->alamat_kwaran != null ?  $kwaran->alamat_kwaran : '-' ?></p>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="exampleInputPassword1">KAMABIRAN</label>
                <p class="border rounded-lg border-light-dark p-2"><?php echo $kwaran->kamabiran != null ?  $kwaran->kamabiran : '-' ?></p>
            </div>
            <div class="col-md-6">
                <label for="exampleInputPassword1">KAKWARAN</label>
                <p class="border rounded-lg border-light-dark p-2"><?php echo $kwaran->kakwaran != null ?  $kwaran->kakwaran : '-' ?></p>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="exampleInputPassword1">STATUS SEKRETARIAT</label>
                <p class="border rounded-lg border-light-dark p-2"><?php echo $kwaran->status_kepemilikan != null ?  $kwaran->status_kepemilikan : '-' ?></p>
            </div>
            <div class="col-md-6">
                <label for="exampleInputPassword1">SIFAT SEKRETARIAT</label>
                <p class="border rounded-lg border-light-dark p-2"><?php echo $kwaran->sifat_kepemilikan != null ?  $kwaran->sifat_kepemilikan : '-' ?></p>
            </div>
        </div>
        <div class="separator-solid"></div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="exampleInputPassword1">NOMOR SK</label>
                <p class="border rounded-lg border-light-dark p-2"><?php echo $kwaran->nomor_sk != null ?  $kwaran->nomor_sk : '-' ?></p>
            </div>
            <div class="col-md-6">
                <label for="exampleInputPassword1">TANGGAL SK</label>
                <?php if ($kwaran->tgl_sk == null || $kwaran->tgl_sk == "0000-00-00") : ?>
                    <p class="border rounded-lg border-light-dark p-2">-</p>
                <?php else :  ?>
                    <p class="border rounded-lg border-light-dark p-2"><?php echo date('d/m/Y', strtotime($kwaran->tgl_sk)) ?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="exampleInputPassword1">MASA BAKTI</label>
                <?php if ($kwaran->awal_bakti == null || $kwaran->awal_bakti == "0000-00-00") : ?>
                    <p class="border rounded-lg border-light-dark p-2">-</p>
                <?php else :  ?>
                    <p class="border rounded-lg border-light-dark p-2"><?php echo date('d/m/Y', strtotime($kwaran->awal_bakti)) ?></p>
                <?php endif ?>
            </div>
            <div class="col-md-6">
                <label for="exampleInputPassword1">SAMPAI DENGAN</label>
                <?php if ($kwaran->akhir_bakti == null || $kwaran->akhir_bakti == "0000-00-00") : ?>
                    <p class="border rounded-lg border-light-dark p-2">-</p>
                <?php else :  ?>
                    <p class="border rounded-lg border-light-dark p-2"><?php echo date('d/m/Y', strtotime($kwaran->akhir_bakti)) ?></p>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>