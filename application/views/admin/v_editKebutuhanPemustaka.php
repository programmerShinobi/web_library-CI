<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4>Edit <?=$title;?></h4>
	<div class="card mb-4">
		<div class="card-body">
			<?= form_open_multipart("validation_kebutuhanpemustaka_edit"); ?>
			<div class="row">
				<div class="col-md">
					<input type="hidden" name="kebutuhanpemustaka_id" value="<?= $kebutuhanpemustaka->kebutuhanpemustaka_id; ?>">
					<label>Berapa kali dalam seminggu anda mengunjungi Perpustakaan Pemda Karawang ?</label>
					<div class="form-group">
						<select name="kebutuhanpemustaka_kunjungan" class="form-control" required>
							<option disabled selected>-- Pilih --</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_kunjungan == "Satu kali seminggu") {
										echo "selected";
									} ?> value="Satu kali seminggu">Satu kali seminggu</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_kunjungan == "Dua kali seminggu") {
										echo "selected";
									} ?> value="Dua kali seminggu">Dua kali seminggu</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_kunjungan == "Tiga kali seminggu") {
										echo "selected";
									} ?> value="Tiga kali seminggu">Tiga kali seminggu</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_kunjungan == "Empat kali atau lebih seminggu") {
										echo "selected";
									} ?> value="Empat kali atau lebih seminggu">Empat kali atau lebih seminggu</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_kunjungan == "Hampir tidak pernah") {
										echo "selected";
									} ?> value="Hampir tidak pernah">Hampir tidak pernah</option>
						</select>
					</div>
					<label>Jenis koleksi yang sering anda butuhkan ketika berkunjung ke Perpustakaan Pemda Karawang ?</label>
					<div class="form-group">
						<select name="kebutuhanpemustaka_jenisKoleksi" class="form-control" required>
							<option disabled selected>-- Pilih --</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_jenisKoleksi == "Buku teks") {
										echo "selected";
									} ?> value="Buku teks">Buku teks</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_jenisKoleksi == "Majalah dan Surat kabar") {
										echo "selected";
									} ?> value="Majalah dan Surat kabar">Majalah dan Surat kabar</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_jenisKoleksi == "Junal") {
										echo "selected";
									} ?> value="Junal">Junal</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_jenisKoleksi == "Local content (tugas akhir/skripsi/tesis)") {
										echo "selected";
									} ?> value="Local content (tugas akhir/skripsi/tesis)">Local content (tugas akhir/skripsi/tesis)</option>
						</select>
					</div>
					<label>Koleksi bidang apa saja yang sering anda cari ?</label>
					<div class="form-group">
						<select name="kebutuhanpemustaka_koleksiBidang" class="form-control" required>
							<option disabled selected>-- Pilih --</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiBidang == "Pendidikan") {
										echo "selected";
									} ?> value="Pendidikan">Pendidikan</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiBidang == "Agama") {
										echo "selected";
									} ?> value="Agama">Agama</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiBidang == "Sosial/ekonomi") {
										echo "selected";
									} ?> value="Sosial/ekonomi">Sosial/ekonomi</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiBidang == "Sains") {
										echo "selected";
									} ?> value="Sains">Sains</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiBidang == "Kesehatan") {
										echo "selected";
									} ?> value="Kesehatan">Kesehatan</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiBidang == "Fiksi") {
										echo "selected";
									} ?> value="Fiksi">Fiksi</option>
						</select>
					</div>
					<label>Untuk keperluan apa anda mengunjungi Perpustakaan Pemda Karawang ?</label>
					<div class="form-group">
						<select name="kebutuhanpemustaka_keperluan" class="form-control" required>
							<option disabled selected>-- Pilih --</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_keperluan == "Tugas Kuliah") {
										echo "selected";
									} ?> value="Tugas Kuliah">Tugas Kuliah</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_keperluan == "Mencari referensi") {
										echo "selected";
									} ?> value="Mencari referensi">Mencari referensi</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_keperluan == "Mengerjakan tugas akhir/skripis/tesis") {
										echo "selected";
									} ?> value="Mengerjakan tugas akhir/skripis/tesis">Mengerjakan tugas akhir/skripis/tesis</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_keperluan == "Refreshing") {
										echo "selected";
									} ?> value="Refreshing">Refreshing</option>
						</select>
					</div>
					<label>Apakah Perpustakaan Pemda Karawang menyediakan koleksi yang up to date (terbaru) ?</label>
					<div class="form-group">
						<select name="kebutuhanpemustaka_koleksiTerbaru" class="form-control" required>
							<option disabled selected>-- Pilih --</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiTerbaru == "Kurang") {
										echo "selected";
									} ?> value="Kurang">Kurang</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiTerbaru == "Cukup") {
										echo "selected";
									} ?> value="Cukup">Cukup</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiTerbaru == "Baik") {
										echo "selected";
									} ?> value="Baik">Baik</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiTerbaru == "Sangat Baik") {
										echo "selected";
									} ?> value="Sangat Baik">Sangat Baik</option>
						</select>
					</div>
					<label>Apakah koleksi Perpustakaan Pemda Karawang sesuai dengan kebutuhan informasi anda ?</label>
					<div class="form-group">
						<select name="kebutuhanpemustaka_koleksiKebutuhan" class="form-control" required>
							<option disabled selected>-- Pilih --</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiKebutuhan == "Kurang") {
										echo "selected";
									} ?> value="Kurang">Kurang</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiKebutuhan == "Cukup") {
										echo "selected";
									} ?> value="Cukup">Cukup</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiKebutuhan == "Baik") {
										echo "selected";
									} ?> value="Baik">Baik</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_koleksiKebutuhan == "Sangat Baik") {
										echo "selected";
									} ?> value="Sangat Baik">Sangat Baik</option>
						</select>
					</div>
					<label>Apakah jumlah ketersediaan koleksi Perpustakaan Pemda Karawang saat ini mencukupi kebutuhan informasi anda ?</label>
					<div class="form-group">
						<select name="kebutuhanpemustaka_ketersediaanKoleksi" class="form-control" required>
							<option disabled selected>-- Pilih --</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_ketersediaanKoleksi == "Kurang") {
										echo "selected";
									} ?> value="Kurang">Kurang</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_ketersediaanKoleksi == "Cukup") {
										echo "selected";
									} ?> value="Cukup">Cukup</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_ketersediaanKoleksi == "Baik") {
										echo "selected";
									} ?> value="Baik">Baik</option>
							<option <?php if ($kebutuhanpemustaka->kebutuhanpemustaka_ketersediaanKoleksi == "Sangat Baik") {
										echo "selected";
									} ?> value="Sangat Baik">Sangat Baik</option>
						</select>
					</div><br>
					<h5>Usulan koleksi buku untuk perpustakaan</h5>
					<label> Judul :</label>
					<div class="form-group">
						<input type="text" name="kebutuhanpemustaka_judul" class="form-control" value="<?= $kebutuhanpemustaka->kebutuhanpemustaka_judul; ?>" disabled>
					</div>
					<label>Pengarang :</label>
					<div class="form-group">
						<input type="text" name="kebutuhanpemustaka_pengarang" class="form-control" value="<?= $kebutuhanpemustaka->kebutuhanpemustaka_pengarang; ?>" disabled>
					</div>
					<label>Penerbit :</label>
					<div class="form-group">
						<input type="text" name="kebutuhanpemustaka_penerbit" class="form-control" value="<?= $kebutuhanpemustaka->kebutuhanpemustaka_penerbit; ?>" disabled>
					</div>
				</div>
			</div>
			<a href="<?= base_url("kebutuhanpemustaka") ?>" class="btn btn-info btn-sm mb"><i class="fas fa-chevron-left"></i> Kembali</a>
			<button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-sync"></i> Reset</button>
			<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
			<?= form_close(); ?>
		</div>
	</div>
</div>
