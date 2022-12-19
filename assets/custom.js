var base = $('#base_url').data('id')

function logout() {
    Swal.fire({
        title: 'Keluar Aplikasi?',
        text: "Session Akan Dihapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Saya Ingin Keluar!'
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = base + 'login/logout';
        }
    })
}

$(function () {
    $('.select2').select2()

    $('#select-pangkalan-gudep').select2({
        dropdownParent: $('#modal-gudep')
    });

    $('#select-kwaran-admin').select2({
        dropdownParent: $('#modal-admin-kwaran')
    });

    $('#pangkalan_anggota_bulk').select2({
        dropdownParent: $('#modal-bulk')
    });

    $('#kwaran-modal-admin-gudep').select2({
        dropdownParent: $('#modal-admin-gudep')
    });

    $('#pangkalan-modal-admin-gudep').select2({
        dropdownParent: $('#modal-admin-gudep')
    });

    $('#select-kwaran-pangklan').select2({
        placeholder: "PILIH PANGKALAN",
        allowClear: true,
        dropdownParent: $('#modal-pangkalan')
    });

    $('.data-table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});