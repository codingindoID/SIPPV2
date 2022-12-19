<?php
$level = $this->session->userdata('sipp_ses_level');
?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 d-flex mb-2">
                <span class="btn-sm btn-warning pointer" onclick="history.back()"><i class="icofont-undo"></i> Kembali</span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sriped table-hover w-100" id="table-anggota-lain">
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

<script>
    $(document).ready(function() {
        $('#table-anggota-lain').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "pageLength": 25,

            "ajax": {
                "url": base + 'anggota/ajaxAnggotaLain/',
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