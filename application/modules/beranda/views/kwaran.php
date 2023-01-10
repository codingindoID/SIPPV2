<hr>
<h5 class="text-info text-bold"><i class="icofont-chart-arrows-axis"></i> Rekap Anggota Per <strong>Kwartir Ranting</strong></h5>
<div class="row">
    <div class="col-12">
        <div class="card">
            <table class="table-info table-bordered table-hover w-100 text-md">
                <thead class="bg-info">
                    <tr class="text-center">
                        <th rowspan="3" width="5%">NO</th>
                        <th rowspan="3">Kwarran</th>
                    </tr>
                    <tr class="text-center">
                        <th colspan="5">GOLONGAN</th>
                        <th rowspan="3">TOTAL</th>
                    </tr>
                    <tr class="text-center">
                        <th width="10%">SIAGA</th>
                        <th width="10%">PENGGALANG</th>
                        <th width="10%">PENEGAK</th>
                        <th width="10%">PANDEGA</th>
                        <th width="10%">DEWASA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $siaga = 0;
                    $penggalang = 0;
                    $penegak = 0;
                    $pandega = 0;
                    $dewasa = 0;
                    foreach ($detilAnggota as $var) : ?>
                        <?php
                        $totalBaris = $var['siaga'] + $var['penggalang'] + $var['penegak'] + $var['pandega'] + $var['dewasa'];
                        ?>
                        <tr>
                            <td class="text-center"><?= $var['no'] ?></td>
                            <td class="text-bold"><?= $var['nama_kwaran'] ?></td>
                            <td class="text-center"><?= $var['siaga'] ? number_format($var['siaga'], 0) : '-'  ?></td>
                            <td class="text-center"><?= $var['penggalang']  ? number_format($var['penggalang'], 0) : '-' ?></td>
                            <td class="text-center"><?= $var['penegak']  ? number_format($var['penegak'], 0) : '-' ?></td>
                            <td class="text-center"><?= $var['pandega']  ? number_format($var['pandega'], 0) : '-' ?></td>
                            <td class="text-center"><?= $var['dewasa']  ? number_format($var['dewasa'], 0) : '-' ?></td>
                            <td class="text-center text-bold"><?= $totalBaris ? number_format($totalBaris, 0)  : '-' ?></td>
                        </tr>
                    <?php
                        $siaga += $var['siaga'];
                        $penggalang += $var['penggalang'];
                        $penegak += $var['penegak'];
                        $pandega += $var['pandega'];
                        $dewasa += $var['dewasa'];
                    endforeach ?>
                </tbody>
                <tfoot>
                    <?php $total = $siaga + $penggalang + $penegak + $pandega + $dewasa ?>
                    <tr class="text-center text-bold bg-info" style="font-size: 1.3rem;">
                        <td class="p-2" colspan="2" class="text-bold">TOTAL</td>
                        <td class="p-2"><?= $siaga ? number_format($siaga, 0) : '-' ?></td>
                        <td class="p-2"><?= $penggalang ? number_format($penggalang, 0) : '-' ?></td>
                        <td class="p-2"><?= $penegak ? number_format($penegak, 0) : '-' ?></td>
                        <td class="p-2"><?= $pandega ? number_format($pandega, 0) : '-' ?></td>
                        <td class="p-2"><?= $dewasa ? number_format($dewasa, 0) : '-' ?></td>
                        <td class="p-2"><?= $total ? number_format($total, 0) : '-'  ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<hr>