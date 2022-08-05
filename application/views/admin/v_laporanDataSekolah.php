<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4><?= $title; ?></h4>
	<div class="card">
		<div class="card-body">
			<?php if ($user->user_role == 4) {
			} else { ?>
				<a href="<?= base_url("export_laporanDataSekolah") ?>" target="_blank" class="btn btn-dark btn-sm mb-3"><i class="fa fa-file-export"></i> Export to excel</a>
				<?php if ($user->user_role == 1) { ?>
					<a href="" data-toggle="modal" data-target="#import" class="btn btn-dark btn-sm mb-3"><i class="fa fa-file-import"></i> Import Excel</a>
				<?php } ?>
			<?php } ?>
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataLaporan">
					<thead>
						<tr>
							<th>#</th>
							<th>Tanggal Kirim</th>
							<th>Sekolah</th>
							<th>Jenis Laporan</th>
							<th>Nama Petugas</th>
							<th>Catatan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($list_laporan_data_sekolah as $item) { ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= date("d M Y", strtotime($item->laporan_tanggal)); ?></td>
								<td><?= $item->sekolah_nama; ?></td>
								<td><?= $item->laporan_jenis; ?></td>
								<td><?= $item->laporan_nama; ?></td>
								<td><?= $item->laporan_catatan; ?></td>
								<td >
									<div class="form-group card">
										<?php if ($item->laporan_jenis == "Semua") { ?>
											<a href="<?= base_url('perpus_check/' . $item->sekolah_id); ?>" class="nav-link btn btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
										<?php } else if ($item->laporan_jenis == "Perpustakaan") { ?>
											<a href="<?= base_url('perpus_check/' . $item->sekolah_id . '/perpusTab'); ?>" class="nav-link btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
										<?php } else if ($item->laporan_jenis == "Sarana - Prasarana") { ?>
											<a href="<?= base_url('perpus_check/' . $item->sekolah_id . '/saranaTab'); ?>" class="nav-link btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
										<?php } else if ($item->laporan_jenis == "Koleksi") { ?>
											<a href="<?= base_url('perpus_check/' . $item->sekolah_id . '/koleksiTab'); ?>" class="nav-link btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
										<?php } else if ($item->laporan_jenis == "Person") { ?>
											<a href="<?= base_url('perpus_check/' . $item->sekolah_id . '/personTab'); ?>" class="nav-link btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
										<?php } ?>
									</div>
									<?php if ($user->user_role == 1) { ?>
										<div class="form-group card ">
											<a href="<?= base_url('laporanDataSekolah_delete/' . $item->laporan_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
										</div>
									<?php } ?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><b>Form</b> | Tambah Data Sekolah</h4>
				<button type="button" data-dismiss="modal" class="close">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open('validation_laporanDataSekolah_add'); ?>
				<div class="form-group">
					<?= form_label('Sekolah') ?>
					<?= form_input("sekolah_nama", "", "class='form-control'"); ?>
				</div>
				<div class="form-group">
					<?= form_label('Kepala Sekolah') ?>
					<?= form_input("sekolah_namaKepala", "", "class='form-control'"); ?>
				</div>
				<div class="form-group">
					<?= form_label('Alamat') ?>
					<?= form_input("sekolah_alamat", "", "class='form-control'"); ?>
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

<div class="modal fade" id="import">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Import Data Sekolah</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open_multipart("import_laporanDataSekolah") ?>
				<div class="form-group">
					<label>Masukkan File Excel</label>
					<input type="file" name="import_laporanDataSekolah" class="form-control">
				</div>
				<input type="submit" value="Import" class="btn btn-success btn-sm">
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
