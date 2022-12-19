<div class="card">
    <div class="card-header">
        <span class="btn-sm btn-warning pointer" onclick="history.back()"><i class="icofont-undo"></i> Kembali</span>
        <span class="btn-sm btn-success pointer" onclick="modalGudep(this)" data-id=""><i class="icofont-checked"></i> Tambah Gudep</span>
        <a href="<?= site_url('gudep/exportExcel') ?>" class="btn-sm btn-info pointer"><i class="icofont-download"></i> Export Excel</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" id="table-gudep">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th>No Gudep</th>
                            <th>Satuan</th>
                            <th>Nama Pangkalan</th>
                            <th class="text-center">Jumlah Anggota</th>
                            <th class="text-center">#</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
<form action="<?= site_url('gudep/simpanGudep') ?>" method="post" accept-charset="utf-8">
    <div class="modal fade" id="modal-gudep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detil Gudep</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_gudep" name="id_gudep">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="select-pangkalan-gudep">Nama Pangkalan</label>
                            <select id="select-pangkalan-gudep" name="id_pangkalan" class="form-control" style="width: 100%;" required>
                                <option value="">PILIH PANGKALAN . .</option>
                                <?php foreach ($pangkalan as $var) : ?>
                                    <option value="<?= $var->id_pangkalan ?>"><?= $var->nama_pangkalan ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="exampleInputPassword1">No Gudep</label>
                            <input type="text" id="no_gudep" class="form-control" name="no_gudep" placeholder="xxx.xxx" required="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="amabalan">Satuan</label>
                            <select id="ambalan" name="ambalan" class="form-control">
                                <option value="Putra">Putra</option>
                                <option value="Putri">Putri</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="icofont-save"></i> SIMPAN GUDEP</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end modal -->

<script>
    $(document).ready(function() {
        $('#table-gudep').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "pageLength": 25,

            "ajax": {
                "url": base + 'gudep/ajaxgudep/',
                "type": "POST"
            },

        });

        $('#table-gudep').DataTable().on('draw', function() {
            $('tr td:nth-child(1)').each(function() {
                $(this).addClass('text-center text-bold p-1')
            })
            $('tr td:nth-child(2)').each(function() {
                $(this).addClass('p-1')
            })
            $('tr td:nth-child(3)').each(function() {
                $(this).addClass('p-1')
            })
            $('tr td:nth-child(4)').each(function() {
                $(this).addClass('p-1')
            })
            $('tr td:nth-child(5)').each(function() {
                $(this).addClass('text-center text-bold p-1')
            })
            $('tr td:nth-child(6)').each(function() {
                $(this).addClass('text-center text-bold p-1')
            })
        });
    });

    function modalGudep(ctx) {
        let id_gudep = $(ctx).data('id')
        $('#id_gudep').val("")
        $('#ambalan').val("")
        $('#id_pangkalan').val("")
        $('#no_gudep').val("")

        if (id_gudep) {
            $.ajax({
                type: "post",
                url: `${base}gudep/detilGudep`,
                data: {
                    id_gudep: id_gudep
                },
                dataType: "json",
                success: function(data) {
                    $('#id_gudep').val(id_gudep)
                    $('#ambalan').val(data.ambalan)
                    $('#select-pangkalan-gudep').val(data.id_pangkalan).change()
                    $('#no_gudep').val(data.no_gudep)
                }
            });
        }
        $('#modal-gudep').modal('show')
    }

    function hapusGudep(ctx) {
        let id_gudep = $(ctx).data('id')
        Swal.fire({
            title: 'Hapus Gudep?',
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
                    url: `${base}gudep/hapusGudep`,
                    data: {
                        id_gudep: id_gudep
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