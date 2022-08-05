<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4><?= $title; ?></h4>
	<div class="card">
		<div class="card-body">
			<a href="" class="btn btn-success btn-sm mb-4" data-toggle="modal" data-target="#addKebutuhabPemustaka"><i class="fa fa-plus"></i> Tambah <?= $title; ?></a>
			<a href="<?= base_url("export_kebutuhanpemustaka") ?>" target="_blank" class="btn btn-dark btn-sm mb-4"><i class="fa fa-file-export"></i> Export to excel</a>
			<a href="" data-toggle="modal" data-target="#import" class="btn btn-dark btn-sm mb-4"><i class="fa fa-file-import"></i> Import Excel</a>
			<table class="table table-bordered table-hover " id="dataPengadaan">
				<thead>
					<tr>
						<th>#</th>
						<th>Kunjungan</th>
						<th>Jenis Koleksi</th>
						<th>Koleksi Bidang</th>
						<th>Keperluan</th>
						<th>Koleksi Terbaru</th>
						<th>Koleksi Kebutuhan</th>
						<th>Ketersediaan Koleksi</th>
						<th>Usulan Judul</th>
						<th>Usulan Pengarang</th>
						<th>Usulan Penerbit</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($list_kebutuhanpemustaka as $item) { ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $item->kebutuhanpemustaka_kunjungan; ?></td>
							<td><?= $item->kebutuhanpemustaka_jenisKoleksi; ?></td>
							<td><?= $item->kebutuhanpemustaka_koleksiBidang; ?></td>
							<td><?= $item->kebutuhanpemustaka_keperluan; ?></td>
							<td><?= $item->kebutuhanpemustaka_koleksiTerbaru; ?></td>
							<td><?= $item->kebutuhanpemustaka_koleksiKebutuhan; ?></td>
							<td><?= $item->kebutuhanpemustaka_ketersediaanKoleksi; ?></td>
							<td><?= $item->kebutuhanpemustaka_judul ?></td>
							<td><?= $item->kebutuhanpemustaka_pengarang; ?></td>
							<td><?= $item->kebutuhanpemustaka_penerbit; ?></td>
							<td>
								<div class="form-group card ">
									<a href="<?= base_url("kebutuhanpemustaka_edit/" . $item->kebutuhanpemustaka_id) ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
								</div>
								<div class="form-group card ">
									<a href="<?= base_url("process_kebutuhanpemustaka_hapus/" . $item->kebutuhanpemustaka_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="modal fade" id="import">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Import Pengadaan Buku</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open_multipart("import_kebutuhanpemustaka") ?>
				<div class="form-group">
					<label>Masukkan File Excel</label>
					<input type="file" name="import_kebutuhanpemustaka" class="form-control">
				</div>
				<input type="submit" value="Import" class="btn btn-success btn-sm">
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="addKebutuhabPemustaka">
	<div class="modal-dialog modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Tambah <?= $title; ?></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open("validation_kebutuhanpemustaka_add"); ?>
				<div class="row">
					<div class="col-md">
						<label>Berapa kali dalam seminggu anda mengunjungi Perpustakaan Pemda Karawang ?</label>
						<div class="form-group">
							<select name="kebutuhanpemustaka_kunjungan" class="form-control" required>
								<option disabled selected>-- Pilih --</option>
								<option value="Satu kali seminggu">Satu kali seminggu</option>
								<option value="Dua kali seminggu">Dua kali seminggu</option>
								<option value="Tiga kali seminggu">Tiga kali seminggu</option>
								<option value="Empat kali atau lebih seminggu">Empat kali atau lebih seminggu</option>
								<option value="Hampir tidak pernah">Hampir tidak pernah</option>
							</select>
						</div>
						<label>Jenis koleksi yang sering anda butuhkan ketika berkunjung ke Perpustakaan Pemda Karawang ?</label>
						<div class="form-group">
							<select name="kebutuhanpemustaka_jenisKoleksi" class="form-control" required>
								<option disabled selected>-- Pilih --</option>
								<option value="Buku teks">Buku teks</option>
								<option value="Majalah dan Surat kabar">Majalah dan Surat kabar</option>
								<option value="Junal">Junal</option>
								<option value="Local content (tugas akhir/skripsi/tesis)">Local content (tugas akhir/skripsi/tesis)</option>
							</select>
						</div>
						<label>Koleksi bidang apa saja yang sering anda cari ?</label>
						<div class="form-group">
							<select name="kebutuhanpemustaka_koleksiBidang" class="form-control" required>
								<option disabled selected>-- Pilih --</option>
								<option value="Pendidikan">Pendidikan</option>
								<option value="Agama">Agama</option>
								<option value="Sosial/ekonomi">Sosial/ekonomi</option>
								<option value="Sains">Sains</option>
								<option value="Kesehatan">Kesehatan</option>
								<option value="Fiksi">Fiksi</option>
							</select>
						</div>
						<label>Untuk keperluan apa anda mengunjungi Perpustakaan Pemda Karawang ?</label>
						<div class="form-group">
							<select name="kebutuhanpemustaka_keperluan" class="form-control" required>
								<option disabled selected>-- Pilih --</option>
								<option value="Tugas Kuliah">Tugas Kuliah</option>
								<option value="Mencari referensi">Mencari referensi</option>
								<option value="Mengerjakan tugas akhir/skripis/tesis">Mengerjakan tugas akhir/skripis/tesis</option>
								<option value="Refreshing">Refreshing</option>
							</select>
						</div>
						<label>Apakah Perpustakaan Pemda Karawang menyediakan koleksi yang up to date (terbaru) ?</label>
						<div class="form-group">
							<select name="kebutuhanpemustaka_koleksiTerbaru" class="form-control" required>
								<option disabled selected>-- Pilih --</option>
								<option value="Kurang">Kurang</option>
								<option value="Cukup">Cukup</option>
								<option value="Baik">Baik</option>
								<option value="Sangat Baik">Sangat Baik</option>
							</select>
						</div>
						<label>Apakah koleksi Perpustakaan Pemda Karawang sesuai dengan kebutuhan informasi anda ?</label>
						<div class="form-group">
							<select name="kebutuhanpemustaka_koleksiKebutuhan" class="form-control" required>
								<option disabled selected>-- Pilih --</option>
								<option value="Kurang">Kurang</option>
								<option value="Cukup">Cukup</option>
								<option value="Baik">Baik</option>
								<option value="Sangat Baik">Sangat Baik</option>
							</select>
						</div>
						<label>Apakah jumlah ketersediaan koleksi Perpustakaan Pemda Karawang saat ini mencukupi kebutuhan informasi anda ?</label>
						<div class="form-group">
							<select name="kebutuhanpemustaka_ketersediaanKoleksi" class="form-control" required>
								<option disabled selected>-- Pilih --</option>
								<option value="Kurang">Kurang</option>
								<option value="Cukup">Cukup</option>
								<option value="Baik">Baik</option>
								<option value="Sangat Baik">Sangat Baik</option>
							</select>
						</div><br>
						<h5>Usulan koleksi buku untuk perpustakaan</h5>
						<label>Judul :</label>
						<div class="form-group">
							<input type="text" name="kebutuhanpemustaka_judul" class="form-control" required>
						</div>
						<label>Pengarang :</label>
						<div class="form-group">
							<input type="text" name="kebutuhanpemustaka_pengarang" class="form-control" required>
						</div>
						<label>Penerbit :</label>
						<div class="form-group">
							<input type="text" name="kebutuhanpemustaka_penerbit" class="form-control" required>
						</div>
					</div>
				</div>
				<input type="submit" value="Tambah" class="btn btn-primary btn-sm">
				<?= form_close(); ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
