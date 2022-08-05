<?= $this->session->flashdata('pesan'); ?>
<script src="<?= base_url("assets/vendor/ckeditor/ckeditor.js") ?>"></script>
<div class="container-fluid">
	<h4><?= $title; ?></h4>
	<div class="card">
		<div class="card-header">
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item border border-primary rounded m-1">
					<a class="nav-link active" data-toggle="pill" href="#SemuaAnggota"><i class="fas fa-fw fa-user-tag"></i> Semua Anggota</a>
				</li>
				<li class="nav-item border border-primary rounded m-1">
					<a class="nav-link" data-toggle="pill" href="#AnggotaAktif"><i class="fas fa-check"></i> Anggota Aktif</a>
				</li>
				<li class="nav-item border border-primary rounded m-1">
					<a class="nav-link" data-toggle="pill" href="#AnggotaNonaktif"><i class="fas fa-times"></i> Anggota Nonaktif</a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="tab-content">
				<div id="SemuaAnggota" class="tab-pane active">
					<b><?= "Semua Anggota" ?></b>
					<hr>
					<a href="" data-toggle="modal" data-target="#add" class="btn btn-success btn-sm mb-3"><i class="fa fa-plus"></i> Tambah Anggota</a>
					<a href="<?= base_url("export_anggota") ?>" target="_blank" class="btn btn-dark btn-sm mb-3"><i class="fa fa-file-export"></i> Export to excel</a>
					<a href="" data-toggle="modal" data-target="#import" class="btn btn-dark btn-sm mb-3"><i class="fa fa-file-import"></i> Import Excel</a>

					<div class="table-responsive">
						<table class="table table-bordered table-hover w-100 display" cellspacing="0" width="100%" id="dataVisibility">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama</th>
									<th>Klasifikasi</th>
									<th>Nomor HP</th>
									<th>Email</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($list_anggota as $item) { ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $item->user_nama; ?></td>
										<td>
											<?php
											if ($item->user_klasifikasi == 1) {
												echo "TK";
											} elseif ($item->user_klasifikasi == 2) {
												echo "SD";
											} elseif ($item->user_klasifikasi == 3) {
												echo "SMP";
											} elseif ($item->user_klasifikasi == 4) {
												echo "SMA";
											} elseif ($item->user_klasifikasi == 5) {
												echo "Mahasiswa";
											} elseif ($item->user_klasifikasi == 6) {
												echo "PNS";
											} elseif ($item->user_klasifikasi == 7) {
												echo "Karyawan";
											} elseif ($item->user_klasifikasi == 8) {
												echo "Umum";
											} else {
												echo "-";
											}
											?>
										</td>
										<td><?= $item->user_noHP; ?></td>
										<td><?= $item->user_email; ?></td>
										<td>
											<center>
												<?php if ($item->user_backlist == 0) {
												?>

													<a href="<?= base_url('process_anggota_check/' . $item->user_id); ?>" class="btn btn-success btn-sm" onclick="return confirm('Yakin menonaktifkan data?')">
														<i class='fa fa-check'></i>
													</a>

												<?php
												} else {
												?>

													<a href="<?= base_url('process_anggota_check/' . $item->user_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mengaktifkan data?')">
														<i class="fas fa-times"></i>
													</a>

												<?php
												}
												?>
											</center>
										</td>
										<td>
											<?php if ($item->user_backlist == 0) { ?>
												<div class="form-group card ">
													<a href="<?= base_url('cardUser/' . $item->user_id); ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-id-card"></i> Kartu Digital</a>
												</div>
												<div class="form-group card ">
													<a href="<?= base_url('user_edit/' . $item->user_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
												</div>
												<?php if ($user->user_role == 1) { ?>
													<div class="form-group card ">
														<a href="<?= base_url('user_delete/' . $item->user_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
													</div>
												<?php }
											} else { ?>
												<div class="form-group card ">
													<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> </a>
												</div>
											<?php } ?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="AnggotaAktif" class="tab-pane fade">
					<b><?= "Anggota Aktif" ?></b>
					<hr>
					<a href="" data-toggle="modal" data-target="#add" class="btn btn-success btn-sm mb-3"><i class="fa fa-plus"></i> Tambah Anggota</a>
					<div class="table-responsive">
						<table class="table table-bordered table-hover w-100 display" cellspacing="0" width="100%" id="dataVisibility1">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama</th>
									<th>Klasifikasi</th>
									<th>Nomor HP</th>
									<th>Email</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($anggota_aktif as $item1) { ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $item1->user_nama; ?></td>
										<td>
											<?php
											if ($item1->user_klasifikasi == 1) {
												echo "TK";
											} elseif ($item1->user_klasifikasi == 2) {
												echo "SD";
											} elseif ($item1->user_klasifikasi == 3) {
												echo "SMP";
											} elseif ($item1->user_klasifikasi == 4) {
												echo "SMA";
											} elseif ($item1->user_klasifikasi == 5) {
												echo "Mahasiswa";
											} elseif ($item1->user_klasifikasi == 6) {
												echo "PNS";
											} elseif ($item1->user_klasifikasi == 7) {
												echo "Karyawan";
											} elseif ($item1->user_klasifikasi == 8) {
												echo "Umum";
											} else {
												echo "-";
											}
											?>
										</td>
										<td><?= $item1->user_noHP; ?></td>
										<td><?= $item1->user_email; ?></td>
										<td>
											<center>
												<a href="<?= base_url('process_anggota_check/' . $item1->user_id); ?>" class="btn btn-success btn-sm" onclick="return confirm('Yakin menonaktifkan data?')">
													<i class='fa fa-check'></i>
												</a>
											</center>
										</td>
										<td>
											<div class="form-group card ">
												<a href="<?= base_url('cardUser/' . $item->user_id); ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-id-card"></i> Kartu Digital</a>
											</div>
											<div class="form-group card ">
												<a href="<?= base_url('cetakUser/' . $item->user_id); ?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Cetak Kartu</a>
											</div>
											<div class="form-group card ">
												<a href="<?= base_url('user_edit/' . $item->user_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
											</div>
											<?php if ($user->user_role == 1) { ?>
												<div class="form-group card ">
													<a href="<?= base_url('user_delete/' . $item->user_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
												</div>
											<?php } ?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="AnggotaNonaktif" class="tab-pane fade">
					<b><?= "Anggota Non Aktif" ?></b>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-hover w-100 display" cellspacing="0" width="100%" id="dataVisibility2">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama</th>
									<th>Klasifikasi</th>
									<th>Nomor HP</th>
									<th>Email</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($anggota_nonaktif as $item2) { ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $item2->user_nama; ?></td>
										<td>
											<?php
											if ($item2->user_klasifikasi == 1) {
												echo "TK";
											} elseif ($item2->user_klasifikasi == 2) {
												echo "SD";
											} elseif ($item2->user_klasifikasi == 3) {
												echo "SMP";
											} elseif ($item2->user_klasifikasi == 4) {
												echo "SMA";
											} elseif ($item2->user_klasifikasi == 5) {
												echo "Mahasiswa";
											} elseif ($item2->user_klasifikasi == 6) {
												echo "PNS";
											} elseif ($item2->user_klasifikasi == 7) {
												echo "Karyawan";
											} elseif ($item2->user_klasifikasi == 8) {
												echo "Umum";
											} else {
												echo "-";
											}
											?>
										</td>
										<td><?= $item2->user_noHP; ?></td>
										<td><?= $item2->user_email; ?></td>
										<td>
											<center>
												<a href="<?= base_url('process_anggota_check/' . $item2->user_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mengaktifkan data?')">
													<i class="fas fa-times"></i>
												</a>
											</center>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="import">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Import Data Anggota</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open_multipart("import_anggota") ?>
				<div class="form-group">
					<label>Masukkan File Excel</label>
					<input type="file" name="import_anggota" class="form-control">
				</div>
				<input type="submit" value="Import" class="btn btn-success btn-sm">
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>

<?php
$kode = $total_anggota + 1;
//Support KodeTambah
if ($total_anggota <= 9) {
	$kodeTambah = "000";
} else if ($total_anggota <= 99) {
	$kodeTambah = "00";
} else if ($total_anggota <= 1000) {
	$kodeTambah = "0";
} else if ($total_anggota <= 10000) {
	$kodeTambah = "";
}
?>

<div class="modal fade" id="add">
	<div class="modal-dialog modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Tambah Anggota</h5>
				<button type="button" data-dismiss="modal" class="close">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open('validation_user_add'); ?>
				<div class="row">
					<div class="col-md-6">
						<h5>Data Pribadi</h5>
						<div class="form-group">
							<label>Kode Anggota</label>
							<!-- <input type="text" class="form-control" value="<?php echo $kodeTambah . $kode; ?>" disabled>  -->
							<input type="text" name="user_noId" class="form-control" value="<?php echo $kodeTambah . $kode; ?>">
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="user_nama" class="form-control" required autofocus>
						</div>
						<div class="form-group">
							<label>Tempat Lahir</label>
							<input type="text" name="user_tempatLahir" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Tanggal Lahir</label>
							<input type="date" name="user_tanggalLahir" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Klasifikasi</label>
							<select class="form-control" id="user_klasifikasi" name="user_klasifikasi">
								<option disabled selected>-- Pilih Klasifikasi --</option>
								<?php foreach ($pekerjaan as $item) { ?>
									<option value="<?php echo $item->pekerjaan_id; ?>"><?php echo $item->pekerjaan; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label>Nomor Induk KTP / Kartu Pelajar</label>
							<input type="text" name="user_ktp" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="user_username" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="user_password" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nomor HP</label>
							<input type="number" name="user_noHP" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="user_email" class="form-control" required>
						</div>
					</div>
					<div class="col-md-6">
						<h5>Data Orang Tua</h5>
						<div class="form-group">
							<label>Nama Orang Tua</label>
							<input type="text" name="orangtua_nama" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nomor HP Orang Tua</label>
							<input type="number" name="orangtua_noHP" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Tempat Lahir Orang Tua</label>
							<input type="text" name="orangtua_tempatLahir" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Tanggal Lahir Orang Tua</label>
							<input type="date" name="orangtua_tanggalLahir" class="form-control" required>
						</div>
						<h5>Pertanyaan Keamanan</h5>
						<div class="form-group">
							<select name="pertanyaan" class="form-control" required>
								<option disabled selected>-- Pilih Pertanyaan --</option>
								<option value="Siapa nama peliharaan anda?">Siapa nama peliharaan anda?</option>
								<option value="Siapa nama kakek anda?">Siapa nama kakek anda?</option>
								<option value="Siapa nama saudara anda?">Siapa nama saudara anda?</option>
								<option value="Nama sekolah SD anda adalah?">Nama sekolah SD anda adalah?</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="jawaban" class="form-control" required>
						</div>
					</div>
				</div>
				<input type="submit" value="Simpan" class="btn btn-success btn-sm">
				<?= form_close(); ?>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
			</div>
		</div>
	</div>
</div>
