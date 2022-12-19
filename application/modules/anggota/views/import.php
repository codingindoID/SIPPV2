<div class="card">
	<div class="card-header">
		<a class="btn-sm btn-warning" href="<?= site_url('anggota') ?>"><i class="icofont-undo"></i> Kembali</a>
		<a href="<?= base_url('excel/anggota/import_admin.xlsx') ?>" class="btn-sm btn-success btn-round"><i class="icofont-download"></i> Download Format</a>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="<?php echo site_url('anggota/upload') ?>" enctype="multipart/form-data" style="text-align: center">
					<div class="form-row">
						<div class="col-md-6">
							<input type="file" name="file" class="form-control" placeholder="pilih file xls / xlsx" accept=".xlsx, .xls">
						</div>
						<div class="col-md-2">
							<button class="btn btn-primary" type="submit" onclick="return confirm('apakah data anda sudah benar? jika ada kekeliruan mungkin akan mengakibatkan data anda redundant dan tidak valid, mohon pastikan terlebih dahulu sebelum anda melakukan proses import.. Terimakasih,.')"> <i class="icofont-upload"></i> Import File</button>
						</div>
					</div>
				</form>
			</div>

		</div>

		<hr>
		<div class="row">
			<div class="col-md-12">
				<h3 style="color: red">
					<center><strong>Petunjuk Pengisian File</strong></center>
				</h3>
				<table>
					<tbody>
						<tr>
							<td>1. Jangan melakukan perubahan header pada file excel tersebut, karena format sudah disesuaikan dengan format inputan pada database kami, </td>
						</tr>
						<tr>
							<td>2. Pada kolom kwaran silahkan isikan kode kwaran sesuai pada table dibawah ini, </td>
						</tr>
						<tr>
							<td>3. Pada kolom id gudep isikan <span style="color: red; font-weight: bold">Nomor Urut Gudep</span>, Misal : <span style="color: red; font-weight: bold">020</span> , cukup isikan dengan : <span style="color: red; font-weight: bold">20</span>.</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<hr>
		<style type="text/css" media="screen">
			div.table-kwaran div.dataTables_wrapper div.dataTables_filter input {
				width: 60%;
			}
		</style>
		<div class="row">
			<div class="col-md-4">
				<h3>
					<center><b>Kode Kwaran Terdaftar</b></center>
				</h3>
				<div class="table-responsive">
					<div class="table-kwaran">
						<table id="table-kwaran" class="table table-bordered data-table" width="100%">
							<thead>
								<tr class="bg-info">
									<th width=" 50%" class="text-center">ID KWARAN</th>
									<th class="text-center">NAMA KWARAN</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($kwaran as $k) : ?>
									<tr>
										<td class="text-center"><?php echo $k->id_kwaran ?></td>
										<td class="text-center"><?php echo $k->nama_kwaran ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<h3>
					<center><b>Kode Gudep Terdaftar</b></center>
				</h3>
				<div class="table-responsive">
					<table id="table-gudep-import" class="table table-bordered w-100">
						<thead>
							<tr class="bg-success">
								<th class="text-center">ID PANGKALAN</th>
								<th class="text-center">NO GUDEP</th>
								<th class="text-center">Pangkalan</th>
								<th class="text-center">Satuan</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>


		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#table-gudep-import').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"pageLength": 10,

			"ajax": {
				"url": base + 'gudep/ajaxGudepImport/',
				"type": "POST"
			},

		});

	});
</script>