<div class="card">
    <div class="card-header">
        <span class="btn-sm btn-success pointer" data-id="" onclick="modalAdminGudep(this)"><i class="icofont-ui-user-group"></i> Tambah Admin</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped data-table">
                <thead class="bg-primary">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Asal Pangkalan</th>
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
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td><b><?php echo strtoupper($adm->nama_pangkalan) ?></b></td>
                            <td><?php echo $adm->display_name ?></td>
                            <td><?php echo $adm->email ?></td>
                            <td><?php echo $adm->username ?></td>
                            <td><a href="#" data-id="<?php echo $adm->id_user ?>" onclick="modalPasswordGudep(this)"><?php echo substr($adm->password, 1, 10) ?></a></td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a href="#" class="btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
                                        <i class="icofont-navigation-menu"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" data-id="<?= $adm->id_user ?>" onclick="modalAdminGudep(this)"><i class="icofont-gear"></i> Edit</a>
                                        <a class="dropdown-item" href="#" data-id="<?= $adm->id_user ?>" onclick="hapusAdminGudep(this)"><i class="icofont-ui-delete"></i> Hapus</a>
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
<form action="<?php echo site_url('admin/simpanAdminGudep') ?>" method="post" accept-charset="utf-8">
    <div id="modal-admin-gudep" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title"><span id="title_modal">Tambah Admin Kwaran</span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label>Kwaran ** </label>
                            <select id="kwaran-modal-admin-gudep" name="id_kwaran" class="form-control" style="width: 100%;" required>
                                <option value="">Pilih . . </option>
                                <?php foreach ($kwaran as $k) : ?>
                                    <option value="<?php echo $k->id_kwaran ?>"><?= $k->nomor_kwaran ?> - <?php echo $k->nama_kwaran ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Pangkalan ** </label>
                            <select id="pangkalan-modal-admin-gudep" name="id_pangkalan" class="form-control" style="width: 100%;" required>
                                <option value="">Pilih . . </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="hidden" name="id_user" id="id_user">
                            <label for="exampleInputEmail1">Set Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="username" required>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Set Email</label>
                            <input type="email" class="form-control" name="email" placeholder="email" id="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Set Display Name</label>
                            <input type="text" class="form-control" name="display_name" id="display_name" placeholder="display name" required>
                        </div>
                    </div>
                    <div class="row col-md-12 ml-1">
                        <p class="text-danger"><b>NB : </b> Default password = <b>12345</b></p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit"><i class="icofont-save"></i> Simpan Data</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- modal -->
<form action="<?= site_url('admin/updatePassword/admingudep') ?>" method="post">
    <div id="modal-password-gudep" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="title_modal">Ganti Password</span></h5>
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
                        <button class="btn btn-primary" id="simpan_pass"><i class="icofont-lock"></i> Update Password</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    function modalAdminGudep(ctx) {
        let id_user = $(ctx).data('id')
        $('#id_user').val("")
        $('#email').val("")
        $('#username').val("")
        $('#kwaran-modal-admin-gudep').val("").change()
        $('#pangkalan-modal-admin-gudep').html("")
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
                    $('#kwaran-modal-admin-gudep').val(data.id_kwaran).change()

                    $.ajax({
                        type: "post",
                        url: `${base}globalController/ajaxPangkalanByKwaran`,
                        data: {
                            kwaran: data.id_kwaran
                        },
                        dataType: "json",
                        success: function(pangkalan) {
                            let html = '<option value="">PILIH PANGKALAN . .</option>'
                            for (let index = 0; index < pangkalan.length; index++) {
                                html += `<option value="${pangkalan[index].id_pangkalan}">${pangkalan[index].nama_pangkalan}</option>`
                            }
                            $('#pangkalan-modal-admin-gudep').html(html)
                            $('#pangkalan-modal-admin-gudep').val(data.id_pangkalan).change()
                        }
                    });

                    $('#display_name').val(data.display_name)
                }
            });
        }
        $('#modal-admin-gudep').modal('show')
    }

    function modalPasswordGudep(ctx) {
        let id_user = $(ctx).data('id')
        $('#id_user_pass').val("")
        if (id_user) {
            $('#id_user_pass').val(id_user)
            $('#modal-password-gudep').modal('show')
        }
    }

    function hapusAdminGudep(ctx) {
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

    $(document).ready(function() {
        $('#kwaran-modal-admin-gudep').on('change', function() {
            let id_kwaran = $(this).val()
            $('#pangkalan-modal-admin-gudep').html("")
            if (id_kwaran) {
                $.ajax({
                    type: "post",
                    url: `${base}globalController/ajaxPangkalanByKwaran`,
                    data: {
                        kwaran: id_kwaran
                    },
                    dataType: "json",
                    success: function(data) {
                        let html = '<option value="">PILIH PANGKALAN . .</option>'
                        for (let index = 0; index < data.length; index++) {
                            html += `<option value="${data[index].id_pangkalan}">${data[index].nama_pangkalan}</option>`
                        }
                        $('#pangkalan-modal-admin-gudep').html(html)
                    }
                });
            }
        })
    });
</script>