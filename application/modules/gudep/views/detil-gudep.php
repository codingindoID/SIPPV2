<div class="card card-body">
    <h5 class="text-center text-bold">Detil Gudep</h5>
    <hr>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group form-group-default">
                <label>Nomor Gugus Depan</label>
                <input type="text" class="form-control bg-white" readonly value="<?= $detil->no_gudep ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-default">
                <label>Satuan</label>
                <input type="email" class="form-control bg-white" readonly value="<?= $detil->ambalan ?>">
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group form-group-default">
                <label>Nama Pangkalan</label>
                <input type="text" class="form-control bg-white" readonly value="<?= $detil->nama_pangkalan ?>">
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group form-group-default">
                <label>Kwarran</label>
                <input type="text" class="form-control bg-white" readonly value="<?= $detil->nama_kwaran ?>">
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group form-group-default">
                <label>Ka. Mabigus</label>
                <input type="text" class="form-control bg-white" readonly value="<?= $detil->kamabigus ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-default">
                <label>Ka. Gudep</label>
                <input type="text" class="form-control bg-white" readonly value="<?= $detil->kagudep ?>">
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group form-group-default">
                <label>Alamat Lengkap</label>
                <textarea type="text" class="form-control bg-white" readonly rows="3"><?= $detil->alamat_pangkalan ?></textarea>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="form-group form-group-default">
                <label>Jumlah Pembina</label>
                <input type="text" class="form-control bg-white" readonly value="<?= $detil->jumlah_pembina ?>">
            </div>
        </div>
    </div>
</div>