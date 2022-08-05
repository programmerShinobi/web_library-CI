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
	<?php if ($this->session->userdata('admin_id')) : ?>
		<br>
		<div class="row shadow justify-content-center" data-aos="fade-down" data-aos-duration="1500">
			<h4 class="text-center"><?= $title; ?></h4>
		</div>
	<?php else : ?>
		<div class="row shadow justify-content-center" data-aos="fade-down" data-aos-duration="1500">
			<h4 class="text-center"><?= $title; ?></h4>
		</div>
	<?php endif; ?>
	<!-- Nested Row within Card Body -->
	<div class="row shadow justify-content-center" data-aos="fade-up" data-aos-duration="1500">
		<?= form_open('usulan') ?>
		<div class="row justify-content-center">
			<div class="col-md my-0 mx-auto">
				<div class="p-5">
					<label>Berapa kali dalam seminggu anda mengunjungi Perpustakaan Pemda Karawang ?</label>
					<?= form_error('kebutuhanpemustaka_kunjungan', '<small class="text-danger" ><b>', '</b></small>') ?>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="Satu kali seminggu" name="kebutuhanpemustaka_kunjungan" id="flexRadioDefault1.1">
						<label class="form-check-label" for="flexRadioDefault1.1">
							Satu kali seminggu
						</label><br>
						<input class="form-check-input" type="radio" value="Dua kali seminggu" name="kebutuhanpemustaka_kunjungan" id="flexRadioDefault1.2">
						<label class="form-check-label" for="flexRadioDefault1.2">
							Dua kali seminggu
						</label> <br>
						<input class="form-check-input" type="radio" value="Tiga kali seminggu" name="kebutuhanpemustaka_kunjungan" id="flexRadioDefault1.3">
						<label class="form-check-label" for="flexRadioDefault1.3">
							Tiga kali seminggu
						</label> <br>
						<input class="form-check-input" type="radio" value="Empat kali seminggu" name="kebutuhanpemustaka_kunjungan" id="flexRadioDefault1.4">
						<label class="form-check-label" for="flexRadioDefault1.4">
							Empat kali seminggu
						</label> <br>
						<input class="form-check-input" type="radio" value="Hampir tidak pernah" name="kebutuhanpemustaka_kunjungan" id="flexRadioDefault1.5">
						<label class="form-check-label" for="flexRadioDefault1.5">
							Hampir tidak pernah
						</label>
					</div><br>

					<label>Jenis koleksi yang sering anda butuhkan ketika berkunjung ke Perpustakaan Pemda Karawang ?</label>
					<?= form_error('kebutuhanpemustaka_jenisKoleksi', '<small class="text-danger" ><b>', '</b></small>') ?>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="Buku teks" name="kebutuhanpemustaka_jenisKoleksi" id="flexRadioDefault2.1">
						<label class="form-check-label" for="flexRadioDefault2.1">
							Buku teks
						</label> <br>
						<input class="form-check-input" type="radio" value="Majalah dan Surat kabar" name="kebutuhanpemustaka_jenisKoleksi" id="flexRadioDefault2.2">
						<label class="form-check-label" for="flexRadioDefault2.2">
							Majalah dan Surat kabar
						</label> <br>
						<input class="form-check-input" type="radio" value="Junal" name="kebutuhanpemustaka_jenisKoleksi" id="flexRadioDefault2.3">
						<label class="form-check-label" for="flexRadioDefault2.3">
							Junal
						</label> <br>
						<input class="form-check-input" type="radio" value="Local content (tugas akhir/skripsi/tesis)" name="kebutuhanpemustaka_jenisKoleksi" id="flexRadioDefault2.4">
						<label class="form-check-label" for="flexRadioDefault2.4">
							Local content (tugas akhir/skripsi/tesis)
						</label>
					</div><br>

					<label>Koleksi bidang apa saja yang sering anda cari ?</label>
					<?= form_error('kebutuhanpemustaka_koleksiBidang', '<small class="text-danger" ><b>', '</b></small>') ?>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="Pendidikan" name="kebutuhanpemustaka_koleksiBidang" id="flexRadioDefault3.1">
						<label class="form-check-label" for="flexRadioDefault3.1">
							Pendidikan
						</label> <br>
						<input class="form-check-input" type="radio" value="Agama" name="kebutuhanpemustaka_koleksiBidang" id="flexRadioDefault3.2">
						<label class="form-check-label" for="flexRadioDefault3.2">
							Agama
						</label> <br>
						<input class="form-check-input" type="radio" value="Sosial/ekonomi" name="kebutuhanpemustaka_koleksiBidang" id="flexRadioDefault3.3">
						<label class="form-check-label" for="flexRadioDefault3.3">
							Sosial/ekonomi
						</label> <br>
						<input class="form-check-input" type="radio" value="Sains" name="kebutuhanpemustaka_koleksiBidang" id="flexRadioDefault3.4">
						<label class="form-check-label" for="flexRadioDefault3.4">
							Sains
						</label> <br>
						<input class="form-check-input" type="radio" value="Kesehatan" name="kebutuhanpemustaka_koleksiBidang" id="flexRadioDefault3.5">
						<label class="form-check-label" for="flexRadioDefault3.5">
							Kesehatan
						</label> <br>
						<input class="form-check-input" type="radio" value="Fiksi" name="kebutuhanpemustaka_koleksiBidang" id="flexRadioDefault3.6">
						<label class="form-check-label" for="flexRadioDefault3.6">
							Fiksi
						</label> <br>
					</div><br>

					<label>Untuk keperluan apa anda mengunjungi Perpustakaan Pemda Karawang ?</label>
					<?= form_error('kebutuhanpemustaka_keperluan', '<small class="text-danger" ><b>', '</b></small>') ?>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="Tugas Kuliah" name="kebutuhanpemustaka_keperluan" id="flexRadioDefault4.1">
						<label class="form-check-label" for="flexRadioDefault4.1">
							Tugas Kuliah
						</label> <br>
						<input class="form-check-input" type="radio" value="Mencari referensi" name="kebutuhanpemustaka_keperluan" id="flexRadioDefault4.2">
						<label class="form-check-label" for="flexRadioDefault4.2">
							Mencari referensi
						</label> <br>
						<input class="form-check-input" type="radio" value="Mengerjakan tugas akhir/skripis/tesis" name="kebutuhanpemustaka_keperluan" id="flexRadioDefault4.3">
						<label class="form-check-label" for="flexRadioDefault4.3">
							Mengerjakan tugas akhir/skripis/tesis
						</label> <br>
						<input class="form-check-input" type="radio" value="Refreshing" name="kebutuhanpemustaka_keperluan" id="flexRadioDefault4.4">
						<label class="form-check-label" for="flexRadioDefault4.4">
							Refreshing
						</label> <br>
					</div><br>

					<label>Apakah Perpustakaan Pemda Karawang menyediakan koleksi yang up to date (terbaru) ?</label>
					<?= form_error('kebutuhanpemustaka_koleksiTerbaru', '<small class="text-danger" ><b>', '</b></small>') ?>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="Kurang" name="kebutuhanpemustaka_koleksiTerbaru" id="flexRadioDefault5.1">
						<label class="form-check-label" for="flexRadioDefault5.1">
							Kurang
						</label> <br>
						<input class="form-check-input" type="radio" value="Cukup" name="kebutuhanpemustaka_koleksiTerbaru" id="flexRadioDefault5.2">
						<label class="form-check-label" for="flexRadioDefault5.2">
							Cukup
						</label> <br>
						<input class="form-check-input" type="radio" value="Baik" name="kebutuhanpemustaka_koleksiTerbaru" id="flexRadioDefault5.3">
						<label class="form-check-label" for="flexRadioDefault5.3">
							Baik
						</label> <br>
						<input class="form-check-input" type="radio" value="Sangat baik" name="kebutuhanpemustaka_koleksiTerbaru" id="flexRadioDefault5.4">
						<label class="form-check-label" for="flexRadioDefault5.4">
							Sangat baik
						</label> <br>
					</div><br>

					<label>Apakah koleksi Perpustakaan Pemda Karawang sesuai dengan kebutuhan informasi anda ?</label>
					<?= form_error('kebutuhanpemustaka_koleksiKebutuhan', '<small class="text-danger" ><b>', '</b></small>') ?>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="Kurang" name="kebutuhanpemustaka_koleksiKebutuhan" id="flexRadioDefault6.1">
						<label class="form-check-label" for="flexRadioDefault6.1">
							Kurang
						</label> <br>
						<input class="form-check-input" type="radio" value="Cukup" name="kebutuhanpemustaka_koleksiKebutuhan" id="flexRadioDefault6.2">
						<label class="form-check-label" for="flexRadioDefault6.2">
							Cukup
						</label> <br>
						<input class="form-check-input" type="radio" value="Baik" name="kebutuhanpemustaka_koleksiKebutuhan" id="flexRadioDefault6.3">
						<label class="form-check-label" for="flexRadioDefault6.3">
							Baik
						</label> <br>
						<input class="form-check-input" type="radio" value="Sangat baik" name="kebutuhanpemustaka_koleksiKebutuhan" id="flexRadioDefault6.4">
						<label class="form-check-label" for="flexRadioDefault6.4">
							Sangat baik
						</label> <br>
					</div><br>

					<label>Apakah jumlah ketersediaan koleksi Perpustakaan Pemda Karawang saat ini mencukupi kebutuhan informasi anda ?</label>
					<?= form_error('kebutuhanpemustaka_ketersediaanKoleksi', '<small class="text-danger" ><b>', '</b></small>') ?>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="Kurang" name="kebutuhanpemustaka_ketersediaanKoleksi" id="flexRadioDefault7.1">
						<label class="form-check-label" for="flexRadioDefault7.1">
							Kurang
						</label> <br>
						<input class="form-check-input" type="radio" value="Cukup" name="kebutuhanpemustaka_ketersediaanKoleksi" id="flexRadioDefault7.2">
						<label class="form-check-label" for="flexRadioDefault7.2">
							Cukup
						</label> <br>
						<input class="form-check-input" type="radio" value="Baik" name="kebutuhanpemustaka_ketersediaanKoleksi" id="flexRadioDefault7.3">
						<label class="form-check-label" for="flexRadioDefault7.3">
							Baik
						</label> <br>
						<input class="form-check-input" type="radio" value="Sangat baik" name="kebutuhanpemustaka_ketersediaanKoleksi" id="flexRadioDefault7.4">
						<label class="form-check-label" for="flexRadioDefaul75.4">
							Sangat baik
						</label> <br>
					</div><br>

					<h5>Usulan koleksi buku untuk perpustakaan</h5>
					<div class="row">
						<div class="col-md-4">
							<label>Judul :</label>
							<div class="form-group">
								<input type="text" name="kebutuhanpemustaka_judul" placeholder="Masukkan judul buku" class="form-control text-center">
								<?= form_error('kebutuhanpemustaka_judul', '<small class="text-danger" ><b>', '</b></small>') ?>
							</div>
						</div>
						<div class="col-md-4">
							<label>Pengarang :</label>
							<div class="form-group">
								<input type="text" name="kebutuhanpemustaka_pengarang" placeholder="Masukkan pengarang buku" class="form-control text-center">
								<?= form_error('kebutuhanpemustaka_pengarang', '<small class="text-danger" ><b>', '</b></small>') ?>
							</div>
						</div>
						<div class="col-md-4">
							<label>Penerbit :</label>
							<div class="form-group">
								<input type="text" name="kebutuhanpemustaka_penerbit" placeholder="Masukkan penerbit buku" class="form-control text-center">
								<?= form_error('kebutuhanpemustaka_penerbit', '<small class="text-danger" ><b>', '</b></small>') ?>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-success btn-user btn-block " style="display: inline;"><i class="fas fa-plus fa-sm fa-fw mr-2"></i>Submit</button>
				</div>
			</div>
		</div>
		<?= form_close(); ?>
	</div>
</div>
