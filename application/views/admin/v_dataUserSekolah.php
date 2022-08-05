<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4>Data Petugas Sekolah</h4>
	<div class="card">
		<div class="card-body">
			<?php if ($user->user_role == 4) { ?>
			<?php } else { ?>
				<a href="" data-toggle="modal" data-target="#add" class="btn btn-success btn-sm mb-3"><i class="fa fa-plus"></i> Tambah Petugas</a>
			<?php } ?>
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataVisibility">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Sekolah</th>
							<th>Nomor HP</th>
							<th>Email</th>
							<?php if ($user->user_role == 4) { ?>
							<?php } else { ?>
								<th>Aksi</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($list_petugas_perpusSekolah as $item) { ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $item->user_nama; ?></td>
								<td><?= $item->sekolah_nama; ?></td>
								<td><?= $item->user_noHP; ?></td>
								<td><?= $item->user_email; ?></td>
								<?php if ($user->user_role == 4) { ?>
								<?php } else { ?>
									<td>
										<?php
										if ($user->user_role == 1) {  ?>
											<div class="form-group card ">
												<a href="<?= base_url('cetakUserSekolah/' . $item->user_id); ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Cetak Kartu</a>
											</div>
											<div class="form-group card ">
												<a href="<?= base_url('userSekolah_edit/' . $item->user_id); ?>" class="btn btn-light"><i class="fa fa-edit"></i> Edit</a>
											</div>
											<div class="form-group card ">
												<a href="<?= base_url('userSekolah_delete/' . $item->user_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
											</div>
										<?php
										} else if ($user->user_role == 2) { ?>
											<div class="form-group card ">
												<a href="<?= base_url('cetakUserSekolah/' . $item->user_id); ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Cetak Kartu</a>
											</div>
											<div class="form-group card ">
												<a href="<?= base_url('userSekolah_edit/' . $item->user_id); ?>" class="btn btn-light"><i class="fa fa-edit"></i> Edit</a>
											</div>
										<?php
										} ?>

									</td> <?php } ?>

							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php
$kode = $total_petugasPerpus + 1;
//Support KodeTambah
if ($total_petugasPerpus <= 9) {
	$kodeTambah = "000";
} else if ($total_petugasPerpus <= 99) {
	$kodeTambah = "00";
} else if ($total_petugasPerpus <= 1000) {
	$kodeTambah = "0";
} else if ($total_petugasPerpus <= 10000) {
	$kodeTambah = "";
}
?>

<div class="modal fade" id="add">
	<div class="modal-dialog modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Tambah Petugas</h5>
				<button type="button" data-dismiss="modal" class="close">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open('validation_userSekolah_add'); ?>
				<div class="row">
					<div class="col-md-6">
						<h5>Data Pribadi</h5>
						<div class="form-group">
							<label>Kode Petugas</label>
							<!-- <input type="text" class="form-control" value="<?php echo $kodeTambah . $kode; ?>" disabled>  -->
							<input type="text" name="user_noId" class="form-control" value="<?php echo "PS-" . $kodeTambah . $kode; ?>">
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
							<label>Sekolah</label>
							<select class="form-control" id="sekolah_id" name="sekolah_id">
								<option disabled selected>-- Pilih Sekolah --</option>
								<?php foreach ($sekolah as $item) { ?>
									<option value="<?php echo $item->sekolah_id; ?>"><?php echo $item->sekolah_nama; ?></option>
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
