<span class="btn-sm btn-warning pointer" onclick="history.back()"><i class="icofont-undo"></i> Kembali</span>
<div class="card card-body mt-2">
	<form method="post" action="<?php echo site_url('anggota/simpanAnggota') ?>">
		<div class="row">
			<div class="col-md-3">
				<input type="hidden" name="id_anggota" value="<?php echo $anggota->id_anggota ?>">
				<div class="form-group">
					<label>Kwaran ** </label>
					<div class="select2-input">
						<select id="kwaran" name="kwaran" class="form-control" required>
							<option value="">Pilih . . </option>
							<?php foreach ($kwaran as $k) : ?>
								<option <?php echo $anggota->id_kwaran == $k->id_kwaran ? 'selected' : '' ?> value="<?php echo $k->id_kwaran ?>"><?php echo $k->nama_kwaran ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Pangkalan <span class="text-danger">**</span></label>
					<select id="id_pangkalan" name="id_pangkalan" class="form-control select2" required>
						<option value="">Pilih Pangkalan. . </option>
						<?php foreach ($pangkalan as $var) : ?>
							<option value="<?= $var->id_pangkalan ?>" <?= $var->id_pangkalan == $anggota->id_pangkalan ? 'selected' : '' ?>><?= $var->nama_pangkalan ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Gudep **</label>
					<select id="gudep" name="gudep" class="form-control select2" required>
						<option value="">Pilih Gudep. . </option>
						<?php foreach ($gudep as $g) : ?>
							<option <?php echo $anggota->id_gudep == $g->id_gudep ? 'selected' : '' ?> value="<?php echo $g->id_gudep ?>"><?php echo $g->no_gudep . ' - ' . $g->ambalan  ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Tahun Ajaran <span class="text-danger">**</span></label>
					<input type="number" class="form-control" name="ta" required value="<?php echo $anggota->ta != null ? $anggota->ta : '' ?>">
				</div>
			</div>
		</div>
		<div class="info">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nama **</label>
						<input type="text" class="form-control" name="nama" value="<?php echo $anggota->nama ?>" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Agama<span class="text-danger">**</span></label>
						<select id="agama" name="agama" class="form-control" style="width: 100%;" required>
							<option value="">PILIH AGAMA . . </option>
							<?php foreach ($agama as $a) : ?>
								<option value="<?php echo $a->agama ?>" <?= $anggota->agama == $a->agama ? 'selected' : '' ?>><?php echo $a->agama ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md">
					<span><b>Alamat <span class="text-danger">**</span></b></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<div class="select2-input">
							<select id="kecamatan" name="kecamatan" class="form-control" style="width: 100%;">
								<option value="">KECAMATAN . . </option>
								<?php foreach ($kecamatan as $kec) : ?>
									<option <?php echo $anggota->kecamatan == $kec->id_kecamatan ? 'selected' : '' ?> value="<?php echo $kec->id_kecamatan ?>"><?php echo $kec->nama_kecamatan ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<div class="select2-input">
							<select id="desa" name="desa" class="form-control" style="width: 100%;">
								<option value="">PILIH DESA</option>
								<?php foreach ($desa as $des) : ?>
									<option <?php echo $anggota->desa == $des->id_desa ? 'selected' : '' ?> value="<?php echo $des->id_desa ?>"><?php echo $des->nama_desa ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<input type="number" class="form-control" name="rt" placeholder="RT" value="<?= $anggota->rt ?>">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<input type="number" class="form-control" name="rw" placeholder="RW" value="<?= $anggota->rw ?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>ALamat Lengkap</label>
						<textarea name="alamat" class="form-control" rows="2" readonly><?php echo $anggota->alamat ?></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Tempat Lahir</label>
						<input type="text" class="form-control" name="tempat_lahir" value="<?php echo $anggota->tempat_lahir ?>" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Tanggal Lahir</label>
						<input type="date" class="form-control" name="tgl_lahir" value="<?php echo $anggota->tanggal_lahir != null ? $anggota->tanggal_lahir : '-' ?>" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Golongan Darah **</label>
						<select name="darah" class="form-control" required>
							<option value="">Pilih . . </option>
							<?php foreach ($darah as $d) : ?>
								<option <?php echo $d->darah == $anggota->gol_darah ? 'selected' : '' ?> value="<?php echo $d->darah ?>"><?php echo $d->darah ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>
			<div class="separator-solid"></div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Golongan Kepramukaan **</label>
						<select id="golongan" name="golongan" class="form-control" required>
							<option value="">Pilih . . </option>
							<?php foreach ($golongan as $g) : ?>
								<option <?php echo $anggota->golongan == $g->golongan ? 'selected' : '' ?> value="<?php echo $g->golongan ?>"><?php echo strtoupper($g->golongan) ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Tingkat / Kualifikasi ( Tingkatan Terahir Yang Diperoleh ) <span class="text-danger">**</span></label>
						<select id="tingkat" name="tingkat" class="form-control" required>
							<option value="">Pilih Tingkat. . </option>
							<?php foreach ($tingkat as $t) : ?>
								<option value="<?php echo $t->sub_tingkat ?>" <?php echo $anggota->tingkat == $t->sub_tingkat ? 'selected' : '' ?>><?php echo strtoupper($t->sub_tingkat) ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<p class="ml-2 text-danger">* Keterangan : NK = Non Kualifikasi</p>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Nomor KTA ( kosongkan jika tidak mempunyai )</label>
						<input type="text" class="form-control" name="kta" value="<?php echo $anggota->kta ?>" placeholder="-">
					</div>
				</div>
			</div>
			<hr>
			<p role="button" aria-expanded="false" aria-controls="collapseExample"><i class="icofont-badge"></i> <b>Ijazah KMD</b><span class="caret"></span></p>
			<div class="row" id="kmd">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nomor</label>
						<input type="text" class="form-control" name="no_kmd" value="<?= $anggota->no_kmd ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Penyelenggara</label>
						<input type="text" class="form-control" name="pel_kmd" value="<?= $anggota->pel_kmd ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Tempat</label>
						<input type="text" class="form-control" name="tempat_kmd" value="<?= $anggota->tempat_kmd ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Tahun</label>
						<input type="number" class="form-control" name="tahun_kmd" value="<?= $anggota->tahun_kmd ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-4">

				</div>
			</div>
			<hr>
			<p role="button" aria-expanded="false" aria-controls="collapseExample"><i class="icofont-badge"></i> <b>Ijazah KML</b><span class="caret"></span></p>
			<div class="row" id="kml">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nomor</label>
						<input type="text" class="form-control" name="no_kml" value="<?= $anggota->no_kml ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Penyelenggara</label>
						<input type="text" class="form-control" name="pel_kml" value="<?= $anggota->pel_kml ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Tempat</label>
						<input type="text" class="form-control" name="tempat_kml" value="<?= $anggota->tempat_kml ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Tahun</label>
						<input type="number" class="form-control" name="tahun_kml" value="<?= $anggota->tahun_kml ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Golongan</label>
						<select name="golongan_kml" class="form-control">
							<option value="">Pilih . . </option>
							<?php foreach ($golongan as $g) : ?>
								<option <?= $anggota->golongan_kml == $g->golongan ? 'selected' : '' ?> value="<?php echo $g->golongan ?>"><?php echo $g->golongan ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>

			<hr>
			<p role="button" aria-expanded="false" aria-controls="collapseExample"><i class="icofont-badge"></i> <b>Ijazah KPD</b><span class="caret"></span></p>
			<div class="row" id="kpd">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nomor</label>
						<input type="text" class="form-control" name="no_kpd" value="<?= $anggota->no_kpd ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Penyelenggara</label>
						<input type="text" class="form-control" name="pel_kpd" value="<?= $anggota->pel_kpd ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Tempat</label>
						<input type="text" class="form-control" name="tempat_kpd" value="<?= $anggota->tempat_kpd ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Tahun</label>
						<input type="number" class="form-control" name="tahun_kpd" value="<?= $anggota->tahun_kpd ?>" placeholder="-" value="">
					</div>
				</div>
				<div class="col-md-4">

				</div>
			</div>

			<hr>
			<p role="button" aria-expanded="false" aria-controls="collapseExample"><i class="icofont-badge"></i> <b>Ijazah KPL</b><span class="caret"></span></p>
			<div class="row" id="kpl">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nomor</label>
						<input type="text" class="form-control" name="no_kpl" value="<?= $anggota->no_kpl ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Penyelenggara</label>
						<input type="text" class="form-control" name="pel_kpl" value="<?= $anggota->pel_kpl ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Tempat</label>
						<input type="text" class="form-control" name="tempat_kpl" value="<?= $anggota->tempat_kpl ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Tahun</label>
						<input type="number" class="form-control" name="tahun_kpl" value="<?= $anggota->tahun_kpl ?>" placeholder="-">
					</div>
				</div>
				<div class="col-md-4">

				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button type="submit" class="btn btn-success" style="color: white"><i class="icofont-save"></i> Simpan Perubahan</button>
					</div>
				</div>
			</div>
		</div>


	</form>
</div>

<script src="<?= base_url('assets/partJs/anggota.js') ?>"></script>