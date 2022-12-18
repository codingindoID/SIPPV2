<div class="card">
    <div class="card-header">
        <span class="btn-sm btn-warning pointer" onclick="history.back()"><i class="icofont-undo"></i> Kembali</span>
        <span class="btn-sm btn-success pointer"><i class="icofont-checked"></i> Tambah Gudep</span>
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
</script>