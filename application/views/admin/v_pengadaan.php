<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
	<h4><?= $title; ?></h4>
	<div class="card">
		<div class="card-body">
			<a href="" class="btn btn-success btn-sm mb-4" data-toggle="modal" data-target="#addPengadaan"><i class="fa fa-plus"></i> Tambah <?= $title; ?></a>
			<a href="<?= base_url("export_pengadaan") ?>" target="_blank" class="btn btn-dark btn-sm mb-4"><i class="fa fa-file-export"></i> Export to excel</a>
			<a href="" data-toggle="modal" data-target="#import" class="btn btn-dark btn-sm mb-4"><i class="fa fa-file-import"></i> Import Excel</a>
			<table class="table table-bordered table-hover " id="dataPengadaan">
				<thead>
					<tr>
						<th>#</th>
						<th>Judul</th>
						<th>Pengarang</th>
						<th>Penerbit</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($list_pengadaan as $item) { ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $item->pengadaan_judul; ?></td>
							<td><?= $item->pengadaan_pengarang; ?></td>
							<td><?= $item->pengadaan_penerbit; ?></td>
							<td>
								<div class="form-group card ">
									<a href="<?= base_url("pengadaan_edit/" . $item->pengadaan_id) ?>" class="btn btn-light btn-sm"><i class="fa fa-edit"></i> Edit</a>
								</div>
								<div class="form-group card ">
									<a href="<?= base_url("process_pengadaan_hapus/" . $item->pengadaan_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
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
				<?= form_open_multipart("import_pengadaan") ?>
				<div class="form-group">
					<label>Masukkan File Excel</label>
					<input type="file" name="import_pengadaan" class="form-control">
				</div>
				<input type="submit" value="Import" class="btn btn-success btn-sm">
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="addPengadaan">
	<div class="modal-dialog modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Tambah <?= $title; ?></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<?= form_open("validation_pengadaan_add"); ?>
				<div class="row">
					<div class="col-md">
						<label>Judul :</label>
						<div class="form-group">
							<input type="text" name="pengadaan_judul" placeholder="masukkan judul buku" class="form-control" required>
						</div>
						<label>Pengarang :</label>
						<div class="form-group">
							<input type="text" name="pengadaan_pengarang" placeholder="masukkan pengarang buku" class="form-control" required>
						</div>
						<label>Penerbit :</label>
						<div class="form-group">
							<input type="text" name="pengadaan_penerbit" placeholder="masukkan penerbit buku" class="form-control" required>
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
