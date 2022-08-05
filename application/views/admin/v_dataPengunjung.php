<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item border border-primary rounded m-1">
					<a class="nav-link active" data-toggle="pill" href="#perpustakaanData"><i class="fas fa-fw fa-users"></i> Data Pengunjung Perpustakaan</a>
				</li>
				<li class="nav-item border border-primary rounded m-1">
					<a class="nav-link" data-toggle="pill" href="#websiteData"><i class="fas fa-globe"></i> Data Pengunjung Website</a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<?= form_open('dataPengunjung'); ?>
			<div class="row">
				<div class="col">
					<label>Period Start</label>
					<input type="date" class="form-control" name="start_order_date" id="inputStartDate">
				</div>
				<div class="col">
					<label>Period End</label>
					<input type="date" class="form-control" name="end_order_date" id="inputEndDate">
				</div>
			</div>
			<input type="submit" class="btn btn-primary btn-sm my-3" value="Filter">
			<?= form_close(); ?>
			<hr>
			<div class="tab-content">
				<div id="perpustakaanData" class="tab-pane active">
					<b>Data Pengunjung Perpustakaan</b>
					<hr>
					<a href="" data-toggle="modal" data-target="#add" class="btn btn-success btn-sm mb-3"><i class="fa fa-plus"></i> Tambah Pengunjung</a>
					<a href="<?= base_url("export_pengunjung") ?>" target="_blank" class="btn btn-dark btn-sm mb-3"><i class="fa fa-file-export"></i> Export to excel</a>
					<a href="" data-toggle="modal" data-target="#import" class="btn btn-dark btn-sm mb-3"><i class="fa fa-file-import"></i> Import Excel</a>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataVisibility1">
							<thead>
								<tr>
									<th>#</th>
									<th>Tanggal</th>
									<th>Nama</th>
									<th>JK</th>
									<th>Klasifikasi</th>
									<th>Info</th>
									<th>Masuk</th>
									<th>Alamat</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($list_pengunjung_perpus as $item) : ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= date('d M Y', strtotime($item->pengunjung_tanggal)); ?></td>
										<td><?= $item->pengunjung_nama; ?></td>
										<td><?= $item->pengunjung_jk; ?></td>
										<td>
											<?php
											if ($item->pengunjung_klasifikasi == 1) {
												echo "TK";
											} elseif ($item->pengunjung_klasifikasi == 2) {
												echo "SD";
											} elseif ($item->pengunjung_klasifikasi == 3) {
												echo "SMP";
											} elseif ($item->pengunjung_klasifikasi == 4) {
												echo "SMA";
											} elseif ($item->pengunjung_klasifikasi == 5) {
												echo "Mahasiswa";
											} elseif ($item->pengunjung_klasifikasi == 6) {
												echo "PNS";
											} elseif ($item->pengunjung_klasifikasi == 7) {
												echo "Karyawan";
											} elseif ($item->pengunjung_klasifikasi == 8) {
												echo "Umum";
											} else {
												echo "-";
											}
											?>
										</td>
										<td><?= $item->pengunjung_info; ?></td>
										<td><?= date('H:i:s', strtotime($item->pengunjung_masuk)); ?></td>
										<!-- <td><?= date('H:i:s', strtotime($item->pengunjung_keluar)); ?></td> -->
										<td><?= $item->pengunjung_alamat; ?></td>
										<td>
											<div class="form-group card ">
												<a href="<?= base_url('pengunjung_edit/' . $item->pengunjung_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
											</div>
											<div class="form-group card ">
												<a href="<?= base_url('pengunjung_delete/' . $item->pengunjung_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="websiteData" class="tab-pane fade">
					<b>Data Pengunjung Website</b>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataVisibility2">
							<thead>
								<tr>
									<th>#</th>
									<th>Tanggal</th>
									<th>Browser</th>
									<th>Alamat IP</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($list_pengunjung_website as $item2) : ?>
									<tr>
										<td><?= $no++; ?></td>
										<td width="13%"><?= date('d M Y', strtotime($item2->waktu)); ?></td>
										<td><?= $item2->browser; ?></td>
										<td><?= $item2->alamat_ip; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<hr>
						<center class="card badge-warning text-dark"><b>"Dalam jangka waktu 1 tahun data akan otomatis terhapus !" </b></center>
					</div>
					<hr>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="import">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Import Data Pengunjung</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open_multipart("import_pengunjung") ?>
				<div class="form-group">
					<label>Masukkan File Excel</label>
					<input type="file" name="import_pengunjung" class="form-control">
				</div>
				<input type="submit" value="Import" class="btn btn-success btn-sm">
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="add">
	<div class="modal-dialog modal-dialog-scrollable ">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Tambah Pengunjung</h5>
				<button type="button" data-dismiss="modal" class="close">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open('validation_pengunjung_add'); ?>
				<div class="row">
					<div class="col-md">
						<h5>Data Pengunjung</h5>
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="pengunjung_nama" placeholder="masukkan nama lengkap" class="form-control" required autofocus>
						</div>
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select class="form-control" id="pengunjung_jk" name="pengunjung_jk">
								<option disabled selected>-- Pilih Jenis Kelamin --</option>
								<option value="L">Laki - laki</option>
								<option value="P">Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label>Klasifikasi</label>
							<select class="form-control" id="pengunjung_klasifikasi" name="pengunjung_klasifikasi">
								<option disabled selected>-- Pilih Klasifikasi --</option>
								<?php foreach ($pekerjaan as $item) { ?>
									<option value="<?php echo $item->pekerjaan_id; ?>"><?php echo $item->pekerjaan; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label>Informasi Yang Dicari </label>
							<select class="form-control" id="pengunjung_info" name="pengunjung_info">
								<option disabled selected>-- Pilih --</option>
								<option value="Baca">Baca</option>
								<option value="Pinjam">Pinjam</option>
								<option value="Kembali">Kembali</option>
							</select>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" name="pengunjung_alamat" placeholder="masukkan alamat lengkap" id="pengunjung_alamat" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Tanggal Kunjungan</label>
							<input type="date" name="pengunjung_tanggal" id="pengunjung_tanggal" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Waktu Masuk</label>
							<input type="time" name="pengunjung_masuk" id="pengunjung_masuk" class="form-control" required>
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
