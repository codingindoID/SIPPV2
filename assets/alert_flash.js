var xxx_logo = $('#x_flash').val()
var yyy_message = $('#m_flash').val()

if (xxx_logo != "" ) {
	if (xxx_logo == 'error' || xxx_logo == 'warning' ) {
		Swal.fire(
			xxx_logo,
			yyy_message,
			xxx_logo
			)

	}
	else
	{
		Swal.fire({
			position: 'center',
			icon: xxx_logo,
			title: yyy_message,
			showConfirmButton: false,
			timer: 1000
		})
	}
}

