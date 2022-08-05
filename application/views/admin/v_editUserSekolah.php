<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4>Edit Data Petugas Sekolah</h4>
	<div class="card mb-4">
		<div class="card-body">
			<?= form_open_multipart('validation_userSekolah_edit'); ?>
			<div class="row">
				<div class="col-md-6">
					<h5>Data Pribadi</h5>
					<div class="form-group">
						<label>Kode Anggota</label>
						<input type="hidden" name="user_id" class="form-control" value="<?= $user_detail->user_id; ?>" required>
						<input type="text" name="user_noId" class="form-control" value="<?= $user_detail->user_noId; ?>" required>
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="user_nama" class="form-control" value="<?= $user_detail->user_nama; ?>" required>
					</div>
					<div class="form-group">
						<label>Tempat Lahir</label>
						<input type="text" name="user_tempatLahir" class="form-control" value="<?= $user_detail->user_tempatLahir; ?>" required>
					</div>
					<div class="form-group">
						<label>Tanggal Lahir</label>
						<input type="date" name="user_tanggalLahir" class="form-control" value="<?= $user_detail->user_tanggalLahir; ?>" required>
					</div>
					<div class="form-group">
						<label>Klasifikasi</label>
						<select class="form-control" id="user_klasifikasi" name="user_klasifikasi">
							<option value="<?= $user_detail->pekerjaan_id; ?>"><?= $user_detail->pekerjaan; ?></option>
							<?php foreach ($pekerjaan as $item) { ?>
								<option value="<?= $item->pekerjaan_id; ?>"><?= $item->pekerjaan; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Sekolah</label>
						<select class="form-control" id="sekolah_id" name="sekolah_id">
							<option value="<?= $user_detail->sekolah_id; ?>"><?= $user_detail->sekolah_nama; ?></option>
							<?php foreach ($sekolah as $item) { ?>
								<option value="<?= $item->sekolah_id; ?>"><?= $item->sekolah_nama; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>KTP</label>
						<input type="text" name="user_ktp" class="form-control" value="<?= $user_detail->user_ktp; ?>" required>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="user_username" class="form-control" value="<?= $user_detail->user_username; ?>" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="user_password" class="form-control" placeholder="Isi jika ingin ganti password">
					</div>
					<div class="form-group">
						<label>Nomor HP</label>
						<input type="number" name="user_noHP" class="form-control" value="<?= $user_detail->user_noHP; ?>" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="user_email" class="form-control" value="<?= $user_detail->user_email; ?>" required>
					</div>
					<img src="<?= base_url("vendor/img/user/" . $user_detail->user_foto); ?>" alt="Foto Petugas" style="max-width: 20%;">
					<div class="form-group">
						<label>Foto User</label>
						<input type="file" name="user_foto" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<h5>Data Orang Tua / Wali</h5>
					<div class="form-group">
						<label>Nama Orang Tua / Wali</label>
						<input type="text" name="orangtua_nama" class="form-control" value="<?= $user_detail->orangtua_nama; ?>" required>
					</div>
					<div class="form-group">
						<label>Nomor HP Orang Tua / Wali</label>
						<input type="number" name="orangtua_noHP" class="form-control" value="<?= $user_detail->orangtua_noHP; ?>" required>
					</div>
					<div class="form-group">
						<label>Tempat Lahir Orang Tua / Wali</label>
						<input type="text" name="orangtua_tempatLahir" class="form-control" value="<?= $user_detail->orangtua_tempatLahir; ?>" required>
					</div>
					<div class="form-group">
						<label>Tanggal Lahir Orang Tua / Wali</label>
						<input type="date" name="orangtua_tanggalLahir" class="form-control" value="<?= $user_detail->orangtua_tanggalLahir; ?>" required>
					</div>
					<h5>Pertanyaan Keamanan</h5>
					<div class="form-group">
						<select name="pertanyaan" class="form-control" required>
							<option disabled selected>-- Pilih Pertanyaan --</option>
							<option <?php if ($user_detail->pertanyaan == "Siapa nama peliharaan anda?") {
												echo "selected";
											} ?> value="Siapa nama peliharaan anda?">Siapa nama peliharaan anda?</option>
							<option <?php if ($user_detail->pertanyaan == "Siapa nama kakek anda?") {
												echo "selected";
											} ?> value="Siapa nama kakek anda?">Siapa nama kakek anda?</option>
							<option <?php if ($user_detail->pertanyaan == "Siapa nama saudara anda?") {
												echo "selected";
											} ?> value="Siapa nama saudara anda?">Siapa nama saudara anda?</option>
							<option <?php if ($user_detail->pertanyaan == "Nama sekolah SD anda adalah?") {
												echo "selected";
											} ?> value="Nama sekolah SD anda adalah?">Nama sekolah SD anda adalah?</option>
						</select>
					</div>
					<div class="form-group">
						<input type="text" name="jawaban" class="form-control" value="<?= $user_detail->pertanyaan_jawaban; ?>" required>
					</div>
				</div>
			</div>
			<a href="<?= base_url("userSekolah") ?>" class="btn btn-info btn-sm mb"><i class="fas fa-chevron-left"></i> Kembali</a>
			<button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-sync"></i> Reset</button>
			<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
			<?= form_close(); ?>
		</div>
	</div>
</div>
