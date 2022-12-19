$(document).ready(function () {
    $('#kwaran').on('change', function () {
        $('#id_pangkalan').html("")
        let kwarran = $(this).val()
        $.ajax({
            type: "post",
            url: `${base}globalController/ajaxPangkalanByKwaran`,
            data: {
                kwaran: kwarran
            },
            dataType: "json",
            success: function (data) {
                $('#id_pangkalan').attr('disabled', false)
                let html = `<option value="">Pilih Pangkalan . . .</option>`
                for (let index = 0; index < data.length; index++) {
                    html += `<option value="${data[index].id_pangkalan}">${data[index].nama_pangkalan}</option>`
                }
                $('#id_pangkalan').html(html)
            }
        });
    });

    $('#id_pangkalan').on('change', function () {
        $('#gudep').html("")
        let id_pangkalan = $(this).val()
        $.ajax({
            type: "post",
            url: `${base}globalController/getGudepByPangkalan`,
            data: {
                id_pangkalan: id_pangkalan
            },
            dataType: "json",
            success: function (data) {
                $('#gudep').attr('disabled', false)
                let html = ''
                for (let index = 0; index < data.length; index++) {
                    html += `<option value="${data[index].id_gudep}">${data[index].no_gudep} - ${data[index].ambalan}</option>`
                }
                $('#gudep').append(html)
            }
        });
    });

    $('#kecamatan').on('change', function () {
        $('#desa').html("")
        let id_kecamatan = $(this).val()
        $.ajax({
            type: "post",
            url: `${base}globalController/getDesaByKecamatan`,
            data: {
                id_kecamatan: id_kecamatan
            },
            dataType: "json",
            success: function (data) {
                $('#desa').attr('disabled', false)
                $('input[name="rt"]').attr('disabled', false)
                $('input[name="rw"]').attr('disabled', false)
                let html = ''
                for (let index = 0; index < data.length; index++) {
                    html += `<option value="${data[index].id_desa}">${data[index].nama_desa}</option>`
                }
                $('#desa').append(html)
            }
        });
    });

    $('#golongan').on('change', function () {
        $('#tingkat').html("")
        let tingkat = $(this).val()
        $.ajax({
            type: "post",
            url: `${base}globalController/getTingkatByGolongan`,
            data: {
                tingkat: tingkat
            },
            dataType: "json",
            success: function (data) {
                $('#tingkat').attr('disabled', false)
                let html = ''
                for (let index = 0; index < data.length; index++) {
                    html += `<option value="${data[index].sub_tingkat}">${data[index].sub_tingkat}</option>`
                }
                $('#tingkat').append(html)
            }
        });
    });
});