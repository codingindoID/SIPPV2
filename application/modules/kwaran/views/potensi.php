<h5 class="text-danger text-bold"><i class="icofont-search-user"></i> Potensi Anggota</h5>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pointer" data-toggle="collapse" data-target="#card-muda">
                <h5 class="text-bold">
                    <img src="<?= base_url('assets/dist/img/flaticon/layers.png') ?>" width="15">
                    <span class="ml-2"> Potensi Anggota Muda</span>
                    <span class="font-weight-normal text-danger"> ( <?= number_format($potensi['count_muda']['total'], 0) ?> )</span>
                </h5>
            </div>
            <div class="collapse" id="card-muda">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box pointer-event" data-toggle="collapse" data-target="#row-siaga">
                                <span class="info-box-icon bg-success elevation-1">
                                    <img src="<?= base_url('assets/dist/img/flaticon/wosm.png') ?>" width="50">
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">SIAGA</span>
                                    <span class="info-box-number">
                                        <?php
                                        $siaga = $potensi['count_muda']['data'][0]['siaga'];
                                        $mula = $siaga[0]['mula'];
                                        $bantu = $siaga[1]['bantu'];
                                        $tata = $siaga[2]['tata'];
                                        $garuda = $siaga[3]['garuda'];

                                        $totalSiaga = $mula + $bantu + $tata + $garuda;
                                        ?>
                                        <h5 class="text-bold text-success"><?= number_format($totalSiaga, 0) ?></h5>
                                    </span>
                                </div>

                            </div>
                            <div class="row collapse" id="row-siaga">
                                <div class="col-12">
                                    <div class="card card-body bg-success p-0">
                                        <table class="w-100 bg-success text-md">
                                            <tr>
                                                <td class="p-3">Mula</td>
                                                <td class="p-3">:</td>
                                                <td class="p-3 text-bold text-right"><?= number_format($mula, 0) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="p-3">Bantu</td>
                                                <td class="p-3">:</td>
                                                <td class="p-3 text-bold text-right"><?= number_format($bantu, 0) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="p-3">Tata</td>
                                                <td class="p-3">:</td>
                                                <td class="p-3 text-bold text-right"><?= number_format($tata, 0) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="p-3">Garuda</td>
                                                <td class="p-3">:</td>
                                                <td class="p-3 text-bold text-right"><?= number_format($garuda, 0) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3 pointer" data-toggle="collapse" data-target="#row-penggalang">
                                <span class="info-box-icon bg-danger elevation-1">
                                    <img src="<?= base_url('assets/dist/img/flaticon/wosm.png') ?>" width="50">
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">PENGGALANG</span>
                                    <span class="info-box-number">
                                        <?php
                                        $penggalang = $potensi['count_muda']['data'][1]['penggalang'];
                                        $ramu = $penggalang[0]['ramu'];
                                        $rakit = $penggalang[1]['rakit'];
                                        $terap = $penggalang[2]['terap'];
                                        $garuda = $penggalang[3]['garuda'];

                                        $totalPenggalang = $ramu + $rakit + $terap + $garuda;
                                        ?>
                                        <h5 class="text-bold text-danger"><?= number_format($totalPenggalang, 0) ?></h5>
                                    </span>
                                </div>
                            </div>
                            <div class="row collapse mt-0" id="row-penggalang">
                                <div class="col-12">
                                    <div class="card card-body bg-danger p-0">
                                        <table class="w-100 bg-danger text-md">
                                            <tr>
                                                <td class="p-3">Ramu</td>
                                                <td class="p-3">:</td>
                                                <td class="p-3 text-bold text-right"><?= number_format($ramu, 0) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="p-3">Rakit</td>
                                                <td class="p-3">:</td>
                                                <td class="p-3 text-bold text-right"><?= number_format($rakit, 0) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="p-3">Terap</td>
                                                <td class="p-3">:</td>
                                                <td class="p-3 text-bold text-right"><?= number_format($terap, 0) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="p-3">Garuda</td>
                                                <td class="p-3">:</td>
                                                <td class="p-3 text-bold text-right"><?= number_format($garuda, 0) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3 pointer" data-toggle="collapse" data-target="#row-penegak">
                                <span class="info-box-icon bg-warning elevation-1">
                                    <img src="<?= base_url('assets/dist/img/flaticon/wosm.png') ?>" width="50">
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">PENEGAK</span>
                                    <span class="info-box-number">
                                        <?php
                                        $penegak = $potensi['count_muda']['data'][2]['penegak'];
                                        $bantara = $penegak[0]['bantara'];
                                        $laksana = $penegak[1]['laksana'];
                                        $garuda = $penegak[2]['garuda'];

                                        $totalPenegak = $bantara + $laksana + $garuda;
                                        ?>
                                        <h5 class="text-bold text-warning"><?= number_format($totalPenegak, 0) ?></h5>
                                    </span>
                                </div>
                            </div>
                            <div class="row collapse" id="row-penegak">
                                <div class="col-12">
                                    <div class="card card-body bg-warning p-0">
                                        <table class="w-100 bg-warning text-md">
                                            <tr>
                                                <td class="p-3">Bantara</td>
                                                <td class="p-3">:</td>
                                                <td class="p-3 text-bold text-right"><?= number_format($bantara, 0) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="p-3">Laksana</td>
                                                <td class="p-3">:</td>
                                                <td class="p-3 text-bold text-right"><?= number_format($laksana, 0) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="p-3">Garuda</td>
                                                <td class="p-3">:</td>
                                                <td class="p-3 text-bold text-right"><?= number_format($garuda, 0) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3 pointer" data-toggle="collapse" data-target="#row-pandega">
                                <span class="info-box-icon bg-brown elevation-1">
                                    <img src="<?= base_url('assets/dist/img/flaticon/wosm.png') ?>" width="50">
                                </span>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">PANDEGA</span>
                                    <span class="info-box-number">
                                        <?php
                                        $pandega = $potensi['count_muda']['data'][3]['pandega'];
                                        $pandega1 = $pandega[0]['pandega'];
                                        $garuda = $pandega[1]['garuda'];

                                        $totalPandega = $pandega1 + $garuda;
                                        ?>
                                        <h5 class="text-bold text-dark"><?= number_format($totalPandega, 0) ?></h5>
                                    </span>
                                </div>
                            </div>
                            <div class="row collapse" id="row-pandega">
                                <div class="col-12">
                                    <div class="card card-body bg-brown p-0">
                                        <table class="w-100 bg-brown text-md">
                                            <tr>
                                                <td class="p-3">Pandega</td>
                                                <td class="p-3">:</td>
                                                <td class="p-3 text-bold text-right"><?= number_format($pandega1, 0) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="p-3">Garuda</td>
                                                <td class="p-3">:</td>
                                                <td class="p-3 text-bold text-right"><?= number_format($garuda, 0) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-danger"><strong>Nb. </strong> Mohon cek data inputan tingkat pada golongan Muda jika terjadi selisih perhitungan ( Sesuaikan dengan Data Standar Pada Aplikasi SIPP )</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header pointer" data-toggle="collapse" data-target="#card-dewasa">
                <h5 class="text-bold">
                    <img src="<?= base_url('assets/dist/img/flaticon/layers.png') ?>" width="15">
                    <span class="ml-2"> Potensi Anggota Dewasa <span class="font-weight-normal text-danger">( <?= number_format($potensi['count_dewasa']['total'], 0) ?> )</span></span>
                </h5>
            </div>
            <div class="collapse" id="card-dewasa">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <?php
                        for ($i = 0; $i < count($potensi['count_dewasa']['data'][0]['dewasa']); $i++) {
                            $key = array_keys($potensi['count_dewasa']['data'][0]['dewasa'][$i])[0];
                        ?>
                            <div class="col-md-4">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-info elevation-1">
                                        <img src="<?= base_url('assets/dist/img/flaticon/medal.png') ?>" width="50">
                                    </span>
                                    </span>

                                    <div class="info-box-content">
                                        <h5 class="info-box-text"><?= strtoupper($key) ?></h5>
                                        <span class="info-box-number">
                                            <h4 class="text-bold text-dark"><?= $potensi['count_dewasa']['data'][0]['dewasa'][$i][$key] ?></h4>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-danger"><strong>Nb. </strong> Mohon cek data inputan tingkat pada golongan dewasa jika terjadi selisih perhitungan ( Sesuaikan dengan Data Standar Pada Aplikasi SIPP )</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="text-bold">
                    <img src="<?= base_url('assets/dist/img/flaticon/layers.png') ?>" width="15">
                    <span class="ml-2"> Potensi Anggota Lainnya <span class="font-weight-normal text-danger">( <a class="text-danger" href="<?= site_url('anggota/anggotaLain') ?>"><?= number_format($potensi['count_lain'], 0) ?></a> )</span></span>
                </h5>
            </div>
        </div>
    </div>
</div>