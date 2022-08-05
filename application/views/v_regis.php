<?php
echo $this->session->flashdata('pesan');
$kode = $total_anggota + 1;
//Support KodeTambah
if ($kode <= 9) {
	$kodeTambah = "000";
} else if ($kode <= 99) {
	$kodeTambah = "00";
} else if ($kode <= 1000) {
	$kodeTambah = "0";
} else if ($kode <= 10000) {
	$kodeTambah = "";
}
?>
<div class="container">
	<div class="row shadow justify-content-center" data-aos="fade-down" data-aos-duration="1500">
		<h4 class="text-center"><?= $title; ?></h4>
	</div>
	<!-- Nested Row within Card Body -->
	<div class="row shadow justify-content-center" data-aos="fade-up" data-aos-duration="1500">
		<?= form_open('register') ?>
		<div class="row">
			<div class="col-md-6 my-0 mx-auto">
				<div class="p-5">
					<h5 class="text-dark">Indentitas Pribadi</h5>
					<div class="form-group">
						<!-- <input type="text" class="form-control form-control-user" value="Kode Anggota : <?php echo $kodeTambah . $kode; ?>" disabled> -->
						<input type="hidden" name="noId" class="form-control form-control-user" id="noId" value="<?php echo $kodeTambah . $kode; ?>">
						<input type="text" name="nama" class="form-control form-control-user" id="nama" placeholder="Masukan nama lengkap" value="<?= set_value('nama'); ?>" autofocus>
						<?= form_error('nama', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<input type="text" name="tempatLahir" class="form-control form-control-user" id="tempatLahir" placeholder="Masukan tempat lahir" value="<?= set_value('tempatLahir'); ?>">
						<?= form_error('tempatLahir', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<label class="text-dark">Tanggal Lahir</label>
						<input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" placeholder="Tanggal Lahir" value="<?= set_value('tanggalLahir'); ?>">
						<?= form_error('tanggalLahir', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<textarea type="text" name="alamat" class="form-control form-control-user" id="alamat" placeholder="Masukan alamat lengkap"><?= set_value('alamat'); ?></textarea>
						<?= form_error('alamat', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<input type="number" name="nomorHP" class="form-control form-control-user" id="nomorHP" placeholder="Masukan nomor HP" value="<?= set_value('nomorHP'); ?>">
						<?= form_error('nomorHP', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<input type="number" name="noKTP" class="form-control form-control-user" id="noKTP" placeholder="Masukan nomor induk KTP / Kartu Pelajar" value="<?= set_value('noKTP'); ?>">
						<?= form_error('noKTP', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<!-- <label>Jenis Kelamin</label> -->
						<select class="form-control" id="jk" name="jk">
							<option disabled selected>-- Pilih jenis kelamin --</option>
							<option name="jk" id="jk" value="L" <?php if (set_value('jk') == "L") {
																	echo 'selected';
																} ?>>Laki-Laki</option>
							<option name="jk" id="jk" value="P" <?php if (set_value('jk') == "P") {
																	echo 'selected';
																} ?>>Perempuan</option>
						</select>
						<?= form_error('jk', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<!-- <label>Klasifikasi</label> -->
						<select class="form-control" id="klasifikasi" name="klasifikasi">
							<option disabled selected>-- Pilih Klasifikasi --</option>
							<?php foreach ($pekerjaan as $item) { ?>
								<option value="<?php echo $item->pekerjaan_id; ?>"><?php echo $item->pekerjaan; ?></option>
							<?php } ?>
						</select>
						<?= form_error('klasifikasi', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<input type="email" name="mail" class="form-control form-control-user" id="mail" placeholder="Masukan alamat email" value="<?= set_value('mail'); ?>">
						<?= form_error('mail', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<input type="text" name="user" class="form-control form-control-user" id="user" placeholder="Masukan Username" value="<?= set_value('user'); ?>">
						<?= form_error('user', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group row">
						<div class="col-sm-6 mb-3 mb-sm-0">
							<input type="password" name="pass" id="pass" class="form-control form-control-user" placeholder="Masukan Password" value="<?= set_value('pass'); ?>">
							<?= form_error('pass', '<small class="text-danger" ><b>', '</b></small>') ?>
						</div>
						<div class="col-sm-6">
							<input type="password" name="pas1" id="pas1" class="form-control form-control-user" placeholder="Ulangi Password" value="<?= set_value('pas1'); ?>">
							<?= form_error('pas1', '<small class="text-danger" ><b>', '</b></small>') ?>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 mx-auto">
				<div class="p-5">
					<h5 class="">Indentitas Orang Tua / Wali</h5>
					<div class="form-group">
						<input type="text" name="namaOrangTua" class="form-control form-control-user" id="namaOrangTua" placeholder="Masukan nama Orangtua / Wali" value="<?= set_value('namaOrangTua'); ?>">
						<?= form_error('namaOrangTua', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<input type="text" name="tempatLahirOrangTua" class="form-control form-control-user" id="tempatLahirOrangTua" placeholder="Masukan tempat lahir Orang Tua / Wali" value="<?= set_value('tempatLahirOrangTua'); ?>">
						<?= form_error('tempatLahirOrangTua', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<label class="">Tanggal Lahir Orang Tua / Wali</label>
						<input type="date" name="tanggalLahirOrangTua" class="form-control form-control-user" id="tanggalLahirOrangTua" placeholder="Masukan tanggal lahir Orang Tua / Wali" value="<?= set_value('tanggalLahirOrangTua'); ?>">
						<?= form_error('tanggalLahirOrangTua', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<textarea type="text" name="alamatOrangTua" class="form-control form-control-user" id="alamatOrangTua" placeholder="Masukan alamat Orang Tua / Wali"><?= set_value('alamatOrangTua'); ?></textarea>
						<?= form_error('alamatOrangTua', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<input type="number" name="noHPOrangTua" class="form-control form-control-user" id="noHPOrangTua" placeholder="Masukan nomor HP Orang Tua / Wali" value="<?= set_value('noHPOrangTua'); ?>">
						<?= form_error('noHPOrangTua', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<br><br><br>
					<h5 class="text-dark">Pertanyaan Keamanan</h5>
					<div class="form-group">
						<select name="pertanyaan" class="form-control" id="pertanyaan">
							<option disabled selected>Pilih Pertanyaan Keamanan</option>
							<option name="pertanyaan" id="pertanyaan" value="Siapa nama peliharaan anda?" <?php if (set_value('pertanyaan') == "Siapa nama peliharaan anda?") {
																												echo 'selected';
																											} ?>>Siapa nama peliharaan anda?</option>
							<option name="pertanyaan" id="pertanyaan" value="Siapa nama kakek anda?" <?php if (set_value('pertanyaan') == "Siapa nama kakek anda?") {
																											echo 'selected';
																										} ?>>Siapa nama kakek anda?</option>
							<option name="pertanyaan" id="pertanyaan" value="Siapa nama saudara anda?" <?php if (set_value('pertanyaan') == "Siapa nama saudara anda?") {
																											echo 'selected';
																										} ?>>Siapa nama saudara anda?</option>
							<option name="pertanyaan" id="pertanyaan" value="Nama sekolah SD anda adalah?" <?php if (set_value('pertanyaan') == "Nama sekolah SD anda adalah?") {
																												echo 'selected';
																											} ?>>Nama sekolah SD anda adalah?</option>
						</select>
						<?= form_error('pertanyaan', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>
					<div class="form-group">
						<input type="text" name="jawaban" class="form-control form-control-user" id="jawaban" placeholder="Jawaban anda" value="<?= set_value('jawaban'); ?>">
						<?= form_error('jawaban', '<small class="text-danger" ><b>', '</b></small>') ?>
					</div>

					<button type="submit" class="btn btn-success btn-user btn-block " style="display: inline;"><i class="fas fa-user-plus fa-sm fa-fw mr-2"></i>Registrasi</button>
					<hr>
					<div class="text-center">
						<a class="small" href="<?= base_url('login') ?>">Punya akun? Silahkan login!</a>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
