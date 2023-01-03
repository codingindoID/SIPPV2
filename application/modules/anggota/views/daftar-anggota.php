<?php
$level = $this->session->userdata('sipp_ses_level');
?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 d-flex mb-2">
                <span class="btn-sm btn-warning pointer" onclick="history.back()"><i class="icofont-undo"></i> Kembali</span>
                <a class="btn-sm btn-primary mt-auto my-auto ml-1" href="<?= site_url('anggota/formTambahAnggota') ?>"><i class="icofont-user-alt-2"></i> Tambah Anggota</a>
                <a class="btn-sm btn-info mt-auto my-auto ml-1" href="<?= site_url('anggota/formImport') ?>"><i class="icofont-upload-alt"></i> Import Excel</a>
                <a class="btn-sm btn-success mt-auto my-auto ml-1" href="<?= site_url('anggota/exportExcel') ?>"><i class="icofont-file-excel"></i> Export Anggota</a>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="<?= $level == SUPERADMIN ? 'col' : 'col-md-4 ml-auto' ?>">
                        <select class="form-control" name="bulk" id="bulk">
                            <option value="">--action--</option>
                            <option value="hapusAngkatan">Hapus Anggota By TA</option>
                        </select>
                    </div>

                    <?php if ($level == SUPERADMIN) : ?>
                        <div class="col">
                            <select id="filterKwaran" class="form-control">
                                <option value="">Filter Kwarran</option>
                                <?php foreach ($kwarran as $var) : ?>
                                    <option value="<?= $var->id_kwaran ?>"><?= $var->nama_kwaran ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sriped table-hover w-100" id="table-anggota">
                <thead>
                    <tr class="text-center bg-primary text-white">
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Asal Pangkalan</th>
                        <th>Satuan</th>
                        <th>Golongan</th>
                        <th>Tingkat</th>
                        <th>TA</th>
                        <th class="text-center">#</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- modal -->
<form action="<?= site_url('anggota/bulkHapus') ?>" method="post">
    <div class="modal fade" id="modal-bulk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php if ($level != ADMIN_GUDEP) : ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pangkalan <span class="text-danger">**</span></label>
                                    <select id="pangkalan_anggota_bulk" class="form-control" name="id_pangkalan" required style="width: 100%;">
                                        <option value="">Pilih Pangkalan. . </option>
                                        <?php foreach ($pangkalan as $pang) : ?>
                                            <option value="<?php echo $pang->id_pangkalan ?>"><?php echo $pang->nama_pangkalan ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="col">
                            <div class="form-group">
                                <label>Pilih Tahun Ajaran</label>
                                <select id="ta_bulk" name="ta" required class="form-control">
                                    <option value="">--Pilih Tahun--</option>
                                    <?php if ($level == ADMIN_GUDEP) : ?>
                                        <?php foreach ($tahun as $var) : ?>
                                            <option value="<?= $var->ta ?>"><?= $var->ta ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="sumbit" class="btn btn-danger">HAPUS</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- modal -->


<script>
    $(document).ready(function() {
        $('#table-anggota').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "pageLength": 25,

            "ajax": {
                "url": base + 'anggota/ajaxAnggota/',
                "type": "POST"
            },

        });

        $('#table-anggota').DataTable().on('draw', function() {
            $('tr td:nth-child(1)').each(function() {
                $(this).addClass('text-center text-bold p-2')
            })
            $('tr td:nth-child(2)').each(function() {
                $(this).addClass('p-2')
            })
            $('tr td:nth-child(3)').each(function() {
                $(this).addClass('p-2')
            })
            $('tr td:nth-child(4)').each(function() {
                $(this).addClass('p-2')
            })
            $('tr td:nth-child(5)').each(function() {
                $(this).addClass('p-2')
            })
            $('tr td:nth-child(6)').each(function() {
                $(this).addClass('p-2')
            })
            $('tr td:nth-child(7)').each(function() {
                $(this).addClass('text-center text-bold p-1')
            })
        });


        $('#bulk').on('change', function() {
            let action = $(this).val()
            switch (action) {
                case 'hapusAngkatan':
                    $('#modal-bulk').modal('show')
                    break;

                default:
                    break;
            }
        })

        $('#pangkalan_anggota_bulk').on('change', function() {
            let id_pangkalan = $(this).val()
            $('#ta_bulk').html('')
            $.ajax({
                type: "post",
                url: `${base}anggota/getTahunBulkHapus`,
                data: {
                    id_pangkalan: id_pangkalan
                },
                dataType: "json",
                success: function(data) {
                    let html = '<option value="">--PILIH TAHUN--</option>'
                    for (let index = 0; index < data.length; index++) {
                        html += `<option value="${data[index].ta}">${data[index].ta}</option>`
                    }
                    $('#ta_bulk').html(html)
                }
            });
        })

        $('#filterKwaran').on('change', function() {
            let kwaran = $(this).val()
            var table = $('#table-anggota').DataTable();
            table.destroy()
            $('#table-anggota').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "pageLength": 25,

                "ajax": {
                    "url": base + 'anggota/ajaxAnggota/' + kwaran,
                    "type": "POST"
                },

            });

        })
    });

    function hapusBaris(ctx) {
        let id_anggota = $(ctx).data('id');
        Swal.fire({
            title: 'Hapus Anggota?',
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
                    url: `${base}anggota/hapusAngota`,
                    data: {
                        id_anggota: id_anggota
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