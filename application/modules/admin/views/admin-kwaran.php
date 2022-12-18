<div class="card">
    <div class="card-header">
        <a class="btn-sm btn-success" href="#" onclick="modalAdminKwaran(this)" data-id=""><i class="icofont-ui-user-group"></i> Tambah Admin</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover data-table">
                <thead class="bg-primary">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Asal Kwaran</th>
                        <th>Nama Alias</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th class="text-center">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($admin as $adm) : ?>
                        <tr>
                            <td class="text-center p-1"><?php echo $no++ ?></td>
                            <td class="p-1"><b><?php echo strtoupper($adm->nama_kwaran) ?></b></td>
                            <td class="p-1"><?php echo $adm->display_name ?></td>
                            <td class="p-1"><?php echo $adm->email ?></td>
                            <td class="p-1"><?php echo $adm->username ?></td>
                            <td class="p-1"><a href="#" data-toggle="modal" data-id="<?= $adm->id_user ?>" onclick="modalPasswordKwaran(this)"><?php echo substr($adm->password, 1, 10) ?></a></td>
                            <td class="text-center p-1">
                                <div class="dropdown">
                                    <a href="#" class="btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
                                        <i class="icofont-navigation-menu"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" data-id="<?= $adm->id_user ?>" onclick="modalAdminKwaran(this)"><i class="icofont-gear"></i> Edit</a>
                                        <a class="dropdown-item" href="#" data-id="<?php echo $adm->id_user ?>" onclick="hapusAdminKwaran(this)"><i class="icofont-ui-delete"></i> Hapus</a>
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
<form action="<?php echo site_url('admin/simpanAdminKwaran') ?>" method="post" accept-charset="utf-8">
    <div id="modal-admin-kwaran" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title"><span id="title_modal">Detil Admin <?= ucfirst(KWARAN) ?></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="hidden" name="id_user" id="id_user">
                            <label for="exampleInputEmail1">Set Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="username" required>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Set Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Set Display Name</label>
                            <input type="text" class="form-control" name="display_name" id="display_name" placeholder="display name" required>
                        </div>
                        <div class="col-md-6">
                            <label>Kwaran ** </label>
                            <select id="select-kwaran-admin" name="id_kwaran" class="form-control" style="width: 100%;" required>
                                <option value="">Pilih . . </option>
                                <?php foreach ($kwaran as $k) : ?>
                                    <option value="<?php echo $k->id_kwaran ?>"><?php echo $k->nama_kwaran ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row col-md-12 ml-1">
                        <p class="text-danger"><b>NB : </b> Default password = <b>12345</b></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="icofont-save"></i> Simpan Data</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- modal -->
<form action="<?= site_url('admin/updatePassword/adminKwaran') ?>" method="post">
    <div id="modal-pass-admin-kwaran" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title"><span id="title_modal">Ganti Password</span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="hidden" name="id_user" id="id_user_pass">
                            <label for="exampleInputEmail1">Set Password Baru</label>
                            <input type="password" class="form-control" name="password1" placeholder="password" required>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Ulangi</label>
                            <input type="password" class="form-control" name="password2" placeholder="ulang password" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary"><i class="fa fa-lock"></i> Update Password</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



<script>
    function modalAdminKwaran(ctx) {
        let id_user = $(ctx).data('id')
        $('#id_user').val("")
        $('#email').val("")
        $('#username').val("")
        $('#select-kwaran-admin').val("").change()
        $('#display_name').val("")

        if (id_user) {
            $.ajax({
                type: "post",
                url: `${base}/admin/detilAdmin`,
                data: {
                    id_user: id_user
                },
                dataType: "json",
                success: function(data) {
                    $('#id_user').val(id_user)
                    $('#email').val(data.email)
                    $('#username').val(data.username)
                    $('#select-kwaran-admin').val(data.id_kwaran).change()
                    $('#display_name').val(data.display_name)
                }
            });
        }
        $('#modal-admin-kwaran').modal('show')
    }

    function modalPasswordKwaran(ctx) {
        let id_user = $(ctx).data('id')
        $('#id_user_pass').val("")
        if (id_user) {
            $('#id_user_pass').val(id_user)
            $('#modal-pass-admin-kwaran').modal('show')
        }
    }

    function hapusAdminKwaran(ctx) {
        let id_user = $(ctx).data('id')
        Swal.fire({
            title: 'Hapus Admin?',
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
                    url: `${base}admin/hapusAdmin`,
                    data: {
                        id_user: id_user
                    },
                    dataType: "json",
                    success: function(data) {
                        Swal.fire(
                            data.kode,
                            data.msg,
                            data.kode
                        )
                        if (data.kode == 'success') {
                            $(ctx).closest('tr').remove();
                        }
                    }
                });
            }
        })
    }
</script>