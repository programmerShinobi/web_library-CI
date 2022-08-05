<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4><?= $title; ?></h4>
	<div class="card">
		<div class="card-body">
			<?php if ($user->user_role == 4) {
			} else { ?>
				<a href="" data-toggle="modal" data-target="#add" class="btn btn-success btn-sm mb-3"><i class="fa fa-plus"></i> Tambah data</a>
				<a href="<?= base_url("export_sekolah") ?>" target="_blank" class="btn btn-dark btn-sm mb-3"><i class="fa fa-file-export"></i> Export to excel</a>
				<a href="" data-toggle="modal" data-target="#import" class="btn btn-dark btn-sm mb-3"><i class="fa fa-file-import"></i> Import Excel</a>
			<?php } ?>
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataVisibility">
					<thead>
						<tr>
							<th>#</th>
							<th>Sekolah</th>
							<th>Kepala Sekolah</th>
							<th>Alamat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($list_sekolah as $item) { ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $item->sekolah_nama; ?></td>
								<td><?= $item->sekolah_namaKepala; ?></td>
								<td><?= $item->sekolah_alamat; ?></td>
								<td>
									<?php if ($user->user_role == 4) {
										if ($item->sekolah_id == $sekolah->sekolah_id) { ?>
											<div class="form-group card ">
												<a href="<?= base_url('perpus_check/' . $item->sekolah_id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-sitemap"></i> Manage</a>
											</div>
										<?php
										} else { ?>
											<div class="form-group card ">
												<a href="#" class="btn btn-primary btn-sm"><i class="fa fa-eye-slash"></i> Privacy</a>
											</div>
										<?php
										}
									} else if ($user->user_role == 1) { ?>
										<div class="form-group card ">
											<a href="<?= base_url('perpus_check/' . $item->sekolah_id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-sitemap"></i> Manage</a>
										</div>
										<div class="form-group card ">
											<a href="<?= base_url('sekolah_edit/' . $item->sekolah_id); ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
										</div>
										<div class="form-group card ">
											<a href="<?= base_url('sekolah_delete/' . $item->sekolah_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
										</div>
									<?php
									} else if ($user->user_role == 2) { ?>
										<div class="form-group card ">
											<a href="<?= base_url('perpus_check/' . $item->sekolah_id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-sitemap"></i> Manage</a>
										</div>
									<?php
									} else if ($user->user_role == 7) { ?>
										<div class="form-group card ">
											<a href="<?= base_url('perpus_check/' . $item->sekolah_id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-sitemap"></i> Manage</a>
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

<?php
//koneksi
$databaseHost = 'localhost';
$databaseName = 'db_library';
$databaseUsername = 'root';
$databasePassword = '';
// $databaseHost = 'localhost';
// $databaseName = 'ewebid_perpus';
// $databaseUsername = 'ewebid_admin_perpus';
// $databasePassword = '@dm!n_perpus'; 
?>

<div class="modal fade" id="add">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><b>Form</b> | Tambah Data Sekolah</h4>
				<button type="button" data-dismiss="modal" class="close">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open('validation_sekolah_add'); ?>
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
				<?= form_open_multipart("import_sekolah") ?>
				<div class="form-group">
					<label>Masukkan File Excel</label>
					<input type="file" name="import_sekolah" class="form-control">
				</div>
				<input type="submit" value="Import" class="btn btn-success btn-sm">
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
