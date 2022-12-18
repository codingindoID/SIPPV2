<div class="row">
    <div class="col-md-8 m-auto">
        <div class="card">
            <div class="card-header">
                <span class="btn-sm btn-warning pointer" onclick="history.back()"><i class="icofont-undo"></i> Kembali</span>
                <span class="btn-sm btn-success pointer" onclick="modalKwaran(this)" data-id=""><i class="icofont-checked"></i> Tambah Kwaran</span>
            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-striped table-hover data-table">
                        <thead class="bg-primary">
                            <tr class="text-center">
                                <th>NO</th>
                                <th>NOMOR KWARAN</th>
                                <th>NAMA KWARAN</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($kwaran as $k) : ?>
                                <tr>
                                    <td class="text-center p-1"><?php echo $no++ ?></td>
                                    <td class="text-center p-1"><b><?php echo $k->nomor_kwaran ?></b></td>
                                    <td class="p-1"><b><?php echo $k->nama_kwaran ?></b></td>
                                    <td class="text-center p-1">
                                        <div class="dropdown">
                                            <a href="#" class="btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
                                                <i class="icofont-navigation-menu text-white"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item pointer" href="<?php echo site_url('kwaran/lihat/') . $k->id_kwaran ?>"><i class="icofont-eye text-primary"></i> Lihat</a>
                                                <a class="dropdown-item pointer" data-id="<?= $k->id_kwaran ?>" onclick="modalKwaran(this)"><i class="icofont-gears text-success"></i> Edit</a>
                                                <a class="dropdown-item pointer" data-id="<?= $k->id_kwaran ?>" onclick="hapusKwaran(this)"><i class="icofont-ui-delete text-danger"></i> Hapus</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
<div id="modal-kwaran" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="modal_title_kwaran"><b>Detil <?= ucfirst(KWARAN) ?></b></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url('kwaran/simpanKwaran') ?>" method="post" accept-charset="utf-8">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="hidden" id="id_kwaran" name="id_kwaran">
                            <label for="exampleInputPassword1">NOMOR <?= strtoupper(KWARAN) ?></label>
                            <input type="text" class="form-control" name="nomor_kwaran" id="nomor_kwaran" placeholder="nomor Kwaran" required>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">NAMA <?= strtoupper(KWARAN) ?></label>
                            <input type="text" class="form-control" name="nama_kwaran" id="nama_kwaran" placeholder="nama kwaran" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="exampleInputPassword1">ALAMAT <?= strtoupper(KWARAN) ?></label>
                            <textarea type="text" class="form-control" name="alamat_kwaran" id="alamat_kwaran" placeholder="alamat kwaran" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">KA.MABIRRAN</label>
                            <input type="text" class="form-control" name="kamabiran" id="kamabiran" placeholder="kamabiran" required>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">KA.KWARRAN</label>
                            <input type="text" class="form-control" name="kakwaran" id="kakwaran" placeholder="kakwaran" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">STATUS SEKRETARIAT</label>
                            <select name="status_kepemilikan" id="status_kepemilikan" class="form-control">
                                <option value="">Pilih..</option>
                                <?php foreach ($status_kepemilikan as $st) : ?>
                                    <option value="<?php echo $st->id ?>"><?php echo $st->status_kepemilikan ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">SIFAT SEKRETARIAT</label>
                            <select name="sifat_kepemilikan" id="sifat_kepemilikan" class="form-control">
                                <option value="">Pilih..</option>
                                <?php foreach ($sifat_kepemilikan as $sf) : ?>
                                    <option value="<?php echo $sf->id_sifat ?>"><?php echo $sf->sifat_kepemilikan ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">NOMOR SK</label>
                            <input type="text" class="form-control" name="nomor_sk" id="nomor_sk" placeholder="NOMOR SK" required>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">TANGGAL SK</label>
                            <input type="date" class="form-control" name="tgl_sk" id="tgl_sk" placeholder="Tanggal SK" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">MASA BAKTI</label>
                            <input type="date" class="form-control" name="awal_bakti" id="awal_bakti" placeholder="Mulai Tahun" required>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">SAMPAI DENGAN</label>
                            <input type="date" class="form-control" name="akhir_bakti" id="akhir_bakti" placeholder="Sampai Tahun" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="icofont-save"></i> Simpan Data</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- modal -->


<script>
    function modalKwaran(ctx) {
        $('#id_kwaran').val("")
        $('#nomor_kwaran').val("")
        $('#nama_kwaran').val("")
        $('#alamat_kwaran').val("")
        $('#kakwaran').val("")
        $('#kamabiran').val("")
        $('#status_kepemilikan').val("")
        $('#sifat_kepemilikan').val("")
        $('#nomor_sk').val("")
        $('#tgl_sk').val("")
        $('#awal_bakti').val("")
        $('#akhir_bakti').val("")

        let id_kwaran = $(ctx).data('id')
        if (id_kwaran != "") {
            $.ajax({
                type: "post",
                url: `${base}kwaran/ajaxDetillKwaran`,
                data: {
                    id_kwaran: id_kwaran
                },
                dataType: "json",
                success: function(data) {
                    $('#id_kwaran').val(id_kwaran)
                    $('#nomor_kwaran').val(data.nomor_kwaran)
                    $('#nama_kwaran').val(data.nama_kwaran)
                    $('#alamat_kwaran').val(data.alamat_kwaran)
                    $('#kakwaran').val(data.kakwaran)
                    $('#kamabiran').val(data.kamabiran)
                    $('#status_kepemilikan').val(data.status_kepemilikan)
                    $('#sifat_kepemilikan').val(data.sifat_kepemilikan)
                    $('#nomor_sk').val(data.nomor_sk)
                    $('#tgl_sk').val(data.tgl_sk)
                    $('#awal_bakti').val(data.awal_bakti)
                    $('#akhir_bakti').val(data.akhir_bakti)
                }
            });
        }
        $('#modal-kwaran').modal('show')
    }

    function hapusKwaran(ctx) {
        let id_kwaran = $(ctx).data('id')
        Swal.fire({
            title: 'Hapus Kwaran?',
            text: "Data Akan Dihapus Dari Server!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: `${base}kwaran/hapusKwaran`,
                    data: {
                        id_kwaran: id_kwaran
                    },
                    dataType: "json",
                    success: function(data) {
                        Swal.fire(
                            data.kode,
                            data.msg,
                            data.kode
                        )
                        $(ctx).closest('tr').remove();
                    }
                });
            }
        })
    }
</script>