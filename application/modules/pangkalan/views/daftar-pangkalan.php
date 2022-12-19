<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <span class="btn-sm btn-warning pointer" onclick="history.back()"><i class="icofont-undo"></i> Kembali</span>
            </div>
            <div class="col-md-6 text-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="#" onclick="modalPangkalan(this)" data-id="" data-toggle="modal" class="btn-sm btn-success"><i class="icofont-checked"></i> Tambah</a>
                    <!-- <a href="#" class="btn-sm btn-primary ml-1"><i class="icofont-upload"></i> Import</a> -->
                    <a href="<?= site_url('pangkalan/exportExcel') ?>" class="btn-sm btn-info ml-1"><i class="icofont-download"></i> Export</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover data-table">
                <thead class="bg-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Pangkalan</th>
                        <th>Kamabigus</th>
                        <th>Kgudep</th>
                        <th class="text-center">Jumlah Pembina</th>
                        <th class="text-center">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($pangkalan as $p) : ?>
                        <tr>
                            <td class="text-center text-bold p-1"><?php echo $no++ ?></td>
                            <td class="p-1"><?php echo $p->nama_pangkalan ?></td>
                            <td class="p-1"><?php echo $p->kamabigus ?></td>
                            <td class="p-1"><?php echo $p->kagudep ?></td>
                            <td class="text-center p-1"><?php echo $p->jumlah_pembina ?></td>
                            <td class="text-center p-1">
                                <div class="dropdown">
                                    <a href="#" class="btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icofont-navigation-menu text-white"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" target="__blank" href="<?php echo site_url('pangkalan/lihat/') . $p->id_pangkalan ?>"><i class="icofont-eye-alt text-primary"></i> Lihat</a>
                                        <a class="dropdown-item pointer" data-id="<?= $p->id_pangkalan ?>" onclick="modalPangkalan(this)"><i class="icofont-gears text-success"></i> Edit</a>
                                        <a class="dropdown-item" href="#" onclick="hapusPangkalan(this)" data-id="<?= $p->id_pangkalan ?>"><i class="icofont-ui-delete text-danger"></i>Hapus</a>
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

<!-- modal -->
<form action="<?php echo site_url('pangkalan/simpanPangkalan') ?>" method="post">
    <div id="modal-pangkalan" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detil Pangkalan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_pangkalan" id="id_pangkalan">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Nama Pangkalan</label>
                            <input type="text" id="nama_pangkalan" name="nama_pangkalan" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Kwaran ** </label>
                            <div class="select2-input">
                                <select id="select-kwaran-pangklan" class="form-control" name="kwaran" required style="width: 100%;">
                                    <?php foreach ($kwaran as $k) : ?>
                                        <option value="<?php echo $k->id_kwaran ?>"><?= $k->id_kwaran ?> - <?php echo $k->nama_kwaran ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="exampleInputPassword1">Alamat</label>
                            <textarea type="text" class="form-control" id="alamat_pangkalan" name="alamat_pangkalan" placeholder="xxx.xxx" required></textarea>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">Ka. Mabigus</label>
                            <input type="text" name="kamabigus" id="kamabigus" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">Ka. Gudep</label>
                            <input type="text" name="kagudep" id="kagudep" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">Jumlah Pembina</label>
                            <input type="number" name="jumlah_pembina" id="jumlah_pembina" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="icofont-save"></i> Simpan Data</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- modal -->



<script>
    function modalPangkalan(ctx) {
        $('#id_pangkalan').val("")
        $('#nama_pangkalan').val("")
        $('#select-kwaran-pangklan').val("").change()
        $('#alamat_pangkalan').text("")
        $('#kagudep').val("")
        $('#kamabigus').val("")
        $('#jumlah_pembina').val("")
        let id_pangkalan = $(ctx).data('id')
        if (id_pangkalan != "") {
            $.ajax({
                type: "post",
                url: `${base}pangkalan/ajaxDetilPangkalan`,
                data: {
                    id_pangkalan: id_pangkalan
                },
                dataType: "json",
                success: function(data) {
                    $('#id_pangkalan').val(id_pangkalan)
                    $('#nama_pangkalan').val(data.nama_pangkalan)
                    $('#select-kwaran-pangklan').val(data.kwaran).change()
                    $('#alamat_pangkalan').text(data.alamat_pangkalan)
                    $('#kagudep').val(data.kagudep)
                    $('#kamabigus').val(data.kamabigus)
                    $('#jumlah_pembina').val(data.jumlah_pembina)
                }
            });
        }
        $('#modal-pangkalan').modal('show')
    }

    function hapusPangkalan(ctx) {
        let id_pangkalan = $(ctx).data('id')
        Swal.fire({
            title: 'Hapus Pangkalan?',
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
                    url: `${base}pangkalan/hapusPangkalan`,
                    data: {
                        id_pangkalan: id_pangkalan
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